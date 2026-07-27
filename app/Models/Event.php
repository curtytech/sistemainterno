<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Event extends Model
{
    protected $fillable = [
        'category_id',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'content',
        'title',
        'image',
    ];

    protected $appends = [
        'category_name',
        'image_url',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'date',
            'end_date' => 'date',
        ];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(EventCategory::class, 'category_id');
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

    public function scopeLatestForSite(Builder $query, int $limit = 3): Builder
    {
        return $query
            ->with('category:id,name')
            ->latest()
            ->limit($limit);
    }

    public static function getLatestForSite(int $limit = 3): Collection
    {
        if (! Schema::hasTable('events') || ! Schema::hasTable('event_categories')) {
            return collect();
        }

        return static::query()
            ->latestForSite($limit)
            ->get();
    }
}
