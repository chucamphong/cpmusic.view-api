<?php

use App\Models\Artist;
use App\Models\Song;
use Illuminate\Database\Seeder;

class SongsTableSeeder extends Seeder
{
    public function run(): void
    {
        factory(Song::class, 60)->create()->each(function (Song $song) {
            $song->artists()->attach(Artist::inRandomOrder()->limit(1)->get());
        });

        factory(Song::class)->create([
            'name' => 'Anh ơi ở lại',
            'other_name' => 'Cám Tấm',
            'thumbnail' => 'thumbnails/AnhOiOLai.jpg',
            'url' => 'songs/AnhOiOLai.mp3',
        ])->setCategory('Nhạc trẻ')->setArtist('Chi Pu');

        factory(Song::class)->create([
            'name' => 'Cảm giác lúc ấy sẽ ra sao',
            'other_name' => null,
            'thumbnail' => 'thumbnails/CamGiacLucAySeRaSao.jpg',
            'url' => 'songs/CamGiacLucAySeRaSao.mp3',
        ])->setCategory('Nhạc trẻ')->setArtist('Lou Hoàng');

        factory(Song::class)->create([
            'name' => 'Kill this love',
            'other_name' => null,
            'thumbnail' => 'thumbnails/KillThisLove.jpg',
            'url' => 'songs/KillThisLove.mp3',
        ])->setCategory('Nhạc Hàn Quốc')->setArtist('BLACKPINK');

        factory(Song::class)->create([
            'name' => 'Du ddu du ddu',
            'other_name' => null,
            'thumbnail' => 'thumbnails/DuDduDuDdu.jpg',
            'url' => 'songs/DuDduDuDdu.mp3',
        ])->setCategory('Nhạc Hàn Quốc')->setArtist('BLACKPINK');

        factory(Song::class)->create([
            'name' => 'Boombayah',
            'other_name' => null,
            'thumbnail' => 'thumbnails/Boombayah.jpg',
            'url' => 'songs/Boombayah.mp3',
        ])->setCategory('Nhạc Hàn Quốc')->setArtist('BLACKPINK');

        factory(Song::class)->create([
            'name' => 'Em gái mưa',
            'other_name' => null,
            'thumbnail' => 'thumbnails/EmGaiMua.jpg',
            'url' => 'songs/EmGaiMua.mp3',
        ])->setCategory('Nhạc Trẻ')->setArtist('Hương Tràm');
    }
}
