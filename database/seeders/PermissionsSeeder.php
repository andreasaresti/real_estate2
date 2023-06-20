<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list agents']);
        Permission::create(['name' => 'view agents']);
        Permission::create(['name' => 'create agents']);
        Permission::create(['name' => 'update agents']);
        Permission::create(['name' => 'delete agents']);

        Permission::create(['name' => 'list agentagreements']);
        Permission::create(['name' => 'view agentagreements']);
        Permission::create(['name' => 'create agentagreements']);
        Permission::create(['name' => 'update agentagreements']);
        Permission::create(['name' => 'delete agentagreements']);

        Permission::create(['name' => 'list banners']);
        Permission::create(['name' => 'view banners']);
        Permission::create(['name' => 'create banners']);
        Permission::create(['name' => 'update banners']);
        Permission::create(['name' => 'delete banners']);

        Permission::create(['name' => 'list bannerimages']);
        Permission::create(['name' => 'view bannerimages']);
        Permission::create(['name' => 'create bannerimages']);
        Permission::create(['name' => 'update bannerimages']);
        Permission::create(['name' => 'delete bannerimages']);

        Permission::create(['name' => 'list customers']);
        Permission::create(['name' => 'view customers']);
        Permission::create(['name' => 'create customers']);
        Permission::create(['name' => 'update customers']);
        Permission::create(['name' => 'delete customers']);

        Permission::create(['name' => 'list customeragreements']);
        Permission::create(['name' => 'view customeragreements']);
        Permission::create(['name' => 'create customeragreements']);
        Permission::create(['name' => 'update customeragreements']);
        Permission::create(['name' => 'delete customeragreements']);

        Permission::create(['name' => 'list customerroles']);
        Permission::create(['name' => 'view customerroles']);
        Permission::create(['name' => 'create customerroles']);
        Permission::create(['name' => 'update customerroles']);
        Permission::create(['name' => 'delete customerroles']);

        Permission::create(['name' => 'list deliverytimes']);
        Permission::create(['name' => 'view deliverytimes']);
        Permission::create(['name' => 'create deliverytimes']);
        Permission::create(['name' => 'update deliverytimes']);
        Permission::create(['name' => 'delete deliverytimes']);

        Permission::create(['name' => 'list districts']);
        Permission::create(['name' => 'view districts']);
        Permission::create(['name' => 'create districts']);
        Permission::create(['name' => 'update districts']);
        Permission::create(['name' => 'delete districts']);

        Permission::create(['name' => 'list favoriteproperties']);
        Permission::create(['name' => 'view favoriteproperties']);
        Permission::create(['name' => 'create favoriteproperties']);
        Permission::create(['name' => 'update favoriteproperties']);
        Permission::create(['name' => 'delete favoriteproperties']);

        Permission::create(['name' => 'list features']);
        Permission::create(['name' => 'view features']);
        Permission::create(['name' => 'create features']);
        Permission::create(['name' => 'update features']);
        Permission::create(['name' => 'delete features']);

        Permission::create(['name' => 'list floorplans']);
        Permission::create(['name' => 'view floorplans']);
        Permission::create(['name' => 'create floorplans']);
        Permission::create(['name' => 'update floorplans']);
        Permission::create(['name' => 'delete floorplans']);

        Permission::create(['name' => 'list internalstatuses']);
        Permission::create(['name' => 'view internalstatuses']);
        Permission::create(['name' => 'create internalstatuses']);
        Permission::create(['name' => 'update internalstatuses']);
        Permission::create(['name' => 'delete internalstatuses']);

        Permission::create(['name' => 'list languages']);
        Permission::create(['name' => 'view languages']);
        Permission::create(['name' => 'create languages']);
        Permission::create(['name' => 'update languages']);
        Permission::create(['name' => 'delete languages']);

        Permission::create(['name' => 'list listings']);
        Permission::create(['name' => 'view listings']);
        Permission::create(['name' => 'create listings']);
        Permission::create(['name' => 'update listings']);
        Permission::create(['name' => 'delete listings']);

        Permission::create(['name' => 'list listingadditionaldetails']);
        Permission::create(['name' => 'view listingadditionaldetails']);
        Permission::create(['name' => 'create listingadditionaldetails']);
        Permission::create(['name' => 'update listingadditionaldetails']);
        Permission::create(['name' => 'delete listingadditionaldetails']);

        Permission::create(['name' => 'list listingattachments']);
        Permission::create(['name' => 'view listingattachments']);
        Permission::create(['name' => 'create listingattachments']);
        Permission::create(['name' => 'update listingattachments']);
        Permission::create(['name' => 'delete listingattachments']);

        Permission::create(['name' => 'list listingtypes']);
        Permission::create(['name' => 'view listingtypes']);
        Permission::create(['name' => 'create listingtypes']);
        Permission::create(['name' => 'update listingtypes']);
        Permission::create(['name' => 'delete listingtypes']);

        Permission::create(['name' => 'list locations']);
        Permission::create(['name' => 'view locations']);
        Permission::create(['name' => 'create locations']);
        Permission::create(['name' => 'update locations']);
        Permission::create(['name' => 'delete locations']);

        Permission::create(['name' => 'list marketplaces']);
        Permission::create(['name' => 'view marketplaces']);
        Permission::create(['name' => 'create marketplaces']);
        Permission::create(['name' => 'update marketplaces']);
        Permission::create(['name' => 'delete marketplaces']);

        Permission::create(['name' => 'list municipalities']);
        Permission::create(['name' => 'view municipalities']);
        Permission::create(['name' => 'create municipalities']);
        Permission::create(['name' => 'update municipalities']);
        Permission::create(['name' => 'delete municipalities']);

        Permission::create(['name' => 'list propertytypes']);
        Permission::create(['name' => 'view propertytypes']);
        Permission::create(['name' => 'create propertytypes']);
        Permission::create(['name' => 'update propertytypes']);
        Permission::create(['name' => 'delete propertytypes']);

        Permission::create(['name' => 'list saleslostreasons']);
        Permission::create(['name' => 'view saleslostreasons']);
        Permission::create(['name' => 'create saleslostreasons']);
        Permission::create(['name' => 'update saleslostreasons']);
        Permission::create(['name' => 'delete saleslostreasons']);

        Permission::create(['name' => 'list allsalespeople']);
        Permission::create(['name' => 'view allsalespeople']);
        Permission::create(['name' => 'create allsalespeople']);
        Permission::create(['name' => 'update allsalespeople']);
        Permission::create(['name' => 'delete allsalespeople']);

        Permission::create(['name' => 'list salespeopleagreements']);
        Permission::create(['name' => 'view salespeopleagreements']);
        Permission::create(['name' => 'create salespeopleagreements']);
        Permission::create(['name' => 'update salespeopleagreements']);
        Permission::create(['name' => 'delete salespeopleagreements']);

        Permission::create(['name' => 'list salesrequests']);
        Permission::create(['name' => 'view salesrequests']);
        Permission::create(['name' => 'create salesrequests']);
        Permission::create(['name' => 'update salesrequests']);
        Permission::create(['name' => 'delete salesrequests']);

        Permission::create(['name' => 'list salesrequestappointments']);
        Permission::create(['name' => 'view salesrequestappointments']);
        Permission::create(['name' => 'create salesrequestappointments']);
        Permission::create(['name' => 'update salesrequestappointments']);
        Permission::create(['name' => 'delete salesrequestappointments']);

        Permission::create(['name' => 'list salesrequestdistricts']);
        Permission::create(['name' => 'view salesrequestdistricts']);
        Permission::create(['name' => 'create salesrequestdistricts']);
        Permission::create(['name' => 'update salesrequestdistricts']);
        Permission::create(['name' => 'delete salesrequestdistricts']);

        Permission::create(['name' => 'list salesrequestlistings']);
        Permission::create(['name' => 'view salesrequestlistings']);
        Permission::create(['name' => 'create salesrequestlistings']);
        Permission::create(['name' => 'update salesrequestlistings']);
        Permission::create(['name' => 'delete salesrequestlistings']);

        Permission::create(['name' => 'list salesrequestlistingtypes']);
        Permission::create(['name' => 'view salesrequestlistingtypes']);
        Permission::create(['name' => 'create salesrequestlistingtypes']);
        Permission::create(['name' => 'update salesrequestlistingtypes']);
        Permission::create(['name' => 'delete salesrequestlistingtypes']);

        Permission::create(['name' => 'list salesrequestlocations']);
        Permission::create(['name' => 'view salesrequestlocations']);
        Permission::create(['name' => 'create salesrequestlocations']);
        Permission::create(['name' => 'update salesrequestlocations']);
        Permission::create(['name' => 'delete salesrequestlocations']);

        Permission::create(['name' => 'list salesrequestmunicipalities']);
        Permission::create(['name' => 'view salesrequestmunicipalities']);
        Permission::create(['name' => 'create salesrequestmunicipalities']);
        Permission::create(['name' => 'update salesrequestmunicipalities']);
        Permission::create(['name' => 'delete salesrequestmunicipalities']);

        Permission::create(['name' => 'list sources']);
        Permission::create(['name' => 'view sources']);
        Permission::create(['name' => 'create sources']);
        Permission::create(['name' => 'update sources']);
        Permission::create(['name' => 'delete sources']);

        Permission::create(['name' => 'list statuses']);
        Permission::create(['name' => 'view statuses']);
        Permission::create(['name' => 'create statuses']);
        Permission::create(['name' => 'update statuses']);
        Permission::create(['name' => 'delete statuses']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
