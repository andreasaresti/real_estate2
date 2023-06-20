<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Location;
use App\Models\Municipality;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MunicipalityLocationsTest extends TestCase
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
    public function it_gets_municipality_locations(): void
    {
        $municipality = Municipality::factory()->create();
        $locations = Location::factory()
            ->count(2)
            ->create([
                'municipality_id' => $municipality->id,
            ]);

        $response = $this->getJson(
            route('api.municipalities.locations.index', $municipality)
        );

        $response->assertOk()->assertSee($locations[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_municipality_locations(): void
    {
        $municipality = Municipality::factory()->create();
        $data = Location::factory()
            ->make([
                'municipality_id' => $municipality->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.municipalities.locations.store', $municipality),
            $data
        );

        unset($data['laditude']);
        unset($data['longitude']);

        $this->assertDatabaseHas('locations', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $location = Location::latest('id')->first();

        $this->assertEquals($municipality->id, $location->municipality_id);
    }
}
