<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','manager');
if(!(in_array($this->session->userdata('type'),$p))){
  redirect('auth');
}
$this->load->view('layout/header');
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('auth/dashboard'); ?>" class="text-black"><i class="fa fa-dashboard">&nbsp;</i><strong><?php echo $this->lang->line('header_dashboard'); ?></strong></a></li>
          <li><a href="<?php echo base_url('brand'); ?>" class="text-black"><strong>Brand</strong></a></li>
          <li class="active">Add Brand <!-- <?php echo $this->lang->line('category_lable_addcategory'); ?> --></li>
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
              <h3 class="box-title">Add New Brand<!-- <?php echo $this->lang->line('category_lable_newcategory'); ?> --></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" id="form" method="post" action="<?php echo base_url('brand/add_brand');?>">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="brand_name">Brand Name<!-- <?php echo $this->lang->line('category_lable_cname'); ?> --> <span class="validation-color">*</span></label>
                    <input type="text" class="form-control" id="brand_name" name="brand_name" value="<?php echo set_value('brand_name'); ?>">
                    <span class="validation-color" id="err_category_name"><?php echo form_error('brand_name'); ?></span>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="box-footer">
                    <button type="submit" id="submit" class="btn btn-info">&nbsp;&nbsp;&nbsp;Add&nbsp;&nbsp;&nbsp;</button>
                    <span class="btn btn-default" id="cancel" style="margin-left: 2%" onclick="cancel('brand')">Cancel<!-- <?php echo $this->lang->line('category_cancel'); ?> --></span>
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
    $("#submit").click(function(event){
      var name_regex = /^[-a-zA-Z\s]+$/;
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
//category name validation complite.
    });

    $("#category_name").on("blur keyup",  function (event){
      var name_regex = /^[-a-zA-Z\s]+$/;
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