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
          <li><a href="<?php echo base_url('subcategory'); ?>" class="text-black"><!-- Subcategory --><strong>Subcategory</strong></a></li>
          <li class="active"><!-- Add Subcategory --><?php echo $this->lang->line('subcategory_label_add'); ?></li>
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
              <h3 class="box-title"><!-- Add New Subcategory --><?php echo $this->lang->line('subcategory_newcategory'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                <form role="form" id="form" method="post" action="<?php echo base_url('subcategory/addSubcategory');?>">
                  <div class="form-group">
                    <label for="category">Category <span class="validation-color">*</span></label>
                    <select class="form-control select2" id="category" name="category" style="width: 100%;">
                      <option value="">Select Category</option>
                      <?php
                        foreach ($data as $row) {
                          echo "<option value='$row->category_id'".set_select('category',$row->category_id).">$row->category_name</option>";
                        }
                      ?>
                    </select>
                    <span class="validation-color" id="err_category"><?php echo form_error('category'); ?></span>
                  </div>
                  <!-- /.form-group -->
                  <div class="form-group">
                    <label for="subcategory_name"><!-- Subcategory Name  --><?php echo $this->lang->line('product_name'); ?><span class="validation-color">*</span></label>
                    <input type="text" class="form-control" id="subcategory_name" name="subcategory_name" value="<?php echo set_value('subcategory_name'); ?>">
                    <span class="validation-color" id="err_subcategory_name"><?php echo form_error('subcategory_name'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="subcategory_description"><!-- Subcategory Description  -->Description </label>
                    <input type="text" class="form-control" id="sub_category_desc" name="sub_category_desc" value="<?php echo set_value('sub_category_desc'); ?>">
                    <!-- <input type="text" class="form-control" id="subcategory_name" name="subcategory_description" value="<?php echo set_value('subcategory_description'); ?>"> -->
                    <!-- <span class="validation-color" id="err_subcategory_name"><?php echo form_error('subcategory_description'); ?></span> -->

                  </div>
                  <div class="form-group">
                    <label for="category_name"><!-- Category Description --> Status </label><br>
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
                    <span class="btn btn-danger" id="cancel" style="margin-left: 2%" onclick="cancel('subcategory')"><!-- Cancel --><?php echo $this->lang->line('subcategory_cancel'); ?></span>
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
<script>
  $(document).ready(function(){
    var subcategory_name_empty = "Please Enter Subategory.";
    var subcategory_name_invalid = "Please Enter Valid Subategory Name";
    var subcategory_name_length = "Please Enter Subcategory Name Minimun 3 Character";
    var category_select = "Please Select Category."
    
    $('#form').submit(function(){
      var name_regex = /^[a-z0-9\040\.\-\,\/]+$/i;
      var subcategory_name = $('#subcategory_name').val().trim();
      var category = $('#category').val();

      if(category == "" || category == null){
        $('#err_category').text(category_select);
      }
      else{
        $('#err_category').text("");
      }
      //select category validation copmlite.

      $('#subcategory_name').val(subcategory_name);
      if(subcategory_name==null || subcategory_name==""){
        $("#err_subcategory_name").text(subcategory_name_empty);
        return false;
      }
      else{
        $("#err_subcategory_name").text("");
      }
      if (!subcategory_name.match(name_regex) ) {
        $('#err_subcategory_name').text(subcategory_name_invalid);   
        return false;
      }
      else{
        $("#err_subcategory_name").text("");
      }
      if (subcategory_name.length < 3) {
        $('#err_subcategory_name').text(subcategory_name_length);  
        return false;
      }
      else{
        $("#err_subcategory_name").text("");
      }
      //subcategory name validation complite.

      $(this).find(':button[type=submit]').prop('disabled', true);
      $('.button').css('cursor', 'default');
      $('.button').toggleClass('active');
    });

    $("#subcategory_name").on("blur keyup",  function (event){
      var name_regex = /^[a-z0-9\040\.\-\,\/]+$/i;
      var subcategory_name = $('#subcategory_name').val();
      if(subcategory_name==null || subcategory_name==""){
        $("#err_subcategory_name").text(subcategory_name_empty);
        return false;
      }
      else{
        $("#err_subcategory_name").text("");
      }
      if (!subcategory_name.match(name_regex) ) {
        $('#err_subcategory_name').text(subcategory_name_invalid);   
        return false;
      }
      else{
        $("#err_subcategory_name").text("");
      }
      if (subcategory_name.length < 3) {
        $('#err_subcategory_name').text(subcategory_name_length);  
        return false;
      }
      else{
        $("#err_subcategory_name").text("");
      }
    });
    $('#category').change(function(){
      var category = $('#category').val();
      if(category == "" || category == null){
        $('#err_category').text(category_select);
      }
      else{
        $('#err_category').text("");
      }
    });
}); 
</script>
