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
        Schema::create('listing_additional_details', function (
            Blueprint $table
        ) {
            $table->bigIncrements('id');
            $table->json('title');
            $table->json('value');
            $table->unsignedBigInteger('listing_id');
            $table->integer('sequence')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listing_additional_details');
    }
};
