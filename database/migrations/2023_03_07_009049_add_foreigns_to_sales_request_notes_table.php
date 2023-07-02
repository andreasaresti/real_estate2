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
        Schema::table('sales_request_notes', function (Blueprint $table) {
            $table
                ->foreign('sales_request_id')
                ->references('id')
                ->on('sales_requests')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('sales_request_note_type_id')
                ->references('id')
                ->on('sales_request_note_types')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales_request_notes', function (Blueprint $table) {
            $table->dropForeign(['sales_request_id']);
            $table->dropForeign(['sales_request_note_type_id']);
        });
    }
};
