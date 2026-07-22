<?php

namespace App\Filament\Resources\Payouts\Pages;

use App\Filament\Resources\Payouts\PayoutResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePayout extends CreateRecord
{
    protected static string $resource = PayoutResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['created_by'] = auth()->id();
        return $data;
    }
}
