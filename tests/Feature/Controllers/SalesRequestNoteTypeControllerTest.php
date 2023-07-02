<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\SalesRequestNoteType;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesRequestNoteTypeControllerTest extends TestCase
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
    public function it_displays_index_view_with_sales_request_note_types(): void
    {
        $salesRequestNoteTypes = SalesRequestNoteType::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('sales-request-note-types.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.sales_request_note_types.index')
            ->assertViewHas('salesRequestNoteTypes');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_sales_request_note_type(): void
    {
        $response = $this->get(route('sales-request-note-types.create'));

        $response
            ->assertOk()
            ->assertViewIs('app.sales_request_note_types.create');
    }

    /**
     * @test
     */
    public function it_stores_the_sales_request_note_type(): void
    {
        $data = SalesRequestNoteType::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('sales-request-note-types.store'), $data);

        $this->assertDatabaseHas('sales_request_note_types', $data);

        $salesRequestNoteType = SalesRequestNoteType::latest('id')->first();

        $response->assertRedirect(
            route('sales-request-note-types.edit', $salesRequestNoteType)
        );
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_sales_request_note_type(): void
    {
        $salesRequestNoteType = SalesRequestNoteType::factory()->create();

        $response = $this->get(
            route('sales-request-note-types.show', $salesRequestNoteType)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.sales_request_note_types.show')
            ->assertViewHas('salesRequestNoteType');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_sales_request_note_type(): void
    {
        $salesRequestNoteType = SalesRequestNoteType::factory()->create();

        $response = $this->get(
            route('sales-request-note-types.edit', $salesRequestNoteType)
        );

        $response
            ->assertOk()
            ->assertViewIs('app.sales_request_note_types.edit')
            ->assertViewHas('salesRequestNoteType');
    }

    /**
     * @test
     */
    public function it_updates_the_sales_request_note_type(): void
    {
        $salesRequestNoteType = SalesRequestNoteType::factory()->create();

        $data = [
            'name' => $this->faker->name(),
        ];

        $response = $this->put(
            route('sales-request-note-types.update', $salesRequestNoteType),
            $data
        );

        $data['id'] = $salesRequestNoteType->id;

        $this->assertDatabaseHas('sales_request_note_types', $data);

        $response->assertRedirect(
            route('sales-request-note-types.edit', $salesRequestNoteType)
        );
    }

    /**
     * @test
     */
    public function it_deletes_the_sales_request_note_type(): void
    {
        $salesRequestNoteType = SalesRequestNoteType::factory()->create();

        $response = $this->delete(
            route('sales-request-note-types.destroy', $salesRequestNoteType)
        );

        $response->assertRedirect(route('sales-request-note-types.index'));

        $this->assertModelMissing($salesRequestNoteType);
    }
}
