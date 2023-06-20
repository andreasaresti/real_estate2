<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SalesRequest;
use App\Models\SalesRequestListingType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesRequestSalesRequestListingTypesTest extends TestCase
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
    public function it_gets_sales_request_sales_request_listing_types(): void
    {
        $salesRequest = SalesRequest::factory()->create();
        $salesRequestListingTypes = SalesRequestListingType::factory()
            ->count(2)
            ->create([
                'sales_request_id' => $salesRequest->id,
            ]);

        $response = $this->getJson(
            route(
                'api.sales-requests.sales-request-listing-types.index',
                $salesRequest
            )
        );

        $response->assertOk()->assertSee($salesRequestListingTypes[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_sales_request_sales_request_listing_types(): void
    {
        $salesRequest = SalesRequest::factory()->create();
        $data = SalesRequestListingType::factory()
            ->make([
                'sales_request_id' => $salesRequest->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.sales-requests.sales-request-listing-types.store',
                $salesRequest
            ),
            $data
        );

        unset($data['sales_request_id']);
        unset($data['listing_type_id']);

        $this->assertDatabaseHas('sales_request_listing_types', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $salesRequestListingType = SalesRequestListingType::latest(
            'id'
        )->first();

        $this->assertEquals(
            $salesRequest->id,
            $salesRequestListingType->sales_request_id
        );
    }
}
