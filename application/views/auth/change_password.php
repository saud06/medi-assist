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
          <li><a href="<?php echo base_url('auth'); ?>">List User</a></li>
          <li class="active">Change Password</li>
        </ol>
      </h5>    
    </section>
<!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Edit User Group</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div id="infoMessage"><?php echo $message;?></div>
            <?php echo form_open("auth/change_password",'class="form-horizontal row-border"');?>

              <div class="box-body" style="padding: 20px">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Old Password</label>
                  <div class="col-sm-9">
                    <!-- <input type="text" class="form-control" id="firstname" placeholder="First Name"> -->
                    <?php echo form_input($old_password,'','class="form-control" id="firstname" placeholder="Old Password"');?>
                  </div>
                </div>

                <div class="form-group">
                  <!-- <label for="inputEmail3" class="col-sm-3 control-label">New Password(8 Character)</label> -->
                  <label for="new_password" class="col-sm-3 control-label"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label>

                  <div class="col-sm-9">
                    <!-- <input type="text" class="form-control" id="firstname" placeholder="First Name"> -->
                    <?php echo form_input($new_password,'','class="form-control" id="lastname" placeholder="New Password"');?>
                  </div>
                </div>  


                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Confirm Password</label>
                  <div class="col-sm-9">
                    <!-- <input type="text" class="form-control" id="firstname" placeholder="First Name"> -->
                    <?php echo form_input($new_password_confirm,'','class="form-control" id="firstname" placeholder="Confirm Password"');?>
                  </div>
                </div>
                <?php echo form_input($user_id);?>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <?php echo form_submit('submit', lang('change_password_submit_btn'),'class="btn btn-info pull-right"');?>
              </div>
              <!-- /.box-footer -->
            <?php echo form_close();?>
          </div>
        </div>
      </div>
      <!-- /.row -->
      
    </section>
    <!-- /.content -->

  </div>

<?php 
  $this->load->view('layout/footer');
?>





<!-- <h1><?php echo lang('change_password_heading');?></h1>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/change_password");?>

      <p>
            <?php echo lang('change_password_old_password_label', 'old_password');?> <br />
            <?php echo form_input($old_password);?>
      </p>

      <p>
            <label for="new_password"><?php echo sprintf(lang('change_password_new_password_label'), $min_password_length);?></label> <br />
            <?php echo form_input($new_password);?>
      </p>

      <p>
            <?php echo lang('change_password_new_password_confirm_label', 'new_password_confirm');?> <br />
            <?php echo form_input($new_password_confirm);?>
      </p>

      <?php echo form_input($user_id);?>
      <p><?php echo form_submit('submit', lang('change_password_submit_btn'));?></p>

<?php echo form_close();?> -->
