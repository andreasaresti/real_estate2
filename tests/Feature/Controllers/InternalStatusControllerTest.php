<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\InternalStatus;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class InternalStatusControllerTest extends TestCase
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
    public function it_displays_index_view_with_internal_statuses(): void
    {
        $internalStatuses = InternalStatus::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('internal-statuses.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.internal_statuses.index')
            ->assertViewHas('internalStatuses');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_internal_status(): void
    {
        $response = $this->get(route('internal-statuses.create'));

        $response->assertOk()->assertViewIs('app.internal_statuses.create');
    }

    /**
     * @test
     */
    public function it_stores_the_internal_status(): void
    {
        $data = InternalStatus::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('internal-statuses.store'), $data);

        unset($data['color']);

        $this->assertDatabaseHas('internal_statuses', $data);

        $internalStatus = InternalStatus::latest('id')->first();

        $response->assertRedirect(
            route('internal-statuses.edit', $internalStatus)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_internal_status(): void
    {
        $internalStatus = InternalStatus::factory()->create();

        $response = $this->get(
            route('internal-statuses.show', $internalStatus)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.internal_statuses.show')
            ->assertViewHas('internalStatus');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_internal_status(): void
    {
        $internalStatus = InternalStatus::factory()->create();

        $response = $this->get(
            route('internal-statuses.edit', $internalStatus)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.internal_statuses.edit')
            ->assertViewHas('internalStatus');
    }

    /**
     * @test
     */
    public function it_updates_the_internal_status(): void
    {
        $internalStatus = InternalStatus::factory()->create();

        $data = [
            'ext_code' => $this->faker->unique->text(255),
            'name' => $this->faker->name(),
            'color' => $this->faker->hexcolor,
            'sequence' => $this->faker->randomNumber(0),
        ];

        $response = $this->put(
            route('internal-statuses.update', $internalStatus),
            $data
        );

        unset($data['color']);

        $data['id'] = $internalStatus->id;

        $this->assertDatabaseHas('internal_statuses', $data);

        $response->assertRedirect(
            route('internal-statuses.edit', $internalStatus)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_internal_status(): void
    {
        $internalStatus = InternalStatus::factory()->create();

        $response = $this->delete(
            route('internal-statuses.destroy', $internalStatus)
        );

        $response->assertRedirect(route('internal-statuses.index'));

        $this->assertModelMissing($internalStatus);
    }
}
