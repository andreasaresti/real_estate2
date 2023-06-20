<?php

namespace Database\Factories;

use App\Models\Language;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class LanguageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Language::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'encoding' => $this->faker->unique->text(255),
            'name' => $this->faker->name(),
            'sequence' => $this->faker->randomNumber(0),
        ];
    }
}
