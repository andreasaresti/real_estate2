<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\CustomerRole;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerRoleControllerTest extends TestCase
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
    public function it_displays_index_view_with_customer_roles(): void
    {
        $customerRoles = CustomerRole::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('customer-roles.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.customer_roles.index')
            ->assertViewHas('customerRoles');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_customer_role(): void
    {
        $response = $this->get(route('customer-roles.create'));

        $response->assertOk()->assertViewIs('app.customer_roles.create');
    }

    /**
     * @test
     */
    public function it_stores_the_customer_role(): void
    {
        $data = CustomerRole::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('customer-roles.store'), $data);

        $this->assertDatabaseHas('customer_roles', $data);

        $customerRole = CustomerRole::latest('id')->first();

        $response->assertRedirect(route('customer-roles.edit', $customerRole));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_customer_role(): void
    {
        $customerRole = CustomerRole::factory()->create();

        $response = $this->get(route('customer-roles.show', $customerRole));

        $response
            ->assertOk()
            ->assertViewIs('app.customer_roles.show')
            ->assertViewHas('customerRole');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_customer_role(): void
    {
        $customerRole = CustomerRole::factory()->create();

        $response = $this->get(route('customer-roles.edit', $customerRole));

        $response
            ->assertOk()
            ->assertViewIs('app.customer_roles.edit')
            ->assertViewHas('customerRole');
    }

    /**
     * @test
     */
    public function it_updates_the_customer_role(): void
    {
        $customerRole = CustomerRole::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'sequence' => $this->faker->randomNumber(0),
        ];

        $response = $this->put(
            route('customer-roles.update', $customerRole),
            $data
        );

        $data['id'] = $customerRole->id;

        $this->assertDatabaseHas('customer_roles', $data);

        $response->assertRedirect(route('customer-roles.edit', $customerRole));
    }

    /**
     * @test
     */
    public function it_deletes_the_customer_role(): void
    {
        $customerRole = CustomerRole::factory()->create();

        $response = $this->delete(
            route('customer-roles.destroy', $customerRole)
        );

        $response->assertRedirect(route('customer-roles.index'));

        $this->assertModelMissing($customerRole);
    }
}
