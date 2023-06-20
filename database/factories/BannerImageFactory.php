<?php

namespace Database\Factories;

use App\Models\BannerImage;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BannerImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BannerImage::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => [],
            'description' => [],
            'button_text' => [],
            'link' => $this->faker->text(255),
            'sort_order' => $this->faker->randomNumber(0),
            'active' => $this->faker->boolean,
            'language_id' => \App\Models\Language::factory(),
            'banner_id' => \App\Models\Banner::factory(),
        ];
    }
}
