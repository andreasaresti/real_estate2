<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SalesPeople;
use App\Models\SalesPeopleAgreement;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesPeopleSalesPeopleAgreementsTest extends TestCase
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
    public function it_gets_sales_people_sales_people_agreements(): void
    {
        $salesPeople = SalesPeople::factory()->create();
        $salesPeopleAgreements = SalesPeopleAgreement::factory()
            ->count(2)
            ->create([
                'sales_people_id' => $salesPeople->id,
            ]);

        $response = $this->getJson(
            route(
                'api.all-sales-people.sales-people-agreements.index',
                $salesPeople
            )
        );

        $response->assertOk()->assertSee($salesPeopleAgreements[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_sales_people_sales_people_agreements(): void
    {
        $salesPeople = SalesPeople::factory()->create();
        $data = SalesPeopleAgreement::factory()
            ->make([
                'sales_people_id' => $salesPeople->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.all-sales-people.sales-people-agreements.store',
                $salesPeople
            ),
            $data
        );

        unset($data['property_type_id']);

        $this->assertDatabaseHas('sales_people_agreements', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $salesPeopleAgreement = SalesPeopleAgreement::latest('id')->first();

        $this->assertEquals(
            $salesPeople->id,
            $salesPeopleAgreement->sales_people_id
        );
    }
}
