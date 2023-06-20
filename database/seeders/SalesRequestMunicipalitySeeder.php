<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SalesRequestMunicipality;

class SalesRequestMunicipalitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SalesRequestMunicipality::factory()
            ->count(5)
            ->create();
    }
}
