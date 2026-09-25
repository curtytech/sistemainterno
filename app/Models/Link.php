<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

class Link extends Model
{
    protected $fillable = [
        'link_category_id',
        'title',
        'link',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(LinkCategory::class, 'link_category_id');
    }

    public function scopeInCategory(Builder $query, int $categoryId): Builder
    {
        return $query->where('link_category_id', $categoryId);
    }

    public function scopeInCategoryTitle(Builder $query, string $title): Builder
    {
        return $query->whereHas('category', function (Builder $sub) use ($title) {
            $sub->where('title', $title);
        });
    }

    public function scopeLatestForSite(Builder $query, int $limit = 10): Builder
    {
        return $query
            ->latest()
            ->limit($limit);
    }

    public static function getLatestForSite(int $limit = 10): Collection
    {
        if (! Schema::hasTable('links')) {
            return collect();
        }

        return static::query()
            ->latestForSite($limit)
            ->get();
    }
}
