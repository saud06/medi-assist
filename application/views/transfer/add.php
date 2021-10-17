<?php
defined('BASEPATH') OR exit('NO direct script access allowed');
$this->load->view('layout/header');
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('auth/dashboard'); ?>" class="text-black"><i class="fa fa-dashboard">&nbsp;</i><strong><?php echo $this->lang->line('header_dashboard'); ?></strong></a></li>
          <li><a href="<?php echo base_url('transfer'); ?>" class="text-black"><strong><?php echo $this->lang->line('transfer_listtransfers'); ?></strong></a></li>
          <li class="active"><?php echo $this->lang->line('transfer_add_transfer'); ?></li>
        </ol>
      </h5>    
    </section>

  <!-- Main content -->
    <section class="content">
      <div class="row">
      <!-- right column -->
        <div class="col-sm-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $this->lang->line('transfer_add_transfer'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <form role="form" id="form" method="post" action="<?php echo base_url('transfer/addTransfer');?>">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="date"><?php echo $this->lang->line('transfer_date'); ?><span class="validation-color">*</span></label>
                    <input type="text" class="form-control datepicker" id="date" name="date" value="<?php echo date("Y-m-d");  ?>">
                    <span class="validation-color pull-right" id="err_date"><?php echo form_error('date'); ?></span>
                  </div>
                  <div class="form-group">
                    <label for="to_warehouse"><?php echo $this->lang->line('transfer_to_warehouse'); ?> <span class="validation-color">*</span></label>
                    <select class="form-control select2" id="to_warehouse" name="to_warehouse" style="width: 100%;">
                      <option value=""><?php echo $this->lang->line('transfer_select'); ?></option>
                      <?php

                        foreach ($warehouse as $row) {
                          echo "<option value='$row->warehouse_id'".set_select('warehouse_id',$row->branch_id).">$row->warehouse_name</option>";
                        }
                      ?>
                    </select>
                    <span class="validation-color" id="err_to_warehouse"><?php echo form_error('to_warehouse'); ?></span>
                  </div>
                  <div class="form-group">
                    <label for="from_warehouse"><?php echo $this->lang->line('transfer_from_warehouse'); ?><span class="validation-color">*</span></label>
                    <select class="form-control select2" id="from_warehouse" name="from_warehouse" style="width: 100%;">
                      <option value=""><?php echo $this->lang->line('transfer_select'); ?></option>
                      <?php

                        foreach ($warehouse as $row) {
                          echo "<option value='$row->warehouse_id'".set_select('warehouse_id',$row->branch_id).">$row->warehouse_name</option>";
                        }
                      ?>
                    </select>
                    <span class="validation-color" id="err_from_warehouse"><?php echo form_error('from_warehouse'); ?></span>
                  </div>
                </div>
                <div class="col-sm-12">
                  <br><br><br><br>
                  <div class="col-sm-2"></div>
                  <div class="col-sm-5">
                    <div class="form-group">
                      <select class="form-control select2" id="product" name="product" style="width: 100%;">
                      <option value=""><?php echo $this->lang->line('transfer_select_product'); ?></option>
                    </select>
                    </div> <!--/form group  -->
                  </div> <!--/col-sm-6 -->
                  <div class="col-sm-4">
                    <span class="validation-color" id="err_product"></span>
                  </div>
                </div> <!--/col-sm-12 -->
                <div class="col-sm-12">
                  <div class="form-group">
                    <label><?php echo $this->lang->line('transfer_inventory_items'); ?></label>
                    <div style="overflow-y: auto;">
                      <table class="table items table-striped table-bordered table-condensed table-hover product_table" name="product_data" id="product_data">
                        <thead>
                          <tr>
                            <th style="width: 20px;"><img src="<?php  echo base_url(); ?>assets/images/bin1.png" /></th>
                            <th class="span2" width="20%"><?php echo $this->lang->line('transfer_code'); ?></th>
                            <th class="span2"><?php echo $this->lang->line('transfer_quantity'); ?></th>
                            <th class="span2"><?php echo $this->lang->line('transfer_available_qty'); ?>
                            </th>
                            <th class="span2"><?php echo $this->lang->line('transfer_unit'); ?></th>
                            <th class="span2"><?php echo $this->lang->line('transfer_cost'); ?></th>
                            <th class="span2"><?php echo $this->lang->line('transfer_sub_total'); ?></th>
                          </tr>
                        </thead>
                        <tbody id="product_table_body">
                          
                        </tbody>
                      </table>
                    </div>
                    <input type="hidden" name="grand_total" id="grand_total">
                    <input type="hidden" name="table_data" id="table_data">
                    <?php echo $this->lang->line('transfer_grand_total'); ?> : <?php echo$this->session->userdata('symbol'); ?><span id="grandtotal">0.00</span>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                      <label for="note"><?php echo $this->lang->line('transfer_note'); ?> </label>
                      <textarea class="form-control" id="note" name="note"><?php echo set_value('details'); ?></textarea>
                      <span class="validation-color" id="err_details"><?php echo form_error('details'); ?></span>
                    </div>
                  </div>
                </div>
                <div class="form-group">                     
                    <div id='autoproduct' class="col-sm-5" style="position:absolute;">     
                </div> <!-- /form-group -->
                <div class="col-sm-12">
                  <div class="box-footer">
                    <button type="submit" id="submit" class="btn btn-primary"><?php echo $this->lang->line('transfer_add'); ?></button>
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
  $(document).ready(function() {
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
<script>
 $(document).ready(function(){
    var i = 0;
    var product_data = new Array();
    var counter = 1;
    
    $('#from_warehouse').change(function(){
      $('#product').html('');
      $('#product').html('<option value="">Select Product</option>');
      $('#err_product').text('');
      var from_warehouse_id = $('#from_warehouse').val();
      var to_warehouse_id = $('#to_warehouse').val();
      if(to_warehouse_id != ""){
        $.ajax({
          url: "<?php echo base_url('transfer/getProducts') ?>/"+from_warehouse_id,
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
      else{
        $('#err_product').text('Please Select (To) Warehouse').animate({opacity: '0.0'}, 2000).animate({opacity: '0.0'}, 1000).animate({opacity: '1.0'}, 2000); 
        return false; 
      }
    });

    $('#product').change(function(){
      var id = $(this).val();
      var product_id = $('#product').val();
      var warehouse_id = $('#from_warehouse').val();
      var flag = 0;
      $('#err_product').text('');
      if(warehouse_id != ""){
        $.ajax({
          url: "<?php echo base_url('transfer/getProduct') ?>/"+product_id+"/"+warehouse_id,
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
      var date_regex = /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
      var date = $('#date').val();
      var to_warehouse = $('#to_warehouse').val();
      var from_warehouse = $('#from_warehouse').val();
      var grand_total = $('#grand_total').val();


        if(date==null || date==""){
          $("#err_date").text("Please enter date");
          $('#date').focus();
          return false;
        }
        else{
          $("#err_date").text("");
        }
        if (!date.match(date_regex) ) {
          $('#err_date').text("Please enter valid date ");   
          $('#date').focus();
          return false;
        }
        else{
          $("#err_date").text("");
        }

        if(to_warehouse==""){
          $("#err_to_warehouse").text("Please enter (To) warehouse");
          $('#to_warehouse').focus();
          return false;
        }
        else{
          $("#err_to_warehouse").text("");
        }

        if(from_warehouse==""){
          $("#err_from_warehouse").text("Please enter (From) warehouse");
          $('#from_warehouse').focus();
          return false;
        }
        else{
          $("#err_from_warehouse").text("");
        }

        if(from_warehouse === to_warehouse){
        $("#err_to_warehouse").text("Please select different warehouse");
        return false;
      }
      else{
        $("#err_to_warehouse").text("");
      }

        if(grand_total=="" || grand_total==null || grand_total==0.00){
          $("#err_product").text("Please Select Product");
          $('#product').focus();
          return false;
        }
        else{
          $("#err_product").text("");
        }

    }); 

    $("#date").blur(function(event){
      var date = $('#date').val(); 
      var date_regex = /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
      if(date==null || date==""){
          $("#err_date").text("Please enter date");
          $('#date').focus();
          return false;
        }
        else{
          $("#err_date").text("");
        }
        if (!date.match(date_regex) ) {
          $('#err_date').text(" Please enter valid date ");   
          $('#date').focus();
          return false;
        }
        else{
          $("#err_date").text("");
        }
    });
    $("#to_warehouse").change(function(event){
        var to_warehouse = $('#to_warehouse').val();
        if(to_warehouse==""){
        $("#err_to_warehouse").text("Please select (To) warehouse");
          $('#to_warehouse').focus();
          return false;
      }
      else{
          $("#err_to_warehouse").text("");
      }
    });
    $("#from_warehouse").change(function(event){
        var from_warehouse = $('#from_warehouse').val();
        var to_warehouse = $('#to_warehouse').val();
        $('#product_table_body').empty();
        $('#table_data').val('clear');
        $('#last_total').val('');
        $('#grand_total').val('');
        $('#grandtotal').text('0.00');
        $('#totaldiscount').text('0.00');
        $('#lasttotal').text('0.00');
        if(from_warehouse === to_warehouse){
          $("#err_from_warehouse").text("Please select different warehouse");
          return false;
        }
        else{
          $("#err_from_warehouse").text("");
        }
        if(from_warehouse==""){
        $("#err_from_warehouse").text("Please select (From) warehouse");
          $('#from_warehouse').focus();
          return false;
      }
      else{
          $("#err_from_warehouse").text("");
      }
    });

  }); 
</script>