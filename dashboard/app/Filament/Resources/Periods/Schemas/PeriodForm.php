<?php

namespace App\Filament\Resources\Periods\Schemas;

use Filament\Schemas\Schema;

class PeriodForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make()
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('month')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(12),
                        \Filament\Forms\Components\TextInput::make('year')
                            ->required()
                            ->numeric()
                            ->minValue(2000),
                        \Filament\Forms\Components\Select::make('state')
                            ->options([
                                'open' => 'Open',
                                'closed' => 'Closed',
                            ])
                            ->default('open')
                            ->required(),
                    ])->columns(2)
            ]);
    }
}
