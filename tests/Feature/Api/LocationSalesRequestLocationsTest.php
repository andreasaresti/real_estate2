<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Location;
use App\Models\SalesRequestLocation;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LocationSalesRequestLocationsTest extends TestCase
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
    public function it_gets_location_sales_request_locations(): void
    {
        $location = Location::factory()->create();
        $salesRequestLocations = SalesRequestLocation::factory()
            ->count(2)
            ->create([
                'location_id' => $location->id,
            ]);

        $response = $this->getJson(
            route('api.locations.sales-request-locations.index', $location)
        );

        $response->assertOk()->assertSee($salesRequestLocations[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_location_sales_request_locations(): void
    {
        $location = Location::factory()->create();
        $data = SalesRequestLocation::factory()
            ->make([
                'location_id' => $location->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.locations.sales-request-locations.store', $location),
            $data
        );

        unset($data['salesRequest_id']);
        unset($data['location_id']);

        $this->assertDatabaseHas('sales_request_locations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $salesRequestLocation = SalesRequestLocation::latest('id')->first();

        $this->assertEquals($location->id, $salesRequestLocation->location_id);
    }
}
