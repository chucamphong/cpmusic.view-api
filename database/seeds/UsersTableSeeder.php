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
            'name' => 'Chu Cẩm Phong',
            'email' => 'chucamphong@gmail.com',
        ])->assignRole('admin');

        factory(User::class)->create([
            'name' => 'Nguyễn Xuân Hòa',
            'email' => 'nguyenxuanhoa@gmail.com',
        ])->assignRole('mod');

        factory(User::class)->create([
            'name' => 'Dương Việt Hoàng',
            'email' => 'duongviethoang@gmail.com',
        ])->assignRole('member');
    }
}
