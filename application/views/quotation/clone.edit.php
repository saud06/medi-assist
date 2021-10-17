<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*echo "<pre>";
print_r($discount);
exit;*/
?>
<div class="main">
  
  <div class="main-inner">

      <div class="container">
  
        <div class="row">
          
          <div class="span12">          
            
            <div class="widget ">
              
              <div class="widget-header">
                &nbsp;&nbsp;<img src="<?php  echo base_url(); ?>assets/images/add_product.png" />
                <h3>Edit Sales</h3>
            </div> <!-- /widget-header -->
        
            <div class="widget-content">  <span style="color:blue;" id="success"><?php if(isset($err)){echo $err;}  ?></span>                                             
                <form id="edit-profile" method="post" class="form-horizontal" action="<?php echo base_url('sales/edit_sales');?>">
                    <fieldset>   
                      <br> 
                      <?php foreach($data as $row){?>
                      <div class="control-group">          
                        <label class="control-label" for="date">Date</label>
                        <div class="controls">
                          <input type="text" class="span4 txt-height datepicker" placeholder="yyyy-mm-dd" id="date" name="date" value="<?php echo $row->date;?>">
                          <input type="hidden" name="sales_id" value="<?php echo $row->sales_id;?>">
                          <span style="color:red;" id="err_date"></span>
                        </div> <!-- /controls -->       
                      </div> <!-- /control-group -->

                      <div class="control-group">                     
                        <label class="control-label" for="reference_no">Reference No</label>
                        <div class="controls">
                          <input type="text" class="span4 txt-height" id="reference_no" name="reference_no" value="<?php echo $row->reference_no;?>" readonly>
                          <span style="color:red;" id="err_reference_no"></span>
                        </div> <!-- /controls -->       
                      </div> <!-- /control-group -->

                      <div class="control-group">                     
                        <label class="control-label" for="warehouse">Warehouse</label>
                        <div class="controls">
                          <select name="warehouse" id="warehouse" class="ui search dropdown chosen-select">
                            <option value="Select">Select</option>
                            <?php
                            foreach ($warehouse as  $key) {
                            ?>
                                    <option value='<?php echo $key->warehouse_id ?>' <?php if($key->warehouse_id == $row->warehouse_id){echo "selected";} ?>><?php echo $key->warehouse_name ?></option>
                            <?php
                                }
                            ?> 
                          </select>
                          <span style="color:red;" id="err_warehouse"></span>
                        </div> <!-- /controls -->       
                      </div> <!-- /control-group -->

                      <div class="control-group">                     
                        <label class="control-label" for="biller">Biller</label>
                        <div class="controls">
                          <select name="biller" id="biller" class="ui search dropdown">
                            <option value="Select">Select</option>
                            <?php
                            foreach ($biller as  $key) {
                            ?>
                                    <option value='<?php echo $key->biller_id ?>' <?php if($key->biller_id == $row->biller_id){echo "selected";} ?>><?php echo $key->biller_name ?></option>
                            <?php
                                }
                            ?>
                          </select>
                          <span style="color:red;" id="err_biller"></span>
                        </div> <!-- /controls -->       
                      </div> <!-- /control-group -->

                      <div class="control-group">                     
                        <label class="control-label" for="client">Client</label>
                        <div class="controls">
                          <select name="client" id="client" class="ui search dropdown">
                            <option value="Select">Select</option>
                            <?php
                            foreach ($client as  $key) {
                            ?>
                                    <option value='<?php echo $key->client_id ?>' <?php if($key->client_id == $row->client_id){echo "selected";} ?>><?php echo $key->client_name ?></option>
                            <?php
                                }
                            ?>
                          </select>
                          <span style="color:red;" id="err_client"></span>
                        </div> <!-- /controls -->       
                      </div> <!-- /control-group -->

                      <div class="control-group">                     
                        <label class="control-label" for="discount">Discount</label>
                        <div class="controls">
                          <select name="discount" id="discount" class="ui search dropdown">
                            <option value="Select">Select</option>
                            <?php
                            foreach ($discount as  $key) {
                                  if($key->discount_type == "Fixed")
                                  {
                            ?>
                                    <option value='<?php echo $key->discount_id ?>' <?php if($key->discount_id == $row->discount_id){echo "selected";} ?>><?php echo $key->discount_name ?>(Rs <span style='color:green'><?php echo $key->discount_value ?></span>)</option>
                            <?php
                                  }
                                  else{
                            ?>
                                    <option value='<?php echo $key->discount_id ?>' <?php if($key->discount_id == $row->discount_id){echo "selected";} ?>><?php echo $key->discount_name ?>(<span style='color:green'><?php echo $key->discount_value ?>)</span></option>
                            <?php
                                  }
                              }
                            ?>
                          </select>
                          <span style="color:red;" id="err_discount"></span>
                        </div> <!-- /controls -->       
                      </div> <!-- /control-group -->



                      <br><br>
                      <div class="control-group">                     
                        
                        <div class="controls">
                          <input type="text" class="span4 txt-height" id="product" name="product" value="">&nbsp;&nbsp;&nbsp;
                          <input type="radio" name="product_search" id="product_code" value="Code" checked> Product Code &nbsp;&nbsp;
                          <input type="radio" name="product_search" id="product_name" value="Name"> Product Name &nbsp;&nbsp;
                          <span style="color:red;" id="err_product"></span>
                        </div> <!-- /controls -->       
                      </div> <!-- /control-group -->

                      <div class="control-group">                     
                        <div id='autoproduct' class="controls" style="position: absolute;">
                        </div> <!-- /controls -->       
                      </div> <!-- /control-group -->

                      <div class="control-group">                     
                        <label class="control-label">Inventory Items</label>
                        <div class="controls">
                          <table class="table items table-striped table-bordered table-condensed table-hover product_table" name="product_data" id="product_data">
                            <thead>
                              <tr>
                                <th style="width: 20px;"><img src="<?php  echo base_url(); ?>assets/images/bin1.png" /></th>
                                <th class="span2">Code</th>
                                <th class="span2">Quantity</th>
                                <th class="span2">Available Qty</th                                                           >
                                <th class="span2">Unit</th>
                                <th class="span2">Cost</th>
                                <th class="span2">Sub Total</th>
                              </tr>
                            </thead>
                            <tbody id="product_table_body">
                          
                              <?php
                              $i=0;
                             // $product_data = [];
                              foreach ($items as  $key) {
                              ?>
                              <tr>
                                <td>
                                  <a class='deleteRow1'> <img src='<?php  echo base_url(); ?>assets/images/bin3.png' /> </a><input type='hidden' name='id' name='id' value="<?php echo $i ?>"><input type='hidden' name='product_id' name='product_id' value="<?php echo $key->product_id ?>"></td>
                                  <td><?php echo $key->code ?></td>
                                  <td><div class="input-group spinner" data-trigger="spinner">
                                        <input type="text" class="form-control text-center" value="<?php echo $key->quantity ?>" data-rule="quantity" name='qty' id='qty'>
                                        <div class="input-group-addon">
                                          <a href="javascript:;" class="spin-up" data-spin="up"><i class="fa fa-caret-up"></i></a>
                                          <a href="javascript:;" class="spin-down" data-spin="down"><i class="fa fa-caret-down"></i></a>
                                        </div>
                                      </div></td>
                                  <td>q</td>
                                  <td><?php echo $key->unit ?></td>
                                  <td><input type='hidden' name='price' id='price' value='<?php echo $key->cost ?>'><?php echo $key->cost ?></td>
                                  <td><input type='text' class='txt-height' style='' value='<?php echo $key->gross_total ?>' name='linetotal' id='linetotal' readonly>
                                </td>
                              </tr>
                              <?php
                                  $product_data[$i] = $key->product_id;
                                  //array_push($product_data,$product);
                                  $i++;
                                }
                                //echo "<pre>";
                                //print_r($product_data);
                                $grandtotal = $row->total;
                                $product = json_encode($product_data);
                              ?>
                            </tbody>
                          </table>
                          <?php
                            foreach ($data as $data1) {
                              foreach ($discount as  $discount1) {
                                 if($data1->discount_id == $discount1->discount_id){
                                    if($discount1->discount_type == "Fixed"){
                                      /*$value1 = $discount1->discount_value;
                                      $amount1 = $discount1->discount_amount;
                                      $type1 = $discount1->$discount_type;*/
                          ?>
                                      <input type="text" name="total_discount" id="total_discount" value="<?php echo $discount1->discount_value ?>">
                                      <input type="text" name="discount_type" id="discount_type" value="<?php echo $discount1->discount_type ?>">
                                      <input type="text" name="discount_amount" id="discount_amount" value="<?php echo $discount1->amount ?>">
                          <?php
                                    }
                                    else{
                                      /*$value1 = $discount1->discount_value;*/
                          ?>
                                    <input type="text" name="total_discount" id="total_discount" value="<?php echo $discount1->discount_value ?>">
                                    <input type="text" name="discount_type" id="discount_type" value="">
                                    <input type="text" name="discount_amount" id="discount_amount" value="">
                          <?php
                                    }
                                 }
                              }
                            }
                          ?>
                          <input type="text" name="grand_total" id="grand_total" value='<?php echo $row->total; ?>'>
                          <!-- <input type="text" name="total_discount" id="total_discount" value="">
                          <input type="text" name="discount_type" id="discount_type" value="">
                          <input type="text" name="discount_amount" id="discount_amount" value=""> -->
                          <input type="text" name="last_total" id="last_total">
                          <input type="text" name="table_data" id="table_data" value='<?php echo $product ?>'>
                          <input type="text" name="table_data1" id="table_data1">
                          
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
                              <td align="right">Total : </td><td><span id="lasttotal">&nbsp;<?php echo $row->total; ?></span></td>
                            </tr>
                          </table>
                        </div> <!-- /controls -->       
                      </div> <!-- /control-group -->

                      <br>
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
                                  <textarea class="ckeditor" id="editor" name="note" value=""><?php echo $row->note; ?></textarea>
                                  <span style="color:red;" id="err_note"></span>
                                </div>
                                <div class="tab-pane active" id="internal_note">
                                  <textarea class="ckeditor" id="editor" name="internal_note" value=""><?php echo $row->internal_note; ?></textarea>
                                  <span style="color:red;" id="err_note"></span>
                                </div>
                              </div>
                            </div>
                          </div> <!-- /controls -->       
                      </div> <!-- /control-group -->      
                      <?php } ?>
                      <div class="form-actions">
                        <button type="submit" class="btn btn-primary" id="submit_add_user">Save</button> 
                        <button class="btn">Cancel</button>
                      </div> <!-- /form-actions -->
        
                    </fieldset>
                  </form>
            
              </div> <!-- /widget-content -->
            </div>

          </div> <!-- /span12 -->
   
       </div> <!-- /row -->
  
      </div> <!-- /container -->
      
  </div> <!-- /main-inner -->
    
