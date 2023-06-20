<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\FavoriteProperty;
use Illuminate\Database\Eloquent\Factories\Factory;

class FavoritePropertyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = FavoriteProperty::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => \App\Models\Customer::factory(),
            'listing_id' => \App\Models\Listing::factory(),
        ];
    }
}
