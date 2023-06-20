<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\SalesPeopleAgreement;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesPeopleAgreementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SalesPeopleAgreement::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'salespeople_commission_percentage' => $this->faker->randomNumber(
                2
            ),
            'sales_people_id' => \App\Models\SalesPeople::factory(),
            'district_id' => \App\Models\District::factory(),
            'property_type_id' => \App\Models\PropertyType::factory(),
        ];
    }
}
