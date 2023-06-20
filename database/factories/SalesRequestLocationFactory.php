<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\SalesRequestLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesRequestLocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SalesRequestLocation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'location_id' => \App\Models\Location::factory(),
            'salesRequest_id' => \App\Models\SalesRequest::factory(),
        ];
    }
}
