<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Listing;
use App\Models\Location;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LocationListingsTest extends TestCase
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
    public function it_gets_location_listings(): void
    {
        $location = Location::factory()->create();
        $listings = Listing::factory()
            ->count(2)
            ->create([
                'location_id' => $location->id,
            ]);

        $response = $this->getJson(
            route('api.locations.listings.index', $location)
        );

        $response->assertOk()->assertSee($listings[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_location_listings(): void
    {
        $location = Location::factory()->create();
        $data = Listing::factory()
            ->make([
                'location_id' => $location->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.locations.listings.store', $location),
            $data
        );

        unset($data['ext_code']);
        unset($data['agent_id']);
        unset($data['export_all_marketplaces']);
        unset($data['popular']);

        $this->assertDatabaseHas('listings', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $listing = Listing::latest('id')->first();

        $this->assertEquals($location->id, $listing->location_id);
    }
}
