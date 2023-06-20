<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Listing;
use App\Models\Feature;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingFeaturesTest extends TestCase
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
    public function it_gets_listing_features(): void
    {
        $listing = Listing::factory()->create();
        $feature = Feature::factory()->create();

        $listing->features()->attach($feature);

        $response = $this->getJson(
            route('api.listings.features.index', $listing)
        );

        $response->assertOk()->assertSee($feature->name);
    }

    /**
     * @test
     */
    public function it_can_attach_features_to_listing(): void
    {
        $listing = Listing::factory()->create();
        $feature = Feature::factory()->create();

        $response = $this->postJson(
            route('api.listings.features.store', [$listing, $feature])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $listing
                ->features()
                ->where('features.id', $feature->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_features_from_listing(): void
    {
        $listing = Listing::factory()->create();
        $feature = Feature::factory()->create();

        $response = $this->deleteJson(
            route('api.listings.features.store', [$listing, $feature])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $listing
                ->features()
                ->where('features.id', $feature->id)
                ->exists()
        );
    }
}
