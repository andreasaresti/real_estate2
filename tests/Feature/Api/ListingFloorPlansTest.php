<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Listing;
use App\Models\FloorPlan;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingFloorPlansTest extends TestCase
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
    public function it_gets_listing_floor_plans(): void
    {
        $listing = Listing::factory()->create();
        $floorPlans = FloorPlan::factory()
            ->count(2)
            ->create([
                'listing_id' => $listing->id,
            ]);

        $response = $this->getJson(
            route('api.listings.floor-plans.index', $listing)
        );

        $response->assertOk()->assertSee($floorPlans[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_listing_floor_plans(): void
    {
        $listing = Listing::factory()->create();
        $data = FloorPlan::factory()
            ->make([
                'listing_id' => $listing->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.listings.floor-plans.store', $listing),
            $data
        );

        $this->assertDatabaseHas('floor_plans', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $floorPlan = FloorPlan::latest('id')->first();

        $this->assertEquals($listing->id, $floorPlan->listing_id);
    }
}
