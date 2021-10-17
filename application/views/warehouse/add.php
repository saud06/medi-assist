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
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-dashboard"></i> 
                <!-- Dashboard -->
                <?php echo $this->lang->line('header_dashboard'); ?></a></li>
          <li><a href="<?php echo base_url('warehouse'); ?>">
                <!-- Warehouse -->
                  <?php echo $this->lang->line('warehouse_header'); ?>
                </a></li>
          <li class="active"><!-- Add Warehouse -->
            <?php echo $this->lang->line('add_warehouse'); ?>
          </li>
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
              <h3 class="box-title"><!-- Add New Warehouse -->
                <?php echo $this->lang->line('warehouse_btn_new'); ?>
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                <form role="form" id="form" method="post" action="<?php echo base_url('warehouse/addWarehouse');?>">
                  <div class="form-group">
                    <label for="branch"><!-- Select Branch --> 
                        <?php echo $this->lang->line('add_biller_select_branch'); ?>
                      <span class="validation-color">*</span></label>
                    <select class="form-control select2" id="branch" name="branch" style="width: 100%;">
                      <option value=""><!-- Select -->
                        <?php echo $this->lang->line('add_biller_select'); ?>
                      </option>
                      <?php
                        foreach ($data as $row) {
                          echo "<option value='$row->branch_id'".set_select('branch',$row->branch_id).">$row->branch_name</option>";
                        }
                      ?>
                    </select>
                    <span class="validation-color" id="err_branch_id"><?php echo form_error('branch'); ?></span>
                  </div>
                  <!-- /.form-group -->
                  <div class="form-group">
                    <label for="warehouse_name"><!-- Warehouse Name -->
                        <?php echo $this->lang->line('add_warehouse_name'); ?>
                     <span class="validation-color">*</span></label>
                    <input type="text" class="form-control" id="warehouse_name" name="warehouse_name" value="<?php echo set_value('warehouse_name'); ?>">
                    <span class="validation-color" id="err_warehouse_name"><?php echo form_error('warehouse_name'); ?></span>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="box-footer">
                    <button type="submit" id="submit" class="btn btn-info">&nbsp;&nbsp;&nbsp;<!-- Add -->
                        <?php echo $this->lang->line('add_user_btn'); ?>&nbsp;&nbsp;&nbsp;</button>
                    <span class="btn btn-default" id="cancel" style="margin-left: 2%" onclick="cancel('warehouse')"><!-- Cancel -->
                      <?php echo $this->lang->line('add_user_btn_cancel'); ?></span>
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
    $("#submit").click(function(event){
      var name_regex = /^[-\sa-zA-Z]+$/;
      var branch_id = $('#branch').val();
      var warehouse_name = $('#warehouse_name').val();


        if(branch_id==""){
          $("#err_branch_id").text("Please Select Branch.");
          return false;
        }
        else{
          $("#err_branch_id").text("");
        }
//branch id validation complite.

        if(warehouse_name==null || warehouse_name==""){
          $("#err_warehouse_name").text("Please Enter Warehouse Name.");
          return false;
        }
        else{
          $("#err_warehouse_name").text("");
        }
        if (!warehouse_name.match(name_regex) ) {
          $('#err_warehouse_name').text(" Please Enter Valid Warehouse Name  ");   
          return false;
        }
        else{
          $("#err_warehouse_name").text("");
        }
//warehouse name validation complite.
        
    });

    $("#branch").change(function(event){
        var branch_id = $('#branch').val();
        if(branch_id==""){
          $("#err_branch_id").text(" Please Select Branch.");
          return false;
        }
        else{
          $("#err_branch_id").text("");
        }
    });

    $("#warehouse_name").on("blur keyup", function(){
        var name_regex = /^[-\sa-zA-Z]+$/;
        var warehouse_name = $('#warehouse_name').val();
        if(warehouse_name==null || warehouse_name==""){
          $("#err_warehouse_name").text("Please Enter Warehouse Name.");
          return false;
        }
        else{
          $("#err_warehouse_name").text("");
        }
        if (!warehouse_name.match(name_regex) ) {
          $('#err_warehouse_name').text(" Please Enter Valid Warehouse Name  ");   
          return false;
        }
        else{
          $("#err_warehouse_name").text("");
        }
    });
   
}); 
</script>