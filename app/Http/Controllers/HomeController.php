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
        $songs = Song::with('artists:id,name')->limit(6)->orderByDesc('created_at')->get();
        $categories = Category::select(['id', 'name', 'thumbnail'])->limit(6)->get();
        return view('home', compact('songs', 'categories'));
    }
}
