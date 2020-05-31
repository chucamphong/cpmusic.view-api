<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateRequest;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Trang hiển thị thông tin tài khoản
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request): Renderable
    {
        $user = $request->user();

        return view('account.index', compact('user'));
    }

    public function update(Request $request)
    {
        $data = $request->only('name');
        $avatar = $request->file('avatar');

        if (isset($avatar)) {
            $path = $avatar->store('avatars/users');

            if (is_string($path)) {
                $data['avatar'] = $path;
            }
        }

        if ($request->user()->update($data)) {
            $request->session()->flash('status', 'Cập nhật tài khoản hoàn tất');
        } else {
            $request->session()->flash('status', 'Cập nhật tài khoản thất bại');
        }

        return redirect()->route('account.index');
    }
}
