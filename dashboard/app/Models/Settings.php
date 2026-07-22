<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Support\Facades\Cache;

#[Fillable(['partner_setup_pct', 'partner_monthly_pct', 'founder_discount_pct', 'founder_client_cap'])]
class Settings extends Model
{
    public static function current(): self
    {
        return Cache::rememberForever('settings.current', function () {
            return self::firstOrCreate(
                ['id' => 1],
                [
                    'partner_setup_pct' => 40.00,
                    'partner_monthly_pct' => 25.00,
                    'founder_discount_pct' => 25.00,
                    'founder_client_cap' => 5,
                ]
            );
        });
    }

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('settings.current');
        });
    }
}
