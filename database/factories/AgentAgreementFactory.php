<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\AgentAgreement;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgentAgreementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = AgentAgreement::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'agency_commission_percentage' => $this->faker->randomNumber(2),
            'salespeople_commission_percentage' => $this->faker->randomNumber(
                2
            ),
            'agent_id' => \App\Models\Agent::factory(),
            'property_type_id' => \App\Models\PropertyType::factory(),
        ];
    }
}
