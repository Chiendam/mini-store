@extends('admin.layouts.master')

@section('custom_js')
    @production
        @php
            $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
        @endphp
        <script type="module" src="/build/{{$manifest['resources/js/users/profile.js']['file']}}"></script>
        @else
            @vite(['resources/js/users/profile.js'])
    @endproduction
@endsection
            @section('content')
                <div class="content-wrapper">

                    <!-- Page header -->
                    <div class="page-header">
                        <div class="page-header-content">
                            <div class="page-title">
                                <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Tài khoản</span></h4>
                            </div>
                        </div>
                        <div class="breadcrumb-line">
                            <ul class="breadcrumb">
                                <li><a href="{{route('admin.dashboard')}}"><i class="icon-home2 position-left"></i> Bảng điều khiển</a>
                                </li>
                                <li><a href="{{route('admin.users.index')}}">Tài khoản</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- /page header -->

                    <!-- Content area -->
                    <div class="content">

                        <!-- Dashboard content -->
                        <div class="row">
                            <form id="form-profile" action="{{ route('admin.users.updateProfile', @$user->id) }}" method="post" >
                                @csrf
                                @method('put')
                                <div class="col-md-9">
                                    <div class="panel panel-white">
                                        <div class="panel-heading">
                                            <h6 class="panel-title"><i class="icon-info22 position-left"></i> Thông tin</h6>
                                        </div>
                                        <div class="panel-body row">
                                            <div class="form-group col-md-6">
                                                <label class="control-label text-bold">Họ và tên<span
                                                        class="text-danger">*</span></label>
                                                <div>
                                                    <input type="text" name="fullname" id="fullname" class="form-control" value="{{ old('fullname', @$user->fullname) }}">
                                                    @error('fullname')
                                                    <label id="basic-error" class="validation-error-label"
                                                           for="basic">{{ $message }}</label>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="control-label text-bold">Tên tài khoản<span
                                                        class="text-danger">*</span></label>
                                                <div>
                                                    <input disabled type="text" name="username" id="username" class="form-control" value="{{ old('fullname', @$user->username) }}">
                                                    @error('username')
                                                    <label id="basic-error" class="validation-error-label"
                                                           for="basic">{{ $message }}</label>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label class="control-label text-bold">Email<span
                                                        class="text-danger">*</span></label>
                                                <div>
                                                    <input type="text" name="email" id="email" class="form-control" value="{{ old('email', @$user->email) }}">
                                                    @error('email')
                                                    <label id="basic-error" class="validation-error-label"
                                                           for="basic">{{ $message }}</label>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label class="control-label text-bold">Số điện thoại<span
                                                        class="text-danger">*</span></label>
                                                <div>
                                                    <input type="text" name="phone_number" id="phone_number" class="form-control" value="{{ old('phone_number', @$user->phone_number) }}">
                                                    @error('phone_number')
                                                    <label id="basic-error" class="validation-error-label"
                                                           for="basic">{{ $message }}</label>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="panel panel-white">
                                        <div class="panel-heading">
                                            <h6 class="panel-title"><i class="icon-cog3 position-left"></i> Tác vụ</h6>
                                        </div>
                                        <div class="panel-body">
                                            <div class="d-grid gap-5">
                                                <button class="btn btn-primary"><i class=" icon-paperplane"></i> Lưu
                                                </button>
                                                <a data-id="{{@$user->id}}" class="btn btn-success btn-change-password" data-toggle="modal"
                                                   data-target="#modal_change_password" ><i class=" icon-lock"></i> Đổi mật khẩu
                                                </a>
                                                <a href="{{ url()->previous() }}" class="btn btn-default"><i
                                                        class=" icon-close2"></i>
                                                    Đóng</a>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        </form>
                    </div>

                    <div id="modal_change_password" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" id="btnCloseFormChangPass" class="close" data-dismiss="modal">&times;</button>
                                    <h5 class="modal-title">Đổi mật khẩu</h5>
                                </div>

                                <form action="#" id="form_change_password">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>Mật khẩu hiện tại</label>
                                                    <input id="modal_change_password-password" type="password" placeholder="Nhập mật khẩu hiện tại" class="form-control">
                                                    <span id="modal_change_password-password_smg" class="text-danger"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>Mật khẩu mới</label>
                                                    <input id="modal_change_password-password_new" type="password" placeholder="Nhập mật khẩu mới" class="form-control">
                                                    <span id="modal_change_password-password_new_smg" class="text-danger"></span>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>Xác nhận mật khẩu mới</label>
                                                    <input id="modal_change_password-password_new_confirm" type="password" placeholder="Nhập mật khẩu mới" class="form-control">
                                                    <span id="modal_change_password-password_new_confirm_smg" class="text-danger"></span>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-link" data-dismiss="modal">Đóng</button>
                                        <button type="button" class="btn btn-primary btn-change-password">Đồng ý</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    @include('admin.includes.footer')
                    <!-- /footer -->
                    <form action="" method="post" id="frm-change-password" class="hidden">
                        @csrf
                        @method('post')
                        <input type="password" id="password-form-change" name="password" placeholder="">
                        <input type="password" id="new-password-form-change" name="newPassword" placeholder="">
                    </form>
                </div>
                <!-- /content area -->

                </div>
            @endsection
