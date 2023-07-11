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
        Schema::create('listing_type_sales_people', function (
            Blueprint $table
        ) {
            $table->unsignedBigInteger('listing_type_id');
            $table->unsignedBigInteger('sales_people_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listing_type_sales_people');
    }
};
