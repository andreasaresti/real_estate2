<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\DeliveryTime;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeliveryTimeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DeliveryTime::class;

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
            'color' => $this->faker->hexcolor,
            'sequence' => $this->faker->randomNumber(0),
        ];
    }
}
