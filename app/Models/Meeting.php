<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Meeting extends Model
{
    protected $table = 'mettings';

    protected $fillable = [
        'category_id',
        'content',
        'end_date',
        'end_time',
        'title',
        'image',
        'start_date',
        'start_time',
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
        return $this->belongsTo(MeetingCategory::class, 'category_id');
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
}
