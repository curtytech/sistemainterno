<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class DocumentLibrary extends Model
{
    protected $fillable = [
        'name',
        'link',
        'icon',
    ];

    protected $appends = [
        'icon_url',
    ];

    public function getIconUrlAttribute(): ?string
    {
        if (! is_string($this->icon) || $this->icon === '') {
            return null;
        }

        if (Str::startsWith($this->icon, ['http://', 'https://', '/'])) {
            return $this->icon;
        }

        return Storage::disk('public')->url($this->icon);
    }
}
