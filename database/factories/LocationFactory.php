<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Location::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ext_code' => $this->faker->unique->text(255),
            'name' => [],
            'sequence' => $this->faker->randomNumber(0),
            'latitude' => $this->faker->text(255),
            'longitude' => $this->faker->text(255),
            'municipality_id' => \App\Models\Municipality::factory(),
        ];
    }
}
