<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\ListingType;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingTypeControllerTest extends TestCase
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
    public function it_displays_index_view_with_listing_types(): void
    {
        $listingTypes = ListingType::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('listing-types.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.listing_types.index')
            ->assertViewHas('listingTypes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_listing_type(): void
    {
        $response = $this->get(route('listing-types.create'));

        $response->assertOk()->assertViewIs('app.listing_types.create');
    }

    /**
     * @test
     */
    public function it_stores_the_listing_type(): void
    {
        $data = ListingType::factory()
            ->make()
            ->toArray();

        $data['name'] = json_encode($data['name']);

        $response = $this->post(route('listing-types.store'), $data);

        unset($data['ext_code']);

        $data['name'] = $this->castToJson($data['name']);

        $this->assertDatabaseHas('listing_types', $data);

        $listingType = ListingType::latest('id')->first();

        $response->assertRedirect(route('listing-types.edit', $listingType));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_listing_type(): void
    {
        $listingType = ListingType::factory()->create();

        $response = $this->get(route('listing-types.show', $listingType));

        $response
            ->assertOk()
            ->assertViewIs('app.listing_types.show')
            ->assertViewHas('listingType');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_listing_type(): void
    {
        $listingType = ListingType::factory()->create();

        $response = $this->get(route('listing-types.edit', $listingType));

        $response
            ->assertOk()
            ->assertViewIs('app.listing_types.edit')
            ->assertViewHas('listingType');
    }

    /**
     * @test
     */
    public function it_updates_the_listing_type(): void
    {
        $listingType = ListingType::factory()->create();

        $data = [
            'ext_code' => $this->faker->unique->text(255),
            'name' => [],
            'sequence' => $this->faker->randomNumber(0),
        ];

        $data['name'] = json_encode($data['name']);

        $response = $this->put(
            route('listing-types.update', $listingType),
            $data
        );

        unset($data['ext_code']);

        $data['id'] = $listingType->id;

        $data['name'] = $this->castToJson($data['name']);

        $this->assertDatabaseHas('listing_types', $data);

        $response->assertRedirect(route('listing-types.edit', $listingType));
    }

    /**
     * @test
     */
    public function it_deletes_the_listing_type(): void
    {
        $listingType = ListingType::factory()->create();

        $response = $this->delete(route('listing-types.destroy', $listingType));

        $response->assertRedirect(route('listing-types.index'));

        $this->assertModelMissing($listingType);
    }
}
