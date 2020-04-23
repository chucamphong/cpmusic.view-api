<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        // Chỉnh sửa thông tin cá nhân
        Permission::create(['name' => 'view.me']);
        Permission::create(['name' => 'update.me']);

        // Quản lý thành viên
        Permission::create(['name' => 'create.users']);
        Permission::create(['name' => 'create.users.role']);
        Permission::create(['name' => 'view.users']);
        Permission::create(['name' => 'update.users']);
        Permission::create(['name' => 'update.users.permissions']);
        Permission::create(['name' => 'delete.users']);

        // Quản lý bài hát
        Permission::create(['name' => 'create.songs']);
        Permission::create(['name' => 'view.songs']);
        Permission::create(['name' => 'update.songs']);
        Permission::create(['name' => 'delete.songs']);

        /** @var Role $role */
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'mod']);
        $role->givePermissionTo([
            'create.users', 'view.users', 'update.users', 'delete.users',
            'view.me', 'update.me',
            'create.songs', 'view.songs', 'update.songs', 'delete.songs',
        ]);

        // or may be done by chaining
        $role = Role::create(['name' => 'member']);
        $role->givePermissionTo(['view.me', 'update.me']);


    }
}
