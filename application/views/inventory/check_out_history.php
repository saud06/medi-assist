<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','manager');
if(!(in_array($this->session->userdata('type'),$p))){
  redirect('auth');
}
$this->load->view('layout/header');
?>

<script type="text/javascript">
  function delete_id(id)
  {
   if(confirm('<?php echo $this->lang->line('inventory_delete_conform'); ?>'))
   {
    window.location.href='<?php  echo base_url('inventory/delete/'); ?>'+id;
  }
}
</script>
<div class="content-wrapper">
  <?php 
    // $this->load->view('layout/sticky_note');
  ?>
  
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h5>
     <ol class="breadcrumb">
      <li><a href="<?php echo base_url('auth/dashboard'); ?>" class="text-black"><i class="fa fa-dashboard">&nbsp;</i><strong><?php echo $this->lang->line('header_dashboard'); ?></strong></a></li>
      <li class="active">Check-Out History</li>
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
            <h3 class="box-title">Check-Out History</h3>
            <!--    <a class="btn btn-sm btn-info pull-right" style="margin: 10px" href="<?php echo base_url('inventory/add');?>"><?php echo $this->lang->line('inventory_add_new_inventory'); ?></a> -->
          </div>
          <!-- /.box-header -->

          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Check-In </a></li>
              <li><a href="#tab_2" data-toggle="tab">Sales</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_1">
                <div class="box-body outer-scroll">
                  <div class="inner-scroll">
                    <div class="row">
                      <div class="col-sm-12">
                        <strong>Check-Out History Filter:</strong> &emsp;

                        <select class="form-control select2" name="category_id" id="category_id" style="width: 20%;">
                          <option value="" selected>All Categories</option>

                          <?php 
                            foreach ($categories as $category) {
                          ?>
                              <option value="<?php echo $category->category_id ?>"><?php echo $category->category_name ?></option>
                          <?php
                            }
                          ?>
                        </select> &emsp;

                        <select class="form-control select2" name="sub_category_id" id="sub_category_id" style="width: 20%;">
                          <option value="" selected>All Subcategories</option>
                          
                          <?php 
                            foreach ($subcategories as $subcategory) {
                          ?>
                              <option value="<?php echo $subcategory->sub_category_id ?>"><?php if($subcategory->category_id == 0){ echo 'N/A'; } else{ echo $subcategory->sub_category_name; } ?></option>
                          <?php
                            }
                          ?>
                        </select> &emsp;

                        <button title="Filter Inventory Item List" type="button" id="btn_ajax" class="btn bg-gray"><i class="fa fa-search" aria-hidden="true"></i></button>&emsp;

                        <div class="btn-group">
                          <button title="Print Check-Out History" type="button" class="btn bg-gray gropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-print" aria-hidden="true"></i>&nbsp;
                            <span class="fa fa-angle-double-down"></span>
                          </button>
                          <ul class="dropdown-menu">
                            <li>
                              <a href="#" target="_blank" onclick="printContent('print')">Print (Default)</a>
                            </li>
                            <li id="pdf">
                              <a href="<?php echo base_url('inventory/check_out_history_pdf');?>" target="_blank">PDF (On Letter Head)</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    </div>
                    <br>

                    <table id="index" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Reference No.</th>
                          <th>Product Name</th>
                          <!-- <th>Category</th>
                          <th>Sub Category</th> -->
                          <th>Customer</th>                
                          <th>Issued Datetime</th>
                          <th>Quantity</th> 
                          <th>Checked By</th> 
                          <th>Check-In</th> 
                        </tr>
                      </thead>
                      <tbody id="records">
                        <?php
                        foreach ($data as $i => $row) {
                         $id= $row->check_out_history_id; ?>
                         <tr>
                          <td><?php echo $i++; ?> </td>
                          <td><?php echo $row->reference_no; ?></td> 
                          <td><?php 
                          $product_id= $row->product_id;
                          $this->db->where('product_id', $product_id);
                          $cat_id = $this->db->get('check_out_history')->result_array();
                          $var = $cat_id[0]['product_id'];
                          $cat_idd = explode(",", $var);
                          foreach ($cat_idd as $value) {
                            $this->db->where('product_id', $value);
                            $cat_name = $this->db->get('products')->result_array();
                            echo $cat_name[0]['name'] . '<br>';
                          }

                          ?>
                          </td>
                          <!-- <td><?php 
                          $product_id= $row->product_id;
                          $this->db->where('product_id', $product_id);
                          $cat_id = $this->db->get('products')->result_array();
                          $var = $cat_id[0]['category_id'];
                          $cat_idd = explode(",", $var);
                          foreach ($cat_idd as $value) {
                            $this->db->where('category_id', $value);
                            $cat_name = $this->db->get('category')->result_array();
                            echo $cat_name[0]['category_name'] . '<br>';
                          }
                          ?>
                          </td> -->
                          <!-- <td><?php 
                          $product_id= $row->product_id;
                          $this->db->where('product_id', $product_id);
                          $cat_id = $this->db->get('products')->result_array();
                          $var = $cat_id[0]['subcategory_id'];
                          $cat_idd = explode(",", $var);
                          foreach ($cat_idd as $value) {
                            $this->db->where('sub_category_id', $value);
                            $cat_name = $this->db->get('sub_category')->result_array();
                            if($cat_name){
                              echo $cat_name[0]['sub_category_name'] . '<br>';
                            }
                          }
                          ?>
                          </td> -->

                          <td><?php echo $row->company_name; ?></td> 
                          <td><?php echo $row->out_date; ?></td>
                          <td><?php echo $row->out_quantity; ?></td> 
                          <td><?php echo $row->user_name; ?></td> 
                          <td><button title="Check-In" class="btn btn-sm bg-gray" onclick="checkout(<?php echo $id;?>); "><i class="fa fa-sign-in"></i></button></td>
                         </tr>
                        <?php
                        }
                        ?>
                      </tbody>
                      <tfoot>
                        <tr>
                          <th>No.</th>
                          <th>Reference No.</th>
                          <th>Product Name</th>
                          <!-- <th>Category</th>
                          <th>Sub Category</th> -->
                          <th>Customer</th>
                          <th>Issued Datetime</th>
                          <th>Quantity</th> 
                          <th>Checked By</th> 
                          <th>Check-In</th>   
                        </tr>
                      </tfoot>
                    </table>

                    <div style="display: none;" id="print">
                      <div id="header" class="box-header with-border" style="text-align: center; display: none">
                        <!-- <img width="300" height="100" src="<?php echo base_url().'assets/images/winmarkFinal.png'; ?>"><br>
                        <hr> -->

                        <h3 class="box-title">
                          Check-Out History
                        </h3>
                        <br><br>

                        <table id="pindex" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th>No.</th>
                              <th>Reference No.</th>
                              <th>Product Name</th>
                              <!-- <th>Category</th>
                              <th>Sub Category</th> -->
                              <th>Customer</th>
                              <th>Issued Datetime</th>
                              <th>Quantity</th>
                              <th>Checked By</th> 
                            </tr>
                          </thead>
                          <tbody id="precords">
                            <?php
                            foreach ($data as $i => $row) {
                             $id= $row->check_out_history_id; ?>
                             <tr>
                              <td><?php echo ++$i; ?> </td>
                              <td><?php echo $row->reference_no; ?></td> 
                              <td><?php 
                              $product_id= $row->product_id;
                              $this->db->where('product_id', $product_id);
                              $cat_id = $this->db->get('check_out_history')->result_array();
                              $var = $cat_id[0]['product_id'];
                              $cat_idd = explode(",", $var);
                              foreach ($cat_idd as $value) {
                                $this->db->where('product_id', $value);
                                $cat_name = $this->db->get('products')->result_array();
                                echo $cat_name[0]['name'] . '<br>';
                              }

                              ?>
                              </td>
                              <!-- <td><?php 
                              $product_id= $row->product_id;
                              $this->db->where('product_id', $product_id);
                              $cat_id = $this->db->get('products')->result_array();
                              $var = $cat_id[0]['category_id'];
                              $cat_idd = explode(",", $var);
                              foreach ($cat_idd as $value) {
                                $this->db->where('category_id', $value);
                                $cat_name = $this->db->get('category')->result_array();
                                echo $cat_name[0]['category_name'] . '<br>';
                              }
                              ?>
                              </td> -->
                              <!-- <td><?php 
                              $product_id= $row->product_id;
                              $this->db->where('product_id', $product_id);
                              $cat_id = $this->db->get('products')->result_array();
                              $var = $cat_id[0]['subcategory_id'];
                              $cat_idd = explode(",", $var);
                              foreach ($cat_idd as $value) {
                                $this->db->where('sub_category_id', $value);
                                $cat_name = $this->db->get('sub_category')->result_array();
                                if($cat_name){
                                  echo $cat_name[0]['sub_category_name'] . '<br>';
                                }
                              }
                              ?>
                              </td> -->

                              <td><?php echo $row->company_name; ?></td> 
                              <td><?php echo $row->out_date; ?></td>
                              <td><?php echo $row->out_quantity; ?></td> 
                              <td><?php echo $row->user_name; ?></td> 
                             </tr>
                            <?php
                            }
                            ?>
                          </tbody>
                          <tfoot>
                            <tr>
                              <th>No.</th>
                              <th>Reference No.</th>
                              <th>Product Name</th>
                              <!-- <th>Category</th>
                              <th>Sub Category</th> -->
                              <th>Customer</th>
                              <th>Issued Datetime</th>
                              <th>Quantity</th> 
                              <th>Checked By</th> 
                            </tr>
                          </tfoot>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.tab-pane -->

              <div class="tab-pane" id="tab_2">
                <div class="row">
                  <div class="col-sm-4"></div>
                  <div class="col-sm-4">
                    <div class="form-group"></div>
                      <label for="subcategory">
                        Client 
                      </label>

                      <select class="form-control select2" id="client_id" name="client_id" style="width: 100%" onchange="clientAjax()">
                        <option value="">Select Client</option>
                        <?php
                          foreach ($client as $value) {
                           echo "<option value='$value->client_id'".set_select('client',$value->client_id).">$value->company_name</option>";
                          }
                        ?>
                      </select>                      
                    </div>
                  </div>

                  <form name="actionForm" action="<?php echo base_url('inventory/sales'); ?>" method="post" onsubmit="return saleConfirm();"/>  
                    <div class="box-body">
                      <table id="index1" class="table table-striped table-bordered ">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <!--  <th>Reference No</th> -->
                            <th>Product Name</th>
                            <th>Customer</th>  
                            <th>Quantity</th> 
                            <th>Select</th> 
                          </tr>
                        </thead>
                        <tbody id="records">
                        </tbody>
                        <thead>
                          <tr>
                            <th>No.</th>
                            <!--  <th>Reference No</th> -->
                            <th>Product Name</th>
                            <th>Customer</th>  
                            <th>Quantity</th> 
                            <th>Select</th> 
                          </tr>
                        </thead>
                      </table>
                      
                      <div class="row">
                        <div class="col-sm-5"></div>
                        <div class="col-sm-2">
                          <button class="btn bg-gray" id="check"><i class="glyphicon glyphicon-plus"></i> Add Selected Item(s) For Sale</button>         
                        </div>
                        <div class="col-sm-5"></div>
                      </div>
                    </div>
                  </form>
                </div>
                <!-- /.box -->
              </div>
              <!--/.col (right) -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
    <!-- /.content -->
