<?php

namespace Database\Seeders;

use App\Models\ListingRequest;
use Illuminate\Database\Seeder;

class ListingRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ListingRequest::factory()
            ->count(5)
            ->create();
    }
}
