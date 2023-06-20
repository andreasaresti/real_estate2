<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Status;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusControllerTest extends TestCase
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
    public function it_displays_index_view_with_statuses(): void
    {
        $statuses = Status::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('statuses.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.statuses.index')
            ->assertViewHas('statuses');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_status(): void
    {
        $response = $this->get(route('statuses.create'));

        $response->assertOk()->assertViewIs('app.statuses.create');
    }

    /**
     * @test
     */
    public function it_stores_the_status(): void
    {
        $data = Status::factory()
            ->make()
            ->toArray();

        $data['name'] = json_encode($data['name']);

        $response = $this->post(route('statuses.store'), $data);

        unset($data['color']);

        $data['name'] = $this->castToJson($data['name']);

        $this->assertDatabaseHas('statuses', $data);

        $status = Status::latest('id')->first();

        $response->assertRedirect(route('statuses.edit', $status));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_status(): void
    {
        $status = Status::factory()->create();

        $response = $this->get(route('statuses.show', $status));

        $response
            ->assertOk()
            ->assertViewIs('app.statuses.show')
            ->assertViewHas('status');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_status(): void
    {
        $status = Status::factory()->create();

        $response = $this->get(route('statuses.edit', $status));

        $response
            ->assertOk()
            ->assertViewIs('app.statuses.edit')
            ->assertViewHas('status');
    }

    /**
     * @test
     */
    public function it_updates_the_status(): void
    {
        $status = Status::factory()->create();

        $data = [
            'ext_code' => $this->faker->unique->text(255),
            'name' => [],
            'color' => $this->faker->hexcolor,
            'sequence' => $this->faker->randomNumber(0),
        ];

        $data['name'] = json_encode($data['name']);

        $response = $this->put(route('statuses.update', $status), $data);

        unset($data['color']);

        $data['id'] = $status->id;

        $data['name'] = $this->castToJson($data['name']);

        $this->assertDatabaseHas('statuses', $data);

        $response->assertRedirect(route('statuses.edit', $status));
    }

    /**
     * @test
     */
    public function it_deletes_the_status(): void
    {
        $status = Status::factory()->create();

        $response = $this->delete(route('statuses.destroy', $status));

        $response->assertRedirect(route('statuses.index'));

        $this->assertModelMissing($status);
    }
}
