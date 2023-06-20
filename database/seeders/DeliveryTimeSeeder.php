<?php

namespace Database\Seeders;

use App\Models\DeliveryTime;
use Illuminate\Database\Seeder;

class DeliveryTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeliveryTime::factory()
            ->count(5)
            ->create();
    }
}
