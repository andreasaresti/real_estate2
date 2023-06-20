<?php

namespace Database\Seeders;

use App\Models\RequestArea;
use Illuminate\Database\Seeder;

class RequestAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RequestArea::factory()
            ->count(5)
            ->create();
    }
}
