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
        <li class="active">Stock Record</li>
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
            <h3 class="box-title">Stock Record List</h3>
          </div>

          <div class="box-body outer-scroll"> 
            <div class="inner-scroll">
              <div class="row">
                <div class="col-sm-12">
                  <strong>Stock Record List Filter:</strong> &emsp;

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
                    <button title="Print Stock Record" type="button" class="btn bg-gray gropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-print" aria-hidden="true"></i>&nbsp;
                      <span class="fa fa-angle-double-down"></span>
                    </button>
                    <ul class="dropdown-menu">
                      <li>
                        <a href="#" target="_blank" onclick="printContent('print')">Print (Default)</a>
                      </li>
                      <li id="pdf">
                        <a href="<?php echo base_url('inventory/stock_record_pdf');?>" target="_blank">PDF (On Letter Head)</a>
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
                    <!-- <th>Category</th>
                    <th>Sub Category</th> -->
                    <th>Client</th>                
                    <th>Location</th>
                    <th style="text-align: center;">Transaction<br> Mode</th>
                    <th>Check-Out</th>
                  </tr>
                </thead>
                <tbody id="records">
                  <?php
                    $i = 1;
                    foreach ($data as $i => $row){
                      $id= $row->inventory_id;
                  ?>
                      <tr>
                        <td><?php echo ++$i; ?></td>
                        <td><?php echo $row->name; ?></td>
                        <!-- <td>
                          <?php 
                            $category_id= $row->category_id;
                            $this->db->where('category_id', $category_id);
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
                        <!-- <td>
                          <?php 
                            $sub_category_id= $row->subcategory_id;
                            $this->db->where('subcategory_id', $sub_category_id);
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
                        <td>
                          Shelf: <?php echo $row->shelf_name; ?><br>
                          Rack: <?php echo $row->rack_name; ?>
                        </td>
                        <td style="text-align: center;">
                          <?php 
                            if($row->totalProduct > 0){
                              echo "Purchase <br>" ?> <strong><?php echo $row->totalProduct; ?></strong>
                          <?php
                            }
                            else{
                              echo "Sales <br>"  ?> <strong><?php echo abs($row->totalProduct); ?></strong>
                          <?php 
                            }
                          ?>
                        </td>
                        <td>
                          <?php if($row->totalProduct > 0){?>
                            <button title="Check-Out" class="btn btn-sm bg-gray" onclick="checkout(<?php echo $id;?>); "><i class="fa fa-sign-out"></i></button>
                          <?php }
                          ?>
                        </td> 
                      </tr>
                  <?php
                    }
                  ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>No.</th>
                    <th>Product Name</th>
                    <!-- <th>Category</th>
                    <th>Sub Category</th> -->
                    <th>Client</th>
                    <th>Location</th>
                    <th style="text-align: center;">Transaction<br> Mode</th>
                    <th>Check-Out</th>
                  </tr>
                </tfoot>
              </table>

              <div style="display: none;" id="print">
                <div id="header" class="box-header with-border" style="text-align: center; display: none">
                  <!-- <img width="300" height="100" src="<?php echo base_url().'assets/images/winmarkFinal.png'; ?>"><br>
                  <hr> -->

                  <h3 class="box-title">
                    Stock Record
                  </h3>
                  <br><br>
                </div>

                <table id="pindex" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Product Name</th>
                      <!-- <th>Category</th>
                      <th>Sub Category</th> -->
                      <th>Client</th>                
                      <th>Location</th>
                      <th style="text-align: center;">Transaction<br> Mode</th>
                    </tr>
                  </thead>
                  <tbody id="precords">
                    <?php
                      foreach ($data as $i => $row){
                        $id= $row->inventory_id;
                    ?>
                        <tr>
                          <td><?php echo ++$i; ?> </td>
                          <td><?php echo $row->name; ?></td>
                          <!-- <td>
                            <?php 
                              $category_id= $row->category_id;
                              $this->db->where('category_id', $category_id);
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
                          <!-- <td>
                            <?php 
                              $sub_category_id= $row->subcategory_id;
                              $this->db->where('subcategory_id', $sub_category_id);
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
                          <td>
                            Shelf: <?php echo $row->shelf_name; ?><br>
                            Rack: <?php echo $row->rack_name; ?>
                          </td>
                          <td style="text-align: center;">
                            <?php 
                              if($row->totalProduct > 0){
                                echo "Purchase <br>" ?> <strong><?php echo $row->totalProduct; ?></strong>
                            <?php
                              }
                              else{
                                echo "Sales <br>"  ?> <strong><?php echo abs($row->totalProduct); ?></strong>
                            <?php 
                              }
                            ?>
                          </td>
                        </tr>
                    <?php
                      }
                    ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>No.</th>
                      <th>Product Name</th>
                      <!-- <th>Category</th>
                      <th>Sub Category</th> -->
                      <th>Client</th>
                      <th>Location</th>
                      <th style="text-align: center;">Transaction<br> Mode</th>
                    </tr>
                  </tfoot>
                </table>
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

