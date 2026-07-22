<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Period;
use App\Models\EarningLine;
use App\Models\Client;
use App\Services\PeriodService;
use App\Services\PricingService;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;

class PeriodController extends Controller
{
    public function index(PricingService $pricingService)
    {
        $periods = Period::orderBy('year', 'desc')->orderBy('month', 'desc')->get();
        
        // Find or create current open period
        $now = now();
        $currentPeriod = Period::firstOrCreate(
            ['year' => $now->year, 'month' => $now->month],
            ['state' => 'open']
        );

        if (!$periods->contains('id', $currentPeriod->id)) {
            $periods->prepend($currentPeriod);
        }

        // Compute live preview for open periods
        $previews = [];
        $periodService = app(PeriodService::class);
        
        foreach ($periods as $period) {
            if ($period->state === 'open') {
                $previews[$period->id] = $periodService->previewPeriod($period);
            } else {
                $previews[$period->id] = [
                    'house_earned' => EarningLine::where('period_id', $period->id)->sum('house_fils'),
                    'partner_earned' => EarningLine::where('period_id', $period->id)->sum('partner_fils'),
                ];
            }
        }

        return view('admin.periods.index', compact('periods', 'previews'));
    }

    public function close(Period $period, PeriodService $periodService)
    {
        if ($period->state !== 'open') {
            return back()->with('error', 'Period is already closed.');
        }

        try {
            $periodService->closePeriod($period);
            return back()->with('success', 'Period closed successfully.');
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}
