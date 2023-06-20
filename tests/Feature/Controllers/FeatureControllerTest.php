<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FeatureControllerTest extends TestCase
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
    public function it_displays_index_view_with_features(): void
    {
        $features = Feature::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('features.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.features.index')
            ->assertViewHas('features');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_feature(): void
    {
        $response = $this->get(route('features.create'));

        $response->assertOk()->assertViewIs('app.features.create');
    }

    /**
     * @test
     */
    public function it_stores_the_feature(): void
    {
        $data = Feature::factory()
            ->make()
            ->toArray();

        $data['name'] = json_encode($data['name']);

        $response = $this->post(route('features.store'), $data);

        $data['name'] = $this->castToJson($data['name']);

        $this->assertDatabaseHas('features', $data);

        $feature = Feature::latest('id')->first();

        $response->assertRedirect(route('features.edit', $feature));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_feature(): void
    {
        $feature = Feature::factory()->create();

        $response = $this->get(route('features.show', $feature));

        $response
            ->assertOk()
            ->assertViewIs('app.features.show')
            ->assertViewHas('feature');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_feature(): void
    {
        $feature = Feature::factory()->create();

        $response = $this->get(route('features.edit', $feature));

        $response
            ->assertOk()
            ->assertViewIs('app.features.edit')
            ->assertViewHas('feature');
    }

    /**
     * @test
     */
    public function it_updates_the_feature(): void
    {
        $feature = Feature::factory()->create();

        $data = [
            'ext_code' => $this->faker->unique->text(255),
            'name' => [],
            'sequence' => $this->faker->randomNumber(0),
        ];

        $data['name'] = json_encode($data['name']);

        $response = $this->put(route('features.update', $feature), $data);

        $data['id'] = $feature->id;

        $data['name'] = $this->castToJson($data['name']);

        $this->assertDatabaseHas('features', $data);

        $response->assertRedirect(route('features.edit', $feature));
    }

    /**
     * @test
     */
    public function it_deletes_the_feature(): void
    {
        $feature = Feature::factory()->create();

        $response = $this->delete(route('features.destroy', $feature));

        $response->assertRedirect(route('features.index'));

        $this->assertModelMissing($feature);
    }
}
