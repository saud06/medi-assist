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
          <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-dashboard"></i>  <?php echo $this->lang->line('header_dashboard'); ?></a></li>
          <li><a href="<?php echo base_url('assign_warehouse'); ?>"><?php echo $this->lang->line('assign_warehouse'); ?></a></li>
          <li class="active"><?php echo $this->lang->line('assign_warehouse_add_assign_warehouse'); ?></li>
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
              <h3 class="box-title"><?php echo $this->lang->line('assign_warehouse_add_assign_warehouse');?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                <form role="form" id="form" method="post" action="<?php echo base_url('assign_warehouse/assignWarehouse');?>">
                  <div class="form-group">
                    <label for="user_id"><?php echo $this->lang->line('assign_warehouse_user_name'); ?> <span class="validation-color">*</span></label>
                    <select class="form-control select2" id="user_id" name="user_id" style="width: 100%;">
                      <option value=""><?php echo $this->lang->line('assign_warehouse_select'); ?></option>
                      <?php
                        foreach ($user as $value) {
                      ?>
                        <option value="<?php echo $value->id ?>"><?php echo $value->first_name." ".$value->last_name; ?></option>
                      <?php
                        }
                      ?>
                    </select>
                    <span class="validation-color" id="err_user_id"><?php echo form_error('user_id'); ?></span>
                  </div>
                  <!-- /.form-group -->
                  <div class="form-group">
                    <label for="warehouse_id"><?php echo $this->lang->line('assign_warehouse_warehouse_name'); ?> <span class="validation-color">*</span></label>
                    <select class="form-control select2" id="warehouse_id" name="warehouse_id" style="width: 100%;">
                      <option value=""><?php echo $this->lang->line('assign_warehouse_select'); ?></option>
                      
                    </select>
                    <span class="validation-color" id="err_warehouse_id"><?php echo form_error('warehouse_id'); ?></span>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="box-footer">
                    <button type="submit" id="submit" class="btn btn-info">&nbsp;&nbsp;&nbsp;<?php echo $this->lang->line('assign_warehouse_add'); ?>&nbsp;&nbsp;&nbsp;</button>
                    <span class="btn btn-default" id="cancel" style="margin-left: 2%" onclick="cancel('assign_warehouse')"><?php echo $this->lang->line('assign_warehouse_cancel'); ?></span>
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
<script type="text/javascript">
    $('#user_id').change(function(){
      var id = $(this).val();
      $('#warehouse_id').html('');
      $('#warehouse_id').append('<option value="">Select</option>');
      $.ajax({
          url: "<?php echo base_url('assign_warehouse/getWarehouse') ?>/"+id,
          type: "GET",
          dataType: "JSON",
          success: function(data){
            for(i=0;i<data.length;i++){
              //alert(data[i].sub_category_name);
                $('#warehouse_id').append('<option value="' + data[i].warehouse_id + '">' + data[i].warehouse_name + '</option>');
             
            }
            //console.log(data);
          } 
        });

    });

</script>

<script>
  $(document).ready(function(){
    $("#submit").click(function(event){
      var user_id = $('#user_id').val();
      var warehouse_id = $('#warehouse_id').val();

        if(user_id==""){
          $("#err_user_id").text("Select the User Name.");
          return false;
        }
        else{
          $("#err_user_id").text("");
        }
        if(warehouse_id==""){
          $("#err_warehouse_id").text("Select the Warehouse Name.");
          return false;
        }
        else{
          $("#err_warehouse_id").text("");
        }
        
    });

    $("#user_id").change(function(event){
        var user_id = $('#user_id').val();
        if(user_id==""){
          $("#err_user_id").text("Select the User Name.");
          return false;
        }
        else{
          $("#err_user_id").text("");
        }
    });

    $("#warehouse_id").change(function(event){
        var warehouse_id = $('#warehouse_id').val();
        if(warehouse_id==""){
          $("#err_warehouse_id").text("Select the Warehouse Name.");
          return false;
        }
        else{
          $("#err_warehouse_id").text("");
        }
    });
    
   
}); 
</script>