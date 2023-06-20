<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\District;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DistrictTest extends TestCase
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
    public function it_gets_districts_list(): void
    {
        $districts = District::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.districts.index'));

        $response->assertOk()->assertSee($districts[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_district(): void
    {
        $data = District::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.districts.store'), $data);

        $this->assertDatabaseHas('districts', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.districts.update', $district),
            $data
        );

        $data['id'] = $district->id;

        $this->assertDatabaseHas('districts', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_district(): void
    {
        $district = District::factory()->create();

        $response = $this->deleteJson(
            route('api.districts.destroy', $district)
        );

        $this->assertModelMissing($district);

        $response->assertNoContent();
    }
}
