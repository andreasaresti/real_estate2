<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SalesRequest;
use App\Models\SalesRequestLocation;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesRequestSalesRequestLocationsTest extends TestCase
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
    public function it_gets_sales_request_sales_request_locations(): void
    {
        $salesRequest = SalesRequest::factory()->create();
        $salesRequestLocations = SalesRequestLocation::factory()
            ->count(2)
            ->create([
                'salesRequest_id' => $salesRequest->id,
            ]);

        $response = $this->getJson(
            route(
                'api.sales-requests.sales-request-locations.index',
                $salesRequest
            )
        );

        $response->assertOk()->assertSee($salesRequestLocations[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_sales_request_sales_request_locations(): void
    {
        $salesRequest = SalesRequest::factory()->create();
        $data = SalesRequestLocation::factory()
            ->make([
                'salesRequest_id' => $salesRequest->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.sales-requests.sales-request-locations.store',
                $salesRequest
            ),
            $data
        );

        unset($data['salesRequest_id']);
        unset($data['location_id']);

        $this->assertDatabaseHas('sales_request_locations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $salesRequestLocation = SalesRequestLocation::latest('id')->first();

        $this->assertEquals(
            $salesRequest->id,
            $salesRequestLocation->salesRequest_id
        );
    }
}
