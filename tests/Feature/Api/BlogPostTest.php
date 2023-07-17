<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\BlogPost;

use App\Models\Blog;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogPostTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_blog_posts_list(): void
    {
        $blogPosts = BlogPost::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.blog-posts.index'));

        $response->assertOk()->assertSee($blogPosts[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_blog_post(): void
    {
        $data = BlogPost::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.blog-posts.store'), $data);

        $this->assertDatabaseHas('blog_posts', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_blog_post(): void
    {
        $blogPost = BlogPost::factory()->create();

        $blog = Blog::factory()->create();

        $data = [
            'name' => [],
            'description' => [],
            'publish_on' => $this->faker->date,
            'priority' => $this->faker->randomNumber(0),
            'published' => $this->faker->boolean,
            'blog_id' => $blog->id,
        ];

        $response = $this->putJson(
            route('api.blog-posts.update', $blogPost),
            $data
        );

        $data['id'] = $blogPost->id;

        $this->assertDatabaseHas('blog_posts', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_blog_post(): void
    {
        $blogPost = BlogPost::factory()->create();

        $response = $this->deleteJson(
            route('api.blog-posts.destroy', $blogPost)
        );

        $this->assertModelMissing($blogPost);

        $response->assertNoContent();
    }
}
