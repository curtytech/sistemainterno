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
            'start_time' => 'string',
            'end_time' => 'string',
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

        $haystack = array('http://', 'https://', '/');
        if (Str::startsWith($this->image, $haystack)) {
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

    public function scopePublished(Builder $query): Builder
    {
        return $query
            ->with('category:id,name')
            ->orderBy('created_at', 'DESC');
    }

    public function scopeUpcoming(Builder $query): Builder
    {
        $today = now()->toDateString();

        return $query
            ->with('category:id,name')
            ->where(function (Builder $sub) use ($today) {
                $sub
                    ->whereDate('end_date', '>=', $today)
                    ->orWhereNull('end_date');
            })
            ->orderByRaw('COALESCE(start_date, created_at) ASC');
    }

    public function scopeFuture(Builder $query): Builder
    {
        $today = now()->toDateString();

        return $query
            ->with('category:id,name')
            ->whereDate('start_date', '>=', $today)
            ->orderBy('start_date', 'ASC');
    }

    public function scopeSortedForListing(Builder $query): Builder
    {
        $today = now()->toDateString();
        $coalesce = 'COALESCE(start_date, end_date, created_at)';
        $juliandayToday = 'julianday(?)';
        $upcomingFlag = "CASE WHEN {$coalesce} >= {$juliandayToday} THEN 0 ELSE 1 END";
        $upcomingDate = "CASE WHEN {$coalesce} >= {$juliandayToday} THEN julianday({$coalesce}) ELSE NULL END ASC";
        $pastDate = "CASE WHEN {$coalesce} <  {$juliandayToday} THEN julianday({$coalesce}) ELSE NULL END DESC";

        return $query
            ->with('category:id,name')
            ->orderByRaw($upcomingFlag, array($today))
            ->orderByRaw($upcomingDate, array($today))
            ->orderByRaw($pastDate, array($today));
    }

    public function scopeRecentAndUpcoming(Builder $query, int $limit = 6): Builder
    {
        return $query
            ->sortedForListing()
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
