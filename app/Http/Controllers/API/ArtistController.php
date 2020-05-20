<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\Artist\StoreRequest;
use App\Http\Requests\Artist\UpdateRequest;
use App\Http\Resources\ArtistResource;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\QueryBuilder;

class ArtistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum')->except('index', 'show');
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

    public function store(StoreRequest $request)
    {
        $artist = Artist::create($request->all());

        if ($artist->exists) {
            return response()->json([
                'data' => [
                    'message' => "Tạo thành công nghệ sĩ $artist->name"
                ]
            ]);
        }

        return response()->json([
            'data' => [
                'message' => "Tạo nghệ sĩ {$request->get('name')} thất bại"
            ]
        ]);
    }

    public function show(Artist $artist)
    {
        return ArtistResource::make($artist);
    }

    public function update(UpdateRequest $request, Artist $artist)
    {
        if ($artist->update($request->all())) {
            return response()->json([
                'data' => [
                    'message' => "Cập nhật thành công nghệ sĩ $artist->name"
                ]
            ]);
        }

        return response()->json([
            'data' => [
                'message' => "Cập nhật nghệ sĩ $artist->name thất bại"
            ]
        ]);
    }

    public function destroy(Artist $artist)
    {
        try {
            $artist->delete();
            return response()->json([
                'message' => "Xóa thành công nghệ sĩ $artist->name"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Xóa thất bại nghệ sĩ $artist->name"
            ], Response::HTTP_EXPECTATION_FAILED);
        }
    }
}
