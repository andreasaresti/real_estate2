<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\District;
use App\Models\CustomerAgreement;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DistrictCustomerAgreementsTest extends TestCase
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
    public function it_gets_district_customer_agreements(): void
    {
        $district = District::factory()->create();
        $customerAgreements = CustomerAgreement::factory()
            ->count(2)
            ->create([
                'district_id' => $district->id,
            ]);

        $response = $this->getJson(
            route('api.districts.customer-agreements.index', $district)
        );

        $response->assertOk()->assertSee($customerAgreements[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_district_customer_agreements(): void
    {
        $district = District::factory()->create();
        $data = CustomerAgreement::factory()
            ->make([
                'district_id' => $district->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.districts.customer-agreements.store', $district),
            $data
        );

        unset($data['property_type_id']);

        $this->assertDatabaseHas('customer_agreements', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $customerAgreement = CustomerAgreement::latest('id')->first();

        $this->assertEquals($district->id, $customerAgreement->district_id);
    }
}
