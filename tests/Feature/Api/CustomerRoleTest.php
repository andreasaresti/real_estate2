<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\CustomerRole;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerRoleTest extends TestCase
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
    public function it_gets_customer_roles_list(): void
    {
        $customerRoles = CustomerRole::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.customer-roles.index'));

        $response->assertOk()->assertSee($customerRoles[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_customer_role(): void
    {
        $data = CustomerRole::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.customer-roles.store'), $data);

        $this->assertDatabaseHas('customer_roles', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.customer-roles.update', $customerRole),
            $data
        );

        $data['id'] = $customerRole->id;

        $this->assertDatabaseHas('customer_roles', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_customer_role(): void
    {
        $customerRole = CustomerRole::factory()->create();

        $response = $this->deleteJson(
            route('api.customer-roles.destroy', $customerRole)
        );

        $this->assertModelMissing($customerRole);

        $response->assertNoContent();
    }
}
