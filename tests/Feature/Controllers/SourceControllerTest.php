<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Source;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SourceControllerTest extends TestCase
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
    public function it_displays_index_view_with_sources(): void
    {
        $sources = Source::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('sources.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.sources.index')
            ->assertViewHas('sources');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_source(): void
    {
        $response = $this->get(route('sources.create'));

        $response->assertOk()->assertViewIs('app.sources.create');
    }

    /**
     * @test
     */
    public function it_stores_the_source(): void
    {
        $data = Source::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('sources.store'), $data);

        $this->assertDatabaseHas('sources', $data);

        $source = Source::latest('id')->first();

        $response->assertRedirect(route('sources.edit', $source));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_source(): void
    {
        $source = Source::factory()->create();

        $response = $this->get(route('sources.show', $source));

        $response
            ->assertOk()
            ->assertViewIs('app.sources.show')
            ->assertViewHas('source');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_source(): void
    {
        $source = Source::factory()->create();

        $response = $this->get(route('sources.edit', $source));

        $response
            ->assertOk()
            ->assertViewIs('app.sources.edit')
            ->assertViewHas('source');
    }

    /**
     * @test
     */
    public function it_updates_the_source(): void
    {
        $source = Source::factory()->create();

        $data = [
            'name' => $this->faker->name(),
            'website' => $this->faker->text(255),
            'sequence' => $this->faker->randomNumber(0),
        ];

        $response = $this->put(route('sources.update', $source), $data);

        $data['id'] = $source->id;

        $this->assertDatabaseHas('sources', $data);

        $response->assertRedirect(route('sources.edit', $source));
    }

    /**
     * @test
     */
    public function it_deletes_the_source(): void
    {
        $source = Source::factory()->create();

        $response = $this->delete(route('sources.destroy', $source));

        $response->assertRedirect(route('sources.index'));

        $this->assertModelMissing($source);
    }
}
