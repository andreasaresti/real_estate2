<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\SalesPeopleAgreement;

use App\Models\District;
use App\Models\SalesPeople;
use App\Models\PropertyType;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesPeopleAgreementControllerTest extends TestCase
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
    public function it_displays_index_view_with_sales_people_agreements(): void
    {
        $salesPeopleAgreements = SalesPeopleAgreement::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('sales-people-agreements.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.sales_people_agreements.index')
            ->assertViewHas('salesPeopleAgreements');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_sales_people_agreement(): void
    {
        $response = $this->get(route('sales-people-agreements.create'));

        $response
            ->assertOk()
            ->assertViewIs('app.sales_people_agreements.create');
    }

    /**
     * @test
     */
    public function it_stores_the_sales_people_agreement(): void
    {
        $data = SalesPeopleAgreement::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('sales-people-agreements.store'), $data);

        unset($data['property_type_id']);

        $this->assertDatabaseHas('sales_people_agreements', $data);

        $salesPeopleAgreement = SalesPeopleAgreement::latest('id')->first();

        $response->assertRedirect(
            route('sales-people-agreements.edit', $salesPeopleAgreement)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_sales_people_agreement(): void
    {
        $salesPeopleAgreement = SalesPeopleAgreement::factory()->create();

        $response = $this->get(
            route('sales-people-agreements.show', $salesPeopleAgreement)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.sales_people_agreements.show')
            ->assertViewHas('salesPeopleAgreement');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_sales_people_agreement(): void
    {
        $salesPeopleAgreement = SalesPeopleAgreement::factory()->create();

        $response = $this->get(
            route('sales-people-agreements.edit', $salesPeopleAgreement)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.sales_people_agreements.edit')
            ->assertViewHas('salesPeopleAgreement');
    }

    /**
     * @test
     */
    public function it_updates_the_sales_people_agreement(): void
    {
        $salesPeopleAgreement = SalesPeopleAgreement::factory()->create();

        $salesPeople = SalesPeople::factory()->create();
        $district = District::factory()->create();
        $propertyType = PropertyType::factory()->create();

        $data = [
            'salespeople_commission_percentage' => $this->faker->randomNumber(
                2
            ),
            'sales_people_id' => $salesPeople->id,
            'district_id' => $district->id,
            'property_type_id' => $propertyType->id,
        ];

        $response = $this->put(
            route('sales-people-agreements.update', $salesPeopleAgreement),
            $data
        );

        unset($data['property_type_id']);

        $data['id'] = $salesPeopleAgreement->id;

        $this->assertDatabaseHas('sales_people_agreements', $data);

        $response->assertRedirect(
            route('sales-people-agreements.edit', $salesPeopleAgreement)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_sales_people_agreement(): void
    {
        $salesPeopleAgreement = SalesPeopleAgreement::factory()->create();

        $response = $this->delete(
            route('sales-people-agreements.destroy', $salesPeopleAgreement)
        );

        $response->assertRedirect(route('sales-people-agreements.index'));

        $this->assertModelMissing($salesPeopleAgreement);
    }
}
