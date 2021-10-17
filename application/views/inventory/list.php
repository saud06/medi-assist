<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','manager');
if(!(in_array($this->session->userdata('type'),$p))){
  redirect('auth');
}
$this->load->view('layout/header');
?>

<script type="text/javascript">
  function delete_id(id){
    if(confirm('<?php echo $this->lang->line('inventory_delete_conform'); ?>')){
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
        <li class="active">Inventory Item</li>
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
            <h3 class="box-title">Inventory Item List</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body outer-scroll">
            <div class="inner-scroll">
              <div class="row">
                <div class="col-sm-12">
                  <strong>Inventory Item List Filter:</strong> &emsp;

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
                    <button title="Print Inventory Item List" type="button" class="btn bg-gray gropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-print" aria-hidden="true"></i>&nbsp;
                      <span class="fa fa-angle-double-down"></span>
                    </button>
                    <ul class="dropdown-menu">
                      <li>
                        <a href="#" target="_blank" onclick="printContent('print')">Print (Default)</a>
                      </li>
                      <li id="pdf">
                        <a href="<?php echo base_url('inventory/list_pdf');?>" target="_blank">PDF (On Letter Head)</a>
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
                    <th>Product Name</th>
                    <th>Product<br>Details</th>
                    <th>Client</th>
                    <th>Sales<br>Quantity</th> 
                    <th>Check-Out<br>Quantity</th>
                    <th>Check-In<br>Quantity</th>                
                    <th>Available<br>Quantity</th>
                  </tr>
                </thead>
                <tbody id="records">
                  <?php
                    $i=1;
                    foreach ($data as $row) {
                      $id= $row->inventory_id;
                  ?>
                      <tr <?php if(isset($product_id) && $row->product_id == $product_id) { echo "style='background-color: #BFE2FF'";}?>>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $row->name; ?></td>
                        <td>
                          <button title="View Product Specification" type="button" onclick="btn_inv(<?php echo $row->product_id; ?>)" class="btn btn-sm bg-gray"><span class="glyphicon glyphicon-eye-open"></span></button>
                        </td>
                        <td>
                          <?php 
                            $client_id= $row->client_id;
                            $this->db->where('client_id', $client_id);
                            $cat_id = $this->db->get('products')->result_array();
                            $var = $cat_id[0]['client_id'];
                            $cat_idd = explode(",", $var);
                            foreach ($cat_idd as $key => $value) {
                              $this->db->where('client_id', $value);
                              $cat_name = $this->db->get('client')->result_array();
                              if($cat_name){
                                echo ($key+1) . '. ' . $cat_name[0]['company_name'] . '<br>';
                              }
                            }
                          ?>
                        </td>
                        <td><?php echo $row->totalSales; ?></td>
                        <td><?php echo $row->totalOut; ?></td>
                        <td><?php echo $row->totalIn; ?></td>
                        <td><?php echo ($row->totalProduct - $row->totalOut) + $row->totalIn; ?></td>
                      </tr>
                  <?php
                    }
                  ?>
                </tbody>

                <tfoot>
                  <tr>
                    <th>No.</th>
                    <th>Product Name</th>
                    <th>Product<br>Details</th>
                    <th>Client</th>
                    <th>Sales<br>Quantity</th>
                    <th>Check-Out<br>Quantity</th>
                    <th>Check-In<br>Quantity</th>
                    <th>Available<br>Quantity</th>
                  </tr>
                </tfoot>
              </table>

              <div style="display: none;" id="print">
                <div id="header" class="box-header with-border" style="text-align: center; display: none">
                  <!-- <img width="300" height="100" src="<?php echo base_url().'assets/images/winmarkFinal.png'; ?>"><br>
                  <hr> -->

                  <h3 class="box-title">
                    Inventory Item List
                  </h3>
                  <br><br>

                  <table id="pindex" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No.</th>
                        <th>Product Name</th>
                        <th>Client</th>
                        <th>Sales<br>Quantity</th> 
                        <th>Check-Out<br>Quantity</th>
                        <th>Check-In<br>Quantity</th>                
                        <th>Available<br>Quantity</th>
                      </tr>
                    </thead>
                    <tbody id="precords">
                      <?php
                        foreach ($data as $i => $row) {
                          $id= $row->inventory_id;
                      ?>
                          <tr>
                            <td><?php echo ++$i; ?></td>
                            <td><?php echo $row->name; ?></td>
                            <td>
                              <?php 
                                $client_id= $row->client_id;
                                $this->db->where('client_id', $client_id);
                                $cat_id = $this->db->get('products')->result_array();
                                $var = $cat_id[0]['client_id'];
                                $cat_idd = explode(",", $var);
                                foreach ($cat_idd as $key => $value) {
                                  $this->db->where('client_id', $value);
                                  $cat_name = $this->db->get('client')->result_array();
                                  if($cat_name){
                                    echo ($key+1) . '. ' . $cat_name[0]['company_name'] . '<br>';
                                  }
                                }
                              ?>
                            </td>
                            <td><?php echo $row->totalSales; ?></td>
                            <td><?php echo $row->totalOut; ?></td>
                            <td><?php echo $row->totalIn; ?></td>
                            <td><?php echo ($row->totalProduct - $row->totalOut) + $row->totalIn; ?></td>
                          </tr>
                      <?php
                        }
                      ?>
                    </tbody>

                    <tfoot>
                      <tr>
                        <th>No.</th>
                        <th>Product Name</th>
                        <th>Client</th>
                        <th>Sales<br>Quantity</th>
                        <th>Check-Out<br>Quantity</th>
                        <th>Check-In<br>Quantity</th>
                        <th>Available<br>Quantity</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
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

<div class="modal fade" id="modal_checkout" role="dialog">
  <div class="modal-dialog" style="width: 60%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"></h3>
      </div>
      <div class="modal-body form">
        <div class="form-horizontal">
          <div class="form-body">
            <div class="row">
              <div class="col-sm-6">
                <div class="form-group">
                  <label class="control-label col-md-3">Product Code</label>
                  <div class="col-md-9">
                    <input class="form-control" id="product_code" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3">Name</label>
                  <div class="col-md-9">
                    <input class="form-control" id="name" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3">Category</label>
                  <div class="col-md-9">
                    <input class="form-control" id="category" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3">Subcategory</label>
                  <div class="col-md-9">
                    <input class="form-control" id="subcategory" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3">Client</label>
                  <div class="col-md-9">
                    <input class="form-control" id="client" readonly>
                  </div>
                </div>
              </div>

              <div class="col-sm-6">
                <div class="form-group">
                  <label class="control-label col-md-3">Product Image</label>
                  <div class="col-md-9">
                    <img id="image" width="27%" height="27%">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3">Product Details</label>
                  <div class="col-md-9">
                    <textarea class="form-control" id="product_details" readonly></textarea>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3">Is Inventory</label>
                  <div class="col-md-9">
                    <input type="checkbox" class="" id="is_inventory" onclick="return false;">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php
  $this->load->view('layout/footer');
?>

<script type="text/javascript">
  $('#btn_ajax').click(function(){
    var category_id = $('#category_id').val();
    if(!category_id) category_id = 0;
    var sub_category_id = $('#sub_category_id').val();
    if(!sub_category_id) sub_category_id = 0;

    $.ajax({
      url: "<?php echo base_url('inventory/filter_inventory_item') ?>/",
      type: "POST",
      dataType: "JSON",
      data : {
        category_id: category_id,
        sub_category_id: sub_category_id
      },
      success: function (response) {
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
          trHTML += '<td>' + item.name + '</td>';

          var product_id = item.product_id;
          trHTML += '<td><button title="View Product Specification" type="button" onclick="btn_inv(' + product_id + ')" class="btn btn-sm bg-gray"><span class="glyphicon glyphicon-eye-open"></span></button></td>';
          
          var client_name = item.client_name;
          trHTML += '<td>';
            for(i=0; i<client_name.length; i++){
              trHTML += (i+1) + '. ' + client_name[i].company_name + '<br>';
            }
          trHTML += '</td>';
          
          trHTML += '<td>' + item.totalSales + '</td>';
          trHTML += '<td>' + item.totalOut + '</td>';
          trHTML += '<td>' + item.totalIn + '</td>';
          trHTML += '<td>' + (+item.totalProduct - +item.totalOut + +item.totalIn) + '</td>';
          trHTML += '</tr>';
        });
        
        $('#records').append(trHTML);
        $('#index').DataTable();

        $('#precords').empty();

        var trHTML = '';
        $.each(response.data, function (i, item) {
          trHTML += '<tr>';
          trHTML += '<td>'+(i+1)+'</td>';
          trHTML += '<td>' + item.name + '</td>';
          
          var client_name = item.client_name;
          trHTML += '<td>';
            for(i=0; i<client_name.length; i++){
              trHTML += (i+1) + '. ' + client_name[i].company_name + '<br>';
            }
          trHTML += '</td>';
          
          trHTML += '<td>' + item.totalSales + '</td>';
          trHTML += '<td>' + item.totalOut + '</td>';
          trHTML += '<td>' + item.totalIn + '</td>';
          trHTML += '<td>' + (+item.totalProduct - +item.totalOut + +item.totalIn) + '</td>';
          trHTML += '</tr>';
        });
        
        $('#precords').append(trHTML);
      }
    });

    $("#pdf").html('<a href="<?php echo base_url('inventory/filterInventoryItemPDF/');?>' + category_id + '/' + sub_category_id + '" target="_blank">PDF (On Letter Heads)</a>');
  });

  <?php 
    if(isset($product_id)){
      ?>
      btn_inv(<?php echo $product_id; ?>);
  <?php
    }
  ?>

  function btn_inv(product_id){
    $.ajax({
      url : "<?php echo base_url('inventory/get_product/')?>/" + product_id,
      type: "GET",
      dataType: "JSON",
      success: function(response)
      {
        $('#product_code').val(response.data[0].code);
        $('#name').val(response.data[0].name);
        $('#category').val(response.data[0].category_name);
        $('#subcategory').val(response.data[0].sub_category_name);
        var clients = response.data[0].clients;
        var clients_data = '';
        for(i=0; i<clients.length; i++){
          clients_data += clients[i].company_name;
          if(i != clients.length-1){
            clients_data += '; '; 
          }
        }
        $('#client').val(clients_data);
        $('#image').attr('src', response.data[0].image);
        $('#details').val(response.data[0].details);
        if (response.data[0].is_inventory == 1){
          $("#is_inventory").prop('checked', true);
        }
        else{
          $("#is_inventory").prop('checked', false);
        }

        $('#modal_checkout').modal('show'); 
        $('.modal-title').text('Product Specification');
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        alert('Error get data from ajax');
      }
    });
  }

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
</script>