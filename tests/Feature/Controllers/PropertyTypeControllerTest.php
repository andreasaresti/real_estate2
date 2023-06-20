<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\PropertyType;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PropertyTypeControllerTest extends TestCase
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
    public function it_displays_index_view_with_property_types(): void
    {
        $propertyTypes = PropertyType::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('property-types.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.property_types.index')
            ->assertViewHas('propertyTypes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_property_type(): void
    {
        $response = $this->get(route('property-types.create'));

        $response->assertOk()->assertViewIs('app.property_types.create');
    }

    /**
     * @test
     */
    public function it_stores_the_property_type(): void
    {
        $data = PropertyType::factory()
            ->make()
            ->toArray();

        $data['name'] = json_encode($data['name']);

        $response = $this->post(route('property-types.store'), $data);

        unset($data['color']);

        $data['name'] = $this->castToJson($data['name']);

        $this->assertDatabaseHas('property_types', $data);

        $propertyType = PropertyType::latest('id')->first();

        $response->assertRedirect(route('property-types.edit', $propertyType));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_property_type(): void
    {
        $propertyType = PropertyType::factory()->create();

        $response = $this->get(route('property-types.show', $propertyType));

        $response
            ->assertOk()
            ->assertViewIs('app.property_types.show')
            ->assertViewHas('propertyType');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_property_type(): void
    {
        $propertyType = PropertyType::factory()->create();

        $response = $this->get(route('property-types.edit', $propertyType));

        $response
            ->assertOk()
            ->assertViewIs('app.property_types.edit')
            ->assertViewHas('propertyType');
    }

    /**
     * @test
     */
    public function it_updates_the_property_type(): void
    {
        $propertyType = PropertyType::factory()->create();

        $data = [
            'ext_code' => $this->faker->unique->text(255),
            'name' => [],
            'color' => $this->faker->hexcolor,
            'sequence' => $this->faker->randomNumber(0),
        ];

        $data['name'] = json_encode($data['name']);

        $response = $this->put(
            route('property-types.update', $propertyType),
            $data
        );

        unset($data['color']);

        $data['id'] = $propertyType->id;

        $data['name'] = $this->castToJson($data['name']);

        $this->assertDatabaseHas('property_types', $data);

        $response->assertRedirect(route('property-types.edit', $propertyType));
    }

    /**
     * @test
     */
    public function it_deletes_the_property_type(): void
    {
        $propertyType = PropertyType::factory()->create();

        $response = $this->delete(
            route('property-types.destroy', $propertyType)
        );

        $response->assertRedirect(route('property-types.index'));

        $this->assertModelMissing($propertyType);
    }
}
