<?php

namespace Database\Seeders;

use App\Models\FloorPlan;
use Illuminate\Database\Seeder;

class FloorPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FloorPlan::factory()
            ->count(5)
            ->create();
    }
}
