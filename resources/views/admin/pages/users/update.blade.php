@extends('admin.layouts.master')

@section('custom_js')
    @vite(['resources/js/category/create.js'])

@endsection

@section('content')
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header">
            <div class="page-header-content">
                <div class="page-title">
                    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Tài khoản</span> -
                        Chỉnh sửa </h4>
                </div>

            </div>

            <div class="breadcrumb-line">
                <ul class="breadcrumb">
                    <li><a href="{{route('admin.dashboard')}}"><i class="icon-home2 position-left"></i> Bảng điều khiển</a>
                    </li>
                    <li><a href="{{route('admin.users.index')}}">Tài khoản</a></li>
                    <li class="active">Chỉnh sửa</li>
                </ul>
            </div>
        </div>
        <!-- /page header -->


        <!-- Content area -->
        <div class="content">

            <!-- Dashboard content -->
            <div class="row">
                <form action="{{ route('admin.users.update', @$user->id) }}" method="post">
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
                                        <input type="text" name="full_name" id="full_name" class="form-control"
                                               value="{{ old('full_name', @$user->full_name) }}">
                                        @error('full_name')
                                        <label id="basic-error" class="validation-error-label"
                                               for="basic">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label text-bold">Tên tài khoản<span
                                            class="text-danger">*</span></label>
                                    <div>
                                        <input disabled type="text" name="username" id="username" class="form-control"
                                               value="{{ old('username', @$user->username) }}">
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
                                        <input type="text" name="email" id="email" class="form-control"
                                               value="{{ old('email', @$user->email) }}">
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
                                        <input type="text" name="phone_number" id="phone_number" class="form-control"
                                               value="{{ old('phone_number', @$user->phone_number) }}">
                                        @error('phone_number')
                                        <label id="basic-error" class="validation-error-label"
                                               for="basic">{{ $message }}</label>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="control-label text-bold">Nhóm quyền<span
                                            class="text-danger">*</span></label>
                                    <div>
                                        <select id="selectIsActive" name="role"
                                                class="bootstrap-select form-control select-lg">
                                            <option selected
                                                    disabled>Chọn quyền</option>
                                            @forelse(@$roles ?? [] as $role)
                                                <option {{old('order', @$user->role) == $role['value'] ? 'selected' : ''}} value="{{$role['value']}}">{{$role['name']}}</option>
                                            @empty
                                            @endforelse
                                        </select>
                                        @error('role')
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
                                <div>
                                    <button class="btn btn-primary"><i class=" icon-paperplane"></i> Lưu
                                    </button>
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-default"><i
                                            class=" icon-close2"></i>
                                        Đóng</a>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <h6 class="panel-title"><i class="icon-gradient position-left"></i> Trạng thái</h6>
                            </div>
                            <div class="panel-body">
                                <div>
                                    <select id="selectIsActive" name="status"
                                            class="bootstrap-select form-control select-lg">
                                        <option value="1" {{old('order', @$user->status) == 1 ? 'selected' : ''}}>Công
                                            khai
                                        </option>
                                        <option value="0" {{old('order', @$user->status) == 0 ? 'selected' : ''}}>Ẩn
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            </form>

        </div>

        <!-- /dashboard content -->


        <!-- Footer -->
        @include('admin.includes.footer')
        <!-- /footer -->

    </div>
    <!-- /content area -->

    </div>
@endsection
