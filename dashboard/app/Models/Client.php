<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['partner_id', 'business_name', 'contact_name', 'contact_phone', 'contact_email', 'setup_fee_fils', 'is_founder', 'discount_pct_applied', 'status', 'started_at'])]
class Client extends Model
{
    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'is_founder' => 'boolean',
            'started_at' => 'date',
        ];
    }

    public function partner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'partner_id');
    }

    public function services(): BelongsToMany
    {
        return $this->belongsToMany(Service::class, 'client_services')
            ->withPivot('price_fils', 'is_active', 'added_at', 'removed_at')
            ->withTimestamps();
    }

    public function activeServices(): BelongsToMany
    {
        return $this->services()->wherePivot('is_active', true);
    }
}
