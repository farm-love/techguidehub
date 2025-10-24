<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Ad;

class AdApiController extends Controller
{
    public function index()
    {
        $ads = Ad::where('is_active', true)->get();
        return response()->json($ads);
    }
}


