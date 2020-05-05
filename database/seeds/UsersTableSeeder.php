<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(User::class)->create([
            'name' => 'Chu Cẩm Phong',
            'email' => 'admin@gmail.com',
        ])->assignRole('admin');

        factory(User::class)->create([
            'name' => 'Admin 2',
            'email' => 'admin2@gmail.com',
        ])->assignRole('admin');

        factory(User::class)->create([
            'email' => 'mod@gmail.com',
        ])->assignRole('mod');

        factory(User::class)->create([
            'email' => 'mod2@gmail.com',
        ])->assignRole('mod');

        factory(User::class)->create([
            'email' => 'member@gmail.com',
        ])->assignRole('member');

        for ($i = 0; $i < 100; $i++) {
            factory(User::class)->create()->assignRole('member');
        }
    }
}
