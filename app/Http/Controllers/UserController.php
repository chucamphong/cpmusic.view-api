<?php

namespace App\Http\Controllers;

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
        $request->validate([
            'name' => ['string', 'min:8', 'max:255'],
            'avatar' => ['image', 'mimes:jpeg,jpg,png', 'max:2048']
        ]);
        $data = $request->only('name');
        $avatar = $request->file('avatar');

        if (isset($avatar)) {
            $path = $avatar->store('avatars/users');

            if (is_string($path)) {
                $data['avatar'] = $path;
            }
        }

        if ($request->user()->update($data)) {
            $request->session()->flash('status', 'success');
            $request->session()->flash('msg', 'Cập nhật tài khoản hoàn tất');
        } else {
            $request->session()->flash('status', 'error');
            $request->session()->flash('msg', 'Cập nhật tài khoản thất bại');
        }

        return redirect()->route('account.index');
    }
}
