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
        Schema::table('request_areas', function (Blueprint $table) {
            $table
                ->foreign('listingRequest_id')
                ->references('id')
                ->on('listing_requests')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('district_id')
                ->references('id')
                ->on('districts')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('municipality_id')
                ->references('id')
                ->on('municipalities')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('location_id')
                ->references('id')
                ->on('locations')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('request_areas', function (Blueprint $table) {
            $table->dropForeign(['listingRequest_id']);
            $table->dropForeign(['district_id']);
            $table->dropForeign(['municipality_id']);
            $table->dropForeign(['location_id']);
        });
    }
};
