<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'affiliate_link', 'image', 'rating',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}


