<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('category_id')->nullable()->index();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('excerpt', 500)->nullable();
            $table->longText('content')->nullable();
            $table->string('thumbnail')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('reading_time')->default(0);
            $table->unsignedBigInteger('views')->default(0);
            $table->enum('status', ['draft', 'scheduled', 'published'])->default('draft');
            $table->timestamp('published_at')->nullable();
            $table->string('canonical_url')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->json('schema_json')->nullable();
            $table->timestamps();
            $table->index(['status', 'published_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
