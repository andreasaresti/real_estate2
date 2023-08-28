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
        Schema::create('import_listings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->longText('content')->nullable();
            $table->string('property_status')->nullable();
            $table->string('price')->nullable();
            $table->string('size')->nullable();
            $table->string('bedrooms')->nullable();
            $table->string('bathrooms')->nullable();
            $table->string('garage')->nullable();
            $table->string('property_id')->nullable();
            $table->string('address')->nullable();
            $table->string('developer')->nullable();
            $table->string('developer_phone')->nullable();
            $table->string('district')->nullable();
            $table->string('municipality')->nullable();
            $table->string('location')->nullable();
            $table->string('coordinate1')->nullable();
            $table->string('coordinate2')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('import_listings');
    }
};
