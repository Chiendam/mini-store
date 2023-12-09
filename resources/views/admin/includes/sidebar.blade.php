<div class="sidebar sidebar-main">
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="category-content">
                <div class="media">
                    <a href="#" class="media-left"><img src=""
                                                        class="img-circle img-sm" alt=""></a>
                    <div class="media-body">
                        <span class="media-heading text-semibold"></span>
                        <div class="text-size-mini text-muted">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /users menu -->


        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">

                    <!-- Main -->
                    <li class="{{ request()->is('admin') ? 'active' : '' }}"><a
                            href="{{route('admin.dashboard')}}"><i class="icon-home4"></i>
                            <span>Bảng điều khiển</span></a>
                    </li>
                    <li class="{{ request()->is('admin/users*') ? 'active' : '' }}"><a
                            href="{{route('admin.users.index')}}"><i class="icon-user"></i>
                            <span>Quản lý tài khoản</span></a>
                    </li>
                    <!-- /page kits -->

                </ul>
            </div>
        </div>
        <!-- /main navigation -->

    </div>
</div>
