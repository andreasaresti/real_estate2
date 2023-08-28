<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Listing;
use App\Models\DeliveryTime;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeliveryTimeListingsTest extends TestCase
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
    public function it_gets_delivery_time_listings(): void
    {
        $deliveryTime = DeliveryTime::factory()->create();
        $listings = Listing::factory()
            ->count(2)
            ->create([
                'delivery_time_id' => $deliveryTime->id,
            ]);

        $response = $this->getJson(
            route('api.delivery-times.listings.index', $deliveryTime)
        );

        $response->assertOk()->assertSee($listings[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_delivery_time_listings(): void
    {
        $deliveryTime = DeliveryTime::factory()->create();
        $data = Listing::factory()
            ->make([
                'delivery_time_id' => $deliveryTime->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.delivery-times.listings.store', $deliveryTime),
            $data
        );

        unset($data['ext_code']);
        unset($data['agent_id']);
        unset($data['include_all_feeds']);
        unset($data['popular']);

        $this->assertDatabaseHas('listings', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $listing = Listing::latest('id')->first();

        $this->assertEquals($deliveryTime->id, $listing->delivery_time_id);
    }
}
