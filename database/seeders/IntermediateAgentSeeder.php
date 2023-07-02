<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\IntermediateAgent;

class IntermediateAgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        IntermediateAgent::factory()
            ->count(5)
            ->create();
    }
}
