<!DOCTYPE html>
<html lang="en">
@include('templates.layouts.head')
@include('templates.layouts.css')
<body class="index ">
    <div class="box-full">
        @yield('body')
    </div>
    @include('templates.layouts.footer')
    @include('templates.layouts.modal')
    @include('templates.layouts.js')
</body>
</html>
