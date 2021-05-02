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
                        <?php if ($this->session->flashdata('success')): ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo $this->session->flashdata('success'); ?>
                        </div>
                        <?php endif; ?>
                        <div class="card mb-4">
                            <div class="card-body">
                                <form action="" method="post">
                                <div class="form-group">
                                    <label for="name">Old Password *</label>
                                    <input class="form-control <?php echo form_error('old_password') ? 'is-invalid':'' ?>"
                                    type="password" name="old_password" />
                                    <div class="invalid-feedback">
                                        <?php echo form_error('old_password') ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name">New Password *</label>
                                    <input class="form-control <?php echo form_error('new_password') ? 'is-invalid':'' ?>"
                                    type="password" name="new_password" />
                                    <div class="invalid-feedback">
                                        <?php echo form_error('new_password') ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name">Confirm Password *</label>
                                    <input class="form-control <?php echo form_error('confirm_password') ? 'is-invalid':'' ?>"
                                    type="password" name="confirm_password" />
                                    <div class="invalid-feedback">
                                        <?php echo form_error('confirm_password') ?>
                                    </div>
                                </div>

                                <input class="btn btn-success" type="submit" name="btn" value="Save" />
                            </form>
                            </div>
                        </div>
                    </div>
                </main>
                <?php $this->load->view("_includes/footer.php");?>
            </div>
        </div>
        <?php $this->load->view("_includes/js.php"); ?>
    </body>
</html>
