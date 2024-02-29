<div class="modal modal-decor fade" id="thuengay" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    @php
        $name = '';
        $phone = '';
        $email = '';
        $userId = '';
        if (isset(Auth::guard('user')->user()->name)) {
            $name = Auth::guard('user')->user()->name;
        }
        if (isset(Auth::guard('user')->user()->phone)) {
            $phone = Auth::guard('user')->user()->phone;
        }
        if (isset(Auth::guard('user')->user()->email)) {
            $email = Auth::guard('user')->user()->email;
        }
        if (isset(Auth::guard('user')->user()->id)) {
            $userId = Auth::guard('user')->user()->id;
        }
    @endphp
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Thanh toán</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('thanhtoan') }}">
                @csrf
                <div class="modal-body">
                    <span class="content-1-datphong">
                        Bạn vui lòng điền đầy đủ thông tin bên dưới để thanh toán phòng thông qua VNPAY.
                    </span>
                    <div class="box-datphong-nhanh">
                        <input type="text" name="id" class="hidden datnhanh-id" />
                        <input type="text" name="iduser" class="hidden" value="{{ $userId }}" />
                        <input type="text" name="giadatnhanh" class="hidden datnhanh-price giadatnhanh" />
                        <input type="text" name="typepay" value="thanh-toan" class="hidden " />
                        <div class="box-info-thue-nhanh">
                            <div class="info-thuenhanh-content">
                                <span class="ex-thuenhanh-title">
                                    Tên phòng :
                                </span>
                                <span class="thuenhanh-name">

                                </span>
                            </div>
                            <div class="info-thuenhanh-content">
                                <span class="ex-thuenhanh-title">
                                    Giá phòng ( Đã bao gồm tiền phòng và tiền dịch vụ ) :
                                </span>
                                <span class="thuenhanh-price">

                                </span>
                            </div>
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label">Tên người đặt</label>
                            <input type="text" value="{{ $name }}" name="name"
                                class="form-control form-control-lg" placeholder="Tên người đặt" readonly />
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" value="{{ $phone }}" name="sdt"
                                class="form-control form-control-lg" placeholder="Số điện thoại" readonly />
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label">Email</label>
                            <input type="email" value="{{ $email }}" name="email"
                                class="form-control form-control-lg" placeholder="Email" readonly />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" name="redirect" class="btn btn-primary btn-accept2" data-id="">Chấp
                        nhận</button>
                </div>
            </form>
        </div>
    </div>
</div>






