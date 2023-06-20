<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Agent;
use App\Models\SalesPeople;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AgentAllSalesPeopleTest extends TestCase
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
    public function it_gets_agent_all_sales_people(): void
    {
        $agent = Agent::factory()->create();
        $allSalesPeople = SalesPeople::factory()
            ->count(2)
            ->create([
                'agent_id' => $agent->id,
            ]);

        $response = $this->getJson(
            route('api.agents.all-sales-people.index', $agent)
        );

        $response->assertOk()->assertSee($allSalesPeople[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_agent_all_sales_people(): void
    {
        $agent = Agent::factory()->create();
        $data = SalesPeople::factory()
            ->make([
                'agent_id' => $agent->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.agents.all-sales-people.store', $agent),
            $data
        );

        $this->assertDatabaseHas('sales_people', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $salesPeople = SalesPeople::latest('id')->first();

        $this->assertEquals($agent->id, $salesPeople->agent_id);
    }
}
