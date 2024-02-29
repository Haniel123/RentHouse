@extends('admin.index')
@php
    use App\Http\Controllers\Admin\Functions;
@endphp
@section('body')
    <div class="main-container">
        <div class="function">
            <div class="btn-func">
                <a id='btnthem' class="btn btn-primary">Thêm mới</a>
            </div>
        </div>
        <div class="main-content">
            <div class="wrap-content">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th style="width: 50px;">STT</th>
                            <th>Tên phiếu chi</th>
                            <th>Giá</th>
                            <th style="width: 50%">Nội dung chi</th>
                            <th style="width: 190px">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($chislist))
                            @foreach ($chislist as $k => $v)
                                <tr data-id="{{ $v['id'] }}">
                                    <td class="text-center">{{ $v['ordinal'] }}</td>
                                    <td>{{ $v['name'] }}</td>
                                    <td>{{ Functions::formatMoney($v['price']) }}</td>
                                    <td style="text-wrap: balance;">
                                        <div class="text-split" style="-webkit-line-clamp:1">{{ $v['content'] }}</div>
                                    </td>
                                    <td class="white-space">
                                        <button class="btn btn-info update-chi-term d-none">Sửa phiếu chi</button>
                                        <button class="btn btn-success update-chi" data-bs-toggle="tooltip"
                                            data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                            data-bs-title="Sửa"><i class="fa-solid fa-pen-field"></i></button>
                                        <button class="btn btn-danger delete-chi" data-bs-toggle="tooltip"
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
                <div class="chi-pagination center"></div>
            </div>
        </div>
    </div>
@endsection


@section('modal')
    <div class="modal fade" id="chi" tabindex="-1" aria-labelledby="exampleModalXlLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="exampleModalXlLabel"></h5>
                    <button type="button" class="btn-close" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formchi" enctype="multipart/form-data">
                        @csrf
                        <div class="form-add">
                            <div class="margina d-flex flex-wrap w-100">
                                <div class="form-group col-4">
                                    <label class="form-control-label">Tên phiếu chi:</label>
                                    <div class="input-group">
                                        <input type="text" class="input100 form-control" name="name"
                                            placeholder="Tên phiếu chi" required>
                                    </div>
                                </div>
                                <div class="form-group col-4">
                                    <label class="form-control-label">Giá:</label>
                                    <div class="input-group">
                                        <input type="number" class="input100 form-control" name="price" placeholder="Giá"
                                            required>
                                        <div class="input-group-append">
                                            <div class="input-group-text"><strong>VNĐ</strong></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label class="form-control-label">Nội dung chi:</label>
                                    <div class="input-group">
                                        <textarea class="ckeditor" name="content" cols="30" rows="10" placeholder="Nội dung chi"></textarea>
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
