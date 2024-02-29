@extends('templates.index')
@section('body')
    @include('templates.layouts.header')
    <section class="section-register">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100 box-register">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                                    <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Đổi mật khẩu</p>
                                    <form class="mx-1 mx-md-7" method="post" action="{{ route('user.mat-khau-moi-post')}}">
                                        @csrf
                                        <input type="text" class="hidden" name="newspwtoken" value="{{$token}}">
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example3c"><i
                                                        class="fas fa-envelope fa-lg me-3 fa-fw"></i> Email</label>
                                                <input name="email" type="email" id="email"
                                                    value="{{ $email }}"
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
                                                <input name="password_comfirmation" type="password" id="password_comfirmation"
                                                    class="@error('password_comfirmation') is-invalid @enderror form-control" />
                                                @if ($errors->any())
                                                    @error('password_comfirmation')
                                                        <div class="alert alert-danger">{{ $message }}</div>
                                                    @enderror
                                                @endif
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" class="btn btn-primary btn-lg">Đổi mật khẩu</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-5 d-flex align-items-center order-1 order-lg-2">
                                    <img src="{{ asset('public/assets/images/loho.jpg') }}" alt="Generic placeholder image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
