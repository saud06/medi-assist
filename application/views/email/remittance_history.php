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
     if(confirm('Sure To Remove This Record ?'))
     {
        window.location.href='<?php  echo base_url('email/delete_remittance_history/'); ?>'+id;
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
          <li class="active"><!-- Remittance History --> 
            Remittance History
          </li>
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
              <h3 class="box-title"><!-- Remittance History -->
                Remittance History
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body outer-scroll">
              <div class="inner-scroll">
                <div class="row">
                  <div class="col-sm-1">
                    <p><strong>List Filter:</strong></p>
                  </div>
                  <div class="col-sm-2">
                    <!-- Date range -->
                    <div class="form-group">
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="date_range" class="form-control pull-right" id="reservation" autocomplete="off" placeholder="Insert Daterange">
                      </div>
                      <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                  </div>
                  <div class="col-sm-2">
                    <select class="form-control select2" style="width: 100%" name="category_id" id="category_id">
                      <option value="">All Categories</option>
                      <?php
                        $category = $this->db->get('category')->result();
                        foreach ($category as $cat){
                      ?>
                          <option value="<?php echo $cat->category_id; ?>"><?php echo $cat->category_name; ?></option>
                      <?php
                        }
                      ?>
                    </select>
                  </div>
                  <div class="col-sm-2">
                    <button title="Filter Remittance History" type="button" id="btn_ajax" class="btn bg-gray"><i class="fa fa-search"></i></button> &emsp;
                    <button title="Print Remittance History" type="button" id="" class="btn bg-gray" onclick="printContent('print')"><i class="fa fa-print" aria-hidden="true"></i></button>
                  </div>
                </div>
                <br>

                <table id="index" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <!-- <th style="min-width: 45px">Date</th> -->
                    <th>Contact Person</th>
                    <th>Customer Name</th>
                    <th>Manufacturer Name</th>
                    <th>PO/PI/Indent No.</th>
                    <th style="min-width: 300px">Product</th>
                    <th>LC/TT/Cheque No.</th>
                    <th>Total Order Value</th>
                    <th>Agreed Comission<br>on Base Price</th>
                    <th>OP</th>
                    <th>Total Comission</th>
                    <?php if($this->session->userdata('type') == 'admin'){ ?>
                      <th>Action</th>
                    <?php }?>
                  </tr>
                  </thead>
                  <tbody id="records">
                    <?php 
                      $grand_tot_comission = 0.00;
                      foreach ($data as $row) {
                        $id= $row->remittance_history_id;

                        $query = $this->db->query("SELECT * FROM remittance_history_item WHERE remittance_history_id = '$id'");
                        $item = $query->result();
                    ?>
                      <tr>
                        <td></td>
                        <!-- <td><?php echo $row->email_date; ?></td> -->
                        <td><?php echo $row->contact_person ?></td>
                        <td><?php echo $row->customer_name ?></td>
                        <td><?php echo $row->manufacturer_name ?></td>
                        <td><?php echo $row->indent_no ?></td>
                        <td>
                          <?php 
                            foreach ($item as $key => $value) {
                              echo ($key+1) . '. ' . '<strong>Name:</strong> ' . $value->product_name . '&emsp;<strong>Price:</strong> ' . $value->price . '&emsp;<strong>Quantity:</strong> ' . $value->quantity . '&emsp;<strong>Total Value:</strong> ' . $value->total_value . '<br>';
                            } 
                          ?>
                        </td>
                        <td><?php echo $row->lc ?></td>
                        <td><?php echo $row->grand_total ?></td>
                        <td><?php if($row->comission || $row->comission == 0){ echo $row->comission . '% (' . number_format(($row->grand_total * ($row->comission / 100)), 2, '.', '') . ')'; } ?></td>
                        <td>
                          <?php 
                            if($row->op || $row->op == 0){ echo number_format(($row->op * $row->product_qty), 2, '.', ''); }
                          ?>
                        </td>
                        <td><?php if($row->comission || $row->comission == 0){ echo number_format((($row->grand_total * ($row->comission / 100)) + ($row->op * $row->product_qty)), 2, '.', ''); $grand_tot_comission += ($row->grand_total * ($row->comission / 100)) + ($row->op * $row->product_qty); } ?></td>
                        <?php if($this->session->userdata('type') == 'admin'){ ?>
                          <td>
                            <div class="dropdown">
                              <button title="Action" type="button" class="btn btn-sm bg-gray gropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-cog"></i>&nbsp;
                                <span class="fa fa-angle-double-down"></span>
                              </button>
                              <ul class="dropdown-menu">
                                <li>
                                  <a onclick="edit(<?php echo $id; ?>)" href="javascript:void(0);"><i class="fa fa-file-text-o"></i>Edit</a>
                                </li>
                                <li>
                                  <a href="javascript:delete_id(<?php echo $id;?>)"><i class="fa fa-trash-o"></i>Delete</a>
                                </li>
                              </ul>
                            </div>
                          </td>
                        <?php }?>
                      </tr>
                      <?php
                        }
                      ?>
                  <tfoot>
                  <tr>
                    <th>No.</th>
                    <!-- <th>Date</th> -->
                    <th>Contact Person</th>
                    <th>Customer Name</th>
                    <th>Manufacturer Name</th>
                    <th>PO/PI/Indent No.</th>
                    <th>Product</th>
                    <th>LC/TT/Cheque No.</th>
                    <th>Total Order Value</th>
                    <th>Agreed Comission<br>on Base Price</th>
                    <th>OP</th>
                    <th><?= 'Total Comission: <br><span id="grand_tot_comission">' . number_format($grand_tot_comission, 2, '.', '') . '</span>'; ?></th>
                    <?php if($this->session->userdata('type') == 'admin'){ ?>
                      <th>Action</th>
                    <?php }?>
                  </tr>
                  </tfoot>
                </table>

                <div style="display: none;" id="print">
                  <div id="header" class="box-header with-border" style="text-align: center; display: none">
                    <img width="300" height="100" src="<?php echo base_url().'assets/images/winmarkFinal.png'; ?>"><br>
                    <hr>

                    <h3 class="box-title">
                      Remittance History
                    </h3>
                    <br><br>

                    <table id="pindex" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th>No.</th>
                        <!-- <th style="min-width: 45px">Date</th> -->
                        <th>Contact Person</th>
                        <th>Customer Name</th>
                        <th>Manufacturer Name</th>
                        <th>PO/PI/Indent No.</th>
                        <th style="min-width: 300px">Product</th>
                        <th>LC/TT/Cheque No.</th>
                        <th>Total Order Value</th>
                        <th>Agreed Comission<br>on Base Price</th>
                        <th>OP</th>
                        <th>Total Comission</th>
                      </tr>
                      </thead>
                      <tbody id="precords">
                        <?php 
                          $grand_tot_comission = 0.00;
                          foreach ($data as $key => $row) {
                            $id= $row->remittance_history_id;

                            $query = $this->db->query("SELECT * FROM remittance_history_item WHERE remittance_history_id = '$id'");
                            $item = $query->result();
                        ?>
                          <tr>
                            <td><?php echo ++$key; ?></td>
                            <!-- <td><?php echo $row->email_date; ?></td> -->
                            <td><?php echo $row->contact_person ?></td>
                            <td><?php echo $row->customer_name ?></td>
                            <td><?php echo $row->manufacturer_name ?></td>
                            <td><?php echo $row->indent_no ?></td>
                            <td>
                              <?php 
                                foreach ($item as $key => $value) {
                                  echo ($key+1) . '. ' . '<strong>Name:</strong> ' . $value->product_name . '&emsp;<strong>Price:</strong> ' . $value->price . '&emsp;<strong>Quantity:</strong> ' . $value->quantity . '&emsp;<strong>Total Value:</strong> ' . $value->total_value . '<br>';
                                } 
                              ?>
                            </td>
                            <td><?php echo $row->lc ?></td>
                            <td><?php echo $row->grand_total ?></td>
                            <td><?php if($row->comission || $row->comission == 0){ echo $row->comission . '% (' . number_format(($row->grand_total * ($row->comission / 100)), 2, '.', '') . ')'; } ?></td>
                            <td>
                              <?php 
                                if($row->op || $row->op == 0){ echo number_format(($row->op * $row->product_qty), 2, '.', ''); }
                              ?>
                            </td>
                            <td><?php if($row->comission || $row->comission == 0){ echo number_format((($row->grand_total * ($row->comission / 100)) + ($row->op * $row->product_qty)), 2, '.', ''); $grand_tot_comission += ($row->grand_total * ($row->comission / 100)) + ($row->op * $row->product_qty); } ?></td>
                          </tr>
                          <?php
                            }
                          ?>
                      <tfoot>
                      <tr>
                        <th>No.</th>
                        <!-- <th>Date</th> -->
                        <th>Contact Person</th>
                        <th>Customer Name</th>
                        <th>Manufacturer Name</th>
                        <th>PO/PI/Indent No.</th>
                        <th>Product</th>
                        <th>LC/TT/Cheque No.</th>
                        <th>Total Order Value</th>
                        <th>Agreed Comission<br>on Base Price</th>
                        <th>OP</th>
                        <th><?= 'Total Comission: <br><span id="grand_tot_comission_2">' . number_format($grand_tot_comission, 2, '.', '') . '</span>'; ?></th>
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

  <div class="modal fade" id="modal_history" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title">Edit </h3>
          <h4>Remittance History ID: <span id="span_history_id" style="font-weight: bold;"></span></h4>
        </div>
        <div class="modal-body form">
          <div class="box-body">
            <div class="row">
              <form action="#" id="form">
                <input type="hidden" name="remittance_history_id" id="remittance_history_id" />
                <input type="hidden" name="customer_id" id="customer_id" />
                <input type="hidden" name="customer_name" id="customer_name" />
                <input type="hidden" name="manufacturer_id" id="manufacturer_id" />
                <input type="hidden" name="manufacturer_name" id="manufacturer_name" />
                <input type="hidden" name="product_qty" id="product_qty" />

                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Contact Person <span class="validation-color">*</span></label>
                    <input type="text" class="form-control" id="contact_person" name="contact_person" placeholder="Insert Contact Person Name">
                    <span class="validation-color" id="err_contact_person"></span>
                  </div>

                  <div class="form-group">
                    <label>Manufacturer Name <span class="validation-color">*</span></label>

                    <select class="form-control select2" id="client2" name="client2" style="width: 100%;">
                      <option value="">Select Manufacturer</option>
                    </select>

                    <span class="validation-color" id="err_client2"></span>
                  </div>

                  <div class="form-group">
                    <label>LC / TT / Cheque No. <span class="validation-color">*</span></label>
                    <input type="text" class="form-control" id="lc" name="lc" placeholder="Insert LC / TT / Cheque No.">
                    <span class="validation-color" id="err_lc"></span>
                  </div>

                  <div class="form-group">
                    <label>OP (Per Unit) <span class="validation-color">*</span></label>
                    <input name="op" id="op" placeholder="Insert OP" class="form-control" type="number">
                    <span class="validation-color" id="err_op"></span>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label>Customer Name <span class="validation-color">*</span></label>
                    
                    <select class="form-control select2" id="client1" name="client1" style="width: 100%;">
                      <option value="">Select Customer</option>
                    </select>

                    <span class="validation-color" id="err_client1"></span>
                  </div>

                  <div class="form-group">
                    <label>PO / PI / Indent No.</label>
                    <input type="text" class="form-control" id="indent_no" name="indent_no" placeholder="Insert Indent No.">
                  </div>

                  <div class="form-group">
                    <label>Agreed Comission on Base Price (%) <span class="validation-color">*</span></label>
                    <input name="comission" id="comission" placeholder="Insert Comission" class="form-control" type="number">
                    <span class="validation-color" id="err_comission"></span>
                  </div>
                </div>

                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Products</label>

                    <div style="overflow-y: auto;">
                      <table class="table items table-striped table-bordered table-condensed table-hover category_table" name="category_data" id="category_data">
                        <thead>
                          <tr>
                            <th width="40%">Name</th>
                            <th width="20%">Price</th>
                            <th width="20%">Quantity</th>
                            <th width="20%">Total Value</th>
                          </tr>
                        </thead>
                        <tbody id="prod_records">
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>

              </form>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnSave" onclick="update()" class="btn bg-gray">Update</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
<?php
  $this->load->view('layout/footer');
?>

<script>
  $(document).ready(function(){
    $('#reservation').val('');
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

  function edit(id){
    $('#form')[0].reset(); // reset form on modals
    $('#remittance_history_id').val(id);

    var customer_id = ''; var manufacturer_id = '';

    $.ajax({
      url : "<?php echo base_url('email/get_remittance_history/')?>" + id,
      type: "GET",
      dataType: "JSON",
      async: false,
      success: function(data){
        $('#prod_records').empty();

        customer_id = data[0].customer_id;
        manufacturer_id = data[0].manufacturer_id;
        $('#contact_person').val(data[0].contact_person);
        $('#customer_id').val(customer_id);
        $('#customer_name').val(data[0].customer_name);
        $('#manufacturer_id').val(manufacturer_id);
        $('#manufacturer_name').val(data[0].manufacturer_name);
        $('#indent_no').val(data[0].indent_no);
        $('#lc').val(data[0].lc);
        $('#comission').val(data[0].comission);
        $('#op').val(data[0].op);

        var count = 0;
        var product_qty = 0;
        var prod_data = [];
        var trHTML = '';
        for(i=0; i<data.products.length; i++){
          trHTML += '<tr>';
            trHTML += '<td>' + data.products[i].product_name + '</td>';
            trHTML += '<td>' + data.products[i].price + '</td>';
            trHTML += '<td>' + data.products[i].quantity + '</td>';
            trHTML += '<td>' + data.products[i].total_value + '</td>';
          trHTML += '</tr>';

          product_qty = +product_qty + +data.products[i].quantity;

          prod_data[count] = count + 1;
          count++;
        }

        $('#product_qty').val(product_qty);

        $('#prod_records').append(trHTML);
      },
      error: function (jqXHR, textStatus, errorThrown){
        alert('Error check out adding data'+errorThrown);
      }
    });

    $.ajax({
      url : "<?php echo base_url('email/get_customer_data')?>",
      type: "GET",
      dataType: "JSON",
      success: function(response){
        var option = '';

        for(i=0; i<response.data.length; i++){
          var selected = '';
          if(response.data[i].client_id == customer_id) selected = 'selected';

          option += '<option ' + selected + ' value="' + response.data[i].client_id + '">' + response.data[i].company_name + '</option>';
        }

        $('#client1').append(option);
      }
    });

    $.ajax({
      url : "<?php echo base_url('email/get_manufacturer_data')?>",
      type: "GET",
      dataType: "JSON",
      success: function(response){
        var option = '';

        for(i=0; i<response.data.length; i++){
          var selected = '';
          if(response.data[i].client_id == manufacturer_id) selected = 'selected';

          option += '<option ' + selected + ' value="' + response.data[i].client_id + '">' + response.data[i].company_name + '</option>';
        }

        $('#client2').append(option);
      }
    });

    $('#modal_history').modal('show');
    $('#span_history_id').html(id);
  }

  $('#client1').on('change', function(){
    var customer_id = $(this).val();
    var customer_name = $('option:selected', $(this)).text();
    $('#customer_id').val(customer_id);
    $('#customer_name').val(customer_name);
  });

  $('#client2').on('change', function(){
    var manufacturer_id = $(this).val();
    var manufacturer_name = $('option:selected', $(this)).text();
    $('#manufacturer_id').val(manufacturer_id);
    $('#manufacturer_name').val(manufacturer_name);
  });

  function update(){
    var contact_person = $('[name="contact_person"]').val();
    var client1 = $('[name="client1"]').val();
    var client2 = $('[name="client2"]').val();
    var indent_no = $('[name="indent_no"]').val();
    var lc = $('[name="lc"]').val();
    var comission = $('[name="comission"]').val();
    var op = $('[name="op"]').val();

    if(contact_person == null || contact_person == ""){
      $("#err_contact_person").text("Insert Contact Person Name.");
      return false;
    }
    else{
      $("#err_contact_person").text("");
    }

    if(client1 == null || client1 == ""){
      $("#err_client1").text("Select Customer.");
      return false;
    }
    else{
      $("#err_client1").text("");
    }

    if(client2 == null || client2 == ""){
      $("#err_client2").text("Select Manufacturer.");
      return false;
    }
    else{
      $("#err_client2").text("");
    }

    if(lc == null || lc == ""){
      $("#err_lc").text("Insert LC / TT / Cheque No.");
      return false;
    }
    else{
      $("#err_lc").text("");
    }

    if(comission == null || comission == ""){
      $("#err_comission").text("Insert Comission.");
      return false;
    }
    else{
      $("#err_comission").text("");
    }

    if(op == null || op == ""){
      $("#err_op").text("Insert OP.");
      return false;
    }
    else{
      $("#err_op").text("");
    }

    $.ajax({
      url : "<?php echo base_url('email/edit_remittance_history/')?>",
      type: "POST",
      data: $('#form').serialize(),
      dataType: "JSON",
      success: function(data){
        location.reload();
      },
      error: function (jqXHR, textStatus, errorThrown){
        alert('Error check out adding data'+errorThrown);
      }
    });
  }

  $('#btn_ajax').click(function(){
    var date_range = $('#reservation').val();
    var prod_category = $('#category_id').val();
    if(!prod_category) prod_category = 0;

    if(!$('#reservation').val()){
      alert('Date range is empty!');

      return false;
    } else{
      $.ajax({
        url: "<?php echo base_url('email/filterRemittanceHistory') ?>",
        type: "POST",
        dataType: "JSON",
        data : {
          date_range: date_range,
          prod_category: prod_category
        },
        success: function (response) {
          var table = $('#index').DataTable();
          table.destroy();
          $('#records').empty();

          var grand_tot_comission = 0.00;
          var trHTML = '';
          $.each(response.data, function (i, item) {
              trHTML += '<tr>';
              trHTML += '<td>'+(i+1)+'</td>';
              trHTML += '<td>' + item.contact_person + '</td>';
              trHTML += '<td>' + item.customer_name + '</td>';
              trHTML += '<td>' + item.manufacturer_name + '</td>';
              trHTML += '<td>' + item.indent_no + '</td>';
              trHTML += '<td>';
                var products = item.products;
                for(i=0; i<products.length; i++){
                  trHTML += (i+1) + '. ' + '<strong>Name:</strong> ' + products[i].product_name + '&emsp;<strong>Price:</strong> ' + products[i].price + '&emsp;<strong>Quantity:</strong> ' + products[i].quantity + '&emsp;<strong>Total Value:</strong> ' + products[i].total_value + '<br>';
                }
              trHTML += '</td>';

              var lc = '';
              if(item.lc != null) lc = item.lc;
              trHTML += '<td>' + lc + '</td>';

              trHTML += '<td>' + item.grand_total + '</td>';

              trHTML += '<td>';
                if(item.comission || item.comission == 0){
                  trHTML += item.comission + '% (' + (item.grand_total * (item.comission / 100)).toFixed(2) + ')';
                }
              trHTML += '</td>';

              trHTML += '<td>';
                if(item.op || ite.op == 0)
                  trHTML += (item.op * item.product_qty).toFixed(2);
              trHTML += '</td>';

              trHTML += '<td>';
                if(item.comission || item.comission == 0){
                  trHTML += ((item.grand_total * (item.comission / 100)) + +(item.op * item.product_qty)).toFixed(2);

                  grand_tot_comission = +grand_tot_comission + +(((item.grand_total * (item.comission / 100)) + +(item.op * item.product_qty)).toFixed(2));
                }
              trHTML += '</td>';
              
              trHTML += '<td>';
                trHTML += '<div class="dropdown"><button title="Action" type="button" class="btn btn-sm bg-gray gropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> &nbsp;<span class="fa fa-angle-double-down"></span></button><ul class="dropdown-menu"><li><a onclick="edit(' + item.remittance_history_id + ')" href="javascript:void(0);"><i class="fa fa-file-text-o"></i>Edit</a></li><li><a href="javascript:delete_id(' + item.remittance_history_id + ')"><i class="fa fa-trash-o"></i>Delete</a></li></ul></div>';
              trHTML += '</td>'; 
              trHTML += '</tr>';
          });

          $('#grand_tot_comission').html(grand_tot_comission.toFixed(2));
          
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

          var grand_tot_comission_2 = 0.00;
          var trHTML = '';
          $.each(response.data, function (i, item) {
              trHTML += '<tr>';
              trHTML += '<td>'+(i+1)+'</td>';
              trHTML += '<td>' + item.contact_person + '</td>';
              trHTML += '<td>' + item.customer_name + '</td>';
              trHTML += '<td>' + item.manufacturer_name + '</td>';
              trHTML += '<td>' + item.indent_no + '</td>';
              trHTML += '<td>';
                var products = item.products;
                for(i=0; i<products.length; i++){
                  trHTML += (i+1) + '. ' + '<strong>Name:</strong> ' + products[i].product_name + '&emsp;<strong>Price:</strong> ' + products[i].price + '&emsp;<strong>Quantity:</strong> ' + products[i].quantity + '&emsp;<strong>Total Value:</strong> ' + products[i].total_value + '<br>'; 
                }
              trHTML += '</td>';
              trHTML += '<td>' + item.grand_total + '</td>';
              
              var lc = '';
              if(item.lc != null) lc = item.lc;
              trHTML += '<td>' + lc + '</td>';

              trHTML += '<td>';
                if(item.comission || item.comission == 0){
                  trHTML += item.comission + '% (' + (item.grand_total * (item.comission / 100)).toFixed(2) + ')';
                }
              trHTML += '</td>';

              trHTML += '<td>';
                if(item.op || ite.op == 0)
                  trHTML += (item.op * item.product_qty).toFixed(2);
              trHTML += '</td>';

              trHTML += '<td>';
                if(item.comission || item.comission == 0){
                  trHTML += ((item.grand_total * (item.comission / 100)) + +(item.op * item.product_qty)).toFixed(2);

                  grand_tot_comission_2 = +grand_tot_comission_2 + +(((item.grand_total * (item.comission / 100)) + +(item.op * item.product_qty)).toFixed(2));
                }
              trHTML += '</td>';
              trHTML += '</tr>';
          });

          $('#grand_tot_comission_2').html(grand_tot_comission_2.toFixed(2));
          
          $('#precords').append(trHTML);
        }
      });
    }
  });
</script>