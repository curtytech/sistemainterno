<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

class News extends Model
{
    protected $table = 'news';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'category_id',
        'content',
        'title',
        'image',
    ];

    protected $appends = [
        'category_name',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(NewsCategory::class, 'category_id');
    }

    public function getCategoryNameAttribute(): ?string
    {
        return $this->category?->name;
    }

    public function scopeLatestForSite(Builder $query, int $limit = 4): Builder
    {
        return $query
            ->with('category:id,name')
            ->latest()
            ->limit($limit);
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
