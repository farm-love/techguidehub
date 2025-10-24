<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    protected $fillable = [
        'email',
        'name',
        'source',
        'verified_at',
        'unsubscribe_token',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];
}
