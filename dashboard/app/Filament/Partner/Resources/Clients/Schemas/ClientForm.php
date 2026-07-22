<?php

namespace App\Filament\Partner\Resources\Clients\Schemas;

use Filament\Schemas\Schema;

class ClientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make()
                    ->schema([
                        \Filament\Forms\Components\TextInput::make('business_name')
                            ->required()
                            ->maxLength(255),
                        \Filament\Forms\Components\TextInput::make('contact_name')
                            ->required()
                            ->maxLength(255),
                        \Filament\Forms\Components\TextInput::make('contact_email')
                            ->email()
                            ->required()
                            ->maxLength(255),
                        \Filament\Forms\Components\TextInput::make('contact_phone')
                            ->tel()
                            ->maxLength(255),
                        \Filament\Forms\Components\TextInput::make('setup_fee_fils')
                            ->label('Setup Fee (in fils)')
                            ->numeric()
                            ->default(0)
                            ->required(),
                        \Filament\Forms\Components\TextInput::make('discount_pct_applied')
                            ->label('Discount (%)')
                            ->numeric()
                            ->default(0),
                        \Filament\Forms\Components\DatePicker::make('started_at')
                            ->default(now()),
                        \Filament\Forms\Components\Select::make('status')
                            ->options([
                                'prospect' => 'Prospect',
                                'active' => 'Active',
                                'churned' => 'Churned',
                            ])
                            ->default('active')
                            ->required(),
                    ])->columns(2)
            ]);
    }
}
