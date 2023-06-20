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
        Schema::table('listing_listing_type', function (Blueprint $table) {
            $table
                ->foreign('listing_type_id')
                ->references('id')
                ->on('listing_types')
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
        Schema::table('listing_listing_type', function (Blueprint $table) {
            $table->dropForeign(['listing_type_id']);
            $table->dropForeign(['listing_id']);
        });
    }
};
