@extends('admin.index')
@php
    use App\Http\Controllers\Admin\Functions;
@endphp
@section('body')
    <div class="main-container">
        <div class="main-content">
            <div class="wrap-content">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 50px;text-align: center;">STT</th>
                            <th style="width: 180px">Phòng</th>
                            <th style="width: 180px">Người gửi</th>
                            <th style="width: 180px">Loại phản hồi</th>
                            <th style="width: 180px">Nội dung</th>
                            <th style="width: 180px">Trạng thái</th>
                            <th style="width: 190px">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($reportslist))
                            @foreach ($reportslist as $k => $v)
                                <tr data-id="{{ $v['id'] }}">
                                    <td style="text-align: center;">{{ $v['ordinal'] }}</td>
                                    <td>{{ Functions::getRoomName($v['id_phong']) }}</td>
                                    <td>{{ Functions::getCustomerName($v['id_khachhang']) }}</td>
                                    <td>@php
                                        if ($v['type'] == 'huy-phong') {
                                            echo 'Hủy phòng';
                                        } elseif ($v['type'] == 'phan-hoi') {
                                            echo 'Phản hồi';
                                        }
                                    @endphp</td>
                                    <td>{{ $v['content'] }}</td>
                                    <td>
                                        <div class="v-center change-status"
                                            {{ $v['status'] == '0' || $v['status'] == null ? 'style=color:red' : ($v['status'] == '1' ? 'style=color:#39e339' : ($v['status'] == '2' ? 'style=color:#193a97' : 'style=color:#e59010')) }}>
                                            <div class="status-name">
                                                {{ $v['status'] == '0' || $v['status'] == null ? 'Chưa xem' : ($v['status'] == '1' ? 'Đã xem' : ($v['status'] == '2' ? 'Đã xử lý' : '')) }}
                                                <div class="arrow"><svg width="14" height="7" viewBox="0 0 22 11"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M1.04991 1L1 1.04544L10.8361 9.99999L20.6721 1.04544L20.6222 1L10.8361 9.90911L1.04991 1Z"
                                                            fill="white" stroke="black" />
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="status-r">
                                                @if ($v['status'] != 0)
                                                    <div class="value" style="color: red" data-value="0">Chưa xem
                                                    </div>
                                                @endif
                                                @if ($v['status'] != 1)
                                                    <div class="value" style="color: #39e339" data-value="1">Đã xem
                                                    </div>
                                                @endif
                                                @if ($v['status'] != 2)
                                                    <div class="value" style="color: #193a97" data-value="2">Đã xử lý
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="white-space">
                                        <button class="btn btn-danger delete-report" data-bs-toggle="tooltip"
                                            data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                            data-bs-title="Xóa"><i class="fa-regular fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="11" class="text-center">Không có dữ liệu</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
                <div class="report-pagination center"></div>
            </div>
        </div>
    </div>
@endsection


@section('modal')
    <div class="modal fade" id="phanhoi" tabindex="-1" aria-labelledby="exampleModalXlLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="exampleModalXlLabel"></h5>
                    <button type="button" class="btn-close" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formphanhoi" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-add">
                            <div class="margina w-100">
                                <div class="form-group col-12 d-flex flex-wrap align-items-start">
                                    <div class="col-9 d-flex flex-wrap">
                                        <div class="form-group col-4">
                                            <label class="form-control-label">Tên tài khoản:</label>
                                            <div class="input-group">
                                                <input type="text" class="input100 form-control" name="username" required
                                                    placeholder="Tên tài khoản">
                                            </div>
                                        </div>
                                        <div class="form-group col-4">
                                            <label class="form-control-label">Mật khẩu:</label>
                                            <div class="input-group">
                                                <input type="text" class="input100 form-control" name="password" required
                                                    placeholder="Mật khẩu">
                                            </div>
                                        </div>
                                        <div class="form-group col-4">
                                            <label class="form-control-label">Nhập lại mật khẩu:</label>
                                            <div class="input-group">
                                                <input type="text" class="input100 form-control" name="repassword"
                                                    required placeholder="Nhập lại mật khẩu">
                                            </div>
                                        </div>
                                        <div class="form-group col-4">
                                            <label class="form-control-label">Họ tên:</label>
                                            <div class="input-group">
                                                <input type="text" class="input100 form-control" name="name"
                                                    placeholder="Họ tên">
                                            </div>
                                        </div>
                                        <div class="form-group col-4">
                                            <label class="form-control-label">Email:</label>
                                            <div class="input-group">
                                                <input type="email" class="input100 form-control" name="email"
                                                    placeholder="Email">
                                            </div>
                                        </div>
                                        <div class="form-group col-4">
                                            <label class="form-control-label">Số điện thoại:</label>
                                            <div class="input-group">
                                                <input type="text" class="input100 form-control" name="phone"
                                                    placeholder="Số điện thoại">
                                            </div>
                                        </div>
                                        <div class="form-group col-4">
                                            <label class="form-control-label">Ngày sinh:</label>
                                            <div class="input-group">
                                                <input type="date" class="input100 form-control" name="birthday"
                                                    placeholder="Ngày sinh">
                                            </div>

                                        </div>
                                        <div class="form-group col-4">
                                            <label class="form-control-label">Địa chỉ:</label>
                                            <div class="input-group">
                                                <input type="text" class="input100 form-control" name="address"
                                                    placeholder="Địa chỉ">
                                            </div>
                                        </div>
                                        <div class="form-group col-4">
                                            <label class="form-control-label">Trạng thái:</label>
                                            <div class="input-group">
                                                <select name="status" id="status">
                                                    <option value="0" selected>Chưa xem</option>
                                                    <option value="1">Đã xem</option>
                                                    <option value="2">Đã xử lý</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <label class="form-control-label">Hình ảnh:</label>
                                        <div class="pic-container-1">
                                            <div class="pic"><img src="../public/assets/images/noimage.png"
                                                    alt="">
                                            </div>
                                        </div>
                                        <div class="input-group">
                                            <input type="file" class="custom-file-2" id="photo" name="photo"
                                                accept="image/png, image/gif, image/jpeg, image/jpg">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-block btn-danger">Hủy</button>
                    <button type="submit" style="display: none"></button>
                </div>
            </div>
        </div>
    </div>
@endsection
