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
        Schema::table('sales_requests', function (Blueprint $table) {
            $table
                ->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('source_id')
                ->references('id')
                ->on('sources')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('property_type_id')
                ->references('id')
                ->on('property_types')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('sales_people_id')
                ->references('id')
                ->on('sales_people')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('listing_id')
                ->references('id')
                ->on('listings')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('sales_lost_reason_id')
                ->references('id')
                ->on('sales_lost_reasons')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('intermediate_agent_id')
                ->references('id')
                ->on('intermediate_agents')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales_requests', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropForeign(['source_id']);
            $table->dropForeign(['property_type_id']);
            $table->dropForeign(['sales_people_id']);
            $table->dropForeign(['listing_id']);
            $table->dropForeign(['sales_lost_reason_id']);
            $table->dropForeign(['intermediate_agent_id']);
        });
    }
};
