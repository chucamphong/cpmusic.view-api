<?php

namespace App\Http\Controllers;

use App\Models\Artist;

class ArtistController extends Controller
{
    public function show(int $artistId)
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
