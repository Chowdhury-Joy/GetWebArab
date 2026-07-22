<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\User;
use App\Models\Settings;
use App\Services\PricingService;

class DashboardController extends Controller
{
    public function index(PricingService $pricingService)
    {
        $user = auth()->user();

        if ($user->isAdmin()) {
            $partners = User::where('role', 'partner')->get();
            $totalActiveClients = Client::where('status', 'active')->count();
            
            $totalHouseMonthly = 0;
            $totalPartnerPayoutsMonthly = 0;
            
            $activeClients = Client::with('activeServices')->where('status', 'active')->get();
            foreach ($activeClients as $client) {
                $split = $pricingService->computeForClient($client);
                $totalHouseMonthly += $split['monthly']['house'];
                $totalPartnerPayoutsMonthly += $split['monthly']['partner'];
            }

            return view('dashboard.admin', compact(
                'partners',
                'totalActiveClients',
                'totalHouseMonthly',
                'totalPartnerPayoutsMonthly'
            ));
        }

        // Partner
        $clients = $user->clients()->with('activeServices')->get();
        $activeClientsCount = $clients->where('status', 'active')->count();
        $founderSlotsUsed = $user->clients()->withTrashed()->count();
        $cap = Settings::current()->founder_client_cap;

        $currentMonthlyRunRate = 0;
        $lifetimeSetupEarned = 0;

        foreach ($clients as $client) {
            $split = $pricingService->computeForClient($client);
            if ($client->status === 'active') {
                $currentMonthlyRunRate += $split['monthly']['partner'];
            }
            $lifetimeSetupEarned += $split['setup']['partner'];
        }

        return view('dashboard.partner', compact(
            'clients',
            'activeClientsCount',
            'founderSlotsUsed',
            'cap',
            'currentMonthlyRunRate',
            'lifetimeSetupEarned'
        ));
    }
}
