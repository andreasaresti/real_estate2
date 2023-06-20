<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Customer;
use App\Models\CustomerRole;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerRoleCustomersTest extends TestCase
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
    public function it_gets_customer_role_customers(): void
    {
        $customerRole = CustomerRole::factory()->create();
        $customers = Customer::factory()
            ->count(2)
            ->create([
                'customer_role_id' => $customerRole->id,
            ]);

        $response = $this->getJson(
            route('api.customer-roles.customers.index', $customerRole)
        );

        $response->assertOk()->assertSee($customers[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_customer_role_customers(): void
    {
        $customerRole = CustomerRole::factory()->create();
        $data = Customer::factory()
            ->make([
                'customer_role_id' => $customerRole->id,
            ])
            ->toArray();
        $data['password'] = \Str::random('8');

        $response = $this->postJson(
            route('api.customer-roles.customers.store', $customerRole),
            $data
        );

        unset($data['password']);

        $this->assertDatabaseHas('customers', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $customer = Customer::latest('id')->first();

        $this->assertEquals($customerRole->id, $customer->customer_role_id);
    }
}
