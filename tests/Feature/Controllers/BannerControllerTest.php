<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Banner;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BannerControllerTest extends TestCase
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
    public function it_displays_index_view_with_banners(): void
    {
        $banners = Banner::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('banners.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.banners.index')
            ->assertViewHas('banners');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_banner(): void
    {
        $response = $this->get(route('banners.create'));

        $response->assertOk()->assertViewIs('app.banners.create');
    }

    /**
     * @test
     */
    public function it_stores_the_banner(): void
    {
        $data = Banner::factory()
            ->make()
            ->toArray();

        $data['title'] = json_encode($data['title']);
        $data['description'] = json_encode($data['description']);

        $response = $this->post(route('banners.store'), $data);

        $data['title'] = $this->castToJson($data['title']);
        $data['description'] = $this->castToJson($data['description']);

        $this->assertDatabaseHas('banners', $data);

        $banner = Banner::latest('id')->first();

        $response->assertRedirect(route('banners.edit', $banner));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_banner(): void
    {
        $banner = Banner::factory()->create();

        $response = $this->get(route('banners.show', $banner));

        $response
            ->assertOk()
            ->assertViewIs('app.banners.show')
            ->assertViewHas('banner');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_banner(): void
    {
        $banner = Banner::factory()->create();

        $response = $this->get(route('banners.edit', $banner));

        $response
            ->assertOk()
            ->assertViewIs('app.banners.edit')
            ->assertViewHas('banner');
    }

    /**
     * @test
     */
    public function it_updates_the_banner(): void
    {
        $banner = Banner::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'title' => [],
            'description' => [],
            'active' => $this->faker->boolean,
        ];

        $data['title'] = json_encode($data['title']);
        $data['description'] = json_encode($data['description']);

        $response = $this->put(route('banners.update', $banner), $data);

        $data['id'] = $banner->id;

        $data['title'] = $this->castToJson($data['title']);
        $data['description'] = $this->castToJson($data['description']);

        $this->assertDatabaseHas('banners', $data);

        $response->assertRedirect(route('banners.edit', $banner));
    }

    /**
     * @test
     */
    public function it_deletes_the_banner(): void
    {
        $banner = Banner::factory()->create();

        $response = $this->delete(route('banners.destroy', $banner));

        $response->assertRedirect(route('banners.index'));

        $this->assertModelMissing($banner);
    }
}
