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
        Schema::table('agent_agreements', function (Blueprint $table) {
            $table
                ->foreign('property_type_id')
                ->references('id')
                ->on('property_types')
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
        Schema::table('agent_agreements', function (Blueprint $table) {
            $table->dropForeign(['property_type_id']);
            $table->dropForeign(['agent_id']);
        });
    }
};
