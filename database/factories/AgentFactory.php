<?php

namespace Database\Factories;

use App\Models\Agent;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Agent::class;

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
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'postal_code' => $this->faker->text(255),
            'city' => $this->faker->city,
            'country' => $this->faker->country,
            'comments' => $this->faker->text,
            'active' => $this->faker->boolean,
            'longitude' => $this->faker->longitude,
            'laditude' => $this->faker->randomNumber(2),
            'district_id' => \App\Models\District::factory(),
        ];
    }
}
