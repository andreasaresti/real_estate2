<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\PropertyType;
use App\Models\SalesRequest;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PropertyTypeSalesRequestsTest extends TestCase
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
    public function it_gets_property_type_sales_requests(): void
    {
        $propertyType = PropertyType::factory()->create();
        $salesRequests = SalesRequest::factory()
            ->count(2)
            ->create([
                'property_type_id' => $propertyType->id,
            ]);

        $response = $this->getJson(
            route('api.property-types.sales-requests.index', $propertyType)
        );

        $response->assertOk()->assertSee($salesRequests[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_property_type_sales_requests(): void
    {
        $propertyType = PropertyType::factory()->create();
        $data = SalesRequest::factory()
            ->make([
                'property_type_id' => $propertyType->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.property-types.sales-requests.store', $propertyType),
            $data
        );

        unset($data['minimum_size']);
        unset($data['maximum_size']);
        unset($data['minimum_bedrooms']);
        unset($data['minimum_bathrooms']);
        unset($data['assigned']);
        unset($data['accepted_status']);
        unset($data['status']);
        unset($data['listing_id']);
        unset($data['agreement_price']);
        unset($data['agency_percentage']);
        unset($data['salespeople_percentage']);
        unset($data['sales_lost_reason_id']);
        unset($data['intermediate_percentage']);
        unset($data['final_status']);

        $this->assertDatabaseHas('sales_requests', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $salesRequest = SalesRequest::latest('id')->first();

        $this->assertEquals($propertyType->id, $salesRequest->property_type_id);
    }
}
