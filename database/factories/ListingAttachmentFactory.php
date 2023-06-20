<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Models\ListingAttachment;
use Illuminate\Database\Eloquent\Factories\Factory;

class ListingAttachmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ListingAttachment::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'attachment' => $this->faker->text(255),
            'listing_id' => \App\Models\Listing::factory(),
        ];
    }
}
