<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

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
     * Lấy bảng xếp hạng bài hát thuộc quốc gia đó
     * @param string $country
     * @return array
     */
    private function getSongChartsOf(string $country): array
    {
        switch ($country) {
            case 'Việt Nam':
                $title = 'Bảng xếp hạng bài hát Việt Nam';
                break;
            case 'US-UK':
                $title = 'Bảng xếp hạng bài hát US-UK';
                break;
            case 'Hàn Quốc':
                $title = 'Bảng xếp hạng bài hát Hàn Quốc';
                break;
            default:
                abort(404);
                break;
        }

        $songs = Song::with('artists:id,name')
            ->select('id', 'name', 'other_name', 'thumbnail')
            ->where('country', '=', $country)
            ->orderByDesc('views')
            ->limit(25)->get();

        /** @noinspection PhpUndefinedVariableInspection */
        return [$title, $songs];
    }

    /**
     * Trang xem bảng xếp hạng bài hát theo lượt nghe
     * @param Request $request
     * @return Renderable
     * @noinspection PhpUnused
     */
    public function topSongs(Request $request): Renderable
    {
        // Lấy bảng xếp bài hát có quốc gia X
        if ($request->has('country')) {
            $country = $request->get('country');
            [$title, $songs] = $this->getSongChartsOf($country);
        }
        // Lấy bảng xếp bài hát không phân biệt quốc gia
        else {
            $title = 'Bảng xếp hạng bài hát';
            $songs = Song::with('artists')->orderByDesc('views')->limit(25)->get();
        }

        return view('top', compact('title', 'songs'));
    }

    /**
     * Trang hiển thị các bài hát mới phát hành
     */
    public function newSongs()
    {
        $songs = Song::with('artists:id,name')
            ->select(['id', 'name', 'thumbnail', 'other_name'])
            ->orderByDesc('created_at')
            ->paginate(25);

        return view('new-songs', compact('songs'));
    }
}
