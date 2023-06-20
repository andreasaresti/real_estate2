<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Feature;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FeatureTest extends TestCase
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
    public function it_gets_features_list(): void
    {
        $features = Feature::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.features.index'));

        $response->assertOk()->assertSee($features[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_feature(): void
    {
        $data = Feature::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.features.store'), $data);

        $this->assertDatabaseHas('features', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_feature(): void
    {
        $feature = Feature::factory()->create();

        $data = [
            'ext_code' => $this->faker->unique->text(255),
            'name' => [],
            'sequence' => $this->faker->randomNumber(0),
        ];

        $response = $this->putJson(
            route('api.features.update', $feature),
            $data
        );

        $data['id'] = $feature->id;

        $this->assertDatabaseHas('features', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_feature(): void
    {
        $feature = Feature::factory()->create();

        $response = $this->deleteJson(route('api.features.destroy', $feature));

        $this->assertModelMissing($feature);

        $response->assertNoContent();
    }
}
