<?php

namespace App\Filament\Resources\Payouts\Schemas;

use Filament\Schemas\Schema;

class PayoutForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                \Filament\Schemas\Components\Section::make()
                    ->schema([
                        \Filament\Forms\Components\Select::make('partner_id')
                            ->relationship('partner', 'name')
                            ->required(),
                        \Filament\Forms\Components\Select::make('period_id')
                            ->relationship('period', 'month')
                            ->getOptionLabelFromRecordUsing(fn (\App\Models\Period $record) => \DateTime::createFromFormat('!m', $record->month)->format('F') . ' ' . $record->year)
                            ->required(),
                        \Filament\Forms\Components\TextInput::make('amount_fils')
                            ->label('Amount Paid (in fils)')
                            ->required()
                            ->numeric(),
                        \Filament\Forms\Components\DatePicker::make('paid_at')
                            ->required()
                            ->default(now()),
                        \Filament\Forms\Components\Select::make('method')
                            ->options([
                                'bank_transfer' => 'Bank Transfer',
                                'cash' => 'Cash',
                                'crypto' => 'Crypto',
                                'paypal' => 'PayPal',
                            ]),
                        \Filament\Forms\Components\TextInput::make('reference')
                            ->label('Transaction Reference')
                            ->maxLength(255),
                    ])->columns(2)
            ]);
    }
}
