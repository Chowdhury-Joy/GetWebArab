<?php

namespace App\Filament\Resources\Services\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;

class ServicesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                \Filament\Tables\Columns\TextColumn::make('key')
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                \Filament\Tables\Columns\TextColumn::make('default_price_fils')
                    ->label('Default Price')
                    ->numeric()
                    ->sortable()
                    ->formatStateUsing(fn ($state) => number_format($state / 100, 2) . ' AED'),
                \Filament\Tables\Columns\IconColumn::make('is_mandatory')
                    ->boolean(),
                \Filament\Tables\Columns\IconColumn::make('is_recurring')
                    ->boolean(),
                \Filament\Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
                \Filament\Tables\Columns\TextColumn::make('sort_order')
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
