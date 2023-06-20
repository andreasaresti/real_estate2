<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SalesPeople;
use App\Models\PropertyType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PropertyTypeAllSalesPeopleTest extends TestCase
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
    public function it_gets_property_type_all_sales_people(): void
    {
        $propertyType = PropertyType::factory()->create();
        $salesPeople = SalesPeople::factory()->create();

        $propertyType->allSalesPeople()->attach($salesPeople);

        $response = $this->getJson(
            route('api.property-types.all-sales-people.index', $propertyType)
        );

        $response->assertOk()->assertSee($salesPeople->name);
    }

    /**
     * @test
     */
    public function it_can_attach_all_sales_people_to_property_type(): void
    {
        $propertyType = PropertyType::factory()->create();
        $salesPeople = SalesPeople::factory()->create();

        $response = $this->postJson(
            route('api.property-types.all-sales-people.store', [
                $propertyType,
                $salesPeople,
            ])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $propertyType
                ->allSalesPeople()
                ->where('sales_people.id', $salesPeople->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_all_sales_people_from_property_type(): void
    {
        $propertyType = PropertyType::factory()->create();
        $salesPeople = SalesPeople::factory()->create();

        $response = $this->deleteJson(
            route('api.property-types.all-sales-people.store', [
                $propertyType,
                $salesPeople,
            ])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $propertyType
                ->allSalesPeople()
                ->where('sales_people.id', $salesPeople->id)
                ->exists()
        );
    }
}
