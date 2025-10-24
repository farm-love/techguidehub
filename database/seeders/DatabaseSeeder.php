<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\{Category, Tag, Post, Ad, Tool, Setting};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create an admin and an author user if not exists
        $admin = User::firstOrCreate([
            'email' => 'admin@example.com',
        ], [
            'name' => 'Admin',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $user = User::firstOrCreate([
            'email' => 'author@example.com',
        ], [
            'name' => 'Author User',
            'password' => bcrypt('password'),
            'role' => 'author',
        ]);

        // Categories
        $categories = collect(['Programming', 'AI & ML', 'Web Development', 'DevOps', 'Cloud', 'Data Science'])
            ->map(function ($name) {
                return Category::firstOrCreate([
                    'slug' => Str::slug($name),
                ], [
                    'name' => $name,
                    'description' => $name . ' tutorials and guides',
                ]);
            });

        // Tags
        $tags = collect(['Laravel', 'Vue', 'React', 'Docker', 'AWS', 'Python', 'SEO'])
            ->map(fn ($name) => Tag::firstOrCreate(['slug' => Str::slug($name)], ['name' => $name]));

        // Demo posts
        foreach (range(1, 9) as $i) {
            $title = "Sample Post $i";
            $post = Post::firstOrCreate([
                'slug' => Str::slug($title),
            ], [
                'title' => $title,
                'excerpt' => 'This is a sample excerpt for the demo post.',
                'content' => '<p>This is a sample post content. Replace with your content.</p>',
                'status' => 'published',
                'published_at' => now()->subDays(10 - $i),
                'reading_time' => rand(3, 8),
                'category_id' => $categories->random()->id,
                'user_id' => $user->id,
            ]);
            $post->tags()->sync($tags->random(rand(2, 4))->pluck('id')->all());
        }

        // Ad placeholders
        $adPositions = ['header','sidebar_top','sidebar_bottom','in_article_top','in_article_middle','in_article_bottom','footer'];
        foreach ($adPositions as $pos) {
            Ad::firstOrCreate([
                'position' => $pos,
            ], [
                'name' => Str::title(str_replace('_', ' ', $pos)) . ' Ad',
                'script' => '<div style="background:#f3f4f6;padding:16px;text-align:center;border:1px dashed #cbd5e1">Ad slot: ' . e($pos) . '</div>',
                'is_active' => true,
            ]);
        }

        // Tools demo
        $tools = [
            ['name' => 'Hostinger', 'affiliate_link' => 'https://www.hostg.xyz/aff', 'rating' => 5],
            ['name' => 'Udemy', 'affiliate_link' => 'https://www.udemy.com/aff', 'rating' => 4],
            ['name' => 'AWS', 'affiliate_link' => 'https://aws.amazon.com', 'rating' => 5],
        ];
        foreach ($tools as $t) {
            Tool::firstOrCreate([
                'slug' => Str::slug($t['name']),
            ], [
                'name' => $t['name'],
                'description' => $t['name'] . ' description and review.',
                'affiliate_link' => $t['affiliate_link'] ?? null,
                'rating' => $t['rating'] ?? 0,
            ]);
        }

        // Default settings
        Setting::firstOrCreate(['key' => 'site.tagline'], ['value' => 'Tutorials, Reviews & Tools for Developers']);
        Setting::firstOrCreate(['key' => 'adsense.publisher_id'], ['value' => 'ca-pub-XXXXXXXXXXXXXXX']);
    }
}
