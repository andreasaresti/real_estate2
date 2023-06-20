<?php

namespace Database\Factories;

use App\Models\SalesPeople;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesPeopleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SalesPeople::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'active' => $this->faker->boolean,
            'customer_id' => \App\Models\Customer::factory(),
            'agent_id' => \App\Models\Agent::factory(),
        ];
    }
}
