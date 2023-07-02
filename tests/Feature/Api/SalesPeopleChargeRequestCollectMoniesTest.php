<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SalesPeople;
use App\Models\ChargeRequestCollectMoney;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesPeopleChargeRequestCollectMoniesTest extends TestCase
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
    public function it_gets_sales_people_charge_request_collect_monies(): void
    {
        $salesPeople = SalesPeople::factory()->create();
        $chargeRequestCollectMonies = ChargeRequestCollectMoney::factory()
            ->count(2)
            ->create([
                'sales_people_id' => $salesPeople->id,
            ]);

        $response = $this->getJson(
            route(
                'api.all-sales-people.charge-request-collect-monies.index',
                $salesPeople
            )
        );

        $response->assertOk()->assertSee($chargeRequestCollectMonies[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_sales_people_charge_request_collect_monies(): void
    {
        $salesPeople = SalesPeople::factory()->create();
        $data = ChargeRequestCollectMoney::factory()
            ->make([
                'sales_people_id' => $salesPeople->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.all-sales-people.charge-request-collect-monies.store',
                $salesPeople
            ),
            $data
        );

        $this->assertDatabaseHas('charge_request_collect_monies', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $chargeRequestCollectMoney = ChargeRequestCollectMoney::latest(
            'id'
        )->first();

        $this->assertEquals(
            $salesPeople->id,
            $chargeRequestCollectMoney->sales_people_id
        );
    }
}
