<div class="box-menu">
    <div class="wrap-menu">
        <div class="menu-btn"><i class="fa-solid fa-bars"></i>Menu</div>
        <div class="namepage">{{ $url }}</div>
        <div class="userinfo">
            <a href="{{ route('index') }}" target="_blank" class="gotoindex">Quay lại web</a>
            <span> | </span>
            Chào bạn, <b>{{ Auth::guard('admin')->user()->name }}</b>, <a href="{{ route('admin.logout') }}">Đăng
                xuất</a>
        </div>
    </div>
</div>
