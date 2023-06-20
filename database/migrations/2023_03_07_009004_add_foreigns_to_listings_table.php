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
        Schema::table('listings', function (Blueprint $table) {
            $table
                ->foreign('parent_id')
                ->references('id')
                ->on('listings')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('location_id')
                ->references('id')
                ->on('locations')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('status_id')
                ->references('id')
                ->on('statuses')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('delivery_time_id')
                ->references('id')
                ->on('delivery_times')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('internal_status_id')
                ->references('id')
                ->on('internal_statuses')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('owner_id')
                ->references('id')
                ->on('customers')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('agent_id')
                ->references('id')
                ->on('agents')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('listings', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropForeign(['location_id']);
            $table->dropForeign(['status_id']);
            $table->dropForeign(['delivery_time_id']);
            $table->dropForeign(['internal_status_id']);
            $table->dropForeign(['owner_id']);
            $table->dropForeign(['agent_id']);
        });
    }
};
