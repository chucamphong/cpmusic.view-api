<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
        ])->assignRole('admin');

        factory(User::class)->create([
            'name' => 'Admin 2',
            'email' => 'admin2@gmail.com',
        ])->assignRole('admin');

        factory(User::class)->create([
            'name' => 'Mod',
            'email' => 'mod@gmail.com',
        ])->assignRole('mod');

        factory(User::class)->create([
            'name' => 'Member',
            'email' => 'member@gmail.com',
        ])->assignRole('member');

        for ($i = 0; $i < 500; $i++) {
            factory(User::class)->create()->assignRole('member');
        }
    }
}
