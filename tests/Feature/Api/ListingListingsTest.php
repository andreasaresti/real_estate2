<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Listing;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingListingsTest extends TestCase
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
    public function it_gets_listing_listings(): void
    {
        $listing = Listing::factory()->create();
        $listings = Listing::factory()
            ->count(2)
            ->create([
                'parent_id' => $listing->id,
            ]);

        $response = $this->getJson(
            route('api.listings.listings.index', $listing)
        );

        $response->assertOk()->assertSee($listings[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_listing_listings(): void
    {
        $listing = Listing::factory()->create();
        $data = Listing::factory()
            ->make([
                'parent_id' => $listing->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.listings.listings.store', $listing),
            $data
        );

        unset($data['ext_code']);
        unset($data['agent_id']);
        unset($data['include_all_feeds']);
        unset($data['popular']);

        $this->assertDatabaseHas('listings', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $listing = Listing::latest('id')->first();

        $this->assertEquals($listing->id, $listing->parent_id);
    }
}
