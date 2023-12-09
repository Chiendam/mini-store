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
                <form action="{{ route('admin.handleRecoverPasswordForm') }}" method="post">
                    @csrf
                    <div class="panel panel-body login-form">
                        <div class="text-center">
                            <div class="icon-object border-warning text-warning"><i class="icon-spinner11"></i></div>
                            <h5 class="content-group">Quên mật khẩu <small class="display-block">Chúng tôi sẽ gửi cho bạn hướng dẫn trong email</small></h5>
                        </div>

                        <div class="form-group has-feedback">
                            <input type="email" class="form-control" id="input-email" name="email"  placeholder="Email của bạn">
                            <div class="form-control-feedback">
                                <i class="icon-mail5 text-muted"></i>
                            </div>
                            @error('email')
                            <label id="error-email" class="validation-error-label" for="basic">{{ $message }}</label>
                            @enderror

                        </div>

                        <button type="submit" class="btn bg-blue btn-block btn-send">Gửi<i class="icon-arrow-right14 position-right"></i></button>
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
