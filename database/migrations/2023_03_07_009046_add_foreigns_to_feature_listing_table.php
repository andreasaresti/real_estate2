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
        Schema::table('feature_listing', function (Blueprint $table) {
            $table
                ->foreign('listing_id')
                ->references('id')
                ->on('listings')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('feature_id')
                ->references('id')
                ->on('features')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('feature_listing', function (Blueprint $table) {
            $table->dropForeign(['listing_id']);
            $table->dropForeign(['feature_id']);
        });
    }
};
