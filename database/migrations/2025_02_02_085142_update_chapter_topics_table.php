<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Drop the 'content' column first
        Schema::table('chapter_topics', function (Blueprint $table) {
            $table->dropColumn('content');
            $table->dropColumn('type');
        });

        // Add new columns
        Schema::table('chapter_topics', function (Blueprint $table) {
            $table->jsonb('content')->nullable()->after('chapter_id');
            $table->enum('type', ['image', 'paragraph', 'header'])->default('paragraph')->after('chapter_id');
        });
    }

    public function down(): void
    {
        Schema::table('chapter_topics', function (Blueprint $table) {
            $table->dropColumn(['type', 'content']); // Drop the new column if rolling back
        });

        Schema::table('chapter_topics', function (Blueprint $table) {
            $table->enum('type', ['image', 'paragraph', 'title '])->default('paragraph')->after('chapter_id'); // Restore original column
            $table->text('content')->nullable()->after('chapter_id');
        });
    }
};

