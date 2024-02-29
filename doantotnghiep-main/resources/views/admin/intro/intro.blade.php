@extends('admin.index')
@php
    use App\Http\Controllers\Admin\Functions;
@endphp

@section('body')
    <div class="main-container">
        <div class="function">
            <div class="btn-func">
                <button id="btnluu" type="button" class="btn btn-primary luugt">Lưu</button>
            </div>
        </div>
        <div class="main-content mb-3">
            <div class="wrap-content">
                <form id="formgioithieu" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-9">
                            <div class="card card-primary card-outline text-sm">
                                <div class="card-header">Nội dung giới thiệu</div>
                                <div class="card-body">
                                    <div class="margina d-flex flex-wrap w-100">
                                        <div class="col-12">
                                            <label class="form-control-label">Tên giới thiệu:</label>
                                            <div class="input-group">
                                                <input type="text" class="input100 form-control" name="name"
                                                    placeholder="Nhập tên bài viết"
                                                    value="@if ($gioithieu['name'] != '') {{ $gioithieu['name'] }} @endif"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-control-label">Mô tả:</label>
                                            <div class="input-group">
                                                <textarea class="ckeditor d-none" name="desc" id="desc" cols="30" rows="10" placeholder="Mô tả">@php
                                                    if ($gioithieu['desc'] != '') {
                                                        echo htmlspecialchars_decode($gioithieu['desc']);
                                                    }
                                                @endphp</textarea>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-control-label">Nội dung:</label>
                                            <div class="input-group">
                                                <textarea class="ckeditor d-none" name="content" id="content" cols="30" rows="10" placeholder="Nội dung">@php
                                                    if ($gioithieu['content'] != '') {
                                                        echo htmlspecialchars_decode($gioithieu['content']);
                                                    }
                                                @endphp</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="card card-primary card-outline text-sm">
                                <div class="card-header">Hình ảnh giới thiệu</div>
                                <div class="card-body">
                                    <div class="margina">
                                        <div class="col-12">
                                            <label class="form-control-label">Hình ảnh:</label>
                                            <div class="pic-container-1">
                                                @if ($gioithieu['photo'] == '')
                                                    <div class="pic"><img src="../public/assets/images/noimage.png"
                                                            alt=""></div>
                                                @else
                                                    <div class="pic"><img
                                                            src="../public/uploads/news/gioithieu/{{ $gioithieu['photo'] }}"
                                                            alt=""></div>
                                                @endif
                                            </div>
                                            <div class="input-group">
                                                <input type="file" class="custom-file-1" id="photo" name="photo" accept="image/png, image/gif, image/jpeg, image/jpg">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="function">
            <div class="btn-func">
                <button id="btnluu" type="button" class="btn btn-primary luugt">Lưu</button>
            </div>
        </div>
    </div>
@endsection
