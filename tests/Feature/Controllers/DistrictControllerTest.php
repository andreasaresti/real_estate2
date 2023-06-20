<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\District;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DistrictControllerTest extends TestCase
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
    public function it_displays_index_view_with_districts(): void
    {
        $districts = District::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('districts.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.districts.index')
            ->assertViewHas('districts');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_district(): void
    {
        $response = $this->get(route('districts.create'));

        $response->assertOk()->assertViewIs('app.districts.create');
    }

    /**
     * @test
     */
    public function it_stores_the_district(): void
    {
        $data = District::factory()
            ->make()
            ->toArray();

        $data['name'] = json_encode($data['name']);

        $response = $this->post(route('districts.store'), $data);

        $data['name'] = $this->castToJson($data['name']);

        $this->assertDatabaseHas('districts', $data);

        $district = District::latest('id')->first();

        $response->assertRedirect(route('districts.edit', $district));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_district(): void
    {
        $district = District::factory()->create();

        $response = $this->get(route('districts.show', $district));

        $response
            ->assertOk()
            ->assertViewIs('app.districts.show')
            ->assertViewHas('district');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_district(): void
    {
        $district = District::factory()->create();

        $response = $this->get(route('districts.edit', $district));

        $response
            ->assertOk()
            ->assertViewIs('app.districts.edit')
            ->assertViewHas('district');
    }

    /**
     * @test
     */
    public function it_updates_the_district(): void
    {
        $district = District::factory()->create();

        $data = [
            'ext_code' => $this->faker->unique->text(255),
            'country' => $this->faker->country,
            'name' => [],
        ];

        $data['name'] = json_encode($data['name']);

        $response = $this->put(route('districts.update', $district), $data);

        $data['id'] = $district->id;

        $data['name'] = $this->castToJson($data['name']);

        $this->assertDatabaseHas('districts', $data);

        $response->assertRedirect(route('districts.edit', $district));
    }

    /**
     * @test
     */
    public function it_deletes_the_district(): void
    {
        $district = District::factory()->create();

        $response = $this->delete(route('districts.destroy', $district));

        $response->assertRedirect(route('districts.index'));

        $this->assertModelMissing($district);
    }
}
