<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','purchaser','manager');
if(!(in_array($this->session->userdata('type'),$p))){
  redirect('auth');
}
$this->load->view('layout/header');
?>

<style type="text/css">
  div.processCls, div.voucher_no, div.bank_name, div.receive_date, div.receipt_no{
    display: none;
  }
</style>

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
        <li><a href="<?php echo base_url('purchase'); ?>" class="text-black"><strong><?php echo $this->lang->line('header_purchase'); ?></strong></a></li>
        <li class="active"><?php echo $this->lang->line('purchase_edit_purchase'); ?></li>
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
            <h3 class="box-title"><?php echo $this->lang->line('purchase_edit_purchase'); ?></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <form role="form" id="form" method="post" action="<?php echo base_url('purchase/editPurchase');?>">
                <?php foreach($data as $row){?>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="date"><?php echo $this->lang->line('purchase_date'); ?><span class="validation-color">*</span></label>
                    <input type="text" class="form-control datepicker" id="date" name="date" value="<?php echo $row->date;?>">
                    <input type="hidden" name="purchase_id" value="<?php echo $row->purchase_id;?>">
                    <span class="validation-color pull-right" id="err_date"><?php echo form_error('date'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="reference_no"><?php echo $this->lang->line('purchase_reference_no'); ?></label>
                    <input type="text" class="form-control" id="reference_no" name="reference_no" value="<?php echo $row->reference_no;?>" readonly>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-6" style="padding-left: 0">
                      <label for="ship_mode">
                        Shipping Mode <span class="validation-color">*</span>
                      </label><br>

                      <input type="radio" name="ship_mode" id="air" class="shippingCls" value="Air" <?php if($row->ship_mode == 'Air') {?> checked <?php }?> required> Air &emsp;
                      <input type="radio" name="ship_mode" id="courier" class="shippingCls" value="Courier" <?php if($row->ship_mode == 'Courier') {?>checked <?php }?> required> Courier &emsp;
                      <input type="radio" name="ship_mode" id="sea" class="shippingCls" value="Sea" <?php if($row->ship_mode == 'Sea') {?> checked <?php }?> required> Sea &emsp;
                      <input type="radio" name="ship_mode" id="road" class="shippingCls" value="Road" <?php if($row->ship_mode == 'Road') {?> checked <?php }?> required> Road &emsp;

                      <br>
                      <span class="validation-color" id="err_ship_mode"></span>
                    </div>

                    <div class="col-sm-6" style="padding-right: 0">
                      <label for="currency">
                        Currency <span class="validation-color">*</span>
                      </label><br>

                      <select class="form-control" name="currency" id="currency" style="width: 100%;">
                        <option value="">Select Currency</option>
                        <?php
                          foreach ($currency as $curr) { ?>
                            <option value="<?php echo $curr->id . '|' . $curr->name; ?>" <?php if($curr->id == $row->currency_id){ ?> selected <?php }?>><?php echo $curr->name; ?></option>
                          <?php 
                          }
                          ?>
                      </select>

                      <span class="validation-color" id="err_currency"><?php echo form_error('currency'); ?></span>
                    </div>
                  </div>

                  <br><br><br><br>

                  <div class="form-group processCls">
                    <div class="col-sm-3 type" style="padding-left: 0">
                      <label for="type">
                        Courier Type <span class="validation-color">*</span>
                      </label><br>
          
                      <select class="form-control select2" name="type" id="type" style="width: 100%;">
                        <option value="">Select Courier Type</option>
                        <?php
                          foreach ($couriers as $val) { ?>
                            <option <?php if($val->courier_id == $row->type){ ?> selected <?php }?> value="<?php echo $val->courier_id; ?>"><?php echo $val->courier_name; ?></option>
                        <?php 
                          }
                        ?>
                      </select>
                      <span class="validation-color" id="err_type"></span>
                    </div>

                    <div class="freight_charge" style="padding-left: 0">
                      <label for="freight_charge">
                        Freight Charge 
                      </label><br>

                      <input type="number" name="freight_charge" id="freight_charge" class="form-control" placeholder="Insert Charge" value="<?php echo $row->freight_charge; ?>">
                      <span class="validation-color" id="err_freight_charge"></span>
                    </div>

                    <div class="custom_charge" style="padding-left: 0">
                      <label for="custom_charge">
                        Custom Duty Charge 
                      </label><br>

                      <input type="number" name="custom_charge" id="custom_charge" class="form-control" placeholder="Insert Charge" value="<?php echo $row->custom_charge; ?>">
                      <span class="validation-color" id="err_custom_charge"></span>
                    </div>

                    <div class="method" style="padding-right: 0">
                      <label for="method">
                        Payment Method <span class="validation-color">*</span>
                      </label><br>

                      <select class="form-control select2" name="method" id="method" style="width: 100%;">
                        <option value="">Select Payment Method</option>
                        <option value="COD" <?php if($row->method == 'COD'){ ?> selected <?php }?>>Cash on Delivery</option>
                        <option value="Bank" <?php if($row->method == 'Bank'){ ?> selected <?php }?>>Bank</option>
                        <option value="Cheque" <?php if($row->method == 'Cheque'){ ?> selected <?php }?>>Cheque</option>
                      </select>
                      <span class="validation-color" id="err_method"></span>
                    </div>

                    <br><br><br><br>

                    <div class="col-sm-6" style="padding-left: 0">
                    </div>

                    <div class="col-sm-6 voucher_no" style="padding-right: 0">
                      <label for="voucher_no">
                        Voucher No. <span class="validation-color">*</span>
                      </label><br>
                    
                      <input type="text" name="voucher_no" id="voucher_no" class="form-control" placeholder="Insert Voucher No." value="<?php echo $row->voucher_no; ?>">
                      <span class="validation-color" id="err_voucher_no"></span>
                    </div>

                    <div class="col-sm-6 bank_name" style="padding-right: 0">
                      <label for="bank_name">
                        Bank Name
                      </label><br>
                    
                      <input type="text" name="bank_name" id="bank_name" class="form-control" placeholder="Insert Bank Name" value="<?php echo $row->bank_name; ?>">
                      <span class="validation-color" id="err_bank_name"></span>
                    </div>

                    <div class="col-sm-3 receive_date">
                      <label for="receive_date">
                        Receive Date
                      </label><br>

                      <input type="text" name="receive_date" id="receive_date" class="form-control datepicker" placeholder="Insert Date" value="<?php echo $row->receive_date; ?>">
                      <span class="validation-color" id="err_receive_date"></span>
                    </div>

                    <div class="col-sm-3 receipt_no" style="padding-right: 0">
                      <label for="receipt_no">
                        Cheque No.
                      </label><br>

                      <input type="text" name="receipt_no" id="receipt_no" class="form-control" placeholder="Insert Receipt No." value="<?php echo $row->receipt_no; ?>">
                      <span class="validation-color" id="err_receipt_no"></span>
                    </div>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="client">
                      Manufacturer / Supplier <span class="validation-color">*</span>
                    </label>

                    <select class="form-control select2" id="client" name="client_id" style="width: 100%;">
                      <option value="">Select Manufacturer / Supplier</option>
                      <?php
                        foreach ($client as $key){ 
                          if($key->client_type_id == 2){ $cus_type = 'Manufacturer'; }
                          elseif($key->client_type_id == 3){ $cus_type = 'Supplier'; }
                          else { $cus_type = 'Manufacturer & Supplier'; }
                      ?>
                          <option value="<?php echo $key->client_id ?>" <?php if($key->client_id == $row->client_id){ ?> selected <?php }?>><?php echo $key->company_name . ' [' . $cus_type . ']'; ?></option>
                      <?php  
                        }
                      ?>
                    </select>
                    <span class="validation-color" id="err_client"><?php echo form_error('client'); ?></span>
                  </div>

                  <?php 
                    foreach ($users as $key => $value) {
                      if($value->emp_id == $row->emp_id){
                        $receiver_name = $value->first_name . ' ' . $value->last_name;
                        $receiver_phone = $value->phone;

                        break;
                      }
                    }
                  ?>

                  <div class="form-group">
                    <label for="receiver_name"> 
                      Receiver Name 
                    </label>

                    <input type="text" name="receiver_name" id="receiver_name" class="form-control" value="<?php echo $receiver_name; ?>" readonly>
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="receiver_id">
                      Receiver ID
                    </label><br>

                    <input type="text" name="receiver_id" id="receiver_id" class="form-control" value="<?php echo $row->emp_id; ?>" readonly>
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label for="receiver_phone">
                      Receiver Phone
                    </label><br>

                    <input type="text" name="receiver_phone" id="receiver_phone" class="form-control" value="<?php echo $receiver_phone; ?>" readonly>
                  </div>
                </div>

                <div class="col-sm-12">
                  <br><br><br><br>
                  <div class="col-sm-4"></div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <label for="product">
                        Product <span class="validation-color">*</span>
                      </label>

                      <select class="form-control select2" id="product" name="product" style="width: 100%;">
                        <option value="">Select Product</option>
                        <?php 
                          $sql = "SELECT * FROM products WHERE client_id LIKE '%$row->client_id%'";
                          $data = $this->db->query($sql,array($row->client_id));
                          $result = $data->result();
                        
                          foreach ($result as $list) { 
                        ?>
                            <option value="<?php echo $list->product_id ?>"><?php echo $list->name; ?></option>
                        <?php 
                          } 
                        ?>
                      </select>
                      <span class="validation-color" id="err_product"><?php echo form_error('product'); ?></span>
                    </div> <!--/form group  -->
                  </div> <!--/col-md-6 -->
                  <div class="col-sm-4"></div>
                </div>
                
                <div class="col-sm-12">
                  <div class="form-group">
                    <label><?php echo $this->lang->line('purchase_inventory_items'); ?></label>
                    <div style="overflow-y: auto;">
                      <table class="table items table-striped table-bordered table-condensed table-hover product_table" name="product_data" id="product_data">
                        <thead>
                          <tr>
                            <th width="5%"><img src="<?php  echo base_url(); ?>assets/images/bin1.png" /></th>
                            <th class="span2"><?php echo $this->lang->line('product_code'); ?></th>
                            <th class="span2"><?php echo $this->lang->line('purchase_product_description'); ?></th>
                            <th class="span2" width="10%">FOC</th>
                            <th class="span2" width="15%">Inventory</th>
                            <th class="span2" width="10%"><?php echo $this->lang->line('product_quantity'); ?></th>
                            <th class="span2" width="10%"><?php echo $this->lang->line('product_available_quantity'); ?></th>
                            <th class="span2" width="10%"><?php echo $this->lang->line('product_price'); ?> (<span id="span_currency"><?php if($row->currency_id == 1){ echo '$';} else{ echo '৳'; } ?></span>)</th>
                            <th class="span2" width="10%"> Total (<span id="span_currency2"><?php if($row->currency_id == 1){ echo '$';} else{ echo '৳'; } ?></span>) </th> 
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $i=0;
                          $tot=0;
                          foreach ($items as $key) {
                            ?>
                            <tr>
                              <td>
                                <a class='deleteRow1'> <img src='<?php  echo base_url(); ?>assets/images/bin3.png' /> </a><input type='hidden' name='id' name='id' value="<?php echo $i ?>"><input type='hidden' name='product_id' name='product_id' value="<?php echo $key->product_id ?>"></td>
                                <td><?php echo $key->code; ?></td>
                                <td><?php echo $key->name; ?></td>
                                <td><input type="checkbox" id="fop" name="fop" <?php if($key->fop_status == 1){ ?>checked<?php }?>></td>
                                <td>
                                  <div class="form-group">
                                    <select required class="form-control" id="item_shelf" name="item_shelf" style="width: 100%;">
                                      <?php 
                                        $this->db->select('*');
                                        $shelfs = $this->db->get('shelf')->result();
                                      
                                        foreach ($shelfs as $shelf){
                                      ?>
                                          <optgroup label="<?php echo $shelf->shelf_name; ?>">
                                            <?php 
                                              $shelf_id = $shelf->shelf_id;
                                              $this->db->select('*');
                                              $racks = $this->db->get('rack')->result();

                                              foreach ($racks as $rack){
                                                $rack_id = $rack->rack_id;
                                                if($rack->shelf_id == $shelf_id){
                                            ?>
                                                  <option value="<?php echo $shelf_id . '0.1' . $rack_id; ?>" <?php if($shelf_id == $key->shelf_id && $rack_id == $key->rack_id){ ?>selected<?php }?>><?php echo $rack->rack_name; ?></option>
                                            <?php
                                                }
                                              }
                                            ?>
                                          </optgroup>
                                      <?php
                                        }
                                      ?>
                                    </select>
                                  </div>
                                </td>
                                <td><input type="number" class="form-control text-right" value="<?php echo $key->quantity ?>" data-rule="quantity" name='qty' id='qty' min="1">
                                </td>
                                <td>
                                  <?php 
                                    $sql = "SELECT *, SUM(quantity) AS pQuantity, SUM(ck_out_qty) AS ckoQuantity, SUM(ck_in_qty) AS ckiQuantity FROM inventory WHERE product_id = '$key->product_id' GROUP BY product_id";
                                    $quantity = $this->db->query($sql,array($key->product_id))->row()->pQuantity;
                                    $ck_out_qty = $this->db->query($sql,array($key->product_id))->row()->ckoQuantity;
                                    $ck_in_qty = $this->db->query($sql,array($key->product_id))->row()->ckiQuantity;
                                    $product_quantity = ($quantity - $ck_out_qty) + $ck_in_qty;
                                  ?>
                                  <input type="number" class="form-control text-right" style="" value="<?php echo $product_quantity; ?>" name="" id="" readonly>
                                </td>
                                <td><input type="number" class="form-control text-right" name="price" id="price" value="<?php echo $key->cost; ?>"></td>
                                <td><input type="number" class="form-control text-right" style="" value="<?php echo $key->gross_total ?>" name="linetotal" id="linetotal" readonly></td>
                                <!-- <td align="right">
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
                                </td> -->
                                <!-- <td align="right">
                                  <span id="taxable_value"><?php echo $key->gross_total - $key->discount ?></span>
                                </td> -->
                                <!-- <td align="right">
                                  <input type="hidden" id="tax_value" name="tax_value" value="<?php echo $key->tax_value; ?>">
                                  <input type="hidden" id="hidden_tax" name="hidden_tax" value="<?php echo $key->tax; ?>">
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
                                </td> -->
                                <!-- <td align="right">
                                  <input type="text" class="form-control text-right" id="product_total" name="product_total" value=" <?php echo $key->gross_total - $key->discount + $key->tax ?>" readonly>
                                </td> -->
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
                          //$product = json_encode($product_data);
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
                          <td align='right'><span id="span_currency3"><?php if($row->currency_id == 1){ echo '$';} else{ echo '৳'; } ?></span><span id="totalValue"><?php echo $tot; ?></span></td>
                          <input type="hidden" name="total_value2" id="total_value2"></td>
                          <input type="hidden" name="totalValue" value="<?php echo $tot; ?>" id="totalValue"></td>
                        </tr>
                        <!-- <tr>
                          <td align="right"><?php echo $this->lang->line('purchase_total_discount'); ?></td>
                          <td align='right'>
                            <?php echo $this->session->userdata('symbol'); ?><span id="totalDiscount"><?php echo $row->discount_value; ?></span>
                          </td>
                        </tr>
                        <tr>
                          <td align="right"><?php echo $this->lang->line('purchase_total_tax'); ?></td>
                          <td align='right'>
                            <?php echo $this->session->userdata('symbol'); ?><span id="totalTax"><?php echo $row->tax_value; ?></span>
                          </td>
                        </tr> -->
                        <tr>
                         <!--  <td align="right"><?php echo $this->lang->line('purchase_total'); ?></td> -->
                         <!-- <td align='right'><?php echo $this->session->userdata('symbol'); ?><span id="grandTotal"><?php echo $row->total; ?></span></td> -->
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="details"><?php echo $this->lang->line('purchase_note'); ?></label>
                    <textarea class="form-control" id="note" name="note"><?php echo $row->note;?></textarea>
                    <span class="validation-color" id="err_details"><?php echo form_error('details'); ?></span>
                  </div>
                </div>

                <div class="col-sm-12">
                  <div class="box-footer">
                    <button type="submit" id="submit" class="button btn bg-gray">
                      <span class="submit" style="left: 16%">Update</span>
                      <span class="loading" style="left: 32%"><i class="fa fa-circle-o-notch"></i></span>
                    </button>
                    <span class="btn btn-danger" id="cancel" style="margin-left: 2%" onclick="cancel('purchase')"><?php echo $this->lang->line('product_cancel'); ?></span>
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
      <!-- /.col -->
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
  $('#client').change(function(){
    var id = $(this).val();
    $('#product').html('<option value="">Select Product</option>');
    $.ajax({
        url: "<?php echo base_url('purchase/getProductList') ?>/"+id,
        type: "GET",
        dataType: "JSON",
        success: function(data){
          //console.log(data);
          for(i=0;i<data.length;i++){
            $('#product').append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
          }
        }
    });
  });

  $('#currency').change(function(){
    var symbol = $(this).val().split('|')[1];
    if(symbol == 'BDT'){
      symbol = '‎৳';
    }
    else{
      symbol = '$';
    }

    $('#span_currency').text(symbol);
    $('#span_currency2').text(symbol);
    $('#span_currency3').text(symbol);
  });
</script>

<script>
  $(document).ready(function(){
    var i = <?php echo $i++; ?>;
    var product_data = new Array();
    var counter = <?php echo count($items); ?>;

    $('#product').change(function(){
      var id = $('#product').val();
      $('#err_product').text('');
      var flag = 0;
      if(id != ""){
        $.ajax({
          url: "<?php echo base_url('purchase/getProductAjax') ?>/"+id,
          type: "GET",
          data:{
            '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
          },
          datatype: "JSON",
          success: function(d){
            data = JSON.parse(d);
            $("table.product_table").find('input[name^="product_id"]').each(function () {
              if(data[0].product_id  == +$(this).val()){
                flag = 1;
              }
            });
            if(flag == 0){
              var id = data[0].product_id;
              var code = data[0].code;
              var name = data[0].name;
              var price = data[0].cost;
              var product = { "product_id" : id, "cost" : price };
            
              product_data[i] = product;

              var select_discount = "";
              select_discount += '<div class="form-group">';
              select_discount += '<select class="form-control select2" id="item_discount" name="item_discount" style="width: 100%;">';
              select_discount += '<option value="">Select</option>';
              for(a=0;a<data['discount'].length;a++){
                select_discount += '<option value="' + data['discount'][a].discount_id + '">' + data['discount'][a].discount_name+'('+data['discount'][a].discount_value +'%)'+ '</option>';
              }
              select_discount += '</select></div>';

              var select_shelf = "";
              select_shelf += '<div class="form-group">';
              select_shelf += '<select required class="form-control select2" id="item_shelf" name="item_shelf" style="width: 100%;">';
                
                var shelf_id;
                var rack_id;
                for(b=0;b<data['shelf'].length;b++){
                  select_shelf += '<optgroup label="' + data['shelf'][b].shelf_name + '">';
                    shelf_id = data['shelf'][b].shelf_id;
                    for(c=0;c<data['rack'].length;c++){
                      if(data['rack'][c].shelf_id == shelf_id){
                        select_shelf += '<option value="' + (shelf_id.concat(.1, data['rack'][c].rack_id)) + '">' + data['rack'][c].rack_name + '</option>';
                      }
                    }
                  select_shelf += '</optgroup>';
                }
              select_shelf += '</select></div>';

              var newRow = $("<tr>");
              var cols = "";
              cols += "<td><a class='deleteRow'> <img src='<?php  echo base_url(); ?>assets/images/bin3.png' /> </a><input type='hidden' name='id' name='id' value="+i+"><input type='hidden' name='product_id' name='product_id' value="+id+"></td>";
              cols += "<td>"+code+"</td>";
              cols += "<td>"+name+"</td>";
              cols += "<td><input type='checkbox' id='fop' name='fop' ></td>";
              cols += "<td><input type='hidden' id='shelf_value' name='shelf_value'><input type='hidden' id='hidden_shelf' name='hidden_shelf'>"+select_shelf+"</td>";
              cols += "<td>"
              +"<input type='number' class='form-control text-right' value='0' data-rule='quantity' min='1' name='qty"+ counter +"' id='qty"+ counter +"' >"
              +"</td>";
              cols += "<td>"
              +"<span id='product_available_quantity'>"
              +"<input type='number' class='form-control text-right' style='' value='"+ ((data[0].pQuantity - data[0].ckoQuantity) + +data[0].ckiQuantity) +"' name='' id='' readonly>"
              +"</span>"
              +"</td>";
              cols += "<td align='right'>" 
              +"<span id='price'>"
              +"<input type='number' class='form-control text-right' name='price"+ counter +"' id='price"+ counter +"' value='0.00'></span>"
              +"</td>";
              cols += "<td>"
              +"<span id='sub_total'>"
              +"<input type='number' class='form-control text-right' style='' value='0.00' name='linetotal"+ counter +"' id='linetotal"+ counter +"' readonly>"
              +"</span>"
              +"</td>";

              /*cols += '<td><input type="hidden" id="discount_value" name="discount_value"><input type="hidden" id="hidden_discount" name="hidden_discount">'+select_discount+'</td>';
              cols += '<td align="right"><span id="taxable_value"></span></td>';
              cols += '<td><input type="hidden" id="tax_value" name="tax_value"><input type="hidden" id="hidden_tax" name="hidden_tax">'+select_tax+'</td>';
              cols += '<td><input type="text" class="form-control text-right" id="product_total" name="product_total" readonly></td>';*/

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
          },
          error: function(xhr, status, error) {
            $('#err_product').text('Enter Product Code / Name').animate({opacity: '0.0'}, 2000).animate({opacity: '0.0'}, 1000).animate({opacity: '1.0'}, 2000);
          }
        });
      }
    });

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

    $("table.product_table").on("keyup", 'input[name^="price"], input[name^="qty"]', function (event) {
      calculateRow($(this).closest("tr"));
      calculateDiscountTax($(this).closest("tr"));
      calculateGrandTotal();
    });

    $("table.product_table").on("change", '#item_shelf',function (event) {
      calculateRow($(this).closest("tr"));
      calculateDiscountTax($(this).closest("tr"));
      calculateGrandTotal();
    });

    $("table.product_table").on("change", 'input[id^="fop"]',function (event) {
      makeDisable($(this).closest("tr"));
    });

    function makeDisable(row){
      var fop = +row.find('input[id^="fop"]').is(':checked');
      
      if(fop){
        var zero = 0;
        +row.find('input[id^="price"]').attr('readonly', 'true');
        row.find('input[id^="price"]').val(zero.toFixed(2));
        row.find('input[id^="linetotal"]').val(zero.toFixed(2));
        
        calculateRow($(row));
        calculateGrandTotal();
      }
      else{
        +row.find('input[id^="price"]').removeAttr('readonly');
      }
    }

    /*$("table.product_table").on("change",'#item_discount',function (event) {
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
    });*/
    /*$("table.product_table").on("change",'#item_tax',function (event) {
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
    });*/

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
      product_data[key].shelf_value = +row.find('#shelf_value').val();
      product_data[key].shelf_and_rack_id = +row.find('#item_shelf').val();
      var table_data = JSON.stringify(product_data);
      $('#table_data1').val(table_data);
    }

    function calculateRow(row) {
      var key = +row.find('input[name^="id"]').val();
      var fop = +row.find('input[name^="fop"]').is(':checked');
      var price = +row.find('input[name^="price"]').val();
      var shelf_and_rack_id = +row.find('#item_shelf').val();
      var qty = +row.find('input[name^="qty"]').val();
      var product_id = +row.find('input[name^="product_id"]').val();
      row.find('input[name^="linetotal"]').val((price * qty).toFixed(2));
      //alert(key +" "+ price+" "+qty);
      if(product_data[key]==null || product_data[fop]==null){
        var temp = {
          "product_id" : product_id,
          "shelf_and_rack_id" : shelf_and_rack_id,
          "cost" : price,
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
      var totalValue = 0.00;

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
      $('#totalValue').text(totalValue.toFixed(2));
      $('#total_value').val(totalValue.toFixed(2));
      $('#total_value2').val(totalValue.toFixed(2));
      $('#totalDiscount').text(totalDiscount.toFixed(2));
      $('#total_discount').val(totalDiscount.toFixed(2));
      $('#totalTax').text(grandTax.toFixed(2));
      $('#total_tax').val(grandTax.toFixed(2));
      $('#grandTotal').text(grandTotal.toFixed(2));
      $('#grand_total').val(grandTotal.toFixed(2));
    }
  });
</script>

<script>
  $(document).ready(function(){
    if($("[name='ship_mode']").is(':checked')){ 
      $('.processCls').show();

      if($('#courier').is(':checked')){ 
        $('.type').show();
        $(".freight_charge").addClass("col-sm-3");
        $(".custom_charge").addClass("col-sm-3");
        $(".method").addClass("col-sm-3");
      }
      else { 
        $('.type').hide();
        $(".freight_charge").removeClass("col-sm-3");
        $(".freight_charge").addClass("col-sm-3");
        $(".custom_charge").addClass("col-sm-3");
        $(".method").removeClass("col-sm-3");
        $(".method").addClass("col-sm-6");
      }
    }
    else { 
      $('.processCls').hide();
    }

    var checked_ship_mode = $('input[name="ship_mode"]:checked').val();
    var freight_charge = $('input[name="freight_charge"]').val();
    var custom_charge = $('input[name="custom_charge"]').val();
    var method = $('#method').find(":selected").text();
    var voucher_no = $('input[name="voucher_no"]').val();
    var bank_name = $('input[name="bank_name"]').val();
    var receive_date = $('input[name="receive_date"]').val();
    var receipt_no = $('input[name="receipt_no"]').val();

    $('.shippingCls').click(function(){
      $('.processCls').show();
      
      if($('input[name="ship_mode"]:checked').val() != checked_ship_mode){
        $('input[name="freight_charge"]').val('');
        $('input[name="custom_charge"]').val('');
        $('#method').val("").trigger('change');
        $('input[name="voucher_no"]').val('');
        $('input[name="bank_name"]').val('');
        $('input[name="receive_date"]').val('');
        $('input[name="receipt_no"]').val('');
      }
      else{
        $('input[name="freight_charge"]').val(freight_charge);
        $('input[name="custom_charge"]').val(custom_charge);
        $('#method').val(method).trigger('change');
        $('input[name="voucher_no"]').val(voucher_no);
        $('input[name="bank_name"]').val(bank_name);
        $('input[name="receive_date"]').val(receive_date);
        $('input[name="receipt_no"]').val(receipt_no);
      }

      if($('#courier').is(':checked')){ 
        $('.type').show();
        $(".freight_charge").addClass("col-sm-3");
        $(".custom_charge").addClass("col-sm-3");
        $(".method").addClass("col-sm-3");
      }
      else { 
        $('.type').hide();
        $(".freight_charge").removeClass("col-sm-3");
        $(".freight_charge").addClass("col-sm-3");
        $(".custom_charge").addClass("col-sm-3");
        $(".method").removeClass("col-sm-3");
        $(".method").addClass("col-sm-6");
      }
    });

    var method = $('#method option:selected').val();
    if(method == 'COD'){
      $('.voucher_no').show();
    }
    else { 
      $('.voucher_no').hide();
    }

    if(method == 'Bank'){
      $('.bank_name').show();
    }
    else { 
      $('.bank_name').hide();
    }

    if(method == 'Cheque'){
      $('.receive_date').show();
      $('.receipt_no').show();
    }
    else { 
      $('.receive_date').hide();
      $('.receipt_no').hide();
    }

    $('#method').change(function(){
      if($(this).val() == 'COD'){
        $('.voucher_no').show();
      }
      else{
        $('.voucher_no').hide();
      }

      if($(this).val() == 'Bank'){
        $('.bank_name').show();
      }
      else{
        $('.bank_name').hide();
      }

      if($(this).val() == 'Cheque'){
        $('.receive_date').show();
        $('.receipt_no').show();
      }
      else{
        $('.receive_date').hide();
        $('.receipt_no').hide();
      }
    });

    $('#form').submit(function(){
      var name_regex = /^[a-zA-Z]+$/;
      var sname_regex = /^[a-zA-Z0-9]+$/;
      var num_regex = /^[0-9]+$/;
      var date_regex = /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
      var date = $('#date').val();
      var type = $('#type').val();
      var freight_charge = $('#freight_charge').val();
      var custom_charge = $('#custom_charge').val();
      var method = $('#method').val();
      var voucher_no = $('#voucher_no').val();
      var bank_name = $('#bank_name').val();
      var receive_date = $('#receive_date').val();
      var receipt_no = $('#receipt_no').val();
      var currency = $('#currency').val();
      var client = $('#client').val();
      //var product = $('#product').val();
      //var warehouse = $('#warehouse').val();
      //var supplier = $('#supplier').val();
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
        $('#err_date').text(" Please Enter Valid Date ");   
        $('#date').focus();
        return false;
      }
      else{
        $("#err_date").text("");
      }
      //date codevalidation complite.

      if(!$("[name='ship_mode']").is(':checked')){
        $("#err_ship_mode").text("Select Shipping Mode");
        return false;
      }
      else{
        $("#err_ship_mode").text("");

        if($('#courier').is(':checked')){ 
          if(type==""){
            $("#err_type").text("Select Type");
            $('#type').focus();
            return false;
          }
          else{
            $("#err_type").text("");
          }
        }
        
        if(freight_charge==""){
          $("#err_freight_charge").text("Insert Charge");
          $('#freight_charge').focus();
          return false;
        }
        else{
          $("#err_freight_charge").text("");
        }

        if(custom_charge==""){
          $("#err_custom_charge").text("Insert Charge");
          $('#custom_charge').focus();
          return false;
        }
        else{
          $("#err_custom_charge").text("");
        }

        if(method==""){
          $("#err_method").text("Select Method");
          $('#method').focus();
          return false;
        }
        else{
          $("#err_method").text("");

          if(method == 'COD'){
            if(voucher_no==""){
              $("#err_voucher_no").text("Insert Voucher No.");
              $('#voucher_no').focus();
              return false;
            }
            else{
              $("#err_voucher_no").text("");
            }
          }
          else if(method == 'Bank'){
            if(bank_name==""){
              $("#err_bank_name").text("Insert Bank Name");
              $('#bank_name').focus();
              return false;
            }
            else{
              $("#err_bank_name").text("");
            }
          }
          else{
            if(receive_date==""){
              $("#err_receive_date").text("Insert Receive Date");
              $('#receive_date').focus();
              return false;
            }
            else{
              $("#err_receive_date").text("");
            }

            if(receipt_no==""){
              $("#err_receipt_no").text("Insert Receipt No.");
              $('#receipt_no').focus();
              return false;
            }
            else{
              $("#err_receipt_no").text("");
            }
          }
        }
      }
      //shipping mode validation complite.

      if(client==""){
        $("#err_client").text("Please Enter Client");
        $('#client').focus();
        return false;
      }
      else{
        $("#err_client").text("");
      }
      //client validation complite.

      if(currency==""){
        $("#err_currency").text("Please Enter Client");
        $('#currency').focus();
        return false;
      }
      else{
        $("#err_currency").text("");
      }
      //currency validation complite.

      /*if(product==""){
        $("#err_product").text("Please Enter Product");
        $('#product').focus();
        return false;
      }
      else{
        $("#err_product").text("");
      }*/
      //product code validation complite.

      /*if(warehouse==""){
        $("#err_warehouse").text("Please Enter Warehouse");
        $('#warehouse').focus();
        return false;
      }
      else{
        $("#err_warehouse").text("");
      }*/
      //warehouse code validation complite.

      /*if(supplier==""){
        $("#err_supplier").text("Please Enter supplier");
        $('#supplier').focus();
        return false;
      }
      else{
        $("#err_supplier").text("");
      }*/
      //supplier validation complite.

      $(this).find(':button[type=submit]').prop('disabled', true);
      $('.button').css('cursor', 'default');
      $('.button').toggleClass('active');
    });
    $("#date").change(function(event){
      var date = $('#date').val(); 
      var date_regex = /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
      if(date==null || date==""){
        $("#err_date").text("Please Enter Date. ");
        $('#date').focus();
        return false;
      }
      else{
        $("#err_date").text("");
      }
      if (!date.match(date_regex) ) {
        $('#err_date').text(" Please Enter Valid Date. ");   
        $('#date').focus();
        return false;
      }
      else{
        $("#err_date").text("");
      }
    });
    $("#ship_mode").change(function(event){
      var ship_mode = $('#ship_mode').val();
      if(ship_mode==""){
        $("#err_ship_mode").text("Select Shipping Mode. ");
        return false;
      }
      else{
        $("#err_ship_mode").text("");
      }
    });
    $("#client").change(function(event){
      var client = $('#client').val();
      if(client==""){
        $("#err_client").text("Select the Client. ");
        return false;
      }
      else{
        $("#err_client").text("");
      }
    });
    $("#currency").change(function(event){
      var currency = $('#currency').val();
      if(currency==""){
        $("#err_currency").text("Select the Currency. ");
        return false;
      }
      else{
        $("#err_currency").text("");
      }
    });
    /*$("#product").change(function(event){
      var product = $('#product').val();
      if(product==""){
        $("#err_product").text("Select the Product. ");
        return false;
      }
      else{
        $("#err_product").text("");
      }
    });*/
    /*$("#warehouse").change(function(event){
      var warehouse = $('#warehouse').val();
      if(warehouse==""){
        $("#err_warehouse").text("Please Enter Warehouse");
        $('#warehouse').focus();
        return false;
      }
      else{
        $("#err_warehouse").text("");
      }
    });*/
    /*$("#supplier").change(function(event){
      var supplier = $('#supplier').val();
      if(supplier==""){
        $("#err_supplier").text("Please Enter Supplier");
        $('#supplier').focus();
        return false;
      }
      else{
        $("#err_supplier").text("");
      }
    });*/
  }); 
</script>