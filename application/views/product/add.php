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
        <li><a href="<?php echo base_url('product/local_list'); ?>" class="text-black"><strong><?php echo $this->lang->line('header_product'); ?></strong></a></li>
        <li class="active"><?php echo $this->lang->line('product_add_product'); ?></li>
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
            <h3 class="box-title"><?php echo $this->lang->line('product_add_new_product'); ?></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <form role="form" id="form" method="post" action="<?php echo base_url('product/addProduct');?>" encType="multipart/form-data">
                <div class="col-md-6">
                  <?php
                  if($code==null){
                    $no = sprintf('%06d',intval(1));
                  }
                  else{
                    foreach ($code as $value) {
                      $no = sprintf('%06d',intval($value->product_id)+1); 
                    }
                  }
                  ?>
                  <div class="form-group">
                    <label for="code"><?php echo $this->lang->line('product_product_code'); ?></label>
                    <input type="text" class="form-control" id="code" name="code" value="WPR-<?php echo $no;?>" readonly>
                  </div>

                  <div class="form-group">
                    <label for="category">Category <span class="validation-color">*</span></label>
                    <select class="form-control select2" id="category" name="category" style="width: 100%;">
                      <option value="">Select Category</option>
                      <?php
                        $category_id = explode(',', $this->session->userdata('category_id'));

                        foreach ($category as $row) {
                          if($this->session->userdata('type') == 'admin'){
                            echo "<option value='$row->category_id'".set_select('category',$row->category_id).">$row->category_name</option>";
                          }
                          else{
                            if((in_array($row->category_id, $category_id))){
                              echo "<option value='$row->category_id'".set_select('category',$row->category_id).">$row->category_name</option>";
                            }
                          }
                        }
                      ?>
                    </select>
                    <span class="validation-color" id="err_category"><?php echo form_error('category'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="category">Principal <span class="validation-color">*</span></label>
                    
                    <select class="form-control select2" id="client1" name="client1[]" style="width: 100%" multiple>
                      <?php
                      foreach ($client1 as $value) {
                        echo "<option value='$value->client_id'".set_select('client1',$value->client_id).">$value->company_name</option>";
                      }
                      ?>
                    </select>
                    <span class="validation-color" id="err_client1"><?php echo form_error('client1'); ?></span>
                  </div>

                  <div class="form-group" style="margin-bottom: 0">
                    <table class="table no-border" style="margin-bottom: 0">
                      <tbody id="records">
                      </tbody>
                    </table>
                  </div>

                  <div class="form-group">
                    <label for="type">Type <span style="color: red;">*</span></label>
                    
                    <select class="form-control select2" id="type_id" name="type_id" style="width: 100%">
                      <option value="">Select Type</option>
                      <option value="1">Customer Product</option>
                      <option value="2">Winmark Product</option>
                    </select>
                    <span class="validation-color" id="err_type_id"><?php echo form_error('type_id'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="image">TR / Spec </label>
                    <input accept="image/*" type="file" class="form-control" id="image" name="image" value="<?php echo set_value('image'); ?>">
                    <span class="validation-color" id="err_image"><?php echo form_error('image'); ?></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="name"><?php echo $this->lang->line('product_product_name'); ?> <span class="validation-color">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo set_value('name'); ?>">
                    <span class="validation-color" id="err_name"><?php echo form_error('name'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="subcategory">Subcategory</label>
                    <select class="form-control select2" id="subcategory" name="subcategory" style="width: 100%;">
                      <option value="">Select Subcategory</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="category">BD Customer <span class="validation-color">*</span></label>
                    
                    <select class="form-control select2" id="client2" name="client2[]" style="width: 100%" multiple>
                      <?php
                      foreach ($client2 as $value) {
                        echo "<option value='$value->client_id'".set_select('client2',$value->client_id).">$value->company_name</option>";
                      }
                      ?>
                    </select>
                    <span class="validation-color" id="err_client2"><?php echo form_error('client2'); ?></span>
                  </div>

                  <div id="approval_div" class="form-group" style="display: none;">
                    <label for="type">Approval Status <span class="validation-color">*</span></label>
                    
                    <select class="form-control select2" id="approve_status" name="approve_status" style="width: 100%">
                      <option value="">Select Status</option>
                      <option value="Approved">Approved</option>
                      <option value="Rejected">Rejected</option>
                      <option value="Pending">Pending</option>
                      <option value="Not Applicable">Not Applicable</option>
                    </select>
                    <span class="validation-color" id="err_approve_status"><?php echo form_error('approve_status'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="note">Details </label>
                    <textarea rows="1" class="form-control" id="note" name="note"><?php echo set_value('note'); ?></textarea>
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
                      <div class="col-sm-6">
                        <label for="is_inventory">Inventory</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" name="is_inventory" value="1" class="minimal"/>
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
                    <span class="btn btn-danger" id="cancel" style="margin-left: 2%" onclick="cancel('product/other_list')"><?php echo $this->lang->line('product_cancel'); ?></span>
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
  $('#category').change(function(){
    var id = $(this).val();
    $('#subcategory').html('');
    $('#subcategory').append('<option value="">Select Subcategory</option>');
    $.ajax({
      url: "<?php echo base_url('product/getSubcategory') ?>/"+id,
      type: "GET",
      dataType: "JSON",
      success: function(data){
        for(i=0;i<data.length;i++){
            $('#subcategory').append('<option value="' + data[i].sub_category_id + '">' + data[i].sub_category_name + '</option>');
        }
      } 
    });
  });
</script>

<script>
  var client_arr;
  $('#client').change(function(){
    var client = $(this).val();
    var str_client = client.toString();
    client_arr = str_client.split(',');

    $("#records").empty();
    client_arr.map( function(item) {
      $("#records").append('<tr><td style="padding: 0; padding-bottom: 8px;"><input type="text" class="form-control" name="email[]" id="email" placeholder="Insert Email"></td></tr>');
    });
  });

  $('#type_id').change(function(){
    if($(this).val() == 1){
      $('#approval_div').css('display', 'block');
    }

    else{
      $('#approval_div').css('display', 'none');
    }
  });

  $(document).ready(function(){
    $('#form').submit(function(){
      var name_regex = /^[a-z0-9\040\.\-\,\/]+$/i;
      var name = $('#name').val();
      var category = $('#category').val();
      var client1 = $('#client1').val();
      var client2 = $('#client2').val();
      var image = $('#image').val();
      var details = $('#details').val();
      var type_id = $('#type_id').val();
      var approve_status = $('#approve_status').val();

      if(name==null || name==""){
        $("#err_name").text("Please Enter Product.");
        return false;
      }
      else{
        $("#err_name").text("");
      }
      if (!name.match(name_regex) ) {
        $('#err_name').text(" Please Enter Valid Product Name ");   
        return false;
      }
      else{
        $("#err_name").text("");
      }
      //product name validation complite.

      if(category==""){
        $("#err_category").text("Select the Category.");
        return false;
      }
      else{
        $("#err_category").text("");
      }
      //category validation complite.

      if(client1=="" && client2==""){
        $("#err_client1").text("Select At Least One From The List.");
        $("#err_client2").text("Select At Least One From The List.");
        return false;
      }
      else{
        $("#err_client1").text("");
        $("#err_client2").text("");
      }
      //Client validation complite

      if(type_id==""){
        $("#err_type_id").text("Select the Type.");
        return false;
      }
      else{
        if(type_id == 1){
          if(approve_status==""){
            $("#err_approve_status").text("Select the Approval Status.");
            return false;
          }
          else{
            $("#err_approve_status").text("");
          }
        }

        $("#err_type_id").text("");
      }
      //Type validation complite

      $(this).find(':button[type=submit]').prop('disabled', true);
      $('.button').css('cursor', 'default');
      $('.button').toggleClass('active');
    });
   
    $("#name").on("blur keyup",  function (event){
      var name_regex = /^[a-z0-9\040\.\-\,\/]+$/i;
      var name = $('#name').val();
      if(name==null || name==""){
        $("#err_name").text("Please Enter Product Name.");
        return false;
      }
      else{
        $("#err_name").text("");
      }
      if (!name.match(name_regex) ) {
        $('#err_name').text(" Please Enter Valid Product Name ");   
        return false;
      }
      else{
        $("#err_name").text("");
      }
    });
    $("#category").change(function(event){
      var category = $('#category').val();
      if(category==""){
        $("#err_category").text("Select the Category.");
        return false;
      }
      else{
        $("#err_category").text("");
      }
    });
    $("#client1").change(function(event){
      var client2 = $('#client2').val();
      if($(this).val()=="" && client2==""){
        $("#err_client1").text("Select At Least One From The List.");
        $("#err_client2").text("Select At Least One From The List.");
        return false;
      }
      else{
        $("#err_client1").text("");
        $("#err_client12").text("");
      }
    });
    $("#client2").change(function(event){
      var client1 = $('#client1').val();
      if($(this).val()=="" && client1==""){
        $("#err_client1").text("Select At Least One From The List.");
        $("#err_client2").text("Select At Least One From The List.");
        return false;
      }
      else{
        $("#err_client1").text("");
        $("#err_client12").text("");
      }
    });
    $("#type_id").change(function(event){
      var type_id = $('#type_id').val();
      if(type_id==""){
        $("#err_type_id").text("Select the Type.");
        return false;
      }
      else{
        $("#err_type_id").text("");
      }
    });
  }); 
</script>