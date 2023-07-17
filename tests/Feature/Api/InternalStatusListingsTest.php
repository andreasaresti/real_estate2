<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Listing;
use App\Models\InternalStatus;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InternalStatusListingsTest extends TestCase
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
    public function it_gets_internal_status_listings(): void
    {
        $internalStatus = InternalStatus::factory()->create();
        $listings = Listing::factory()
            ->count(2)
            ->create([
                'internal_status_id' => $internalStatus->id,
            ]);

        $response = $this->getJson(
            route('api.internal-statuses.listings.index', $internalStatus)
        );

        $response->assertOk()->assertSee($listings[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_internal_status_listings(): void
    {
        $internalStatus = InternalStatus::factory()->create();
        $data = Listing::factory()
            ->make([
                'internal_status_id' => $internalStatus->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.internal-statuses.listings.store', $internalStatus),
            $data
        );

        unset($data['ext_code']);
        unset($data['agent_id']);
        unset($data['export_all_marketplaces']);
        unset($data['popular']);

        $this->assertDatabaseHas('listings', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $listing = Listing::latest('id')->first();

        $this->assertEquals($internalStatus->id, $listing->internal_status_id);
    }
}
