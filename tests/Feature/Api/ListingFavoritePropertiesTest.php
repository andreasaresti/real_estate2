<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Listing;
use App\Models\FavoriteProperty;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingFavoritePropertiesTest extends TestCase
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
    public function it_gets_listing_favorite_properties(): void
    {
        $listing = Listing::factory()->create();
        $favoriteProperties = FavoriteProperty::factory()
            ->count(2)
            ->create([
                'listing_id' => $listing->id,
            ]);

        $response = $this->getJson(
            route('api.listings.favorite-properties.index', $listing)
        );

        $response->assertOk()->assertSee($favoriteProperties[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_listing_favorite_properties(): void
    {
        $listing = Listing::factory()->create();
        $data = FavoriteProperty::factory()
            ->make([
                'listing_id' => $listing->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.listings.favorite-properties.store', $listing),
            $data
        );

        $this->assertDatabaseHas('favorite_properties', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $favoriteProperty = FavoriteProperty::latest('id')->first();

        $this->assertEquals($listing->id, $favoriteProperty->listing_id);
    }
}
