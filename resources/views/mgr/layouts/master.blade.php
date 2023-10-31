<!doctype html >
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title>@yield('title') | {{ config('app.name')}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Management Project Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="{{ URL::asset('assets/img/favicon.png')}}">
    @include('mgr.layouts.head-css')
</head>
@section('body')
    @include('mgr.layouts.body')
@show
    <div id="layout-wrapper">
        @include('mgr.layouts.topbar')
        @include('mgr.layouts.sidebar')
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            @include('mgr.layouts.footer')
        </div>
    </div>
    @include('mgr.layouts.customizer')
    @include('mgr.layouts.vendor-scripts')
</body>

</html>
