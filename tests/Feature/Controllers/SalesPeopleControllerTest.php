<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\SalesPeople;

use App\Models\Agent;
use App\Models\Customer;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesPeopleControllerTest extends TestCase
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
    public function it_displays_index_view_with_all_sales_people(): void
    {
        $allSalesPeople = SalesPeople::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('all-sales-people.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.all_sales_people.index')
            ->assertViewHas('allSalesPeople');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_sales_people(): void
    {
        $response = $this->get(route('all-sales-people.create'));

        $response->assertOk()->assertViewIs('app.all_sales_people.create');
    }

    /**
     * @test
     */
    public function it_stores_the_sales_people(): void
    {
        $data = SalesPeople::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('all-sales-people.store'), $data);

        $this->assertDatabaseHas('sales_people', $data);

        $salesPeople = SalesPeople::latest('id')->first();

        $response->assertRedirect(route('all-sales-people.edit', $salesPeople));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_sales_people(): void
    {
        $salesPeople = SalesPeople::factory()->create();

        $response = $this->get(route('all-sales-people.show', $salesPeople));

        $response
            ->assertOk()
            ->assertViewIs('app.all_sales_people.show')
            ->assertViewHas('salesPeople');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_sales_people(): void
    {
        $salesPeople = SalesPeople::factory()->create();

        $response = $this->get(route('all-sales-people.edit', $salesPeople));

        $response
            ->assertOk()
            ->assertViewIs('app.all_sales_people.edit')
            ->assertViewHas('salesPeople');
    }

    /**
     * @test
     */
    public function it_updates_the_sales_people(): void
    {
        $salesPeople = SalesPeople::factory()->create();

        $customer = Customer::factory()->create();
        $agent = Agent::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'active' => $this->faker->boolean,
            'customer_id' => $customer->id,
            'agent_id' => $agent->id,
        ];

        $response = $this->put(
            route('all-sales-people.update', $salesPeople),
            $data
        );

        $data['id'] = $salesPeople->id;

        $this->assertDatabaseHas('sales_people', $data);

        $response->assertRedirect(route('all-sales-people.edit', $salesPeople));
    }

    /**
     * @test
     */
    public function it_deletes_the_sales_people(): void
    {
        $salesPeople = SalesPeople::factory()->create();

        $response = $this->delete(
            route('all-sales-people.destroy', $salesPeople)
        );

        $response->assertRedirect(route('all-sales-people.index'));

        $this->assertModelMissing($salesPeople);
    }
}
