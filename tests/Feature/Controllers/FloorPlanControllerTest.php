<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\FloorPlan;

use App\Models\Listing;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FloorPlanControllerTest extends TestCase
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

    protected function castToJson($json)
    {
        if (is_array($json)) {
            $json = addslashes(json_encode($json));
        } elseif (is_null($json) || is_null(json_decode($json))) {
            throw new \Exception(
                'A valid JSON string was not provided for casting.'
            );
        }

        return \DB::raw("CAST('{$json}' AS JSON)");
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_floor_plans(): void
    {
        $floorPlans = FloorPlan::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('floor-plans.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.floor_plans.index')
            ->assertViewHas('floorPlans');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_floor_plan(): void
    {
        $response = $this->get(route('floor-plans.create'));

        $response->assertOk()->assertViewIs('app.floor_plans.create');
    }

    /**
     * @test
     */
    public function it_stores_the_floor_plan(): void
    {
        $data = FloorPlan::factory()
            ->make()
            ->toArray();

        $data['name'] = json_encode($data['name']);
        $data['description'] = json_encode($data['description']);

        $response = $this->post(route('floor-plans.store'), $data);

        $data['name'] = $this->castToJson($data['name']);
        $data['description'] = $this->castToJson($data['description']);

        $this->assertDatabaseHas('floor_plans', $data);

        $floorPlan = FloorPlan::latest('id')->first();

        $response->assertRedirect(route('floor-plans.edit', $floorPlan));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_floor_plan(): void
    {
        $floorPlan = FloorPlan::factory()->create();

        $response = $this->get(route('floor-plans.show', $floorPlan));

        $response
            ->assertOk()
            ->assertViewIs('app.floor_plans.show')
            ->assertViewHas('floorPlan');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_floor_plan(): void
    {
        $floorPlan = FloorPlan::factory()->create();

        $response = $this->get(route('floor-plans.edit', $floorPlan));

        $response
            ->assertOk()
            ->assertViewIs('app.floor_plans.edit')
            ->assertViewHas('floorPlan');
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

        $data['name'] = json_encode($data['name']);
        $data['description'] = json_encode($data['description']);

        $response = $this->put(route('floor-plans.update', $floorPlan), $data);

        $data['id'] = $floorPlan->id;

        $data['name'] = $this->castToJson($data['name']);
        $data['description'] = $this->castToJson($data['description']);

        $this->assertDatabaseHas('floor_plans', $data);

        $response->assertRedirect(route('floor-plans.edit', $floorPlan));
    }

    /**
     * @test
     */
    public function it_deletes_the_floor_plan(): void
    {
        $floorPlan = FloorPlan::factory()->create();

        $response = $this->delete(route('floor-plans.destroy', $floorPlan));

        $response->assertRedirect(route('floor-plans.index'));

        $this->assertModelMissing($floorPlan);
    }
}
