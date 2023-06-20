<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Listing;
use App\Models\Marketplace;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MarketplaceListingsTest extends TestCase
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
    public function it_gets_marketplace_listings(): void
    {
        $marketplace = Marketplace::factory()->create();
        $listing = Listing::factory()->create();

        $marketplace->listings()->attach($listing);

        $response = $this->getJson(
            route('api.marketplaces.listings.index', $marketplace)
        );

        $response->assertOk()->assertSee($listing->name);
    }

    /**
     * @test
     */
    public function it_can_attach_listings_to_marketplace(): void
    {
        $marketplace = Marketplace::factory()->create();
        $listing = Listing::factory()->create();

        $response = $this->postJson(
            route('api.marketplaces.listings.store', [$marketplace, $listing])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $marketplace
                ->listings()
                ->where('listings.id', $listing->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_listings_from_marketplace(): void
    {
        $marketplace = Marketplace::factory()->create();
        $listing = Listing::factory()->create();

        $response = $this->deleteJson(
            route('api.marketplaces.listings.store', [$marketplace, $listing])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $marketplace
                ->listings()
                ->where('listings.id', $listing->id)
                ->exists()
        );
    }
}
