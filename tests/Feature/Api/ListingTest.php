<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Listing;

use App\Models\Agent;
use App\Models\Status;
use App\Models\Location;
use App\Models\Customer;
use App\Models\DeliveryTime;
use App\Models\InternalStatus;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingTest extends TestCase
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
    public function it_gets_listings_list(): void
    {
        $listings = Listing::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.listings.index'));

        $response->assertOk()->assertSee($listings[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_listing(): void
    {
        $data = Listing::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.listings.store'), $data);

        unset($data['ext_code']);
        unset($data['agent_id']);
        unset($data['include_all_feeds']);
        unset($data['popular']);

        $this->assertDatabaseHas('listings', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.listings.update', $listing),
            $data
        );

        unset($data['ext_code']);
        unset($data['agent_id']);
        unset($data['include_all_feeds']);
        unset($data['popular']);

        $data['id'] = $listing->id;

        $this->assertDatabaseHas('listings', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_listing(): void
    {
        $listing = Listing::factory()->create();

        $response = $this->deleteJson(route('api.listings.destroy', $listing));

        $this->assertModelMissing($listing);

        $response->assertNoContent();
    }
}
