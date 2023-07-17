<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\BlogPost;

use App\Models\Blog;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogPostControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    protected function castToJson($json)
    {
        if (is_array($json)) {
            $json = addslashes(json_encode($json));
        } elseif (is_null($json) || is_null(json_decode($json))) {
            throw new \Exception(
                'A valid JSON string was not provided for casting.'
            );
        }

        return \DB::raw("CAST('{$json}' AS JSON)");
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_blog_posts(): void
    {
        $blogPosts = BlogPost::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('blog-posts.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.blog_posts.index')
            ->assertViewHas('blogPosts');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_blog_post(): void
    {
        $response = $this->get(route('blog-posts.create'));

        $response->assertOk()->assertViewIs('app.blog_posts.create');
    }

    /**
     * @test
     */
    public function it_stores_the_blog_post(): void
    {
        $data = BlogPost::factory()
            ->make()
            ->toArray();

        $data['name'] = json_encode($data['name']);
        $data['description'] = json_encode($data['description']);

        $response = $this->post(route('blog-posts.store'), $data);

        $data['name'] = $this->castToJson($data['name']);
        $data['description'] = $this->castToJson($data['description']);

        $this->assertDatabaseHas('blog_posts', $data);

        $blogPost = BlogPost::latest('id')->first();

        $response->assertRedirect(route('blog-posts.edit', $blogPost));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_blog_post(): void
    {
        $blogPost = BlogPost::factory()->create();

        $response = $this->get(route('blog-posts.show', $blogPost));

        $response
            ->assertOk()
            ->assertViewIs('app.blog_posts.show')
            ->assertViewHas('blogPost');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_blog_post(): void
    {
        $blogPost = BlogPost::factory()->create();

        $response = $this->get(route('blog-posts.edit', $blogPost));

        $response
            ->assertOk()
            ->assertViewIs('app.blog_posts.edit')
            ->assertViewHas('blogPost');
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

        $data['name'] = json_encode($data['name']);
        $data['description'] = json_encode($data['description']);

        $response = $this->put(route('blog-posts.update', $blogPost), $data);

        $data['id'] = $blogPost->id;

        $data['name'] = $this->castToJson($data['name']);
        $data['description'] = $this->castToJson($data['description']);

        $this->assertDatabaseHas('blog_posts', $data);

        $response->assertRedirect(route('blog-posts.edit', $blogPost));
    }

    /**
     * @test
     */
    public function it_deletes_the_blog_post(): void
    {
        $blogPost = BlogPost::factory()->create();

        $response = $this->delete(route('blog-posts.destroy', $blogPost));

        $response->assertRedirect(route('blog-posts.index'));

        $this->assertModelMissing($blogPost);
    }
}
