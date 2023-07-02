<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\SalesRequestNote;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesRequestNoteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SalesRequestNote::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->text,
            'sales_request_id' => \App\Models\SalesRequest::factory(),
            'sales_request_note_type_id' => \App\Models\SalesRequestNoteType::factory(),
        ];
    }
}
