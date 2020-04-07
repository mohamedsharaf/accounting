<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class Roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        //Roles = POS,accounting,Super-admin

        // create permissions 
        Permission::create(['name' => 'read']);
        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'delete']);
        Permission::create(['name' => 'write']);
        Permission::create(['name' => 'unpublish']);
        Permission::create(['name' => 'publish']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'employee']);
        $role1->givePermissionTo('read');
        $role1->givePermissionTo('write');

        $role2 = Role::create(['name' => 'admin']);
        $role2->givePermissionTo('read');
        $role2->givePermissionTo('write');
        $role2->givePermissionTo('publish');
        $role2->givePermissionTo('unpublish');
        $role2->givePermissionTo('edit');

        $role3 = Role::create(['name' => 'super-admin']);
        // gets all permissions via Gate::before rule; see AuthServiceProvider
        $role3->givePermissionTo('read');
        $role3->givePermissionTo('write');
        $role3->givePermissionTo('publish');
        $role3->givePermissionTo('unpublish');
        $role3->givePermissionTo('edit');
        $role3->givePermissionTo('delete');

        // create demo users
        $user = Factory(App\User::class)->create([
            'name' => 'employee',
            'email' => 'e@e.com',
            'password' => bcrypt('112233'),
        ]);
        $user->assignRole($role1);

        $user = Factory(App\User::class)->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('112233'),
        ]);
        $user->assignRole($role2);

        $user = Factory(App\User::class)->create([
            'name' => 'super',
            'email' => 'super@super.com',
            'password' => bcrypt('112233'),
        ]);
        $user->assignRole($role3);
    }
}
