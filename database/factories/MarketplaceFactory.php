<?php

namespace Database\Factories;

use App\Models\Marketplace;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class MarketplaceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Marketplace::class;

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
        ];
    }
}
