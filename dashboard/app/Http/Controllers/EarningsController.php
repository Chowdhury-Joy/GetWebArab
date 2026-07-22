<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PricingService;

class EarningsController extends Controller
{
    public function index(PricingService $pricingService)
    {
        $user = auth()->user();
        $clients = $user->clients()->with('activeServices')->get();

        $currentMonthlyRunRate = 0;
        $lifetimeSetupEarned = 0;
        $clientEarnings = [];

        foreach ($clients as $client) {
            $split = $pricingService->computeForClient($client);
            if ($client->status === 'active') {
                $currentMonthlyRunRate += $split['monthly']['partner'];
            }
            $lifetimeSetupEarned += $split['setup']['partner'];

            $clientEarnings[] = [
                'client' => $client,
                'setup' => $split['setup']['partner'],
                'monthly' => $split['monthly']['partner'],
            ];
        }

        return view('earnings.index', compact('currentMonthlyRunRate', 'lifetimeSetupEarned', 'clientEarnings'));
    }
}
