<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Blog;
use App\Models\BlogPost;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogBlogPostsTest extends TestCase
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
    public function it_gets_blog_blog_posts(): void
    {
        $blog = Blog::factory()->create();
        $blogPosts = BlogPost::factory()
            ->count(2)
            ->create([
                'blog_id' => $blog->id,
            ]);

        $response = $this->getJson(route('api.blogs.blog-posts.index', $blog));

        $response->assertOk()->assertSee($blogPosts[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_blog_blog_posts(): void
    {
        $blog = Blog::factory()->create();
        $data = BlogPost::factory()
            ->make([
                'blog_id' => $blog->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.blogs.blog-posts.store', $blog),
            $data
        );

        $this->assertDatabaseHas('blog_posts', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $blogPost = BlogPost::latest('id')->first();

        $this->assertEquals($blog->id, $blogPost->blog_id);
    }
}
