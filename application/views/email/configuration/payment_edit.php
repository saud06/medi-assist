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
          <li><a href="<?php echo base_url('email/payment_list'); ?>" class="text-black"><strong>Payment Mode</strong></a></li>
          <li class="active"><!-- Edit payment_ec_ --> Payment Mode Edit</li>
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
              <h3 class="box-title">Payment Edit</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-sm-6">
                <form role="form" id="form" method="post" action="<?php echo base_url('email/editPayment');?>">
                  <?php foreach($data as $row){?>
                    <div class="form-group">
                      <label for="payment_ec_name">Payment Name<span class="validation-color">*</span></label>
                      <input type="text" class="form-control" id="payment_ec_name" name="payment_ec_name" value="<?php echo $row->payment_ec_name; ?>">
                      <input type="hidden" name="id" value="<?php echo $row->payment_ec_id;?>">
                      <span class="validation-color" id="err_payment_ec_name"><?php echo form_error('payment_ec_name'); ?></span>
                    </div>
                       <div class="form-group">
                      <label for="payment_ec_details">Deatils</label>
                      <input type="text" class="form-control" id="payment_ec_details" name="payment_ec_details" value="<?php echo $row->payment_ec_details; ?>" >
                    </div>

                    <div class="form-group">
                      <label for="category_name"><!-- Category Description --> Status </label><br>
                      <?php echo lang('category_status_y_label', 'confirm');?>
                      <input type="radio" name="confirm" value="active" <?php if($row->payment_ec_status == 'active') {?> checked="checked" <?php }?> class="minimal"/>&nbsp;&nbsp;
                      <?php echo lang('category_status_n_label', 'confirm');?>
                      <input type="radio" name="confirm" value="inactive" <?php if($row->payment_ec_status != 'active') {?> checked="checked" <?php }?> class="minimal"/>
                    </div>
          
                  </div>
                  <div class="col-sm-12">
                  <div class="box-footer">
                    <button type="submit" id="submit" class="button btn bg-gray">
                      <span class="submit" style="left: 16%">Update</span>
                      <span class="loading" style="left: 32%"><i class="fa fa-circle-o-notch"></i></span>
                    </button>
                    <span class="btn btn-danger" id="cancel" style="margin-left: 2%" onclick="cancel('email/payment_list')"><!-- Cancel --><!--  <?php echo $this->lang->line('payment_ec_label_cancel'); ?> -->Cancel</span>
                  </div>
                </div>
                   <?php } ?>
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
    var payment_ec_name_empty = "Please Enter the  Name.";
    var payment_ec_name_invalid = "Please Enter Valid  Name";
    var payment_ec_name_length = "Please Enter  Name Minimun 3 Character";
    
    $('#form').submit(function(){
      var name_regex = /^[a-zA-Z\s0-9.,:;]+$/;
      var payment_ec_name = $('#payment_ec_name').val().trim();
      $('#payment_ec_name').val(payment_ec_name);
      if(payment_ec_name==null || payment_ec_name==""){
        $("#err_payment_ec_name").text(payment_ec_name_empty);
        return false;
      }
      else{
        $("#err_payment_ec_name").text("");
      }
      if (!payment_ec_name.match(name_regex) ) {
        $('#err_payment_ec_name').text(payment_ec_name_invalid);   
        return false;
      }
      else{
        $("#err_payment_ec_name").text("");
      }
      if (payment_ec_name.length < 3) {
        $('#err_payment_ec_name').text(payment_ec_name_length);  
        return false;
      }
      else{
        $("#err_payment_ec_name").text("");
      }

      $(this).find(':button[type=submit]').prop('disabled', true);
      $('.button').css('cursor', 'default');
      $('.button').toggleClass('active'); 
    });

    $("#payment_ec_name").on("blur keyup",  function (event){
      var name_regex = /^[a-zA-Z\s0-9.,:;]+$/;
      var payment_ec_name = $('#payment_ec_name').val();
      if(payment_ec_name==null || payment_ec_name==""){
        $("#err_payment_ec_name").text(payment_ec_name_empty);
        return false;
      }
      else{
        $("#err_payment_ec_name").text("");
      }
      if (!payment_ec_name.match(name_regex) ) {
        $('#err_payment_ec_name').text(payment_ec_name_invalid);   
        return false;
      }
      else{
        $("#err_payment_ec_name").text("");
      }
      if (payment_ec_name.length < 3) {
        $('#err_payment_ec_name').text(payment_ec_name_length);  
        return false;
      }
      else{
        $("#err_payment_ec_name").text("");
      }
    });
}); 
</script>