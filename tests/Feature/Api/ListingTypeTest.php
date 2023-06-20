<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\ListingType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingTypeTest extends TestCase
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
    public function it_gets_listing_types_list(): void
    {
        $listingTypes = ListingType::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.listing-types.index'));

        $response->assertOk()->assertSee($listingTypes[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_listing_type(): void
    {
        $data = ListingType::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.listing-types.store'), $data);

        unset($data['ext_code']);

        $this->assertDatabaseHas('listing_types', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.listing-types.update', $listingType),
            $data
        );

        unset($data['ext_code']);

        $data['id'] = $listingType->id;

        $this->assertDatabaseHas('listing_types', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_listing_type(): void
    {
        $listingType = ListingType::factory()->create();

        $response = $this->deleteJson(
            route('api.listing-types.destroy', $listingType)
        );

        $this->assertModelMissing($listingType);

        $response->assertNoContent();
    }
}
