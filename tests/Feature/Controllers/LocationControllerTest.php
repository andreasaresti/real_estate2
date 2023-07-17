<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Location;

use App\Models\Municipality;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LocationControllerTest extends TestCase
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
    public function it_displays_index_view_with_locations(): void
    {
        $locations = Location::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('locations.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.locations.index')
            ->assertViewHas('locations');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_location(): void
    {
        $response = $this->get(route('locations.create'));

        $response->assertOk()->assertViewIs('app.locations.create');
    }

    /**
     * @test
     */
    public function it_stores_the_location(): void
    {
        $data = Location::factory()
            ->make()
            ->toArray();

        $data['name'] = json_encode($data['name']);

        $response = $this->post(route('locations.store'), $data);

        unset($data['latitude']);
        unset($data['longitude']);

        $data['name'] = $this->castToJson($data['name']);

        $this->assertDatabaseHas('locations', $data);

        $location = Location::latest('id')->first();

        $response->assertRedirect(route('locations.edit', $location));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_location(): void
    {
        $location = Location::factory()->create();

        $response = $this->get(route('locations.show', $location));

        $response
            ->assertOk()
            ->assertViewIs('app.locations.show')
            ->assertViewHas('location');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_location(): void
    {
        $location = Location::factory()->create();

        $response = $this->get(route('locations.edit', $location));

        $response
            ->assertOk()
            ->assertViewIs('app.locations.edit')
            ->assertViewHas('location');
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

        $data['name'] = json_encode($data['name']);

        $response = $this->put(route('locations.update', $location), $data);

        unset($data['latitude']);
        unset($data['longitude']);

        $data['id'] = $location->id;

        $data['name'] = $this->castToJson($data['name']);

        $this->assertDatabaseHas('locations', $data);

        $response->assertRedirect(route('locations.edit', $location));
    }

    /**
     * @test
     */
    public function it_deletes_the_location(): void
    {
        $location = Location::factory()->create();

        $response = $this->delete(route('locations.destroy', $location));

        $response->assertRedirect(route('locations.index'));

        $this->assertModelMissing($location);
    }
}
