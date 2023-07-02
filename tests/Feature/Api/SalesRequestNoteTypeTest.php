<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SalesRequestNoteType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesRequestNoteTypeTest extends TestCase
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
    public function it_gets_sales_request_note_types_list(): void
    {
        $salesRequestNoteTypes = SalesRequestNoteType::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.sales-request-note-types.index'));

        $response->assertOk()->assertSee($salesRequestNoteTypes[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_sales_request_note_type(): void
    {
        $data = SalesRequestNoteType::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.sales-request-note-types.store'),
            $data
        );

        $this->assertDatabaseHas('sales_request_note_types', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_sales_request_note_type(): void
    {
        $salesRequestNoteType = SalesRequestNoteType::factory()->create();

        $data = [
            'name' => $this->faker->name(),
        ];

        $response = $this->putJson(
            route('api.sales-request-note-types.update', $salesRequestNoteType),
            $data
        );

        $data['id'] = $salesRequestNoteType->id;

        $this->assertDatabaseHas('sales_request_note_types', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_sales_request_note_type(): void
    {
        $salesRequestNoteType = SalesRequestNoteType::factory()->create();

        $response = $this->deleteJson(
            route('api.sales-request-note-types.destroy', $salesRequestNoteType)
        );

        $this->assertModelMissing($salesRequestNoteType);

        $response->assertNoContent();
    }
}
