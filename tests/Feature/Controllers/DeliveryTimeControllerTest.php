<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\DeliveryTime;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeliveryTimeControllerTest extends TestCase
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

    protected function castToJson($json)
    {
        if (is_array($json)) {
            $json = addslashes(json_encode($json));
        } elseif (is_null($json) || is_null(json_decode($json))) {
            throw new \Exception(
                'A valid JSON string was not provided for casting.'
            );
        }

        return \DB::raw("CAST('{$json}' AS JSON)");
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_delivery_times(): void
    {
        $deliveryTimes = DeliveryTime::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('delivery-times.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.delivery_times.index')
            ->assertViewHas('deliveryTimes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_delivery_time(): void
    {
        $response = $this->get(route('delivery-times.create'));

        $response->assertOk()->assertViewIs('app.delivery_times.create');
    }

    /**
     * @test
     */
    public function it_stores_the_delivery_time(): void
    {
        $data = DeliveryTime::factory()
            ->make()
            ->toArray();

        $data['name'] = json_encode($data['name']);

        $response = $this->post(route('delivery-times.store'), $data);

        unset($data['color']);

        $data['name'] = $this->castToJson($data['name']);

        $this->assertDatabaseHas('delivery_times', $data);

        $deliveryTime = DeliveryTime::latest('id')->first();

        $response->assertRedirect(route('delivery-times.edit', $deliveryTime));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_delivery_time(): void
    {
        $deliveryTime = DeliveryTime::factory()->create();

        $response = $this->get(route('delivery-times.show', $deliveryTime));

        $response
            ->assertOk()
            ->assertViewIs('app.delivery_times.show')
            ->assertViewHas('deliveryTime');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_delivery_time(): void
    {
        $deliveryTime = DeliveryTime::factory()->create();

        $response = $this->get(route('delivery-times.edit', $deliveryTime));

        $response
            ->assertOk()
            ->assertViewIs('app.delivery_times.edit')
            ->assertViewHas('deliveryTime');
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

        $data['name'] = json_encode($data['name']);

        $response = $this->put(
            route('delivery-times.update', $deliveryTime),
            $data
        );

        unset($data['color']);

        $data['id'] = $deliveryTime->id;

        $data['name'] = $this->castToJson($data['name']);

        $this->assertDatabaseHas('delivery_times', $data);

        $response->assertRedirect(route('delivery-times.edit', $deliveryTime));
    }

    /**
     * @test
     */
    public function it_deletes_the_delivery_time(): void
    {
        $deliveryTime = DeliveryTime::factory()->create();

        $response = $this->delete(
            route('delivery-times.destroy', $deliveryTime)
        );

        $response->assertRedirect(route('delivery-times.index'));

        $this->assertModelMissing($deliveryTime);
    }
}
