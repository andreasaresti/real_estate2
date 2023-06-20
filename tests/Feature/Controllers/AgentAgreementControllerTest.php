<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\AgentAgreement;

use App\Models\Agent;
use App\Models\PropertyType;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AgentAgreementControllerTest extends TestCase
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

    /**
     * @test
     */
    public function it_displays_index_view_with_agent_agreements(): void
    {
        $agentAgreements = AgentAgreement::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('agent-agreements.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.agent_agreements.index')
            ->assertViewHas('agentAgreements');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_agent_agreement(): void
    {
        $response = $this->get(route('agent-agreements.create'));

        $response->assertOk()->assertViewIs('app.agent_agreements.create');
    }

    /**
     * @test
     */
    public function it_stores_the_agent_agreement(): void
    {
        $data = AgentAgreement::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('agent-agreements.store'), $data);

        unset($data['property_type_id']);

        $this->assertDatabaseHas('agent_agreements', $data);

        $agentAgreement = AgentAgreement::latest('id')->first();

        $response->assertRedirect(
            route('agent-agreements.edit', $agentAgreement)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_agent_agreement(): void
    {
        $agentAgreement = AgentAgreement::factory()->create();

        $response = $this->get(route('agent-agreements.show', $agentAgreement));

        $response
            ->assertOk()
            ->assertViewIs('app.agent_agreements.show')
            ->assertViewHas('agentAgreement');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_agent_agreement(): void
    {
        $agentAgreement = AgentAgreement::factory()->create();

        $response = $this->get(route('agent-agreements.edit', $agentAgreement));

        $response
            ->assertOk()
            ->assertViewIs('app.agent_agreements.edit')
            ->assertViewHas('agentAgreement');
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

        $response = $this->put(
            route('agent-agreements.update', $agentAgreement),
            $data
        );

        unset($data['property_type_id']);

        $data['id'] = $agentAgreement->id;

        $this->assertDatabaseHas('agent_agreements', $data);

        $response->assertRedirect(
            route('agent-agreements.edit', $agentAgreement)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_agent_agreement(): void
    {
        $agentAgreement = AgentAgreement::factory()->create();

        $response = $this->delete(
            route('agent-agreements.destroy', $agentAgreement)
        );

        $response->assertRedirect(route('agent-agreements.index'));

        $this->assertModelMissing($agentAgreement);
    }
}
