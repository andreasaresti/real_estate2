<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChargeRequestCollectMoney;

class ChargeRequestCollectMoneySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ChargeRequestCollectMoney::factory()
            ->count(5)
            ->create();
    }
}
