<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ClientService extends Pivot
{
    protected $table = 'client_services';

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'added_at' => 'date',
            'removed_at' => 'date',
        ];
    }
}
