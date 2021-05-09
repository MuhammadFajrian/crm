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
                        <div class="row">
                            <div class="card col-md-4">
                                <div class="card-header">
                                    <h6>Detail Badan Usaha</h6>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="company_id">Nama Badan Usaha *</label>
                                        <input class="form-control" type="text" name="company_name" id="company_name" value="<?php echo $company->name ?>" readonly>
                                        <div class="invalid-feedback">
                                            <?php echo form_error('company_id') ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="price">Alamat *</label>
                                        <textarea class="form-control <?php echo form_error('address') ? 'is-invalid':'' ?>"
                                        name="address" id="address" placeholder="Alamat Badan Usaha" readonly><?php echo $company->address ?></textarea>
                                        <div class="invalid-feedback">
                                            <?php echo form_error('address') ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="company_id">PIC Name *</label>
                                        <input class="form-control" type="text" name="pic_name" id="pic_name" value="<?php echo $company->pic_name ?>" readonly>
                                        <div class="invalid-feedback">
                                            <?php echo form_error('company_id') ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="company_id">Contact *</label>
                                        <input class="form-control" type="text" name="contact" id="contact" value="<?php echo $company->contact ?>" readonly>
                                        <div class="invalid-feedback">
                                            <?php echo form_error('company_id') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card col-md-7" style="border-left-width: 1px;margin-left: 12px;">
                                <div class="card-header">
                                    <a href="<?php echo site_url('telemarketing/') ?>"><i class="fas fa-arrow-left"></i> Back</a>
                                </div>
                                <div class="card-body">
                                    <form action="" method="post">
                                    <input type="hidden" name="admin_task_id" value="<?php echo $admin_task->admin_task_id ?>">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="call_date">Tanggal Telepon *</label>
                                                <input class="form-control" type="text" id="call_date" name="call_date" placeholder="dd-mm-yyyy" />
                                                <div class="invalid-feedback">
                                                    <?php echo form_error('call_date') ?>
                                                </div>
                                            </div>
                                            <div class="col-md-9">
                                                <label for="user_id">Nama Petugas Pemasar *</label>
                                                <select class="form-control" id="user_id" name="user_id">
                                                    <option value>Pilih Telemarketing...</option>
                                                    <?php foreach ($users as $user): ?>
                                                        <?php if($admin_task->user_id == $user->user_id) { ?>
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
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="employee">Jumlah Potensi Pekerja *</label>
                                                <input class="form-control" type="text" name="employee" id="employee" placeholder="Tenaga Kerja" autocomplete="off" />
                                                <div class="invalid-feedback">
                                                    <?php echo form_error('employee') ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="employee_family">Jumlah Potensi Keluarga *</label>
                                                <input class="form-control" type="text" name="employee_family" id="employee_family" placeholder="Keluarga" autocomplete="off" />
                                                <div class="invalid-feedback">
                                                    <?php echo form_error('employee_family') ?>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="total_potential">Total Potensi *</label>
                                                <input class="form-control" type="text" name="total_potential" id="total_potential" placeholder="Total" readonly />
                                                <div class="invalid-feedback">
                                                    <?php echo form_error('total_potential') ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="call_response">Respon Telepon *</label>
                                        <select class="form-control" id="call_response" name="call_response">
                                            <option value>-- Pilih Respon Telepon -- </option>
                                            <?php foreach ($response_parameters as $response): ?>
                                                <option value="<?php echo $response->value ?>"><?php echo $response->description ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?php echo form_error('call_response') ?>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="result">Hasil Telepon *</label>
                                        <select class="form-control" id="result" name="result">
                                            <option value>-- Pilih Hasil Telepon --</option>
                                            <?php foreach ($result_parameters as $result): ?>
                                                <option value="<?php echo $result->value ?>"><?php echo $result->description ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            <?php echo form_error('result') ?>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="notes">Catatan </label>
                                        <textarea class="form-control <?php echo form_error('notes') ? 'is-invalid':'' ?>"
                                        name="notes" id="notes" placeholder="Catatan Tambahan Hasil Telemarketing..."></textarea>
                                        <div class="invalid-feedback">
                                            <?php echo form_error('notes') ?>
                                        </div>
                                    </div>
                                    <input class="btn btn-success" type="submit" name="btn" value="Save" />
                                </form>
                                </div>
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
            $("#call_date").mask("99-99-9999");
            $( "#call_date" ).datepicker({
                minDate: '0',
                maxDate: '0',
                altFormat: 'dd-mm-yy',
                dateFormat: 'dd-mm-yy',
                changeMonth: true
            });

            $("#employee, #employee_family").number(true, 0);
            
            $("#employee, #employee_family").on("keyup", function(){
                var employee = parseInt($("#employee").val());
                var employee_family = parseInt($("#employee_family").val());
                // isNaN($("#employee").val()) ? 0 : $("#employee").val(); 
                var total = (isNaN(employee) ? 0 : employee) + (isNaN(employee_family) ? 0 : employee_family);
               
                $("#total_potential").val(total);
            });
        } );
        </script>
    </body>
</html>
