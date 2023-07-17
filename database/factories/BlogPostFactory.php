<?php

namespace Database\Factories;

use App\Models\BlogPost;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BlogPost::class;

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
            'publish_on' => $this->faker->date,
            'priority' => $this->faker->randomNumber(0),
            'published' => $this->faker->boolean,
            'blog_id' => \App\Models\Blog::factory(),
        ];
    }
}
