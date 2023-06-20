<?php

namespace Database\Seeders;

use App\Models\SalesPeople;
use Illuminate\Database\Seeder;

class SalesPeopleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SalesPeople::factory()
            ->count(5)
            ->create();
    }
}
