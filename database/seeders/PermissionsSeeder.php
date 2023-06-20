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

        Permission::create(['name' => 'list customers']);
        Permission::create(['name' => 'view customers']);
        Permission::create(['name' => 'create customers']);
        Permission::create(['name' => 'update customers']);
        Permission::create(['name' => 'delete customers']);

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

        Permission::create(['name' => 'list features']);
        Permission::create(['name' => 'view features']);
        Permission::create(['name' => 'create features']);
        Permission::create(['name' => 'update features']);
        Permission::create(['name' => 'delete features']);

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

        Permission::create(['name' => 'list listingrequests']);
        Permission::create(['name' => 'view listingrequests']);
        Permission::create(['name' => 'create listingrequests']);
        Permission::create(['name' => 'update listingrequests']);
        Permission::create(['name' => 'delete listingrequests']);

        Permission::create(['name' => 'list locations']);
        Permission::create(['name' => 'view locations']);
        Permission::create(['name' => 'create locations']);
        Permission::create(['name' => 'update locations']);
        Permission::create(['name' => 'delete locations']);

        Permission::create(['name' => 'list municipalities']);
        Permission::create(['name' => 'view municipalities']);
        Permission::create(['name' => 'create municipalities']);
        Permission::create(['name' => 'update municipalities']);
        Permission::create(['name' => 'delete municipalities']);

        Permission::create(['name' => 'list pages']);
        Permission::create(['name' => 'view pages']);
        Permission::create(['name' => 'create pages']);
        Permission::create(['name' => 'update pages']);
        Permission::create(['name' => 'delete pages']);

        Permission::create(['name' => 'list propertytypes']);
        Permission::create(['name' => 'view propertytypes']);
        Permission::create(['name' => 'create propertytypes']);
        Permission::create(['name' => 'update propertytypes']);
        Permission::create(['name' => 'delete propertytypes']);

        Permission::create(['name' => 'list requestappointments']);
        Permission::create(['name' => 'view requestappointments']);
        Permission::create(['name' => 'create requestappointments']);
        Permission::create(['name' => 'update requestappointments']);
        Permission::create(['name' => 'delete requestappointments']);

        Permission::create(['name' => 'list allsalespeople']);
        Permission::create(['name' => 'view allsalespeople']);
        Permission::create(['name' => 'create allsalespeople']);
        Permission::create(['name' => 'update allsalespeople']);
        Permission::create(['name' => 'delete allsalespeople']);

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
