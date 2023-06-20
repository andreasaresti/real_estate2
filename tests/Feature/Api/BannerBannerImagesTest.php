<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Banner;
use App\Models\BannerImage;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BannerBannerImagesTest extends TestCase
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
    public function it_gets_banner_banner_images(): void
    {
        $banner = Banner::factory()->create();
        $bannerImages = BannerImage::factory()
            ->count(2)
            ->create([
                'banner_id' => $banner->id,
            ]);

        $response = $this->getJson(
            route('api.banners.banner-images.index', $banner)
        );

        $response->assertOk()->assertSee($bannerImages[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_banner_banner_images(): void
    {
        $banner = Banner::factory()->create();
        $data = BannerImage::factory()
            ->make([
                'banner_id' => $banner->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.banners.banner-images.store', $banner),
            $data
        );

        unset($data['sort_order']);

        $this->assertDatabaseHas('banner_images', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $bannerImage = BannerImage::latest('id')->first();

        $this->assertEquals($banner->id, $bannerImage->banner_id);
    }
}
