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
                                    <label for="name">NPP *</label>
                                    <input class="form-control <?php echo form_error('npp') ? 'is-invalid':'' ?>"
                                    type="text" name="npp" value="" />
                                    <div class="invalid-feedback">
                                        <?php echo form_error('name') ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name">Email *</label>
                                    <input class="form-control <?php echo form_error('email') ? 'is-invalid':'' ?>"
                                    type="text" name="email" value="" />
                                    <div class="invalid-feedback">
                                        <?php echo form_error('name') ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name">Username *</label>
                                    <input class="form-control <?php echo form_error('username') ? 'is-invalid':'' ?>"
                                    type="text" name="username" value=""/>
                                    <div class="invalid-feedback">
                                        <?php echo form_error('username') ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name">Full Name *</label>
                                    <input class="form-control <?php echo form_error('fullname') ? 'is-invalid':'' ?>"
                                    type="text" name="fullname" value="" />
                                    <div class="invalid-feedback">
                                        <?php echo form_error('fullname') ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="price">Address *</label>
                                    <textarea class="form-control <?php echo form_error('address') ? 'is-invalid':'' ?>"
                                    name="address" ></textarea>
                                    <div class="invalid-feedback">
                                        <?php echo form_error('address') ?>
                                    </div>
                                </div>

                                <input class="form-control" type="hidden" name="role" value="<?php echo $role ?>" />
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
