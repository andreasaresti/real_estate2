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
        Schema::create('included_listing_feeds', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('feed_id');
            $table->unsignedBigInteger('listing_id');
            $table->boolean('schedule')->default(0);
            $table->date('start_date')->nullable();
            $table->integer('number_of_days')->nullable();
            $table->boolean('active')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('included_listing_feeds');
    }
};
