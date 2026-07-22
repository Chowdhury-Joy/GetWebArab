<?php

namespace App\Filament\Resources\Services\Schemas;

use Filament\Schemas\Schema;

class ServiceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make()
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('key')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        \Filament\Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        \Filament\Forms\Components\TextInput::make('default_price_fils')
                            ->label('Default Price (in fils)')
                            ->required()
                            ->numeric()
                            ->default(0),
                        \Filament\Forms\Components\TextInput::make('sort_order')
                            ->required()
                            ->numeric()
                            ->default(0),
                        \Filament\Forms\Components\Toggle::make('is_mandatory')
                            ->default(false),
                        \Filament\Forms\Components\Toggle::make('is_recurring')
                            ->default(true),
                        \Filament\Forms\Components\Toggle::make('is_active')
                            ->default(true),
                    ])->columns(2)
            ]);
    }
}
