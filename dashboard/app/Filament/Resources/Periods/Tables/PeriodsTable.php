<?php

namespace App\Filament\Resources\Periods\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class PeriodsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('month')
                    ->sortable()
                    ->formatStateUsing(fn ($state) => \DateTime::createFromFormat('!m', $state)->format('F')),
                \Filament\Tables\Columns\TextColumn::make('year')
                    ->sortable(),
                \Filament\Tables\Columns\TextColumn::make('state')
                    ->badge()
                    ->color(fn (string $state) => match ($state) {
                        'open' => 'success',
                        'closed' => 'danger',
                        default => 'gray',
                    }),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                \Filament\Actions\Action::make('close')
                    ->label('Close Period')
                    ->color('danger')
                    ->icon('heroicon-o-lock-closed')
                    ->requiresConfirmation()
                    ->hidden(fn ($record) => $record->state === 'closed')
                    ->action(function ($record) {
                        $service = app(\App\Services\PeriodService::class);
                        $service->closePeriod($record);
                        \Filament\Notifications\Notification::make()
                            ->title('Period Closed successfully')
                            ->success()
                            ->send();
                    }),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
