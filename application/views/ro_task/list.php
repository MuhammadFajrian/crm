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
                                <a href="<?php echo site_url('ro_task/add') ?>"><i class="fas fa-plus"></i> Add New</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Deadline</th> 
                                                <th>Badan Usaha</th> 
                                                <th>Last Call</th>
                                                <th>Next Call</th>
                                                <th>Respon</th>
                                                <th>Hasil</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($ro_tasks as $ro_task): ?>
                                            <tr>
                                                <td width="15%">
                                                    <?php echo $ro_task->deadline ?>
                                                </td>
                                                <td width="20%">
                                                    <a href="<?php echo site_url("telemarketing/edit/".$ro_task->admin_task_id) ?>"><?php echo $ro_task->name ?></a>
                                                </td>
                                                <td width="12%">
                                                    <?php echo ($ro_task->last_call == "") ? " - " : $ro_task->last_call ?>
                                                </td>
                                                <td width="12%">
                                                    <?php echo $ro_task->next_call ?>
                                                </td>
                                                <td width="20%">
                                                    <?php echo $ro_task->call_response ?>
                                                </td>
                                                <td width="20%">
                                                    <?php echo $ro_task->result ?>
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
