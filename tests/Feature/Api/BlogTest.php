<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Blog;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogTest extends TestCase
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
    public function it_gets_blogs_list(): void
    {
        $blogs = Blog::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.blogs.index'));

        $response->assertOk()->assertSee($blogs[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_blog(): void
    {
        $data = Blog::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.blogs.store'), $data);

        $this->assertDatabaseHas('blogs', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_blog(): void
    {
        $blog = Blog::factory()->create();

        $data = [
            'name' => [],
            'active' => $this->faker->boolean,
        ];

        $response = $this->putJson(route('api.blogs.update', $blog), $data);

        $data['id'] = $blog->id;

        $this->assertDatabaseHas('blogs', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_blog(): void
    {
        $blog = Blog::factory()->create();

        $response = $this->deleteJson(route('api.blogs.destroy', $blog));

        $this->assertModelMissing($blog);

        $response->assertNoContent();
    }
}
