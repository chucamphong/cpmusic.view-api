<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index', 'show');
        $this->authorizeResource(Category::class);
    }

    /** @noinspection PhpUndefinedMethodInspection */
    public function index(Request $request)
    {
        $categories = QueryBuilder::for(Category::class)
            ->allowedFields('name')
            ->allowedFilters('name')
            ->allowedIncludes('songsCount')
            ->allowedSorts('id');

        if ($request->has('page')) {
            $categories = $categories->jsonPaginate();
        } else {
            $categories = $categories->get();
        }

        return CategoryResource::collection($categories);
    }

    public function store(StoreRequest $request)
    {
        $category = Category::create($request->all());

        if ($category->exists) {
            return response()->json([
                'data' => [
                    'message' => "Tạo thành công thể loại $category->name"
                ]
            ]);
        }

        return response()->json([
            'data' => [
                'message' => "Tạo thể loại {$request->get('name')} thất bại"
            ]
        ]);
    }


    public function show(Category $category)
    {
        return CategoryResource::make($category);
    }

    public function update(UpdateRequest $request, Category $category)
    {
        if ($category->update($request->all())) {
            return response()->json([
                'data' => [
                    'message' => "Cập nhật thành công thể loại $category->name"
                ]
            ]);
        }

        return response()->json([
            'data' => [
                'message' => "Cập nhật thể loại $category->name thất bại"
            ]
        ]);
    }

    public function destroy(Category $category)
    {
        try {
            $category->delete();
            return response()->json([
                'message' => "Xóa thành công thể loại $category->name"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Xóa thất bại thể loại $category->name"
            ], Response::HTTP_EXPECTATION_FAILED);
        }
    }
}
