<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Listing;
use App\Models\ListingType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingListingTypesTest extends TestCase
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
    public function it_gets_listing_listing_types(): void
    {
        $listing = Listing::factory()->create();
        $listingType = ListingType::factory()->create();

        $listing->listingTypes()->attach($listingType);

        $response = $this->getJson(
            route('api.listings.listing-types.index', $listing)
        );

        $response->assertOk()->assertSee($listingType->name);
    }

    /**
     * @test
     */
    public function it_can_attach_listing_types_to_listing(): void
    {
        $listing = Listing::factory()->create();
        $listingType = ListingType::factory()->create();

        $response = $this->postJson(
            route('api.listings.listing-types.store', [$listing, $listingType])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $listing
                ->listingTypes()
                ->where('listing_types.id', $listingType->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_listing_types_from_listing(): void
    {
        $listing = Listing::factory()->create();
        $listingType = ListingType::factory()->create();

        $response = $this->deleteJson(
            route('api.listings.listing-types.store', [$listing, $listingType])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $listing
                ->listingTypes()
                ->where('listing_types.id', $listingType->id)
                ->exists()
        );
    }
}
