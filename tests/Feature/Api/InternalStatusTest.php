<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\InternalStatus;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InternalStatusTest extends TestCase
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
    public function it_gets_internal_statuses_list(): void
    {
        $internalStatuses = InternalStatus::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.internal-statuses.index'));

        $response->assertOk()->assertSee($internalStatuses[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_internal_status(): void
    {
        $data = InternalStatus::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.internal-statuses.store'),
            $data
        );

        unset($data['color']);

        $this->assertDatabaseHas('internal_statuses', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_internal_status(): void
    {
        $internalStatus = InternalStatus::factory()->create();

        $data = [
            'ext_code' => $this->faker->unique->text(255),
            'name' => $this->faker->name(),
            'color' => $this->faker->hexcolor,
            'sequence' => $this->faker->randomNumber(0),
        ];

        $response = $this->putJson(
            route('api.internal-statuses.update', $internalStatus),
            $data
        );

        unset($data['color']);

        $data['id'] = $internalStatus->id;

        $this->assertDatabaseHas('internal_statuses', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_internal_status(): void
    {
        $internalStatus = InternalStatus::factory()->create();

        $response = $this->deleteJson(
            route('api.internal-statuses.destroy', $internalStatus)
        );

        $this->assertModelMissing($internalStatus);

        $response->assertNoContent();
    }
}
