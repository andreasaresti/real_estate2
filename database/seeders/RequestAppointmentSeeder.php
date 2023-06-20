<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RequestAppointment;

class RequestAppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RequestAppointment::factory()
            ->count(5)
            ->create();
    }
}
