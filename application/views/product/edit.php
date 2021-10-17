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
        <li><a href="<?php echo base_url('product/local_list'); ?>" class="text-black"><strong><?php echo $this->lang->line('header_product'); ?></strong></a></li>
        <li class="active"><?php echo $this->lang->line('header_edit_product'); ?></li>
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
            <h3 class="box-title"><?php echo $this->lang->line('header_edit_product'); ?></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <form role="form" id="form" method="post" action="<?php echo base_url('product/editProduct');?>" encType="multipart/form-data">
                <?php foreach($data as $row){?>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="code"><?php echo $this->lang->line('product_product_code'); ?><span class="validation-color">*</span></label>
                    <input type="text" class="form-control" id="code" name="code" value="<?php echo $row->code;?>" readonly>
                    <input type="hidden" name="id" value="<?php echo $row->product_id;?>">
                    <span class="validation-color" id="err_code"><?php echo form_error('code'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="name"><?php echo $this->lang->line('product_product_name'); ?> <span class="validation-color">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $row->name;?>">
                    <span class="validation-color" id="err_name"><?php echo form_error('name'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="category">Category <span class="validation-color">*</span></label>
                    <select class="form-control select2" id="category" name="category" style="width: 100%;">
                      <option value="">Select Category</option>
                      <?php  foreach ($category as $cat) { ?>
                      <option value='<?php echo $cat->category_id ?>' <?php if($cat->category_id == $row->category_id){echo "selected";} ?>><?php echo $cat->category_name ?></option>
                      <?php } ?>
                    </select>
                    <span class="validation-color" id="err_category"><?php echo form_error('category'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="subcategory">Subcategory</label>
                    <select class="form-control select2" id="subcategory" name="subcategory" style="width: 100%;">
                      <option value="">Select Subcategory</option>
                      <?php  foreach ($subcategory as $sub) { ?>
                      <option value='<?php echo $sub->sub_category_id ?>' <?php if($sub->sub_category_id == $row->subcategory_id){echo "selected";} ?>><?php echo $sub->sub_category_name ?></option>
                      <?php } ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="category">Client <span class="validation-color">*</span></label>

                    <select class="form-control select2" id="client" name="client_cat[]" style="width: 100%;" multiple>
                      <?php
                      $var = $row->client_id;
                      $cat_idd = explode(",", $var);                          

                      foreach ($client_cat as $key){
                        $flag = 0;
                        foreach ($cat_idd as $id){
                          if($key->client_id == $id){
                            $flag = 1;
                            break;
                          }
                        }
                      ?>
                        <option value="<?php echo $key->client_id; ?>" <?php if($flag == 1){ echo "selected"; } ?>
                          ><?php echo $key->company_name; ?></option>
                      <?php
                      }
                      ?>
                    </select>
                    <span class="validation-color" id="err_client"><?php echo form_error('client'); ?></span>
                  </div>

                  <div class="form-group">
                    <table class="table no-border">
                      <tbody id="records">
                        <?php 
                          $client_email = explode(',', $row->client_email);
                          foreach ($client_email as $key => $value) {
                        ?>
                            <tr><td style="padding: 0; padding-bottom: 8px;"><input type="text" class="form-control" name="email[]" id="email" placeholder="Insert Email" value="<?php echo $value; ?>"></td></tr>
                        <?php
                          }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="note">Details</label>
                    <textarea rows="1" class="form-control" id="note" name="note"><?php echo $row->details; ?></textarea>
                    <span class="validation-color" id="err_note"><?php echo form_error('note'); ?></span>
                  </div>

                  <?php 
                    if($type_id == 1){ 
                      $sql = "SELECT * FROM prod_approve_status WHERE product_id = '$row->product_id' LIMIT 1";
                      $result = $this->db->query($sql, array($row->product_id));
                      
                      if($result->num_rows() > 0){
                        $approval_status = $this->db->query($sql,array($row->product_id))->row()->approval_status;
                      } 
                      else{
                        $approval_status = '';
                      }
                  ?>
                      <div id="approval_div" class="form-group">
                        <label for="type">Approval Status <span class="validation-color">*</span></label>
                        
                        <select class="form-control select2" id="approve_status" name="approve_status" style="width: 100%">
                          <option value="">Select Status</option>
                          <option value="Approved" <?php if($approval_status == 'Approved'){ ?> selected <?php }?>>Approved</option>
                          <option value="Rejected" <?php if($approval_status == 'Rejected'){ ?> selected <?php }?>>Rejected</option>
                          <option value="Pending" <?php if($approval_status == 'Pending'){ ?> selected <?php }?>>Pending</option>
                          <option value="Not Applicable" <?php if($approval_status == 'Not Applicable'){ ?> selected <?php }?>>Not Applicable</option>
                        </select>
                        <span class="validation-color" id="err_approve_status"><?php echo form_error('approve_status'); ?></span>
                      </div>
                  <?php 
                    } 
                  ?>

                  <div class="form-group">
                    <label for="image">TR / Spec </label>
                    <input accept="image/*" type="file" class="" id="image" name="image" value="">
                    <input type="hidden" name="hidden_image" value="<?php echo $row->image;?>">
                    <span class="validation-color" id="err_image"><?php echo form_error('image'); ?></span>
                  </div>

                  <div class="form-group">
                    <div class="row">
                      <div class="col-sm-6">
                        <label for="category_name">Status </label><br>
                        <?php echo lang('category_status_y_label', 'confirm');?>
                        <input type="radio" name="confirm" value="active" <?php if($row->product_status == 'active') {?> checked="checked" <?php }?> class="minimal"/>&nbsp;&nbsp;
                        <?php echo lang('category_status_n_label', 'confirm');?>
                        <input type="radio" name="confirm" value="inactive" <?php if($row->product_status != 'active') {?> checked="checked" <?php }?> class="minimal"/>
                      </div>
                      <div class="col-sm-6">
                        <label for="is_inventory">Is Inventory</label>&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="checkbox" class="minimal" name="is_inventory" value="1" <?php if($row->is_inventory=='1'){ echo 'checked';} ?>>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-sm-12">
                  <div class="box-footer">
                    <input type="hidden" name="type_id" value="<?php echo $type_id; ?>"> 
                    <button type="submit" id="submit" class="button btn bg-gray">
                      <span class="submit" style="left: 16%">Update</span>
                      <span class="loading" style="left: 32%"><i class="fa fa-circle-o-notch"></i></span>
                    </button>
                    <span class="btn btn-danger" id="cancel" style="margin-left: 2%" onclick="cancel('product/other_list')"><?php echo $this->lang->line('product_cancel'); ?></span>
                  </div>
                </div>
                <?php }?>
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

  $(document).ready(function(){
    $('#form').submit(function(){
      var name_regex = /^[a-z0-9\040\.\-\,\/]+$/i;
      var name = $('#name').val();
      var category = $('#category').val();
      var image = $('#image').val();
      var details = $('#details').val();
      var type_id = <?= $type_id ?>;

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

      if(type_id == 1){
        var approve_status = $('#approve_status').val();
        
        if(approve_status==""){
          $("#err_approve_status").text("Select the Approval Status.");
          return false;
        }
        else{
          $("#err_approve_status").text("");
        }
      }

      if(client==""){
        $("#err_client").text("Select the Client.");
        return false;
      }
      else{
        $("#err_client").text("");
      }
      //Client validation complite

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
    $("#client").change(function(event){
      var subcategory = $('#client').val();
      if(subcategory==""){
        $("#err_client").text("Select the Client.");
        return false;
      }
      else{
        $("#err_client").text("");
      }
    });
  }); 
</script>