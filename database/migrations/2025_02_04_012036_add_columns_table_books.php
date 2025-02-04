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
        // Add 'synopsis' column to the 'books' table
        Schema::table('custom_books', function (Blueprint $table) {
            $table->string('book_url')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove 'synopsis' column from the 'books' table
        Schema::table('custom_books', function (Blueprint $table) {
            $table->dropColumn('book_url');
        });
    }
};
