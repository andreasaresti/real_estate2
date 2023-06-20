<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Marketplace;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MarketplaceControllerTest extends TestCase
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
    public function it_displays_index_view_with_marketplaces(): void
    {
        $marketplaces = Marketplace::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('marketplaces.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.marketplaces.index')
            ->assertViewHas('marketplaces');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_marketplace(): void
    {
        $response = $this->get(route('marketplaces.create'));

        $response->assertOk()->assertViewIs('app.marketplaces.create');
    }

    /**
     * @test
     */
    public function it_stores_the_marketplace(): void
    {
        $data = Marketplace::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('marketplaces.store'), $data);

        $this->assertDatabaseHas('marketplaces', $data);

        $marketplace = Marketplace::latest('id')->first();

        $response->assertRedirect(route('marketplaces.edit', $marketplace));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_marketplace(): void
    {
        $marketplace = Marketplace::factory()->create();

        $response = $this->get(route('marketplaces.show', $marketplace));

        $response
            ->assertOk()
            ->assertViewIs('app.marketplaces.show')
            ->assertViewHas('marketplace');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_marketplace(): void
    {
        $marketplace = Marketplace::factory()->create();

        $response = $this->get(route('marketplaces.edit', $marketplace));

        $response
            ->assertOk()
            ->assertViewIs('app.marketplaces.edit')
            ->assertViewHas('marketplace');
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

        $response = $this->put(
            route('marketplaces.update', $marketplace),
            $data
        );

        $data['id'] = $marketplace->id;

        $this->assertDatabaseHas('marketplaces', $data);

        $response->assertRedirect(route('marketplaces.edit', $marketplace));
    }

    /**
     * @test
     */
    public function it_deletes_the_marketplace(): void
    {
        $marketplace = Marketplace::factory()->create();

        $response = $this->delete(route('marketplaces.destroy', $marketplace));

        $response->assertRedirect(route('marketplaces.index'));

        $this->assertModelMissing($marketplace);
    }
}
