<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Marketplace;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MarketplaceTest extends TestCase
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
    public function it_gets_marketplaces_list(): void
    {
        $marketplaces = Marketplace::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.marketplaces.index'));

        $response->assertOk()->assertSee($marketplaces[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_marketplace(): void
    {
        $data = Marketplace::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.marketplaces.store'), $data);

        $this->assertDatabaseHas('marketplaces', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_marketplace(): void
    {
        $marketplace = Marketplace::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'active' => $this->faker->boolean,
        ];

        $response = $this->putJson(
            route('api.marketplaces.update', $marketplace),
            $data
        );

        $data['id'] = $marketplace->id;

        $this->assertDatabaseHas('marketplaces', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_marketplace(): void
    {
        $marketplace = Marketplace::factory()->create();

        $response = $this->deleteJson(
            route('api.marketplaces.destroy', $marketplace)
        );

        $this->assertModelMissing($marketplace);

        $response->assertNoContent();
    }
}
