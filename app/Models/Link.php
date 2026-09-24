<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

class Link extends Model
{
    protected $fillable = [
        'title',
        'link',
    ];

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
