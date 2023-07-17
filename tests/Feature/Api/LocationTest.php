<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Location;

use App\Models\Municipality;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LocationTest extends TestCase
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
    public function it_gets_locations_list(): void
    {
        $locations = Location::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.locations.index'));

        $response->assertOk()->assertSee($locations[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_location(): void
    {
        $data = Location::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.locations.store'), $data);

        unset($data['latitude']);
        unset($data['longitude']);

        $this->assertDatabaseHas('locations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_location(): void
    {
        $location = Location::factory()->create();

        $municipality = Municipality::factory()->create();

        $data = [
            'ext_code' => $this->faker->unique->text(255),
            'name' => [],
            'sequence' => $this->faker->randomNumber(0),
            'latitude' => $this->faker->text(255),
            'longitude' => $this->faker->text(255),
            'municipality_id' => $municipality->id,
        ];

        $response = $this->putJson(
            route('api.locations.update', $location),
            $data
        );

        unset($data['latitude']);
        unset($data['longitude']);

        $data['id'] = $location->id;

        $this->assertDatabaseHas('locations', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_location(): void
    {
        $location = Location::factory()->create();

        $response = $this->deleteJson(
            route('api.locations.destroy', $location)
        );

        $this->assertModelMissing($location);

        $response->assertNoContent();
    }
}
