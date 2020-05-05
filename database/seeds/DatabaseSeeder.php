<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RolesAndPermissionsSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ArtistsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(SongsTableSeeder::class);
        $this->call(HistoriesTableSeeder::class);
    }
}
