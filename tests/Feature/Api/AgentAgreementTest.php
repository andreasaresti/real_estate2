<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\AgentAgreement;

use App\Models\Agent;
use App\Models\PropertyType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AgentAgreementTest extends TestCase
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
    public function it_gets_agent_agreements_list(): void
    {
        $agentAgreements = AgentAgreement::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.agent-agreements.index'));

        $response->assertOk()->assertSee($agentAgreements[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_agent_agreement(): void
    {
        $data = AgentAgreement::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.agent-agreements.store'), $data);

        unset($data['property_type_id']);

        $this->assertDatabaseHas('agent_agreements', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_agent_agreement(): void
    {
        $agentAgreement = AgentAgreement::factory()->create();

        $agent = Agent::factory()->create();
        $propertyType = PropertyType::factory()->create();

        $data = [
            'agency_commission_percentage' => $this->faker->randomNumber(2),
            'salespeople_commission_percentage' => $this->faker->randomNumber(
                2
            ),
            'agent_id' => $agent->id,
            'property_type_id' => $propertyType->id,
        ];

        $response = $this->putJson(
            route('api.agent-agreements.update', $agentAgreement),
            $data
        );

        unset($data['property_type_id']);

        $data['id'] = $agentAgreement->id;

        $this->assertDatabaseHas('agent_agreements', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_agent_agreement(): void
    {
        $agentAgreement = AgentAgreement::factory()->create();

        $response = $this->deleteJson(
            route('api.agent-agreements.destroy', $agentAgreement)
        );

        $this->assertModelMissing($agentAgreement);

        $response->assertNoContent();
    }
}
