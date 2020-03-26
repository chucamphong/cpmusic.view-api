<?php

use App\Models\History;
use App\Models\Song;
use App\Models\User;
use Illuminate\Database\Seeder;

class HistoriesTableSeeder extends Seeder
{
    private function randomData()
    {
        $user = User::inRandomOrder()->first();
        $song = Song::inRandomOrder()->first();

        return [
            'user_id' => $user->id,
            'song_id' => $song->id,
        ];
    }

    public function run(): void
    {
        for ($i = 1; $i <= 10; $i++) {
            History::create($this->randomData());
        }
    }
}
