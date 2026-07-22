<?php

namespace App\Services;

use App\Models\Period;
use App\Models\Client;
use App\Models\EarningLine;
use Illuminate\Support\Facades\DB;
use Exception;
use Carbon\Carbon;

class PeriodService
{
    protected PricingService $pricingService;

    public function __construct(PricingService $pricingService)
    {
        $this->pricingService = $pricingService;
    }

    public function closePeriod(Period $period): void
    {
        if ($period->state !== 'open') {
            throw new Exception("Cannot close a period that is already closed.");
        }

        DB::transaction(function () use ($period) {
            $periodEnd = Carbon::create($period->year, $period->month, 1)->endOfMonth();

            // Find all clients that could have activity this month
            // We'll iterate and check conditions inside
            $clients = Client::with('activeServices')->get();

            foreach ($clients as $client) {
                // Determine if they are billable this month
                $hasActiveServices = $client->activeServices->isNotEmpty();
                
                if ($client->status === 'active' && $hasActiveServices) {
                    // Reuse PricingService exactly as is
                    $breakdown = $this->pricingService->computeForClient($client);

                    // MONTHLY LINE
                    // Only if they actually have monthly charges (list > 0) to avoid zero-rows
                    if ($breakdown['monthly']['list'] > 0) {
                        EarningLine::create([
                            'period_id' => $period->id,
                            'partner_id' => $client->partner_id,
                            'client_id' => $client->id,
                            'kind' => 'monthly',
                            'list_fils' => $breakdown['monthly']['list'],
                            'discount_pct' => $client->discount_pct_applied,
                            'charged_fils' => $breakdown['monthly']['charged'],
                            'partner_fils' => $breakdown['monthly']['partner'],
                            'house_fils' => $breakdown['monthly']['house'],
                        ]);
                    }

                    // SETUP LINE
                    // Only in the month they joined, and only if no setup line exists for this client EVER
                    if ($client->started_at && $client->started_at->lte($periodEnd)) {
                        $setupExists = EarningLine::where('client_id', $client->id)
                            ->where('kind', 'setup')
                            ->exists();

                        if (!$setupExists && $breakdown['setup']['list'] >= 0) {
                            EarningLine::create([
                                'period_id' => $period->id,
                                'partner_id' => $client->partner_id,
                                'client_id' => $client->id,
                                'kind' => 'setup',
                                'list_fils' => $breakdown['setup']['list'],
                                'discount_pct' => $client->discount_pct_applied,
                                'charged_fils' => $breakdown['setup']['charged'],
                                'partner_fils' => $breakdown['setup']['partner'],
                                'house_fils' => $breakdown['setup']['house'],
                            ]);
                        }
                    }
                }
            }

            $period->update([
                'state' => 'closed',
                'closed_at' => now(),
                'closed_by' => auth()->id(), // null in console/tests without auth
            ]);
        });
    }
}
