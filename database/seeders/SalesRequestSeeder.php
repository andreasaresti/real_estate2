<?php

namespace Database\Seeders;

use App\Models\SalesRequest;
use Illuminate\Database\Seeder;

class SalesRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SalesRequest::factory()
            ->count(5)
            ->create();
    }
}
