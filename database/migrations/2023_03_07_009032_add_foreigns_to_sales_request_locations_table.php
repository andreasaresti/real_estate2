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
        Schema::table('sales_request_locations', function (Blueprint $table) {
            $table
                ->foreign('salesRequest_id')
                ->references('id')
                ->on('sales_requests')
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
        Schema::table('sales_request_locations', function (Blueprint $table) {
            $table->dropForeign(['salesRequest_id']);
            $table->dropForeign(['location_id']);
        });
    }
};
