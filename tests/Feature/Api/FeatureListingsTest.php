<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Feature;
use App\Models\Listing;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FeatureListingsTest extends TestCase
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
    public function it_gets_feature_listings(): void
    {
        $feature = Feature::factory()->create();
        $listing = Listing::factory()->create();

        $feature->listings()->attach($listing);

        $response = $this->getJson(
            route('api.features.listings.index', $feature)
        );

        $response->assertOk()->assertSee($listing->name);
    }

    /**
     * @test
     */
    public function it_can_attach_listings_to_feature(): void
    {
        $feature = Feature::factory()->create();
        $listing = Listing::factory()->create();

        $response = $this->postJson(
            route('api.features.listings.store', [$feature, $listing])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $feature
                ->listings()
                ->where('listings.id', $listing->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_listings_from_feature(): void
    {
        $feature = Feature::factory()->create();
        $listing = Listing::factory()->create();

        $response = $this->deleteJson(
            route('api.features.listings.store', [$feature, $listing])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $feature
                ->listings()
                ->where('listings.id', $listing->id)
                ->exists()
        );
    }
}
