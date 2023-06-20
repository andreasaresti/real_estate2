<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\PropertyType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PropertyTypeTest extends TestCase
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
    public function it_gets_property_types_list(): void
    {
        $propertyTypes = PropertyType::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.property-types.index'));

        $response->assertOk()->assertSee($propertyTypes[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_property_type(): void
    {
        $data = PropertyType::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.property-types.store'), $data);

        unset($data['color']);

        $this->assertDatabaseHas('property_types', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.property-types.update', $propertyType),
            $data
        );

        unset($data['color']);

        $data['id'] = $propertyType->id;

        $this->assertDatabaseHas('property_types', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_property_type(): void
    {
        $propertyType = PropertyType::factory()->create();

        $response = $this->deleteJson(
            route('api.property-types.destroy', $propertyType)
        );

        $this->assertModelMissing($propertyType);

        $response->assertNoContent();
    }
}
