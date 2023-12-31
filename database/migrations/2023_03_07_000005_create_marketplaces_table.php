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
        Schema::create('marketplaces', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            
            $table->string('export')->nullable();
            $table->boolean('reissue_key')->default(0);
            $table->string('feedkey')->nullable();
            $table->string('feed_type')->nullable();
            $table->unsignedBigInteger('feed_id')->nullable();

            $table->boolean('active')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marketplaces');
    }
};
