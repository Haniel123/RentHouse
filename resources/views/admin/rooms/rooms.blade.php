@extends('admin.index')
@php
    use App\Http\Controllers\Admin\Functions;
@endphp

@section('body')
    <div class="main-container">
        <div class="function">
            <div class="btn-func">
                <button id="btnthem" type="button" class="btn btn-primary">Thêm mới</button>
            </div>
        </div>
        <div class="main-content">
            <div class="wrap-content">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 50px;">STT</th>
                            <th>Tên Phòng</th>
                            <th>Giá</th>
                            <th style="width: 150px;">Thời gian cọc</th>
                            <th>Giá điện</th>
                            <th>Giá nước</th>
                            <th>Ngày thanh toán</th>
                            <th style="width: 54px;">Tầng</th>
                            <th>Khách đang thuê</th>
                            <th style="width: 170px">Trạng thái</th>
                            <th style="width: 190px">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($roomslist))
                            @foreach ($roomslist as $k => $v)
                                <tr data-id="{{ $v['id'] }}">
                                    <td style="text-align: center;">{{ $v['ordinal'] }}</td>
                                    <td>{{ $v['name'] }}</td>
                                    <td>{{ Functions::formatMoney($v['price']) }}</td>
                                    <td>{{ $v['deposittime'] }}</td>
                                    <td>{{ Functions::formatMoney($v['electricity_price']) }}</td>
                                    <td>{{ Functions::formatMoney($v['water_price']) }}</td>
                                    <td>{{ $v['payday'] }}</td>
                                    <td>{{ $v['floor'] }}</td>
                                    <td>{{ Functions::getUserInfo($v['id']) }}</td>
                                    <td>
                                        <div class="v-center
                                        change-status"
                                            {{ $v['status'] == '0' || $v['status'] == null ? 'style=color:red' : ($v['status'] == '1' ? 'style=color:#39e339' : ($v['status'] == '2' ? 'style=color:#193a97' : ($v['status'] == '3' ? 'style=color:#e59010' : 'style=color:#e495b0'))) }}>
                                            <div class="status-name">
                                                {{ $v['status'] == '0' || $v['status'] == null ? 'Chưa hoạt động' : ($v['status'] == '1' ? 'Đang hoạt động' : ($v['status'] == '2' ? 'Đang thuê' : ($v['status'] == '3' ? 'Đang bảo trì' : 'Đang đặt'))) }}
                                                <div class="arrow"><svg width="14" height="7" viewBox="0 0 22 11"
                                                        fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="M1.04991 1L1 1.04544L10.8361 9.99999L20.6721 1.04544L20.6222 1L10.8361 9.90911L1.04991 1Z"
                                                            fill="white" stroke="black" />
                                                    </svg>
                                                </div>
                                            </div>
                                            @if ($v['status'] != 2)
                                                <div class="status-r">
                                                    @if ($v['status'] != 0)
                                                        <div class="value" style="color: red" data-value="0">Chưa hoạt động
                                                        </div>
                                                    @endif
                                                    @if ($v['status'] != 1)
                                                        <div class="value" style="color: #39e339" data-value="1">Đang hoạt
                                                            động
                                                        </div>
                                                    @endif
                                                    @if ($v['status'] != 2)
                                                        <div class="value" style="color: #193a97" data-value="2">Đang thuê
                                                        </div>
                                                    @endif
                                                    @if ($v['status'] != 3)
                                                        <div class="value" style="color: #e59010" data-value="3">Đang bảo
                                                            trì</div>
                                                    @endif
                                                    @if ($v['status'] != 4)
                                                        <div class="value" style="color: #e495b0" data-value="4">Đang đặt
                                                        </div>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="white-space">
                                        <button class="btn btn-success update-room" data-bs-toggle="tooltip"
                                            data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                            data-bs-title="Sửa"><i class="fa-solid fa-pen-field"></i></button>
                                        <button class="btn btn-danger delete-room" data-bs-toggle="tooltip"
                                            data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                            data-bs-title="Xóa"><i class="fa-regular fa-trash"></i></button>
                                        @if ($v['status'] == 2)
                                            <button class="btn btn-danger huy-room" data-bs-toggle="tooltip"
                                                data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                                data-bs-title="Hủy hợp đồng"><i class="fa-solid fa-xmark"></i></button>
                                        @endif
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
                <div class="room-pagination center"></div>
            </div>
        </div>
    </div>
@endsection


