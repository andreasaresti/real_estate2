<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Adding an admin user
        $user = \App\Models\User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin'),
            ]);
        $user = \App\Models\Language::factory()
            ->count(1)
            ->create([
                'encoding' => 'en',
                'name' => 'English',
            ]);
            // $user = \App\Models\Language::factory()
            // ->count(1)
            // ->create([
            //     'encoding' => 'el',
            //     'name' => 'Greek',
            // ]);
        $this->call(PermissionsSeeder::class);

        // $this->call(AgentSeeder::class);
        // $this->call(CustomerSeeder::class);
        // $this->call(CustomerRoleSeeder::class);
        // $this->call(DeliveryTimeSeeder::class);
        // $this->call(DistrictSeeder::class);
        // $this->call(FeatureSeeder::class);
        // $this->call(InternalStatusSeeder::class);
        // $this->call(LanguageSeeder::class);
        // $this->call(ListingSeeder::class);
        // $this->call(ListingAdditionalDetailSeeder::class);
        // $this->call(ListingAttachmentSeeder::class);
        // $this->call(ListingRequestSeeder::class);
        // $this->call(LocationSeeder::class);
        // $this->call(MunicipalitySeeder::class);
        // $this->call(PageSeeder::class);
        // $this->call(PropertyTypeSeeder::class);
        // $this->call(RequestAppointmentSeeder::class);
        // $this->call(SalesPeopleSeeder::class);
        // $this->call(SourceSeeder::class);
        // $this->call(StatusSeeder::class);
        // $this->call(UserSeeder::class);
    }
}
