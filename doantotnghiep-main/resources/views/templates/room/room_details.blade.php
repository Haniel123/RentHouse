@extends('templates.index')
@section('body')
    @php
        use App\Http\Controllers\HomeController;
        $func = new HomeController();
    @endphp
    @include('templates.layouts.header')
    <div class="wrap-room-details box-white">
        <div class="wrap-content">
            <div class="grid-pro-detail w-clear">
                <div class="room-name text-center">
                    <div class="title-main">
                        <span>
                            {{ $roomDetails->name }}
                        </span>
                    </div>
                </div>

                <div class="left-pro-detail mb-4">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <div class="fotorama" data-nav="thumbs">
                                    @php
                                        $arrImg = explode(',', $roomDetails->picture);
                                    @endphp
                                    @foreach ($arrImg as $k => $roomimg)
                                        <img src="{{ asset($func->formatLinkRoom($roomDetails->id, $roomimg)) }}"
                                            alt="">
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="room-details-info">
                                    <span class="span-title-room-info">Thông tin chính</span>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="room-status room-info">
                                                <span>
                                                    <span class="desc-info-room"> Trạng thái :</span>
                                                    {{ $func->formatStatusRoom($roomDetails->status) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="room-size room-info">
                                                <span>
                                                    <span class="desc-info-room"> Diện tích :</span>
                                                    {{ $roomDetails->area }} m2
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="room-price-coc room-info">
                                                <span>
                                                    <span class="desc-info-room"> Số tiền cọc :</span>
                                                    {{ $func->formatMoney($roomDetails->price) }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="room-price-month room-info">
                                                <span>
                                                    <span class="desc-info-room"> Số tháng cọc :</span>
                                                    {{ $roomDetails->deposittime }} Tháng
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="room-service">
                                        <div class="span-title-room-info-service">
                                            <span class="span-title-room-info">Dịch vụ</span>
                                        </div>
                                        @if (!empty($listservice))
                                            @foreach ($listservice as $item)
                                                <div class="service-details">
                                                    <span>
                                                        {{ $item->name }} : <span
                                                            class="pri-service">{{ $func->formatMoney($item->price) }}</span>

                                                    </span>
                                                </div>
                                            @endforeach
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="right-pro-detail  mb-4">


                    <div class="room-content">
                        <div class="room-content-title">
                            <span>Thông tin mô tả</span>
                        </div>
                        <span>
                            <?= htmlspecialchars_decode($roomDetails->content) ?>
                        </span>
                    </div>
                </div>

                <div class="room-map">

                </div>
            </div>
        </div>
    @endsection
