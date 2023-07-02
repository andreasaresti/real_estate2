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
        Schema::create('locations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table
                ->string('ext_code')
                ->nullable()
                ->unique();
            $table->unsignedBigInteger('municipality_id');
            $table->json('name');
            $table->integer('sequence')->default(0);
            $table->float('latitude')->nullable();
            $table->float('longitude')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locations');
    }
};
