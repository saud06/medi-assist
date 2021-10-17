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
          <li><a href="<?php echo base_url('category'); ?>" class="text-black"><!-- Category --><strong><?php echo $this->lang->line('category_lable'); ?></strong></a></li>
          <li class="active"><!-- Add Category --> <?php echo $this->lang->line('category_lable_addcategory'); ?></li>
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
              <h3 class="box-title"><!-- Add New Category --><?php echo $this->lang->line('category_lable_newcategory'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" id="form" method="post" action="<?php echo base_url('category/addCategory');?>">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="category_name"><!-- Category Name --><?php echo $this->lang->line('category_lable_cname'); ?> <span class="validation-color">*</span></label>
                    <input type="text" class="form-control" id="category_name" name="category_name" value="<?php echo set_value('category_name'); ?>">
                    <span class="validation-color" id="err_category_name"><?php echo form_error('category_name'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="category_name"><!-- Category Description --><?php echo $this->lang->line('category_lable_status'); ?> <span class="validation-color">*</span></label><br>
                    <?php echo lang('category_status_y_label', 'confirm');?>
                    <input type="radio" name="confirm" value="active" checked="checked" class="minimal"/>&nbsp;&nbsp;
                    <?php echo lang('category_status_n_label', 'confirm');?>
                    <input type="radio" name="confirm" value="inactive" class="minimal"/>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="category_name"><!-- Category Description --><?php echo $this->lang->line('category_lable_desc'); ?></label>
                    <input type="text" class="form-control" id="category_desc" name="category_desc" value="<?php echo set_value('category_desc'); ?>">
                  </div>
                </div>

                <div class="col-sm-12">
                  <div class="box-footer">
                    <button type="submit" id="submit" class="button btn bg-gray">
                      <span class="submit" style="left: 32%">Add</span>
                      <span class="loading" style="left: 32%"><i class="fa fa-circle-o-notch"></i></span>
                    </button>

                    <span class="btn btn-danger" id="cancel" style="margin-left: 2%" onclick="cancel('category')"><!-- Cancel --><?php echo $this->lang->line('category_cancel'); ?></span>
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
    var category_name_empty = "Please Enter the Category Name.";
    var category_name_invalid = "Please Enter Valid Category Name";
    var category_name_length = "Please Enter Category Name Minimun 3 Character";

    $('#form').submit(function(){
      var name_regex = /^[a-z0-9\040\.\-\,\/]+$/i;
      var category_name = $('#category_name').val().trim();
      $('#category_name').val(category_name);
      if(category_name==null || category_name==""){
        $("#err_category_name").text(category_name_empty);
        return false;
      }
      else{
        $("#err_category_name").text("");
      }
      if (!category_name.match(name_regex) ) {
        $('#err_category_name').text(category_name_invalid);   
        return false;
      }
      else{
        $("#err_category_name").text("");
      }
      if (category_name.length < 3) {
        $('#err_category_name').text(category_name_length);  
        return false;
      }
      else{
        $("#err_category_name").text("");
      }

      $(this).find(':button[type=submit]').prop('disabled', true);
      $('.button').css('cursor', 'default');
      $('.button').toggleClass('active');
    });

    $("#category_name").on("blur keyup",  function (event){
      var name_regex = /^[a-z0-9\040\.\-\,\/]+$/i;
      var category_name = $('#category_name').val();
        if(category_name==null || category_name==""){
          $("#err_category_name").text(category_name_empty);
          return false;
        }
        else{
          $("#err_category_name").text("");
        }
        if (!category_name.match(name_regex)) {
          $('#err_category_name').text(category_name_invalid);  
          return false;
        }
        else{
          $("#err_category_name").text("");
        }
        if (category_name.length < 3) {
          $('#err_category_name').text(category_name_length);  
          return false;
        }
        else{
          $("#err_category_name").text("");
        }
    });
   
}); 
</script>