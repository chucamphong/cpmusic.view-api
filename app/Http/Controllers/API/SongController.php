<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Song\StoreRequest;
use App\Http\Requests\Song\UpdateRequest;
use App\Http\Resources\SongResource;
use App\Models\Category;
use App\Models\Song;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SongController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index', 'show');
        $this->authorizeResource(Song::class);
    }

    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @noinspection PhpUndefinedMethodInspection
     */
    public function index()
    {
        $songs = QueryBuilder::for(Song::class)
            ->allowedFields(
                'id', 'name', 'other_name', 'thumbnail', 'url', 'year', 'views', 'category_id',
                'artists.name', 'artists.thumbnail',
                'category.id', 'category.name'
            )
            ->allowedIncludes('category', 'artists')
            ->allowedFilters([AllowedFilter::scope('search')])
            ->allowedAppends('slug')
            ->allowedSorts('id', 'views', 'created_at')
            ->jsonPaginate();

        return SongResource::collection($songs);
    }

    public function store(StoreRequest $request)
    {
        try {
            $song = Song::make($request->all());
            $category = Category::whereName($request->get('category'))->first();
            $song->category()->associate($category);
            $song->saveOrFail();
            $song->setArtist($request->get('artists'));

            return response()->json([
                'data' => [
                    'message' => "Tạo thành công bài hát $song->name"
                ]
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'data' => [
                    'message' => "Tạo bài hát {$request->get('name')} thất bại"
                ]
            ]);
        }
    }

    /**
     * @param Song $song
     * @return SongResource
     */
    public function show(Song $song)
    {
        return SongResource::make($song);
    }

    public function update(UpdateRequest $request, Song $song)
    {
        if ($request->has('category')) {
            $song->setCategory($request->get('category'));
        }

        if ($request->has('artists')) {
            $song->setArtist($request->get('artists'));
        }

        if ($song->update($request->all())) {
            return response()->json([
                'data' => [
                    'message' => "Cập nhật thành công bài hát $song->name"
                ]
            ]);
        }

        return response()->json([
            'data' => [
                'message' => "Cập nhật bài hát $song->name thất bại"
            ]
        ]);
    }

    /**
     * @param Song $song
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Song $song)
    {
        try {
            $song->delete();
            return response()->json([
                'message' => "Xóa thành công bài hát $song->name"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Xóa thất bại bài hát $song->name"
            ], Response::HTTP_EXPECTATION_FAILED);
        }
    }
}
