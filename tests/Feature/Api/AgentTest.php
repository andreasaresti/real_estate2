<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Agent;

use App\Models\District;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AgentTest extends TestCase
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
    public function it_gets_agents_list(): void
    {
        $agents = Agent::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.agents.index'));

        $response->assertOk()->assertSee($agents[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_agent(): void
    {
        $data = Agent::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.agents.store'), $data);

        unset($data['longitude']);
        unset($data['laditude']);

        $this->assertDatabaseHas('agents', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_agent(): void
    {
        $agent = Agent::factory()->create();

        $district = District::factory()->create();

        $data = [
            'ext_code' => $this->faker->unique->text(255),
            'name' => $this->faker->name(),
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'postal_code' => $this->faker->text(255),
            'city' => $this->faker->city,
            'country' => $this->faker->country,
            'comments' => $this->faker->text,
            'active' => $this->faker->boolean,
            'longitude' => $this->faker->longitude,
            'laditude' => $this->faker->randomNumber(2),
            'district_id' => $district->id,
        ];

        $response = $this->putJson(route('api.agents.update', $agent), $data);

        unset($data['longitude']);
        unset($data['laditude']);

        $data['id'] = $agent->id;

        $this->assertDatabaseHas('agents', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_agent(): void
    {
        $agent = Agent::factory()->create();

        $response = $this->deleteJson(route('api.agents.destroy', $agent));

        $this->assertModelMissing($agent);

        $response->assertNoContent();
    }
}
