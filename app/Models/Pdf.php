<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Pdf extends Model
{
    protected $fillable = [
        'title',
        'file',
    ];

    protected $appends = [
        'file_url',
    ];

    public function getFileUrlAttribute(): ?string
    {
        if (! is_string($this->file) || $this->file === '') {
            return null;
        }

        if (Str::startsWith($this->file, ['http://', 'https://', '/'])) {
            return $this->file;
        }

        return Storage::disk('public')->url($this->file);
    }

    public function scopeLatestForSite(Builder $query, int $limit = 10): Builder
    {
        return $query
            ->latest()
            ->limit($limit);
    }

    public static function getLatestForSite(int $limit = 10): Collection
    {
        if (! Schema::hasTable('pdfs')) {
            return collect();
        }

        return static::query()
            ->latestForSite($limit)
            ->get();
    }
}
