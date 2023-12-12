<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('catalogues_values', function (Blueprint $table) {
            $table
                ->foreign('catalogue_id')
                ->references('id')
                ->on('catalogues')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
            $table
                ->foreign('default_field_id')
                ->references('id')
                ->on('catalogues_default_values')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('catalogues_values', function (Blueprint $table) {
            $table->dropForeign(['catalogue_id']);
            $table->dropForeign(['default_field_id']);
        });
    }
};
