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
                                <a href="<?php echo site_url('admin_task/add') ?>"><i class="fas fa-plus"></i> Add New</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Deadline</th>
                                                <th>Nama RO</th>
                                                <th>Sumber</th>
                                                <th>Nama BU</th>
                                                <th>Status</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($admin_tasks as $admin_task): ?>
                                            <tr>
                                                <td width="20%">
                                                    <?php echo $admin_task->name ?>
                                                </td>
                                                <td width="20%">
                                                    <?php echo $admin_task->address ?>
                                                </td>
                                                <td width="20%">
                                                    <?php echo $admin_task->pic_name ?>
                                                </td>
                                                <td width="10%">
                                                    <?php echo $admin_task->contact ?>
                                                </td>
                                                <td width="10%">
                                                    <?php echo $admin_task->email ?>
                                                </td>
                                                <td width="10%" style="text-align: center;">
                                                    <a href="<?php echo site_url('admin_task/edit/'.$admin_task->admin_task_id) ?>"
                                                    class="btn btn-small" style="padding-right: 5px;padding-left: 5px;"><i class="fas fa-edit"></i></a>
                                                    <a onclick="deleteConfirm('<?php echo site_url('admin_task/delete/'.$admin_task->admin_task_id) ?>')"
                                                    href="#!" class="btn btn-small text-danger" style="padding-right: 5px;padding-left: 5px;"><i class="fas fa-trash"></i></a>
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
