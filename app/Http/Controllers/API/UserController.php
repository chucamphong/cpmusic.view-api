<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function index(Request $request)
    {
        $this->authorize('viewAny', $request->user());

        $users = QueryBuilder::for(User::class)
            ->allowedFields(['id', 'name', 'email'])
            ->allowedFilters(['id', 'name', 'email'])
            ->allowedSorts('id')
            ->jsonPaginate();

        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param string $user
     * @param Request $request
     * @return UserResource
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(string $user, Request $request)
    {
        $user = ($user === 'me') ? $request->user() : User::findOrFail($user);

        $this->authorize('view', $user);

        return UserResource::make($user);
    }

    /**
     * @param UpdateRequest $request
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(UpdateRequest $request, User $user)
    {
        $this->authorize('update', $user);

        $data = $request->only('name', 'password', 'avatar');

        // Cập nhật chức vụ
        if ($request->has('role')) {
            $user->syncRoles($request->get('role'));
        }

        // Cập nhật lại dữ liệu
        if (!$user->update($data)) {
            // Đăng xuất khỏi tất cả các thiết bị đang đăng nhập nếu cập nhật chức vụ hoặc mật khẩu
            if ($request->has('role') || $request->has('password')) {
                $user->tokens()->delete();
            }

            return response()->json([
                'data' => [
                    'message' => "Không thể cập nhật tài khoản $user->name"
                ]
            ]);
        }

        return response()->json([
            'data' => [
                'message' => "Cập nhật thành công tài khoản $user->name"
            ]
        ]);
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        try {
            $user->delete();
            return response()->json([
                'message' => "Xóa thành công tài khoản $user->name"
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Xóa thất bại'
            ], Response::HTTP_EXPECTATION_FAILED);
        }
    }
}
