<?php

namespace App\Services;

use App\Models\Client;
use App\Models\Settings;

class PricingService
{
    public function computeForClient(Client $client): array
    {
        $s = Settings::current();

        // --- SETUP (one-time) ---
        $setupList     = $client->setup_fee_fils;
        $setupCharged  = $this->applyDiscount($setupList, $client->discount_pct_applied);
        $setupPartner  = round($setupCharged * $s->partner_setup_pct / 100);
        $setupHouse    = $setupCharged - $setupPartner;

        // --- MONTHLY (recurring) ---
        $monthlyList = $client->activeServices->sum('pivot.price_fils');
        $monthlyCharged = $this->applyDiscount($monthlyList, $client->discount_pct_applied);
        $monthlyPartner = round($monthlyCharged * $s->partner_monthly_pct / 100);
        $monthlyHouse   = $monthlyCharged - $monthlyPartner;

        return [
            'setup'   => [
                'list'    => $setupList,
                'charged' => $setupCharged,
                'partner' => $setupPartner,
                'house'   => $setupHouse,
            ],
            'monthly' => [
                'list'    => $monthlyList,
                'charged' => $monthlyCharged,
                'partner' => $monthlyPartner,
                'house'   => $monthlyHouse,
            ],
        ];
    }

    private function applyDiscount($fils, $pct)
    {
        return $fils - round($fils * $pct / 100);
    }
}
