<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    protected $fillable = [
        'name',
        'position',
        'script',
        'display_rules',
        'is_active',
    ];

    protected $casts = [
        'display_rules' => 'array',
        'is_active' => 'boolean',
    ];
}
