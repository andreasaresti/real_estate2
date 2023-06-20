<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ListingAdditionalDetail;

class ListingAdditionalDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ListingAdditionalDetail::factory()
            ->count(5)
            ->create();
    }
}
