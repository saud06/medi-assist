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
          <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li><a href="<?php echo base_url('sales'); ?>">Sales</a></li>
          <li class="active">Add Sales</li>
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
              <h3 class="box-title">Add New Sales</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <form role="form" id="form" method="post" action="<?php echo base_url('sales/addSales');?>">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="date">Date<span class="validation-color">*</span></label>
                    <input type="text" class="form-control datepicker" id="date" name="date" value="<?php echo date("Y-m-d");  ?>">
                    <span class="validation-color pull-right" id="err_date"><?php echo form_error('date'); ?></span>
                  </div>

                  <?php
                    if($reference_no==null){
                        $no = sprintf('%06d',intval(1));
                    }
                    else{
                      foreach ($reference_no as $value) {
                        $no = sprintf('%06d',intval($value->sales_id)+1); 
                      }
                    }
                  ?>
                  <div class="form-group">
                    <label for="reference_no">Reference No<span class="validation-color">*</span></label>
                    <input type="text" class="form-control" id="reference_no" name="reference_no" value="SO-<?php echo $no;?>" readonly>
                    <span class="validation-color" id="err_reference_no"><?php echo form_error('reference_no'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="warehouse">Select Warehouse <span class="validation-color">*</span></label>
                    <select class="form-control select2" id="warehouse" name="warehouse" style="width: 100%;">
                      <option value="">Select</option>
                      <?php  
                        foreach ($warehouse as $row) {
                          echo "<option value='$row->warehouse_id'>$row->warehouse_name</option>";
                        }
                      ?> 
                    </select>
                    <span class="validation-color" id="err_warehouse"><?php echo form_error('warehouse');?></span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="biller">Select Biller <span class="validation-color">*</span></label>
                    <select class="form-control select2" id="biller" name="biller" style="width: 100%;">
                      <option value="">Select</option>
                      <?php  
                        foreach ($biller as $row) {
                          echo "<option value='$row->biller_id'>$row->biller_name</option>";
                        }
                      ?> 
                    </select>
                    <span class="validation-color" id="err_biller"><?php echo form_error('biller');?></span>
                  </div>
                  <div class="form-group">
                    <label for="client">Select Client <span class="validation-color">*</span></label>
                    <select class="form-control select2" id="client" name="client" style="width: 100%;">
                      <option value="">Select</option>
                      <?php  
                        foreach ($client as $row) {
                          echo "<option value='$row->client_id'>$row->client_name</option>";
                        }
                      ?> 
                    </select>
                    <span class="validation-color" id="err_client"><?php echo form_error('client');?></span>
                  </div>
                  <div class="form-group">
                    <label for="discount">Select Discount <span class="validation-color">*</span></label>
                    <select class="form-control select2" id="discount" name="discount" style="width: 100%;">
                      <option value="">Select</option>
                      <?php  
                        foreach ($discount as $row) {
                            if($row->discount_type == "Fixed"){
                              echo "<option value='$row->discount_id'>$row->discount_name <span style='color:green;'>(Rs $row->discount_value</span>)</option>";
                            }
                            else{
                              echo "<option value='$row->discount_id'>$row->discount_name <span style='color:green;'>($row->discount_value%</span>)</option>";
                            }
                        }
                      ?> 
                    </select>
                    <span class="validation-color" id="err_discount"><?php echo form_error('discount');?></span>
                  </div>
                </div>
                <div class="col-sm-12">
                  <br><br><br><br>
                  <div class="col-sm-2"></div>
                  <div class="col-sm-5">
                    <div class="form-group">
                      <select class="form-control select2" id="product" name="product" style="width: 100%;">
                      <option value="">Select Product</option>
                      
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
                    <label>Inventory Items</label>
                    
                    <table class="table items table-striped table-bordered table-condensed table-hover product_table" name="product_data" id="product_data">
                      <thead>
                        <tr>
                          <th style="width: 20px;"><img src="<?php  echo base_url(); ?>assets/images/bin1.png" /></th>
                          <th class="span2">Code</th>
                          <th class="span2">Name</th>
                          <th class="span2">HSN/SAC Code</th>
                          <th class="span2" width="10%">Quantity</th>
                          <th class="span2">Available Qty</th>
                          <th class="span2">Unit</th>
                          <th class="span2">Price</th>
                          <th class="span2" width="10%">Total Sale</th>
                          <!-- <th class="span2">Discount</th>
                          <th class="span2">Taxable Value</th>
                          <th class="span2">Tax</th> -->
                        </tr>
                      </thead>
                      <tbody id="product_table_body">
                        
                      </tbody>
                    </table>
                    <input type="hidden" name="grand_total" id="grand_total">
                    <input type="hidden" name="total_discount" id="total_discount">
                    <input type="hidden" name="discount_type" id="discount_type">
                    <input type="hidden" name="discount_amount" id="discount_amount">
                    <input type="hidden" name="last_total" id="last_total">
                    <input type="hidden" name="table_data" id="table_data">
                    <table>
                      <tr>
                        <td>Grand Total : </td><td><span id="grandtotal">&nbsp;0.00</span></td>
                      </tr>
                      <tr>
                        <td align="right">Discount : </td>
                        <td>
                          <span id="totaldiscount">&nbsp;0.00</span>
                          <span id="showdiscount" style="color:green;"></span>
                        </td>
                      </tr>
                       <tr>
                        <td align="right">Total : </td><td><span id="lasttotal">&nbsp;0.00</span></td>
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
                            <a href="#note" data-toggle="tab">Note</a>
                          </li>
                          <li class="active"><a href="#internal_note" data-toggle="tab">Internal Note</a></li>
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
                    <button type="submit" id="submit" class="btn btn-info">&nbsp;&nbsp;&nbsp;Add&nbsp;&nbsp;&nbsp;</button>
                    <span class="btn btn-default" id="cancel" style="margin-left: 2%" onclick="cancel('sales')">Cancel</span>
                  </div>
                </div>
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
    var i = 0;
    var product_data = new Array();
    var counter = 1;
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
                  var price = data[0].price
                  var product = { "product_id" : id
                                };
                  product_data[i] = product;
                  length = product_data.length - 1 ;
                  
                  /*var select_discount = "";
                  select_discount += '<div class="form-group">';
                  select_discount += '<select class="form-control select2" id="item_discount" name="item_discount" style="width: 100%;">';
                  select_discount += '<option value="">Select</option>';
                    for(i=0;i<data['discount'].length;i++){
                      select_discount += '<option value="' + data['discount'][i].discount_id + '">' + data['discount'][i].discount_name+'('+data['discount'][i].discount_value +'%)'+ '</option>';
                    }
                  select_discount += '</select></div>';

                  var select_tax = "";
                  select_tax += '<div class="form-group">';
                  select_tax += '<select class="form-control select2" id="item_tax" name="item_tax" style="width: 100%;">';
                  select_tax += '<option value="">Select</option>';
                    for(i=0;i<data['tax'].length;i++){
                      select_tax += '<option value="' + data['tax'][i].tax_id + '">' + data['tax'][i].tax_name+'('+data['tax'][i].tax_value +')'+ '</option>';
                    }
                  select_tax += '</select></div>';*/

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
                  cols += "<td>" 
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
                  /*cols += '<td><input type="text" id="hidden_discount">'+select_discount+'</td>';
                  cols += '<td><span id="taxable_value"></span></td>';
                  cols += '<td><input type="text" id="hidden_tax">'+select_tax+'</td>';*/
                  cols += "</tr>";
                  counter++;
 
                  newRow.append(cols);
                  $("table.product_table").append(newRow);
                  var table_data = JSON.stringify(product_data);
                  $('#table_data').val(table_data);
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
    }); //product , keyup
    
    $("table.product_table").on("click", "a.deleteRow", function (event) {
        deleteRow($(this).closest("tr"));
        $(this).closest("tr").remove();
        calculateGrandTotal();
    });

    function deleteRow(row){
      var id = +row.find('input[name^="id"]').val();
      var array_id = product_data[id].product_id;
      //product_data.splice(id, 1);
      product_data[id] = null;
      //alert(product_data);
      var table_data = JSON.stringify(product_data);
      $('#table_data').val(table_data);
    }

    $("table.product_table").on("change", 'input[name^="price"], input[name^="qty"]', function (event) {
        calculateRow($(this).closest("tr"));
        calculateGrandTotal();
    });
    function calculateRow(row) {
      //$('#hidden_discount').val(discount);
      var key = +row.find('input[name^="id"]').val();
      var price = +row.find('input[name^="price"]').val();
      var qty = +row.find('input[name^="qty"]').val();
      row.find('input[name^="linetotal"]').val((price * qty).toFixed(2));

      product_data[key].quantity = qty;
      product_data[key].total = (price * qty).toFixed(2);
      var table_data = JSON.stringify(product_data);
      $('#table_data').val(table_data);
    }
    function calculateGrandTotal() {
      var grandTotal = 0;
      $("table.product_table").find('input[name^="linetotal"]').each(function () {
        grandTotal += +$(this).val();
      });
      var value = $('#total_discount').val();
      var type = $('#discount_type').val();
      var amount = parseInt($('#discount_amount').val());
      //var total = $('#last_total').val();
      if(grandTotal > 0 && grandTotal!=null){
        if(type == "Fixed"){
          var t = grandTotal - value;
          if(grandTotal < amount){
            var t = grandTotal;
          }  
          $('#lasttotal').text(t);
          $('#last_total').val(t);
          $('#totaldiscount').text(value);
          $('#total_discount').val(value);
          $('#showdiscount').text(" (Rs "+value+")");
        }
        else{
          var total = (grandTotal*value)/100;
          var t = grandTotal - total;
          $('#totaldiscount').text(total);
          $('#total_discount').val(value);
          $('#lasttotal').text(t);
          $('#last_total').val(t);
          $('#showdiscount').text(" ("+value+"%)");
        }
      }
      /*if(grandTotal==0.00){
        $("#last_total").val(grandTotal);
        $("#lasttotal").text(grandTotal);
      }
      if(grandTotal>0){
        var t = grandTotal - discount;
        $("#last_total").val(t);
        $("#lasttotal").text(t);
      }*/
      
      $("#grandtotal").text(grandTotal.toFixed(2));
      $("#grand_total").val(grandTotal.toFixed(2));
    }
});

</script>

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
      var client = $('#client').val();
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
      $('#product_table_body').empty();
      $('#table_data').val('clear');
      $('#last_total').val('');
      $('#grand_total').val('');
      $('#grandtotal').text('0.00');
      $('#totaldiscount').text('0.00');
      $('#lasttotal').text('0.00');
      if(warehouse==""){
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
      if (!product.match(sname_regex) ) {
        $('#err_product').text(" Please Enter Valid Product Code/Name ");  
        $('#product').focus(); 
        return false;
      }
      else{
        $("#err_product").text("");
      }
    });
    $("#item_discount").change(function(event){

    }
  }); 
</script>