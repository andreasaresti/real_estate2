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
        Schema::create('sales_request_listings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sales_request_id');
            $table->unsignedBigInteger('listing_id');
            $table->longText('notes')->nullable();
            $table->string('status')->nullable();
            $table->boolean('emailed')->nullable();
            $table->boolean('active')->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_request_listings');
    }
};
