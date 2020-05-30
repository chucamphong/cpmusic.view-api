<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate();
        return view('category-index', compact('categories'));
    }

    /**
     * @param int $categoryId
     * @return Renderable
     */
    public function show(int $categoryId): Renderable
    {
        /** @var Category $category */
        $category = Category::withCount('songs')
            ->findOrFail($categoryId);

        $songs = $category->songs()
            ->with('artists:id,name')
            ->orderByDesc('created_at')
            ->paginate();

        return view('category', compact('category', 'songs'));
    }
}
