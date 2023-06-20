<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\SalesLostReason;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesLostReasonControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_sales_lost_reasons(): void
    {
        $salesLostReasons = SalesLostReason::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('sales-lost-reasons.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.sales_lost_reasons.index')
            ->assertViewHas('salesLostReasons');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_sales_lost_reason(): void
    {
        $response = $this->get(route('sales-lost-reasons.create'));

        $response->assertOk()->assertViewIs('app.sales_lost_reasons.create');
    }

    /**
     * @test
     */
    public function it_stores_the_sales_lost_reason(): void
    {
        $data = SalesLostReason::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('sales-lost-reasons.store'), $data);

        $this->assertDatabaseHas('sales_lost_reasons', $data);

        $salesLostReason = SalesLostReason::latest('id')->first();

        $response->assertRedirect(
            route('sales-lost-reasons.edit', $salesLostReason)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_sales_lost_reason(): void
    {
        $salesLostReason = SalesLostReason::factory()->create();

        $response = $this->get(
            route('sales-lost-reasons.show', $salesLostReason)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.sales_lost_reasons.show')
            ->assertViewHas('salesLostReason');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_sales_lost_reason(): void
    {
        $salesLostReason = SalesLostReason::factory()->create();

        $response = $this->get(
            route('sales-lost-reasons.edit', $salesLostReason)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.sales_lost_reasons.edit')
            ->assertViewHas('salesLostReason');
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

        $response = $this->put(
            route('sales-lost-reasons.update', $salesLostReason),
            $data
        );

        $data['id'] = $salesLostReason->id;

        $this->assertDatabaseHas('sales_lost_reasons', $data);

        $response->assertRedirect(
            route('sales-lost-reasons.edit', $salesLostReason)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_sales_lost_reason(): void
    {
        $salesLostReason = SalesLostReason::factory()->create();

        $response = $this->delete(
            route('sales-lost-reasons.destroy', $salesLostReason)
        );

        $response->assertRedirect(route('sales-lost-reasons.index'));

        $this->assertModelMissing($salesLostReason);
    }
}
