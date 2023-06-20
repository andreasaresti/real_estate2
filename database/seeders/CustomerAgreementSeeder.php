<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CustomerAgreement;

class CustomerAgreementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CustomerAgreement::factory()
            ->count(5)
            ->create();
    }
}
