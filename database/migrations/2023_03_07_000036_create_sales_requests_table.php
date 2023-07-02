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
        Schema::create('sales_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->date('date');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('source_id');
            $table->unsignedBigInteger('property_type_id');
            $table->integer('minimum_budget')->nullable();
            $table->integer('maximum_budget')->nullable();
            $table->integer('minimum_size')->nullable();
            $table->integer('maximum_size')->nullable();
            $table->integer('minimum_bedrooms')->nullable();
            $table->integer('minimum_bathrooms')->nullable();
            $table->longText('description')->nullable();
            $table->boolean('assigned')->default(0);
            $table->unsignedBigInteger('sales_people_id')->nullable();
            $table->date('assigned_date')->nullable();
            $table->string('accepted_status')->default('open');
            $table->string('status')->default('open');
            $table->boolean('active')->default(1);
            $table->unsignedBigInteger('listing_id')->nullable();
            $table->float('agreement_price')->nullable();
            $table->decimal('commission_amount')->default(0);
            $table->float('agency_percentage')->nullable();
            $table->decimal('agency_amount')->default(0);
            $table->decimal('salesperson_amount')->default(0);
            $table->float('salespeople_percentage')->nullable();
            $table->unsignedBigInteger('sales_lost_reason_id')->nullable();
            $table->string('final_status')->nullable();
            $table->boolean('has_intermediate_agent')->default(0);
            $table->unsignedBigInteger('intermediate_agent_id')->nullable();
            $table
                ->float('intermediate_percentage')
                ->default(0)
                ->nullable();
            $table->decimal('intermediate_amount')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_requests');
    }
};
