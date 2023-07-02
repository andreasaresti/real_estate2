<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\FavoriteProperty;

use App\Models\Listing;
use App\Models\Customer;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FavoritePropertyControllerTest extends TestCase
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
    public function it_displays_index_view_with_favorite_properties(): void
    {
        $favoriteProperties = FavoriteProperty::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('favorite-properties.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.favorite_properties.index')
            ->assertViewHas('favoriteProperties');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_favorite_property(): void
    {
        $response = $this->get(route('favorite-properties.create'));

        $response->assertOk()->assertViewIs('app.favorite_properties.create');
    }

    /**
     * @test
     */
    public function it_stores_the_favorite_property(): void
    {
        $data = FavoriteProperty::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('favorite-properties.store'), $data);

        $this->assertDatabaseHas('favorite_properties', $data);

        $favoriteProperty = FavoriteProperty::latest('id')->first();

        $response->assertRedirect(
            route('favorite-properties.edit', $favoriteProperty)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_favorite_property(): void
    {
        $favoriteProperty = FavoriteProperty::factory()->create();

        $response = $this->get(
            route('favorite-properties.show', $favoriteProperty)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.favorite_properties.show')
            ->assertViewHas('favoriteProperty');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_favorite_property(): void
    {
        $favoriteProperty = FavoriteProperty::factory()->create();

        $response = $this->get(
            route('favorite-properties.edit', $favoriteProperty)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.favorite_properties.edit')
            ->assertViewHas('favoriteProperty');
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

        $response = $this->put(
            route('favorite-properties.update', $favoriteProperty),
            $data
        );

        $data['id'] = $favoriteProperty->id;

        $this->assertDatabaseHas('favorite_properties', $data);

        $response->assertRedirect(
            route('favorite-properties.edit', $favoriteProperty)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_favorite_property(): void
    {
        $favoriteProperty = FavoriteProperty::factory()->create();

        $response = $this->delete(
            route('favorite-properties.destroy', $favoriteProperty)
        );

        $response->assertRedirect(route('favorite-properties.index'));

        $this->assertModelMissing($favoriteProperty);
    }
}
