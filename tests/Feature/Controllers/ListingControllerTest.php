<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Listing;

use App\Models\Agent;
use App\Models\Status;
use App\Models\Location;
use App\Models\Customer;
use App\Models\DeliveryTime;
use App\Models\InternalStatus;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingControllerTest extends TestCase
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
    public function it_displays_index_view_with_listings(): void
    {
        $listings = Listing::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('listings.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.listings.index')
            ->assertViewHas('listings');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_listing(): void
    {
        $response = $this->get(route('listings.create'));

        $response->assertOk()->assertViewIs('app.listings.create');
    }

    /**
     * @test
     */
    public function it_stores_the_listing(): void
    {
        $data = Listing::factory()
            ->make()
            ->toArray();

        $data['name'] = json_encode($data['name']);
        $data['description'] = json_encode($data['description']);

        $response = $this->post(route('listings.store'), $data);

        unset($data['ext_code']);
        unset($data['agent_id']);
        unset($data['include_all_feeds']);
        unset($data['popular']);

        $data['name'] = $this->castToJson($data['name']);
        $data['description'] = $this->castToJson($data['description']);

        $this->assertDatabaseHas('listings', $data);

        $listing = Listing::latest('id')->first();

        $response->assertRedirect(route('listings.edit', $listing));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_listing(): void
    {
        $listing = Listing::factory()->create();

        $response = $this->get(route('listings.show', $listing));

        $response
            ->assertOk()
            ->assertViewIs('app.listings.show')
            ->assertViewHas('listing');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_listing(): void
    {
        $listing = Listing::factory()->create();

        $response = $this->get(route('listings.edit', $listing));

        $response
            ->assertOk()
            ->assertViewIs('app.listings.edit')
            ->assertViewHas('listing');
    }

    /**
     * @test
     */
    public function it_updates_the_listing(): void
    {
        $listing = Listing::factory()->create();

        $listing = Listing::factory()->create();
        $location = Location::factory()->create();
        $status = Status::factory()->create();
        $deliveryTime = DeliveryTime::factory()->create();
        $internalStatus = InternalStatus::factory()->create();
        $customer = Customer::factory()->create();
        $agent = Agent::factory()->create();

        $data = [
            'ext_code' => $this->faker->unique->text(255),
            'name' => [],
            'description' => [],
            'price' => $this->faker->randomNumber(2),
            'old_price' => $this->faker->randomNumber(2),
            'price_prefix' => $this->faker->text(255),
            'price_postfix' => $this->faker->text(255),
            'area_size' => $this->faker->randomNumber(0),
            'area_size_prefix' => $this->faker->text(255),
            'area_size_postfix' => $this->faker->text(255),
            'number_of_bedrooms' => $this->faker->randomNumber(0),
            'number_of_bathrooms' => $this->faker->randomNumber(0),
            'number_of_garages_or_parkingpaces' => $this->faker->randomNumber(
                0
            ),
            'year_built' => $this->faker->randomNumber(0),
            'featured' => $this->faker->boolean,
            'address' => $this->faker->address,
            'latitude' => $this->faker->text(255),
            'longitude' => $this->faker->text(255),
            '360_virtual_tour' => $this->faker->text,
            'energy_class' => $this->faker->text(255),
            'energy_performance' => $this->faker->text(255),
            'epc_current_rating' => $this->faker->text(255),
            'epc_potential_rating' => $this->faker->text(255),
            'taxes' => $this->faker->text(255),
            'published' => $this->faker->boolean,
            'dues' => $this->faker->text(255),
            'notes' => $this->faker->text,
            'include_all_feeds' => $this->faker->boolean,
            'popular' => $this->faker->boolean,
            'parent_id' => $listing->id,
            'location_id' => $location->id,
            'status_id' => $status->id,
            'delivery_time_id' => $deliveryTime->id,
            'internal_status_id' => $internalStatus->id,
            'owner_id' => $customer->id,
            'agent_id' => $agent->id,
        ];

        $data['name'] = json_encode($data['name']);
        $data['description'] = json_encode($data['description']);

        $response = $this->put(route('listings.update', $listing), $data);

        unset($data['ext_code']);
        unset($data['agent_id']);
        unset($data['include_all_feeds']);
        unset($data['popular']);

        $data['id'] = $listing->id;

        $data['name'] = $this->castToJson($data['name']);
        $data['description'] = $this->castToJson($data['description']);

        $this->assertDatabaseHas('listings', $data);

        $response->assertRedirect(route('listings.edit', $listing));
    }

    /**
     * @test
     */
    public function it_deletes_the_listing(): void
    {
        $listing = Listing::factory()->create();

        $response = $this->delete(route('listings.destroy', $listing));

        $response->assertRedirect(route('listings.index'));

        $this->assertModelMissing($listing);
    }
}
