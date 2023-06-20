<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\District;
use App\Models\Municipality;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DistrictMunicipalitiesTest extends TestCase
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
    public function it_gets_district_municipalities(): void
    {
        $district = District::factory()->create();
        $municipalities = Municipality::factory()
            ->count(2)
            ->create([
                'district_id' => $district->id,
            ]);

        $response = $this->getJson(
            route('api.districts.municipalities.index', $district)
        );

        $response->assertOk()->assertSee($municipalities[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_district_municipalities(): void
    {
        $district = District::factory()->create();
        $data = Municipality::factory()
            ->make([
                'district_id' => $district->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.districts.municipalities.store', $district),
            $data
        );

        $this->assertDatabaseHas('municipalities', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $municipality = Municipality::latest('id')->first();

        $this->assertEquals($district->id, $municipality->district_id);
    }
}
