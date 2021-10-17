<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin');
if(!(in_array($this->session->userdata('type'),$p))){
  redirect('auth');
}
  $this->load->view('layout/header');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li><a href="<?php echo base_url('auth'); ?>">User</a></li>
          <li class="active">Edit User Group</li>
        </ol>
      </h5>    
    </section>
<!-- Main content -->
    <section class="content">
      <div class="row">
      <!-- right column -->
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Edit User Group</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                <form role="form" id="form" method="post" action="<?php echo current_url();?>">

                  <div class="form-group">
                    <label>Group Name </label>
                    <?php echo form_input($group_name,'','class="form-control" id="firstname" placeholder="Group Name"');?>
                    <span class="validation-color" id="err_firstname"><?php echo form_error('firstname'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="lastname">Description  </label>
                    <?php echo form_input($group_description,'','class="form-control" id="lastname" placeholder="Description"');?>
                    <span class="validation-color" id="err_lastname"><?php echo form_error('lastname'); ?></span>
                  </div>
                      
                </div>
                <div class="col-sm-12">
                  <div class="box-footer">
                    <button type="submit" id="submit" class="btn btn-info">Update</button>
                    <span class="btn btn-default" id="cancel" style="margin-left: 2%" onclick="cancel('auth')">Cancel</span>
                  </div>
                </div>
                </form>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
    $this->load->view('layout/footer');
  ?>
