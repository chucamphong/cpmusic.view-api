<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SongResource;
use App\Models\Song;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SongController extends Controller
{
    public function __construct()
    {
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

    public function store(Request $request)
    {
        //
    }

    /**
     * @param Song $song
     * @return SongResource
     */
    public function show(Song $song)
    {
        return SongResource::make($song);
    }

    public function update(Request $request, Song $song)
    {
        //
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
