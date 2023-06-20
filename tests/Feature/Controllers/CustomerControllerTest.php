<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Customer;

use App\Models\CustomerRole;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerControllerTest extends TestCase
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
    public function it_displays_index_view_with_customers(): void
    {
        $customers = Customer::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('customers.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.customers.index')
            ->assertViewHas('customers');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_customer(): void
    {
        $response = $this->get(route('customers.create'));

        $response->assertOk()->assertViewIs('app.customers.create');
    }

    /**
     * @test
     */
    public function it_stores_the_customer(): void
    {
        $data = Customer::factory()
            ->make()
            ->toArray();
        $data['password'] = \Str::random('8');

        $response = $this->post(route('customers.store'), $data);

        unset($data['password']);

        $this->assertDatabaseHas('customers', $data);

        $customer = Customer::latest('id')->first();

        $response->assertRedirect(route('customers.edit', $customer));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_customer(): void
    {
        $customer = Customer::factory()->create();

        $response = $this->get(route('customers.show', $customer));

        $response
            ->assertOk()
            ->assertViewIs('app.customers.show')
            ->assertViewHas('customer');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_customer(): void
    {
        $customer = Customer::factory()->create();

        $response = $this->get(route('customers.edit', $customer));

        $response
            ->assertOk()
            ->assertViewIs('app.customers.edit')
            ->assertViewHas('customer');
    }

    /**
     * @test
     */
    public function it_updates_the_customer(): void
    {
        $customer = Customer::factory()->create();

        $customerRole = CustomerRole::factory()->create();

        $data = [
            'ext_code' => $this->faker->unique->text(255),
            'type' => $this->faker->word,
            'name' => $this->faker->name(),
            'surname' => $this->faker->lastName,
            'company_name' => $this->faker->text(255),
            'email' => $this->faker->unique->email,
            'mobile' => $this->faker->phoneNumber,
            'phone' => $this->faker->phoneNumber,
            'address' => $this->faker->address,
            'postal_code' => $this->faker->text(255),
            'city' => $this->faker->city,
            'district' => $this->faker->text(255),
            'country' => $this->faker->country,
            'notes' => $this->faker->text,
            'customer_role_id' => $customerRole->id,
        ];

        $data['password'] = \Str::random('8');

        $response = $this->put(route('customers.update', $customer), $data);

        unset($data['password']);

        $data['id'] = $customer->id;

        $this->assertDatabaseHas('customers', $data);

        $response->assertRedirect(route('customers.edit', $customer));
    }

    /**
     * @test
     */
    public function it_deletes_the_customer(): void
    {
        $customer = Customer::factory()->create();

        $response = $this->delete(route('customers.destroy', $customer));

        $response->assertRedirect(route('customers.index'));

        $this->assertModelMissing($customer);
    }
}
