<?php 
    if (isset($_GET['page'])) {
        if ($_GET['page'] == 'dashboard') {
            $active1 = 'active';
            $active2 = '';
            $active3 = '';
            $active4 = '';
        } else if ($_GET['page'] == 'pelanggan') {
            $active1 = '';
            $active2 = 'active';
            $active3 = '';
            $active4 = '';
        } else if ($_GET['page'] == 'layanan') {
            $active1 = '';
            $active2 = '';
            $active3 = 'active';
            $active4 = '';
        } else if ($_GET['page'] == 'transaksi') {
            $active1 = '';
            $active2 = '';
            $active3 = '';
            $active4 = 'active';
        } else {
            $active1 = '';
            $active2 = '';
            $active3 = '';
            $active4 = '';
        }
    } else {
        $active1 = 'active';
        $active2 = '';
        $active3 = '';
        $active4 = '';
    }
?>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SI Laundry</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= $active1; ?>">
        <a class="nav-link" href="index.php?page=dashboard">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item <?= $active2; ?>">
        <a class="nav-link" href="index.php?page=pelanggan">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Pelanggan</span></a>
    </li>
    <li class="nav-item <?= $active3; ?>">
        <a class="nav-link" href="index.php?page=layanan">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Layanan</span></a>
    </li>
    <li class="nav-item <?= $active4; ?>">
        <a class="nav-link" href="index.php?page=transaksi">
        <i class="fas fa-fw fa-chart-area"></i>
        <span>Transaksi</span></a>
    </li>

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>