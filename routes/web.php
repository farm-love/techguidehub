<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\ToolController;


Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/category/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

// Static pages for AdSense
Route::view('/about', 'pages.about')->name('about');
Route::view('/contact', 'pages.contact')->name('contact');
Route::view('/privacy', 'pages.privacy')->name('privacy');
Route::view('/terms', 'pages.terms')->name('terms');
Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');
// Robots and sitemap
Route::get('/robots.txt', function () {
    $content = "User-agent: *\nAllow: /\nSitemap: " . url('/sitemap.xml') . "\n";
    return Response::make($content, 200, ['Content-Type' => 'text/plain']);
});

Route::get('/sitemap.xml', function () {
    $posts = \App\Models\Post::where('status', 'published')->orderByDesc('updated_at')->get();
    return response()->view('sitemap', compact('posts'))->header('Content-Type', 'application/xml');
})->name('sitemap');

// RSS Feed
Route::get('/feed.xml', function () {
    $posts = \App\Models\Post::where('status', 'published')->orderByDesc('published_at')->limit(30)->get();
    return response()->view('rss', compact('posts'))->header('Content-Type', 'application/rss+xml');
})->name('rss');

// Newsletter
Route::post('/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// AI Generator (auth required)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/ai-generator', 'pages.ai-generator')->name('ai.generator');
});

// Tools
Route::get('/tools', [ToolController::class, 'index'])->name('tools.index');
Route::get('/tools/{tool:slug}', [ToolController::class, 'show'])->name('tools.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Admin area - basic CRUD for posts and ads (requires auth)
Route::middleware(['auth', 'verified', 'role:admin|author'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('posts', App\Http\Controllers\Admin\PostController::class)->except(['show']);
});

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('ads', App\Http\Controllers\Admin\AdController::class)->except(['show']);
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class)->except(['show']);
    Route::resource('tags', App\Http\Controllers\Admin\TagController::class)->except(['show']);
    Route::resource('users', App\Http\Controllers\Admin\UserController::class)->except(['show']);
    Route::resource('settings', App\Http\Controllers\Admin\SettingController::class)->except(['show', 'create', 'edit']);
});
