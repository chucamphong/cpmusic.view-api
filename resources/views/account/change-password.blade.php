@extends('layouts.master')

@section('title', 'Đổi mật khẩu')

@section('content')
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    <h1 class="mb-0">Đổi mật khẩu</h1>
                </div>
                <div class="card-body">
                    @if (session()->exists('status'))
                        <div class="alert alert-{{ session('status') }} alert-dismissible fade show" role="alert">
                            <span class="alert-text">{{ session('message') }}</span>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                    @endif

                    <form method="post" action="{{ route('account.update-password') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="password" class="col-md-3 col-form-label text-md-right">Mật khẩu</label>

                            <div class="col-md-9">
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                       autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-3 col-form-label text-md-right">
                                Nhập lại mật khẩu
                            </label>

                            <div class="col-md-9">
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation" autocomplete="new-password">
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
