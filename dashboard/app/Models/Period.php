<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Period extends Model
{
    protected $guarded = [];

    protected $casts = [
        'closed_at' => 'datetime',
    ];

    public function earningLines(): HasMany
    {
        return $this->hasMany(EarningLine::class);
    }

    public function payouts(): HasMany
    {
        return $this->hasMany(Payout::class);
    }

    public function closer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'closed_by');
    }
}
