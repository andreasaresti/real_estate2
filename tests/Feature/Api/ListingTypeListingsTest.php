<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Listing;
use App\Models\ListingType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingTypeListingsTest extends TestCase
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
    public function it_gets_listing_type_listings(): void
    {
        $listingType = ListingType::factory()->create();
        $listing = Listing::factory()->create();

        $listingType->listings()->attach($listing);

        $response = $this->getJson(
            route('api.listing-types.listings.index', $listingType)
        );

        $response->assertOk()->assertSee($listing->name);
    }

    /**
     * @test
     */
    public function it_can_attach_listings_to_listing_type(): void
    {
        $listingType = ListingType::factory()->create();
        $listing = Listing::factory()->create();

        $response = $this->postJson(
            route('api.listing-types.listings.store', [$listingType, $listing])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $listingType
                ->listings()
                ->where('listings.id', $listing->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_listings_from_listing_type(): void
    {
        $listingType = ListingType::factory()->create();
        $listing = Listing::factory()->create();

        $response = $this->deleteJson(
            route('api.listing-types.listings.store', [$listingType, $listing])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $listingType
                ->listings()
                ->where('listings.id', $listing->id)
                ->exists()
        );
    }
}
