<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ListingType;
use App\Models\SalesRequestListingType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingTypeSalesRequestListingTypesTest extends TestCase
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
    public function it_gets_listing_type_sales_request_listing_types(): void
    {
        $listingType = ListingType::factory()->create();
        $salesRequestListingTypes = SalesRequestListingType::factory()
            ->count(2)
            ->create([
                'listing_type_id' => $listingType->id,
            ]);

        $response = $this->getJson(
            route(
                'api.listing-types.sales-request-listing-types.index',
                $listingType
            )
        );

        $response->assertOk()->assertSee($salesRequestListingTypes[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_listing_type_sales_request_listing_types(): void
    {
        $listingType = ListingType::factory()->create();
        $data = SalesRequestListingType::factory()
            ->make([
                'listing_type_id' => $listingType->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.listing-types.sales-request-listing-types.store',
                $listingType
            ),
            $data
        );

        unset($data['sales_request_id']);
        unset($data['listing_type_id']);

        $this->assertDatabaseHas('sales_request_listing_types', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $salesRequestListingType = SalesRequestListingType::latest(
            'id'
        )->first();

        $this->assertEquals(
            $listingType->id,
            $salesRequestListingType->listing_type_id
        );
    }
}
