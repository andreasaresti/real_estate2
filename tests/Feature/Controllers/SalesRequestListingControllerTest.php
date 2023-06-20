<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\SalesRequestListing;

use App\Models\Listing;
use App\Models\SalesRequest;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesRequestListingControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_sales_request_listings(): void
    {
        $salesRequestListings = SalesRequestListing::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('sales-request-listings.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.sales_request_listings.index')
            ->assertViewHas('salesRequestListings');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_sales_request_listing(): void
    {
        $response = $this->get(route('sales-request-listings.create'));

        $response
            ->assertOk()
            ->assertViewIs('app.sales_request_listings.create');
    }

    /**
     * @test
     */
    public function it_stores_the_sales_request_listing(): void
    {
        $data = SalesRequestListing::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('sales-request-listings.store'), $data);

        unset($data['sales_request_id']);
        unset($data['emailed']);

        $this->assertDatabaseHas('sales_request_listings', $data);

        $salesRequestListing = SalesRequestListing::latest('id')->first();

        $response->assertRedirect(
            route('sales-request-listings.edit', $salesRequestListing)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_sales_request_listing(): void
    {
        $salesRequestListing = SalesRequestListing::factory()->create();

        $response = $this->get(
            route('sales-request-listings.show', $salesRequestListing)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.sales_request_listings.show')
            ->assertViewHas('salesRequestListing');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_sales_request_listing(): void
    {
        $salesRequestListing = SalesRequestListing::factory()->create();

        $response = $this->get(
            route('sales-request-listings.edit', $salesRequestListing)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.sales_request_listings.edit')
            ->assertViewHas('salesRequestListing');
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

        $response = $this->put(
            route('sales-request-listings.update', $salesRequestListing),
            $data
        );

        unset($data['sales_request_id']);
        unset($data['emailed']);

        $data['id'] = $salesRequestListing->id;

        $this->assertDatabaseHas('sales_request_listings', $data);

        $response->assertRedirect(
            route('sales-request-listings.edit', $salesRequestListing)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_sales_request_listing(): void
    {
        $salesRequestListing = SalesRequestListing::factory()->create();

        $response = $this->delete(
            route('sales-request-listings.destroy', $salesRequestListing)
        );

        $response->assertRedirect(route('sales-request-listings.index'));

        $this->assertModelMissing($salesRequestListing);
    }
}
