<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\FloorPlan;

use App\Models\Listing;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FloorPlanTest extends TestCase
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
    public function it_gets_floor_plans_list(): void
    {
        $floorPlans = FloorPlan::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.floor-plans.index'));

        $response->assertOk()->assertSee($floorPlans[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_floor_plan(): void
    {
        $data = FloorPlan::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.floor-plans.store'), $data);

        $this->assertDatabaseHas('floor_plans', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_floor_plan(): void
    {
        $floorPlan = FloorPlan::factory()->create();

        $listing = Listing::factory()->create();

        $data = [
            'name' => [],
            'description' => [],
            'sequence' => $this->faker->randomNumber(0),
            'listing_id' => $listing->id,
        ];

        $response = $this->putJson(
            route('api.floor-plans.update', $floorPlan),
            $data
        );

        $data['id'] = $floorPlan->id;

        $this->assertDatabaseHas('floor_plans', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_floor_plan(): void
    {
        $floorPlan = FloorPlan::factory()->create();

        $response = $this->deleteJson(
            route('api.floor-plans.destroy', $floorPlan)
        );

        $this->assertModelMissing($floorPlan);

        $response->assertNoContent();
    }
}
