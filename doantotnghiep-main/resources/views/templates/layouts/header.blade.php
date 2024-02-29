<div class="header">
    <div class="wrap-content">
        <div class="box-header-info d-flex align-content-center justify-content-between">
            <div class="box-header-menu">
                <div class="menu">
                    <ul class="menu-main">
                        <li>
                            <a class="" href="{{ route('trang-chu') }}" title="Trang chủ">Trang chủ</a>
                        </li>
                        <li>
                            <a class="" href="{{ route('gioi-thieu-noi-dung') }}" title="Về chúng tôi">Về chúng
                                tôi</a>
                        </li>

                        <li>
                            <a class="" href="{{route('tin-tuc')}}" title="Tin tức">Tin tức</a>
                        </li>

                        <li>
                            <a class="" href="lien-he" title="Liên hệ">Liên hệ</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="box-info-header-top d-flex align-center ">
                <div class="userinfo">
                </div>
                @if (Auth::guard('user')->check())
                    <div class="box-info-user">
                        <a href="{{ route('user.userinfo') }}"><i class="fas fa-user mr-3"></i></a>
                        Chào bạn, <b>{{ Auth::guard('user')->user()->name }}</b>

                        <a class="logout-btn" href="{{ route('user.logout') }}"><i
                                class="fa-solid fa-right-from-bracket"></i></a>
                    </div>
                @else
                    <div class="box-info-user">
                        <a href="{{ route('user.login') }}" class="slogan-user mb-0 text-decoration-none">
                            Đăng nhập
                        </a>/
                        <a href="{{ route('user.dang-ky') }}" class="slogan-user mb-0 text-decoration-none">
                            Đăng ký
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@include('templates.layouts.notify')
