<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Language;
use App\Models\BannerImage;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LanguageBannerImagesTest extends TestCase
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
    public function it_gets_language_banner_images(): void
    {
        $language = Language::factory()->create();
        $bannerImages = BannerImage::factory()
            ->count(2)
            ->create([
                'language_id' => $language->id,
            ]);

        $response = $this->getJson(
            route('api.languages.banner-images.index', $language)
        );

        $response->assertOk()->assertSee($bannerImages[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_language_banner_images(): void
    {
        $language = Language::factory()->create();
        $data = BannerImage::factory()
            ->make([
                'language_id' => $language->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.languages.banner-images.store', $language),
            $data
        );

        unset($data['sort_order']);

        $this->assertDatabaseHas('banner_images', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $bannerImage = BannerImage::latest('id')->first();

        $this->assertEquals($language->id, $bannerImage->language_id);
    }
}
