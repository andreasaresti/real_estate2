<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\InternalStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class InternalStatusFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = InternalStatus::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ext_code' => $this->faker->unique->text(255),
            'name' => $this->faker->name(),
            'color' => $this->faker->hexcolor,
            'sequence' => $this->faker->randomNumber(0),
        ];
    }
}
