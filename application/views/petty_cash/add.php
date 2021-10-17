<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','manager');
if(!(in_array($this->session->userdata('type'),$p))){
  redirect('auth');
}
$this->load->view('layout/header');
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <?php 
    // $this->load->view('layout/sticky_note');
  ?>
  
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h5>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('auth/dashboard'); ?>" class="text-black"><i class="fa fa-dashboard">&nbsp;</i><strong><?php echo $this->lang->line('header_dashboard'); ?></strong></a></li>
        <li><a href="<?php echo base_url('petty_cash'); ?>" class="text-black"><strong>Petty Cash</strong></a></li>
        <li class="active">Add Petty Cash</li>
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
            <h3 class="box-title">Add New Petty Cash</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <form role="form" id="form" method="post" action="<?php echo base_url('petty_cash/addPettyCash');?>" encType="multipart/form-data">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="date">Date <span class="validation-color">*</span></label>
                    <input type="text" class="form-control datepicker" id="date" name="date" value="<?php echo date('Y-m-d'); ?>">
                    <span class="validation-color" id="err_date"><?php echo form_error('date'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="amount">Amount <span class="validation-color">*</span></label>
                    <input type="number" class="form-control" id="amount" name="amount" value="<?php echo set_value('amount'); ?>">
                    <span class="validation-color" id="err_amount"><?php echo form_error('amount'); ?></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="remarks">Remarks </label>
                    <textarea rows="1" class="form-control" id="remarks" name="remarks"></textarea>
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6">
                        <label for="category_name">Status <span class="validation-color">*</span></label><br>
                        <?php echo lang('category_status_y_label', 'confirm');?>
                        <input type="radio" name="confirm" value="active" checked="checked" class="minimal"/>&nbsp;&nbsp;
                        <?php echo lang('category_status_n_label', 'confirm');?>
                        <input type="radio" name="confirm" value="inactive" class="minimal"/>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="box-footer">
                    <button type="submit" id="submit" class="button btn bg-gray">
                      <span class="submit" style="left: 32%">Add</span>
                      <span class="loading" style="left: 32%"><i class="fa fa-circle-o-notch"></i></span>
                    </button>

                    <span class="btn btn-danger" id="cancel" style="margin-left: 2%" onclick="cancel('petty_cash')"><!-- Cancel --><?php echo $this->lang->line('category_cancel'); ?></span>
                  </div>
                </div>
              </form>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
      </div>
      <!--/.col (right) -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
  $this->load->view('layout/product_footer');
?>

<script>
  $(document).ready(function(){
    $('#form').submit(function(){
      var date_regex = /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
      var date = $('#date').val();
      var amount = $('#amount').val();
      var remarks = $('#remarks').val();

      if(date==null || date==""){
        $("#err_date").text("Please Enter Date.");
        return false;
      }
      else{
        $("#err_date").text("");
      }
      if (!date.match(date_regex) ) {
        $('#err_date').text(" Please Enter Valid Date.");   
        return false;
      }
      else{
        $("#err_date").text("");
      }
      //date validation complite.

      if(amount==null || amount==""){
        $("#err_amount").text("Please Enter Amount.");
        return false;
      }
      else{
        $("#err_amount").text("");
      }
      //amount validation complite.

      $(this).find(':button[type=submit]').prop('disabled', true);
      $('.button').css('cursor', 'default');
      $('.button').toggleClass('active');
    });
   
    $("#date").on("blur keyup",  function (event){
      var date_regex = /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
      var date = $('#date').val();
      if(date==null || date==""){
        $("#err_date").text("Please Enter Date.");
        return false;
      }
      else{
        $("#err_date").text("");
      }
      if (!date.match(date_regex) ) {
        $('#err_date').text("Please Enter Valid Date.");   
        return false;
      }
      else{
        $("#err_date").text("");
      }
    });
    $("#amount").change(function(event){
      var amount = $('#amount').val();
      if(amount==""){
        $("#err_amount").text("Please Enter Amount.");
        return false;
      }
      else{
        $("#err_amount").text("");
      }
    });
  }); 
</script>