</div>

  <script type="text/javascript">
    $('#btn_ajax').click(function(){
      var category_id = $('#category_id').val();
      if(!category_id) category_id = 0;
      var sub_category_id = $('#sub_category_id').val();
      if(!sub_category_id) sub_category_id = 0;

      $.ajax({
        url: "<?php echo base_url('inventory/filter_check_out_history') ?>/",
        type: "POST",
        dataType: "JSON",
        data : {
          category_id: category_id,
          sub_category_id: sub_category_id
        },
        success: function (response) {
          console.log(response);
          var table = $('#index').DataTable();
          table.destroy({
            "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": 0
            } ],
            "order": [[ 1, 'asc' ]],
            "pageLength": 100
          });
          $('#records').empty();

          var trHTML = '';
          $.each(response.data, function (i, item) {
            trHTML += '<tr>';
            trHTML += '<td>'+(i+1)+'</td>';
            trHTML += '<td>' + item.reference_no + '</td>';
            trHTML += '<td>' + item.name + '</td>';
            /*trHTML += '<td>' + item.category_name + '</td>';

            var sub_category_name = item.sub_category_name;
            if(sub_category_name == null){
              sub_category_name = '';
            }
            trHTML += '<td>' + sub_category_name + '</td>';*/
            
            trHTML += '<td>' + item.company_name + '</td>';
            trHTML += '<td>' + item.out_date + '</td>';
            trHTML += '<td>' + item.out_quantity + '</td>';
            trHTML += '<td>' + item.user_name + '</td>';

            trHTML += '<td><button title="Check-In" class="btn btn-sm bg-gray" onclick="checkout(' + item.check_out_history_id + '); "><i class="fa fa-sign-in"></i></button></td>';

            trHTML += '</tr>';
          });
          
          $('#records').append(trHTML);
          $('#index').DataTable();

          $('#precords').empty();

          var trHTML = '';
          $.each(response.data, function (i, item) {
            trHTML += '<tr>';
            trHTML += '<td>'+(i+1)+'</td>';
            trHTML += '<td>' + item.reference_no + '</td>';
            trHTML += '<td>' + item.name + '</td>';
            /*trHTML += '<td>' + item.category_name + '</td>';

            var sub_category_name = item.sub_category_name;
            if(sub_category_name == null){
              sub_category_name = '';
            }
            trHTML += '<td>' + sub_category_name + '</td>';*/
            
            trHTML += '<td>' + item.company_name + '</td>';
            trHTML += '<td>' + item.out_date + '</td>';
            trHTML += '<td>' + item.out_quantity + '</td>';
            trHTML += '<td>' + item.user_name + '</td>';

            trHTML += '</tr>';
          });
          
          $('#precords').append(trHTML);
        }
      });

      $("#pdf").html('<a href="<?php echo base_url('inventory/filterCheckOutHistoryPDF/');?>' + category_id + '/' + sub_category_id + '" target="_blank">PDF (On Letter Heads)</a>');
    });

    function printContent(el){
      $('#header').show();
      // $('.table-bordered th').eq(0).css("min-width", "");
      $('.table-bordered').css("font-size", "12px");
      $('.table-bordered tfoot').css( "display", "table-row-group");
      $(".table-bordered td, .table-bordered th").each(function(){ $(this).css("text-align", "center") });
      $(".table-bordered td, .table-bordered th").each(function(){ $(this).css("vertical-align", "middle") });
      //var restorepage = document.body.innerHTML;
      var printcontent = document.getElementById(el).innerHTML;
      document.body.innerHTML = printcontent;
      window.print();
      //document.body.innerHTML = restorepage;
    }
    
    window.onafterprint = function(){
      window.location.reload(true);
    }

    var productSale = [];

    function clientAjax(){
      var client_id = $("#client_id").val();
    //alert(client_id);
    $.ajax({
      url: "<?php echo base_url('inventory/client_data') ?>/"+client_id,
      type: "GET",
      dataType: "JSON",
      success: function (response) {

       var table = $('#index1').DataTable();
       table.destroy();
       $('#records').empty();

       var trHTML = '';
       $.each(response.data, function (i, item) {
        //productSale.push(item.product_id,item.code,item.name,item.out_quantity,item.shelf_id,item.rack_id,'XX');

       // var productSale = [];
      /*  for(i=0;i<item.length;i++)
        { 
         productSale.push(item.product_id,item.code,item.name,item.out_quantity,item.shelf_id,item.rack_id);          

       }*/

       var temp_sale = [item.product_id,item.code,item.name,item.shelf_id,item.rack_id,item.out_quantity];
       productSale.push(temp_sale);

       trHTML += '<tr>';
       trHTML += '<td></td>';
       /* trHTML += '<td>' + item.reference_no + '</td>';*/            
       trHTML += '<td>' + item.name + '</td>';
       trHTML += '<td>' + item.company_name + '</td>';
       trHTML += '<td>' + '<input type="number" id="out_quantity_'+i+'" name="out_quantity" onkeyup="change_ids('+i+')" value="' +item.out_quantity+ '" min="1" max="' +item.out_quantity+ '" class="form-control">' + '</td>';
       trHTML += '<td>' + '<input type="checkbox" id="selected_ids_'+i+'" name="selected_id[]" value="' +productSale[i]+ '" class="checkbox"><input  type="hidden" name="client_id" value="' +client_id+ '">' + '</td>';

       trHTML += '</tr>';
     });

       $('#records').append(trHTML);

       $(document).ready(function() {
        var t = $('#index1').DataTable( {
          "columnDefs": [ {
            "searchable": false,
            "orderable": false,
            "targets": 0
          } ],
          "order": [[ 1, 'asc' ]]
        });

        t.on( 'order.dt search.dt', function () {
          t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
            cell.innerHTML = i+1;
          });
        }).draw();
      });
     }
   });
  }

  function change_ids(indx){
    productSale[indx][5] = $("#out_quantity_"+indx).val();
    $('#selected_ids_' + indx).val(productSale[indx][0] + "," + productSale[indx][1] + "," + productSale[indx][2] + "," + productSale[indx][3] + "," + productSale[indx][4] + "," + productSale[indx][5]);
  }

  $('#check').click(function() {
    if($('input[name="selected_id[]"]:checked').length < 1){
      alert('You didnt Select any Item(s).');
      return false;
    }
  });
