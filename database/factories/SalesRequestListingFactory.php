<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\SalesRequestListing;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesRequestListingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SalesRequestListing::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'notes' => $this->faker->text,
            'status' => $this->faker->word,
            'emailed' => $this->faker->boolean,
            'active' => $this->faker->boolean,
            'listing_id' => \App\Models\Listing::factory(),
            'sales_request_id' => \App\Models\SalesRequest::factory(),
        ];
    }
}
