<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Agent;
use App\Models\District;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DistrictAgentsTest extends TestCase
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
    public function it_gets_district_agents(): void
    {
        $district = District::factory()->create();
        $agents = Agent::factory()
            ->count(2)
            ->create([
                'district_id' => $district->id,
            ]);

        $response = $this->getJson(
            route('api.districts.agents.index', $district)
        );

        $response->assertOk()->assertSee($agents[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_district_agents(): void
    {
        $district = District::factory()->create();
        $data = Agent::factory()
            ->make([
                'district_id' => $district->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.districts.agents.store', $district),
            $data
        );

        unset($data['longitude']);
        unset($data['latitude']);

        $this->assertDatabaseHas('agents', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $agent = Agent::latest('id')->first();

        $this->assertEquals($district->id, $agent->district_id);
    }
}