@section('modal')
    <div class="modal fade" id="phong" tabindex="-1" aria-labelledby="exampleModalXlLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="exampleModalXlLabel"></h5>
                    <button type="button" class="btn-close" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formphong" enctype="multipart/form-data">
                        @csrf
                        <div class="form-add">
                            <div class="margina d-flex flex-wrap w-100">
                                <div class="form-group col-4">
                                    <label class="form-control-label">Tên phòng:</label>
                                    <div class="input-group">
                                        <input type="text" class="input100 form-control" name="name"
                                            placeholder="Tên phòng" required>
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <label class="form-control-label">Giá:</label>
                                    <div class="input-group">
                                        <input type="number" class="input100 form-control" name="price"
                                            placeholder="Tiền phòng" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text"><strong>VNĐ</strong></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <label class="form-control-label">Thời gian cọc:</label>
                                    <div class="input-group">
                                        <input type="number" class="input100 form-control" name="deposittime"
                                            placeholder="Thời gian cọc" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text"><strong>Tháng</strong></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <label class="form-control-label">Giá điện:</label>
                                    <div class="input-group">
                                        <input type="number" class="input100 form-control" name="electricity_price"
                                            placeholder="Giá điện" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text"><strong>VNĐ/KWh</strong></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <label class="form-control-label">Giá nước:</label>
                                    <div class="input-group">
                                        <input type="number" class="input100 form-control" name="water_price"
                                            placeholder="Giá nước" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text"><strong>VNĐ/Người</strong></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <label class="form-control-label">Tầng:</label>
                                    <div class="input-group">
                                        <input type="number" class="input100 form-control" name="floor"
                                            placeholder="Tầng" required>
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <label class="form-control-label">Diện tích:</label>
                                    <div class="input-group">
                                        <input type="number" class="input100 form-control text-sm" name="area"
                                            placeholder="Diện tích" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text"><strong>m2</strong></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <label class="form-control-label">Ngày thanh toán:</label>
                                    <div class="input-group">
                                        <input type="number" class="input100 form-control text-sm" name="payday"
                                            placeholder="Ngày thanh toán" required>
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <label class="form-control-label">Trạng thái:</label>
                                    <div class="input-group">
                                        <select class="form-select" name="status" id="status">
                                            <option value="0" selected>Chưa hoạt động</option>
                                            <option value="1">Đang hoạt động</option>
                                            <option value="2">Đang thuê</option>
                                            <option value="3">Đang bảo trì</option>
                                            <option value="4">Đang đặt</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label class="form-control-label">Mô tả:</label>
                                    <div class="input-group">
                                        <textarea class="ckeditor" name="desc" id="desc" cols="30" rows="10" placeholder="Mô tả"></textarea>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label class="form-control-label">Nội dung:</label>
                                    <div class="input-group">
                                        <textarea class="ckeditor" name="content" id="content" cols="30" rows="10" placeholder="Nội dung"></textarea>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label class="form-control-label">Hình ảnh:</label>
                                    <div class="input-group">
                                        <input type="file" class="custom-file" id="image" multiple
                                            accept="image/png, image/gif, image/jpeg, image/jpg">
                                    </div>
                                    <div class="pic-container">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hopdong form-add">
                            <div class="form-group col-12">
                                <div class="show-down">
                                    <label class="form-control-label w-100">Hợp đồng đã chọn:</label>
                                    <div class="itemshopdong">
                                        <div class="input-group">
                                            @foreach ($contracts as $v)
                                                <div class="form-group col-3">
                                                    <label class="form-check-label custom-radio hopdong-item"
                                                        for="hopdong-{{ $v['id'] }}">
                                                        <input class="d-none" type="radio" name="hopdong"
                                                            value="{{ $v['id'] }}"
                                                            id="hopdong-{{ $v['id'] }}">{{ $v['name'] }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="dichvu form-add">
                            <div class="form-group col-12">
                                <div class="show-down">
                                    <label class="form-control-label w-100">Dịch vụ đã chọn: 0</label>
                                    <div class="itemsdichvu">
                                        <div class="input-group">
                                            @foreach ($services as $v)
                                                <div class="form-group col-3">
                                                    <label class="form-check-label custom-checkbox dichvu-item"
                                                        for="dichvu-{{ $v['id'] }}">
                                                        <input class="d-none" type="checkbox" name="dichvu[]"
                                                            value="{{ $v['id'] }}"
                                                            id="dichvu-{{ $v['id'] }}">{{ $v['name'] }}</label>
                                                </div>
                                            @endforeach
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
