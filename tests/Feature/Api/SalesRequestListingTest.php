<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SalesRequestListing;

use App\Models\Listing;
use App\Models\SalesRequest;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesRequestListingTest extends TestCase
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
    public function it_gets_sales_request_listings_list(): void
    {
        $salesRequestListings = SalesRequestListing::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.sales-request-listings.index'));

        $response->assertOk()->assertSee($salesRequestListings[0]->status);
    }

    /**
     * @test
     */
    public function it_stores_the_sales_request_listing(): void
    {
        $data = SalesRequestListing::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.sales-request-listings.store'),
            $data
        );

        unset($data['sales_request_id']);
        unset($data['emailed']);

        $this->assertDatabaseHas('sales_request_listings', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_sales_request_listing(): void
    {
        $salesRequestListing = SalesRequestListing::factory()->create();

        $listing = Listing::factory()->create();
        $salesRequest = SalesRequest::factory()->create();

        $data = [
            'notes' => $this->faker->text,
            'status' => $this->faker->word,
            'emailed' => $this->faker->boolean,
            'active' => $this->faker->boolean,
            'listing_id' => $listing->id,
            'sales_request_id' => $salesRequest->id,
        ];

        $response = $this->putJson(
            route('api.sales-request-listings.update', $salesRequestListing),
            $data
        );

        unset($data['sales_request_id']);
        unset($data['emailed']);

        $data['id'] = $salesRequestListing->id;

        $this->assertDatabaseHas('sales_request_listings', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_sales_request_listing(): void
    {
        $salesRequestListing = SalesRequestListing::factory()->create();

        $response = $this->deleteJson(
            route('api.sales-request-listings.destroy', $salesRequestListing)
        );

        $this->assertModelMissing($salesRequestListing);

        $response->assertNoContent();
    }
}
