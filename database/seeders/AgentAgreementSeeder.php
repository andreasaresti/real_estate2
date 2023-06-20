<?php

namespace Database\Seeders;

use App\Models\AgentAgreement;
use Illuminate\Database\Seeder;

class AgentAgreementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AgentAgreement::factory()
            ->count(5)
            ->create();
    }
}
