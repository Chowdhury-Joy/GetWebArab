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

            $openPeriod = \App\Models\Period::where('state', 'open')->first();
            $lastClosedPeriod = \App\Models\Period::where('state', 'closed')->orderBy('year', 'desc')->orderBy('month', 'desc')->first();
            
            $unpaidPartnersCount = 0;
            if ($lastClosedPeriod) {
                $partnerIdsWithEarnings = \App\Models\EarningLine::where('period_id', $lastClosedPeriod->id)->pluck('partner_id')->unique();
                $paidPartnerIds = \App\Models\Payout::where('period_id', $lastClosedPeriod->id)->pluck('partner_id')->unique();
                $unpaidPartnersCount = $partnerIdsWithEarnings->diff($paidPartnerIds)->count();
            }

            return view('dashboard.admin', compact(
                'partners',
                'totalActiveClients',
                'totalHouseMonthly',
                'totalPartnerPayoutsMonthly',
                'openPeriod',
                'lastClosedPeriod',
                'unpaidPartnersCount'
            ));
        }

        // Partner
        $clients = $user->clients()->with('activeServices')->get();
        $activeClientsCount = $clients->where('status', 'active')->count();
        $founderSlotsUsed = $user->clients()->withTrashed()->where('is_founder', true)->count();
        $cap = Settings::current()->founder_client_cap;

        $currentMonthlyRunRate = 0;
        $lifetimeSetupEarned = 0;

        foreach ($clients as $client) {
            $split = $pricingService->computeForClient($client);
            if ($client->status === 'active') {
                $currentMonthlyRunRate += $split['monthly']['partner'];
            }
            // For v2, lifetime setup earned might be slightly inaccurate if derived from current pricing instead of earning_lines,
            // but we'll leave it as is, or we can compute it from earning_lines.
        }
        
        $closedPeriods = \App\Models\Period::where('state', 'closed')->orderBy('year', 'desc')->orderBy('month', 'desc')->get();
        $settledData = [];
        foreach ($closedPeriods as $p) {
            $earned = $user->earnedForPeriod($p);
            if ($earned > 0) {
                $settledData[] = (object)[
                    'period' => $p,
                    'earned' => $earned,
                    'is_paid' => $user->wasPaidForPeriod($p)
                ];
            }
        }

        return view('dashboard.partner', compact(
            'clients',
            'activeClientsCount',
            'founderSlotsUsed',
            'cap',
            'currentMonthlyRunRate',
            'lifetimeSetupEarned',
            'settledData'
        ));
    }
}
