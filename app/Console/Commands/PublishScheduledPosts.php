<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class PublishScheduledPosts extends Command
{
    protected $signature = 'posts:publish-scheduled';
    protected $description = 'Publish scheduled posts whose published_at is due';

    public function handle(): int
    {
        $due = Post::where('status', 'scheduled')
            ->whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->get();

        foreach ($due as $post) {
            $post->status = 'published';
            $post->save();
            $this->info("Published: {$post->title}");
        }

        return self::SUCCESS;
    }
}


