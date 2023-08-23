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
        Schema::table('customers', function (Blueprint $table) {
            $table
                ->foreign('customer_role_id')
                ->references('id')
                ->on('customer_roles')
                ->onUpdate('CASCADE')
                ->onDelete('RESTRICT');
        });
        Schema::table('customers', function (Blueprint $table) {
            $table
                ->foreign('developer_id')
                ->references('id')
                ->on('developers')
                ->onUpdate('CASCADE')
                ->onDelete('RESTRICT');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropForeign(['customer_role_id']);
            $table->dropForeign(['developer_id']);
        });
    }
};
