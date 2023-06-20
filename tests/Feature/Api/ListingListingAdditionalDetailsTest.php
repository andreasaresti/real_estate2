<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Listing;
use App\Models\ListingAdditionalDetail;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingListingAdditionalDetailsTest extends TestCase
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
    public function it_gets_listing_listing_additional_details(): void
    {
        $listing = Listing::factory()->create();
        $listingAdditionalDetails = ListingAdditionalDetail::factory()
            ->count(2)
            ->create([
                'listing_id' => $listing->id,
            ]);

        $response = $this->getJson(
            route('api.listings.listing-additional-details.index', $listing)
        );

        $response->assertOk()->assertSee($listingAdditionalDetails[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_listing_listing_additional_details(): void
    {
        $listing = Listing::factory()->create();
        $data = ListingAdditionalDetail::factory()
            ->make([
                'listing_id' => $listing->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.listings.listing-additional-details.store', $listing),
            $data
        );

        $this->assertDatabaseHas('listing_additional_details', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $listingAdditionalDetail = ListingAdditionalDetail::latest(
            'id'
        )->first();

        $this->assertEquals($listing->id, $listingAdditionalDetail->listing_id);
    }
}
