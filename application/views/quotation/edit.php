<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','sales_person','manager');
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
          <li><a href="<?php echo base_url('auth/dashboard'); ?>" class="text-black"><i class="fa fa-dashboard">&nbsp;</i><strong><?php echo $this->lang->line('header_dashboard'); ?></strong></a></li>
          <li><a href="<?php echo base_url('quotation'); ?>" class="text-black"><strong>Quotation</strong></a></li>
          <li class="active">Edit Quotation</li>
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
              <h3 class="box-title">Edit Quotation</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <form role="form" id="form" method="post" action="<?php echo base_url('quotation/editQuotation');?>">
                <?php foreach($data as $row){?>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="date"><?php echo $this->lang->line('purchase_date'); ?><span class="validation-color">*</span></label>
                    <input type="text" class="form-control datepicker" id="date" name="date" value="<?php echo $row->date;?>">
                    <input type="hidden" name="quotation_id" value="<?php echo $row->quotation_id;?>">
                    <span class="validation-color pull-right" id="err_date"><?php echo form_error('date'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="reference_no"><?php echo $this->lang->line('purchase_reference_no'); ?><span class="validation-color">*</span></label>
                    <input type="text" class="form-control" id="reference_no" name="reference_no" value="<?php echo $row->reference_no;?>" readonly>
                    <span class="validation-color" id="err_reference_no"><?php echo form_error('reference_no'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="warehouse"><?php echo $this->lang->line('purchase_select_warehouse'); ?><span class="validation-color">*</span></label>
                    <input type="hidden" name="old_warehouse_id" id="old_warehouse_id" value="<?php echo $row->warehouse_id ?>">
                    <input type="hidden" name="warehouse_change" id="warehouse_change" value="no">
                    <select class="form-control select2" id="warehouse" name="warehouse" style="width: 100%;">
                      <option value=""><?php echo $this->lang->line('product_select'); ?></option>
                      <?php
                        foreach ($warehouse as  $key) {
                      ?>
                        <option value='<?php echo $key->warehouse_id ?>' <?php if($key->warehouse_id == $row->warehouse_id){echo "selected";} ?>><?php echo $key->warehouse_name ?></option>
                      <?php
                        }
                      ?> 
                    </select>
                    <span class="validation-color" id="err_warehouse"><?php echo form_error('warehouse'); ?></span>
                  </div>
                  <div class="form-group">
                    <label for="biller"><?php echo $this->lang->line('sales_select_biller'); ?><span class="validation-color">*</span></label>
                    <select class="form-control select2" id="biller" name="biller" style="width: 100%;">
                      <option value=""><?php echo $this->lang->line('product_select'); ?></option>
                      <?php
                      foreach ($biller as  $key) {
                      ?>
                              <option value='<?php echo $key->biller_id ?>' <?php if($key->biller_id == $row->biller_id){echo "selected";} ?>><?php echo $key->biller_name ?></option>
                      <?php
                          }
                      ?>
                    </select>
                    <span class="validation-color" id="err_biller"><?php echo form_error('biller');?></span>
                  </div>
                  <div class="form-group">
                    <label for="client"><?php echo $this->lang->line('sales_select_client'); ?><span class="validation-color">*</span></label>
                    <select class="form-control select2" id="client" name="client" style="width: 100%;">
                      <option value=""><?php echo $this->lang->line('product_select'); ?></option>
                      <?php
                      foreach ($client as  $key) {
                      ?>
                              <option value='<?php echo $key->client_id ?>' <?php if($key->client_id == $row->client_id){echo "selected";} ?>><?php echo $key->client_name ?></option>
                      <?php
                          }
                      ?>
                    </select>
                    <span class="validation-color" id="err_client"><?php echo form_error('client');?></span>
                  </div>
                  <div class="form-group">
                    <label for="shipping_charge">Shipping Charge</label>
                    <input type="text" class="form-control text-right" id="shipping_charge" name="shipping_charge" value="<?php echo $row->shipping_charge;?>">
                    <span class="validation-color" id="err_shipping_charge"><?php echo form_error('shipping_charge'); ?></span>
                  </div>
                                    <div class="form-group">
                    <label for="mode_of_transport">Mode of Transport<span class="validation-color">*</span></label>
                    <input type="text" class="form-control" id="mode_of_transport" name="mode_of_transport" value="<?php echo $row->mode_of_transport; ?>">
                    <span class="validation-color" id="err_mode_of_transport"><?php echo form_error('mode_of_transport'); ?></span>
                  </div>
                  <div class="form-group">
                    <label for="transporter_name">Transporter Name<span class="validation-color">*</span></label>
                    <input type="text" class="form-control" id="transporter_name" name="transporter_name" value="<?php echo $row->transporter_name; ?>">
                    <span class="validation-color" id="err_transporter_name"><?php echo form_error('transporter_name'); ?></span>
                  </div>
                  <div class="form-group">
                    <label for="transporter_code">Transporter Code<span class="validation-color">*</span></label>
                    <input type="text" class="form-control" id="transporter_code" name="transporter_code" value="<?php echo $row->transporter_code; ?>">
                    <span class="validation-color" id="err_transporter_code"><?php echo form_error('transporter_code'); ?></span>
                  </div>
                  <div class="form-group">
                    <label for="vehicle_regn_no">Vehicle Regn No.<span class="validation-color">*</span></label>
                    <input type="text" class="form-control" id="vehicle_regn_no" name="vehicle_regn_no" value="<?php echo $row->vehicle_regn_no; ?>">
                    <span class="validation-color" id="err_vehicle_regn_no"><?php echo form_error('vehicle_regn_no'); ?></span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="well well-small">
                    <h4>Shipping Address</h4><br>
                  <div class="form-group">
                      <label for="country"><!-- Country --> 
                          <?php echo $this->lang->line('biller_lable_country'); ?> <span class="validation-color">*</span></label>
                      <select class="form-control select2" id="country" name="country" style="width: 100%;">
                        <option value=""><!-- Select -->
                          <?php echo $this->lang->line('add_biller_select'); ?>    
                        </option>
                        <?php
                          foreach ($country as  $key) {
                        ?>
                        <option 
                          value='<?php echo $key->id ?>' 
                          <?php 
                            if(isset($row->shipping_country_id)){
                              if($key->id == $row->shipping_country_id){
                                echo "selected";
                              }
                            } 
                          ?>
                        >
                        <?php echo $key->name; ?>
                        </option>
                        <?php
                          }
                        ?>
                      </select>
                      <span class="validation-color" id="err_country"><?php echo form_error('country'); ?></span>
                    </div>
                  <div class="form-group">
                      <label for="state"><!-- State --> 
                          <?php echo $this->lang->line('add_biller_state'); ?> <span class="validation-color">*</span></label>
                      <select class="form-control select2" id="state" name="state" style="width: 100%;">
                        <option value=""><!-- Select -->
                            <?php echo $this->lang->line('add_biller_select'); ?></option>
                        <?php
                          foreach ($state as  $key) {
                        ?>
                        <option 
                          value='<?php echo $key->id ?>' 
                          <?php 
                            if(isset($row->shipping_state_id)){
                              if($key->id == $row->shipping_state_id){
                                echo "selected";
                              }
                            } 
                          ?>
                        >
                        <?php echo $key->name; ?>
                        </option>
                      <?php
                        }
                      ?>
                      </select>
                      <span class="validation-color" id="err_state"><?php echo form_error('state'); ?></span>
                    </div>
                  <div class="form-group">
                      <label for="city"><!-- City --> 
                          <?php echo $this->lang->line('biller_lable_city'); ?> <span class="validation-color">*</span></label>
                      <select class="form-control select2" id="city" name="city" style="width: 100%;">
                        <option value=""><!-- Select -->
                            <?php echo $this->lang->line('add_biller_select'); ?></option>
                        <?php
                          foreach ($city as  $key) {
                        ?>
                        <option 
                          value='<?php echo $key->id ?>' 
                          <?php 
                            if(isset($row->shipping_city_id)){
                              if($key->id == $row->shipping_city_id){
                                echo "selected";
                              }
                            } 
                          ?>
                        >
                        <?php echo $key->name; ?>
                        </option>
                        <?php
                          }
                        ?>
                      </select>
                      <span class="validation-color" id="err_city"><?php echo form_error('city'); ?></span>
                    </div>
                    <div class="form-group">
                    <label for="address"><!-- Address --> 
                        <?php echo $this->lang->line('add_biller_address'); ?> <span class="validation-color">*</span></label>
                    <textarea class="form-control" id="address" rows="4" name="address"><?php echo $row->shipping_address; ?></textarea>
                    <span class="validation-color" id="err_address"><?php echo form_error('address'); ?></span>
                  </div>
                  </div>
                </div>
                <div class="col-sm-12">
                  <br><br><br><br>
                  <div class="col-sm-2"></div>
                  <div class="col-sm-5">
                    <div class="form-group">
                      <select class="form-control select2" id="product" name="product" style="width: 100%;">
                      <option value=""><?php echo $this->lang->line('purchase_select_product'); ?></option>
                      <?php

                        foreach ($product as $value) {
                          echo "<option value='$value->product_id'".set_select('product_id',$value->product_id).">$value->name ($value->code)</option>";
                        }
                      ?>
                    </select>
                    </div> <!--/form group  -->
                  </div> <!--/col-md-6 -->
                  <div class="col-sm-4">
                    <span class="validation-color" id="err_product"></span>
                  </div>
                </div> <!--/col-md-12 -->
                <div class="col-sm-12">
                  <div class="form-group">
                    <label><?php echo $this->lang->line('purchase_inventory_items'); ?></label>
                    
                    <table class="table items table-striped table-bordered table-condensed table-hover product_table" name="product_data" id="product_data">
                      <thead>
                        <tr>
                          <th style="width: 20px;"><img src="<?php  echo base_url(); ?>assets/images/bin1.png" /></th>
                          <th class="span2"><?php echo $this->lang->line('product_code'); ?></th>
                          <th class="span2"><?php echo $this->lang->line('purchase_product_description'); ?></th>
                          <th class="span2"><?php echo $this->lang->line('product_hsn_sac_code'); ?></th>
                          <th class="span2" width="10%"><?php echo $this->lang->line('product_quantity'); ?></th>
                          <th class="span2"><?php echo $this->lang->line('product_available_quantity'); ?></th>
                          <th class="span2"><?php echo $this->lang->line('product_unit'); ?></th>
                          <th class="span2"><?php echo $this->lang->line('product_price'); ?></th>
                          <th class="span2" width="10%"><?php echo $this->lang->line('sales_total_sales'); ?></th>
                          <th class="span2" width="15%"><?php echo $this->lang->line('header_discount'); ?></th>
                          <th class="span2"><?php echo $this->lang->line('purchase_taxable_value'); ?></th>
                          <th class="span2" width="15%"><?php echo $this->lang->line('header_tax'); ?></th>
                          <th class="span2" width="10%"><?php echo $this->lang->line('purchase_total'); ?>
                        </tr>
                      </thead>
                      <tbody id="product_table_body">
                        <?php
                        $i=0;
                        $tot=0;
                       // $product_data = [];
                        foreach ($items as  $key) {
                        ?>
                        <tr>
                          <td>
                            <a class='deleteRow1'> <img src='<?php  echo base_url(); ?>assets/images/bin3.png' /> </a><input type='hidden' name='id' name='id' value="<?php echo $i ?>"><input type='hidden' name='product_id' name='product_id' value="<?php echo $key->product_id ?>"></td>
                            <td><?php echo $key->code ?></td>
                            <td><?php echo $key->name ?></td>
                            <td><?php echo $key->hsn_sac_code ?></td>
                            <td><input type="number" class="form-control text-center" value="<?php echo $key->quantity ?>" data-rule="quantity" name='qty' id='qty' min="1" max="<?php echo $key->quantity+$key->warehouses_quantity ?>">
                            </td>
                            <td>
                              <?php echo $key->warehouses_quantity ?>
                              <input type="hidden" name="available_quantity" id="available_quantity" value="<?php echo $key->quantity+$key->warehouses_quantity ?>">  
                            </td>
                            <td><?php echo $key->unit ?></td>
                            <td align="right"><input type='hidden' name='price' id='price' value='<?php echo $key->price ?>'><?php echo $key->price ?></td>
                            <td><input type='text' class='form-control text-right' style='' value='<?php echo $key->gross_total ?>' name='linetotal' id='linetotal' readonly>
                            <td align="right">
                              <input type="hidden" id="discount_value" name="discount_value" value="<?php echo $key->discount_value;?>">
                              <input type="hidden" id="hidden_discount" name="hidden_discount" value="<?php echo $key->discount;?>">
                              <div class="form-group">
                                <select class="form-control" id="item_discount" name="item_discount" style="width: 100%;">
                                  <option value=""><?php echo $this->lang->line('product_select'); ?></option>
                                  <?php foreach ($discount as $dis) {
                                  ?>
                                    <option value='<?php echo $dis->discount_id ?>' <?php if($key->discount_id == $dis->discount_id){echo "selected";} ?>><?php echo $dis->discount_name.'('.$dis->discount_value.')' ?></option>
                                  <?php
                                    } 
                                  ?>
                                </select>
                              </div>
                            </td>
                            <td align="right">
                              <span id="taxable_value"><?php echo $key->gross_total - $key->discount ?></span>
                            </td>
                            <td align="right">
                              <input type="hidden" id="tax_value" name="tax_value" value="<?php echo $key->tax_value; ?>">
                              <input type="hidden" id="hidden_tax" name="hidden_tax" value="<?php echo $key->tax ?>">
                              <div class="form-group">
                                <select class="form-control" id="item_tax" name="item_tax" style="width: 100%;">
                                  <option value=""><?php echo $this->lang->line('product_select'); ?></option>
                                  <?php foreach ($tax as $ta) {
                                  ?>
                                    <option value='<?php echo $ta->tax_id ?>' <?php if($key->tax_id == $ta->tax_id){echo "selected";} ?>><?php echo $ta->tax_name ?></option>
                                  <?php
                                    } 
                                  ?>
                                </select>
                              </div>
                            </td>
                            <td align="right">
                              <input type="text" class="form-control text-right" id="product_total" name="product_total" value=" <?php echo $key->gross_total - $key->discount + $key->tax ?>" readonly>
                            </td>
                          </td>
                        </tr>
                        <?php
                            $product_data[$i] = $key->product_id;
                            //array_push($product_data,$product);
                            $i++;
                            $tot += $key->gross_total;
                          }
                          //echo "<pre>";
                          //print_r($product_data);
                          $grandtotal = $row->total;
                          $product = json_encode($product_data);
                        ?>
                      </tbody>
                    </table>
                    
                    <input type="hidden" name="total_value" id="total_value" value='<?php echo $tot; ?>'>
                    <input type="hidden" name="total_discount" id="total_discount" value='<?php echo $row->discount_value; ?>'>
                    <input type="hidden" name="total_tax" id="total_tax" value='<?php echo $row->tax_value; ?>'>
                    <input type="hidden" name="grand_total" id="grand_total" value='<?php echo $row->total; ?>'>
                    <input type="hidden" name="table_data" id="table_data" value='<?php echo $product ?>'>
                    <input type="hidden" name="table_data1" id="table_data1">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                      <tr>
                        <td align="right" width="80%"><?php echo $this->lang->line('purchase_total_value'); ?></td>
                        <td align='right'><?php echo $this->session->userdata('symbol'); ?><span id="totalValue"><?php echo $tot; ?></span></td>
                      </tr>
                      <tr>
                        <td align="right"><?php echo $this->lang->line('purchase_total_discount'); ?> </td>
                        <td align='right'><?php echo $this->session->userdata('symbol'); ?><span id="totalDiscount"><?php echo $row->discount_value; ?></span>
                        </td>
                      </tr>
                      <tr>
                        <td align="right"><?php echo $this->lang->line('purchase_total_tax'); ?> </td>
                        <td align='right'><?php echo $this->session->userdata('symbol'); ?><span id="totalTax"><?php echo $row->tax_value; ?></span>
                        </td>
                      </tr>
                      <tr>
                        <td align="right"><?php echo $this->lang->line('purchase_total'); ?> </td>
                        <td align='right'><?php echo $this->session->userdata('symbol'); ?><span id="grandTotal"><?php echo $row->total; ?></span></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="control-group">                     
                    <div class="controls">
                      <div class="tabbable">
                        <ul class="nav nav-tabs">
                          <li>
                            <a href="#note" data-toggle="tab"><?php echo $this->lang->line('purchase_note'); ?></a>
                          </li>
                          <li class="active"><a href="#internal_note" data-toggle="tab"><?php echo $this->lang->line('sales_internal_note'); ?></a></li>
                        </ul>                           
                        <br>
                          <div class="tab-content">
                            <div class="tab-pane" id="note">
                              <textarea class="col-sm-12 form-control" id="note" name="note" value=""></textarea>
                              <span style="color:red;" id="err_note"></span>
                            </div>
                            <div class="tab-pane active" id="internal_note">
                              <textarea class="col-sm-12 form-control" id="note" name="internal_note" value=""></textarea>
                              <span style="color:red;" id="err_note"></span>
                            </div>
                          </div>
                        </div>
                      </div> <!-- /controls -->       
                  </div> <!-- /control-group -->  
                </div>
                <div class="col-sm-12">
                  <div class="box-footer">
                    <button type="submit" id="submit" class="btn btn-info"><?php echo $this->lang->line('product_update'); ?></button>
                    <span class="btn btn-default" id="cancel" style="margin-left: 2%" onclick="cancel('sales')"><?php echo $this->lang->line('product_cancel'); ?></span>
                  </div>
                </div>
                <?php } ?>
              </form>
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
    $('#client').change(function(){
      var client_id = $(this).val();
      $.ajax({
          url: "<?php echo base_url('sales/getClientData') ?>/"+client_id,
          type: "GET",
          dataType: "JSON",
          data:{
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
          },
          success: function(data){
            $('#country').text('');
            $('#state').text('');
            $('#city').text('');
            $('#err_country').text('');
            $('#err_state').text('');
            $('#err_city').text('');
            for(a=0;a<data['country'].length;a++){
              $('#country').append('<option value="' + data['country'][a].id + '">' + data['country'][a].name+'</option>');
            }
            for(a=0;a<data['state'].length;a++){
              $('#state').append('<option value="' + data['state'][a].id + '">' + data['state'][a].name+'</option>');
            }
            for(a=0;a<data['city'].length;a++){
              $('#city').append('<option value="' + data['city'][a].id + '">' + data['city'][a].name+'</option>');
            }
            $('#country').val(data['data'][0].country_id).attr("selected","selected");
            $('#state').val(data['data'][0].state_id).attr("selected","selected");
            $('#city').val(data['data'][0].city_id).attr("selected","selected");
            $('#address').val(data['data'][0].address);
          }
        });
    });
  });
