<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\District;
use App\Models\SalesRequestDistrict;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DistrictSalesRequestDistrictsTest extends TestCase
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
    public function it_gets_district_sales_request_districts(): void
    {
        $district = District::factory()->create();
        $salesRequestDistricts = SalesRequestDistrict::factory()
            ->count(2)
            ->create([
                'district_id' => $district->id,
            ]);

        $response = $this->getJson(
            route('api.districts.sales-request-districts.index', $district)
        );

        $response->assertOk()->assertSee($salesRequestDistricts[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_district_sales_request_districts(): void
    {
        $district = District::factory()->create();
        $data = SalesRequestDistrict::factory()
            ->make([
                'district_id' => $district->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.districts.sales-request-districts.store', $district),
            $data
        );

        unset($data['salesRequest_id']);
        unset($data['district_id']);

        $this->assertDatabaseHas('sales_request_districts', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $salesRequestDistrict = SalesRequestDistrict::latest('id')->first();

        $this->assertEquals($district->id, $salesRequestDistrict->district_id);
    }
}
