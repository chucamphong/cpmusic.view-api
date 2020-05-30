<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Song;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends Controller
{
    /**
     * Trang chủ
     * @return Renderable
     */
    public function index(): Renderable
    {
        $songQuery = Song::with('artists:id,name')->select(['id', 'name', 'thumbnail', 'other_name'])->limit(6);
        $songs = with(clone $songQuery)->orderByDesc('created_at')->get();
        $topSongs = with(clone $songQuery)->orderByDesc('views')->get();
        $randomSongs = with(clone $songQuery)->inRandomOrder()->get();

        $categories = Category::select(['id', 'name', 'thumbnail'])->limit(6)->get();

        return view('home', compact('songs', 'topSongs', 'categories', 'randomSongs'));
    }
}
