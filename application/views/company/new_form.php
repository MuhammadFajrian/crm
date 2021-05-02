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
                            <div class="card-header">
                                <a href="<?php echo site_url('company/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
                            </div>
                            <div class="card-body">
                                <form action="<?php echo site_url('company/add') ?>" method="post">
                                <div class="form-group">
                                    <label for="name">Name *</label>
                                    <input class="form-control <?php echo form_error('name') ? 'is-invalid':'' ?>"
                                    type="text" name="name" placeholder="Company name" />
                                    <div class="invalid-feedback">
                                        <?php echo form_error('name') ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="price">Address *</label>
                                    <textarea class="form-control <?php echo form_error('address') ? 'is-invalid':'' ?>"
                                    name="address" placeholder="Company Address"></textarea>
                                    <div class="invalid-feedback">
                                        <?php echo form_error('address') ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="name">PIC Name *</label>
                                    <input class="form-control <?php echo form_error('pic_name') ? 'is-invalid':'' ?>"
                                    type="text" name="pic_name" placeholder="PIC name" />
                                    <div class="invalid-feedback">
                                        <?php echo form_error('pic_name') ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="name">Contact Number *</label>
                                    <input class="form-control <?php echo form_error('contact') ? 'is-invalid':'' ?>"
                                    type="text" name="contact" placeholder="Phone number" />
                                    <div class="invalid-feedback">
                                        <?php echo form_error('contact') ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="name">Email</label>
                                    <input class="form-control <?php echo form_error('email') ? 'is-invalid':'' ?>"
                                    type="text" name="email" placeholder="Email" />
                                    <div class="invalid-feedback">
                                        <?php echo form_error('email') ?>
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
