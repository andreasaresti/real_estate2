<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\PropertyType;
use App\Models\CustomerAgreement;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PropertyTypeCustomerAgreementsTest extends TestCase
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
    public function it_gets_property_type_customer_agreements(): void
    {
        $propertyType = PropertyType::factory()->create();
        $customerAgreements = CustomerAgreement::factory()
            ->count(2)
            ->create([
                'property_type_id' => $propertyType->id,
            ]);

        $response = $this->getJson(
            route('api.property-types.customer-agreements.index', $propertyType)
        );

        $response->assertOk()->assertSee($customerAgreements[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_property_type_customer_agreements(): void
    {
        $propertyType = PropertyType::factory()->create();
        $data = CustomerAgreement::factory()
            ->make([
                'property_type_id' => $propertyType->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.property-types.customer-agreements.store',
                $propertyType
            ),
            $data
        );

        unset($data['property_type_id']);

        $this->assertDatabaseHas('customer_agreements', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $customerAgreement = CustomerAgreement::latest('id')->first();

        $this->assertEquals(
            $propertyType->id,
            $customerAgreement->property_type_id
        );
    }
}
