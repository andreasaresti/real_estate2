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
        Schema::create('sales_request_notes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sales_request_id');
            $table->unsignedBigInteger('sales_request_note_type_id');
            $table->longText('description');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_request_notes');
    }
};
