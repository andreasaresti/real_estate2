<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SalesRequest;
use App\Models\IntermediateAgent;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IntermediateAgentSalesRequestsTest extends TestCase
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
    public function it_gets_intermediate_agent_sales_requests(): void
    {
        $intermediateAgent = IntermediateAgent::factory()->create();
        $salesRequests = SalesRequest::factory()
            ->count(2)
            ->create([
                'intermediate_agent_id' => $intermediateAgent->id,
            ]);

        $response = $this->getJson(
            route(
                'api.intermediate-agents.sales-requests.index',
                $intermediateAgent
            )
        );

        $response->assertOk()->assertSee($salesRequests[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_intermediate_agent_sales_requests(): void
    {
        $intermediateAgent = IntermediateAgent::factory()->create();
        $data = SalesRequest::factory()
            ->make([
                'intermediate_agent_id' => $intermediateAgent->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.intermediate-agents.sales-requests.store',
                $intermediateAgent
            ),
            $data
        );

        unset($data['minimum_size']);
        unset($data['maximum_size']);
        unset($data['minimum_bedrooms']);
        unset($data['minimum_bathrooms']);
        unset($data['assigned']);
        unset($data['assigned_date']);
        unset($data['accepted_status']);
        unset($data['status']);
        unset($data['listing_id']);
        unset($data['agreement_price']);
        unset($data['commission_amount']);
        unset($data['agency_percentage']);
        unset($data['agency_amount']);
        unset($data['salesperson_amount']);
        unset($data['salespeople_percentage']);
        unset($data['sales_lost_reason_id']);
        unset($data['final_status']);
        unset($data['has_intermediate_agent']);
        unset($data['intermediate_agent_id']);
        unset($data['intermediate_percentage']);
        unset($data['intermediate_amount']);

        $this->assertDatabaseHas('sales_requests', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $salesRequest = SalesRequest::latest('id')->first();

        $this->assertEquals(
            $intermediateAgent->id,
            $salesRequest->intermediate_agent_id
        );
    }
}
