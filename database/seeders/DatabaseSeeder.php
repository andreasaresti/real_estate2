<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
                'password' => \Hash::make('admin'),
            ]);
        $this->call(PermissionsSeeder::class);

        $this->call(AgentSeeder::class);
        $this->call(AgentAgreementSeeder::class);
        $this->call(BannerSeeder::class);
        $this->call(BannerImageSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(CustomerAgreementSeeder::class);
        $this->call(CustomerRoleSeeder::class);
        $this->call(DeliveryTimeSeeder::class);
        $this->call(DistrictSeeder::class);
        $this->call(FavoritePropertySeeder::class);
        $this->call(FeatureSeeder::class);
        $this->call(FloorPlanSeeder::class);
        $this->call(InternalStatusSeeder::class);
        $this->call(LanguageSeeder::class);
        $this->call(ListingSeeder::class);
        $this->call(ListingAdditionalDetailSeeder::class);
        $this->call(ListingAttachmentSeeder::class);
        $this->call(ListingTypeSeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(MarketplaceSeeder::class);
        $this->call(MunicipalitySeeder::class);
        $this->call(PropertyTypeSeeder::class);
        $this->call(SalesLostReasonSeeder::class);
        $this->call(SalesPeopleSeeder::class);
        $this->call(SalesPeopleAgreementSeeder::class);
        $this->call(SalesRequestSeeder::class);
        $this->call(SalesRequestAppointmentSeeder::class);
        $this->call(SalesRequestDistrictSeeder::class);
        $this->call(SalesRequestListingSeeder::class);
        $this->call(SalesRequestListingTypeSeeder::class);
        $this->call(SalesRequestLocationSeeder::class);
        $this->call(SalesRequestMunicipalitySeeder::class);
        $this->call(SourceSeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(UserSeeder::class);
    }
}
