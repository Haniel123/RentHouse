@extends('admin.index')
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
                            <th>Tên điều khoản</th>
                            <th style="width: 60%">Nội dung</th>
                            <th style="width: 190px">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($termslist))
                            @foreach ($termslist as $k => $v)
                                <tr data-id="{{ $v['id'] }}">
                                    <td class="text-center">{{ $v['ordinal'] }}</td>
                                    <td><span class="text-split" style="-webkit-line-clamp:1">{{ $v['name'] }}</span></td>
                                    <td><span class="text-split" style="-webkit-line-clamp:1">@php echo htmlspecialchars_decode($v['content']) @endphp</span></td>
                                    <td class="white-space">
                                        <button class="btn btn-success update-term" data-bs-toggle="tooltip"
                                            data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                            data-bs-title="Sửa"><i class="fa-solid fa-pen-field"></i></button>
                                        <button class="btn btn-danger delete-term" data-bs-toggle="tooltip"
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
                <div class="term-pagination center"></div>
            </div>
        </div>
    </div>
@endsection


@section('modal')
    <div class="modal fade" id="dieukhoan" tabindex="-1" aria-labelledby="exampleModalXlLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="exampleModalXlLabel"></h5>
                    <button type="button" class="btn-close" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formdieukhoan" enctype="multipart/form-data">
                        @csrf
                        <div class="form-add">
                            <div class="margina d-flex flex-wrap w-100">
                                <div class="form-group col-4">
                                    <label class="form-control-label">Tên điều khoản:</label>
                                    <div class="input-group">
                                        <input type="text" class="input100 form-control" name="name" required
                                            placeholder="Tên điều khoản">
                                    </div>
                                </div>
                                <div class="form-group col-12">
                                    <label class="form-control-label">Nội dung:</label>
                                    <div class="input-group">
                                        <textarea class="ckeditor" name="content" id="content" cols="30" rows="10" placeholder="Nội dung"></textarea>
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
