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
                                <a href="<?php echo site_url('summary/export'); ?>" type="button" class="btn-sm btn-success">
                                    <span aria-hidden="true">Export Excel</span>
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Nama RO</th>
                                                <th>Nama_Badan_Usaha</th>
                                                <th>Alamat</th>
                                                <th>Sumber</th>
                                                <th>Tenaga_Kerja</th>
                                                <th>Keluarga</th>
                                                <th>Stratifikasi</th>
                                                <th>Last_Call</th>
                                                <th>Respon_Telepon</th>
                                                <th>Hasil_Telepon</th>
                                                <th>Total_Telepon</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($summaries as $summary): ?>
                                            <tr>
                                                <td width="15%">
                                                    <?php echo $summary->fullname ?>
                                                </td>
                                                <td width="20%">
                                                    <?php echo $summary->company_name ?>
                                                </td>
                                                <td width="20%">
                                                    <?php echo $summary->address ?>
                                                </td>
                                                <td width="5%">
                                                    <?php echo $summary->data_source ?>
                                                </td>
                                                <td width="10%">
                                                    <?php echo $summary->employee ?>
                                                </td>
                                                <td width="10%">
                                                    <?php echo $summary->employee_family ?>
                                                </td>
                                                <td width="10%">
                                                    <?php echo $summary->stratifikasi ?>
                                                </td>
                                                <td width="10%">
                                                    <?php echo $summary->last_call ?>
                                                </td>
                                                <td width="10%">
                                                    <?php echo $summary->call_response_desc ?>
                                                </td>
                                                <td width="10%">
                                                    <?php echo $summary->result_desc ?>
                                                </td>
                                                <td width="10%">
                                                    <?php echo $summary->total ?>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
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
