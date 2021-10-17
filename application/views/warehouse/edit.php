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
          <li><a href="<?php echo base_url('warehouse'); ?>" class="text-black"><!-- Warehouse -->
                  <strong><?php echo $this->lang->line('warehouse_header'); ?></strong></a></li>
          <li class="active"><!-- Edit Warehouse -->
            <?php echo $this->lang->line('edit_warehouse_header'); ?>
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
              <h3 class="box-title"><!-- Edit Warehouse -->
            <?php echo $this->lang->line('edit_warehouse_header'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-sm-6">
                <form role="form" id="form" method="post" action="<?php echo base_url('warehouse/editWarehouse');?>">
                  <?php foreach($data as $row){?>
                    <div class="form-group">
                      <label for="branch"><!-- Select Branch --> 
                        <?php echo $this->lang->line('add_biller_select_branch'); ?> <span class="validation-color">*</span></label>
                      <select class="form-control select2" id="branch" name="branch" style="width: 100%;">
                        <option value=""><!-- Select -->
                        <?php echo $this->lang->line('add_biller_select'); ?></option>
                        <?php
                          foreach ($branch as $key) {
                        ?>
                            <option value='<?php echo $key->branch_id ?>' <?php if($key->branch_id == $row->branch_id){echo "selected";} ?>><?php echo $key->branch_name ?></option>
                        <?php
                          }
                        ?>
                      </select>
                      <span class="validation-color" id="err_branch_id"><?php echo form_error('branch'); ?></span>
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                      <label for="warehouse_name"><!-- Warehouse Name -->
                        <?php echo $this->lang->line('add_warehouse_name'); ?> <span class="validation-color">*</span></label>
                      <input type="text" class="form-control" id="warehouse_name" name="warehouse_name" value="<?php echo $row->warehouse_name; ?>">
                      <input type="hidden" name="id" value="<?php echo $row->warehouse_id;?>">
                      <span class="validation-color" id="err_warehouse_name"><?php echo form_error('warehouse_name'); ?></span>
                    </div>
                  </div>
                <div class="col-sm-12">
                  <div class="box-footer">
                    <button type="submit" id="submit" class="btn btn-info"><!-- Update --><?php echo $this->lang->line('edit_biller_btn'); ?></button>
                    <span class="btn btn-default" id="cancel" style="margin-left: 2%" onclick="cancel('warehouse')"><!-- Cancel -->
                      <?php echo $this->lang->line('add_user_btn_cancel'); ?></span>
                  </div>
                </div>
                  <?php } ?>
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
