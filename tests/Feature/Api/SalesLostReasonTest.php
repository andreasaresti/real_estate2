<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\SalesLostReason;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesLostReasonTest extends TestCase
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
    public function it_gets_sales_lost_reasons_list(): void
    {
        $salesLostReasons = SalesLostReason::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.sales-lost-reasons.index'));

        $response->assertOk()->assertSee($salesLostReasons[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_sales_lost_reason(): void
    {
        $data = SalesLostReason::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(
            route('api.sales-lost-reasons.store'),
            $data
        );

        $this->assertDatabaseHas('sales_lost_reasons', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_sales_lost_reason(): void
    {
        $salesLostReason = SalesLostReason::factory()->create();

        $data = [
            'name' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.sales-lost-reasons.update', $salesLostReason),
            $data
        );

        $data['id'] = $salesLostReason->id;

        $this->assertDatabaseHas('sales_lost_reasons', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_sales_lost_reason(): void
    {
        $salesLostReason = SalesLostReason::factory()->create();

        $response = $this->deleteJson(
            route('api.sales-lost-reasons.destroy', $salesLostReason)
        );

        $this->assertModelMissing($salesLostReason);

        $response->assertNoContent();
    }
}
