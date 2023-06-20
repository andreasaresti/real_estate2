<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SalesPeople;
use App\Models\ListingType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesPeopleListingTypesTest extends TestCase
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
    public function it_gets_sales_people_listing_types(): void
    {
        $salesPeople = SalesPeople::factory()->create();
        $listingType = ListingType::factory()->create();

        $salesPeople->listingTypes()->attach($listingType);

        $response = $this->getJson(
            route('api.all-sales-people.listing-types.index', $salesPeople)
        );

        $response->assertOk()->assertSee($listingType->name);
    }

    /**
     * @test
     */
    public function it_can_attach_listing_types_to_sales_people(): void
    {
        $salesPeople = SalesPeople::factory()->create();
        $listingType = ListingType::factory()->create();

        $response = $this->postJson(
            route('api.all-sales-people.listing-types.store', [
                $salesPeople,
                $listingType,
            ])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $salesPeople
                ->listingTypes()
                ->where('listing_types.id', $listingType->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_listing_types_from_sales_people(): void
    {
        $salesPeople = SalesPeople::factory()->create();
        $listingType = ListingType::factory()->create();

        $response = $this->deleteJson(
            route('api.all-sales-people.listing-types.store', [
                $salesPeople,
                $listingType,
            ])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $salesPeople
                ->listingTypes()
                ->where('listing_types.id', $listingType->id)
                ->exists()
        );
    }
}
