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
        Schema::table('listing_feed', function (Blueprint $table) {
            $table
                ->foreign('feed_id')
                ->references('id')
                ->on('feeds')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('listing_id')
                ->references('id')
                ->on('listings')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('listing_feed', function (Blueprint $table) {
            $table->dropForeign(['feed_id']);
            $table->dropForeign(['listing_id']);
        });
    }
};
