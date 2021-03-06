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
                    @if (session()->exists('status'))
                        <div class="alert alert-{{ session('status') }} alert-dismissible fade show" role="alert">
                            <span class="alert-text">{{ session('msg') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif
                    <form method="post" action="{{ route('account.update') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Tên hiển thị -->
                        <div class="form-group row">
                            <label for="name" class="col-md-3 col-form-label text-md-right">Tên hiển thị</label>

                            <div class="col-md-9">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ $user->name }}" autocomplete="name" autofocus/>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Địa chỉ email -->
                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">Địa chỉ Email</label>

                            <div class="col-md-9">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                       value="{{ $user->email }}" required disabled />

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Ảnh đại diện -->
                        <div class="form-group row">
                            <label for="avatar" class="col-md-3 col-form-label text-md-right">Ảnh đại diện</label>

                            <div class="col-md-9">
                                <div class="custom-file">
                                    <input name="avatar" type="file"
                                           class="custom-file-input @error('avatar') is-invalid @enderror" id="avatar"
                                           lang="en" accept="image/png, image/jpeg"/>
                                    <label class="custom-file-label" for="avatar"></label>

                                    @error('avatar')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
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
            <a href="{{ route('account.change-password') }}">Đổi mật khẩu</a>
        </div>
    </div>
@endsection