<div class="modal modal-decor fade" id="datnhanh" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    @php
        $name = '';
        $phone = '';
        $email = '';
        $userId = '';
        if (isset(Auth::guard('user')->user()->name)) {
            $name = Auth::guard('user')->user()->name;
        }
        if (isset(Auth::guard('user')->user()->phone)) {
            $phone = Auth::guard('user')->user()->phone;
        }
        if (isset(Auth::guard('user')->user()->email)) {
            $email = Auth::guard('user')->user()->email;
        }
        if (isset(Auth::guard('user')->user()->id)) {
            $userId = Auth::guard('user')->user()->id;
        }
    @endphp

    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Thanh toán</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="{{ route('thanhtoan') }}">
                @csrf
                <div class="modal-body">
                    <span class="content-1-datphong">
                        Bạn vui lòng điền đầy đủ thông tin bên dưới để thanh toán phòng thông qua VNPAY.
                    </span>
                    <div class="box-datphong-nhanh">
                        <input type="text" name="id" class="hidden datnhanh-id" />
                        <input type="text" name="iduser" class="hidden" value="{{ $userId }}" />
                        <input type="text" name="giadatnhanh" class="hidden datnhanh-price giadatnhanh" />
                        <input type="text" name="typepay" value="dat-truoc" class="hidden" />
                        <div class="box-info-thue-nhanh">
                            <div class="info-thuenhanh-content">
                                <span class="ex-thuenhanh-title">
                                    Tên phòng :
                                </span>
                                <span class="thuenhanh-name">
                                </span>
                            </div>
                            <div class="info-thuenhanh-content">
                                <span class="ex-thuenhanh-title">
                                    Giá đặt trước ( 20% tổng giá phòng ) :
                                </span>
                                <span class="thuenhanh-pricerq">
                                </span>
                            </div>
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label">Tên người đặt</label>
                            <input type="text" value="{{ $name }}" name="name"
                                class="form-control form-control-lg" placeholder="Tên người đặt" readonly />
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" value="{{ $phone }}" name="sdt"
                                class="form-control form-control-lg" placeholder="Số điện thoại" required />
                        </div>
                        <div class="form-outline mb-4">
                            <label class="form-label">Email</label>
                            <input type="email" value="{{ $email }}" name="email"
                                class="form-control form-control-lg" placeholder="Email" required/>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="redirect" class="btn btn-primary btn-accept2" data-id="">Chấp
                        nhận</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal modal-decor fade" id="quenmatkhau" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nhập email bạn đã đăng ký</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="GET" action="{{ route('user.quen-mat-khau') }}">
                <div class="modal-body">
                    <div class="form-outline mb-3">
                        <label class="form-label" for="form3Example4">Email</label>
                        <input type="email" id="quenmatkhau-email" name="email"
                            class="form-control form-control-lg" placeholder="Nhập email" required />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Gửi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal modal-decor fade" id="xemhopdong" data-bs-backdrop="static" data-bs-keyboard="false"
    tabindex="-1" aria-labelledby="xemhopdongLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="xemhopdongLabel">
                    @if (!empty($contractsinfo))
                        {{ $contractsinfo->name }}
                    @endif
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if (!empty($contractsinfo))

                    @if (!empty($roomcontracts))
                        @php
                            $roomct = $func->layThongTinPhong($roomcontracts->id_phong);
                            $userct = $func->layThongTinUser($roomcontracts->id_khachhang);
                        @endphp
                        <div class="box-contract-info">
                            <div class="name-contracts">
                                <span>
                                    <b>Tên hợp đồng</b> : {{ $contractsinfo->name }}
                                </span>
                            </div>
                            <?= htmlspecialchars_decode($contractsinfo->content) ?>
                            <div class="room-name-contracts">
                                <span>
                                    <b>Người thuê</b> : {{ $userct->name }}
                                </span>
                            </div>
                            <div class="room-name-contracts">
                                <span>
                                    <b>Phòng thuê</b> : {{ $roomct->name }}
                                </span>
                            </div>
                            <div class="room-price-contracts">
                                <span>
                                    <b>Giá phòng</b> : {{ $roomct->price }}
                                </span>
                            </div>
                            <div class="room-price-contracts">
                                <span>
                                    <b>Ngày bắt đầu thuê</b> : {{ date('d/m/Y', $roomcontracts->created_date) }}
                                </span>
                            </div>
                        </div>
                    @endif

                    @php
                        $hddk = $func->layHDDieuKhoan($contractsinfo->id);
                    @endphp
                    @if (count($hddk))
                        <div>
                            <h3><b>Điều khoản :</b></h3>
                        </div>
                        @foreach ($hddk as $ttdk)
                            @php
                                $ttdka = $func->layDieuKhoan($ttdk->id_dieukhoan);
                            @endphp
                            @if (isset($hddk))
                                <p>
                                    <span><b> {{ $ttdka->name }}
                                        </b><?= htmlspecialchars_decode($ttdka->content) ?></span>
                                </p>
                            @endif
                        @endforeach
                    @endif
                @endif
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Understood</button>
            </div> --}}
        </div>
    </div>
</div>
@isset($roomDetails)
    <div class="modal modal-decor fade" id="report" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Phản hồi phòng {{ $roomDetails->name }} </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="GET" action="{{ route('user.phan-hoi-phong') }}">
                    <input type="text" id="idphongreport" name="idphongreportt" class="form-control form-control-lg"
                        hidden value="{{ $roomDetails->id }}" placeholder="" required />
                    <input type="text" id="iduserreport" hidden name="iduserreport"
                        class="form-control form-control-lg" value="{{ $userId }}" placeholder="" required />
                    <div class="modal-body">
                        <div class="form-outline mb-3">
                            <label class="form-label" for="form3Example4">Nội dung</label>
                            <textarea type="text" id="noidungreport" name="noidungreport" class="form-control form-control-lg"
                                placeholder="Nội dung" required>
                            </textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Gửi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endisset
@isset($roomDetails)
    <div class="modal modal-decor fade" id="cancelroom" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bạn sẽ huỷ phòng {{ $roomDetails->name }} </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="GET" action="{{ route('user.huy-phong') }}">
                    <input type="text" id="idphongreport" name="idphongreportt" class="form-control form-control-lg"
                        hidden value="{{ $roomDetails->id }}" placeholder="" required />
                    <input type="text" id="iduserreport" hidden name="iduserreport"
                        class="form-control form-control-lg" value="{{ $userId }}" placeholder="" required />
                    <div class="modal-body">
                        <div class="form-outline mb-3">
                            <textarea type="text" cols="300" id="noidungreport" name="noidungreport"
                                class="form-control form-control-lg" placeholder="" readonly hidden>
                            </textarea>
                            <span>Bạn có chắc muốn huỷ phòng này !. Chúng tôi sẽ xem xét và tiếp hành huỷ vào tháng tiếp
                                theo.</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Xác nhận</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endisset
