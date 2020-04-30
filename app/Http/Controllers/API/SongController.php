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
    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @noinspection PhpUndefinedMethodInspection
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', $request->user());

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
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(Song $song)
    {
        $this->authorize('view', $song);

        return SongResource::make($song);
    }

    public function update(Request $request, Song $song)
    {
        //
    }

    /**
     * @param Song $song
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Song $song)
    {
        $this->authorize('delete', $song);

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
