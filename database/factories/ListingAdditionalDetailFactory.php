<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ListingAdditionalDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class ListingAdditionalDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ListingAdditionalDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => [],
            'value' => [],
            'sequence' => $this->faker->randomNumber(0),
            'listing_id' => \App\Models\Listing::factory(),
        ];
    }
}
