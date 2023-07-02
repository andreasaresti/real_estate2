<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SalesRequest;
use App\Models\ChargeRequestCollectMoney;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesRequestChargeRequestCollectMoniesTest extends TestCase
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
    public function it_gets_sales_request_charge_request_collect_monies(): void
    {
        $salesRequest = SalesRequest::factory()->create();
        $chargeRequestCollectMonies = ChargeRequestCollectMoney::factory()
            ->count(2)
            ->create([
                'sales_request_id' => $salesRequest->id,
            ]);

        $response = $this->getJson(
            route(
                'api.sales-requests.charge-request-collect-monies.index',
                $salesRequest
            )
        );

        $response->assertOk()->assertSee($chargeRequestCollectMonies[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_sales_request_charge_request_collect_monies(): void
    {
        $salesRequest = SalesRequest::factory()->create();
        $data = ChargeRequestCollectMoney::factory()
            ->make([
                'sales_request_id' => $salesRequest->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.sales-requests.charge-request-collect-monies.store',
                $salesRequest
            ),
            $data
        );

        $this->assertDatabaseHas('charge_request_collect_monies', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $chargeRequestCollectMoney = ChargeRequestCollectMoney::latest(
            'id'
        )->first();

        $this->assertEquals(
            $salesRequest->id,
            $chargeRequestCollectMoney->sales_request_id
        );
    }
}
