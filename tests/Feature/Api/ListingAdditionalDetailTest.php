<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ListingAdditionalDetail;

use App\Models\Listing;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingAdditionalDetailTest extends TestCase
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
    public function it_gets_listing_additional_details_list(): void
    {
        $listingAdditionalDetails = ListingAdditionalDetail::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(
            route('api.listing-additional-details.index')
        );

        $response->assertOk()->assertSee($listingAdditionalDetails[0]->title);
    }

    /**
     * @test
     */
    public function it_stores_the_listing_additional_detail(): void
    {
        $data = ListingAdditionalDetail::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.listing-additional-details.store'),
            $data
        );

        $this->assertDatabaseHas('listing_additional_details', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_listing_additional_detail(): void
    {
        $listingAdditionalDetail = ListingAdditionalDetail::factory()->create();

        $listing = Listing::factory()->create();

        $data = [
            'title' => [],
            'value' => [],
            'sequence' => $this->faker->randomNumber(0),
            'listing_id' => $listing->id,
        ];

        $response = $this->putJson(
            route(
                'api.listing-additional-details.update',
                $listingAdditionalDetail
            ),
            $data
        );

        $data['id'] = $listingAdditionalDetail->id;

        $this->assertDatabaseHas('listing_additional_details', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_listing_additional_detail(): void
    {
        $listingAdditionalDetail = ListingAdditionalDetail::factory()->create();

        $response = $this->deleteJson(
            route(
                'api.listing-additional-details.destroy',
                $listingAdditionalDetail
            )
        );

        $this->assertModelMissing($listingAdditionalDetail);

        $response->assertNoContent();
    }
}