</script>
<script>
    $('#country').change(function(){
      var id = $(this).val();
      $('#state').html('<option value="">Select</option>');
      $('#city').html('<option value="">Select</option>');
      $.ajax({
          url: "<?php echo base_url('client/getState') ?>/"+id,
          type: "GET",
          dataType: "JSON",
          success: function(data){
            for(i=0;i<data.length;i++){
              $('#state').append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
            }
          }
        });
    });
</script>
<script>
    $('#state').change(function(){
      var id = $(this).val();
      $('#city').html('<option value="">Select</option>');
      $.ajax({
          url: "<?php echo base_url('client/getCity') ?>/"+id,
          type: "GET",
          dataType: "JSON",
          success: function(data){
            for(i=0;i<data.length;i++){
              $('#city').append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
            }
          }
        });
    });
</script>
<script>
$(document).ready(function(){
    var i = <?php echo $i++; ?>;
    var product_data = new Array();
    var counter = <?php echo count($items); ?>;
    $('#warehouse').change(function(){
      $('#product').html('');
      $('#product').html('<option value="">Select Product</option>');
      var warehouse_id = $('#warehouse').val();
      if(warehouse_id != ""){
        $.ajax({
          url: "<?php echo base_url('sales/getProducts') ?>/"+warehouse_id,
          type: "GET",
          dataType: "JSON",
          data:{
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
          },
          success: function(data){
            for(a=0;a<data.length;a++){
              $('#product').append('<option value="' + data[a].product_id + '">' + data[a].name+'  ( '+data[a].code+' )</option>');
            }
          }
        });
      }
    });

    $('#product').change(function(){
      var id = $(this).val();
      var product_id = $('#product').val();
      var warehouse_id = $('#warehouse').val();
      var flag = 0;
      $('#err_product').text('');
      if(warehouse != ""){
        $.ajax({
          url: "<?php echo base_url('sales/getProduct') ?>/"+product_id+"/"+warehouse_id,
          type: "GET",
          dataType: "JSON",
          data:{
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
          },
          success: function(data){
            $("table.product_table").find('input[name^="product_id"]').each(function () {
                    if(data[0].product_id  == +$(this).val()){
                      flag = 1;
                    }
                });
                if(flag == 0){
                  var id = data[0].product_id;
                  var code = data[0].code;
                  var name = data[0].name;
                  var hsn_sac_code = data[0].hsn_sac_code;
                  var price = data[0].price;
                  var tax_id = data[0].tax_id;
                  var tax_value = data[0].tax_value;
                  if(tax_value==null){
                    tax_value = 0;
                  }
                  var product = { "product_id" : id,
                                  "price" : price
                                };
                  product_data[i] = product;

                  length = product_data.length - 1 ;
                
                  var select_discount = "";
                  select_discount += '<div class="form-group">';
                  select_discount += '<select class="form-control select2" id="item_discount" name="item_discount" style="width: 100%;">';
                  select_discount += '<option value="">Select</option>';
                    for(a=0;a<data['discount'].length;a++){
                      select_discount += '<option value="' + data['discount'][a].discount_id + '">' + data['discount'][a].discount_name+'('+data['discount'][a].discount_value +'%)'+ '</option>';
                    }
                  select_discount += '</select></div>';

                  var select_tax = "";
                  select_tax += '<div class="form-group">';
                  select_tax += '<select class="form-control select2" id="item_tax" name="item_tax" style="width: 100%;">';
                  select_tax += '<option value="">Select</option>';
                    for(b=0;b<data['tax'].length;b++){
                      select_tax += '<option value="' + data['tax'][b].tax_id + '">' + data['tax'][b].tax_name+ '</option>';
                    }
                  select_tax += '</select></div>';

                  var newRow = $("<tr>");
                  var cols = "";
                  cols += "<td><a class='deleteRow'> <img src='<?php  echo base_url(); ?>assets/images/bin3.png' /> </a><input type='hidden' name='id' name='id' value="+i+"><input type='hidden' name='product_id' name='product_id' value="+id+"></td>";
                  cols += "<td>"+code+"</td>";
                  cols += "<td>"+name+"</td>";
                  cols += "<td>"+hsn_sac_code+"</td>";
                  cols += "<td>"
                          +"<input type='number' class='form-control text-center' value='0' data-rule='quantity' name='qty"+ counter +"' id='qty"+ counter +"' min='1' max='"+data[0].quantity+"'>"           
                        +"</td>";
                   cols += "<td>"+data[0].quantity
                              +"<input type='hidden' name='available_quantity' id='available_quantity' value='"+data[0].quantity+"'>" 
                        +"</td>";
                  cols += "<td>"+data[0].unit+"</td>";
                   cols += "<td align='right'>" 
                            +"<span id='price'>"
                              +"<input type='hidden' name='price"+ counter +"' id='price"+ counter +"' value='"+price
                            +"'>"+price
                            +"</span>"
                          +"</td>";
                  cols += "<td>"
                            +"<span id='sub_total'>"
                              +"<input type='text' class='form-control' style='' value='0.00' name='linetotal"+ counter +"' id='linetotal"+ counter +"' readonly>"
                            +"</span>"
                          +"</td>";
                  cols += '<td><input type="hidden" id="discount_value" name="discount_value"><input type="hidden" id="hidden_discount" name="hidden_discount">'+select_discount+'</td>';
                  cols += '<td align="right"><span id="taxable_value"></span></td>';
                  cols += '<td><input type="hidden" id="tax_id" name="tax_id" value="'+tax_id+'"><input type="hidden" id="tax_value" name="tax_value" value="'+tax_value+'"><input type="hidden" id="hidden_tax" name="hidden_tax">'+select_tax+'</td>';
                  cols += '<td><input type="text" class="form-control text-right" id="product_total" name="product_total" readonly></td>';
                  cols += "</tr>";
                  counter++;

                  newRow.append(cols);
                  $("table.product_table").append(newRow);
                  var table_data = JSON.stringify(product_data);
                  $('#table_data1').val(table_data);
                  i++;
                }
                else{
                  $('#err_product').text('Product Already Added').animate({opacity: '0.0'}, 2000).animate({opacity: '0.0'}, 1000).animate({opacity: '1.0'}, 2000);
                }
          }
        });
      } // warehouse
      else{
        $('#err_product').text('Please Select Warehouse.').animate({opacity: '0.0'}, 2000).animate({opacity: '0.0'}, 1000).animate({opacity: '1.0'}, 2000);      
      }
    }); //product
    
    $("table.product_table").on("click", "a.deleteRow", function (event) {
        deleteRow($(this).closest("tr"));
        $(this).closest("tr").remove();
        calculateGrandTotal();
    });

    $("table.product_table").on("click", "a.deleteRow1", function (event) {
        deleteRow1($(this).closest("tr"));
        $(this).closest("tr").remove();
        calculateGrandTotal();
    });

    function deleteRow(row){
      var id = +row.find('input[name^="id"]').val();
      //var array_id = product_data[id].product_id;
      product_data.splice(id, 1);
      var table_data = JSON.stringify(product_data);
      $('#table_data1').val(table_data);
    }

    function deleteRow1(row){
      var id = +row.find('input[name^="id"]').val();
      product_data[id] = 'delete';
      var table_data = JSON.stringify(product_data);
      $('#table_data1').val(table_data);
    }

    $("table.product_table").on("change", 'input[name^="price"], input[name^="qty"]', function (event) {
        var tax_id = $(this).closest("tr").find('input[name^="tax_id"]').val();
        var tax_id_value = $(this).closest("tr").find('#item_tax').val();
        if(tax_id_value == ""){
          $(this).closest("tr").find('select[name^="item_tax"]').val(tax_id).attr("selected","selected");
        }
        calculateRow($(this).closest("tr"));
        calculateDiscountTax($(this).closest("tr"));
        calculateGrandTotal();
    });

    $("table.product_table").on("change",'#item_discount',function (event) {
      var row = $(this).closest("tr");
      var discount = +row.find('#item_discount').val();
      if(discount != ""){
        $.ajax({
          url: '<?php echo base_url('purchase/getDiscountValue/') ?>'+discount,
          type: "GET",
          data:{
            '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
          },
          datatype: JSON,
          success: function(value){
            data = JSON.parse(value);
            row.find('#discount_value').val(data[0].discount_value);
            calculateRow(row);
            calculateDiscountTax(row,data[0].discount_value);
            calculateGrandTotal();
          }
        });
      }
      else{
        row.find('#discount_value').val('0');
        calculateRow(row);
        calculateDiscountTax(row,0);
        calculateGrandTotal();
      }
    });
    $("table.product_table").on("change",'#item_tax',function (event) {
      var row = $(this).closest("tr");
      var tax = +row.find('#item_tax').val();
      if(tax != ""){
        $.ajax({
          url: '<?php echo base_url('purchase/getTaxValue/') ?>'+tax,
          type: "GET",
          data:{
            '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
          },
          datatype: JSON,
          success: function(value){
            data = JSON.parse(value);
            row.find('#tax_value').val(data[0].purchase_tax_value);
            calculateRow(row);
            calculateDiscountTax(row,0,data[0].purchase_tax_value);
            calculateGrandTotal();
          }
        });
      }
      else{
        row.find('#tax_value').val('0');
        calculateRow(row);
        calculateDiscountTax(row,0,0);
        calculateGrandTotal();
      }
    });

    function calculateDiscountTax(row,data = 0,data1 = 0){
      var discount;
      var tax;
      if(data == 0 ){
        discount = +row.find('#discount_value').val();
      }
      else{
        discount = data;
      }
      if(data1 == 0 ){
        tax = +row.find('#tax_value').val();
      }
      else{
        tax = data1;
      }
      var sales_total = +row.find('input[name^="linetotal"]').val();
      var total_discount = sales_total*discount/100;
      var taxable_value = sales_total - total_discount;
      row.find('#taxable_value').text(taxable_value);
      var total_tax = taxable_value*tax/100;
      row.find('#product_total').val(taxable_value + total_tax);

      row.find('#hidden_discount').val(total_discount);
      row.find('#hidden_tax').val(total_tax);

      var key = +row.find('input[name^="id"]').val();
      product_data[key].discount = total_discount;
      product_data[key].discount_value = +row.find('#discount_value').val();
      product_data[key].discount_id = +row.find('#item_discount').val();
      product_data[key].tax = total_tax;
      product_data[key].tax_value = +row.find('#tax_value').val();
      product_data[key].tax_id = +row.find('#item_tax').val();
      var table_data = JSON.stringify(product_data);
      $('#table_data1').val(table_data);
    }
    
    function calculateRow(row) {
      var key = +row.find('input[name^="id"]').val();
      var price = +row.find('input[name^="price"]').val();
      var qty = +row.find('input[name^="qty"]').val();
      var product_id = +row.find('input[name^="product_id"]').val();
      row.find('input[name^="linetotal"]').val((price * qty).toFixed(2));
      if(product_data[key]==null){
        var temp = {
          "product_id" : product_id,
          "price" : price,
          "quantity" : qty,
          "total" : (price * qty).toFixed(2)
        };
        product_data[key] = temp;
      }
      product_data[key].quantity = qty;
      product_data[key].total = (price * qty).toFixed(2);
      var table_data = JSON.stringify(product_data);
      $('#table_data1').val(table_data);
    }
    function calculateGrandTotal() {
      var totalValue = 0;
      var totalDiscount = 0;
      var grandTax = 0;
      var grandTotal = 0;
      $("table.product_table").find('input[name^="linetotal"]').each(function () {
        totalValue += +$(this).val();
      });
      $("table.product_table").find('input[name^="hidden_discount"]').each(function () {
        totalDiscount += +$(this).val();
      });
      $("table.product_table").find('input[name^="hidden_tax"]').each(function () {
        grandTax += +$(this).val();
      });
      $("table.product_table").find('input[name^="product_total"]').each(function () {
        grandTotal += +$(this).val();
      });
      $('#totalValue').text(totalValue);
      $('#total_value').val(totalValue);
      $('#totalDiscount').text(totalDiscount.toFixed(2));
      $('#total_discount').val(totalDiscount.toFixed(2));
      $('#totalTax').text(grandTax.toFixed(2));
      $('#total_tax').val(grandTax.toFixed(2));
      $('#grandTotal').text(grandTotal.toFixed(2));
      $('#grand_total').val(grandTotal.toFixed(2));
    }
});

