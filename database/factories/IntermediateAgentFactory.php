<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\IntermediateAgent;
use Illuminate\Database\Eloquent\Factories\Factory;

class IntermediateAgentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = IntermediateAgent::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'country' => $this->faker->country,
            'telephone' => $this->faker->text(255),
            'email' => $this->faker->email,
            'website' => $this->faker->text(255),
        ];
    }
}
