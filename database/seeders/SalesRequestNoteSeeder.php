<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SalesRequestNote;

class SalesRequestNoteeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SalesRequestNote::factory()
            ->count(5)
            ->create();
    }
}
