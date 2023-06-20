<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Agent;
use App\Models\AgentAgreement;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AgentAgentAgreementsTest extends TestCase
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
    public function it_gets_agent_agent_agreements(): void
    {
        $agent = Agent::factory()->create();
        $agentAgreements = AgentAgreement::factory()
            ->count(2)
            ->create([
                'agent_id' => $agent->id,
            ]);

        $response = $this->getJson(
            route('api.agents.agent-agreements.index', $agent)
        );

        $response->assertOk()->assertSee($agentAgreements[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_agent_agent_agreements(): void
    {
        $agent = Agent::factory()->create();
        $data = AgentAgreement::factory()
            ->make([
                'agent_id' => $agent->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.agents.agent-agreements.store', $agent),
            $data
        );

        unset($data['property_type_id']);

        $this->assertDatabaseHas('agent_agreements', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $agentAgreement = AgentAgreement::latest('id')->first();

        $this->assertEquals($agent->id, $agentAgreement->agent_id);
    }
}
