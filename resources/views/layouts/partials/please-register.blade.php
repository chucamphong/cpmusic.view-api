@push('styles')
    <style type="text/css">
        .please-register {
            background: url({{ asset('assets/banner-background.svg') }}) center / cover no-repeat;
        }
    </style>
@endpush

<div class="row">
    <div class="col-12">
        <div class="please-register alert alert-primary alert-dismissible fade show" role="alert">
            <span class="alert-icon"><i class="fas fa-heart"></i></span>
            <span class="alert-text h3 m-0 text-white">Hãy đăng nhập để khám phá nhiều bài hát dành riêng cho bạn</span>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
</div>
