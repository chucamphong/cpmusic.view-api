<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\LoginResponseResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function __construct()
    {
        // Cho phép "guest" truy cập vào tất cả các hàm ngoại trừ hàm logout
        $this->middleware('guest')->except('logout');
        // Cho phép truy cập vào hàm logout với điều kiện đã đăng nhập
        $this->middleware('auth:sanctum')->only('logout');
    }

    /**
     * @param LoginRequest $request
     * @return LoginResponseResource|void
     * @throws ValidationException
     */
    public function login(LoginRequest $request)
    {
        // Lấy thông tin từ $_GET['email'] và $_GET['password']
        $data = $request->only('email', 'password');

        // Tìm kiếm người dùng có email tương ứng
        $user = User::firstWhere('email', $data['email']);

        // Kiểm tra mật khẩu được gửi lên với mật khẩu trong cơ sở dữ liệu có giống nhau hay không
        if (!\Hash::check($data['password'], optional($user)->password)) {
            // Gửi kết quả thất bại
            return $this->sendFailedLoginResponse($request);
        }

        // Gửi kết quả thành công
        return $this->sendLoginResponse($request, $user);
    }

    protected function sendLoginResponse(Request $request, $user)
    {
        return $this->authenticated($request, $user);
    }

    /**
     * @param Request $request
     * @throws ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        throw ValidationException::withMessages([
            'email' => [trans('auth.failed')],
        ]);
    }

    public function authenticated(Request $request, User $user)
    {
        // Lấy các quyền truy cập của $user
        $permissions = $user->getPermissionsViaRoles()->map(function ($value) {
            return $value['name'];
        })->all();

        // Tạo mã đăng nhập và gán quyền cho mã đăng nhập
        $token = $user->createToken(\Str::uuid(), $permissions);

        // Trả về kết quả
        return LoginResponseResource::make($token);
    }

    public function logout(Request $request)
    {
        /** @var User $user */
        // Lấy thông tin của $user đã đăng nhập
        $user = $request->user();

        // Xóa các token của $user này để đăng xuất
        $user->tokens()->delete();

        return response()->json([
            'message' => __('auth.logout_success')
        ]);
    }
}
