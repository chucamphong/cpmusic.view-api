<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
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

        // Quản lý nghệ sĩ
        Permission::create(['name' => 'create.artists']);
        Permission::create(['name' => 'view.artists']);
        Permission::create(['name' => 'update.artists']);
        Permission::create(['name' => 'delete.artists']);

        // Quản lý thể loại
        Permission::create(['name' => 'create.categories']);
        Permission::create(['name' => 'view.categories']);
        Permission::create(['name' => 'update.categories']);
        Permission::create(['name' => 'delete.categories']);

        /** @var Role $role */
        $role = Role::create(['name' => 'admin']);
        $role->givePermissionTo(Permission::all());

        $role = Role::create(['name' => 'mod']);
        $role->givePermissionTo([
            'create.users', 'view.users', 'update.users', 'delete.users',
            'view.me', 'update.me',
            'create.songs', 'view.songs', 'update.songs', 'delete.songs',
            'create.artists', 'view.artists', 'update.artists', 'delete.artists',
            'create.categories', 'view.categories', 'update.categories', 'delete.categories',
        ]);

        // or may be done by chaining
        $role = Role::create(['name' => 'member']);
        $role->givePermissionTo([
            'view.me', 'update.me',
            'view.songs',
            'view.artists',
            'view.categories',
        ]);
    }
}
