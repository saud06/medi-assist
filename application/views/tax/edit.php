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
          <li><a href="<?php echo base_url('tax'); ?>" class="text-black"><!-- Tax --> <strong><?php echo $this->lang->line('tax_label'); ?></strong></a></li>
          <li class="active"><!-- Edit Tax --> <?php echo $this->lang->line('tax_label_Edit'); ?></li>
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
              <h3 class="box-title"><!-- Edit Tax --> <?php echo $this->lang->line('tax_label_Edit'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-sm-6">
                <form role="form" id="form" method="post" action="<?php echo base_url('tax/editTax');?>">
                  <?php foreach($data as $row){?>
                    <div class="form-group">
                      <label for="tax_name"><!-- Tax Name --> <?php echo $this->lang->line('tax_label_name'); ?> <span class="validation-color">*</span></label>
                      <input type="text" class="form-control" id="tax_name" name="tax_name" value="<?php echo $row->tax_name; ?>">
                      <input type="hidden" name="id" value="<?php echo $row->tax_id;?>">
                      <span class="validation-color" id="err_tax_name"><?php echo form_error('tax_name'); ?></span>
                    </div>
                    <div class="form-group">
                    <label for="start_from"><!-- Start From  --> <?php echo $this->lang->line('tax_label_form'); ?><span class="validation-color">*</span></label>
                    <input type="text" class="form-control datepicker" id="start_from" name="start_from" value="<?php echo $row->start_from; ?>">
                    <span class="validation-color" id="err_start_from"><?php echo form_error('start_from'); ?></span>
                  </div>
                  <div class="form-group">
                    <label for="registration_number"><!-- Registration Number --> <?php echo $this->lang->line('tax_label_rnumber'); ?></label>
                    <input type="text" class="form-control" id="registration_number" name="registration_number" value="<?php echo $row->registration_number; ?>">
                    <span class="validation-color" id="err_registration_number"><?php echo form_error('registration_number'); ?></span>
                  </div>
                  <div class="form-group">
                    <label for="frequency"><!-- Filling Frequency --> <?php echo $this->lang->line('tax_label_frequency'); ?> <span class="validation-color">*</span></label>
                    <select class="form-control select2" id="frequency" name="frequency" style="width: 100%;">
                      <option value="Monthly">Monthly</option>
                      <option value="Quarterly">Quarterly</option>
                      <option value="Half-Yearly">Half-Yearly</option>
                      <option value="Yearly">Yearly</option>
                    </select>
                    <span class="validation-color" id="err_frequency"><?php echo form_error('frequency'); ?></span>
                  </div>
                  <div class="form-group">
                    <label for="description"><!-- Description --> <?php echo $this->lang->line('tax_label_desc'); ?></label>
                    <textarea class="form-control" id="description" name="description"><?php echo $row->description; ?></textarea>
                    <span class="validation-color" id="err_registration_number"><?php echo form_error('registration_number'); ?></span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="frequency"><!-- Tax applies to -->  <?php echo $this->lang->line('tax_label_applies'); ?><span class="validation-color">*</span></label>
                    <ul type="none">
                      <li><input type="checkbox" name="sales" id="sales" <?php if($row->tax_value != 0){ echo "checked"; } ?>> Sales</li>
                      <li><input type="checkbox" name="purchase" id="purchase" <?php if($row->purchase_tax_value != 0){ echo "checked"; } ?>> Purchase</li>
                    </ul>
                    <span class="validation-color" id="err_frequency"><?php echo form_error('frequency'); ?></span>
                  </div>
                  <div class="form-group calculate_on">
                    <label for="calculate_on"><!-- Calculate On --> <?php echo $this->lang->line('tax_label_calculate'); ?><span class="validation-color">*</span></label>
                    <div class="input-group">
                      <input class="form-control text-right" type="text" id="calculate_on" name="calculate_on" value="<?php echo $row->calculate_on; ?>" placeholder="100">
                      <span class="input-group-addon">%</span>
                    </div>
                    <span class="validation-color" id="err_calculate_on"><?php echo form_error('calculate_on'); ?></span>
                  </div>
                  
                  <div class="form-group sales">
                    <label for="tax_value"><!-- Sales Tax Rate  --> <?php echo $this->lang->line('tax_label_salesrate'); ?><span class="validation-color">*</span></label>
                    <div class="input-group">
                      <input type="text" class="form-control text-right" id="tax_value" name="tax_value" value="<?php echo $row->tax_value; ?>">
                      <span class="input-group-addon">%</span>
                    </div>
                    <span class="validation-color" id="err_tax_value"><?php echo form_error('tax_value'); ?></span>
                    <div id="s_gst">
                      <br>IGST &nbsp;: <span id="s_igst"><?php echo $row->tax_value; ?>%</span>
                      <br>CGST : <span id="s_cgst"><?php echo $row->tax_value/2; ?>%</span>
                      <br>SGST : <span id="s_sgst"><?php echo $row->tax_value/2; ?>%</span>
                    </div>
                  </div>
                  
                  <div class="form-group purchase">
                    <label for="purchase_tax_value"><!-- Purchase Tax Rate --> <?php echo $this->lang->line('tax_label_purchaserate'); ?> <span class="validation-color">*</span></label>
                    <div class="input-group">
                      <input type="text" class="form-control text-right" id="purchase_tax_value" name="purchase_tax_value" value="<?php echo $row->purchase_tax_value; ?>">
                      <span class="input-group-addon">%</span>
                    </div>
                    <span class="validation-color" id="err_purchase_tax_value"><?php echo form_error('purchase_tax_value'); ?></span>
                    <div id="p_gst">
                      <br>IGST &nbsp;: <span id="p_igst"><?php echo $row->purchase_tax_value; ?>%</span>
                      <br>CGST : <span id="p_cgst"><?php echo $row->purchase_tax_value/2; ?>%</span>
                      <br>SGST : <span id="p_sgst"><?php echo $row->purchase_tax_value/2; ?>%</span>
                    </div>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="box-footer">
                    <button type="submit" id="submit" class="btn btn-info"><!-- Update --> <?php echo $this->lang->line('discount_label_update'); ?></button>
                    <span class="btn btn-default" id="cancel" style="margin-left: 2%" onclick="cancel('tax')"><!-- Cancel --> <?php echo $this->lang->line('discount_label_cancel'); ?></span>
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
  if($data[0]->tax_value == 0){ 
?>
  <script>
    $('.sales').hide();
  </script>
<?php
  }
  if($data[0]->purchase_tax_value == 0){ 
?>
  <script>
    $('.purchase').hide();
  </script>
<?php
  }
?>
<?php
  $this->load->view('layout/footer');
?>
<script>
  $(document).ready(function(){
    $("#submit").click(function(event){
      var name_regex = /^[a-zA-Z0-9\s@%]+$/;
      var tax_regex = /^\$?[0-9]*([0-9]+)?$/;
      var tax_name = $('#tax_name').val();
      var tax_value = $('#tax_value').val();
      
      $('#purchase').is(":checked");
        if(tax_name==null || tax_name==""){
          $("#err_tax_name").text("Please Enter Tax Name.");
          return false;
        }
        else{
          $("#err_tax_name").text("");
        }
        if (!tax_name.match(name_regex) ) {
          $('#err_tax_name').text(" Please Enter Valid Tax Name");   
          return false;
        }
        else{
          $("#err_tax_name").text("");
        }

//tax name validation complite. 
        if($('#sales').is(":checked")){
          if(tax_value==null || tax_value==""){
            $("#err_tax_value").text("Please Enter Sales Tax Value.");
            return false;
          }
          else{
            $("#err_tax_value").text("");
          }
          if (!tax_value.match(tax_regex) ) {
            $('#err_tax_value').text(" Please Enter Valid Sales Tax value (ex : 12) ");   
            return false;
          }
          else{
            $("#err_tax_value").text("");
          }
        }     
        
//sales tax value validation complite.
         if($('#purchase').is(":checked")){
          if(tax_value==null || tax_value==""){
            $("#err_tax_value").text("Please Enter Purchase Tax Value.");
            return false;
          }
          else{
            $("#err_tax_value").text("");
          }
          if (!tax_value.match(tax_regex) ) {
            $('#err_tax_value').text(" Please Enter Valid Purchase Tax value (ex : 12) ");   
            return false;
          }
          else{
            $("#err_tax_value").text("");
          }
        }
        if(!$('#sales').is(":checked") && !$('#purchase').is(":checked")){
          $('#sales').prop("checked", true);
          $('.sales').show();
          $(".calculate_on").show();
          $("#err_tax_value").text("Please Enter Sales Tax Value1.");
          return false;
        } 
        
//purchase tax value validation complite.
        
    });

    $("#tax_name").on("blur keyup",  function (event){
        var name_regex = /^[a-zA-Z0-9\s@%]+$/;
        var tax_name = $('#tax_name').val();
        if(tax_name==null || tax_name==""){
          $("#err_tax_name").text("Please Enter Tax Name.");
          return false;
        }
        else{
          $("#err_tax_name").text("");
        }
        if (!tax_name.match(name_regex) ) {
          $('#err_tax_name').text(" Please Enter Valid Tax Name");   
          return false;
        }
        else{
          $("#err_tax_name").text("");
        }
        //event.preventDefault();
    });

    $("#tax_value").on("blur keyup",  function (event){
       var tax_value = $('#tax_value').val();
       var tax_regex = /^\$?[0-9]*([0-9]+)?$/;
        if(tax_value==null || tax_value==""){
          $("#err_tax_value").text("Please Enter Sales Tax Value.");
          $('#s_gst').hide();
          return false;
        }
        else{
          $("#err_tax_value").text("");
        }
        if (!tax_value.match(tax_regex) ) {
          $('#s_gst').hide();
          $('#err_tax_value').text(" Please Enter Valid Sales Tax value (ex : 12) ");   
          return false;
        }
        else{
          $("#err_tax_value").text("");
        }
        if(tax_value.match(tax_regex)) {
          $('#s_igst').text(tax_value);
          if(tax_value==null || tax_value==""){
            $('s_gst').hide();
          }
          else{
            $('#s_gst').show();
            $('#s_igst').text(tax_value+"%");
            $('#s_cgst').text((tax_value/2)+"%");
            $('#s_sgst').text((tax_value/2)+"%");
          }
          
        }
    });
    $("#purchase_tax_value").on("blur keyup",  function (event){
       var tax_value = $('#purchase_tax_value').val();
       var tax_regex = /^\$?[0-9]*([0-9]+)?$/;
        if(tax_value==null || tax_value==""){
          $("#err_purchase_tax_value").text("Please Enter Purchase Tax Value.");
          $('#p_gst').hide();
          return false;
        }
        else{
          $("#err_purchase_tax_value").text("");
        }
        if (!tax_value.match(tax_regex) ) {
          $('#p_gst').hide();
          $('#err_purchase_tax_value').text(" Please Enter Valid Purchase Tax value (ex : 12) ");   
          return false;
        }
        else{
          $("#err_purchase_tax_value").text("");
        }
        if(tax_value.match(tax_regex)) {
          $('#p_igst').text(tax_value);
          if(tax_value==null || tax_value==""){
            $('p_gst').hide();
          }
          else{
            $('#p_gst').show();
            $('#p_igst').text(tax_value+"%");
            $('#p_cgst').text((tax_value/2)+"%");
            $('#p_sgst').text((tax_value/2)+"%");
          }
          
        }
    });
    $("#sales").on("change",  function (event){
      if($('#sales').is(":checked")){  
        $(".sales").show();
        $(".s_gst").show();
        $(".calculate_on").show();
      }
      else{
        $(".sales").hide();
        if($('#sales').is(":checked") || $('#sales').is(":checked")){  
          $(".calculate_on").show();
        }
        else{
          $(".calculate_on").hide();
        }
      }
      
    });
    $("#purchase").on("change",  function (event){
      if($('#purchase').is(":checked")){  
        $(".purchase").show();
        $(".p_gst").show();
        $(".calculate_on").show();
      }
      else{
        $(".purchase").hide();
        if($('#purchase').is(":checked") || $('#sales').is(":checked")){ 
          $(".calculate_on").show();
        }
        else{
          $(".calculate_on").hide();
        }
      }
      
    });
}); 
</script>