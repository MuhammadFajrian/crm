<a class="navbar-brand" href="index.html">ELLATE KC Depok</a>
<button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
<!-- Navbar Search-->
<form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
</form>
<!-- Navbar-->
<div class="dropdown">
    <a class="nav-link dropdown-toggle" id="dLabel" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
    <div class="dropdown-menu" aria-labelledby="dLabel">
        <a class="dropdown-item" href="<?= site_url('user/profile') ?>">Profile</a>
        <a class="dropdown-item" href="<?= site_url('user/setting') ?>">Setting</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="<?= site_url('user/logout') ?>">Logout</a>
    </div>
</div>