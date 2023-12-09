<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Trang quản trị - HLY')</title>

    @include('admin.includes.style')

    @yield('custom_css')

    @include('admin.includes.script')

    @yield('custom_js')
</head>

<body>

<!-- Main navbar -->
@include('admin.includes.navbar')
<!-- /main navbar -->


<!-- Page container -->
<div class="page-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        @include('admin.includes.sidebar')
        <!-- /main sidebar -->


        <!-- Main content -->
        @yield('content')
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

</body>
</html>

