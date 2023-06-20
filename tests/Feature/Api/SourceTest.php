<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Source;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SourceTest extends TestCase
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
    public function it_gets_sources_list(): void
    {
        $sources = Source::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.sources.index'));

        $response->assertOk()->assertSee($sources[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_source(): void
    {
        $data = Source::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.sources.store'), $data);

        $this->assertDatabaseHas('sources', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_source(): void
    {
        $source = Source::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'website' => $this->faker->text(255),
            'sequence' => $this->faker->randomNumber(0),
        ];

        $response = $this->putJson(route('api.sources.update', $source), $data);

        $data['id'] = $source->id;

        $this->assertDatabaseHas('sources', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_source(): void
    {
        $source = Source::factory()->create();

        $response = $this->deleteJson(route('api.sources.destroy', $source));

        $this->assertModelMissing($source);

        $response->assertNoContent();
    }
}
