<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'excerpt',
        'content',
        'thumbnail',
        'is_featured',
        'reading_time',
        'views',
        'status',
        'published_at',
        'canonical_url',
        'meta_title',
        'meta_description',
        'schema_json',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'published_at' => 'datetime',
        'schema_json' => 'array',
    ];

    protected static function booted(): void
    {
        static::saving(function (Post $post) {
            if (empty($post->reading_time) && !empty($post->content)) {
                $text = strip_tags($post->content);
                $words = str_word_count($text);
                $post->reading_time = max(1, (int) ceil($words / 200));
            }
        });
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
