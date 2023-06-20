<?php

namespace Database\Seeders;

use App\Models\InternalStatus;
use Illuminate\Database\Seeder;

class InternalStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InternalStatus::factory()
            ->count(5)
            ->create();
    }
}
