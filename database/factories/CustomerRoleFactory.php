<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\CustomerRole;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerRoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomerRole::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'sequence' => $this->faker->randomNumber(0),
        ];
    }
}
