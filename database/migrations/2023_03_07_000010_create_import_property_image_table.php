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
        Schema::create('import_property_images', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('property_id')->nullable();
            $table->string('url')->nullable();
            $table->string('imported')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('import_property_images');
    }
};
