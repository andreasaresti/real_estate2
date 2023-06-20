<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SalesPeople;

use App\Models\Agent;
use App\Models\Customer;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesPeopleTest extends TestCase
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
    public function it_gets_all_sales_people_list(): void
    {
        $allSalesPeople = SalesPeople::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.all-sales-people.index'));

        $response->assertOk()->assertSee($allSalesPeople[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_sales_people(): void
    {
        $data = SalesPeople::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.all-sales-people.store'), $data);

        $this->assertDatabaseHas('sales_people', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_sales_people(): void
    {
        $salesPeople = SalesPeople::factory()->create();

        $customer = Customer::factory()->create();
        $agent = Agent::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'active' => $this->faker->boolean,
            'customer_id' => $customer->id,
            'agent_id' => $agent->id,
        ];

        $response = $this->putJson(
            route('api.all-sales-people.update', $salesPeople),
            $data
        );

        $data['id'] = $salesPeople->id;

        $this->assertDatabaseHas('sales_people', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_sales_people(): void
    {
        $salesPeople = SalesPeople::factory()->create();

        $response = $this->deleteJson(
            route('api.all-sales-people.destroy', $salesPeople)
        );

        $this->assertModelMissing($salesPeople);

        $response->assertNoContent();
    }
}
