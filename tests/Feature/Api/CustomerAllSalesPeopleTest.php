<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Customer;
use App\Models\SalesPeople;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerAllSalesPeopleTest extends TestCase
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
    public function it_gets_customer_all_sales_people(): void
    {
        $customer = Customer::factory()->create();
        $allSalesPeople = SalesPeople::factory()
            ->count(2)
            ->create([
                'customer_id' => $customer->id,
            ]);

        $response = $this->getJson(
            route('api.customers.all-sales-people.index', $customer)
        );

        $response->assertOk()->assertSee($allSalesPeople[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_customer_all_sales_people(): void
    {
        $customer = Customer::factory()->create();
        $data = SalesPeople::factory()
            ->make([
                'customer_id' => $customer->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.customers.all-sales-people.store', $customer),
            $data
        );

        $this->assertDatabaseHas('sales_people', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $salesPeople = SalesPeople::latest('id')->first();

        $this->assertEquals($customer->id, $salesPeople->customer_id);
    }
}
