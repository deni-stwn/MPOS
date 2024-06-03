<aside class="main-sidebar bg-white border-r-2 border-[#E6E6E6]">
    <!-- Brand Logo -->
    <a href="/" class="brand-link border-b-2 border-[#E6E6E6]">
        <img src="{{ asset('logo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-2"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Mangcoding POS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}"
                        class="nav-link flex items-center gap-2 {{ Route::currentRouteName() == 'dashboard' ? 'actived' : '' }}">
                        <img src="{{ asset('assets/images/dashboard.svg') }}" alt="">
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-header text-base">Master</li>
                @if (Auth::user()->usertype == 'admin')
                    <li class="nav-item">
                        <a href="{{ route('users.index') }}"
                            class="nav-link flex items-center gap-2 {{ Route::currentRouteName() == 'users.index' ? 'actived' : '' }}">
                            <img src="{{ asset('assets/images/dashboard.svg') }}" alt="">
                            <p>
                                User
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="{{ route('categories.index') }}"
                        class="nav-link flex items-center gap-2 {{ Route::currentRouteName() == 'categories.index' ? 'actived' : '' }}">
                        <img src="{{ asset('assets/images/dashboard.svg') }}" alt="">
                        <p>
                            {{ trans('cruds.category.category') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('products.index') }}"
                        class="nav-link flex items-center gap-2 {{ Route::currentRouteName() == 'products.index' ? 'actived' : '' }}">
                        <img src="{{ asset('assets/images/dashboard.svg') }}" alt="">
                        <p>
                            {{ trans('cruds.product.product') }}
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('stores.index') }}"
                        class="nav-link flex items-center gap-2 {{ Route::currentRouteName() == 'stores.index' ? 'actived' : '' }}">
                        <img src="{{ asset('assets/images/dashboard.svg') }}" alt="">
                        <p>
                            {{ trans('cruds.store.store') }}
                        </p>
                    </a>
                </li>
                <li class="nav-header text-base">Payment</li>
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="./index.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./index2.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Product</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="./index3.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Category</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="pages/widgets.html" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Widgets
                            <span class="right badge badge-danger">New</span>
                        </p>
                    </a>
                </li>
                <li class="nav-header">EXAMPLES</li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
