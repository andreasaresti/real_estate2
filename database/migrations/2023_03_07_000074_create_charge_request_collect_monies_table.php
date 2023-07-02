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
        Schema::create('charge_request_collect_monies', function (
            Blueprint $table
        ) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sales_request_id');
            $table->unsignedBigInteger('sales_people_id')->nullable();
            $table->decimal('amount')->default(0);
            $table->decimal('commission_amount')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('charge_request_collect_monies');
    }
};
