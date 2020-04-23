<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SongResource;
use App\Models\Song;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class SongController extends Controller
{
    /**
     * @param Request $request
     * @return
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @noinspection PhpUndefinedMethodInspection
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', $request->user());

        $songs = QueryBuilder::for(Song::class)
            ->allowedFields(['id', 'name'])
            ->allowedFilters(['id', 'name', 'other_name'])
            ->allowedSorts('id')
            ->jsonPaginate();

        return SongResource::collection($songs);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Song $song)
    {
        //
    }

    public function update(Request $request, Song $song)
    {
        //
    }

    public function destroy(Song $song)
    {
        //
    }
}
