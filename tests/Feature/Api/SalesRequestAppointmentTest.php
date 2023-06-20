<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SalesRequestAppointment;

use App\Models\Listing;
use App\Models\SalesRequest;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesRequestAppointmentTest extends TestCase
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
    public function it_gets_sales_request_appointments_list(): void
    {
        $salesRequestAppointments = SalesRequestAppointment::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(
            route('api.sales-request-appointments.index')
        );

        $response->assertOk()->assertSee($salesRequestAppointments[0]->status);
    }

    /**
     * @test
     */
    public function it_stores_the_sales_request_appointment(): void
    {
        $data = SalesRequestAppointment::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.sales-request-appointments.store'),
            $data
        );

        unset($data['sales_request_id']);
        unset($data['status']);
        unset($data['signed']);
        unset($data['date_signed']);
        unset($data['signature']);

        $this->assertDatabaseHas('sales_request_appointments', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_sales_request_appointment(): void
    {
        $salesRequestAppointment = SalesRequestAppointment::factory()->create();

        $listing = Listing::factory()->create();
        $salesRequest = SalesRequest::factory()->create();

        $data = [
            'date' => $this->faker->dateTime,
            'status' => $this->faker->word,
            'signed' => $this->faker->boolean,
            'date_signed' => $this->faker->dateTime,
            'signature' => $this->faker->text(255),
            'listing_id' => $listing->id,
            'sales_request_id' => $salesRequest->id,
        ];

        $response = $this->putJson(
            route(
                'api.sales-request-appointments.update',
                $salesRequestAppointment
            ),
            $data
        );

        unset($data['sales_request_id']);
        unset($data['status']);
        unset($data['signed']);
        unset($data['date_signed']);
        unset($data['signature']);

        $data['id'] = $salesRequestAppointment->id;

        $this->assertDatabaseHas('sales_request_appointments', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_sales_request_appointment(): void
    {
        $salesRequestAppointment = SalesRequestAppointment::factory()->create();

        $response = $this->deleteJson(
            route(
                'api.sales-request-appointments.destroy',
                $salesRequestAppointment
            )
        );

        $this->assertModelMissing($salesRequestAppointment);

        $response->assertNoContent();
    }
}
