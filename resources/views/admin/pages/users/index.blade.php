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
                    <li class="active">Người dùng</li>
                </ul>
            </div>
        </div>
        <!-- /page header -->


        <!-- Content area -->
        <div class="content">
            <div class="row">
                <div class="col">
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-md-6">
                                    <form action="">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <input type="text" class="form-control" name="q"
                                                           value="{{ request()->query('q') }}"
                                                           placeholder="Tìm kiếm...">
                                                    <div class="form-control-feedback">
                                                        <i class="icon-search4 text-size-base"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <button class="btn-primary btn" type="submit">Tìm kiếm</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-2"></div>
                                <div class="col-md-4 text-right">
                                    <div class="form-group has-feedback has-feedback-left"
                                         style="text-align: end">
                                        <a type="button" href=""
                                           data-toggle="modal" data-target="#modal_keyboard"
                                           class="btn btn-success {{!checkPermission('admin') ? 'select2-display-none' : ''}}"><i
                                                class="icon-upload"></i>
                                            Nhập File</a>
                                        <a type="button" href="{{ route('admin.users.export-file') }}"
                                           class="btn btn-info {{!checkPermission('admin') ? 'select2-display-none' : ''}}"><i
                                                class="icon-file-excel"></i>
                                            Xuất File</a>
                                        <a type="button" href="{{ route('admin.users.create') }}"
                                           class="btn btn-primary {{!checkPermission('admin') ? 'select2-display-none' : ''}}"><i
                                                class="icon-add"></i>
                                            Thêm mới</a>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            <div class="table">

                                <table class="table table-bordered" id="user-table">
                                    <thead>
                                    <tr>
                                        <th style="width: 5%; text-align: center">STT</th>
                                        <th>Họ và tên</th>
                                        <th>Tên tài khoẻn</th>
                                        <th style="text-align: center">Email</th>
                                        <th style="text-align: center">Số điện thoại</th>
                                        <th style="text-align: center">Vai trò</th>
                                        <th style="text-align: center">Trạng thái</th>
                                        <th style="width: 150px; text-align: center" class="{{!checkPermission('admin') ? 'select2-display-none' : ''}}" >Hành động</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($users as $user)
                                        <tr>
                                            <td style="text-align: center">{{ $loop->index + 1 + $users->perPage() * ($users->currentPage() - 1)   }}</td>
                                            <td>
                                                <span style="font-weight: bold"><a
                                                        href="{{ route('admin.users.edit', $user->id) }}">{{ $user->full_name ? $user->full_name : $user->username}}</a></span>
                                            </td>
                                            <td>{{ $user->username ?? '' }}</td>
                                            <td style="text-align: center">{{ $user->email }}</td>
                                            <td style="text-align: center">{{ $user->phone_number }}</td>
                                            <td style="text-align: center">{!!  $user->roleText ?? ''!!}</td>
                                            <td style="text-align: center">{!! @$user->isActiveText !!}</td>
                                            <td style="text-align: center" class="{{!checkPermission('admin') ? 'select2-display-none' : ''}}">
                                                <ul class="icons-list">
                                                    <li class="dropdown">
                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                                                           aria-expanded="false"><i class="icon-menu7"></i></a>
                                                        <ul class="dropdown-menu dropdown-menu-right">
                                                            <li><a href="{{ route('admin.users.edit', $user->_id) }}"><i
                                                                        class="icon-pencil7"></i> Chỉnh sửa</a></li>
                                                            <li>
                                                                <a href="javascript:void(0);" class="btn-delete"
                                                                   data-id="{{$user->_id}}"><i class="icon-trash"></i>
                                                                    Xóa</a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="8" style="text-align: center">
                                                <img src="{{ asset('assets\admin\images\empty.png') }}" width="350px"
                                                     alt="">
                                                <div>Không có dữ liệu</div>
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div
                                style="display: flex; justify-content: space-between; align-items: center; margin-top: 10px">
                                <div class="per_page">

                                </div>
                                <div class="pagination">
                                    {{ $users->appends(request()->input())->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Dashboard content -->
            <!-- /dashboard content -->


            <!-- Footer -->
            @include('admin.includes.footer')
            <!-- /footer -->
            <form action="" method="post" id="frm-delete">
                @csrf
                @method('delete')
            </form>

            <div id="modal_keyboard" class="modal fade" data-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h5 class="modal-title">Chọn file execl muốn nhập</h5>
                        </div>
                        <div style="padding-left: 20px; padding-top: 10px">
                            <a type="button" href="{{route('admin.users.download-file')}}"
                               class="btn btn-info {{!checkPermission('admin') ? 'select2-display-none' : ''}}"><i
                                    class="icon-database"></i>
                                Tải file import mẫu</a>
                        </div>
                        <form action="{{route('admin.users.import-file')}}" class="" id="dropzone_single"
                              enctype="multipart/form-data" method="post" >
                            @csrf
                            <div class="modal-body">
                                <div class="dropzone">
                                    <input type="file" name="file">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /content area -->

    </div>
@endsection
