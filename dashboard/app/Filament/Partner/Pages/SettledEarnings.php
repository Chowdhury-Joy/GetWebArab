<?php

namespace App\Filament\Partner\Pages;

use Filament\Pages\Page;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\TextColumn;

class SettledEarnings extends Page implements HasTable
{
    use InteractsWithTable;

    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-currency-dollar';
    }
    protected string $view = 'filament.partner.pages.settled-earnings';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                \App\Models\Payout::query()->where('partner_id', auth()->id())
            )
            ->columns([
                TextColumn::make('period.month')
                    ->formatStateUsing(fn ($state) => \DateTime::createFromFormat('!m', $state)->format('F')),
                TextColumn::make('period.year'),
                TextColumn::make('amount_fils')
                    ->label('Earned')
                    ->formatStateUsing(fn ($state) => number_format($state / 100, 2) . ' AED')
                    ->color('success')
                    ->weight('bold'),
            ])
            ->emptyStateHeading('No settled months with earnings yet');
    }
}
