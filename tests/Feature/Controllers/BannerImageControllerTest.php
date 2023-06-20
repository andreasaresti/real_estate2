<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\BannerImage;

use App\Models\Banner;
use App\Models\Language;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BannerImageControllerTest extends TestCase
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
    public function it_displays_index_view_with_banner_images(): void
    {
        $bannerImages = BannerImage::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('banner-images.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.banner_images.index')
            ->assertViewHas('bannerImages');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_banner_image(): void
    {
        $response = $this->get(route('banner-images.create'));

        $response->assertOk()->assertViewIs('app.banner_images.create');
    }

    /**
     * @test
     */
    public function it_stores_the_banner_image(): void
    {
        $data = BannerImage::factory()
            ->make()
            ->toArray();

        $data['name'] = json_encode($data['name']);
        $data['description'] = json_encode($data['description']);
        $data['button_text'] = json_encode($data['button_text']);

        $response = $this->post(route('banner-images.store'), $data);

        unset($data['sort_order']);

        $data['name'] = $this->castToJson($data['name']);
        $data['description'] = $this->castToJson($data['description']);
        $data['button_text'] = $this->castToJson($data['button_text']);

        $this->assertDatabaseHas('banner_images', $data);

        $bannerImage = BannerImage::latest('id')->first();

        $response->assertRedirect(route('banner-images.edit', $bannerImage));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_banner_image(): void
    {
        $bannerImage = BannerImage::factory()->create();

        $response = $this->get(route('banner-images.show', $bannerImage));

        $response
            ->assertOk()
            ->assertViewIs('app.banner_images.show')
            ->assertViewHas('bannerImage');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_banner_image(): void
    {
        $bannerImage = BannerImage::factory()->create();

        $response = $this->get(route('banner-images.edit', $bannerImage));

        $response
            ->assertOk()
            ->assertViewIs('app.banner_images.edit')
            ->assertViewHas('bannerImage');
    }

    /**
     * @test
     */
    public function it_updates_the_banner_image(): void
    {
        $bannerImage = BannerImage::factory()->create();

        $language = Language::factory()->create();
        $banner = Banner::factory()->create();

        $data = [
            'name' => [],
            'description' => [],
            'button_text' => [],
            'link' => $this->faker->text(255),
            'sort_order' => $this->faker->randomNumber(0),
            'active' => $this->faker->boolean,
            'language_id' => $language->id,
            'banner_id' => $banner->id,
        ];

        $data['name'] = json_encode($data['name']);
        $data['description'] = json_encode($data['description']);
        $data['button_text'] = json_encode($data['button_text']);

        $response = $this->put(
            route('banner-images.update', $bannerImage),
            $data
        );

        unset($data['sort_order']);

        $data['id'] = $bannerImage->id;

        $data['name'] = $this->castToJson($data['name']);
        $data['description'] = $this->castToJson($data['description']);
        $data['button_text'] = $this->castToJson($data['button_text']);

        $this->assertDatabaseHas('banner_images', $data);

        $response->assertRedirect(route('banner-images.edit', $bannerImage));
    }

    /**
     * @test
     */
    public function it_deletes_the_banner_image(): void
    {
        $bannerImage = BannerImage::factory()->create();

        $response = $this->delete(route('banner-images.destroy', $bannerImage));

        $response->assertRedirect(route('banner-images.index'));

        $this->assertModelMissing($bannerImage);
    }
}
