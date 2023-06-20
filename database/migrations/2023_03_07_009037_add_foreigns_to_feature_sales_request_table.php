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
        Schema::table('feature_sales_request', function (Blueprint $table) {
            $table
                ->foreign('feature_id')
                ->references('id')
                ->on('features')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('sales_request_id')
                ->references('id')
                ->on('sales_requests')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('feature_sales_request', function (Blueprint $table) {
            $table->dropForeign(['feature_id']);
            $table->dropForeign(['sales_request_id']);
        });
    }
};
