<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ChargeRequestCollectMoney;

use App\Models\SalesPeople;
use App\Models\SalesRequest;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChargeRequestCollectMoneyTest extends TestCase
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
    public function it_gets_charge_request_collect_monies_list(): void
    {
        $chargeRequestCollectMonies = ChargeRequestCollectMoney::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(
            route('api.charge-request-collect-monies.index')
        );

        $response->assertOk()->assertSee($chargeRequestCollectMonies[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_charge_request_collect_money(): void
    {
        $data = ChargeRequestCollectMoney::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.charge-request-collect-monies.store'),
            $data
        );

        $this->assertDatabaseHas('charge_request_collect_monies', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_charge_request_collect_money(): void
    {
        $chargeRequestCollectMoney = ChargeRequestCollectMoney::factory()->create();

        $salesRequest = SalesRequest::factory()->create();
        $salesPeople = SalesPeople::factory()->create();

        $data = [
            'amount' => $this->faker->randomNumber(1),
            'commission_amount' => $this->faker->randomNumber(1),
            'sales_request_id' => $salesRequest->id,
            'sales_people_id' => $salesPeople->id,
        ];

        $response = $this->putJson(
            route(
                'api.charge-request-collect-monies.update',
                $chargeRequestCollectMoney
            ),
            $data
        );

        $data['id'] = $chargeRequestCollectMoney->id;

        $this->assertDatabaseHas('charge_request_collect_monies', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_charge_request_collect_money(): void
    {
        $chargeRequestCollectMoney = ChargeRequestCollectMoney::factory()->create();

        $response = $this->deleteJson(
            route(
                'api.charge-request-collect-monies.destroy',
                $chargeRequestCollectMoney
            )
        );

        $this->assertModelMissing($chargeRequestCollectMoney);

        $response->assertNoContent();
    }
}
