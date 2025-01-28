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
            $table->enum('type', ['image', 'paragraph', 'title'])->default('paragraph')->after('chapter_id');
            $table->integer('order')->nullable()->after('chapter_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chapter_topics', function (Blueprint $table) {
            $table->dropColumn('order');
            $table->dropColumn('type');
        });
    }
};
