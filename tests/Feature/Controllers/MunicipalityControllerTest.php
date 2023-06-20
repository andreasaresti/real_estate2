<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Municipality;

use App\Models\District;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MunicipalityControllerTest extends TestCase
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
    public function it_displays_index_view_with_municipalities(): void
    {
        $municipalities = Municipality::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('municipalities.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.municipalities.index')
            ->assertViewHas('municipalities');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_municipality(): void
    {
        $response = $this->get(route('municipalities.create'));

        $response->assertOk()->assertViewIs('app.municipalities.create');
    }

    /**
     * @test
     */
    public function it_stores_the_municipality(): void
    {
        $data = Municipality::factory()
            ->make()
            ->toArray();

        $data['name'] = json_encode($data['name']);

        $response = $this->post(route('municipalities.store'), $data);

        $data['name'] = $this->castToJson($data['name']);

        $this->assertDatabaseHas('municipalities', $data);

        $municipality = Municipality::latest('id')->first();

        $response->assertRedirect(route('municipalities.edit', $municipality));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_municipality(): void
    {
        $municipality = Municipality::factory()->create();

        $response = $this->get(route('municipalities.show', $municipality));

        $response
            ->assertOk()
            ->assertViewIs('app.municipalities.show')
            ->assertViewHas('municipality');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_municipality(): void
    {
        $municipality = Municipality::factory()->create();

        $response = $this->get(route('municipalities.edit', $municipality));

        $response
            ->assertOk()
            ->assertViewIs('app.municipalities.edit')
            ->assertViewHas('municipality');
    }

    /**
     * @test
     */
    public function it_updates_the_municipality(): void
    {
        $municipality = Municipality::factory()->create();

        $district = District::factory()->create();

        $data = [
            'ext_code' => $this->faker->unique->text(255),
            'name' => [],
            'sequence' => $this->faker->randomNumber(0),
            'district_id' => $district->id,
        ];

        $data['name'] = json_encode($data['name']);

        $response = $this->put(
            route('municipalities.update', $municipality),
            $data
        );

        $data['id'] = $municipality->id;

        $data['name'] = $this->castToJson($data['name']);

        $this->assertDatabaseHas('municipalities', $data);

        $response->assertRedirect(route('municipalities.edit', $municipality));
    }

    /**
     * @test
     */
    public function it_deletes_the_municipality(): void
    {
        $municipality = Municipality::factory()->create();

        $response = $this->delete(
            route('municipalities.destroy', $municipality)
        );

        $response->assertRedirect(route('municipalities.index'));

        $this->assertModelMissing($municipality);
    }
}
