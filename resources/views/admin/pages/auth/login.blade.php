<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Trang quản trị - HLY</title>

    @include('admin.includes.style')

    @include('admin.includes.script')

</head>

<body>

<!-- Page container -->
<div class="page-container login-container">

    <!-- Page content -->
    <div class="page-content">

        <!-- Main content -->
        <div class="content-wrapper">

            <!-- Content area -->
            <div class="content">

                <!-- Simple login form -->
                <form action="{{ route('admin.login') }}" method="post" id="loginForm">
                    @csrf
                    <div class="panel panel-body login-form">
                        <div class="text-center">
                            <div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
                            <h5 class="content-group">Chào mừng quay trở lại </h5>
                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                            <input type="text" class="form-control" id="username" value="{{ old('username') }}"
                                   name="username" placeholder="Tên đăng nhập">
                            <div class="form-control-feedback">
                                <i class="icon-user text-muted"></i>
                            </div>
                            @error('username')
                            <label id="error-username" class="validation-error-label" for="basic">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                            <input type="password" class="form-control" id="password" value="{{ old('password') }}"
                                   name="password" placeholder="Mật khẩu">
                            <div class="form-control-feedback">
                                <i class="icon-lock2 text-muted"></i>
                            </div>
                            @error('password')
                            <label id="error-password" class="validation-error-label" for="basic">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group">
                            <button type="submit" id="btn-login" class="btn btn-primary btn-block">Đăng nhập <i
                                    class="icon-circle-right2 position-right"></i></button>
                        </div>

                        <div class="text-center">
                            <a href="">Quên mật khẩu</a>
                        </div>
                    </div>
                </form>
                <!-- /simple login form -->

                <!-- Footer -->
            @include('admin.includes.footer')
            <!-- /footer -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

</body>
@vite(['resources/js/login/index.js'])

</html>
