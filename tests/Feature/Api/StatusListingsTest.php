<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Status;
use App\Models\Listing;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusListingsTest extends TestCase
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
    public function it_gets_status_listings(): void
    {
        $status = Status::factory()->create();
        $listings = Listing::factory()
            ->count(2)
            ->create([
                'status_id' => $status->id,
            ]);

        $response = $this->getJson(
            route('api.statuses.listings.index', $status)
        );

        $response->assertOk()->assertSee($listings[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_status_listings(): void
    {
        $status = Status::factory()->create();
        $data = Listing::factory()
            ->make([
                'status_id' => $status->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.statuses.listings.store', $status),
            $data
        );

        unset($data['ext_code']);
        unset($data['agent_id']);
        unset($data['include_all_feeds']);
        unset($data['popular']);

        $this->assertDatabaseHas('listings', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $listing = Listing::latest('id')->first();

        $this->assertEquals($status->id, $listing->status_id);
    }
}
