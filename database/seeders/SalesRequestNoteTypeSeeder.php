<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SalesRequestNoteType;

class SalesRequestNoteTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SalesRequestNoteType::factory()
            ->count(5)
            ->create();
    }
}
