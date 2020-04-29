<?php

use App\Models\Artist;
use Illuminate\Database\Seeder;

class ArtistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Artist::class, 20)->create();

        factory(Artist::class)->create([
            'name'      => 'Chi Pu',
            'avatar'    => 'avatars/artists/ChiPu.jpg'
        ]);

        factory(Artist::class)->create([
            'name'      => 'Lou Hoàng',
            'avatar'    => 'avatars/artists/LouHoang.jpg'
        ]);

        factory(Artist::class)->create([
            'name'      => 'BLACKPINK',
            'avatar'    => 'avatars/artists/BlackPink.jpg'
        ]);

        factory(Artist::class)->create([
            'name'      => 'Hương Tràm',
            'avatar'    => 'avatars/artists/HuongTram.jpg'
        ]);
    }
}
