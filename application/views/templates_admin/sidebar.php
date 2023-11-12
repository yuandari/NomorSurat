<body id="page-top" class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-primary">
        <!-- Sidebar Toggle-->
        <!-- <div class="col-md-0">
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-8 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        </div> -->
        <!-- navbar title -->
        <a class="navbar-brand ps-3">BALAI BESAR WILAYAH SUNGAI MESUJI SEKAMPUNG</a>


        <!-- Topbar Navbar -->
        <div class="col-md-12">
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4 text-right">
                <!-- Nav Item - User Information -->
                <div class="col-md-10 text-right">
                    <a class="nav-link">
                        <span class=" text-right text-gray-300 ms-auto me-0 me-md-3 my-2 my-md-0 small"><?= $user['nama'] ?></span>
                        <img class="img-profile rounded-circle" src="<?= base_url('assets/img/profile/') . $user['photo'] ?>" width="40px">
                    </a>
                </div>
            </ul>
        </div>
    </nav>
    <!-- End of Topbar -->

    <!-- Sidebar -->
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <br>
                        <!-- Navbar Brand-->
                        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                            <img class="bg-white" src="<?= base_url('assets/img/logopupr.jpg') ?>" alt="" height="50" srcset="">
                        </a>

                        <br>
                        <!-- Nav Item - Dashboard -->
                        <a class="nav-link" href="<?= base_url('Admin') ?>">
                            <div class="nav-link-icon">
                                <i class="fas fa-solid fa-house"></i>
                                <span>Dashboard</span>
                            </div>
                        </a>
                        <!-- Divider -->
                        <hr class="sidebar-divider my-0">

                        <!-- Nav Item - Nomor Surat -->
                        <a class="nav-link " href="<?= base_url('Admin/Nomor') ?>">
                            <div class="nav-link-icon">
                                <i class="fas fa-fw fa-hashtag"></i>
                                <span>Nomor Surat</span>
                            </div>
                        </a>

                        <!-- Nav Item - Klasifikasi Surat -->
                        <a class="nav-link pb-2 pt-1" href="<?= base_url('Admin/DataKlasifikasi') ?>">
                            <div class="nav-link-icon">
                                <i class="fas fa-fw fa-clipboard-list"></i>
                                <span>Klasifikasi Surat</span>
                            </div>
                        </a>

                        <!-- Nav Item - Pejabat Penandatangan -->
                        <a class="nav-link pb-2 pt-1" href="<?= base_url('Admin/dataPejabat') ?>">
                            <div class="nav-link-icon">
                                <i class="fas fa-solid fa-briefcase"></i>
                                <span>Data Pejabat</span>
                            </div>
                        </a>

                        <!-- Nav Item - Data User -->
                        <a class="nav-link pb-2 pt-1" href="<?= base_url('Admin/DataUser') ?>">
                            <div class="nav-link-icon">
                                <i class="fas fa-fw fa-users"></i>
                                <span>Data User</span>
                            </div>
                        </a>

                        <!-- Divider -->
                        <hr class="sidebar-divider my-0">

                        <!-- Nav Item - Profile -->
                        <a class="nav-link" href="<?= base_url('Admin/Profile') ?>">
                            <div class="nav-link-icon">
                                <i class="fas fa-fw fa-user"></i>
                                <span>Profile</span>
                            </div>
                        </a>

                        <!-- Nav Item - Ganti Password -->
                        <a class="nav-link pb-2 pt-1" href="<?= base_url('Admin/ganti_password') ?>">
                            <div class="nav-link-icon">
                                <i class="fas fa-fw fa-key"></i>
                                <span>Ganti Password</span>
                            </div>
                        </a>

                        <!-- Nav Item - Logout -->
                        <a class="nav-link pb-2 pt-1" href="<?= base_url('Login/logout') ?>" data-toggle="modal" data-target="#logoutModal">
                            <div class="nav-link-icon">
                                <i class="fas fa-fw fa-sign-out-alt"></i>
                                <span>Logout</span>
                            </div>
                        </a>

                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Copyright &copy; BBWS-MS <?= date('Y'); ?></div>
                </div>
            </nav>
        </div>