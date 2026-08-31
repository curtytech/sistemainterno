<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class News extends Model
{
    protected $table = 'news';

    protected $fillable = [
        'category_id',
        'content',
        'title',
        'image',
    ];

    protected $appends = [
        'category_name',
        'image_url',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(NewsCategory::class, 'category_id');
    }

    public function getCategoryNameAttribute(): ?string
    {
        return $this->category?->name;
    }

    public function getImageUrlAttribute(): ?string
    {
        if (! is_string($this->image) || $this->image === '') {
            return null;
        }

        if (Str::startsWith($this->image, ['http://', 'https://', '/'])) {
            return $this->image;
        }

        return Storage::disk('public')->url($this->image);
    }

    public function scopeLatestForSite(Builder $query, int $limit = 4): Builder
    {
        return $query
            ->with('category:id,name')
            ->latest()
            ->limit($limit);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query
            ->with('category:id,name')
            ->orderBy('created_at', 'DESC');
    }

    public static function getLatestForSite(int $limit = 4): Collection
    {
        if (! Schema::hasTable('news') || ! Schema::hasTable('news_categories')) {
            return collect();
        }

        return static::query()
            ->latestForSite($limit)
            ->get();
    }
}
