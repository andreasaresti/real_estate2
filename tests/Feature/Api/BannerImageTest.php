<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\BannerImage;

use App\Models\Banner;
use App\Models\Language;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BannerImageTest extends TestCase
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
    public function it_gets_banner_images_list(): void
    {
        $bannerImages = BannerImage::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.banner-images.index'));

        $response->assertOk()->assertSee($bannerImages[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_banner_image(): void
    {
        $data = BannerImage::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.banner-images.store'), $data);

        unset($data['sort_order']);

        $this->assertDatabaseHas('banner_images', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.banner-images.update', $bannerImage),
            $data
        );

        unset($data['sort_order']);

        $data['id'] = $bannerImage->id;

        $this->assertDatabaseHas('banner_images', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_banner_image(): void
    {
        $bannerImage = BannerImage::factory()->create();

        $response = $this->deleteJson(
            route('api.banner-images.destroy', $bannerImage)
        );

        $this->assertModelMissing($bannerImage);

        $response->assertNoContent();
    }
}
