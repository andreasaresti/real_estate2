<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\District;
use App\Models\SalesPeople;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DistrictAllSalesPeopleTest extends TestCase
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
    public function it_gets_district_all_sales_people(): void
    {
        $district = District::factory()->create();
        $salesPeople = SalesPeople::factory()->create();

        $district->allSalesPeople()->attach($salesPeople);

        $response = $this->getJson(
            route('api.districts.all-sales-people.index', $district)
        );

        $response->assertOk()->assertSee($salesPeople->name);
    }

    /**
     * @test
     */
    public function it_can_attach_all_sales_people_to_district(): void
    {
        $district = District::factory()->create();
        $salesPeople = SalesPeople::factory()->create();

        $response = $this->postJson(
            route('api.districts.all-sales-people.store', [
                $district,
                $salesPeople,
            ])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $district
                ->allSalesPeople()
                ->where('sales_people.id', $salesPeople->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_all_sales_people_from_district(): void
    {
        $district = District::factory()->create();
        $salesPeople = SalesPeople::factory()->create();

        $response = $this->deleteJson(
            route('api.districts.all-sales-people.store', [
                $district,
                $salesPeople,
            ])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $district
                ->allSalesPeople()
                ->where('sales_people.id', $salesPeople->id)
                ->exists()
        );
    }
}
