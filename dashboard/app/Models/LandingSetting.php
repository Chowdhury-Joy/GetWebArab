<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class LandingSetting extends Model
{
    protected $fillable = [
        'meta_title',
        'meta_description',
        'whatsapp_number',
        'og_image_url',
    ];

    public static function current(): self
    {
        $attributes = Cache::rememberForever('landing_setting.current', function () {
            return self::firstOrCreate(
                ['id' => 1],
                [
                    'meta_title' => 'Get Web Arab — Turn Your Website Into A Customer Magnet for UAE Local Businesses',
                    'meta_description' => 'High-converting bilingual websites, continuous technical care, and predictable growth modules for UAE local businesses. Clear fixed pricing in AED.',
                    'whatsapp_number' => '971500000000',
                ]
            )->getAttributes();
        });

        $instance = (new static)->forceFill($attributes)->syncOriginal();
        $instance->exists = true;

        return $instance;
    }

    protected static function booted()
    {
        static::saved(function () {
            Cache::forget('landing_setting.current');
        });
    }
}
