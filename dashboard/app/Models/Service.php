<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['key', 'name', 'is_mandatory', 'default_price_fils', 'is_recurring', 'is_active', 'sort_order'])]
class Service extends Model
{
    protected function casts(): array
    {
        return [
            'is_mandatory' => 'boolean',
            'is_recurring' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(Client::class, 'client_services')
            ->withPivot('price_fils', 'is_active', 'added_at', 'removed_at')
            ->withTimestamps();
    }
}
