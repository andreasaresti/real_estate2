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
        Schema::table('sales_request_districts', function (Blueprint $table) {
            $table
                ->foreign('salesRequest_id')
                ->references('id')
                ->on('sales_requests')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('district_id')
                ->references('id')
                ->on('districts')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales_request_districts', function (Blueprint $table) {
            $table->dropForeign(['salesRequest_id']);
            $table->dropForeign(['district_id']);
        });
    }
};
