<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Listing;
use App\Models\Marketplace;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingMarketplacesTest extends TestCase
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
    public function it_gets_listing_marketplaces(): void
    {
        $listing = Listing::factory()->create();
        $marketplace = Marketplace::factory()->create();

        $listing->marketplaces()->attach($marketplace);

        $response = $this->getJson(
            route('api.listings.marketplaces.index', $listing)
        );

        $response->assertOk()->assertSee($marketplace->name);
    }

    /**
     * @test
     */
    public function it_can_attach_marketplaces_to_listing(): void
    {
        $listing = Listing::factory()->create();
        $marketplace = Marketplace::factory()->create();

        $response = $this->postJson(
            route('api.listings.marketplaces.store', [$listing, $marketplace])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $listing
                ->marketplaces()
                ->where('marketplaces.id', $marketplace->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_marketplaces_from_listing(): void
    {
        $listing = Listing::factory()->create();
        $marketplace = Marketplace::factory()->create();

        $response = $this->deleteJson(
            route('api.listings.marketplaces.store', [$listing, $marketplace])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $listing
                ->marketplaces()
                ->where('marketplaces.id', $marketplace->id)
                ->exists()
        );
    }
}
