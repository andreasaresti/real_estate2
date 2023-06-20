<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SalesRequestListingType;

class SalesRequestListingTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SalesRequestListingType::factory()
            ->count(5)
            ->create();
    }
}
