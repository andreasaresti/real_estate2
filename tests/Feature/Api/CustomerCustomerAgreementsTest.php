<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Customer;
use App\Models\CustomerAgreement;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerCustomerAgreementsTest extends TestCase
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
    public function it_gets_customer_customer_agreements(): void
    {
        $customer = Customer::factory()->create();
        $customerAgreements = CustomerAgreement::factory()
            ->count(2)
            ->create([
                'customer_id' => $customer->id,
            ]);

        $response = $this->getJson(
            route('api.customers.customer-agreements.index', $customer)
        );

        $response->assertOk()->assertSee($customerAgreements[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_customer_customer_agreements(): void
    {
        $customer = Customer::factory()->create();
        $data = CustomerAgreement::factory()
            ->make([
                'customer_id' => $customer->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.customers.customer-agreements.store', $customer),
            $data
        );

        unset($data['property_type_id']);

        $this->assertDatabaseHas('customer_agreements', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $customerAgreement = CustomerAgreement::latest('id')->first();

        $this->assertEquals($customer->id, $customerAgreement->customer_id);
    }
}
