<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\SalesRequestAppointment;

use App\Models\Listing;
use App\Models\SalesRequest;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesRequestAppointmentControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_sales_request_appointments(): void
    {
        $salesRequestAppointments = SalesRequestAppointment::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('sales-request-appointments.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.sales_request_appointments.index')
            ->assertViewHas('salesRequestAppointments');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_sales_request_appointment(): void
    {
        $response = $this->get(route('sales-request-appointments.create'));

        $response
            ->assertOk()
            ->assertViewIs('app.sales_request_appointments.create');
    }

    /**
     * @test
     */
    public function it_stores_the_sales_request_appointment(): void
    {
        $data = SalesRequestAppointment::factory()
            ->make()
            ->toArray();

        $response = $this->post(
            route('sales-request-appointments.store'),
            $data
        );

        unset($data['sales_request_id']);
        unset($data['status']);
        unset($data['signed']);
        unset($data['date_signed']);
        unset($data['signature']);

        $this->assertDatabaseHas('sales_request_appointments', $data);

        $salesRequestAppointment = SalesRequestAppointment::latest(
            'id'
        )->first();

        $response->assertRedirect(
            route('sales-request-appointments.edit', $salesRequestAppointment)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_sales_request_appointment(): void
    {
        $salesRequestAppointment = SalesRequestAppointment::factory()->create();

        $response = $this->get(
            route('sales-request-appointments.show', $salesRequestAppointment)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.sales_request_appointments.show')
            ->assertViewHas('salesRequestAppointment');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_sales_request_appointment(): void
    {
        $salesRequestAppointment = SalesRequestAppointment::factory()->create();

        $response = $this->get(
            route('sales-request-appointments.edit', $salesRequestAppointment)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.sales_request_appointments.edit')
            ->assertViewHas('salesRequestAppointment');
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

        $response = $this->put(
            route(
                'sales-request-appointments.update',
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

        $response->assertRedirect(
            route('sales-request-appointments.edit', $salesRequestAppointment)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_sales_request_appointment(): void
    {
        $salesRequestAppointment = SalesRequestAppointment::factory()->create();

        $response = $this->delete(
            route(
                'sales-request-appointments.destroy',
                $salesRequestAppointment
            )
        );

        $response->assertRedirect(route('sales-request-appointments.index'));

        $this->assertModelMissing($salesRequestAppointment);
    }
}
