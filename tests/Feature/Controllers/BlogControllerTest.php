<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Blog;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BlogControllerTest extends TestCase
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
    public function it_displays_index_view_with_blogs(): void
    {
        $blogs = Blog::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('blogs.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.blogs.index')
            ->assertViewHas('blogs');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_blog(): void
    {
        $response = $this->get(route('blogs.create'));

        $response->assertOk()->assertViewIs('app.blogs.create');
    }

    /**
     * @test
     */
    public function it_stores_the_blog(): void
    {
        $data = Blog::factory()
            ->make()
            ->toArray();

        $data['name'] = json_encode($data['name']);

        $response = $this->post(route('blogs.store'), $data);

        $data['name'] = $this->castToJson($data['name']);

        $this->assertDatabaseHas('blogs', $data);

        $blog = Blog::latest('id')->first();

        $response->assertRedirect(route('blogs.edit', $blog));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_blog(): void
    {
        $blog = Blog::factory()->create();

        $response = $this->get(route('blogs.show', $blog));

        $response
            ->assertOk()
            ->assertViewIs('app.blogs.show')
            ->assertViewHas('blog');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_blog(): void
    {
        $blog = Blog::factory()->create();

        $response = $this->get(route('blogs.edit', $blog));

        $response
            ->assertOk()
            ->assertViewIs('app.blogs.edit')
            ->assertViewHas('blog');
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

        $data['name'] = json_encode($data['name']);

        $response = $this->put(route('blogs.update', $blog), $data);

        $data['id'] = $blog->id;

        $data['name'] = $this->castToJson($data['name']);

        $this->assertDatabaseHas('blogs', $data);

        $response->assertRedirect(route('blogs.edit', $blog));
    }

    /**
     * @test
     */
    public function it_deletes_the_blog(): void
    {
        $blog = Blog::factory()->create();

        $response = $this->delete(route('blogs.destroy', $blog));

        $response->assertRedirect(route('blogs.index'));

        $this->assertModelMissing($blog);
    }
}
