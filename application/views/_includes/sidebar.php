<div class="sb-sidenav-menu">
    <div class="nav">
        <a class="nav-link" href="index.html">
            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
            Dashboard
        </a>
        <div class="sb-sidenav-menu-heading">Master Data</div>
        <?php if ($this->session->user_logged->role == "admin") { ?>
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                Users
                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
            </a>
            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                <nav class="sb-sidenav-menu-nested nav">
                    <a class="nav-link" href="<?= site_url('admin'); ?>">Admin</a>
                    <a class="nav-link" href="<?= site_url('relation-officer'); ?>">Relation Officer (RO)</a>
                </nav>
            </div>
        <?php } ?>
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
            Badan Usaha
            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
        </a>
        <div class="collapse" id="collapsePages" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
            <nav class="sb-sidenav-menu-nested nav">
                <a class="nav-link" href="<?= site_url('company'); ?>">Daftar BU</a>
            </nav>
        </div>
        
        <div class="sb-sidenav-menu-heading">Transaksi Data</div>
        <?php if ($this->session->user_logged->role == "admin") { ?>
        <a class="nav-link" href="<?php echo site_url('administrasi'); ?>">
            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
            Administrasi
        </a>
        <?php } ?>
        <a class="nav-link" href="<?php echo site_url('telemarketing'); ?>">
            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
            Telemarketing
        </a>
        
        <?php if ($this->session->user_logged->role == "admin") { ?>
        <div class="sb-sidenav-menu-heading">Laporan</div>
        <a class="nav-link" href="charts.html">
            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
            Rekapitulasi
        </a>
        <?php } ?>
    </div>
</div>
<div class="sb-sidenav-footer">
    <div class="small">Logged in as:</div>
    <?php echo $this->session->user_logged->username; ?>
</div>