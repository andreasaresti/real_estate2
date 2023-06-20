<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('banner_images', function (Blueprint $table) {
            $table
                ->foreign('banner_id')
                ->references('id')
                ->on('banners')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('language_id')
                ->references('id')
                ->on('languages')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('banner_images', function (Blueprint $table) {
            $table->dropForeign(['banner_id']);
            $table->dropForeign(['language_id']);
        });
    }
};
