<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\SalesRequestListingType;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesRequestListingTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SalesRequestListingType::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sales_request_id' => \App\Models\SalesRequest::factory(),
            'listing_type_id' => \App\Models\ListingType::factory(),
        ];
    }
}
