<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SalesPeople;
use App\Models\PropertyType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesPeoplePropertyTypesTest extends TestCase
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
    public function it_gets_sales_people_property_types(): void
    {
        $salesPeople = SalesPeople::factory()->create();
        $propertyType = PropertyType::factory()->create();

        $salesPeople->propertyTypes()->attach($propertyType);

        $response = $this->getJson(
            route('api.all-sales-people.property-types.index', $salesPeople)
        );

        $response->assertOk()->assertSee($propertyType->name);
    }

    /**
     * @test
     */
    public function it_can_attach_property_types_to_sales_people(): void
    {
        $salesPeople = SalesPeople::factory()->create();
        $propertyType = PropertyType::factory()->create();

        $response = $this->postJson(
            route('api.all-sales-people.property-types.store', [
                $salesPeople,
                $propertyType,
            ])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $salesPeople
                ->propertyTypes()
                ->where('property_types.id', $propertyType->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_property_types_from_sales_people(): void
    {
        $salesPeople = SalesPeople::factory()->create();
        $propertyType = PropertyType::factory()->create();

        $response = $this->deleteJson(
            route('api.all-sales-people.property-types.store', [
                $salesPeople,
                $propertyType,
            ])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $salesPeople
                ->propertyTypes()
                ->where('property_types.id', $propertyType->id)
                ->exists()
        );
    }
}
