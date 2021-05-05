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
                                <a href="<?php echo site_url('administrasi/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
                            </div>
                            <div class="card-body">
                                <form action="" method="post">
                                <input type="hidden" name="id" id="id" value="<?php echo $admin_task->admin_task_id ?>">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="start_date">Target Mulai *</label>
                                            <input class="form-control <?php echo form_error('start_date') ? 'is-invalid':'' ?>"
                                            type="text" id="start_date" name="start_date" placeholder="dd-mm-yyyy" value="<?php echo $admin_task->start_date ?>" />
                                            <div class="invalid-feedback">
                                                <?php echo form_error('name') ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="end_date">Target Selesai *</label>
                                            <input class="form-control <?php echo form_error('end_date') ? 'is-invalid':'' ?>"
                                            type="text" id="end_date" name="end_date" placeholder="dd-mm-yyyy" value="<?php echo $admin_task->end_date ?>" />
                                            <div class="invalid-feedback">
                                                <?php echo form_error('name') ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="user_id">Nama Petugas Pemasar *</label>
                                    <select class="form-control" id="user_id" name="user_id">
                                        <option value>Pilih Telemarketing...</option>
                                        <?php foreach ($users as $user): ?>
                                            <?php if($user->user_id == $admin_task->user_id){ ?>
                                                <option value="<?php echo $user->user_id ?>" SELECTED><?php echo $user->fullname ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $user->user_id ?>"><?php echo $user->fullname ?></option>
                                            <?php } ?>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?php echo form_error('user_id') ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="company_id">Nama Badan Usaha *</label>
                                    <select class="form-control" id="company_id" name="company_id">
                                        <option value>Pilih Badan Usaha...</option>
                                        <?php foreach ($companies as $company): ?>
                                            <?php if($company->company_id == $admin_task->company_id){ ?>
                                                <option value="<?php echo $company->company_id ?>" data-address="<?php echo $company->address ?>" SELECTED><?php echo $company->name ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $company->company_id ?>" data-address="<?php echo $company->address ?>"><?php echo $company->name ?></option>
                                            <?php } ?>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?php echo form_error('company_id') ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="price">Alamat *</label>
                                    <textarea class="form-control <?php echo form_error('address') ? 'is-invalid':'' ?>"
                                    name="address" id="address" placeholder="Alamat Badan Usaha" readonly><?php echo $admin_task->address ?></textarea>
                                    <div class="invalid-feedback">
                                        <?php echo form_error('address') ?>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="data_source">Sumber Data *</label>
                                    <input class="form-control <?php echo form_error('data_source') ? 'is-invalid':'' ?>"
                                    type="text" name="data_source" placeholder="Sumber Data" value="<?php echo $admin_task->data_source ?>" />
                                    <div class="invalid-feedback">
                                        <?php echo form_error('data_source') ?>
                                    </div>
                                </div>

                                <input class="btn btn-success" type="submit" name="btn" value="Update" />
                            </form>
                            </div>
                        </div>
                    </div>
                </main>
                <?php $this->load->view("_includes/footer.php");?>
            </div>
        </div>
        <?php $this->load->view("_includes/js.php"); ?>
        <script>
          $( function() {
            $( "#start_date" ).datepicker({
                minDate: '0',
                beforeShow : function ()
                {
                    jQuery( this ).datepicker('option', 'maxDate', jQuery('#end_date').val());
                },
                altFormat: 'dd-mm-yy',
                dateFormat: 'dd-mm-yy',
                changeMonth: true
            });

            $( "#end_date" ).datepicker({
                beforeShow : function ()
                {
                    jQuery( this ).datepicker('option', 'minDate', jQuery('#start_date').val());
                },
                altFormat: 'dd-mm-yy',
                dateFormat: 'dd-mm-yy',
                changeMonth: true
            });
            
            $( "#user_id" ).combobox();
            $( "#company_id" ).combobox({
                select: function (event, ui) { 
                    var selected = $(this).find('option:selected');
                    $("#address").val(selected.data('address'));
                } 
            });
             

        } );
        </script>
    </body>
</html>
