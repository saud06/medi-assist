<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','purchaser','manager');
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
          <li><a href="<?php echo base_url('purchase_return'); ?>">Purchase Return</a></li>
          <li class="active">Add Purchase Return</li>
        </ol>
      </h5>    
    </section>

  <!-- Main content -->
    <section class="content">
      <div class="row">
      <!-- right column -->
        <div class="col-md-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Add New Purchase Return</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <form role="form" id="form" method="post" action="<?php echo base_url('purchase_return/addPurchaseReturn');?>">
                <div class="col-md-6">
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
                        $no = sprintf('%06d',intval($value->id)+1); 
                      }
                    }
                  ?>
                  <div class="form-group">
                    <label for="reference_no">Reference No<span class="validation-color">*</span></label>
                    <input type="text" class="form-control" id="reference_no" name="reference_no" value="PR-<?php echo $no;?>" readonly>
                    <span class="validation-color" id="err_reference_no"><?php echo form_error('reference_no'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="warehouse">Select Warehouse <span class="validation-color">*</span></label>
                    <select class="form-control select2" id="warehouse" name="warehouse" style="width: 100%;">
                      <option value="">Select</option>
                      <?php

                        foreach ($warehouse as $row) {
                          echo "<option value='$row->warehouse_id'".set_select('warehouse_id',$row->branch_id).">$row->warehouse_name</option>";
                        }
                      ?>
                    </select>
                    <span class="validation-color" id="err_warehouse"><?php echo form_error('warehouse'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="supplier">Select Supplier <span class="validation-color">*</span></label>
                    <select class="form-control select2" id="supplier" name="supplier" style="width: 100%;">
                      <option value="">Select</option>
                      <?php

                        foreach ($supplier as $row) {
                          echo "<option value='$row->supplier_id'".set_select('supplier_id',$row->branch_id).">$row->supplier_name</option>";
                        }
                      ?>
                    </select>
                    <span class="validation-color" id="err_supplier"><?php echo form_error('supplier'); ?></span>
                  </div>
                </div>
                <div class="col-md-12">
                  <br><br>
                  <div class="col-md-1"></div>
                  <div class="col-md-5">
                    <div class="form-group">
                      <input type="text" class="form-control" id="product" name="product" value="" autocomplete="off">
                      <span class="validation-color" id="err_product"><?php echo form_error('reference_no'); ?></span>
                    </div> <!--/form group  -->
                  </div> <!--/col-md-6 -->
                  <div class="col-md-4">
                    <input type="radio" class="minimal" name="product_search" id="product_code" value="Code" checked> Product Code &nbsp;&nbsp;
                    <input type="radio" class="minimal" name="product_search" id="product_name" value="Name"> Product Name &nbsp;&nbsp;
                  </div>
                </div> <!--/col-md-12 -->
                <br>
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Inventory Items</label>
                    
                    <table class="table items table-striped table-bordered table-condensed table-hover product_table" name="product_data" id="product_data">
                      <thead>
                        <tr>
                          <th style="width: 20px;"><img src="<?php  echo base_url(); ?>assets/images/bin1.png" /></th>
                          <th class="span2">Code</th>
                          <th class="span2" width="20%">Quantity</th>
                          <th class="span2">Available Qty</th>
                          <th class="span2">Unit</th>
                          <th class="span2">Price</th>
                          <th class="span2">Sub Total</th>
                        </tr>
                      </thead>
                      <tbody>
                        
                      </tbody>
                    </table>
                    <input type="hidden" name="grand_total" id="grand_total">
                    <input type="hidden" name="table_data" id="table_data">
                    <span id="grandtotal">Grand Total : 0.00</span>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                      <label for="note">Product Detail for Invoice </label>
                      <textarea class="form-control" id="note" name="note"><?php echo set_value('details'); ?></textarea>
                      <span class="validation-color" id="err_details"><?php echo form_error('details'); ?></span>
                    </div>
                  </div>
                </div>
                <div class="col-md-5">                    
                      <div id='autoproduct' class="form-control" style="position:absolute;">
                      </div> <!-- /controls --> 
                </div>
                <div class="col-md-12">
                  <div class="box-footer">
                    <button type="submit" id="submit" class="btn btn-primary">Add</button>
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
<script type="text/javascript">
   $(document).ready(function () {
    var counter = 1;

    


    $("#product_code").click(function(){
      $('#autoproduct ul').hide();
      $("#product").val('');
    });
    $("#product_name").click(function(){
      $('#autoproduct ul').hide();
      $("#product").val('');
    });

    $("#autoproduct ul").keydown(function(e){
      if(e.keyCode==40){
        alert("hi");
      }
    });

});
</script>
<script>
 $(document).ready(function(){
    var i = 0;
    var product_data = new Array();
    $('#product').keydown(function(){
      var warehouse = $('#warehouse').val();
      if(warehouse == "Select"){
        $('#err_product').text('Please Select Warehouse').animate({opacity: '0.0'}, 2000).animate({opacity: '0.0'}, 1000).animate({opacity: '1.0'}, 2000);  
      }
    });
    $('#product').keyup(function(){
      var code = $('#product').val();
      var warehouse = $('#warehouse').val();
      var search_option = $("input[name='product_search']:checked").val();
      $('#autoproduct').html('');
      code = $.trim(code);
      //alert('hi');
      if(warehouse != ""){
        if(code){
          $.ajax({
            url:"<?php echo base_url(); ?>index.php/purchase_return/getAutoCodeName/"+code+"/"+search_option+"/"+warehouse,
            type: "GET",
            dataType: "html",
            success:function(data){
                      //alert(data);
                      $('#autoproduct').html(data);
                       $('#autoproduct ul li').mouseover(function(){
                          $('#autoproduct ul li').removeClass("hover");
                          $(this).addClass("hover");
                       });
                       /*$('#autoproduct ul li').hover(function(){
                          var value = $(this).text();
                          $('#product').val(value);
                       });*/
                       $('#autoproduct ul li').click(function(){
                          var value = $(this).text();
                          $('#product').val(value);
                          $('#autoproduct ul').remove();
                          addRow();
                          $('#product').val('');
                       });
                      
                    },
            error: function(xhr, status, error) {
                      //alert(error);
                    }
          });//ajax
        }//code
      } // warehouse
      else{
        $('#err_product').text('Please Select Warehouse.').animate({opacity: '0.0'}, 2000).animate({opacity: '0.0'}, 1000).animate({opacity: '1.0'}, 2000);      }
    }); //product , keyup
    var counter = 1;
    function addRow(){
          $('#err_product').text('');
          var code = $("#product").val();
          var warehouse = $('#warehouse').val();
          var flag = 0;
          var search_option = $("input[name='product_search']:checked").val();
          //alert(search_option);
          $.ajax({
              url: "<?php echo base_url('index.php/purchase_return/getProduct') ?>/"+code+"/"+search_option+"/"+warehouse,
              type: "GET",
              dataType: "JSON",
              success: function(data){
                //alert(data);
                //alert(data[0].product_id);
                $("table.product_table").find('input[name^="product_id"]').each(function () {
                    if(data[0].product_id  == +$(this).val()){
                      flag = 1;
                    }
                });
                if(flag == 0){
                  var id = data[0].product_id;
                  var code = data[0].code;
                  var name = data[0].name;
                  var price = data[0].cost
                  var product = { "product_id" : id
                                };
                  product_data[i] = product;

                  length = product_data.length - 1 ;
              
                  var newRow = $("<tr>");
                  var cols = "";
                  cols += "<td><a class='deleteRow'> <img src='<?php  echo base_url(); ?>assets/images/bin3.png' /> </a><input type='hidden' name='id' name='id' value="+i+"><input type='hidden' name='product_id' name='product_id' value="+id+"></td>";
                  cols += "<td>"+code+"</td>";
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
                /*var quantity = $('input[name^="quantity"]').val();
                var price = $('input[name^="price"]').val();*/
              },
              error: function(xhr, status, error) {
                  $('#err_product').text('Enter Product Code / Name').animate({opacity: '0.0'}, 2000).animate({opacity: '0.0'}, 1000).animate({opacity: '1.0'}, 2000);
              }
          });
    }

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
      var quantity = $(this).closest("tr").find('input[name^="qty"]').val();
      var available_quantity = $(this).closest("tr").find('input[name^="available_quantity"]').val();

      if(quantity > available_quantity){
        $('#err_product').text("You Entered Quantity More than Available Quantity"); 
        return false;
      }else{
         $('#err_product').text("");
        calculateRow($(this).closest("tr"));
        calculateGrandTotal();
      }
        
    });
    $('table.product_table input[name^="qty"]').change(function(){
      alert();
       
    });
    function calculateRow(row) {
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
      $("#grandtotal").text("Grand Total : "+grandTotal.toFixed(2));
      $("#grand_total").val(grandTotal.toFixed(2));
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

  /*$(document).ready(function(){
    $('#autoproduct ul li').click(function(){
      $('#err_product').text('');
      var code = $("#product").val();
      var search_option = $("input[name='product_search']:checked").val();
      //alert(search_option);
      $.ajax({
          url: "<?php echo base_url('index.php/purchase/getProduct') ?>/"+code,
          type: "GET",
          dataType: "JSON",
          success: function(data){
            //alert(data[0].product_id);
            $("#product_data tbody").append("<tr><td class = 'icon-remove-sign'><a id='del'><span></span></a></td><td>"+data[0].product_id+"</td><td>"+data[0].quantity+"</td><td>"+data[0].quantity+"</td><td>"+data[0].expiry_date+"</td><td>"+data[0].unit+"</td><td>"+data[0].subcategory_id+"</td></tr>");
          },
          error: function(xhr, status, error) {
              $('#err_product').text('Enter Product Code / Name').animate({opacity: '0.0'}, 2000).animate({opacity: '0.0'}, 1000).animate({opacity: '1.0'}, 2000);
          }
      });
    });
    $('.icon-remove-sign').click(function(){
        alert();
      });
  });*/
</script>
<script>
    $(function() {

      $('#customize-spinner').spinner('changed', function(e, newVal, oldVal) {
        $('#old-val').text(oldVal);
        $('#new-val').text(newVal);
      });

      $('[data-trigger="spinner"]').spinner('changing', function(e, newVal, oldVal) {
        var well = $(e.currentTarget).closest('.well');
        $('small', well).text("Old = " + oldVal + ", New = " + newVal);
      });

      $('#step-spinner').spinner({
        step: function(dir) {
          if ((this.oldValue === 1 && dir === 'down') || (this.oldValue === -1 && dir === 'up')) {
            return 2;
          }
          return 1;
        }
      });
    });
    </script>
<script type="text/javascript">
  function up(){
        add($(this).closest("tr"));
  }
  function add(row){
    var qty = +row.find('input[name^="qty"]').val();
    alert(qty);
    qty++;
    +row.find('input[name^="qty"]').val(qty);
  }
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
      var supplier = $('#supplier').val();
      var product = $('#product').val();
      var editor = $('#editor').val();
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

        /*if(reference_no==null || reference_no==""){
          $("#err_reference_no").text("Please Enter Reference No");
          $('#reference_no').focus();
          return false;
        }
        else{
          $("#err_reference_no").text("");
        }
        if (!reference_no.match(num_regex) ) {
          $('#err_reference_no').text(" Please Enter Valid Reference No ");  
          $('#reference_no').focus(); 
          return false;
        }
        else{
          $("#err_reference_no").text("");
        }*/
//reference no codevalidation complite.

        if(warehouse==""){
          $("#err_warehouse").text("Please Enter Warehouse");
          $('#warehouse').focus();
          return false;
        }
        else{
          $("#err_warehouse").text("");
        }
//warehouse code validation complite.

        if(supplier==""){
          $("#err_supplier").text("Please Enter Supplier");
          $('#supplier').focus();
          return false;
        }
        else{
          $("#err_supplier").text("");
        }
//supplier code validation complite.

        if(grand_total=="" || grand_total==null || grand_total==0.00){
          $("#err_product").text("Please Select Product");
          $('#product').focus();
          return false;
        }

        /*if(product==null || product==""){
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
        }*/
//product codevalidation complite.

    }); 

    /*$("#date").blur(function(event){
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
    });*/
    /*$("#reference_no").blur(function(event){
      var num_regex = /^[0-9]+$/;
      var reference_no = $('#reference_no').val();
      if(reference_no==null || reference_no==""){
          $("#err_reference_no").text("Please Enter Reference No");
          $('#reference_no').focus();
          return false;
        }
        else{
          $("#err_reference_no").text("");
        }
        if (!date.match(num_regex) ) {
          $('#err_reference_no').text(" Please Enter Valid Reference No ");  
          $('#reference_no').focus(); 
          return false;
        }
        else{
          $("#err_reference_no").text("");
        }
    });*/
    $("#warehouse").change(function(event){
      var warehouse = $('#warehouse').val();
      if(warehouse==""){
        $("#err_warehouse").text("Please Enter Warehouse");
        $('#warehouse').focus();
        return false;
      }
      else{
        $("#err_warehouse").text("");
        $("#err_product").text("");
      }
    });
    $("#supplier").change(function(event){
      var supplier = $('#supplier').val();
      if(supplier==""){
        $("#err_supplier").text("Please Enter Supplier");
        $('#supplier').focus();
        return false;
      }
      else{
        $("#err_supplier").text("");
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