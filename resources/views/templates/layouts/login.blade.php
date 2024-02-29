@extends('templates.index')
@section('body')
    @include('templates.layouts.header')

    <section class="">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center">

                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1 box-login">
                    <form method="POST" action="{{ route('user.login') }}">
                        @csrf
                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center title-login fw-bold mx-3 mb-0">LOGIN</p>
                        </div>

                        <!-- Email input -->
                        <div class="form-outline mb-4">
                            <label class="form-label" for="form3Example3">Tên đăng nhập</label>
                            <input type="text" id="username" name="username" class="form-control form-control-lg"
                                placeholder="Tên đăng nhập"  required/>
                        </div>
                        <!-- Password input -->
                        <div class="form-outline mb-3">
                            <label class="form-label" for="form3Example4">Mật khẩu</label>
                            <input type="password" id="password" name="password" id="form3Example4"
                                class="form-control form-control-lg" placeholder="Nhập mật khẩu" required/>
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <!-- Checkbox -->
                            {{-- <div class="form-check mb-0">
                                <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3" />
                                <label class="form-check-label" for="form2Example3">
                                    Remember me
                                </label>
                            </div> --}}
                            <a data-bs-toggle="modal" data-bs-target="#quenmatkhau" class="text-body">Quên mật khẩu ?</a>
                        </div>

                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;"> Đăng nhập</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Chưa có tài khoản ? <a
                                    href="{{ route('user.dang-ky') }}" class="link-danger">Đăng ký</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
