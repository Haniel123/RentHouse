@extends('templates.index')
@php
    use App\Http\Controllers\HomeController;
    $func = new HomeController();
@endphp
@section('body')
    @include('templates.layouts.header')
    <div class="wrap-content">
        <div class="title-main"><span>Tin tức</span></div>
        <div class="content-main row">
            <?php if (!empty($news)) {
            foreach ($news as $k => $v) { ?>
            <div class="news col-md-4">
                <a class="news-image col-sm-5" href="{{route('chi-tiet-tin-tuc',['id'=>$v->id])}}" title="{{ $v->name }}">
                    <span class="scale-img">
                        <img src="{{ $func->formatLinkNews($v->id, $v->photo) }}" alt="">
                    </span>
                </a>
                <h3 class="news-name">
                    <a class="text-decoration-none text-split transition" href="{{route('chi-tiet-tin-tuc',['id'=>$v->id])}}"
                        title="{{ $v->name }}">{{ $v->name }}
                    </a>
                </h3>
                <p class="news-time">Ngày đăng : {{ $v->created_at }}</p>
                <div class="news-desc text-split"><?= htmlspecialchars_decode($v->desc) ?></div>
            </div>
            <?php }
        } else { ?>
            <div class="col-12">
                <div class="alert alert-warning w-100" role="alert">
                    <strong>Không tìm thấy kết</strong>
                </div>
            </div>
            <?php } ?>
            <div class="clear"></div>
        </div>
    </div>
@endsection
