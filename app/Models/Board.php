<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Board extends Model
{
    protected $fillable = [
        'title',
        'content',
        'image',
        'link',
        'file',
    ];

    protected $appends = [
        'image_url',
        'file_url',
    ];

    public function getImageUrlAttribute(): ?string
    {
        return $this->resolvePublicPath($this->image);
    }

    public function getFileUrlAttribute(): ?string
    {
        return $this->resolvePublicPath($this->file);
    }

    public function scopeLatestForSite(Builder $query, int $limit = 5): Builder
    {
        return $query
            ->latest()
            ->limit($limit);
    }

    public static function getLatestForSite(int $limit = 5): Collection
    {
        if (! Schema::hasTable('boards')) {
            return collect();
        }

        return static::query()
            ->latestForSite($limit)
            ->get();
    }

    protected function resolvePublicPath(?string $path): ?string
    {
        if (! is_string($path) || $path === '') {
            return null;
        }

        if (Str::startsWith($path, ['http://', 'https://', '/'])) {
            return $path;
        }

        return Storage::disk('public')->url($path);
    }
}
