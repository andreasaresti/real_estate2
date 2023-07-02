<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ChargeRequestCollectMoney;
use Illuminate\Database\Eloquent\Factories\Factory;

class ChargeRequestCollectMoneyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ChargeRequestCollectMoney::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'amount' => $this->faker->randomNumber(1),
            'commission_amount' => $this->faker->randomNumber(1),
            'sales_request_id' => \App\Models\SalesRequest::factory(),
            'sales_people_id' => \App\Models\SalesPeople::factory(),
        ];
    }
}
