<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Listing;
use App\Models\ListingAttachment;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingListingAttachmentsTest extends TestCase
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
    public function it_gets_listing_listing_attachments(): void
    {
        $listing = Listing::factory()->create();
        $listingAttachments = ListingAttachment::factory()
            ->count(2)
            ->create([
                'listing_id' => $listing->id,
            ]);

        $response = $this->getJson(
            route('api.listings.listing-attachments.index', $listing)
        );

        $response->assertOk()->assertSee($listingAttachments[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_listing_listing_attachments(): void
    {
        $listing = Listing::factory()->create();
        $data = ListingAttachment::factory()
            ->make([
                'listing_id' => $listing->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.listings.listing-attachments.store', $listing),
            $data
        );

        $this->assertDatabaseHas('listing_attachments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $listingAttachment = ListingAttachment::latest('id')->first();

        $this->assertEquals($listing->id, $listingAttachment->listing_id);
    }
}
