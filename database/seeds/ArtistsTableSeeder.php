<?php

use App\Models\Artist;
use Illuminate\Database\Seeder;

class ArtistsTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(Artist::class, 20)->create([
            'avatar'    => 'avatars/artists/HuongTram.jpg'
        ]);

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

        factory(Artist::class)->create([
            'name'      => 'Hòa Minzy',
            'avatar'    => 'avatars/artists/HoaMinzy.jpg'
        ]);

        factory(Artist::class)->create([
            'name'      => 'Mr Siro',
            'avatar'    => 'avatars/artists/MrSiro.jpg'
        ]);

        factory(Artist::class)->create([
            'name'      => 'Trúc Nhân',
            'avatar'    => 'avatars/artists/TrucNhan.jpg'
        ]);

        factory(Artist::class)->create([
            'name'      => 'MIN',
            'avatar'    => 'avatars/artists/MIN.jpg'
        ]);

        factory(Artist::class)->create([
            'name'      => 'Mr.A',
            'avatar'    => 'avatars/artists/MrA.jpg'
        ]);
    }
}
