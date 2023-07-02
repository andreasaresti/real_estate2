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
        Schema::table('charge_request_collect_monies', function (
            Blueprint $table
        ) {
            $table
                ->foreign('sales_request_id')
                ->references('id')
                ->on('sales_requests')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('sales_people_id')
                ->references('id')
                ->on('sales_people')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('charge_request_collect_monies', function (
            Blueprint $table
        ) {
            $table->dropForeign(['sales_request_id']);
            $table->dropForeign(['sales_people_id']);
        });
    }
};
