<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\CustomerAgreement;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerAgreementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomerAgreement::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'agency_commission_percentage' => $this->faker->randomNumber(2),
            'customer_id' => \App\Models\Customer::factory(),
            'district_id' => \App\Models\District::factory(),
            'property_type_id' => \App\Models\PropertyType::factory(),
        ];
    }
}
