<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Listing;
use App\Models\SalesRequestListing;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingSalesRequestListingsTest extends TestCase
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
    public function it_gets_listing_sales_request_listings(): void
    {
        $listing = Listing::factory()->create();
        $salesRequestListings = SalesRequestListing::factory()
            ->count(2)
            ->create([
                'listing_id' => $listing->id,
            ]);

        $response = $this->getJson(
            route('api.listings.sales-request-listings.index', $listing)
        );

        $response->assertOk()->assertSee($salesRequestListings[0]->status);
    }

    /**
     * @test
     */
    public function it_stores_the_listing_sales_request_listings(): void
    {
        $listing = Listing::factory()->create();
        $data = SalesRequestListing::factory()
            ->make([
                'listing_id' => $listing->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.listings.sales-request-listings.store', $listing),
            $data
        );

        unset($data['sales_request_id']);
        unset($data['emailed']);

        $this->assertDatabaseHas('sales_request_listings', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $salesRequestListing = SalesRequestListing::latest('id')->first();

        $this->assertEquals($listing->id, $salesRequestListing->listing_id);
    }
}
