<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArtistResource;
use App\Models\Artist;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class ArtistController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Artist::class);
    }

    /**
     * Lấy tất cả nghệ sĩ có trong bảng và trả về
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @noinspection PhpUndefinedMethodInspection
     */
    public function index(Request $request)
    {
        $artists = QueryBuilder::for(Artist::class)
            ->allowedFields('name')
            ->allowedFilters('name')
            ->allowedIncludes('songsCount')
            ->allowedSorts('id');

        $artists = $request->has('page') ? $artists->jsonPaginate() : $artists->get();

        return ArtistResource::collection($artists);
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Artist $artist)
    {
        //
    }

    public function update(Request $request, Artist $artist)
    {
        //
    }

    public function destroy(Artist $artist)
    {
        //
    }
}
