<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\FavoriteProperty;

use App\Models\Listing;
use App\Models\Customer;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FavoritePropertyTest extends TestCase
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
    public function it_gets_favorite_properties_list(): void
    {
        $favoriteProperties = FavoriteProperty::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.favorite-properties.index'));

        $response->assertOk()->assertSee($favoriteProperties[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_favorite_property(): void
    {
        $data = FavoriteProperty::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.favorite-properties.store'),
            $data
        );

        $this->assertDatabaseHas('favorite_properties', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_favorite_property(): void
    {
        $favoriteProperty = FavoriteProperty::factory()->create();

        $customer = Customer::factory()->create();
        $listing = Listing::factory()->create();

        $data = [
            'customer_id' => $customer->id,
            'listing_id' => $listing->id,
        ];

        $response = $this->putJson(
            route('api.favorite-properties.update', $favoriteProperty),
            $data
        );

        $data['id'] = $favoriteProperty->id;

        $this->assertDatabaseHas('favorite_properties', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_favorite_property(): void
    {
        $favoriteProperty = FavoriteProperty::factory()->create();

        $response = $this->deleteJson(
            route('api.favorite-properties.destroy', $favoriteProperty)
        );

        $this->assertModelMissing($favoriteProperty);

        $response->assertNoContent();
    }
}
