<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\SalesRequestNoteType;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesRequestNoteTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SalesRequestNoteType::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
        ];
    }
}
