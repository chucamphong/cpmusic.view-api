<?php

use App\Models\Song;
use Illuminate\Database\Seeder;

class SongsTableSeeder extends Seeder
{
    public function run(): void
    {
//        factory(Song::class, 60)->create()->each(function (Song $song) {
//            $song->artists()->attach(Artist::inRandomOrder()->limit(1)->get());
//        });

        factory(Song::class)->create([
            'name' => 'Anh ơi ở lại',
            'other_name' => 'Cám Tấm',
            'thumbnail' => 'songs/thumbnails/AnhOiOLai.jpg',
            'url' => 'songs/AnhOiOLai.mp3',
            'country' => 'Việt Nam',
        ])->setCategory('Nhạc trẻ')->setArtist('Chi Pu');

        factory(Song::class)->create([
            'name' => 'Cảm giác lúc ấy sẽ ra sao',
            'other_name' => null,
            'thumbnail' => 'songs/thumbnails/CamGiacLucAySeRaSao.jpg',
            'url' => 'songs/CamGiacLucAySeRaSao.mp3',
            'country' => 'Việt Nam',
        ])->setCategory('Nhạc trẻ')->setArtist('Lou Hoàng');

        factory(Song::class)->create([
            'name' => 'Kill this love',
            'other_name' => null,
            'thumbnail' => 'songs/thumbnails/KillThisLove.jpg',
            'url' => 'songs/KillThisLove.mp3',
            'country' => 'Hàn Quốc',
        ])->setCategory('Nhạc Hàn Quốc')->setArtist('BLACKPINK');

        factory(Song::class)->create([
            'name' => 'Du ddu du ddu',
            'other_name' => null,
            'thumbnail' => 'songs/thumbnails/DuDduDuDdu.jpg',
            'url' => 'songs/DuDduDuDdu.mp3',
            'country' => 'Hàn Quốc',
        ])->setCategory('Nhạc Hàn Quốc')->setArtist('BLACKPINK');

        factory(Song::class)->create([
            'name' => 'Boombayah',
            'other_name' => null,
            'thumbnail' => 'songs/thumbnails/Boombayah.jpg',
            'url' => 'songs/Boombayah.mp3',
            'country' => 'Hàn Quốc',
        ])->setCategory('Nhạc Hàn Quốc')->setArtist('BLACKPINK');

        factory(Song::class)->create([
            'name' => 'Em gái mưa',
            'other_name' => null,
            'thumbnail' => 'songs/thumbnails/EmGaiMua.jpg',
            'url' => 'songs/EmGaiMua.mp3',
            'country' => 'Việt Nam',
        ])->setCategory('Nhạc Trẻ')->setArtist('Hương Tràm');

        factory(Song::class)->create([
            'name' => 'Không thể cùng nhau suốt kiếp',
            'other_name' => null,
            'thumbnail' => 'songs/thumbnails/KhongTheCungNhauSuotKiep.jpg',
            'url' => 'songs/KhongTheCungNhauSuotKiep.mp3',
            'country' => 'Việt Nam',
        ])->setCategory('Nhạc Trẻ')->setArtist('Hòa Minzy', 'Mr Siro');

        factory(Song::class)->create([
            'name' => 'Muốn khóc thật to',
            'other_name' => null,
            'thumbnail' => 'songs/thumbnails/MuonKhocThatTo.jpg',
            'url' => 'songs/MuonKhocThatTo.mp3',
            'country' => 'Việt Nam',
        ])->setCategory('Nhạc Trẻ')->setArtist('Trúc Nhân');

        factory(Song::class)->create([
            'name' => 'Bốn chữ lắm',
            'other_name' => null,
            'thumbnail' => 'songs/thumbnails/BonChuLam.jpg',
            'url' => 'songs/BonChuLam.mp3',
            'country' => 'Việt Nam',
        ])->setCategory('Nhạc Trẻ')->setArtist('Trúc Nhân', 'Trương Thảo Nhi');

        factory(Song::class)->create([
            'name' => 'Tìm',
            'other_name' => null,
            'thumbnail' => 'songs/thumbnails/Tim.jpg',
            'url' => 'songs/Tim.mp3',
            'country' => 'Việt Nam',
        ])->setCategory('Nhạc Trẻ')->setArtist('MIN', 'Mr.A');
    }
}