</script>

<script type="text/javascript">
 var save_method;
/* function add_book()
 {
  save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_checkin').modal('show'); // show bootstrap modal

    }*/
    function checkout(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo base_url('inventory/check_in/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          console.log(data);
          $('input[name="inventory_id"]').val(data[0].inventory_id);
          $('input[name="product_id"]').val(data[0].product_id);
          $('[name="name"]').val(data[0].name);
          $('[name="quantity"]').val(data[0].quantity);
          $('[name="company_name"]').val(data[0].company_name1);
          $('[name="company_name2"]').val(data[0].company_name2);
          $('[name="cost"]').val(data[0].cost);
          $('[name="out_quantity"]').val(data[0].out_quantity);

          var client_data = data[0].client_data;
          // $('[name="product_approval_id"]').val(data[0].client_data[0].product_approval_id);
          // $('[name="company_name2"]').val(data[0].client_data[0].company_name2);

          var approval_status = data[0].client_data[0].approval_status;
          if(approval_status == 'Pending'){
            $('#approval_div').html('\
                <input name="approval_status" value="Approved" class="minimal" type="radio">&nbsp; Approved &emsp;\
                <input name="approval_status" value="Not Approved" class="minimal" type="radio">&nbsp; Not Approved\
                <input name="product_approval_id" id="product_approval_id" value="' + data[0].client_data[0].product_approval_id + '" type="hidden">\
                <span class="validation-color" id="err_approval_status"></span>\
            ');
          }
          else if(approval_status == 'Approved'){
            $('#approval_div').html('\
                <input name="approval_status" value="Approved" class="minimal" type="radio" checked disabled>&nbsp; Approved &emsp;\
                <input name="approval_status" value="Not Approved" class="minimal" type="radio" disabled>&nbsp; Not Approved\
            ');
          }
          else{
            $('#approval_div').html('\
                <input name="approval_status" value="Approved" class="minimal" type="radio" disabled>&nbsp; Approved &emsp;\
                <input name="approval_status" value="Not Approved" class="minimal" type="radio" checked disabled>&nbsp; Not Approved\
            ');
          }

          $('[name="out_date"]').val(data[0].out_date);
          $('[name="client_id"]').val(data[0].client_id);
          $('[name="client_id2"]').val(data[0].client_id2);
          $('[name="check_out_history_id"]').val(data[0].check_out_history_id);
          $('[name="reference_no"]').val(data[0].reference_no);

          $('#modal_checkin').modal('show'); 
          $('.modal-title').text('Product Check-In'); 

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          alert('Error get data from ajax');
        }
      });
    }


    function checkInSave()
    {
      var url = "<?php echo base_url('inventory/checkin_add/')?>";
      var in_quantity = $('[name="in_quantity"]').val();
      var out_quantity = $('[name="out_quantity"]').val();

      if(!$('[name="approval_status"]').is(':checked')){
        $("#err_approval_status").text("Choose Approval Status.");
        return false;
      }
      else{
        $("#err_approval_status").text("");
      }

      if(in_quantity == null || in_quantity == ""){
        $("#err_in_quantity").text("Insert Quantity.");
        return false;
      }
      else{
        $("#err_in_quantity").text("");
      }
      
      if (parseInt(in_quantity) > parseInt(out_quantity)) {
        $('#err_in_quantity').text("Invalid In Quantity.");  
        return false;
      }
      else{
        $("#err_in_quantity").text("");
      }

      $('#btnSave').prop('disabled', true);
      $('#btnSave').css('cursor', 'default');
      $('#btnSave').toggleClass('active');
      
      $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
          location.reload();
        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          alert('Error check out adding data'+errorThrown);
        }
      });
    }       

   </script>



   <!-- modal -->

   <div class="modal fade" id="modal_checkin" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title">Product Check-In</h3>
        </div>
        <div class="modal-body form">
          <form action="#" id="form" class="form-horizontal">
            <input type="hidden" value="" name="inventory_id" id="inventory_id" />
            <input type="hidden" value="" name="product_id" id="product_id" />
            <input type="hidden" value="" name="check_out_history_id" id="check_out_history_id" />
            <input type="hidden" value="" name="client_id" id="client_id" />
            <input type="hidden" value="" name="client_id2" id="client_id2" />

            <div class="form-body">
              <div class="form-group">
                <label class="control-label col-md-3">Check-Out No</label>
                <div class="col-md-9">
                  <input name="reference_no" placeholder="name" class="form-control" type="text" readonly="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Product</label>
                <div class="col-md-9">
                  <input name="name" placeholder="name" class="form-control" type="text" readonly="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Client</label>
                <div class="col-md-9">
                  <input name="company_name" placeholder="company_name" class="form-control" type="text" readonly="">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Cost</label>
                <div class="col-md-9">
                  <input name="cost" placeholder="cost" class="form-control" type="text" readonly="">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Out Quantity</label>
                <div class="col-md-9">
                  <input name="out_quantity" placeholder="Out quantity" class="form-control" type="number" readonly="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Issued Datetime</label>
                <div class="col-md-9">
                  <input name="out_date" placeholder="Out quantity" class="form-control" type="text" readonly="">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Manufacturer / Supplier </label>
                <div class="col-md-9">
                  <input name="company_name2" placeholder="company_name2" class="form-control" type="text" readonly="">
                </div>
              </div>

              <div class="form-group">
                <div id="approval_div" class="col-md-5 pull-right" style="text-align: right;">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">In Quantity <span class="validation-color">*</span></label>
                <div class="col-md-9">
                  <input name="in_quantity" placeholder="Insert Quantity" class="form-control" type="number">
                  <span class="validation-color" id="err_in_quantity"></span>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Status</label>
                <div class="col-md-9">
                  <select class="form-control select2" id="status" name="status" style="width: 100%;">
                    <option value="">Select Status</option>                
                    <option value="Fully Returned">Fully Returned</option>
                    <option value="Partially Returned">Partially Returned</option>
                    <option value="Fully Sold">Fully Sold</option>
                    <option value="Partially Sold">Partially Sold</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Remarks</label>
                <div class="col-md-9">
                  <input name="remarks" placeholder="Remarks" class="form-control" type="text">

                </div>
              </div>

            </div>
          </form>
        </div>
        <div class="modal-footer">
          <!-- <button type="button" id="btnSave" onclick="checkInSave()" class="btn bg-gray">Check-In</button> -->
          <button type="submit" id="btnSave" class="button btn bg-gray" style="padding: 1.6rem 4.125rem;" onclick="checkInSave()">
            <span class="submit" style="left: 20%;">Check-In</span>
            <span class="loading" style="left: 32%"><i class="fa fa-circle-o-notch"></i></span>
          </button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

  <!-- /.modal -->



  <?php
  $this->load->view('layout/footer');
  ?>




  <script type="text/javascript">
    function saleConfirm(){

      var result = confirm("Sure to Add Selected Item(s) for Sale?");
      if(result){
        return true;
      }else{
        return false;
      }
    }
    function deleteConfirm(){
      var result = confirm("Do you really want to delete selected records?");
      if(result){
        return true;
      }else{
        return false;
      }
    }
    $(document).ready(function(){
      $('#check_all').on('click',function(){
        if(this.checked){
          $('.checkbox').each(function(){
            this.checked = true;
          });
        }else{
         $('.checkbox').each(function(){
          this.checked = false;
        });
       }
     });

      $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
          $('#check_all').prop('checked',true);
        }else{
          $('#check_all').prop('checked',false);
        }
      });
    });
  </script>

