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
          <li><a href="<?php echo base_url('notice'); ?>" class="text-black"><!-- Notice --><strong>Notice</strong></a></li>
          <li class="active"><!-- Add Notice --> Add Notice</li>
        </ol>
      </h5>    
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
      <!-- right column -->
      <div class="col-sm-12">
        <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><!-- Add New Notice -->Add New Notice</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" id="form" method="post" action="<?php echo base_url('notice/addNotice');?>">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="title"><!-- Notice Name -->Title <span class="validation-color">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo set_value('title'); ?>">
                    <span class="validation-color" id="err_title"><?php echo form_error('title'); ?></span>
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6">
                        <label for="date"><?php echo $this->lang->line('purchase_date'); ?><span class="validation-color">*</span></label>
                        <input type="text" class="form-control datepicker" id="date" name="date" value="<?php echo date("Y-m-d"); ?>">
                        <span class="validation-color pull-right" id="err_date"><?php echo form_error('date'); ?></span>
                      </div>

                      <div class="col-sm-6">
                        <div class="pull-right">
                          <label for="status"><!-- Notice Description -->Status <span class="validation-color">*</span></label><br>
                          <?php echo lang('category_status_y_label', 'confirm');?>
                          <input type="radio" name="confirm" value="Active" checked="checked" class="minimal"/>&nbsp;&nbsp;
                          <?php echo lang('category_status_n_label', 'confirm');?>
                          <input type="radio" name="confirm" value="Inactive" class="minimal"/>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="description"><!-- Notice Description -->Description</label>
                    <textarea rows="4" class="form-control" id="notice_desc" name="notice_desc"></textarea>
                  </div>
                </div>

                <div class="col-sm-12">
                  <div class="box-footer">
                    <button type="submit" id="submit" class="button btn bg-gray">
                      <span class="submit" style="left: 32%">Add</span>
                      <span class="loading" style="left: 32%"><i class="fa fa-circle-o-notch"></i></span>
                    </button>

                    <span class="btn btn-danger" id="cancel" style="margin-left: 2%" onclick="cancel('notice')"><!-- Cancel --><?php echo $this->lang->line('category_cancel'); ?></span>
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
    $('#form').submit(function(){
      var title_regex = /^[a-z0-9\040\.\-\,\/]+$/i;
      var date_regex = /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
      var title = $('#title').val();
      var date = $('#date').val();

      if(title==null || title==""){
        $("#err_title").text("Please Enter Title.");
        $('#title').focus();
        return false;
      }
      else{
        $("#err_title").text("");
      }
      if (!title.match(title_regex) ) {
        $('#err_title').text(" Please Enter Valid Title.");   
        $('#title').focus();
        return false;
      }
      else{
        $("#err_title").text("");
      }
      //title validation complite.

      if(date==null || date==""){
        $("#err_date").text("Please Enter Date.");
        $('#date').focus();
        return false;
      }
      else{
        $("#err_date").text("");
      }
      if (!date.match(date_regex) ) {
        $('#err_date').text(" Please Enter Valid Date.");   
        $('#date').focus();
        return false;
      }
      else{
        $("#err_date").text("");
      }
      //date codevalidation complite.

      $(this).find(':button[type=submit]').prop('disabled', true);
      $('.button').css('cursor', 'default');
      $('.button').toggleClass('active');
    });

    $("#title").on("blur keyup",  function (event){
      var title_regex = /^[a-z0-9\040\.\-\,\/]+$/i;
      var title = $('#title').val();
      if(title==null || title==""){
        $("#err_title").text("Please Enter Title.");
        return false;
      }
      else{
        $("#err_title").text("");
      }
      if (!title.match(title_regex)) {
        $('#err_title').text("Please Enter Valid Title.");  
        return false;
      }
      else{
        $("#err_title").text("");
      }
      if (title.length < 3) {
        $('#err_title').text("Please Enter Valid Title.");  
        return false;
      }
      else{
        $("#err_title").text("");
      }
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
      if (!date.match(date_regex)) {
        $('#err_date').text("Please Enter Valid Date.");  
        return false;
      }
      else{
        $("#err_date").text("");
      }
    });
  }); 
</script>