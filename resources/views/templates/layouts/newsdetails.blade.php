@extends('templates.index')
@php
    use App\Http\Controllers\HomeController;
    $func = new HomeController();
@endphp
@section('body')
    @include('templates.layouts.header')
    <div class="wrap-content">
        <div class="title-main"><span>{{ $news->name }}</span></div>
        <div class="content-main">
            <?php if (!empty($news)) { ?>
            <a class="news-image" title="{{ $news->name }}">
                <span class="scale-img">
                    <img src="../{{ $func->formatLinkNews($news->id, $news->photo) }}" alt="">
                </span>
            </a>
            <div class="news-desc"><?= htmlspecialchars_decode($news->content) ?></div>
            <?php }
         else { ?>
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
