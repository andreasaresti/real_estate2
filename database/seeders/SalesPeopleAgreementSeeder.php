<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SalesPeopleAgreement;

class SalesPeopleAgreementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SalesPeopleAgreement::factory()
            ->count(5)
            ->create();
    }
}
