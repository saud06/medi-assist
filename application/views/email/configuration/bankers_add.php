<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','manager');
if(!(in_array($this->session->userdata('type'),$p))){
  redirect('auth');
}
$this->load->view('layout/header');
?>
<div class="content-wrapper">
  <?php 
    // $this->load->view('layout/sticky_note');
  ?>
  
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('auth/dashboard'); ?>" class="text-black"><i class="fa fa-dashboard">&nbsp;</i><strong><?php echo $this->lang->line('header_dashboard'); ?></strong></a></li>
          <li><a href="<?php echo base_url('email/bankers_list'); ?>" class="text-black"><strong>Banker</strong></a></li>
          <li class="active"><!-- Add port_ec -->Add Banker</li>
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
              <h3 class="box-title"><!-- Add New port_ec --> Add Banker</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-sm-6">
                <form role="form" id="form" method="post" action="<?php echo base_url('email/addBankers');?>">
                  <div class="form-group">
                    <label for="bankers_ec_name">Banker Name<span class="validation-color">*</span></label>
                    <input type="text" class="form-control" id="bankers_ec_name" name="bankers_ec_name" value="<?php echo set_value('bankers_ec_name'); ?>">
                    <span class="validation-color" id="err_bankers_ec_name"><?php echo form_error('bankers_ec_name'); ?></span>
                  </div>          
                  <div class="form-group">
                    <label for="bankers_ec_details"> Details  <!-- <span class="validation-color">*</span> --></label>
                    <input type="text" class="form-control" id="bankers_ec_details" name="bankers_ec_details" value="<?php echo set_value('bankers_ec_details'); ?>">
                  </div>

                  <div class="form-group">
                    <label for="bankers_ec_details"> Address  <!-- <span class="validation-color">*</span> --></label>
                    <input type="text" class="form-control" id="bankers_ec_address" name="bankers_ec_address" value="<?php echo set_value('bankers_ec_address'); ?>">
                  </div>

                      <div class="form-group">
                    <label for="bankers_ec_status">Status <span class="validation-color">*</span></label><br>
                    <?php echo lang('category_status_y_label', 'confirm');?>
                    <input type="radio" name="confirm" value="active" checked="checked" class="minimal"/>&nbsp;&nbsp;
                    <?php echo lang('category_status_n_label', 'confirm');?>
                    <input type="radio" name="confirm" value="inactive" class="minimal"/>
                  </div>
       
                </div>
                <div class="col-sm-12">
                  <div class="box-footer">
                    <button type="submit" id="submit" class="button btn bg-gray">
                      <span class="submit" style="left: 32%">Add</span>
                      <span class="loading" style="left: 32%"><i class="fa fa-circle-o-notch"></i></span>
                    </button>

                    <span class="btn btn-danger" id="cancel" style="margin-left: 2%" onclick="cancel('email/bankers_list')"><!-- Cancel --><?php echo $this->lang->line('category_cancel'); ?></span>
                  </div>
                </div>
                </form>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
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
<script>
  $(document).ready(function(){
    var bankers_ec_name_empty = "Please Enter the  Name.";
    var bankers_ec_name_invalid = "Please Enter Valid  Name";
    var bankers_ec_name_length = "Please Enter  Name Minimun 3 Character";

    $("#submit").click(function(event){
      var name_regex = /^[a-zA-Z\s0-9.,:;]+$/;
      var bankers_ec_name = $('#bankers_ec_name').val().trim();
      $('#bankers_ec_name').val(bankers_ec_name);
      if(bankers_ec_name==null || bankers_ec_name==""){
        $("#err_bankers_ec_name").text(bankers_ec_name_empty);
        return false;
      }
      else{
        $("#err_bankers_ec_name").text("");
      }
      if (!bankers_ec_name.match(name_regex) ) {
        $('#err_bankers_ec_name').text(bankers_ec_name_invalid);   
        return false;
      }
      else{
        $("#err_bankers_ec_name").text("");
      }
      if (bankers_ec_name.length < 3) {
        $('#err_bankers_ec_name').text(bankers_ec_name_length);  
        return false;
      }
      else{
        $("#err_bankers_ec_name").text("");
      } 

      $(this).find(':button[type=submit]').prop('disabled', true);
      $('.button').css('cursor', 'default');
      $('.button').toggleClass('active');
    });

    $("#bankers_ec_name").on("blur keyup",  function (event){
      var name_regex = /^[a-zA-Z\s0-9.,:;]+$/;
      var bankers_ec_name = $('#bankers_ec_name').val();
      if(bankers_ec_name==null || bankers_ec_name==""){
        $("#err_bankers_ec_name").text(bankers_ec_name_empty);
        return false;
      }
      else{
        $("#err_bankers_ec_name").text("");
      }
      if (!bankers_ec_name.match(name_regex) ) {
        $('#err_bankers_ec_name').text(bankers_ec_name_invalid);   
        return false;
      }
      else{
        $("#err_bankers_ec_name").text("");
      }
      if (bankers_ec_name.length < 3) {
        $('#err_bankers_ec_name').text(bankers_ec_name_length);  
        return false;
      }
      else{
        $("#err_bankers_ec_name").text("");
      }
    });
}); 
</script>