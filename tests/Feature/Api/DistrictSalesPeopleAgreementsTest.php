<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\District;
use App\Models\SalesPeopleAgreement;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DistrictSalesPeopleAgreementsTest extends TestCase
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
    public function it_gets_district_sales_people_agreements(): void
    {
        $district = District::factory()->create();
        $salesPeopleAgreements = SalesPeopleAgreement::factory()
            ->count(2)
            ->create([
                'district_id' => $district->id,
            ]);

        $response = $this->getJson(
            route('api.districts.sales-people-agreements.index', $district)
        );

        $response->assertOk()->assertSee($salesPeopleAgreements[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_district_sales_people_agreements(): void
    {
        $district = District::factory()->create();
        $data = SalesPeopleAgreement::factory()
            ->make([
                'district_id' => $district->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.districts.sales-people-agreements.store', $district),
            $data
        );

        unset($data['property_type_id']);

        $this->assertDatabaseHas('sales_people_agreements', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $salesPeopleAgreement = SalesPeopleAgreement::latest('id')->first();

        $this->assertEquals($district->id, $salesPeopleAgreement->district_id);
    }
}
