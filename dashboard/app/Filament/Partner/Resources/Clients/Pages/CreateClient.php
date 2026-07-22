<?php

namespace App\Filament\Partner\Resources\Clients\Pages;

use App\Filament\Partner\Resources\Clients\ClientResource;
use Filament\Resources\Pages\CreateRecord;

class CreateClient extends CreateRecord
{
    protected static string $resource = ClientResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['partner_id'] = auth()->id();
        return $data;
    }
}
