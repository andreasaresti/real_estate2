<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\IntermediateAgent;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IntermediateAgentControllerTest extends TestCase
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
    public function it_displays_index_view_with_intermediate_agents(): void
    {
        $intermediateAgents = IntermediateAgent::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('intermediate-agents.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.intermediate_agents.index')
            ->assertViewHas('intermediateAgents');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_intermediate_agent(): void
    {
        $response = $this->get(route('intermediate-agents.create'));

        $response->assertOk()->assertViewIs('app.intermediate_agents.create');
    }

    /**
     * @test
     */
    public function it_stores_the_intermediate_agent(): void
    {
        $data = IntermediateAgent::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('intermediate-agents.store'), $data);

        $this->assertDatabaseHas('intermediate_agents', $data);

        $intermediateAgent = IntermediateAgent::latest('id')->first();

        $response->assertRedirect(
            route('intermediate-agents.edit', $intermediateAgent)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_intermediate_agent(): void
    {
        $intermediateAgent = IntermediateAgent::factory()->create();

        $response = $this->get(
            route('intermediate-agents.show', $intermediateAgent)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.intermediate_agents.show')
            ->assertViewHas('intermediateAgent');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_intermediate_agent(): void
    {
        $intermediateAgent = IntermediateAgent::factory()->create();

        $response = $this->get(
            route('intermediate-agents.edit', $intermediateAgent)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.intermediate_agents.edit')
            ->assertViewHas('intermediateAgent');
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

        $response = $this->put(
            route('intermediate-agents.update', $intermediateAgent),
            $data
        );

        $data['id'] = $intermediateAgent->id;

        $this->assertDatabaseHas('intermediate_agents', $data);

        $response->assertRedirect(
            route('intermediate-agents.edit', $intermediateAgent)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_intermediate_agent(): void
    {
        $intermediateAgent = IntermediateAgent::factory()->create();

        $response = $this->delete(
            route('intermediate-agents.destroy', $intermediateAgent)
        );

        $response->assertRedirect(route('intermediate-agents.index'));

        $this->assertModelMissing($intermediateAgent);
    }
}
