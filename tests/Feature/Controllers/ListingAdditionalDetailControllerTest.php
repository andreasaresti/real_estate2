<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ListingAdditionalDetail;

use App\Models\Listing;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingAdditionalDetailControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    protected function castToJson($json)
    {
        if (is_array($json)) {
            $json = addslashes(json_encode($json));
        } elseif (is_null($json) || is_null(json_decode($json))) {
            throw new \Exception(
                'A valid JSON string was not provided for casting.'
            );
        }

        return \DB::raw("CAST('{$json}' AS JSON)");
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_listing_additional_details(): void
    {
        $listingAdditionalDetails = ListingAdditionalDetail::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('listing-additional-details.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.listing_additional_details.index')
            ->assertViewHas('listingAdditionalDetails');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_listing_additional_detail(): void
    {
        $response = $this->get(route('listing-additional-details.create'));

        $response
            ->assertOk()
            ->assertViewIs('app.listing_additional_details.create');
    }

    /**
     * @test
     */
    public function it_stores_the_listing_additional_detail(): void
    {
        $data = ListingAdditionalDetail::factory()
            ->make()
            ->toArray();

        $data['title'] = json_encode($data['title']);
        $data['value'] = json_encode($data['value']);

        $response = $this->post(
            route('listing-additional-details.store'),
            $data
        );

        $data['title'] = $this->castToJson($data['title']);
        $data['value'] = $this->castToJson($data['value']);

        $this->assertDatabaseHas('listing_additional_details', $data);

        $listingAdditionalDetail = ListingAdditionalDetail::latest(
            'id'
        )->first();

        $response->assertRedirect(
            route('listing-additional-details.edit', $listingAdditionalDetail)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_listing_additional_detail(): void
    {
        $listingAdditionalDetail = ListingAdditionalDetail::factory()->create();

        $response = $this->get(
            route('listing-additional-details.show', $listingAdditionalDetail)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.listing_additional_details.show')
            ->assertViewHas('listingAdditionalDetail');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_listing_additional_detail(): void
    {
        $listingAdditionalDetail = ListingAdditionalDetail::factory()->create();

        $response = $this->get(
            route('listing-additional-details.edit', $listingAdditionalDetail)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.listing_additional_details.edit')
            ->assertViewHas('listingAdditionalDetail');
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

        $data['title'] = json_encode($data['title']);
        $data['value'] = json_encode($data['value']);

        $response = $this->put(
            route(
                'listing-additional-details.update',
                $listingAdditionalDetail
            ),
            $data
        );

        $data['id'] = $listingAdditionalDetail->id;

        $data['title'] = $this->castToJson($data['title']);
        $data['value'] = $this->castToJson($data['value']);

        $this->assertDatabaseHas('listing_additional_details', $data);

        $response->assertRedirect(
            route('listing-additional-details.edit', $listingAdditionalDetail)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_listing_additional_detail(): void
    {
        $listingAdditionalDetail = ListingAdditionalDetail::factory()->create();

        $response = $this->delete(
            route(
                'listing-additional-details.destroy',
                $listingAdditionalDetail
            )
        );

        $response->assertRedirect(route('listing-additional-details.index'));

        $this->assertModelMissing($listingAdditionalDetail);
    }
}
