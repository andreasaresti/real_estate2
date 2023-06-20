<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\CustomerAgreement;

use App\Models\Customer;
use App\Models\District;
use App\Models\PropertyType;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerAgreementControllerTest extends TestCase
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
    public function it_displays_index_view_with_customer_agreements(): void
    {
        $customerAgreements = CustomerAgreement::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('customer-agreements.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.customer_agreements.index')
            ->assertViewHas('customerAgreements');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_customer_agreement(): void
    {
        $response = $this->get(route('customer-agreements.create'));

        $response->assertOk()->assertViewIs('app.customer_agreements.create');
    }

    /**
     * @test
     */
    public function it_stores_the_customer_agreement(): void
    {
        $data = CustomerAgreement::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('customer-agreements.store'), $data);

        unset($data['property_type_id']);

        $this->assertDatabaseHas('customer_agreements', $data);

        $customerAgreement = CustomerAgreement::latest('id')->first();

        $response->assertRedirect(
            route('customer-agreements.edit', $customerAgreement)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_customer_agreement(): void
    {
        $customerAgreement = CustomerAgreement::factory()->create();

        $response = $this->get(
            route('customer-agreements.show', $customerAgreement)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.customer_agreements.show')
            ->assertViewHas('customerAgreement');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_customer_agreement(): void
    {
        $customerAgreement = CustomerAgreement::factory()->create();

        $response = $this->get(
            route('customer-agreements.edit', $customerAgreement)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.customer_agreements.edit')
            ->assertViewHas('customerAgreement');
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

        $response = $this->put(
            route('customer-agreements.update', $customerAgreement),
            $data
        );

        unset($data['property_type_id']);

        $data['id'] = $customerAgreement->id;

        $this->assertDatabaseHas('customer_agreements', $data);

        $response->assertRedirect(
            route('customer-agreements.edit', $customerAgreement)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_customer_agreement(): void
    {
        $customerAgreement = CustomerAgreement::factory()->create();

        $response = $this->delete(
            route('customer-agreements.destroy', $customerAgreement)
        );

        $response->assertRedirect(route('customer-agreements.index'));

        $this->assertModelMissing($customerAgreement);
    }
}
