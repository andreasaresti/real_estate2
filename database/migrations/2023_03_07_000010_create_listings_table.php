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
        Schema::create('listings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table
                ->string('ext_code')
                ->nullable()
                ->unique();
            $table->json('name');
            $table->string('image')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->json('description')->nullable();
            $table->float('price');
            $table->float('old_price')->nullable();
            $table->longText('map')->nullable();
            $table->string('price_prefix')->nullable();
            $table->string('price_postfix')->nullable();
            $table->integer('area_size')->nullable();
            $table->string('area_size_prefix')->nullable();
            $table->string('area_size_postfix')->nullable();
            $table->integer('number_of_bedrooms')->nullable();
            $table->integer('number_of_bathrooms')->nullable();
            $table->integer('number_of_garages_or_parkingpaces')->nullable();
            $table->integer('year_built')->nullable();
            $table->boolean('featured')->nullable();
            $table->boolean('popular')->nullable();
            $table->boolean('published')->nullable();
            $table->string('address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->longText('360_virtual_tour')->nullable();
            $table->string('energy_class')->nullable();
            $table->string('energy_performance')->nullable();
            $table->string('epc_current_rating')->nullable();
            $table->string('epc_potential_rating')->nullable();
            $table->string('owner_type')->nullable();
            $table->string('taxes')->nullable();
            $table->string('dues')->nullable();
            $table->longText('notes')->nullable();
            $table->binary('export_all_marketplaces')->default(1);
            $table->unsignedBigInteger('location_id')->nullable();
            $table->unsignedBigInteger('property_type_id')->nullable();
            $table->unsignedBigInteger('status_id')->nullable();
            $table->unsignedBigInteger('delivery_time_id')->nullable();
            $table->unsignedBigInteger('internal_status_id')->nullable();
            $table->unsignedBigInteger('owner_id')->nullable();
            $table->unsignedBigInteger('developer_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