<script type="text/javascript">
  var save_method;

  function checkout(id){
    save_method = 'update';
    $('#form')[0].reset(); // reset form on modals

    //Ajax Load data from ajax
    $.ajax({
      url : "<?php echo base_url('inventory/check_out/')?>/" + id,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
        $('input[name="inventory_id"]').val(data[0].inventory_id);
        $('input[name="product_id"]').val(data[0].product_id);
        $('input[name="shelf_name"]').val(data[0].shelf_name);
        $('[name="rack_name"]').val(data[0].rack_name);
        $('[name="name"]').val(data[0].name);
        $('[name="cost"]').val(data[0].cost);
        $('[name="quantity"]').val(data[0].ProQuantity);

        var options = '<option value="">Select Manufacturer / Supplier</option>';
        var clients = data[0].clients;
        for (i=0; i<clients.length; i++) {
          options += '<option value="' + clients[i].client_id + '">' + clients[i].company_name + '</option>';
        }

        $('#client_id2').html(options);

        $('#modal_checkout').modal('show'); 
        $('.modal-title').text('Product Check-Out');
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        alert('Error get data from ajax');
      }
    });
  }

  function save(){
    var url;
    var client_id = $('[name="client_id"]').val();
    var client_id2 = $('[name="client_id2"]').val();
    var product_id = $('[name="product_id"]').val();
    var out_quantity = $('[name="out_quantity"]').val();
    var quantity = $('[name="quantity"]').val();

    if(save_method == 'add'){
      url = "<?php echo base_url('inventory/ckh_add/')?>";
    }
    else{
      url = "<?php echo base_url('inventory/ckh_add/')?>";
    }

    if(client_id == null || client_id == ""){
      $("#err_client_name").text("Select Customer.");
      return false;
    }
    else{
      $("#err_client_name").text("");
    }

    if(client_id2 == null || client_id2 == ""){
      $("#err_client_name2").text("Select Manufacturer / Supplier.");
      return false;
    }
    else{
      $("#err_client_name2").text("");
    }

    if(out_quantity == null || out_quantity == ""){
      $("#err_out_quantity").text("Insert Quantity.");
      return false;
    }
    else{
      $("#err_out_quantity").text("");
    }
    
    if (parseInt(out_quantity) > parseInt(quantity)) {
      $('#err_out_quantity').text("Invalid Out Quantity.");  
      return false;
    }
    else{
      $("#err_out_quantity").text("");
    }

    $('#btnSave').prop('disabled', true);
    $('#btnSave').css('cursor', 'default');
    $('#btnSave').toggleClass('active');

    $.ajax({
      url : url,
      type: "POST",
      data: $('#form').serialize(),
      dataType: "JSON",
      success: function(data){
        if(data.email == null){
          location.reload();
        }
        else{
          var url = '<?php echo base_url('email/sample_draft/'); ?>' + client_id + '/' + client_id2 + '/' + product_id + '/' + out_quantity;
          $(location).attr('href', url);
        }
      },
      error: function (jqXHR, textStatus, errorThrown){
        alert('Error check out adding data'+errorThrown);
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

  $('#btn_ajax').click(function(){
    var category_id = $('#category_id').val();
    if(!category_id) category_id = 0;
    var sub_category_id = $('#sub_category_id').val();
    if(!sub_category_id) sub_category_id = 0;

    $.ajax({
      url: "<?php echo base_url('inventory/filter_stock_record') ?>/",
      type: "POST",
      dataType: "JSON",
      data : {
        category_id: category_id,
        sub_category_id: sub_category_id
      },
      success: function (response) {
        var table = $('#index').DataTable();
        table.destroy();
        $('#records').empty();

        var trHTML = '';
        $.each(response.data, function (i, item) {
          trHTML += '<tr>';
          trHTML += '<td>'+(i+1)+'</td>';
          trHTML += '<td>' + item.name + '</td>';
          /*trHTML += '<td>' + item.category_name + '</td>';

          var sub_category_name = item.sub_category_name;
          if(sub_category_name == null){
            sub_category_name = '';
          }
          trHTML += '<td>' + sub_category_name + '</td>';*/
          
          var client_name = item.client_name;
          trHTML += '<td>';
            for(i=0; i<client_name.length; i++){
              trHTML += (i+1) + '. ' + client_name[i].company_name + '<br>';
            }
          trHTML += '</td>';
          
          trHTML += '<td>Shelf: ' + item.shelf_name;
          trHTML += '<br>Rack: ' + item.rack_name + '</td>';

          if(item.totalProduct > 0){
            trHTML += '<td align="center">Purchase<br><b>' + item.totalProduct + '</b>';
          }
          else{
            trHTML += '<td align="center">Sales<br><b>' + -(item.totalProduct) + '</b>';
          }

          if(item.totalProduct > 0){
            trHTML += '<td><button title="Check-Out" class="btn btn-sm bg-gray" onclick="checkout(' + item.inventory_id + '); "><i class="fa fa-sign-out"></i></button></td>';
          }
          else{
            trHTML += '<td></td>';
          }

          trHTML += '</tr>';
        });
        
        $('#records').append(trHTML);
        $('#index').DataTable({
          "columnDefs": [ {
              "searchable": false,
              "orderable": false,
              "targets": 0
          } ],
          "order": [[ 1, 'asc' ]],
          "pageLength": 100
        });

        $('#precords').empty();

        var trHTML = '';
        $.each(response.data, function (i, item) {
          trHTML += '<tr>';
          trHTML += '<td>'+(i+1)+'</td>';
          trHTML += '<td>' + item.name + '</td>';
          /*trHTML += '<td>' + item.category_name + '</td>';

          var sub_category_name = item.sub_category_name;
          if(sub_category_name == null){
            sub_category_name = '';
          }
          trHTML += '<td>' + sub_category_name + '</td>';*/
          
          var client_name = item.client_name;
          trHTML += '<td>';
            for(i=0; i<client_name.length; i++){
              trHTML += (i+1) + '. ' + client_name[i].company_name + '<br>';
            }
          trHTML += '</td>';
          
          trHTML += '<td>Shelf: ' + item.shelf_name;
          trHTML += '<br>Rack: ' + item.rack_name + '</td>';

          if(item.totalProduct > 0){
            trHTML += '<td align="center">Purchase<br><b>' + item.totalProduct + '</b>';
          }
          else{
            trHTML += '<td align="center">Sales<br><b>' + -(item.totalProduct) + '</b>';
          }

          trHTML += '</tr>';
        });
        
        $('#precords').append(trHTML);
      }
    });

    $("#pdf").html('<a href="<?php echo base_url('inventory/filterStockRecordPDF/');?>' + category_id + '/' + sub_category_id + '" target="_blank">PDF (On Letter Heads)</a>');
  });
</script>

<div class="modal fade" id="modal_checkout" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Product Check-Out</h3>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <input type="hidden" value="" name="inventory_id" id="inventory_id" />
          <input type="hidden" value="" name="product_id" id="product_id" />

          <div class="form-body">
            <?php
              if($reference_no==null){
                $no = sprintf('%06d',intval(1));
              }
              else{
                foreach ($reference_no as $value) {
                  $no = sprintf('%06d',intval($value->check_out_history_id)+1); 
                }
              }
            ?>
            <div class="form-group">
              <label class="control-label col-md-3">Check-Out No</label>
              <div class="col-md-9">
                <input type="text" class="form-control" id="reference_no" name="reference_no" value="CO-<?php echo $no;?>" readonly>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3">Product</label>
              <div class="col-md-9">
                <input name="name" placeholder="name" class="form-control" type="text" readonly="">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3">Shelf (Location)</label>
              <div class="col-md-9">
                <input name="shelf_name" placeholder="shelf_id" class="form-control" type="text" readonly="">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3">Rack (Location)</label>
              <div class="col-md-9">
                <input name="rack_name" placeholder="rack_id" class="form-control" type="text" readonly="">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3">Cost</label>
              <div class="col-md-9">
                <input name="cost" placeholder="cost" class="form-control" type="text" readonly="">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3">Quantity</label>
              <div class="col-md-9">
                <input name="quantity" placeholder="quantity" class="form-control" type="text" readonly="">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3">Customer <span class="validation-color">*</span></label>
              <div class="col-md-9">
                <select class="form-control select2" id="client_id" name="client_id"  style="width: 100%" >
                  <option value="">Select Customer</option>
                  <?php
                  foreach ($client as $value) {
                    echo "<option value='$value->client_id'".set_select('client',$value->client_id).">$value->company_name</option>";
                  }
                  ?>
                </select>
                <span class="validation-color" id="err_client_name"></span>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3">Manufacturer / Supplier <span class="validation-color">*</span></label>
              <div class="col-md-9">
                <select class="form-control select2" id="client_id2" name="client_id2" style="width: 100%;">
                </select>
                <span class="validation-color" id="err_client_name2"></span>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3">Out Quantity <span class="validation-color">*</span></label>
              <div class="col-md-9">
                <input name="out_quantity" placeholder="Insert Quantity" class="form-control" type="number">
                <span class="validation-color" id="err_out_quantity"></span>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3">Remarks</label>
              <div class="col-md-9">
                <input name="remarks" placeholder="Remarks" class="form-control" type="text">
              </div>
            </div>

            <br><br>

            <div class="form-group">
              <label class="control-label col-md-3"></label>
              <div class="col-sm-9" style="font-weight: bold;">
                <input type="checkbox" name="email" value="1" class="minimal" checked/>&emsp;Email the details as Forwarding / O.C to the Customer.
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" id="btnSave" class="button btn bg-gray" style="padding: 1.6rem 4.125rem;" onclick="save()">
          <span class="submit" style="left: 12%;">Check-Out</span>
          <span class="loading" style="left: 32%"><i class="fa fa-circle-o-notch"></i></span>
        </button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<?php
  $this->load->view('layout/footer');
?>