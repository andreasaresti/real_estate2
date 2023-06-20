<?php

namespace Database\Seeders;

use App\Models\BannerImage;
use Illuminate\Database\Seeder;

class BannerImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BannerImage::factory()
            ->count(5)
            ->create();
    }
}
