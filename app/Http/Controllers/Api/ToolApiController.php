<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tool;

class ToolApiController extends Controller
{
    public function index()
    {
        return response()->json(Tool::orderByDesc('rating')->paginate(12));
    }

    public function show(Tool $tool)
    {
        return response()->json($tool);
    }
}


