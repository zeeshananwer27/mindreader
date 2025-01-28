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
        Schema::table('chapter_topics', function (Blueprint $table) {
            $table->dropColumn(['title', 'paragraph', 'image']);
            $table->text('content')->nullable()->after('type');
            $table->uuid('uid')->unique();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chapter_topics', function (Blueprint $table) {
            $table->dropColumn('content');
            $table->dropColumn('uid');
        });
    }
};

