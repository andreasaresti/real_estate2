<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\SalesLostReason;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesLostReasonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SalesLostReason::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->text(255),
        ];
    }
}
