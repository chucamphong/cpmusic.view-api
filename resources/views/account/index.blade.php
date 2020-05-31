@extends('layouts.master')

@section('title', 'Quản lý tài khoản')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="mb-0">Quản Lý Tài Khoản</h1>
                    <small>Chỉnh sửa thông tin tài khoản cá nhân</small>
                </div>
                <div class="card-body">
                    {{ session('status') }}
                    <form method="post" action="{{ route('account.update') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">Tên hiển thị</label>

                            <div class="col-md-9">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ $user->name }}" autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">Địa chỉ Email</label>

                            <div class="col-md-9">
                                <input id="email" disabled type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-3 col-form-label text-md-right">Mật khẩu</label>--}}

{{--                            <div class="col-md-9">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">--}}

{{--                                @error('password')--}}
{{--                                <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password-confirm" class="col-md-3 col-form-label text-md-right">Nhập lại mật khẩu</label>--}}

{{--                            <div class="col-md-9">--}}
{{--                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="form-group row">
                            <label for="avatar" class="col-md-3 col-form-label text-md-right">Ảnh đại diện</label>

                            <div class="col-md-9">
                                <div class="custom-file">
                                    <input name="avatar" type="file" class="custom-file-input" id="avatar" lang="en" />
                                    <label class="custom-file-label" for="avatar"></label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block">
                                    Cập Nhật
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
