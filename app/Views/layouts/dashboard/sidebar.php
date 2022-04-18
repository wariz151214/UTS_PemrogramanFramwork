<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" target="_blank" class="brand-link">
        <img src="/assets/img/uhotel2.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?= $sidebar_title; ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="/assets/img/user-profile/<?= session()->get('avatar'); ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="/dashboard" class="d-block"><?= session()->get('full_name'); ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-header">HOME</li>
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-header">HOTELS</li>
                <li class="nav-item">
                    <a href="/dashboard/hotels/add" class="nav-link">
                        <i class="nav-icon fas fa-hotel"></i>
                        <p>Add Hotel</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/dashboard/hotels" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>View Hotel List</p>
                    </a>
                </li>

                <li class="nav-header">MISC</li>
                <li class="nav-item">
                    <a href="/auth/logout" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
                        <p class="text">Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>