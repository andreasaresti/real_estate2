<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\District;
use App\Models\SalesPeople;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesPeopleDistrictsTest extends TestCase
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
    public function it_gets_sales_people_districts(): void
    {
        $salesPeople = SalesPeople::factory()->create();
        $district = District::factory()->create();

        $salesPeople->districts()->attach($district);

        $response = $this->getJson(
            route('api.all-sales-people.districts.index', $salesPeople)
        );

        $response->assertOk()->assertSee($district->name);
    }

    /**
     * @test
     */
    public function it_can_attach_districts_to_sales_people(): void
    {
        $salesPeople = SalesPeople::factory()->create();
        $district = District::factory()->create();

        $response = $this->postJson(
            route('api.all-sales-people.districts.store', [
                $salesPeople,
                $district,
            ])
        );

        $response->assertNoContent();

        $this->assertTrue(
            $salesPeople
                ->districts()
                ->where('districts.id', $district->id)
                ->exists()
        );
    }

    /**
     * @test
     */
    public function it_can_detach_districts_from_sales_people(): void
    {
        $salesPeople = SalesPeople::factory()->create();
        $district = District::factory()->create();

        $response = $this->deleteJson(
            route('api.all-sales-people.districts.store', [
                $salesPeople,
                $district,
            ])
        );

        $response->assertNoContent();

        $this->assertFalse(
            $salesPeople
                ->districts()
                ->where('districts.id', $district->id)
                ->exists()
        );
    }
}