</div> <!-- /main -->
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
    var i = <?php echo $i++; ?>;
    var product_data = new Array();
    $('#product').keyup(function(){
      var code = $('#product').val();
      var search_option = $("input[name='product_search']:checked").val();
      $('#autoproduct').html('');
      code = $.trim(code);
      //alert('hi');
      if(code){
        $.ajax({
          url:"<?php echo base_url(); ?>index.php/purchase/getAutoCodeName/"+code+"/"+search_option,
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
        });
      }
    }); 
    var counter = <?php echo count($items); ?>;
    
    function addRow(){
          $('#err_product').text('');
          var code = $("#product").val();
          var flag = 0;
          var search_option = $("input[name='product_search']:checked").val();
          //alert(search_option);
          $.ajax({
              url: "<?php echo base_url('index.php/purchase/getProduct') ?>/"+code+"/"+search_option,
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
                  //product_data.push(product);
                  //length = product_data.length - 1 ;
                  var newRow = $("<tr>");
                  var cols = "";
                  cols += "<td><a class='deleteRow'> <img src='<?php  echo base_url(); ?>assets/images/bin3.png' /> </a><input type='hidden' name='id' name='id' value="+i+"><input type='hidden' name='product_id' name='product_id' value="+id+"></td>";
                  cols += "<td>"+code+"</td>";
                  cols += "<td>"                                                                                                               
                  +"<div class = 'input-group spinner' data-trigger='spinner'>"
                                  +"<input type='text' class='form-control text-center' value='0' data-rule='quantity' name='qty"+ counter +"' id='qty"+ counter +"'>"
                                      +"<div class='input-group-addon'>"
                                        +"<a href='javascript:;' class='spin-up' data-spin='up'><i class='fa fa-caret-up'></i></a>"
                                        +"<a href='javascript:;' class='spin-down' data-spin='down'><i class='fa fa-caret-down'></i></a>"
                                      +"</div>"
                                +"</div>"
                        +"</td>";
                  cols += "<td>"+data[0].quantity+"</td>";
                  cols += "<td>"+data[0].unit+"</td>";
                  cols += "<td>" 
                            +"<span id='price'>"
                              +"<input type='hidden' name='price"+ counter +"' id='price"+ counter +"' value='"+price
                            +"'>"+price
                            +"</span>"
                          +"</td>";
                  cols += "<td>"
                            +"<span id='sub_total'>"
                              +"<input type='text' class='txt-height' style='' value='0.00' name='linetotal"+ counter +"' id='linetotal"+ counter +"' readonly>"
                            +"</span>"
                          +"</td>";
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
        calculateRow($(this).closest("tr"));
        calculateGrandTotal();
    });
    /*$('table.product_table input[name^="qty"]').change(function(){
      alert();
       
    });*/
    function calculateRow(row) {
      var key = +row.find('input[name^="id"]').val();
      var price = +row.find('input[name^="price"]').val();
      var qty = +row.find('input[name^="qty"]').val();
      var product_id = +row.find('input[name^="product_id"]').val();
      row.find('input[name^="linetotal"]').val((price * qty).toFixed(2));
      if(product_data[key]==null){
        var temp = {
          "product_id" : product_id,
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
      $("#grandtotal").text(grandTotal.toFixed(2));
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

    $("#submit_add_user").click(function(event){
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

        if(warehouse=="Select"){
          $("#err_warehouse").text("Please Enter Warehouse");
          $('#warehouse').focus();
          return false;
        }
        else{
          $("#err_warehouse").text("");
        }
//warehouse code validation complite.

        if(biller=="Select"){
          $("#err_biller").text("Please Enter Biller");
          $('#biller').focus();
          return false;
        }
        else{
          $("#err_biller").text("");
        }
//biller code validation complite.

         if(client=="Select"){
          $("#err_client").text("Please Enter Client");
          $('#client').focus();
          return false;
        }
        else{
          $("#err_client").text("");
        }
//client code validation complite.
      
         if(discount=="Select"){
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
      $('#product_table_body').empty();
      $('#table_data').val('clear');
      $('#last_total').val('');
      $('#grand_total').val('');
      $('#grandtotal').text('0.00');
      $('#totaldiscount').text('0.00');
      $('#lasttotal').text('0.00');
      emptyProductData();
      if(warehouse=="Select"){
        $("#err_warehouse").text("Please Enter Warehouse");
        $('#warehouse').focus();
        return false;
      }
      else{
        $("#err_warehouse").text("");
      }
    $("#biller").change(function(event){
      var biller = $('#biller').val();
      if(biller=="Select"){
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
      if(client=="Select"){
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
      if(discount=="Select"){
        $("#err_discount").text("Please Enter Discount");
        $('#discount').focus();
        return false;
      }
      else{
        $("#err_discount").text("");
      }
      if(discount!="Select"){
        $.ajax({
          url: "<?php echo base_url('sales/getDiscount') ?>/"+discount,
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
          },
          error: function(xhr, status, error) {
            alert(error);
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