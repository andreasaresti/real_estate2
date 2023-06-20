<?php

namespace Database\Factories;

use App\Models\FloorPlan;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class FloorPlanFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FloorPlan::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => [],
            'description' => [],
            'sequence' => $this->faker->randomNumber(0),
            'listing_id' => \App\Models\Listing::factory(),
        ];
    }
}
