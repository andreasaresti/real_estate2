<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SalesRequest;
use App\Models\SalesLostReason;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesLostReasonSalesRequestsTest extends TestCase
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
    public function it_gets_sales_lost_reason_sales_requests(): void
    {
        $salesLostReason = SalesLostReason::factory()->create();
        $salesRequests = SalesRequest::factory()
            ->count(2)
            ->create([
                'sales_lost_reason_id' => $salesLostReason->id,
            ]);

        $response = $this->getJson(
            route(
                'api.sales-lost-reasons.sales-requests.index',
                $salesLostReason
            )
        );

        $response->assertOk()->assertSee($salesRequests[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_sales_lost_reason_sales_requests(): void
    {
        $salesLostReason = SalesLostReason::factory()->create();
        $data = SalesRequest::factory()
            ->make([
                'sales_lost_reason_id' => $salesLostReason->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.sales-lost-reasons.sales-requests.store',
                $salesLostReason
            ),
            $data
        );

        unset($data['minimum_size']);
        unset($data['maximum_size']);
        unset($data['minimum_bedrooms']);
        unset($data['minimum_bathrooms']);
        unset($data['assigned']);
        unset($data['accepted_status']);
        unset($data['status']);
        unset($data['listing_id']);
        unset($data['agreement_price']);
        unset($data['agency_percentage']);
        unset($data['salespeople_percentage']);
        unset($data['sales_lost_reason_id']);
        unset($data['intermediate_percentage']);
        unset($data['final_status']);

        $this->assertDatabaseHas('sales_requests', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $salesRequest = SalesRequest::latest('id')->first();

        $this->assertEquals(
            $salesLostReason->id,
            $salesRequest->sales_lost_reason_id
        );
    }
}
