<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('bio')->nullable()->after('email');
            $table->string('avatar')->nullable()->after('bio');
            $table->string('twitter')->nullable()->after('avatar');
            $table->string('github')->nullable()->after('twitter');
            $table->string('website')->nullable()->after('github');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['bio', 'avatar', 'twitter', 'github', 'website']);
        });
    }
};


