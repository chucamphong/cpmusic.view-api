<?php

use App\Models\Artist;
use App\Models\Song;
use Illuminate\Database\Seeder;

class SongsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Song::class, 60)->create()->each(function (Song $song) {
            $song->artists()->attach(Artist::inRandomOrder()->limit(1)->get());
        });
    }
}
