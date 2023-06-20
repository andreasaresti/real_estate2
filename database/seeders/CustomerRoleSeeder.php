<?php

namespace Database\Seeders;

use App\Models\CustomerRole;
use Illuminate\Database\Seeder;

class CustomerRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CustomerRole::factory()
            ->count(5)
            ->create();
    }
}
