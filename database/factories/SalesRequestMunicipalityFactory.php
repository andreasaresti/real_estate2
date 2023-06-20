<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\SalesRequestMunicipality;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesRequestMunicipalityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SalesRequestMunicipality::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'municipality_id' => \App\Models\Municipality::factory(),
            'salesRequest_id' => \App\Models\SalesRequest::factory(),
        ];
    }
}
