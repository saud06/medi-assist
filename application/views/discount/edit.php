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
          <li><a href="<?php echo base_url('discount'); ?>" class="text-black"><!-- Discount --> <strong><?php echo $this->lang->line('discount_label'); ?></strong></a></li>
          <li class="active"><!-- Edit Discount --> <?php echo $this->lang->line('discount_label_edit'); ?></li>
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
              <h3 class="box-title"><!-- Edit Discount --> <?php echo $this->lang->line('discount_label_edit'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-sm-6">
                <form role="form" id="form" method="post" action="<?php echo base_url('discount/editDiscount');?>">
                  <?php foreach($data as $row){?>
                    <!-- <div class="form-group">
                    <label for="discount_type">Discount Type<span class="validation-color">*</span></label>
                    <select class="form-control select2" id="discount_type" name="discount_type" style="width: 100%;">
                      <option value="" <?php echo  set_select('discount_type', '', TRUE); ?>>Select</option>
                      <option value="Fixed" <?php if($row->discount_type=="Fixed"){echo "selected";} ?>>Fixed</option>
                      <option value="Percentage" <?php if($row->discount_type=="Percentage"){echo "selected";} ?>>Percentage</option>Percentage</option>
                    </select>
                    <span class="validation-color" id="err_discount_type"><?php echo form_error('discount_type'); ?></span>
                  </div> -->
                  <!-- <div class="form-group discount_amount">
                    <label for="discount_amount">Enter Minimum Amount to Give Discount <span class="validation-color">*</span></label>
                    <div class="input-group">
                      <input type="text" class="form-control" id="discount_amount" name="discount_amount" value="<?php echo $row->amount ?>">
                      <span class="input-group-addon">.00</span>
                    </div>
                    <span class="validation-color" id="err_discount_amount"><?php echo form_error('discount_amount'); ?></span>
                  </div> -->

                  <div class="form-group">
                    <label for="discount_name"><!-- Discount Name --> <?php echo $this->lang->line('discount_label_name'); ?> <span class="validation-color">*</span></label>
                     <input type="text" class="form-control" id="discount_name" name="discount_name" value="<?php echo $row->discount_name;?>">
                     <input type="hidden" name="id" value="<?php echo $row->discount_id;?>">
                    <span class="validation-color" id="err_discount_name"><?php echo form_error('discount_name'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="discount_value"><!-- Discount Value --> <?php echo $this->lang->line('discount_label_value'); ?> <span class="validation-color">*</span></label>
                      <div class="input-group">
                        <input type="text" class="form-control text-right" id="discount_value" name="discount_value" value="<?php echo $row->discount_value; ?>">
                        <span class="input-group-addon percentage_icon">%</span>
                      </div>
                    <span class="validation-color" id="err_discount_value"><?php echo form_error('discount_value'); ?></span>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="box-footer">
                    <button type="submit" id="submit" class="btn btn-info"><!-- Update --> <?php echo $this->lang->line('discount_label_update'); ?></button>
                    <span class="btn btn-default" id="cancel" style="margin-left: 2%" onclick="cancel('discount')"><!-- Cancel --> <?php echo $this->lang->line('discount_label_cancel'); ?></span>
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
      var name_regex = /^[-a-zA-Z\s]+$/;
      var dvalue_regex = /^\$?[0-9]*([0-9]+)?$/;
      /*var discount_type = $('#discount_type').val();*/
      var discount_name = $('#discount_name').val();
      var discount_value = $('#discount_value').val();
      /*var discount_amount = $('#discount_amount').val();*/

       /* if(discount_type==""){
          $("#err_discount_type").text("Select the Discount Type.");
          return false;
        }
        else{
          $("#err_discount_type").text("");
        }*/
//Discount type validation complite.
        /*if(discount_type == "Fixed"){
          if(discount_amount==null || discount_amount==""){
            $("#err_discount_amount").text("Please Enter Amount.");
            $('#discount_amount').focus();
            return false;
          }
          else{
            $("#err_discount_amount").text("");
          }
          if (!discount_amount.match(dvalue_regex) ) {
            $('#err_discount_amount').text("  Please Enter Valid Amount. Ex(1000 or 1000.10)");   
            $('#discount_amount').focus();
            return false;
          }
          else{
            $("#err_discount_amount").text("");
          }
        }*/
        
//discount amount validation complite. 

        if(discount_name==null || discount_name==""){
          $("#err_discount_name").text("Please Enter Discount Name.");
          $('#discount_name').focus();
          return false;
        }
        else{
          $("#err_discount_name").text("");
        }
        if (!discount_name.match(name_regex) ) {
          $('#err_discount_name').text("  Please Enter Valid Discount Name ");  
          $('#discount_name').focus(); 
          return false;
        }
        else{
          $("#err_discount_name").text("");
        }
//discount name validation complite.
  
        if(discount_value==null || discount_value==""){
          $("#err_discount_value").text("Please Enter Discount Value.");
          $('#discount_value').focus();
          return false;
        }
        else{
          $("#err_discount_value").text("");
        }
        if (!discount_value.match(dvalue_regex) ) {
          $('#err_discount_value').text(" Please Enter Valid Discount Value. Ex(10) "); 
          $('#discount_value').focus();  
          return false;
        }
        else{
          $("#err_discount_value").text("");
        }
//discount value validation complite.
        
    });

    /*$("#discount_type").change(function(event){
        var discount_type = $('#discount_type').val();
        if(discount_type=="Select Type"){
          $("#err_discount_type").text("Select the Discount Type.");
          return false;
        }
        else{
          $("#err_discount_type").text("");
        }
        if(discount_type=="Fixed"){
          $('.discount_amount').show();
        }
        else{
          $('.discount_amount').hide();
        }
    });*/
    /*$("#discount_amount").on("blur keyup",  function (event){
        var dvalue_regex = /^\$?[1-9][0-9]*(\.[0-9][0-9])?$/;
        var discount_amount = $('#discount_amount').val();
         if(discount_amount==null || discount_amount==""){
          $("#err_discount_amount").text("Please Enter Amount.");
          return false;
        }
        else{
          $("#err_discount_amount").text("");
        }
        if (!discount_amount.match(dvalue_regex) ) {
          $('#err_discount_amount').text("  Please Enter Valid Amount. Ex(1000 or 1000.10)");   
          return false;
        }
        else{
          $("#err_discount_amount").text("");
        }
    });*/
    $("#discount_name").on("blur keyup",  function (event){
        var name_regex = /^[-a-zA-Z\s]+$/;
        var discount_name = $('#discount_name').val();
        if(discount_name==null || discount_name==""){
          $("#err_discount_name").text("Please Enter Discount Name.");
          return false;
        }
        else{
          $("#err_discount_name").text("");
        }
        if (!discount_name.match(name_regex) ) {
          $('#err_discount_name').text("  Please Enter Valid Discount Name ");   
          return false;
        }
        else{
          $("#err_discount_name").text("");
        }
    });

    $("#discount_value").on("blur keyup",  function (event){
        var dvalue_regex = /^\$?[0-9]*([0-9]+)?$/;
        var discount_value = $('#discount_value').val();
        if(discount_value==null || discount_value==""){
          $("#err_discount_value").text("Please Enter Discount Value.");
          $('#discount_value').focus();
          return false;
        }
        else{
          $("#err_discount_value").text("");
        }
        if (!discount_value.match(dvalue_regex) ) {
          $('#err_discount_value').text(" Please Enter Valid Discount Value. Ex(1000 or 10.10)"); 
          $('#discount_value').focus();  
          return false;
        }
        else{
          $("#err_discount_value").text("");
        }
    });
   
}); 
</script>