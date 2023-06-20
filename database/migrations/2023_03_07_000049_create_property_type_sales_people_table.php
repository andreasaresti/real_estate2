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
        Schema::create('property_type_sales_people', function (
            Blueprint $table
        ) {
            $table->unsignedBigInteger('property_type_id');
            $table->unsignedBigInteger('sales_people_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('property_type_sales_people');
    }
};
