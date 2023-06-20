<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\CustomerAgreement;

use App\Models\Customer;
use App\Models\District;
use App\Models\PropertyType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerAgreementTest extends TestCase
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
    public function it_gets_customer_agreements_list(): void
    {
        $customerAgreements = CustomerAgreement::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.customer-agreements.index'));

        $response->assertOk()->assertSee($customerAgreements[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_customer_agreement(): void
    {
        $data = CustomerAgreement::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.customer-agreements.store'),
            $data
        );

        unset($data['property_type_id']);

        $this->assertDatabaseHas('customer_agreements', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_customer_agreement(): void
    {
        $customerAgreement = CustomerAgreement::factory()->create();

        $customer = Customer::factory()->create();
        $district = District::factory()->create();
        $propertyType = PropertyType::factory()->create();

        $data = [
            'agency_commission_percentage' => $this->faker->randomNumber(2),
            'customer_id' => $customer->id,
            'district_id' => $district->id,
            'property_type_id' => $propertyType->id,
        ];

        $response = $this->putJson(
            route('api.customer-agreements.update', $customerAgreement),
            $data
        );

        unset($data['property_type_id']);

        $data['id'] = $customerAgreement->id;

        $this->assertDatabaseHas('customer_agreements', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_customer_agreement(): void
    {
        $customerAgreement = CustomerAgreement::factory()->create();

        $response = $this->deleteJson(
            route('api.customer-agreements.destroy', $customerAgreement)
        );

        $this->assertModelMissing($customerAgreement);

        $response->assertNoContent();
    }
}
