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
                            <th style="width: 10%;">Ảnh bài viết</th>
                            <th style="width: 10%;">Tên bài viết</th>
                            <th style="width: 35%;">Mô tả</th>
                            <th style="width: 35%;">Nội dung</th>
                            <th style="width: 190px">Chức năng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (count($newslist))
                            @foreach ($newslist as $k => $v)
                                <tr data-id="{{ $v['id'] }}">
                                    <td class="text-center">{{ $v['ordinal'] }}</td>
                                    <td>
                                        @if ($v['photo'] != '' && $v['photo'] != null)
                                            <div class="pic m-auto" style="max-width: 50%"><img style="width:100%;aspect-ratio: 1/1;object-fit: cover;"
                                                    src="../public/uploads/news/tintuc/{{ $v['id'] }}/{{ $v['photo'] }}"
                                                    alt="">
                                            </div>
                                        @else
                                            <div class="pic m-auto" style="max-width: 50%"><img style="width:100%;aspect-ratio: 1/1;object-fit: cover;"
                                                    src="../public/assets/images/noimage.png" alt=""></div>
                                        @endif
                                    </td>
                                    <td><span class="text-split" style="-webkit-line-clamp:1">{{ $v['name'] }}</span></td>
                                    <td><span class="text-split" style="-webkit-line-clamp:1">@php
                                        echo htmlspecialchars_decode($v->desc);
                                    @endphp</span></td>
                                    <td><span class="text-split" style="-webkit-line-clamp:1">@php
                                        echo htmlspecialchars_decode($v->content);
                                    @endphp</span></td>
                                    <td class="white-space">
                                        <button class="btn btn-success update-news" data-bs-toggle="tooltip"
                                            data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                                            data-bs-title="Sửa"><i class="fa-solid fa-pen-field"></i></button>
                                        <button class="btn btn-danger delete-news" data-bs-toggle="tooltip"
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
                <div class="tintuc-pagination center"></div>
            </div>
        </div>
    </div>
@endsection


@section('modal')
    <div class="modal fade" id="tintuc" tabindex="-1" aria-labelledby="exampleModalXlLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="exampleModalXlLabel"></h5>
                    <button type="button" class="btn-close" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formtintuc" enctype="multipart/form-data">
                        @csrf
                        <div class="form-add row">
                            <div class="col-9">
                                <div class="margina d-flex flex-wrap w-100">
                                    <div class="col-12">
                                        <label class="form-control-label">Tên giới thiệu:</label>
                                        <div class="input-group">
                                            <input type="text" class="input100 form-control" name="name"
                                                placeholder="Nhập tên bài viết" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-control-label">Mô tả:</label>
                                        <div class="input-group">
                                            <textarea class="ckeditor d-none" name="desc" id="desc" cols="30" rows="10" placeholder="Mô tả"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <label class="form-control-label">Nội dung:</label>
                                        <div class="input-group">
                                            <textarea class="ckeditor d-none" name="content" id="content" cols="30" rows="10" placeholder="Nội dung"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="margina">
                                    <div class="col-12">
                                        <label class="form-control-label">Hình ảnh:</label>
                                        <div class="pic-container-1">
                                            <div class="pic"><img src="../public/assets/images/noimage.png"
                                                    alt=""></div>
                                        </div>
                                        <div class="input-group">
                                            <input type="file" class="custom-file-1" id="photo" name="photo"
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
