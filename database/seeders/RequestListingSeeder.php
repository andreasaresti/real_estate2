<?php

namespace Database\Seeders;

use App\Models\RequestListing;
use Illuminate\Database\Seeder;

class RequestListingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RequestListing::factory()
            ->count(5)
            ->create();
    }
}
