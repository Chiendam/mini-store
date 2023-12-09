@extends('admin.layouts.master')
@section('custom_js')
    @vite(['resources/js/users/index.js'])
@endsection
@section('content')
    <div class="content-wrapper">

        <!-- Page header -->
        <div class="page-header">
            <div class="page-header-content">
                <div class="page-title">
                    <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Tài khoản</span> -
                        Danh sách tài khoản</h4>
                </div>

            </div>

            <div class="breadcrumb-line">
                <ul class="breadcrumb">
                    <li><a href="{{route('admin.dashboard')}}"><i class="icon-home2 position-left"></i> Bảng điều khiển</a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- /page header -->


        <!-- Content area -->
<div class="content">
    <div class="panel panel-flat">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-6">
                    <h4>Họ và tên: <span style="font-weight: 900">{{ $user->full_name }}</span></h4>
                    <h4>Tên tài khoản: <span style="font-weight: 900"> {{ $user->username }}</span></h4>
                    <h4>Email: <span style="font-weight: 900">{{ $user->email }}</span></h4>
                    <h4>Số điện thoại: <span style="font-weight: 900">{{ $user->phone_number }}</span></h4>
                </div>
                <div class="col-md-6 text-right">
                    <div class="form-group has-feedback has-feedback-left"
                    >
                        <a type="button" href="{{ route('admin.edit-profile') }}"
                           class="btn btn-primary {{!checkPermission('admin') ? 'select2-display-none' : ''}}"><i
                                class="icon-database-edit2"></i>
                            Chỉnh sửa profile</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
        <!-- /content area -->

    </div>
@endsection
