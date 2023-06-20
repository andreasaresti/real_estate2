<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SalesRequest;
use App\Models\SalesRequestDistrict;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesRequestSalesRequestDistrictsTest extends TestCase
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
    public function it_gets_sales_request_sales_request_districts(): void
    {
        $salesRequest = SalesRequest::factory()->create();
        $salesRequestDistricts = SalesRequestDistrict::factory()
            ->count(2)
            ->create([
                'salesRequest_id' => $salesRequest->id,
            ]);

        $response = $this->getJson(
            route(
                'api.sales-requests.sales-request-districts.index',
                $salesRequest
            )
        );

        $response->assertOk()->assertSee($salesRequestDistricts[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_sales_request_sales_request_districts(): void
    {
        $salesRequest = SalesRequest::factory()->create();
        $data = SalesRequestDistrict::factory()
            ->make([
                'salesRequest_id' => $salesRequest->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.sales-requests.sales-request-districts.store',
                $salesRequest
            ),
            $data
        );

        unset($data['salesRequest_id']);
        unset($data['district_id']);

        $this->assertDatabaseHas('sales_request_districts', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $salesRequestDistrict = SalesRequestDistrict::latest('id')->first();

        $this->assertEquals(
            $salesRequest->id,
            $salesRequestDistrict->salesRequest_id
        );
    }
}
