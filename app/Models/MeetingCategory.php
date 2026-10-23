<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MeetingCategory extends Model
{
    protected $table = 'metting_categories';

    protected $fillable = [
        'name',
        'description',
    ];

    public function meetings(): HasMany
    {
        return $this->hasMany(Meeting::class, 'category_id');
    }
}
