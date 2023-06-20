<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SalesRequest;
use App\Models\SalesRequestAppointment;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesRequestSalesRequestAppointmentsTest extends TestCase
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
    public function it_gets_sales_request_sales_request_appointments(): void
    {
        $salesRequest = SalesRequest::factory()->create();
        $salesRequestAppointments = SalesRequestAppointment::factory()
            ->count(2)
            ->create([
                'sales_request_id' => $salesRequest->id,
            ]);

        $response = $this->getJson(
            route(
                'api.sales-requests.sales-request-appointments.index',
                $salesRequest
            )
        );

        $response->assertOk()->assertSee($salesRequestAppointments[0]->status);
    }

    /**
     * @test
     */
    public function it_stores_the_sales_request_sales_request_appointments(): void
    {
        $salesRequest = SalesRequest::factory()->create();
        $data = SalesRequestAppointment::factory()
            ->make([
                'sales_request_id' => $salesRequest->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.sales-requests.sales-request-appointments.store',
                $salesRequest
            ),
            $data
        );

        unset($data['sales_request_id']);
        unset($data['status']);
        unset($data['signed']);
        unset($data['date_signed']);
        unset($data['signature']);

        $this->assertDatabaseHas('sales_request_appointments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $salesRequestAppointment = SalesRequestAppointment::latest(
            'id'
        )->first();

        $this->assertEquals(
            $salesRequest->id,
            $salesRequestAppointment->sales_request_id
        );
    }
}
