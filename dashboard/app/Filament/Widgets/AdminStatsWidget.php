<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AdminStatsWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        $totalPartners = \App\Models\User::where('role', 'partner')->count();
        $activeClients = \App\Models\Client::where('status', 'active')->count();
        $openPeriods = \App\Models\Period::where('state', 'open')->count();
        $totalPaidOutFils = \App\Models\Payout::sum('amount_fils');

        return [
            Stat::make('Total Partners', $totalPartners)
                ->icon('heroicon-o-users')
                ->color('primary'),
            Stat::make('Active Clients', $activeClients)
                ->icon('heroicon-o-briefcase')
                ->color('success'),
            Stat::make('Open Periods', $openPeriods)
                ->icon('heroicon-o-clock')
                ->color('warning'),
            Stat::make('Total Paid Out', number_format($totalPaidOutFils / 100, 2) . ' AED')
                ->icon('heroicon-o-banknotes')
                ->color('info'),
        ];
    }
}
