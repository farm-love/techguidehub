<?php

namespace App\Http\Controllers;

use App\Models\Tool;

class ToolController extends Controller
{
    public function index()
    {
        $tools = Tool::orderByDesc('rating')->paginate(12);
        return view('tools.index', compact('tools'));
    }

    public function show(Tool $tool)
    {
        return view('tools.show', compact('tool'));
    }
}


