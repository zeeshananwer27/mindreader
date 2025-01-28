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
        Schema::table('custom_chapters', function (Blueprint $table) {
            $table->json('content')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('custom_chapters', function (Blueprint $table) {
            $table->longText('content')->nullable()->change();
        });
    }
};
