<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function show(int $artistId)
    {
        $artist = Artist::withCount('songs')
            ->findOrFail($artistId);

        $songs = $artist->songs()->with('artists')->paginate();

        return view('artist', compact('artist', 'songs'));
    }
}
