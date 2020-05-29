<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;

class SongController extends Controller
{
    /**
     * Trang nghe bài hát
     * @param Song|Builder $song
     * @return Renderable
     */
    public function listen(Song $song): Renderable
    {
        $song->increment('views', 1);

        $relatedSongs = Song::with('artists:id,name')
            // Tìm các bài hát có cùng nghệ sĩ
            ->whereHas('artists', function (Builder $query) use ($song) {
                return $query->whereIn('id', $song['artists']->pluck('pivot.artist_id'));
            })
            // Hoặc các bài hát có cùng thể loại
            ->orWhere('category_id', $song->category_id)
            // Lấy ngẫu nhiên 6 bài hát
            ->inRandomOrder()->limit(6)->get();

        return view('listen', compact('song', 'relatedSongs'));
    }

    /**
     * Trang xem bảng xếp hạng bài hát theo lượt nghe
     * @return Renderable
     */
    public function mostViewed(): Renderable
    {
        $title = 'Bảng xếp hạng bài hát';
        $songs = Song::with('artists')->orderByDesc('views')->limit(25)->get();

        return view('top', compact('title', 'songs'));
    }
}
