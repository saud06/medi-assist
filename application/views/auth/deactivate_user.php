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
          <li class="active">Deactive User</li>
        </ol>
      </h5>    
    </section>
<!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-12">
          <!-- Horizontal Form -->
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Deactive User</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php echo form_open("auth/deactivate/".$user->id,'class="form-horizontal row-border"');?>
              <div class="box-body" style="padding: 20px">

				  	<?php echo lang('deactivate_confirm_y_label', 'confirm');?>
				    <input type="radio" name="confirm" value="yes" checked="checked" class="minimal"/>&nbsp;&nbsp;
				    <?php echo lang('deactivate_confirm_n_label', 'confirm');?>
				    <input type="radio" name="confirm" value="no" class="minimal"/>


			  <?php echo form_hidden($csrf); ?>
			  <?php echo form_hidden(array('id'=>$user->id)); ?>
                
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <?php echo form_submit('submit', lang('deactivate_submit_btn'),'class="btn btn-info "');?>
                <span class="btn btn-default" id="cancel" style="margin-left: 2%" onclick="cancel('auth')">Cancel</span>
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

