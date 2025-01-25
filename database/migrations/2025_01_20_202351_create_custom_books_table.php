<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        if (!Schema::hasTable('custom_author_profiles')) {
        // Create custom_author_profiles table
        Schema::create('custom_author_profiles', function (Blueprint $table) {
            $table->id();
            $table->uuid('uid')->unique();
            $table->string('name')->nullable();
            $table->text('biography')->nullable();
            $table->string('tone')->nullable();
            $table->string('style')->nullable();
            $table->string('image')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('status')->default('active');
            $table->timestamps();
        });
    }

    if (!Schema::hasTable('custom_books')) {

        // Create custom_books table
        Schema::create('custom_books', function (Blueprint $table) {
            $table->id();
            $table->uuid('uid')->unique();
            $table->string('title');
            $table->string('genre');
            $table->string('language');
            $table->text('purpose')->nullable();
            $table->text('target_audience')->nullable();
            $table->string('length');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('author_profile_id')->nullable()->constrained('custom_author_profiles')->onDelete('set null');
            $table->string('status')->default('draft');
            $table->timestamps();
        });
    }

    if (!Schema::hasTable('custom_chapters')) {

        // Create custom_chapters table
        Schema::create('custom_chapters', function (Blueprint $table) {
            $table->id();
            $table->uuid('uid')->unique();
            $table->string('title');
            $table->longText('content')->nullable();
            $table->foreignId('book_id')->constrained('custom_books')->onDelete('cascade');
            $table->string('status')->default('draft');
            $table->timestamps();
        });
    }

    if (!Schema::hasTable('custom_audiobooks')) {
        // Create custom_audiobooks table
        Schema::create('custom_audiobooks', function (Blueprint $table) {
            $table->id();
            $table->uuid('uid')->unique();
            $table->string('file_path')->nullable();
            $table->foreignId('book_id')->constrained('custom_books')->onDelete('cascade');
            $table->string('status')->default('processing');
            $table->timestamps();
        });
    }
    if (!Schema::hasTable('book_media')) {

        // Create book_media table
        Schema::create('book_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained('custom_books')->onDelete('cascade');
            $table->foreignId('chapter_id')->nullable()->constrained('custom_chapters')->onDelete('set null');
            $table->string('file_path')->nullable();
            $table->string('type')->default('image'); // e.g., image, video
            $table->timestamps();
        });
    }
    if (!Schema::hasTable('chapter_topics')) {

        // Create chapter_topics table
        Schema::create('chapter_topics', function (Blueprint $table) {
            $table->id();
            $table->foreignId('chapter_id')->constrained('custom_chapters')->onDelete('cascade');
            $table->string('title');
            $table->text('paragraph')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('chapter_topics');
        Schema::dropIfExists('book_media');
        Schema::dropIfExists('custom_audiobooks');
        Schema::dropIfExists('custom_chapters');
        Schema::dropIfExists('custom_books');
        Schema::dropIfExists('custom_author_profiles');
    }
};
