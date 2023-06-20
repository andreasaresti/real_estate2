<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SalesRequestLocation;

class SalesRequestLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SalesRequestLocation::factory()
            ->count(5)
            ->create();
    }
}
