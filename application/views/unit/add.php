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
        <li><a href="<?php echo base_url('unit'); ?>" class="text-black"><!-- Category --><strong>Unit</strong></a></li>
        <li class="active"><!-- Add Category --> Add Unit</li>
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
            <h3 class="box-title"><!-- Add New Category -->Add New Unit</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <form role="form" id="form" method="post" action="<?php echo base_url('unit/addUnit');?>">
              <div class="form-group">
                <div class="col-sm-12">
                  <div class="col-sm-6">                  
                    <label for="unit_name"><!-- Category Name -->Unit name <span class="validation-color">*</span></label>
                    <input type="text" class="form-control" id="unit_name" name="unit_name" value="<?php echo set_value('unit_name'); ?>">
                    <span class="validation-color" id="err_unit_name"><?php echo form_error('unit_name'); ?></span>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="unit_symbol"><!-- Category Description -->Unit Symbol</label>
                      <input type="text" class="form-control" id="unit_symbol" name="unit_symbol" value="<?php echo set_value('unit_symbol'); ?>">
                    </div>
                  </div>
                </div>
              </div>


              <div class="form-group">
               <div class="col-sm-12">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="unit_size"><!-- Category Description -->Unit Size</label>
                    <input type="text" class="form-control" id="unit_size" name="unit_size" value="<?php echo set_value('unit_size'); ?>">
                  </div>
                </div>
                <div class="col-sm-6">
                  <label for="unit_symbol_status"><!-- Category Description -->Status <span class="validation-color">*</span></label><br>
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
                <span class="btn btn-danger" id="cancel" style="margin-left: 2%" onclick="cancel('unit')"><!-- Cancel -->Cancel</span>
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
    var unit_name_empty = "Please Enter the unit Name.";
    var unit_name_invalid = "Please Enter Valid unit Name";
    var unit_name_length = "Please Enter unit Name Minimun 3 Character";
    
    $('#form').submit(function(){
      var name_regex = /^[a-z0-9\040\.\-\,\/]+$/i;
      var unit_name = $('#unit_name').val().trim();
      $('#unit_name').val(unit_name);
      if(unit_name==null || unit_name==""){
        $("#err_unit_name").text(unit_name_empty);
        return false;
      }
      else{
        $("#err_unit_name").text("");
      }
      if (!unit_name.match(name_regex) ) {
        $('#err_unit_name').text(unit_name_invalid);   
        return false;
      }
      else{
        $("#err_unit_name").text("");
      }
      if (unit_name.length < 3) {
        $('#err_unit_name').text(unit_name_length);  
        return false;
      }
      else{
        $("#err_unit_name").text("");
      }

      $(this).find(':button[type=submit]').prop('disabled', true);
      $('.button').css('cursor', 'default');
      $('.button').toggleClass('active');
    });

    $("#unit_name").on("blur keyup",  function (event){
      var name_regex = /^[a-z0-9\040\.\-\,\/]+$/i;
      var unit_name = $('#unit_name').val();
      if(unit_name==null || unit_name==""){
        $("#err_unit_name").text(unit_name_empty);
        return false;
      }
      else{
        $("#err_unit_name").text("");
      }
      if (!unit_name.match(name_regex)) {
        $('#err_unit_name').text(unit_name_invalid);  
        return false;
      }
      else{
        $("#err_unit_name").text("");
      }
      if (unit_name.length < 3) {
        $('#err_unit_name').text(unit_name_length);  
        return false;
      }
      else{
        $("#err_unit_name").text("");
      }
    });

  }); 
</script>