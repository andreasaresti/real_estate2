<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Customer;
use App\Models\FavoriteProperty;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerFavoritePropertiesTest extends TestCase
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
    public function it_gets_customer_favorite_properties(): void
    {
        $customer = Customer::factory()->create();
        $favoriteProperties = FavoriteProperty::factory()
            ->count(2)
            ->create([
                'customer_id' => $customer->id,
            ]);

        $response = $this->getJson(
            route('api.customers.favorite-properties.index', $customer)
        );

        $response->assertOk()->assertSee($favoriteProperties[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_customer_favorite_properties(): void
    {
        $customer = Customer::factory()->create();
        $data = FavoriteProperty::factory()
            ->make([
                'customer_id' => $customer->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.customers.favorite-properties.store', $customer),
            $data
        );

        $this->assertDatabaseHas('favorite_properties', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $favoriteProperty = FavoriteProperty::latest('id')->first();

        $this->assertEquals($customer->id, $favoriteProperty->customer_id);
    }
}
