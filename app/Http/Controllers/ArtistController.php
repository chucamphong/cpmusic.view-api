<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Contracts\Support\Renderable;

class ArtistController extends Controller
{
    /**
     * Trang hiển thị toàn bộ nghệ sĩ
     * @return Renderable
     */
    public function index(): Renderable
    {
        $artists = Artist::select(['id', 'name', 'avatar'])
            ->orderBy('name')->paginate();

        return view('artist-index', compact('artists'));
    }

    /**
     * Trang xem thông tin một nghệ sĩ
     * @param int $artistId
     * @return Renderable
     */
    public function show(int $artistId): Renderable
    {
        /** @var Artist $artist */
        $artist = Artist::withCount('songs')
            ->findOrFail($artistId);

        $songs = $artist->songs()->with('artists')
            ->orderByDesc('created_at')
            ->paginate();

        return view('artist', compact('artist', 'songs'));
    }
}
