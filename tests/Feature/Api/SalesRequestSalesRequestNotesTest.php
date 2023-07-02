<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SalesRequest;
use App\Models\SalesRequestNote;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesRequestSalesRequestNoteTest extends TestCase
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
    public function it_gets_sales_request_sales_request_notes(): void
    {
        $salesRequest = SalesRequest::factory()->create();
        $SalesRequestNote = SalesRequestNote::factory()
            ->count(2)
            ->create([
                'sales_request_id' => $salesRequest->id,
            ]);

        $response = $this->getJson(
            route('api.sales-requests.sales-request-notes.index', $salesRequest)
        );

        $response->assertOk()->assertSee($SalesRequestNote[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_sales_request_sales_request_notes(): void
    {
        $salesRequest = SalesRequest::factory()->create();
        $data = SalesRequestNote::factory()
            ->make([
                'sales_request_id' => $salesRequest->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.sales-requests.sales-request-notes.store',
                $salesRequest
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
            $salesRequest->id,
            $salesRequestNote->sales_request_id
        );
    }
}
