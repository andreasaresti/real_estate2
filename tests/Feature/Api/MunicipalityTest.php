<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Municipality;

use App\Models\District;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MunicipalityTest extends TestCase
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
    public function it_gets_municipalities_list(): void
    {
        $municipalities = Municipality::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.municipalities.index'));

        $response->assertOk()->assertSee($municipalities[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_municipality(): void
    {
        $data = Municipality::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.municipalities.store'), $data);

        $this->assertDatabaseHas('municipalities', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.municipalities.update', $municipality),
            $data
        );

        $data['id'] = $municipality->id;

        $this->assertDatabaseHas('municipalities', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_municipality(): void
    {
        $municipality = Municipality::factory()->create();

        $response = $this->deleteJson(
            route('api.municipalities.destroy', $municipality)
        );

        $this->assertModelMissing($municipality);

        $response->assertNoContent();
    }
}
