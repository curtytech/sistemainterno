<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LinkCategory extends Model
{
    protected $fillable = [
        'title',
    ];

    public function links(): HasMany
    {
        return $this->hasMany(Link::class);
    }
}
