<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','purchaser','manager');
if(!(in_array($this->session->userdata('type'),$p))){
  redirect('auth');
}
$this->load->view('layout/header');
?>
<script type="text/javascript">
  function delete_id(id)
  {
     if(confirm('Sure To Remove This Record? Item(s) Under This Purchase Record In Inventory Will Be Removed As Well.'))
     {
        window.location.href='<?php  echo base_url('purchase/delete/'); ?>'+id;
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
          <li class="active"><?php echo $this->lang->line('header_purchase'); ?></li>
        </ol>
      </h5> 
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
      <?php
        if($message = $this->session->flashdata('message')){
      ?>
        <div class="col-sm-12">
          <div class="alert alert-success">
            <button class="close" data-dismiss="alert" type="button">×</button>
              <?php echo $message; ?>
            <div class="alerts-con"></div>
          </div>
        </div>
      <?php
        }
      ?>
      <!-- right column -->
      <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Purchase List</h3>
              <a title="Add New Purchase" class="btn bg-gray" style="margin: 10px" href="<?php echo base_url('purchase/add');?>"><i class="fa fa-plus"></i></a>
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
                        <input type="text" name="date_range" class="form-control pull-right" id="reservation">
                      </div>
                      <!-- /.input group -->
                    </div>
                    <!-- /.form group -->
                  </div>
                  <div class="col-sm-2">
                    <button title="Filter Purchase List" type="button" id="btn_ajax" class="btn bg-gray"><i class="fa fa-search"></i></button> &emsp;

                    <div class="btn-group">
                      <button title="Print Purchase List" type="button" class="btn bg-gray gropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-print" aria-hidden="true"></i>&nbsp;
                        <span class="fa fa-angle-double-down"></span>
                      </button>
                      <ul class="dropdown-menu">
                        <li>
                          <a href="#" target="_blank" onclick="printContent('print')">Print (Default)</a>
                        </li>
                        <li id="pdf">
                          <a href="<?php echo base_url('purchase/list_pdf');?>" target="_blank">PDF (On Letter Head)</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <br>

                <table id="index" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th><?php echo $this->lang->line('product_no'); ?>.</th>
                    <!-- <th><?php echo $this->lang->line('purchase_date'); ?></th> -->
                    <th><?php echo $this->lang->line('purchase_reference_no'); ?></th>
                    <th>Manufacturer / Supplier</th>
                    <th>Shipping Mode</th>
                    <th>Status</th>
                    <th><?php echo $this->lang->line('purchase_grand_total'); ?></th>
                    <th><?php echo $this->lang->line('product_action'); ?></th>
                  </tr>
                  </thead>
                  <tbody id="records">
                    <?php 
                      foreach ($data as $row) {
                        $id= $row->purchase_id;
                    ?>
                      <tr>
                        <td></td>
                        <!-- <td><?php echo $row->date; ?></td> -->
                        <td><?php echo $row->reference_no; ?></td>
                        <td><?php echo $row->company_name; ?></td>
                        <td>
                          <?php 
                            echo '<strong>Mode: </strong>' . $row->ship_mode . '<br>'; 
                            if($row->ship_mode == 'Courier'){
                              if($row->type){
                                $type = $this->db->get_where('courier', array('courier_id' => $row->type))->row();
                                echo '<strong>Type: </strong>' . $type->courier_name . '<br>'; 
                              }
                              else{
                                echo '<strong>Type: </strong><br>';
                              }
                            }
                            echo '<hr style="margin: 2px">';
                            echo '<strong>Method: </strong>' . $row->method . '<br>'; 
                          ?>
                        </td>
                        <td align="center"><?php echo $this->lang->line('purchase_received'); ?></td>
                        <td align="right"><?php if($row->currency_id == 1){ echo '$';} else{ echo '৳'; } echo $row->total; ?></td>
                        <td>
                          <div class="dropdown">
                            <button title="Action" type="button" class="btn btn-sm bg-gray gropdown-toggle" data-toggle="dropdown">
                              <i class="fa fa-cog"></i>&nbsp;
                              <span class="fa fa-angle-double-down"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                              <li>
                                <a onclick="view_items(<?php echo $row->purchase_id; ?>)" href="javascript:void(0);"><i class="fa fa-file-text-o"></i>Purchase Items</a>
                              </li>
                              <li>
                                <!-- <a href="<?php echo base_url('purchase/pdf/');?><?php echo $id; ?>" target="_blank"><i class="fa fa-file-pdf-o"></i>Receipt (PDF)</a> -->
                                <a href="#"><i class="fa fa-file-pdf-o"></i>Receipt (PDF)</a>
                              </li>
                              <!-- <li>
                                <a href="<?php echo base_url('purchase/view/');?><?php echo $id; ?>"><i class="fa fa-file-text-o"></i><?php echo $this->lang->line('purchase_purchase_details'); ?></a>
                              </li> -->
                              <!-- <li>
                                <a href="<?php echo base_url('purchase/email/');?><?php echo $id; ?>"><i class="fa fa-envelope"></i><?php echo $this->lang->line('purchase_email_purchase'); ?></a>
                              </li> -->
                              <?php if($this->session->userdata('type') == 'admin'){ ?>
                                <li>
                                  <a href="<?php echo base_url('purchase/edit/'); ?><?php echo $id; ?>"><i class="fa fa-edit"></i><?php echo $this->lang->line('purchase_edit_purchase'); ?></a>
                                </li>
                                <li>
                                  <a href="javascript:delete_id(<?php echo $id;?>)"><i class="fa fa-trash-o"></i><?php echo $this->lang->line('purchase_delete_purchase'); ?></a>
                                </li>
                              <?php }?>
                            </ul>
                          </div>
                        </td>
                      </tr>
                    <?php
                      }
                    ?>
                  <tfoot>
                  <tr>
                    <th><?php echo $this->lang->line('product_no'); ?>.</th>
                    <!-- <th><?php echo $this->lang->line('purchase_date'); ?></th> -->
                    <th><?php echo $this->lang->line('purchase_reference_no'); ?></th>
                    <th>Manufacturer / Supplier</th>
                    <th>Shipping Mode</th>
                    <th>Status</th>
                    <th><?php echo $this->lang->line('purchase_grand_total'); ?></th>
                    <th><?php echo $this->lang->line('product_action'); ?></th>
                  </tr>
                  </tfoot>
                </table>

                <div style="display: none;" id="print">
                  <div id="header" class="box-header with-border" style="text-align: center; display: none">
                    <!-- <img width="300" height="100" src="<?php echo base_url().'assets/images/winmarkFinal.png'; ?>"><br>
                    <hr> -->

                    <h3 class="box-title">
                      Purchase List
                    </h3>
                    <br><br>

                    <table id="pindex" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th><?php echo $this->lang->line('product_no'); ?>.</th>
                        <!-- <th><?php echo $this->lang->line('purchase_date'); ?></th> -->
                        <th><?php echo $this->lang->line('purchase_reference_no'); ?></th>
                        <th>Manufacturer / Supplier</th>
                        <th>Shipping Mode</th>
                        <th>Status</th>
                        <th><?php echo $this->lang->line('purchase_grand_total'); ?></th>
                      </tr>
                      </thead>
                      <tbody id="precords">
                        <?php 
                          $grand_tot_bdt = 0; 
                          $grand_tot_usd = 0; 

                          foreach ($data as $key => $row) {
                            $id= $row->purchase_id;
                        ?>
                          <tr>
                            <td><?php echo ++$key; ?></td>
                            <!-- <td><?php echo $row->date; ?></td> -->
                            <td><?php echo $row->reference_no; ?></td>
                            <td><?php echo $row->company_name; ?></td>
                            <td>
                              <?php 
                                echo '<strong>Mode: </strong>' . $row->ship_mode . '<br>'; 
                                if($row->ship_mode == 'Courier'){
                                  if($row->type){
                                    $type = $this->db->get_where('courier', array('courier_id' => $row->type))->row();
                                    echo '<strong>Type: </strong>' . $type->courier_name . '<br>'; 
                                  }
                                  else{
                                    echo '<strong>Type: </strong><br>';
                                  }
                                }
                                echo '<hr style="margin: 2px">';
                                echo '<strong>Method: </strong>' . $row->method . '<br>'; 
                              ?>
                            </td>
                            <td align="center"><?php echo $this->lang->line('purchase_received'); ?></td>
                            <td align="right"><?php if($row->currency_id == 1){ echo '$';} else{ echo '৳'; } echo $row->total; ?></td>
                          </tr>
                        <?php
                            if($row->currency_id == 1){
                              $grand_tot_usd += $row->total;
                            }

                            else{
                              $grand_tot_bdt += $row->total;
                            }
                          }
                        ?>
                      </tbody>
                      <tfoot>
                      <tr>
                        <th><?php echo $this->lang->line('product_no'); ?>.</th>
                        <!-- <th><?php echo $this->lang->line('purchase_date'); ?></th> -->
                        <th><?php echo $this->lang->line('purchase_reference_no'); ?></th>
                        <th>Manufacturer / Supplier</th>
                        <th>Shipping Mode</th>
                        <th>Status</th>
                        <th><span id="ft_grand_tot"><?php echo 'Grand Total: <br>'; ?><?php echo '$' . number_format((float)$grand_tot_usd, 2, '.', '') . '<br>৳' . number_format((float)$grand_tot_bdt, 2, '.', ''); ?></span></th>
                      </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
            <!-- modal -->
            <div class="modal fade" id="modal_form" role="dialog">
              <div class="modal-dialog" style="width: 80%">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Purchase Item List</h3>
                  </div>
                  <div class="modal-body">
                    <table id="index1" class="table table-bordered table-striped product_table1">
                      <thead>
                        <th>No.</th>
                        <th>Purchase ID</th>
                        <th>Batch No</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Cost Mode</th>
                        <th>Cost</th>
                        <th>Grand Total</th>
                        <th>Status</th>
                      <thead>
                      <tbody id="records1">
                      </tbody>
                      <tfoot>
                        <th>No.</th>
                        <th>Purchase ID</th>
                        <th>Batch No</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Cost Mode</th>
                        <th>Cost</th>
                        <th>Grand Total</th>
                        <th>Status</th>
                      <tfoot>
                    </table>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
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
<?php
  $this->load->view('layout/footer');
?>

<script type="text/javascript">
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

  function view_items(purchase_id){
    $.ajax({
      url: "<?php echo base_url('purchase/items_view') ?>/"+purchase_id,
      type: "GET",
      dataType: "JSON",
      success: function (response) {
        //console.log(response);
        var currency = "<?php echo $row->currency_id; ?>";
        if(currency == 1){
          currency = '$';
        }
        else{
          currency = '৳';
        }
        var fop_status;
        if(response.data[0].fop_status == 0){
          fop_status = "-";
        }
        else{
          fop_status = "Free of cost";
        }
        var status;
        if(response.data[0].purchase_items_status == 'active'){
          status = "Received";
        }
        else{
          status = "Pending";
        }

        var table = $('#index1').DataTable();
        table.destroy();
        $('#records1').empty();

        var trHTML = '';
        $.each(response.data, function (i, item) {
            trHTML += '<tr>';
            trHTML += '<td></td>';
            trHTML += '<td>' + item.purchase_id + '</td>';
            trHTML += '<td>' + item.batch_no + '</td>';
            trHTML += '<td>' + item.product_name + '</td>';
            trHTML += '<td>' + item.quantity + '</td>';
            trHTML += '<td>' + fop_status + '</td>';
            trHTML += '<td class="text-right">' + currency + item.cost + '</td>';
            trHTML += '<td class="text-right">' + currency + item.gross_total + '</td>';
            trHTML += '<td class="text-center">' + status + '</td>';
            trHTML += '</tr>';
        });

        $('#records1').append(trHTML);

        $(document).ready(function() {
          var t = $('#index1').DataTable({
            "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": 0
            } ],
            "order": [[ 1, 'asc' ]],
            "pageLength": 100
          });

          t.on( 'order.dt search.dt', function () {
            t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
              cell.innerHTML = i+1;
            });
          }).draw();
        });
      }
    });

    $('#modal_form').modal('show');
  }

  $('#btn_ajax').click(function(){
    var date_range = $('#reservation').val();
    $.ajax({
      url: "<?php echo base_url('purchase/filterPurchase') ?>/",
      type: "POST",
      dataType: "JSON",
      data : {
        date_range: date_range
      },
      success: function (response) {
        var table = $('#index').DataTable();
        table.destroy();
        $('#records').empty();
        
        var trHTML = '';
        $.each(response.data, function (i, item) {
          trHTML += '<tr>';
          trHTML += '<td>'+(i+1)+'</td>';
          // trHTML += '<td>' + item.date + '</td>';
          trHTML += '<td>' + item.reference_no + '</td>';
          trHTML += '<td>' + item.company_name + '</td>';
          
          trHTML += '<td>';
            trHTML += '<strong>Mode: </strong>' + item.ship_mode + '<br>'; 
            if(item.ship_mode == 'Courier'){
              trHTML += '<strong>Type: </strong>' + item.courier_name + '<br>'; 
            }
            trHTML += '<hr style="margin: 2px">';
            trHTML += '<strong>Method: </strong>' + item.method + '<br>'; 
          trHTML += '</td>';
          
          trHTML += '<td align="center">' + 'Received' + '</td>';
          trHTML += '<td align="right">';
            if(item.currency_id == 1){
              trHTML += '$';
            } 
            else{ 
              trHTML += '৳'; 
            } 

            trHTML += item.total;
          trHTML += '</td>';
          trHTML += '<td>';
            trHTML += '<div class="dropdown"><button title="Action" type="button" class="btn btn-sm bg-gray gropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> &nbsp;<span class="fa fa-angle-double-down"></span></button><ul class="dropdown-menu"><li><a onclick="view_items(' + item.purchase_id + ')" href="javascript:void(0);"><i class="fa fa-file-text-o"></i>Purchase Items</a></li><li><a href="<?php echo base_url('purchase/pdf/');?>' + item.purchase_id + '" target="_blank"><i class="fa fa-file-pdf-o"></i>Receipt (PDF)</a></li><li><a href="<?php echo base_url('purchase/edit/'); ?>' + item.purchase_id + '"><i class="fa fa-edit"></i>Edit Purchase</a></li><li><a href="javascript:delete_id(' + item.purchase_id + ')"><i class="fa fa-trash-o"></i>Delete Purchase</a></li></ul></div></td>';
          trHTML += '</td>'; 
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

        var grand_tot_usd = 0;
        var grand_tot_bdt = 0;
        var trHTML = '';
        $.each(response.data, function (i, item) {
          trHTML += '<tr>';
          trHTML += '<td>'+(i+1)+'</td>';
          // trHTML += '<td>' + item.date + '</td>';
          trHTML += '<td>' + item.reference_no + '</td>';
          trHTML += '<td>' + item.company_name + '</td>';
          
          trHTML += '<td>';
            trHTML += '<strong>Mode: </strong>' + item.ship_mode + '<br>'; 
            if(item.ship_mode == 'Courier'){
              trHTML += '<strong>Type: </strong>' + item.courier_name + '<br>'; 
            }
            trHTML += '<hr style="margin: 2px">';
            trHTML += '<strong>Method: </strong>' + item.method + '<br>'; 
          trHTML += '</td>';
          
          trHTML += '<td align="center">' + 'Received' + '</td>';
          trHTML += '<td align-"right">';
            if(item.currency_id == 1){
              trHTML += '$';
            } 
            else{ 
              trHTML += '৳'; 
            } 

            trHTML += item.total;
          trHTML += '</td>';
          trHTML += '</tr>';

          if(item.currency_id == 1){
            grand_tot_usd += +item.total;
          }
          else{
            grand_tot_bdt += +item.total;
          }
        });

        $('#ft_grand_tot').html('Grand Total: <br>$' + grand_tot_usd.toFixed(2) + '<br>৳' + grand_tot_bdt.toFixed(2));
        $('#precords').append(trHTML);
      }
    });

    var split_date_range = date_range.split(' - ');
    var start_date = split_date_range[0];
    start_date = start_date.split('/').join('-');
    var start_date_parts = start_date.split('-');
    var new_start_date = start_date_parts[2] + '-' + start_date_parts[0] + '-' + start_date_parts[1];
    var end_date = split_date_range[1];
    end_date = end_date.split('/').join('-');
    var end_date_parts = end_date.split('-');
    var new_end_date = end_date_parts[2] + '-' + end_date_parts[0] + '-' + end_date_parts[1];

    $("#pdf").html('<a href="<?php echo base_url('purchase/filterPurchasePDF/');?>' + new_start_date + '/' + new_end_date + '" target="_blank">PDF (On Letter Heads)</a>');
  });
</script>