<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ListingAttachment;

use App\Models\Listing;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingAttachmentControllerTest extends TestCase
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

    /**
     * @test
     */
    public function it_displays_index_view_with_listing_attachments(): void
    {
        $listingAttachments = ListingAttachment::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('listing-attachments.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.listing_attachments.index')
            ->assertViewHas('listingAttachments');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_listing_attachment(): void
    {
        $response = $this->get(route('listing-attachments.create'));

        $response->assertOk()->assertViewIs('app.listing_attachments.create');
    }

    /**
     * @test
     */
    public function it_stores_the_listing_attachment(): void
    {
        $data = ListingAttachment::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('listing-attachments.store'), $data);

        $this->assertDatabaseHas('listing_attachments', $data);

        $listingAttachment = ListingAttachment::latest('id')->first();

        $response->assertRedirect(
            route('listing-attachments.edit', $listingAttachment)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_listing_attachment(): void
    {
        $listingAttachment = ListingAttachment::factory()->create();

        $response = $this->get(
            route('listing-attachments.show', $listingAttachment)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.listing_attachments.show')
            ->assertViewHas('listingAttachment');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_listing_attachment(): void
    {
        $listingAttachment = ListingAttachment::factory()->create();

        $response = $this->get(
            route('listing-attachments.edit', $listingAttachment)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.listing_attachments.edit')
            ->assertViewHas('listingAttachment');
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

        $response = $this->put(
            route('listing-attachments.update', $listingAttachment),
            $data
        );

        $data['id'] = $listingAttachment->id;

        $this->assertDatabaseHas('listing_attachments', $data);

        $response->assertRedirect(
            route('listing-attachments.edit', $listingAttachment)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_listing_attachment(): void
    {
        $listingAttachment = ListingAttachment::factory()->create();

        $response = $this->delete(
            route('listing-attachments.destroy', $listingAttachment)
        );

        $response->assertRedirect(route('listing-attachments.index'));

        $this->assertModelMissing($listingAttachment);
    }
}
