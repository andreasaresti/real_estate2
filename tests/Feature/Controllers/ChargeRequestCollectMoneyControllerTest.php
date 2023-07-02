<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ChargeRequestCollectMoney;

use App\Models\SalesPeople;
use App\Models\SalesRequest;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChargeRequestCollectMoneyControllerTest extends TestCase
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
    public function it_displays_index_view_with_charge_request_collect_monies(): void
    {
        $chargeRequestCollectMonies = ChargeRequestCollectMoney::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('charge-request-collect-monies.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.charge_request_collect_monies.index')
            ->assertViewHas('chargeRequestCollectMonies');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_charge_request_collect_money(): void
    {
        $response = $this->get(route('charge-request-collect-monies.create'));

        $response
            ->assertOk()
            ->assertViewIs('app.charge_request_collect_monies.create');
    }

    /**
     * @test
     */
    public function it_stores_the_charge_request_collect_money(): void
    {
        $data = ChargeRequestCollectMoney::factory()
            ->make()
            ->toArray();

        $response = $this->post(
            route('charge-request-collect-monies.store'),
            $data
        );

        $this->assertDatabaseHas('charge_request_collect_monies', $data);

        $chargeRequestCollectMoney = ChargeRequestCollectMoney::latest(
            'id'
        )->first();

        $response->assertRedirect(
            route(
                'charge-request-collect-monies.edit',
                $chargeRequestCollectMoney
            )
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_charge_request_collect_money(): void
    {
        $chargeRequestCollectMoney = ChargeRequestCollectMoney::factory()->create();

        $response = $this->get(
            route(
                'charge-request-collect-monies.show',
                $chargeRequestCollectMoney
            )
        );

        $response
            ->assertOk()
            ->assertViewIs('app.charge_request_collect_monies.show')
            ->assertViewHas('chargeRequestCollectMoney');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_charge_request_collect_money(): void
    {
        $chargeRequestCollectMoney = ChargeRequestCollectMoney::factory()->create();

        $response = $this->get(
            route(
                'charge-request-collect-monies.edit',
                $chargeRequestCollectMoney
            )
        );

        $response
            ->assertOk()
            ->assertViewIs('app.charge_request_collect_monies.edit')
            ->assertViewHas('chargeRequestCollectMoney');
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

        $response = $this->put(
            route(
                'charge-request-collect-monies.update',
                $chargeRequestCollectMoney
            ),
            $data
        );

        $data['id'] = $chargeRequestCollectMoney->id;

        $this->assertDatabaseHas('charge_request_collect_monies', $data);

        $response->assertRedirect(
            route(
                'charge-request-collect-monies.edit',
                $chargeRequestCollectMoney
            )
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_charge_request_collect_money(): void
    {
        $chargeRequestCollectMoney = ChargeRequestCollectMoney::factory()->create();

        $response = $this->delete(
            route(
                'charge-request-collect-monies.destroy',
                $chargeRequestCollectMoney
            )
        );

        $response->assertRedirect(route('charge-request-collect-monies.index'));

        $this->assertModelMissing($chargeRequestCollectMoney);
    }
}
