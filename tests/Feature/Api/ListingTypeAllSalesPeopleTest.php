<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ListingType;
use App\Models\SalesPeople;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingTypeAllSalesPeopleTest extends TestCase
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
    public function it_gets_listing_type_all_sales_people(): void
    {
        $listingType = ListingType::factory()->create();
        $salesPeople = SalesPeople::factory()->create();

        $listingType->allSalesPeople()->attach($salesPeople);

        $response = $this->getJson(
            route('api.listing-types.all-sales-people.index', $listingType)
        );

        $response->assertOk()->assertSee($salesPeople->name);
    }

    /**
     * @test
     */
    public function it_can_attach_all_sales_people_to_listing_type(): void
    {
        $listingType = ListingType::factory()->create();
        $salesPeople = SalesPeople::factory()->create();

        $response = $this->postJson(
            route('api.listing-types.all-sales-people.store', [
                $listingType,
                $salesPeople,
            ])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $listingType
                ->allSalesPeople()
                ->where('sales_people.id', $salesPeople->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_all_sales_people_from_listing_type(): void
    {
        $listingType = ListingType::factory()->create();
        $salesPeople = SalesPeople::factory()->create();

        $response = $this->deleteJson(
            route('api.listing-types.all-sales-people.store', [
                $listingType,
                $salesPeople,
            ])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $listingType
                ->allSalesPeople()
                ->where('sales_people.id', $salesPeople->id)
                ->exists()
        );
    }
}
