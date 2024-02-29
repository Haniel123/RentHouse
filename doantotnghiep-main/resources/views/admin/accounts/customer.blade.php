@extends('admin.index')

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
                            <th style="width: 50px;text-align: center;">STT</th>
                            <th style="width: 10%;">Ảnh</th>
                            <th style="width: 10%;">Tên tài khoản</th>
                            <th>Họ tên</th>
                            <th style="width: 15%;">Email</th>
                            <th style="width: 9%;">Số điện thoại</th>
                            <th style="width: 180px">Trạng thái</th>
                            <th style="width: 190px">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($customerslist))
                            @foreach ($customerslist as $k => $v)
                                <tr data-id="{{ $v['id'] }}">
                                    <td style="text-align: center;">{{ $v['ordinal'] }}</td>
                                    <td>
                                        @if ($v['avatar'] != null)
                                            <div class='pic m-auto' style="max-width: 50%"><img
                                                    style="width:100%;aspect-ratio: 1/1;object-fit: cover;"
                                                    src='../public/uploads/users/customers/{{ $v['id'] }}/{{ $v['avatar'] }}'
                                                    alt=''></div>
                                        @else
                                            <div class="pic m-auto" style="max-width: 50%"><img
                                                    style="width:100%;aspect-ratio: 1/1;object-fit: cover;"
                                                    src="../public/assets/images/noimage.png" alt=""></div>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $v['username'] }}</td>
                                    <td>{{ $v['name'] }}</td>
                                    <td>
                                        {{ $v['email'] }}</td>
                                    <td>{{ $v['phone'] }}</td>
                                    <td>
                                        <div class="v-center change-status"
                                            {{ $v['status'] == '0' || $v['status'] == null ? 'style=color:red' : ($v['status'] == '1' ? 'style=color:#39e339' : ($v['status'] == '2' ? 'style=color:#193a97' : 'style=color:#e59010')) }}>
                                            <div class="status-name">
                                                {{ $v['status'] == '0' || $v['status'] == null ? 'Chưa hoạt động' : ($v['status'] == '1' ? 'Đang hoạt động' : ($v['status'] == '2' ? 'Khóa' : '')) }}
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
                                                    <div class="value" style="color: red" data-value="0">Chưa hoạt động
                                                    </div>
                                                @endif
                                                @if ($v['status'] != 1)
                                                    <div class="value" style="color: #39e339" data-value="1">Đang hoạt động
                                                    </div>
                                                @endif
                                                @if ($v['status'] != 2)
                                                    <div class="value" style="color: #193a97" data-value="2">Khóa
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="white-space">
                                        <button class="btn btn-success update-customer" data-bs-toggle="tooltip"
                                            data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                            data-bs-title="Sửa"><i class="fa-solid fa-pen-field"></i></button>
                                        <button class="btn btn-danger delete-customer" data-bs-toggle="tooltip"
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
                <div class="customer-pagination center"></div>
            </div>
        </div>
    </div>
@endsection


@section('modal')
    <div class="modal fade" id="khachhang" tabindex="-1" aria-labelledby="exampleModalXlLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="exampleModalXlLabel"></h5>
                    <button type="button" class="btn-close" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formkhachhang" method="POST" enctype="multipart/form-data">
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
                                                <input type="password" class="input100 form-control" name="password"
                                                    required placeholder="Mật khẩu">
                                            </div>
                                        </div>
                                        <div class="form-group col-4">
                                            <label class="form-control-label">Nhập lại mật khẩu:</label>
                                            <div class="input-group">
                                                <input type="password" class="input100 form-control" name="repassword"
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
                                                    <option value="0" selected>Chưa hoạt động</option>
                                                    <option value="1">Đang hoạt động</option>
                                                    <option value="2">Khóa</option>
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
