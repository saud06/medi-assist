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
          <li><a href="<?php echo base_url('employee'); ?>" class="text-black"><!-- Client --> <strong>Client</strong></a></li>
          <li><a href="<?php echo base_url('client_type'); ?>" class="text-black"><!-- Client Type --> <strong>Client Type</strong></a></li>
          <li class="active"><!-- Edit Client Type --> Edit Client Type</li>
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
              <h3 class="box-title"><!--Edit Type Name--> Edit Client Type</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <form role="form" id="form" method="post" action="<?php echo base_url('employee/editTypeDetails');?>">
                <?php foreach($data as $row){?>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="type_name"><!-- Type Name  --> Type Name<span class="validation-color">*</span></label>
                      <input type="text" class="form-control" id="type_name" name="type_name" value="<?php echo $row->name; ?>">
                      <input type="hidden" name="id" value="<?php echo $row->client_type_id;?>">
                      <span class="validation-color" id="err_type_name"><?php echo form_error('type_name'); ?></span>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="type_status"><!-- Status -->Status <span class="validation-color">*</span></label><br>
                      <?php echo lang('category_status_y_label', 'confirm');?>
                      <input type="radio" name="confirm" value="active" <?php if($row->status == 'active'){?> checked="checked" <?php }?> class="minimal"/>&nbsp;&nbsp;
                      <?php echo lang('category_status_n_label', 'confirm');?>
                      <input type="radio" name="confirm" value="inactive" <?php if($row->status != 'active'){?> checked="checked" <?php }?> class="minimal"/>
                    </div>
                  </div>
                <?php } ?>

                <div class="col-sm-12">
                  <div class="box-footer">
                    <button type="submit" id="submit" class="btn btn-info"><!-- Update --> Update</button>
                    <span class="btn btn-default" id="cancel" style="margin-left: 2%" onclick="cancel('category')"><!-- Cancel --> <?php echo $this->lang->line('category_cancel'); ?></span>
                  </div>
                </div>
              </form>
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
    var type_name_empty = "Please Enter the Type Name.";
    var type_name_invalid = "Please Enter Valid Type Name";
    var type_name_length = "Please Enter Type Name Minimun 3 Character";
    $("#submit").click(function(event){
      var name_regex = /^[-a-zA-Z\s]+$/;
      var type_name = $('#type_name').val().trim();
      $('#type_name').val(type_name);
      if(type_name==null || type_name==""){
        $("#err_type_name").text(type_name_empty);
        return false;
      }
      else{
        $("#err_type_name").text("");
      }
      if (!type_name.match(name_regex) ) {
        $('#err_type_name').text(type_name_invalid);   
        return false;
      }
      else{
        $("#err_type_name").text("");
      }
      if (type_name.length < 3) {
        $('#err_type_name').text(type_name_length);  
        return false;
      }
      else{
        $("#err_type_name").text("");
      }
//type name validation complite.
    });

    $("#type_name").on("blur keyup",  function (event){
      var name_regex = /^[-a-zA-Z\s]+$/;
      var type_name = $('#type_name').val();
        if(type_name==null || type_name==""){
          $("#err_type_name").text(type_name_empty);
          return false;
        }
        else{
          $("#err_type_name").text("");
        }
        if (!type_name.match(name_regex)) {
          $('#err_type_name').text(type_name_invalid);  
          return false;
        }
        else{
          $("#err_type_name").text("");
        }
        if (type_name.length < 3) {
          $('#err_type_name').text(type_name_length);  
          return false;
        }
        else{
          $("#err_type_name").text("");
        }
    });
   
}); 
</script>