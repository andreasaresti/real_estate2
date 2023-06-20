<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SalesPeopleAgreement;

use App\Models\District;
use App\Models\SalesPeople;
use App\Models\PropertyType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesPeopleAgreementTest extends TestCase
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
    public function it_gets_sales_people_agreements_list(): void
    {
        $salesPeopleAgreements = SalesPeopleAgreement::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.sales-people-agreements.index'));

        $response->assertOk()->assertSee($salesPeopleAgreements[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_sales_people_agreement(): void
    {
        $data = SalesPeopleAgreement::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.sales-people-agreements.store'),
            $data
        );

        unset($data['property_type_id']);

        $this->assertDatabaseHas('sales_people_agreements', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.sales-people-agreements.update', $salesPeopleAgreement),
            $data
        );

        unset($data['property_type_id']);

        $data['id'] = $salesPeopleAgreement->id;

        $this->assertDatabaseHas('sales_people_agreements', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_sales_people_agreement(): void
    {
        $salesPeopleAgreement = SalesPeopleAgreement::factory()->create();

        $response = $this->deleteJson(
            route('api.sales-people-agreements.destroy', $salesPeopleAgreement)
        );

        $this->assertModelMissing($salesPeopleAgreement);

        $response->assertNoContent();
    }
}
