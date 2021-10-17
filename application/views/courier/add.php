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
        <li><a href="<?php echo base_url('courier'); ?>" class="text-black"><!-- Category --><strong>Courier</strong></a></li>
        <li class="active"><!-- Add Category --> Add Courier</li>
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
            <h3 class="box-title"><!-- Add New Category -->Add New Courier</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form role="form" id="form" method="post" action="<?php echo base_url('courier/addcourier');?>">
              <div class="form-group">
                <div class="col-sm-12">
                  <div class="col-sm-6">                  
                    <label for="courier_name"><!-- Category Name -->Courier name <span class="validation-color">*</span></label>
                    <input type="text" class="form-control" id="courier_name" name="courier_name" value="<?php echo set_value('courier_name'); ?>">
                    <span class="validation-color" id="err_courier_name"><?php echo form_error('courier_name'); ?></span>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="courier_details"><!-- Category Description -->Courier Details</label>
                      <input type="text" class="form-control" id="courier_details" name="courier_details" value="<?php echo set_value('courier_details'); ?>">
                    </div>
                  </div>
                </div>
              </div>


              <div class="form-group">
               <div class="col-sm-12">      
                <div class="col-sm-6">
                  <label for="courier_status"><!-- Category Description -->Status <span class="validation-color">*</span></label><br>
                  Active
                  <input type="radio" name="confirm" value="active" checked="checked" class="minimal"/>&nbsp;&nbsp;
                  Inactive
                  <input type="radio" name="confirm" value="inactive" class="minimal"/>
                </div>
              </div>
            </div>

            <div class="col-sm-12">
              <div class="box-footer">
                <button type="submit" id="submit" class="button btn bg-gray">
                  <span class="submit" style="left: 32%">Add</span>
                  <span class="loading" style="left: 32%"><i class="fa fa-circle-o-notch"></i></span>
                </button>

                <span class="btn btn-danger" id="cancel" style="margin-left: 2%" onclick="cancel('courier')"><!-- Cancel --><?php echo $this->lang->line('category_cancel'); ?></span>
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
    var courier_name_empty = "Please Enter the courier Name.";
    var courier_name_invalid = "Please Enter Valid courier Name";
    var courier_name_length = "Please Enter courier Name Minimun 3 Character";

    $('#form').submit(function(){
      var name_regex = /^[a-z0-9\040\.\-\,\/]+$/i;
      var courier_name = $('#courier_name').val().trim();
      $('#courier_name').val(courier_name);
      if(courier_name==null || courier_name==""){
        $("#err_courier_name").text(courier_name_empty);
        return false;
      }
      else{
        $("#err_courier_name").text("");
      }
      if (!courier_name.match(name_regex) ) {
        $('#err_courier_name').text(courier_name_invalid);   
        return false;
      }
      else{
        $("#err_courier_name").text("");
      }
      if (courier_name.length < 3) {
        $('#err_courier_name').text(courier_name_length);  
        return false;
      }
      else{
        $("#err_courier_name").text("");
      }

      $(this).find(':button[type=submit]').prop('disabled', true);
      $('.button').css('cursor', 'default');
      $('.button').toggleClass('active');
    });

    $("#courier_name").on("blur keyup",  function (event){
      var name_regex = /^[a-z0-9\040\.\-\,\/]+$/i;
      var courier_name = $('#courier_name').val();
      if(courier_name==null || courier_name==""){
        $("#err_courier_name").text(courier_name_empty);
        return false;
      }
      else{
        $("#err_courier_name").text("");
      }
      if (!courier_name.match(name_regex)) {
        $('#err_courier_name').text(courier_name_invalid);  
        return false;
      }
      else{
        $("#err_courier_name").text("");
      }
      if (courier_name.length < 3) {
        $('#err_courier_name').text(courier_name_length);  
        return false;
      }
      else{
        $("#err_courier_name").text("");
      }
    });

  }); 
</script>