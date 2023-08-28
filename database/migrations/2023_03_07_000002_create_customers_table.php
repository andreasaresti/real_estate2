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
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table
                ->string('ext_code')
                ->nullable()
                ->unique();
            $table->string('type');
            $table->string('name');
            $table->string('surname')->nullable();
            $table->string('company_name')->nullable();
            $table->string('image')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('mobile')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('city')->nullable();
            $table->string('district')->nullable();
            $table->string('country')->nullable();
            $table->longText('notes')->nullable();
            $table->unsignedBigInteger('customer_role_id')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
