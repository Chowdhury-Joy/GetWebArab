<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'cover_image_url',
        'meta_title',
        'meta_description',
        'status',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->where('published_at', '<=', now());
    }

    public function getDisplayMetaTitleAttribute(): string
    {
        return $this->meta_title ?: $this->title;
    }

    public function getDisplayMetaDescriptionAttribute(): string
    {
        return $this->meta_description ?: (string) str($this->excerpt ?: strip_tags($this->content))->limit(160);
    }
}
