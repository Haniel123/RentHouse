@extends('templates.index')
@php
    use App\Http\Controllers\HomeController;
    $func = new HomeController();
@endphp
@section('body')
    @include('templates.layouts.header')
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
                                <div class="slogan-main">
                                    <span>
                                        Đây là slogan main
                                    </span>
                                </div>
                            </div>
                            <div class="box-room-main">
                                <div class="row">
                                    @foreach ($allRooms as $room)
                                        @php
                                            $roomPrice = $func->tongTienthanhToanLanDau($room->id);
                                        @endphp
                                        <div class="room-main ">
                                            <div class="row align-items-center">
                                                <div class="col-4">
                                                    <div class="room-image">
                                                        @php
                                                            $arrImg = explode(',', $room->picture);
                                                        @endphp
                                                        @if (!empty($room->picture))
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
                                                            <div class="btn-detail">
                                                                <a
                                                                    href="{{ route('chi-tiet-phong', ['id' => $room->id]) }}">Chi
                                                                    tiết</a>
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
                                                                        <i class="fa-solid fa-location-arrow"></i>
                                                                        {{ $room->floor }} Tầng
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-lg-6">
                                                                <div class="sale-room-info sale-room-prices">
                                                                    <span>
                                                                        <i class="fa-solid fa-coins"></i>
                                                                        {{ $func->formatMoney($room->price) }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-lg-6">
                                                                <div class="sale-room-info sale-room-status">
                                                                    <span>
                                                                        <i class="fa-solid fa-notes"></i>
                                                                        {{ $func->formatStatusRoom($room->status) }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-12 col-lg-6">
                                                                <div class="sale-room-info sale-room-saize">
                                                                    <span>
                                                                        <i class="fa-sharp fa-solid fa-explosion"></i>
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
