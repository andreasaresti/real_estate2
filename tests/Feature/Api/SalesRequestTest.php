<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SalesRequest;

use App\Models\Source;
use App\Models\Listing;
use App\Models\Customer;
use App\Models\SalesPeople;
use App\Models\PropertyType;
use App\Models\SalesLostReason;
use App\Models\IntermediateAgent;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesRequestTest extends TestCase
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
    public function it_gets_sales_requests_list(): void
    {
        $salesRequests = SalesRequest::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.sales-requests.index'));

        $response->assertOk()->assertSee($salesRequests[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_sales_request(): void
    {
        $data = SalesRequest::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.sales-requests.store'), $data);

        unset($data['minimum_size']);
        unset($data['maximum_size']);
        unset($data['minimum_bedrooms']);
        unset($data['minimum_bathrooms']);
        unset($data['assigned']);
        unset($data['assigned_date']);
        unset($data['accepted_status']);
        unset($data['status']);
        unset($data['listing_id']);
        unset($data['agreement_price']);
        unset($data['commission_amount']);
        unset($data['agency_percentage']);
        unset($data['agency_amount']);
        unset($data['salesperson_amount']);
        unset($data['salespeople_percentage']);
        unset($data['sales_lost_reason_id']);
        unset($data['final_status']);
        unset($data['has_intermediate_agent']);
        unset($data['intermediate_agent_id']);
        unset($data['intermediate_percentage']);
        unset($data['intermediate_amount']);

        $this->assertDatabaseHas('sales_requests', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_sales_request(): void
    {
        $salesRequest = SalesRequest::factory()->create();

        $customer = Customer::factory()->create();
        $source = Source::factory()->create();
        $salesPeople = SalesPeople::factory()->create();
        $propertyType = PropertyType::factory()->create();
        $listing = Listing::factory()->create();
        $salesLostReason = SalesLostReason::factory()->create();
        $intermediateAgent = IntermediateAgent::factory()->create();

        $data = [
            'name' => $this->faker->text(255),
            'date' => $this->faker->date,
            'minimum_budget' => $this->faker->randomNumber(0),
            'maximum_budget' => $this->faker->randomNumber(0),
            'minimum_size' => $this->faker->randomNumber(0),
            'maximum_size' => $this->faker->randomNumber(0),
            'minimum_bedrooms' => $this->faker->randomNumber(0),
            'minimum_bathrooms' => $this->faker->randomNumber(0),
            'description' => $this->faker->text,
            'assigned' => $this->faker->boolean,
            'assigned_date' => $this->faker->date,
            'accepted_status' => $this->faker->text(255),
            'status' => $this->faker->word,
            'active' => $this->faker->boolean,
            'agreement_price' => $this->faker->randomNumber(2),
            'commission_amount' => $this->faker->randomNumber(1),
            'agency_percentage' => $this->faker->randomNumber(2),
            'agency_amount' => $this->faker->randomNumber(1),
            'salesperson_amount' => $this->faker->randomNumber(1),
            'salespeople_percentage' => $this->faker->randomNumber(2),
            'final_status' => $this->faker->text(255),
            'has_intermediate_agent' => $this->faker->boolean,
            'intermediate_percentage' => $this->faker->randomNumber(2),
            'intermediate_amount' => $this->faker->randomNumber(1),
            'customer_id' => $customer->id,
            'source_id' => $source->id,
            'sales_people_id' => $salesPeople->id,
            'property_type_id' => $propertyType->id,
            'listing_id' => $listing->id,
            'sales_lost_reason_id' => $salesLostReason->id,
            'intermediate_agent_id' => $intermediateAgent->id,
        ];

        $response = $this->putJson(
            route('api.sales-requests.update', $salesRequest),
            $data
        );

        unset($data['minimum_size']);
        unset($data['maximum_size']);
        unset($data['minimum_bedrooms']);
        unset($data['minimum_bathrooms']);
        unset($data['assigned']);
        unset($data['assigned_date']);
        unset($data['accepted_status']);
        unset($data['status']);
        unset($data['listing_id']);
        unset($data['agreement_price']);
        unset($data['commission_amount']);
        unset($data['agency_percentage']);
        unset($data['agency_amount']);
        unset($data['salesperson_amount']);
        unset($data['salespeople_percentage']);
        unset($data['sales_lost_reason_id']);
        unset($data['final_status']);
        unset($data['has_intermediate_agent']);
        unset($data['intermediate_agent_id']);
        unset($data['intermediate_percentage']);
        unset($data['intermediate_amount']);

        $data['id'] = $salesRequest->id;

        $this->assertDatabaseHas('sales_requests', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_sales_request(): void
    {
        $salesRequest = SalesRequest::factory()->create();

        $response = $this->deleteJson(
            route('api.sales-requests.destroy', $salesRequest)
        );

        $this->assertModelMissing($salesRequest);

        $response->assertNoContent();
    }
}
