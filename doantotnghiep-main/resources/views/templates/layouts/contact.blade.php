@extends('templates.index')
@php
    use App\Http\Controllers\HomeController;
    $func = new HomeController();
@endphp
@section('body')
    @include('templates.layouts.header')
    <div class="wrap-aboutus-content">
        <div class="wrap-content">
            <div class="about-us-name">
                <span>
                  Liên hệ
                </span>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="box-contact pad-20 h-100 ">
                        <div class="footer-title">
                            Thông tin liên hệ
                        </div>
                        <div class="box-footer-info">
                            <span>
                                <i class="fa-solid fa-address-book"></i> Địa chỉ: C9/245c Ấp 3, Tân Nhựt, Bình Chánh, Thành Phố Hồ Chí Minh
                            </span>
                        </div>
                        <div class="box-footer-info">
                            <span>
                                <i class="fa-solid fa-phone"></i> Số điện thoại: 0775706809
                            </span>
                        </div>
                        <div class="box-footer-info">
                            <span>
                                <i class="fa-solid fa-globe"></i> Fanpage: Nhà trọ Khánh Huy
                            </span>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="box-contact">
                        <?= htmlspecialchars_decode('<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d22173.337776707052!2d106.66724398353094!3d10.755327933255657!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752ef1efebf7d7%3A0x9014ce53b8910a58!2zQuG7i25oIHZp4buHbiBDaOG7oyBS4bqreQ!5e0!3m2!1svi!2s!4v1688908748091!5m2!1svi!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
