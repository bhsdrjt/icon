<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <li class="mt-1 nav-item ">
    <a class="sidebar-brand " href="/Admin/dashboard">
    <!-- <h3>ICON +</h3>     -->
    <img src="<?= base_url('assets/logo-icon.png'); ?>" width="80%">    
    <!-- <div class="sidebar-brand-text mx-3"><?= session()->get('nama_user') ?></div> -->
    </a>
    </li>
    

    <!-- Nav Item - Dashboard -->
    <!-- <li class="mt-1 nav-item ">
        <a class="nav-link" href="/Admin/dashboard">
            <i class="fa fa-line-chart"></i>
            <b><span>DASHBOARD</span></b>
            </a>
    </li> -->
    <?php if($_SESSION['role'] == 'Admin') {?>
        <li class="nav-item ">
            <a class="nav-link" href="/Laporan/LaporanMasuk">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <b><span>LAPORAN MASUK</span></b>
            </a>
        </li>
        <li class="nav-item ">
            <a class="nav-link" href="/Laporan/Maintenance">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <b><span>MAINTENANCE</span></b>
            </a>
        </li>
    <?php } ?>
    <li class="nav-item ">
        <a class="nav-link" href="/Laporan/Penanganan">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <b><span>PENANGANAN</span></b>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">
    
    <!-- Nav Item - Pages Collapse Menu -->
    <?php if($_SESSION['role'] == 'Admin') {?>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <b><span>MASTER DATA</span></b>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Master Data</h6>
                <a class="collapse-item" href="/Pelanggan/MasterPelanggan">Data Pelanggan</a>
                <a class="collapse-item" href="/Teknisi/MasterTeknisi">Data Teknisi</a>
                <a class="collapse-item" href="/Inventory/MasterInventory">Data Inventory</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider">
    <?php } ?>
    <li class="nav-item ">
            <a class="nav-link collapsed" class="text-center" data-toggle="modal" data-target="#logoutModal">
            <i class="fa fa fa-sign-out"></i>
            <b><span >LOGOUT</span></b>
        </a>
    </li>




    <!-- Heading
    <div class="sidebar-heading">
        Addons
    </div> -->

    <!-- Nav Item - Pages Collapse Menu -->

    <!-- Nav Item - Charts -->
    <!-- <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Laporan</span></a>
    </li> -->


    <!-- Divider -->
    <!-- <hr class="sidebar-divider d-none d-md-block"> -->

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



</ul>
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Yakin Ingin Logout</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <!-- <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div> -->
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <a class="btn btn-primary" href="/Login/logout">Logout</a>
                    </div>
                </div>
            </div>
        </div>
<!-- End of Sidebar -->