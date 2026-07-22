<?php

namespace App\Filament\Partner\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PartnerStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $user = auth()->user();
        $activeClientsCount = $user->clients()->where('status', 'active')->count();
        $founderSlotsUsed = $user->clients()->where('is_founder', true)->count();
        $cap = \App\Models\Settings::current()->founder_client_cap;

        $pricingService = app(\App\Services\PricingService::class);
        $runRate = 0;
        foreach ($user->clients()->where('status', 'active')->with('activeServices')->get() as $client) {
            $breakdown = $pricingService->computeForClient($client);
            $runRate += $breakdown['monthly']['partner'];
        }

        return [
            Stat::make('Active Clients', $activeClientsCount),
            Stat::make('Founder Slots', "{$founderSlotsUsed} / {$cap}"),
            Stat::make('Current Month Est.', number_format($runRate / 100, 2) . ' AED'),
        ];
    }
}
