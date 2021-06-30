<!DOCTYPE html>
<html lang="en">
    <head>
        <?php $this->load->view("_includes/header.php");?>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <?php $this->load->view("_includes/navbar.php");?>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <?php $this->load->view("_includes/sidebar.php");?>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <?php $this->load->view("_includes/breadcrumb.php");?>
                        <div class="card mb-4">
                            <?php if ($this->session->flashdata('success')): ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $this->session->flashdata('success'); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <?php endif; ?>
                            <div class="card-header">
                                <button type="button" class="btn-sm btn-success">
                                    <span aria-hidden="true">Export Excel</span>
                                </button>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nama RO</th>
                                                <th>Nama Badan Usaha</th>
                                                <th>Alamat</th>
                                                <th>Sumber</th>
                                                <th>Tenaga Kerja</th>
                                                <th>Keluarga</th>
                                                <th>Last Call</th>
                                                <th>Respon Telepon</th>
                                                <th>Skala Akurasi</th>
                                                <th>Hasil Telepon</th>
                                                <th>Total Telepon</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td width="15%">
                                                </td>
                                                <td width="20%">
                                                </td>
                                                <td width="20%">
                                                </td>
                                                <td width="5%">
                                                </td>
                                                <td width="10%">
                                                </td>
                                                <td width="10%">
                                                </td>
                                                <td width="10%">
                                                </td>
                                                <td width="10%">
                                                </td>
                                                <td width="10%">
                                                </td>
                                                <td width="10%">
                                                </td>
                                                <td width="10%">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
                <?php $this->load->view("_includes/footer.php");?>
            </div>
        </div>
        <?php $this->load->view("_includes/modal.php"); ?>
        <?php $this->load->view("_includes/js.php"); ?>
        <script>
        function deleteConfirm(url){
            $('#btn-delete').attr('href', url);
            $('#deleteModal').modal();
        }
        </script>
    </body>
</html>
