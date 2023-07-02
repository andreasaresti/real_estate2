<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\IntermediateAgent;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IntermediateAgentTest extends TestCase
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
    public function it_gets_intermediate_agents_list(): void
    {
        $intermediateAgents = IntermediateAgent::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.intermediate-agents.index'));

        $response->assertOk()->assertSee($intermediateAgents[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_intermediate_agent(): void
    {
        $data = IntermediateAgent::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.intermediate-agents.store'),
            $data
        );

        $this->assertDatabaseHas('intermediate_agents', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_intermediate_agent(): void
    {
        $intermediateAgent = IntermediateAgent::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'country' => $this->faker->country,
            'telephone' => $this->faker->text(255),
            'email' => $this->faker->email,
            'website' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.intermediate-agents.update', $intermediateAgent),
            $data
        );

        $data['id'] = $intermediateAgent->id;

        $this->assertDatabaseHas('intermediate_agents', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_intermediate_agent(): void
    {
        $intermediateAgent = IntermediateAgent::factory()->create();

        $response = $this->deleteJson(
            route('api.intermediate-agents.destroy', $intermediateAgent)
        );

        $this->assertModelMissing($intermediateAgent);

        $response->assertNoContent();
    }
}
