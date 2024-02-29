@extends('templates.index')
@section('body')
    @include('templates.layouts.header')
    <section class="section-register">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center box-register">
                <div class="col-md-8 col-lg-6">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-md-12 order-2 order-lg-1">
                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Đăng ký</p>
                                    <form class="mx-1 mx-md-7" method="post" action="{{ route('user.dang-ky') }}">
                                        @csrf
                                        <div class="d-flex flex-row align-items-center mb-4">

                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example1c"> <i
                                                        class="fas fa-user fa-lg me-3 fa-fw"></i> Tên đăng nhập</label>
                                                <input name="username" type="text" id="username"
                                                    value="{{ old('username') }}"
                                                    class="@error('username') is-invalid @enderror form-control">
                                                @if ($errors->any())
                                                    @error('username')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                @endif
                                            </div>

                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example1c"><i
                                                        class="fas fa-user fa-lg me-3 fa-fw"></i> Họ & tên</label>
                                                <input name="name" type="text" id="name"
                                                    class="@error('name') is-invalid @enderror form-control" />
                                                @if ($errors->any())
                                                    @error('name')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                @endif
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example3c"><i
                                                        class="fas fa-envelope fa-lg me-3 fa-fw"></i> Email</label>
                                                <input name="email" type="email" id="email"
                                                    class="@error('email') is-invalid @enderror form-control" />
                                                @if ($errors->any())
                                                    @error('email')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                @endif
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example3c"> <i
                                                        class="fa-duotone fa-phone me-3 fa-lg fa-fw"></i> Số điện
                                                    thoại</label>
                                                <input name="phone" type="text" id="phone"
                                                    class="@error('phone') is-invalid @enderror form-control" />
                                                @if ($errors->any())
                                                    @error('phone')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                @endif
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example4c"> <i
                                                        class="fas fa-lock fa-lg me-3 fa-fw"></i> Mật khẩu</label>
                                                <input name="password" type="password" id="password"
                                                    class="@error('password') is-invalid @enderror form-control" />
                                                @if ($errors->any())
                                                    @error('password')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                @endif
                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example4cd"><i
                                                        class="fas fa-key fa-lg me-3 fa-fw"></i> Nhập lại mật khẩu</label>
                                                <input name="password_confirmation" type="password" id="passwordrepeat"
                                                    class="@error('password_confirmation') is-invalid @enderror form-control" />
                                                @if ($errors->any())
                                                    @error('password_confirmation')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                @endif
                                            </div>
                                        </div>
                                        {{-- <div class="form-check d-flex justify-content-left mb-5 w-100">
                                            <label class="form-check-label" for="form2Example3">
                                                Tôi đồng ý với tất cả <a href="#!">điều khoản dịch vụ</a>
                                            </label>
                                            <input class="ml-2" name="policy" type="checkbox" id="form2Example3c" />
                                        </div> --}}
                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" class="btn btn-primary btn-lg">Đăng ký</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
