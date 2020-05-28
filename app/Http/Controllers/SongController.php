<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;

class SongController extends Controller
{
    /**
     * Trang nghe bài hát
     * @param int $id ID bài hát
     * @return Renderable
     */
    public function listen(int $id): Renderable
    {
        /** @var Song|Builder $song */
        $song = Song::with('artists:name')
            ->select('id', 'name', 'thumbnail', 'url', 'views', 'category_id')
            ->findOrFail($id);

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
}
