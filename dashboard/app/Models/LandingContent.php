<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LandingContent extends Model
{
    protected $fillable = [
        'key',
        'section',
        'sort_order',
        'en',
        'ar',
    ];

    public static function asI18n(): array
    {
        $rows = static::orderBy('sort_order')->get();

        return [
            'en' => $rows->pluck('en', 'key')->toArray(),
            'ar' => $rows->pluck('ar', 'key')->toArray(),
        ];
    }
}
