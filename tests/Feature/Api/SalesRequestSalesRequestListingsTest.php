<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SalesRequest;
use App\Models\SalesRequestListing;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesRequestSalesRequestListingsTest extends TestCase
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
    public function it_gets_sales_request_sales_request_listings(): void
    {
        $salesRequest = SalesRequest::factory()->create();
        $salesRequestListings = SalesRequestListing::factory()
            ->count(2)
            ->create([
                'sales_request_id' => $salesRequest->id,
            ]);

        $response = $this->getJson(
            route(
                'api.sales-requests.sales-request-listings.index',
                $salesRequest
            )
        );

        $response->assertOk()->assertSee($salesRequestListings[0]->status);
    }

    /**
     * @test
     */
    public function it_stores_the_sales_request_sales_request_listings(): void
    {
        $salesRequest = SalesRequest::factory()->create();
        $data = SalesRequestListing::factory()
            ->make([
                'sales_request_id' => $salesRequest->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.sales-requests.sales-request-listings.store',
                $salesRequest
            ),
            $data
        );

        unset($data['sales_request_id']);
        unset($data['emailed']);

        $this->assertDatabaseHas('sales_request_listings', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $salesRequestListing = SalesRequestListing::latest('id')->first();

        $this->assertEquals(
            $salesRequest->id,
            $salesRequestListing->sales_request_id
        );
    }
}
