<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Source;
use App\Models\SalesRequest;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SourceSalesRequestsTest extends TestCase
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
    public function it_gets_source_sales_requests(): void
    {
        $source = Source::factory()->create();
        $salesRequests = SalesRequest::factory()
            ->count(2)
            ->create([
                'source_id' => $source->id,
            ]);

        $response = $this->getJson(
            route('api.sources.sales-requests.index', $source)
        );

        $response->assertOk()->assertSee($salesRequests[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_source_sales_requests(): void
    {
        $source = Source::factory()->create();
        $data = SalesRequest::factory()
            ->make([
                'source_id' => $source->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.sources.sales-requests.store', $source),
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

        $this->assertEquals($source->id, $salesRequest->source_id);
    }
}
