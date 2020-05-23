<?php

namespace App\Http\Controllers;

use App\Models\Song;
use Illuminate\Contracts\Support\Renderable;

class SongController extends Controller
{
    public function listen(Song $song): Renderable
    {
        return view('listen', compact('song'));
    }
}
