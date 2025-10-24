<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiGeneration extends Model
{
    protected $fillable = ['user_id','topic','prompt','output','meta'];

    protected $casts = [
        'meta' => 'array',
    ];
}


