<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\SalesRequestDistrict;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesRequestDistrictFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SalesRequestDistrict::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'district_id' => \App\Models\District::factory(),
            'salesRequest_id' => \App\Models\SalesRequest::factory(),
        ];
    }
}
