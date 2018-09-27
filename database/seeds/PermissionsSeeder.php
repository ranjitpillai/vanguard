<?php

use Vanguard\Permission;
use Vanguard\Role;
use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('name', 'Admin')->first();

        $permissions[] = Permission::create([
            'name' => 'users.manage',
            'display_name' => 'Manage Users',
            'description' => 'Manage users and their sessions.',
            'removable' => false
        ]);

        $permissions[] = Permission::create([
            'name' => 'users.activity',
            'display_name' => 'View System Activity Log',
            'description' => 'View activity log for all system users.',
            'removable' => false
        ]);

        $permissions[] = Permission::create([
            'name' => 'roles.manage',
            'display_name' => 'Manage Roles',
            'description' => 'Manage system roles.',
            'removable' => false
        ]);

        $permissions[] = Permission::create([
            'name' => 'permissions.manage',
            'display_name' => 'Manage Permissions',
            'description' => 'Manage role permissions.',
            'removable' => false
        ]);

        $permissions[] = Permission::create([
            'name' => 'settings.general',
            'display_name' => 'Update General System Settings',
            'description' => '',
            'removable' => false
        ]);

        $permissions[] = Permission::create([
            'name' => 'settings.auth',
            'display_name' => 'Update Authentication Settings',
            'description' => 'Update authentication and registration system settings.',
            'removable' => false
        ]);

        $permissions[] = Permission::create([
            'name' => 'settings.notifications',
            'display_name' => 'Update Notifications Settings',
            'description' => '',
            'removable' => false
        ]);
		$permissions[] = Permission::create([
            'name' => 'manage.companies',
            'display_name' => 'Manage Companies',
            'description' => 'Manage Companies',
            'removable' => true
        ]);
		$permissions[] = Permission::create([
            'name' => 'devices',
            'display_name' => 'devices',
            'description' => 'devices',
            'removable' => true
        ]);
		$permissions[] = Permission::create([
            'name' => 'company.profile',
            'display_name' => 'Company Profile',
            'description' => 'Company Profile',
            'removable' => true
        ]);
		$permissions[] = Permission::create([
            'name' => 'Transactions',
            'display_name' => 'Transactions',
            'description' => 'Transactions',
            'removable' => true
        ]);

        $adminRole->attachPermissions($permissions);
    }
}
