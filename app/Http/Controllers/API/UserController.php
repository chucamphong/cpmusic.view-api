<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{
    /**
     * Trả về danh sách tài khoản (có phân trang)
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @noinspection PhpUndefinedMethodInspection
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
     * @param StoreRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('create', User::class);

        $data = $request->only('name', 'email', 'password', 'avatar');
        $model = User::create($data);

        // Nếu có trường role trong request
        if ($request->has('role')) {
            // Chỗ kiểm tra quyền create.users.role sẽ được xử StoreRequest xử lý
            $model->assignRole($request->get('role'));

            return response()->json([
                'data' => [
                    'message' => "Tạo tài khoản $model->name thành công"
                ]
            ], Response::HTTP_CREATED);
        } else {
            $model->assignRole('member');

            return response()->json([
                'data' => [
                    'message' => "Tạo thành công tài khoản $model->name"
                ]
            ], Response::HTTP_CREATED);
        }
    }

    /**
     * Lấy thông tin của tài khoản
     * Nếu $user là me thì sẽ lấy thông tin của chính tài khoản đó
     * Ngược lại sẽ lấy theo $user->id
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
     * Cập nhật thông tin cho tài khoản
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

        // Chỉnh sửa thành công
        if ($user->update($data)) {
            // Đăng xuất khỏi tất cả các thiết bị đang đăng nhập nếu cập nhật chức vụ hoặc mật khẩu
            if ($request->has('role') || $request->has('password')) {
                $user->tokens()->delete();
            }

            // Trả về thông báo thành công
            return response()->json([
                'data' => [
                    'message' => "Cập nhật thành công tài khoản $user->name"
                ]
            ]);
        }

        // Trả về thông báo thất bại
        return response()->json([
            'data' => [
                'message' => "Không thể cập nhật tài khoản $user->name"
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
