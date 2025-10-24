<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PostApiController;
use App\Http\Controllers\Api\CategoryApiController;
use App\Http\Controllers\Api\AdApiController;
use App\Http\Controllers\Api\AiGeneratorController;
use App\Http\Controllers\Api\ToolApiController;

Route::get('/posts', [PostApiController::class, 'index']);
Route::get('/posts/{post:slug}', [PostApiController::class, 'show']);

Route::get('/categories', [CategoryApiController::class, 'index']);
Route::get('/categories/{category:slug}', [CategoryApiController::class, 'show']);

Route::get('/ads', [AdApiController::class, 'index']);

Route::post('/ai-generator', [AiGeneratorController::class, 'generate']);

Route::get('/tools', [ToolApiController::class, 'index']);
Route::get('/tools/{tool:slug}', [ToolApiController::class, 'show']);


