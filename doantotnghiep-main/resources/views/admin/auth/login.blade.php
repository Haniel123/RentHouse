@extends('admin.auth.index')
@section('body')
    <div class="auth-header">
        <a>
            Quay lại trang chủ
        </a>
    </div>
    <div class="auth-template">
        <form class="auth-form" method="POST" action="{{ route('admin.login') }}">
            @csrf
            <div class="form-name">Đăng nhập quản trị</div>
            <input class="auth-input" type="text" name="username" id="username" placeholder="Tên Đăng nhập">
            <input class="auth-input" type="password" name="password" id="password" placeholder="Mật khẩu">
            <button type="submit">Đăng nhập</button>
        </form>
    </div>
@endsection
