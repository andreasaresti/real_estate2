<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\SalesRequest;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesRequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SalesRequest::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(255),
            'date' => $this->faker->date,
            'minimum_budget' => $this->faker->randomNumber(0),
            'maximum_budget' => $this->faker->randomNumber(0),
            'minimum_size' => $this->faker->randomNumber(0),
            'maximum_size' => $this->faker->randomNumber(0),
            'minimum_bedrooms' => $this->faker->randomNumber(0),
            'minimum_bathrooms' => $this->faker->randomNumber(0),
            'description' => $this->faker->text,
            'assigned' => $this->faker->boolean,
            'assigned_date' => $this->faker->date,
            'accepted_status' => $this->faker->text(255),
            'status' => $this->faker->word,
            'active' => $this->faker->boolean,
            'agreement_price' => $this->faker->randomNumber(2),
            'commission_amount' => $this->faker->randomNumber(1),
            'agency_percentage' => $this->faker->randomNumber(2),
            'agency_amount' => $this->faker->randomNumber(1),
            'salesperson_amount' => $this->faker->randomNumber(1),
            'salespeople_percentage' => $this->faker->randomNumber(2),
            'final_status' => $this->faker->text(255),
            'has_intermediate_agent' => $this->faker->boolean,
            'intermediate_percentage' => $this->faker->randomNumber(2),
            'intermediate_amount' => $this->faker->randomNumber(1),
            'customer_id' => \App\Models\Customer::factory(),
            'source_id' => \App\Models\Source::factory(),
            'sales_people_id' => \App\Models\SalesPeople::factory(),
            'property_type_id' => \App\Models\PropertyType::factory(),
            'listing_id' => \App\Models\Listing::factory(),
            'sales_lost_reason_id' => \App\Models\SalesLostReason::factory(),
            'intermediate_agent_id' => \App\Models\IntermediateAgent::factory(),
        ];
    }
}
