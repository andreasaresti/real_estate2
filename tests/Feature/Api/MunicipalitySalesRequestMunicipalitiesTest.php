<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Municipality;
use App\Models\SalesRequestMunicipality;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MunicipalitySalesRequestMunicipalitiesTest extends TestCase
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
    public function it_gets_municipality_sales_request_municipalities(): void
    {
        $municipality = Municipality::factory()->create();
        $salesRequestMunicipalities = SalesRequestMunicipality::factory()
            ->count(2)
            ->create([
                'municipality_id' => $municipality->id,
            ]);

        $response = $this->getJson(
            route(
                'api.municipalities.sales-request-municipalities.index',
                $municipality
            )
        );

        $response->assertOk()->assertSee($salesRequestMunicipalities[0]->id);
    }

    /**
     * @test
     */
    public function it_stores_the_municipality_sales_request_municipalities(): void
    {
        $municipality = Municipality::factory()->create();
        $data = SalesRequestMunicipality::factory()
            ->make([
                'municipality_id' => $municipality->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route(
                'api.municipalities.sales-request-municipalities.store',
                $municipality
            ),
            $data
        );

        unset($data['salesRequest_id']);
        unset($data['municipality_id']);

        $this->assertDatabaseHas('sales_request_municipalities', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $salesRequestMunicipality = SalesRequestMunicipality::latest(
            'id'
        )->first();

        $this->assertEquals(
            $municipality->id,
            $salesRequestMunicipality->municipality_id
        );
    }
}
