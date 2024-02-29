<?php
$name = Route::currentRouteName();
$url = Route::current()->action['namespace'];
$url = explode('\\', $url);
$url = count($url) == 2 ? $url[1] : ($url[0] == 'Quản Trị' ? 'Trang chủ' : '');
?>

<!DOCTYPE html>
<html lang="vi">
@include('admin.layouts.header')
@include('admin.layouts.head')
@include('admin.layouts.css')

<body class="index">
    <div class="menu-block">
        @include('admin.layouts.menuside')
        <div class="wrap-main">
            @include('admin.layouts.menu')
            @yield('body')
            @include('admin.layouts.footer')
        </div>
    </div>
    @yield('modal')
    @include('admin.layouts.js')
    @yield('javascript')
</body>

</html>
