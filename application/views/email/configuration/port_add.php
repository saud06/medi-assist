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
          <li><a href="<?php echo base_url('email/port_list'); ?>" class="text-black"><strong>Port of Loading</strong></a></li>
          <li class="active"><!-- Add port_ec -->Add Port of Loading</li>
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
              <h3 class="box-title"><!-- Add New port_ec --> Add Port</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-sm-6">
                <form role="form" id="form" method="post" action="<?php echo base_url('email/addPort');?>">
                  <div class="form-group">
                    <label for="port_ec_name">Port Name<span class="validation-color">*</span></label>
                    <input type="text" class="form-control" id="port_ec_name" name="port_ec_name" value="<?php echo set_value('port_ec_name'); ?>">
                    <span class="validation-color" id="err_port_ec_name"><?php echo form_error('port_ec_name'); ?></span>
                  </div>          
                  <div class="form-group">
                    <label for="port_ec_details"> Details  <!-- <span class="validation-color">*</span> --></label>
                    <input type="text" class="form-control" id="port_ec_details" name="port_ec_details" value="<?php echo set_value('port_ec_details'); ?>">
                  </div>

                          <div class="form-group">
                    <label for="port_ec_details"> Port Location  </label>
                    <input type="text" class="form-control" id="port_ec_location" name="port_ec_location" value="<?php echo set_value('port_ec_location'); ?>" >
                    <!-- <span class="validation-color" id="err_port_ec_location"><?php echo form_error('port_ec_location'); ?></span> -->
                  </div>
                      <div class="form-group">
                    <label for="port_ec_status">Status <span class="validation-color">*</span></label><br>
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

                    <span class="btn btn-danger" id="cancel" style="margin-left: 2%" onclick="cancel('email/port_list')"><!-- Cancel --><?php echo $this->lang->line('category_cancel'); ?></span>
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
    var port_ec_name_empty = "Please Enter the  Name.";
    var port_ec_name_invalid = "Please Enter Valid  Name";
    var port_ec_name_length = "Please Enter  Name Minimun 3 Character";
    
    $('#form').submit(function(){
      var name_regex = /^[a-zA-Z\s0-9.,:;]+$/;
      var port_ec_name = $('#port_ec_name').val().trim();
      $('#port_ec_name').val(port_ec_name);
      if(port_ec_name==null || port_ec_name==""){
        $("#err_port_ec_name").text(port_ec_name_empty);
        return false;
      }
      else{
        $("#err_port_ec_name").text("");
      }
      if (!port_ec_name.match(name_regex) ) {
        $('#err_port_ec_name').text(port_ec_name_invalid);   
        return false;
      }
      else{
        $("#err_port_ec_name").text("");
      }
      if (port_ec_name.length < 3) {
        $('#err_port_ec_name').text(port_ec_name_length);  
        return false;
      }
      else{
        $("#err_port_ec_name").text("");
      }

      $(this).find(':button[type=submit]').prop('disabled', true);
      $('.button').css('cursor', 'default');
      $('.button').toggleClass('active'); 
    });

    $("#port_ec_name").on("blur keyup",  function (event){
      var name_regex = /^[a-zA-Z\s0-9.,:;]+$/;
      var port_ec_name = $('#port_ec_name').val();
      if(port_ec_name==null || port_ec_name==""){
        $("#err_port_ec_name").text(port_ec_name_empty);
        return false;
      }
      else{
        $("#err_port_ec_name").text("");
      }
      if (!port_ec_name.match(name_regex) ) {
        $('#err_port_ec_name').text(port_ec_name_invalid);   
        return false;
      }
      else{
        $("#err_port_ec_name").text("");
      }
      if (port_ec_name.length < 3) {
        $('#err_port_ec_name').text(port_ec_name_length);  
        return false;
      }
      else{
        $("#err_port_ec_name").text("");
      }
    });
}); 
</script>