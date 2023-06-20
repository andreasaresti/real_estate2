<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FavoriteProperty;

class FavoritePropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FavoriteProperty::factory()
            ->count(5)
            ->create();
    }
}
