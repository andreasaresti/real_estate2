<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Listing;
use App\Models\SalesRequestAppointment;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListingSalesRequestAppointmentsTest extends TestCase
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
    public function it_gets_listing_sales_request_appointments(): void
    {
        $listing = Listing::factory()->create();
        $salesRequestAppointments = SalesRequestAppointment::factory()
            ->count(2)
            ->create([
                'listing_id' => $listing->id,
            ]);

        $response = $this->getJson(
            route('api.listings.sales-request-appointments.index', $listing)
        );

        $response->assertOk()->assertSee($salesRequestAppointments[0]->status);
    }

    /**
     * @test
     */
    public function it_stores_the_listing_sales_request_appointments(): void
    {
        $listing = Listing::factory()->create();
        $data = SalesRequestAppointment::factory()
            ->make([
                'listing_id' => $listing->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.listings.sales-request-appointments.store', $listing),
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

        $this->assertEquals($listing->id, $salesRequestAppointment->listing_id);
    }
}
