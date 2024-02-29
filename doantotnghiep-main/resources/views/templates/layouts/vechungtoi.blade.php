@extends('templates.index')
@php
    use App\Http\Controllers\HomeController;
    $func = new HomeController();
@endphp
@section('body')
    @include('templates.layouts.header')
    <div class="wrap-aboutus-content">
        <div class="wrap-content">
            @if (isset($gioithieu))
                <div class="title-main">
                    <span>
                        {{ $gioithieu->name }}
                    </span>
                </div>
                <div class="about-us-content">
                    <span>
                        <?= htmlspecialchars_decode($gioithieu->content) ?>
                    </span>
                </div>
            @endif
        </div>
    </div>
@endsection
