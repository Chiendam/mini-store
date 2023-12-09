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

                <!-- Password recovery -->
                <form action="{{ route('admin.handleResetPassword', ['token' => $token]) }}" method="post">
                    @csrf
                    <div class="panel panel-body login-form">
                        <div class="text-center">
                            <div class="icon-object border-warning text-warning"><i class="icon-lock2"></i></div>
                            <h5 class="content-group">Đặt lại mật khẩu</h5>
                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                            <input type="password" class="form-control" id="password" value="{{ old('password') }}"
                                   name="password" placeholder="Mật khẩu mới">
                            <div class="form-control-feedback">
                                <i class="icon-lock2 text-muted"></i>
                            </div>
                            @error('password')
                            <label id="error-password" class="validation-error-label" for="basic">{{ $message }}</label>
                            @enderror
                        </div>

                        <div class="form-group has-feedback has-feedback-left">
                            <input type="password" class="form-control" id="password_confirmation" value="{{ old('password_confirmation') }}"
                                   name="password_confirmation" placeholder="Nhập lại mật khẩu">
                            <div class="form-control-feedback">
                                <i class="icon-lock2 text-muted"></i>
                            </div>
                            @error('password_confirmation')
                            <label id="error-password_confirmation" class="validation-error-label" for="basic">{{ $message }}</label>
                            @enderror
                        </div>

                        <button type="submit" class="btn bg-blue btn-block btn-send">Đặt lại<i class="icon-arrow-right14 position-right"></i></button>
                        <div class="text-center mt-10">
                            <a href="{{ route('admin.getLoginForm') }}">Quay lại đăng nhập</a>
                        </div>
                    </div>
                </form>
                <!-- /password recovery -->


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
@production
    @php
        $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
    @endphp
    <script type="module" src="/build/{{ $manifest['resources/js/login/index.js']['file'] }}"></script>
    @else
        @vite(['resources/js/login/index.js'])
        @endproduction
</html>
