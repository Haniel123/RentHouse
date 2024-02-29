@extends('templates.index')
@php
    use App\Http\Controllers\HomeController;
    $func = new HomeController();
@endphp
@section('body')
    @include('templates.layouts.header')
    <div class="wrap-slider">
        <div class="owl-page owl-carousel owl-theme" data-items="screen:0|items:1" data-rewind="1" data-autoplay="1"
            data-loop="0" data-lazyload="0" data-mousedrag="1" data-touchdrag="1" data-smartspeed="800" data-autoplayspeed="800"
            data-autoplaytimeout="5000" data-dots="0" data-animations="">
            <div class="slider-img">
                <img src="{{ asset('public/assets/images/nha-tro-sinh-vien-can-tho.jpg') }}" alt="">
            </div>
            <div class="slider-img">
                <img src="{{ asset('public/assets/images/slider.jpg') }}" alt="">
            </div>
            <div class="slider-img">
                <img src="{{ asset('public/assets/images/banner-ban-don-nha-tro-so-1.png') }}" alt="">
            </div>
        </div>
    </div>
    <div class="wrap-search">
        <div class="wrap-content">
            <div class="box-search">
                <div class="search-content">
                    <form method="post" action="{{ route('tim-kiem') }}" class="form-inline mr-auto">
                        @csrf
                        <input type="text" name='search' placeholder="Tìm kiếm">
                        <div class="search-button">
                            <button type="submit btn">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="wrap-main-room box-white">
        <div class="wrap-content">
            <div class="box-homepage">
                <div class="box-about-us">
                    <div class="about-us-content">
                        @if (!empty($gioithieu))
                            <div class="row form-row align-items-center">
                                <div class="col-12 col-lg-6">
                                    <div class="about-us-image">
                                        <a class="scale-img hover-img text-center" href="{{ route('gioi-thieu-noi-dung') }}"
                                            title="Nhà trọ Khánh Huy">
                                            <img src="{{ asset('public/uploads/news/gioithieu') . '/' . $gioithieu['photo'] }}"
                                                alt="">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6">
                                    <div class="about-us-info">
                                        <div class="about-us-name">
                                            <span> {{ $gioithieu['name'] }}</span>
                                        </div>
                                        <div class="about-us-desc">
                                            <span class="text-split-6">
                                                @php
                                                    echo htmlspecialchars_decode($gioithieu['content']);
                                                @endphp
                                            </span>
                                        </div>
                                        {{-- <div class="about-us-wm ab-gradient">
                                        <a href="gioi-thieu">Xem tất cả <i class="fa-solid fa-arrow-right-long"></i></a>
                                    </div> --}}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wrap-main-room box-white">
        <div class="wrap-content">
            <div class="box-homepage">
                <div class="row ">
                    <div class="col-9">
                        <div class="box-homepage-left">
                            <div class="box-title-main">
                                <div class="title-main">
                                    <span>
                                        Danh sách phòng
                                    </span>
                                </div>
                                <div class="title-main-decor">

                                </div>
                                {{-- <div class="slogan-main">
                                    <span>
                                        Đây là slogan main
                                    </span>
                                </div> --}}
                            </div>
                            <div class="box-room-main">
                                <div class="row">
                                    @if(count($allRooms))
                                        @foreach ($allRooms as $room)
                                      
                                            <div class="room-main ">
                                                <div class="row align-items-center">
                                                    <div class="col-4">
                                                        <div class="room-image">
                                                            @php
                                                                $arrImg = explode(',', $room->picture);
                                                            @endphp
                                                            @if (isset($room->picture))
                                                          
                                                                @foreach ($arrImg as $k => $roomimg)
                                                                    @if ($k == 0)
                                                                        <div class="sale-room-img">
                                                                            <img src="{{ asset($func->formatLinkRoom($room->id, $roomimg)) }}"
                                                                                alt="">
                                                                        </div>
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                <img src="{{ asset('public/assets/images/noimage.png') }}"
                                                                    alt="">
                                                            @endif

                                                            <div class="box-room-button">
                                                                @php
                                                                    $roomPrice = $func->tongTienthanhToanLanDau($room->id);
                                                                @endphp
                                                                <div class="btn-detail">
                                                                    <a
                                                                        href="{{ route('chi-tiet-phong', ['id' => $room->id]) }}">
                                                                        Chi tiết
                                                                    </a>
                                                                </div>
                                                                @if (Auth::guard('user')->check())
                                                                    <div class="btn-detail btn-thue-ngay"
                                                                        data-id='{{ $room->id }}'
                                                                        data-name='{{ $room->name }}'
                                                                        data-price='{{ $roomPrice }}' data-bs-toggle="modal"
                                                                        data-bs-target="#thuengay">
                                                                        <a>Thuê ngay</a>
                                                                    </div>
                                                                    <div class="btn-detail btn-details-2 btn-dat-ngay"
                                                                        data-id='{{ $room->id }}'
                                                                        data-name='{{ $room->name }}'
                                                                        data-price='{{ $roomPrice }}' data-bs-toggle="modal"
                                                                        data-bs-target="#datnhanh">
                                                                        <a>Đặt cọc</a>
                                                                    </div>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-8">
                                                        <div class="room-main-name">
                                                            <span>{{ $room->name }}</span>
                                                        </div>
                                                        <div class="sale-room-info">
                                                            <div class="row form-row">
                                                                <div class=" col-12 col-lg-6 ">
                                                                    <div class="sale-room-info sale-room-address">
                                                                        <span>
                                                                            <span class="title-info"> Tầng : </span>
                                                                            {{ $room->floor }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-lg-6">
                                                                    <div class="sale-room-info sale-room-prices">
                                                                        <span>
                                                                            <span class="title-info"> Giá : </span>
                                                                            {{ $func->formatMoney($room->price) }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-lg-6">
                                                                    <div class="sale-room-info sale-room-status">
                                                                        <span>
                                                                            <span class="title-info"> Trạng thái : </span>
                                                                            {{ $func->formatStatusRoom($room->status) }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 col-lg-6">
                                                                    <div class="sale-room-info sale-room-saize">
                                                                        <span>
                                                                            <span class="title-info">Diện tích : </span>
                                                                            {{ $room->area }} m2
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="room-main-desc">
                                                            <span class="text-split-4">
                                                                <?= htmlspecialchars_decode($room->desc) ?>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        @include('templates.layouts.left-menu')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
