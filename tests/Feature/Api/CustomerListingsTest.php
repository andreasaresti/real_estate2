<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Listing;
use App\Models\Customer;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerListingsTest extends TestCase
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
    public function it_gets_customer_listings(): void
    {
        $customer = Customer::factory()->create();
        $listings = Listing::factory()
            ->count(2)
            ->create([
                'owner_id' => $customer->id,
            ]);

        $response = $this->getJson(
            route('api.customers.listings.index', $customer)
        );

        $response->assertOk()->assertSee($listings[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_customer_listings(): void
    {
        $customer = Customer::factory()->create();
        $data = Listing::factory()
            ->make([
                'owner_id' => $customer->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.customers.listings.store', $customer),
            $data
        );

        unset($data['ext_code']);
        unset($data['agent_id']);
        unset($data['export_all_marketplaces']);
        unset($data['popular']);

        $this->assertDatabaseHas('listings', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $listing = Listing::latest('id')->first();

        $this->assertEquals($customer->id, $listing->owner_id);
    }
}
