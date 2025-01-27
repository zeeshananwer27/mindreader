<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHasImageToCustomChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('custom_chapters', function (Blueprint $table) {
            // Add the 'has_image' column with a default value of false (assuming it's a boolean)
            $table->boolean('has_image')->default(false)->after('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('custom_chapters', function (Blueprint $table) {
            // Drop the 'has_image' column if rolling back
            $table->dropColumn('has_image');
        });
    }
}
