<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\PropertyType;
use App\Models\SalesPeopleAgreement;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PropertyTypeSalesPeopleAgreementsTest extends TestCase
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
    public function it_gets_property_type_sales_people_agreements(): void
    {
        $propertyType = PropertyType::factory()->create();
        $salesPeopleAgreements = SalesPeopleAgreement::factory()
            ->count(2)
            ->create([
                'property_type_id' => $propertyType->id,
            ]);

        $response = $this->getJson(
            route(
                'api.property-types.sales-people-agreements.index',
                $propertyType
            )
        );

        $response->assertOk()->assertSee($salesPeopleAgreements[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_property_type_sales_people_agreements(): void
    {
        $propertyType = PropertyType::factory()->create();
        $data = SalesPeopleAgreement::factory()
            ->make([
                'property_type_id' => $propertyType->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.property-types.sales-people-agreements.store',
                $propertyType
            ),
            $data
        );

        unset($data['property_type_id']);

        $this->assertDatabaseHas('sales_people_agreements', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $salesPeopleAgreement = SalesPeopleAgreement::latest('id')->first();

        $this->assertEquals(
            $propertyType->id,
            $salesPeopleAgreement->property_type_id
        );
    }
}
