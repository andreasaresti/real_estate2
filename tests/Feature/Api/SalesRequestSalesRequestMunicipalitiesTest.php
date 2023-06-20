<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SalesRequest;
use App\Models\SalesRequestMunicipality;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesRequestSalesRequestMunicipalitiesTest extends TestCase
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
    public function it_gets_sales_request_sales_request_municipalities(): void
    {
        $salesRequest = SalesRequest::factory()->create();
        $salesRequestMunicipalities = SalesRequestMunicipality::factory()
            ->count(2)
            ->create([
                'salesRequest_id' => $salesRequest->id,
            ]);

        $response = $this->getJson(
            route(
                'api.sales-requests.sales-request-municipalities.index',
                $salesRequest
            )
        );

        $response->assertOk()->assertSee($salesRequestMunicipalities[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_sales_request_sales_request_municipalities(): void
    {
        $salesRequest = SalesRequest::factory()->create();
        $data = SalesRequestMunicipality::factory()
            ->make([
                'salesRequest_id' => $salesRequest->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.sales-requests.sales-request-municipalities.store',
                $salesRequest
            ),
            $data
        );

        unset($data['salesRequest_id']);
        unset($data['municipality_id']);

        $this->assertDatabaseHas('sales_request_municipalities', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $salesRequestMunicipality = SalesRequestMunicipality::latest(
            'id'
        )->first();

        $this->assertEquals(
            $salesRequest->id,
            $salesRequestMunicipality->salesRequest_id
        );
    }
}
