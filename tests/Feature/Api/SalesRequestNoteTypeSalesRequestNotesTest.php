<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SalesRequestNote;
use App\Models\SalesRequestNoteType;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesRequestNoteTypeSalesRequestNoteTest extends TestCase
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
    public function it_gets_sales_request_note_type_sales_request_notes(): void
    {
        $salesRequestNoteType = SalesRequestNoteType::factory()->create();
        $SalesRequestNote = SalesRequestNote::factory()
            ->count(2)
            ->create([
                'sales_request_note_type_id' => $salesRequestNoteType->id,
            ]);

        $response = $this->getJson(
            route(
                'api.sales-request-note-types.sales-request-notes.index',
                $salesRequestNoteType
            )
        );

        $response->assertOk()->assertSee($SalesRequestNote[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_sales_request_note_type_sales_request_notes(): void
    {
        $salesRequestNoteType = SalesRequestNoteType::factory()->create();
        $data = SalesRequestNote::factory()
            ->make([
                'sales_request_note_type_id' => $salesRequestNoteType->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.sales-request-note-types.sales-request-notes.store',
                $salesRequestNoteType
            ),
            $data
        );

        unset($data['sales_request_id']);
        unset($data['sales_request_note_type_id']);
        unset($data['description']);

        $this->assertDatabaseHas('sales_request_notes', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $salesRequestNote = SalesRequestNote::latest('id')->first();

        $this->assertEquals(
            $salesRequestNoteType->id,
            $salesRequestNote->sales_request_note_type_id
        );
    }
}
