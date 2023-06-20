<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\SalesRequestAppointment;
use Illuminate\Database\Eloquent\Factories\Factory;

class SalesRequestAppointmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SalesRequestAppointment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'date' => $this->faker->dateTime,
            'status' => $this->faker->word,
            'signed' => $this->faker->boolean,
            'date_signed' => $this->faker->dateTime,
            'signature' => $this->faker->text(255),
            'listing_id' => \App\Models\Listing::factory(),
            'sales_request_id' => \App\Models\SalesRequest::factory(),
        ];
    }
}
