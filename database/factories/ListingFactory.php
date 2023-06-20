<?php

namespace Database\Factories;

use App\Models\Listing;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ListingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Listing::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ext_code' => $this->faker->unique->text(255),
            'name' => [],
            'description' => [],
            'price' => $this->faker->randomNumber(2),
            'old_price' => $this->faker->randomNumber(2),
            'price_prefix' => $this->faker->text(255),
            'price_postfix' => $this->faker->text(255),
            'area_size' => $this->faker->randomNumber(0),
            'area_size_prefix' => $this->faker->text(255),
            'area_size_postfix' => $this->faker->text(255),
            'number_of_bedrooms' => $this->faker->randomNumber(0),
            'number_of_bathrooms' => $this->faker->randomNumber(0),
            'number_of_garages_or_parkingpaces' => $this->faker->randomNumber(
                0
            ),
            'year_built' => $this->faker->randomNumber(0),
            'featured' => $this->faker->boolean,
            'published' => $this->faker->boolean,
            'address' => $this->faker->address,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->text(255),
            '360_virtual_tour' => $this->faker->text,
            'energy_class' => $this->faker->text(255),
            'energy_performance' => $this->faker->text(255),
            'epc_current_rating' => $this->faker->text(255),
            'epc_potential_rating' => $this->faker->text(255),
            'taxes' => $this->faker->text(255),
            'dues' => $this->faker->text(255),
            'notes' => $this->faker->text,
            'map' => $this->faker->text,
            'export_all_marketplaces' => $this->faker->boolean,
            'parent_id' => function () {
                return \App\Models\Listing::factory()->create([
                    'parent_id' => null,
                ])->id;
            },
            'location_id' => \App\Models\Location::factory(),
            'status_id' => \App\Models\Status::factory(),
            'delivery_time_id' => \App\Models\DeliveryTime::factory(),
            'internal_status_id' => \App\Models\InternalStatus::factory(),
            'owner_id' => \App\Models\Customer::factory(),
            'agent_id' => \App\Models\Agent::factory(),
        ];
    }
}
