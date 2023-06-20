<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\DeliveryTime;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeliveryTimeTest extends TestCase
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
    public function it_gets_delivery_times_list(): void
    {
        $deliveryTimes = DeliveryTime::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.delivery-times.index'));

        $response->assertOk()->assertSee($deliveryTimes[0]->name);
    }

    /**
     * @test
     */
    public function it_stores_the_delivery_time(): void
    {
        $data = DeliveryTime::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.delivery-times.store'), $data);

        unset($data['color']);

        $this->assertDatabaseHas('delivery_times', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_delivery_time(): void
    {
        $deliveryTime = DeliveryTime::factory()->create();

        $data = [
            'ext_code' => $this->faker->unique->text(255),
            'name' => [],
            'color' => $this->faker->hexcolor,
            'sequence' => $this->faker->randomNumber(0),
        ];

        $response = $this->putJson(
            route('api.delivery-times.update', $deliveryTime),
            $data
        );

        unset($data['color']);

        $data['id'] = $deliveryTime->id;

        $this->assertDatabaseHas('delivery_times', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_delivery_time(): void
    {
        $deliveryTime = DeliveryTime::factory()->create();

        $response = $this->deleteJson(
            route('api.delivery-times.destroy', $deliveryTime)
        );

        $this->assertModelMissing($deliveryTime);

        $response->assertNoContent();
    }
}
