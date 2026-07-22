<?php

namespace App\Filament\Resources\Payouts\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class PayoutsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('partner.name')
                    ->sortable()
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('period.month')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => \DateTime::createFromFormat('!m', $state)->format('F')),
                \Filament\Tables\Columns\TextColumn::make('period.year')
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('amount_fils')
                    ->label('Amount Paid')
                    ->formatStateUsing(fn ($state) => number_format($state / 100, 2) . ' AED')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
