<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ListingAttachment;

use App\Models\Listing;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingAttachmentTest extends TestCase
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
    public function it_gets_listing_attachments_list(): void
    {
        $listingAttachments = ListingAttachment::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.listing-attachments.index'));

        $response->assertOk()->assertSee($listingAttachments[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_listing_attachment(): void
    {
        $data = ListingAttachment::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.listing-attachments.store'),
            $data
        );

        $this->assertDatabaseHas('listing_attachments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_listing_attachment(): void
    {
        $listingAttachment = ListingAttachment::factory()->create();

        $listing = Listing::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'attachment' => $this->faker->text(255),
            'listing_id' => $listing->id,
        ];

        $response = $this->putJson(
            route('api.listing-attachments.update', $listingAttachment),
            $data
        );

        $data['id'] = $listingAttachment->id;

        $this->assertDatabaseHas('listing_attachments', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_listing_attachment(): void
    {
        $listingAttachment = ListingAttachment::factory()->create();

        $response = $this->deleteJson(
            route('api.listing-attachments.destroy', $listingAttachment)
        );

        $this->assertModelMissing($listingAttachment);

        $response->assertNoContent();
    }
}
