<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('dist/img/image.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">MONITORINGLog</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('photo/' . auth()->user()->photo) }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{ Route('profile') }}" class="d-block">{{ auth()->user()->name }}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                    aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item menu-open">
                    <a href="{{ route('dashboard') }}"
                        class= "{{ Request::is('dashboard') ? 'nav-link active' : 'nav-link' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item menu-open">
                    <a href="{{ route('unitdata') }}"
                        class="{{ Request::is('unitdata') ? 'nav-link active' : 'nav-link' }}">
                        <i class="nav-icon fas fa-database"></i>
                        <p>
                            Data Unit
                        </p>
                    </a>
                </li>

                <li class="nav-item menu-open">
                            <a href="{{ route('down') }}"
                                class="{{ Request::is('menudown') ? 'nav-link active' : 'nav-link' }}">
                                <i class="fas fa-arrow-down nav-icon"></i>
                                <p>Data Down</p>
                            </a>
                        </li>
                </li>

                <li class="nav-item menu-open">
                    <a href="{{ route('laporan') }}"
                        class="{{ Request::is('laporan') ? 'nav-link active' : 'nav-link' }}">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>
                            Laporan
                        </p>
                    </a>
                </li>

                <li class="nav-item menu-open">
                    <a href="{{ route('profile') }}"
                        class="{{ Request::is('profile') ? 'nav-link active' : 'nav-link' }}">
                        <i class="far fas fa-user nav-icon"></i>
                        <p>
                            Profile
                        </p>
                    </a>
                </li>

                </li>
                <li class="nav-item menu-open">
                    <a href="{{ route('logout') }}" class= "nav-link">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Log Out
                        </p>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
