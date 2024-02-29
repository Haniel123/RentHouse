@extends('templates.index')
@php
    use App\Http\Controllers\HomeController;
    $func = new HomeController();
@endphp
@section('body')
    @include('templates.layouts.header')
    <section class="h-100 gradient-custom-2 box-white">
        <div class="wrap-content">
            <div class="container-2 py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-lg-9 col-xl-7">
                        <div class="card">
                            <div class="rounded-top text-white d-flex flex-row" style="background-color: #000; height:200px;">
                                <div class="ms-4 mt-5 d-flex flex-column" style="width: 150px;">
                                    <img src="{{ asset('public/assets/images/avatar.png') }}"
                                        alt="Generic placeholder image" class="img-fluid img-thumbnail mt-4 mb-2"
                                        style="width: 150px; z-index: 1">
                                    <button type="button" class="btn btn-outline-dark" data-mdb-ripple-color="dark"
                                        data-bs-toggle="modal" data-bs-target="#suauser" style="z-index: 1;">
                                        Chỉnh sửa
                                    </button>
                                </div>
                                <div class="ms-3" style="margin-top: 130px;">
                                    <h5>{{ Auth::guard('user')->user()->name }}</h5>
                                    <p>{{ Auth::guard('user')->user()->address }}</p>
                                </div>
                            </div>
                            <div class="p-4 text-black" style="background-color: #f8f9fa;">
                                <div class="d-flex justify-content-end text-center py-1">
                                    <div class="px-3">
                                        <!-- <p class="mb-1 h5">1026</p> -->
                                        <a class="text-decoration-none" href="{{route('user.doi-mat-khau',['id'=>Auth::guard('user')->user()->id ])}}">  <p class="small text-muted mb-0">Đổi mật khẩu</p></a>
                                      
                                    </div>

                                </div>
                            </div>
                            <div class="card-body p-4 text-black">
                                <div class="mb-5">
                                    <p class="lead fw-normal mb-1">Thông tin :</p>
                                    <div class="p-4" style="background-color: #f8f9fa;">
                                        <p class="font-italic mb-1">Số điện thoại: {{ Auth::guard('user')->user()->phone }}
                                        </p>
                                        <p class="font-italic mb-1">Email: {{ Auth::guard('user')->user()->email }}</p>
                                        <p class="font-italic mb-0">Ngày sinh:
                                            @if (isset(Auth::guard('user')->user()->birthday))
                                                {{ date('d-m-Y', strtotime(Auth::guard('user')->user()->birthday)) }}
                                            @else
                                            @endif
                                        </p>

                                    </div>
                                </div>
                                @if (count($listphonguserdt))
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <p class="lead fw-normal mb-0">Danh sách phòng đặt trước</p>
                                        {{-- <p class="mb-0"><a href="#!" class="text-muted">Show all</a></p> --}}
                                    </div>

                                    @foreach ($listphonguserdt as $room)
                                        @php
                                            $hdroom = $func->layThongTinDatTruoc($room->id,Auth::guard('user')->user()->id);
                                        @endphp
                                        <div class="row g-2 mb-4">
                                            <div class="col-4 mb-2 box-room-user">
                                                <a class="text-decoration-none"
                                                    href="{{ route('user.chi-tiet-phong-user', ['id' => $room->id]) }}">
                                                    @if (!empty($room->picture))
                                                        @php
                                                            $arrImg = explode(',', $room->picture);
                                                        @endphp
                                                        @foreach ($arrImg as $k => $roomimg)
                                                            @if ($k == 0)
                                                                <div class="sale-room-img">
                                                                    <img class="w-100 rounded-3 user-detail-room-img"
                                                                        src="{{ asset($func->formatLinkRoom($room->id, $roomimg)) }}"
                                                                        alt="">
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <img src="{{ asset('public/assets/images/noimage.png') }}"
                                                            alt="">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="col-8">
                                                <div class="box-room-user-info">
                                                    <div class="room-user-name">
                                                        <span>
                                                            {{ $room->name }}
                                                        </span>
                                                    </div>
                                                    <div class="room-user-status">
                                                        <span>
                                                            Trạng thái: {{ $func->formatStatusRoom($room->status) }}
                                                        </span>
                                                    </div>
                                                    <div class="box-room-button">
                                                        <div class="btn-detail">
                                                            <a href="{{ route('chi-tiet-phong', ['id' => $room->id]) }}">
                                                                Chi tiết
                                                            </a>
                                                        </div>
                                                        <div class="btn-detail btn-thue-ngay" data-id='{{ $room->id }}'
                                                            data-name='{{ $room->name }}'
                                                            data-giathanhtoan='{{ $hdroom->price }}'
                                                            data-type='thanhtoandt' data-price='{{ $room->price }}'
                                                            data-bs-toggle="modal" data-bs-target="#thuengay">
                                                            <a>Thuê ngay</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <p class="lead fw-normal mb-0">Danh sách phòng</p>
                                    {{-- <p class="mb-0"><a href="#!" class="text-muted">Show all</a></p> --}}
                                </div>
                                @isset($listphonguser)
                                    @foreach ($listphonguser as $room)
                                        @php
                                            $hdinfo = $func->layThongTinHopDongTheoIdPhong($room->id);
                                            $ngayThanhToan = $func->tinhNgayThanhToanTiepTheo($room->id, Auth::guard('user')->user()->id);
                                            $priceRoom = $func->tongTienthanhToan($room->id);
                                        @endphp

                                        <div class="row g-2 mb-4">
                                            <div class="col-4 mb-2 box-room-user">
                                                <a class="text-decoration-none"
                                                    href="{{ route('user.chi-tiet-phong-user', ['id' => $room->id]) }}">
                                                    @if (!empty($room->picture))
                                                        @php
                                                            $arrImg = explode(',', $room->picture);
                                                        @endphp
                                                        @foreach ($arrImg as $k => $roomimg)
                                                            @if ($k == 0)
                                                                <div class="sale-room-img">
                                                                    <img class="w-100 rounded-3 user-detail-room-img"
                                                                        src="{{ asset($func->formatLinkRoom($room->id, $roomimg)) }}"
                                                                        alt="">
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        <img src="{{ asset('public/assets/images/noimage.png') }}"
                                                            alt="">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="col-8">
                                                <div class="box-room-user-info">
                                                    <div class="room-user-name">
                                                        <span>
                                                            {{ $room->name }}
                                                        </span>
                                                    </div>
                                                    <div class="room-user-status">
                                                        <span>
                                                            <b> Trạng thái:</b> {{ $func->formatStatusRoom($room->status) }}
                                                        </span>
                                                    </div>
                                                    <div class="room-user-date">
                                                        <span>
                                                            <b> Ngày thuê:</b>
                                                            {{ $func->formatDate($hdinfo->rental_start_date) }}
                                                        </span>
                                                    </div>
                                                    <div class="room-user-date">
                                                        <span>
                                                            <b> Ngày thanh toán tiếp theo:</b>
                                                            {{ $ngayThanhToan['ngaythanhtoantieptheo'] }}
                                                        </span>
                                                    </div>
                                                    @if ($ngayThanhToan['songayconlai'] > 0 && $ngayThanhToan['songayconlai'] <= 5)
                                                        <div class="room-user-date">
                                                            <span>
                                                                <b> Số ngày còn lại dự kiến:</b>
                                                                {{ $ngayThanhToan['songayconlai'] }} ngày
                                                            </span>
                                                        </div>
                                                    @elseif($ngayThanhToan['songayconlai'] < 0)
                                                        <div class="room-user-date">
                                                            <span>
                                                                <b> Bạn đã trễ hạn :</b>
                                                                {{ $ngayThanhToan['songayconlai'] * -1 }} ngày
                                                            </span>
                                                            <p style="color:red">
                                                                Bạn vui lòng liên hệ chủ phòng trọ để giải quyết, xin cảm ơn !
                                                            </p>
                                                        </div>
                                                    @else
                                                    <div class="room-user-date">
                                                        <span>
                                                            <b> Số ngày còn lại dự kiến:</b>
                                                            {{ $ngayThanhToan['songayconlai'] }} ngày
                                                        </span>
                                                    </div>
                                                    @endif
                                                </div>
                                                @if ($ngayThanhToan['songayconlai'] > 0 && $ngayThanhToan['songayconlai'] <= 5)
                                                    <div
                                                        class="box-room-button justify-content-start
                                                     ">
                                                        <div class="btn-detail">
                                                            <a href="{{ route('chi-tiet-phong', ['id' => $room->id]) }}">
                                                                Chi tiết
                                                            </a>
                                                        </div>
                                                        <div class="btn-detail btn-thue-ngay" data-id='{{ $room->id }}'
                                                            data-name='{{ $room->name }}'
                                                            data-giathanhtoan='{{ $room->price }}'
                                                            data-price='{{ $priceRoom }}' data-bs-toggle="modal"
                                                            data-bs-target="#thuengay">
                                                            <a>Thanh toán</a>
                                                        </div>
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                    @endforeach
                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="suauser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title w-100 text-center" id="exampleModalLabel">Chỉnh sửa user</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="container h-100">
                            <div class="row d-flex justify-content-center align-items-center h-100 box-register">
                                <div class="col-lg-12 col-xl-12">
                                    <div class="card-2 text-black" style="border-radius: 25px;">
                                        <div class="card-body p-md-1">
                                            <div class="row justify-content-center">
                                                <div class="col-md-12 order-2 order-lg-1">
                                                    <p class="text-center mb-2"></p>
                                                    <form class="mx-1 mx-md-7" method="post"
                                                        action="{{ route('user.sua-nguoi-dung') }}">
                                                        @csrf

                                                        <input name="id" type="text" id="id"
                                                            value="{{ Auth::guard('user')->user()->id }}" class="hidden">
                                                        <div class="d-flex flex-row align-items-center mb-2">
                                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                                            <div class="form-outline flex-fill mb-0">
                                                                <input name="name" type="text" id="name"
                                                                    value="{{ Auth::guard('user')->user()->name }}"
                                                                    class="@error('name') is-invalid @enderror form-control" />
                                                                <label class="form-label" for="form3Example1c">Họ &
                                                                    tên</label>
                                                                @if ($errors->any())
                                                                    @error('name')
                                                                        <div class="alert alert-danger">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="d-flex flex-row align-items-center mb-2">
                                                            <i class="fa-solid fa-cake-candles fa-lg me-3 fa-fw"></i>
                                                            <div class="form-outline flex-fill mb-0">
                                                                <input name="birthday" type="date" id="birthday"
                                                                    value="{{ Auth::guard('user')->user()->birthday }}"
                                                                    class="@error('birthday') is-invalid @enderror form-control" />
                                                                <label class="form-label" for="form3Example1c">Ngày
                                                                    sinh</label>
                                                                @if ($errors->any())
                                                                    @error('bithday')
                                                                        <div class="alert alert-danger">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="d-flex flex-row align-items-center mb-2">
                                                            <i class="fa-solid fa-address-book fa-lg me-3 fa-fw"></i>
                                                            <div class="form-outline flex-fill mb-0">
                                                                <input name="address" type="text" id="address"
                                                                    value="{{ Auth::guard('user')->user()->address }}"
                                                                    class="@error('address') is-invalid @enderror form-control" />
                                                                <label class="form-label" for="form3Example1c">Địa
                                                                    chỉ</label>
                                                                @if ($errors->any())
                                                                    @error('address')
                                                                        <div class="alert alert-danger">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="d-flex flex-row align-items-center mb-2">
                                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                                            <div class="form-outline flex-fill mb-0">
                                                                <input name="email" type="email" id="email" readonly    
                                                                    value="{{ Auth::guard('user')->user()->email }}"
                                                                    class="@error('email') is-invalid @enderror form-control" />
                                                                <label class="form-label"
                                                                    for="form3Example3c">Email</label>
                                                                @if ($errors->any())
                                                                    @error('email')
                                                                        <div class="alert alert-danger">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="d-flex flex-row align-items-center mb-2">
                                                            <i class="fa-duotone fa-phone me-3 fa-lg fa-fw"></i>
                                                            <div class="form-outline flex-fill mb-0">
                                                                <input name="phone" type="text" id="phone"
                                                                    value="{{ Auth::guard('user')->user()->phone }}"
                                                                    class="@error('phone') is-invalid @enderror form-control" />
                                                                <label class="form-label" for="form3Example3c">Số điện
                                                                    thoại</label>
                                                                @if ($errors->any())
                                                                    @error('phone')
                                                                        <div class="alert alert-danger">{{ $message }}
                                                                        </div>
                                                                    @enderror
                                                                @endif
                                                            </div>
                                                        </div>
                                                        {{-- <div class="form-check d-flex justify-content-center mb-5">
                                                            <input class="form-check-input me-2" name="policy"
                                                                type="checkbox" id="form2Example3c" />
                                                            <label class="form-check-label" for="form2Example3">
                                                                Tôi đồng ý với tất cả <a href="#!">điều khoản dịch
                                                                    vụ</a>
                                                            </label>
                                                        </div> --}}
                                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                                            <button type="submit" class="btn btn-primary btn-lg "
                                                                style="margin-left:10px;margin-right:10px;">Chỉnh sửa
                                                            </button>

                                                            <button type="button" class="btn btn-secondary btn-lg"
                                                                style="margin-left:10px;margin-right:10px;"
                                                                data-bs-dismiss="modal">Đóng
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