</script>

<!-- datepicker  -->
<script src="<?php echo base_url('assets/jquery/jquery-3.1.1.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
<script type="text/javascript">
$(document).ready(function() {
    //datepicker
    $('.datepicker').datepicker({
        autoclose: true,
        format: "yyyy-mm-dd",
        todayHighlight: true,
        orientation: "auto",
        todayBtn: true,
        todayHighlight: true,  
    });

});
</script>
<!-- close datepicker  -->


<script>
  $(document).ready(function(){

    $("#submit").click(function(event){
      var name_regex = /^[a-zA-Z]+$/;
      var sname_regex = /^[a-zA-Z0-9]+$/;
      var num_regex = /^[0-9]+$/;
      var date_regex = /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
      var date = $('#date').val();
      var reference_no = $('#reference_no').val();
      var warehouse = $('#warehouse').val();
      var biller = $('#biller').val();
      var product = $('#product').val();
      var cusomer = $('#cusomer').val();
      var discount = $('#discount').val();
      var note = $('#note').val();
      var internal_note = $('#internal_note').val();
      var grand_total = $('#grand_total').val();
      

        if(date==null || date==""){
          $("#err_date").text("Please Enter Date");
          $('#date').focus();
          return false;
        }
        else{
          $("#err_date").text("");
        }
        if (!date.match(date_regex) ) {
          $('#err_code').text(" Please Enter Valid Date ");   
          $('#date').focus();
          return false;
        }
        else{
          $("#err_code").text("");
        }
//date codevalidation complite.

        if(warehouse==""){
          $("#err_warehouse").text("Please Enter Warehouse");
          $('#warehouse').focus();
          return false;
        }
        else{
          $("#err_warehouse").text("");
        }
//warehouse code validation complite.

        if(biller==""){
          $("#err_biller").text("Please Enter Biller");
          $('#biller').focus();
          return false;
        }
        else{
          $("#err_biller").text("");
        }
//biller code validation complite.

         if(client==""){
          $("#err_client").text("Please Enter Client");
          $('#client').focus();
          return false;
        }
        else{
          $("#err_client").text("");
        }
//client code validation complite.
      
         if(discount==""){
          $("#err_discount").text("Please Enter Discount");
          $('#discount').focus();
          return false;
        }
        else{
          $("#err_discount").text("");
        }
//discount code validation complite.

        if(grand_total=="" || grand_total==null || grand_total==0.00){;
          $("#err_product").text("Please Select Product");
          $('#product').focus();
          return false;
        }

    }); 

    $("#date").blur(function(event){
      var date = $('#date').val(); 
      var date_regex = /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
      if(date==null || date==""){
          $("#err_date").text("Please Enter Date");
          $('#date').focus();
          return false;
        }
        else{
          $("#err_date").text("");
        }
        if (!date.match(date_regex) ) {
          $('#err_code').text(" Please Enter Valid Date ");   
          $('#date').focus();
          return false;
        }
        else{
          $("#err_code").text("");
        }
    });
    
    $("#warehouse").change(function(event){
      var warehouse = $('#warehouse').val();
      var warehouse_change = $("#warehouse_change").val();
      $('#warehouse_change').val('yes');
      $('#product_table_body').empty();
      $('#table_data1').val('clear');
      $('#last_total').val('');
      $('#grand_total').val('');
      $('#grandtotal').text('0.00');
      $('#totaldiscount').text('0.00');
      $('#lasttotal').text('0.00');
      if(warehouse=="Select"){
        $("#err_warehouse").text("Please Enter Warehouse");
        $('#warehouse').focus();
        return false;
      }
      else{
        $("#err_warehouse").text("");
      }
    });
    $("#biller").change(function(event){
      var biller = $('#biller').val();
      if(biller==""){
        $("#err_biller").text("Please Enter Biller");
        $('#biller').focus();
        return false;
      }
      else{
        $("#err_biller").text("");
      }
    });
    $("#client").change(function(event){
      var client = $('#client').val();
      if(client==""){
        $("#err_client").text("Please Enter Client");
        $('#client').focus();
        return false;
      }
      else{
        $("#err_client").text("");
      }
    });
    $("#discount").change(function(event){
      var discount = $('#discount').val();
      if(discount==""){
        $("#err_discount").text("Please Enter Discount");
        $('#discount').focus();
        return false;
      }
      else{
        $("#err_discount").text("");
      }
      if(discount!=""){
        $.ajax({
          url: "<?php echo base_url('sales/getDiscountAjax') ?>/"+discount,
          type: "get",
          dataType: "json",
          success: function(data){
            //alert(data[0].discount_id);
            var type = data[0].discount_type;
            var value = data[0].discount_value;
            var amount = parseInt(data[0].amount);
            var grand_total = $('#grand_total').val();
            $('#discount_type').val(type);
            $('#total_discount').val(value);
            $('#discount_amount').val(amount);
            if(grand_total > 0 && grand_total!=null){
              if(type == "Fixed"){
                var t = grand_total - value;
                if(grand_total < amount){
                  var t = grand_total;
                }  
                $('#lasttotal').text(t);
                $('#last_total').val(t);
                $('#totaldiscount').text(value);
                $('#total_discount').val(value);
                $('#discount_type').val(type);
                $('#discount_amount').val(amount);
                $('#showdiscount').text(" (Rs "+value+")");
              }
              else{
                var total = (grand_total*value)/100;
                var t = grand_total - total;
                $('#totaldiscount').text(total);
                $('#total_discount').val(value);
                $('#discount_type').val('');
                $('#discount_amount').val('');
                $('#lasttotal').text(t);
                $('#last_total').val(t);
                $('#showdiscount').text(" ("+value+"%)");
              }
            }
          }
        });
      }
    });
    $("#product").blur(function(event){
      var sname_regex = /^[a-zA-Z0-9]+$/;
      var product = $('#product').val();
      if(product==null || product==""){
        $("#err_product").text("Please Enter Product Code/Name");
        $('#product').focus();
        return false;
      }
      else{
        $("#err_product").text("");
      }
      if (!date.match(sname_regex) ) {
        $('#err_product').text(" Please Enter Valid Product Code/Name ");  
        $('#product').focus(); 
        return false;
      }
      else{
        $("#err_product").text("");
      }
    });

  }); 
</script>