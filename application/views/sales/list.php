<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','sales_person','manager');
if(!(in_array($this->session->userdata('type'),$p))){
  redirect('auth');
}
$this->load->view('layout/header');
?>
<script type="text/javascript">
  function delete_id(id)
  {
     if(confirm('<?php echo $this->lang->line('product_delete_conform'); ?>'))
     {
        window.location.href='<?php  echo base_url('sales/delete/'); ?>'+id;
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
          <li class="active">Sales / Sample Submit</li>
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
              <h3 class="box-title">Sales List</h3>
              <a title="Add New Sales" class="btn bg-gray" style="margin: 10px" href="<?php echo base_url('sales/add');?>"><i class="fa fa-plus"></i></a>
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
                    <button title="Filter Sales List" type="button" id="btn_ajax" class="btn bg-gray"><i class="fa fa-search"></i></button> &emsp;
                    
                    <div class="btn-group">
                      <button title="Print Product List" type="button" class="btn bg-gray gropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-print" aria-hidden="true"></i>&nbsp;
                        <span class="fa fa-angle-double-down"></span>
                      </button>
                      <ul class="dropdown-menu">
                        <li>
                          <a href="#" target="_blank" onclick="printContent('print')">Print (Default)</a>
                        </li>
                        <li id="pdf">
                          <a href="<?php echo base_url('sales/list_pdf');?>" target="_blank">PDF (On Letter Head)</a>
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
                    <th>Company Name</th>
                    <th>Shipping Mode</th>
                    <th>Status</th>
                    <th><?php echo $this->lang->line('purchase_grand_total'); ?></th>
                    <th><?php echo $this->lang->line('sales_paid'); ?></th>
                    <th><?php echo $this->lang->line('sales_payment_status'); ?></th>
                    <th><?php echo $this->lang->line('product_action'); ?></th>
                  </tr>
                  </thead>
                  <tbody id="records">
                    <?php 
                        foreach ($data as $row) {
                           $id= $row->sales_id;
                      ?>
                      <tr>
                        <td></td>
                        <!-- <td><?php echo $row->date; ?></td> -->
                        <td><?php echo $row->reference_no; ?></td>
                        <td><?php echo $row->company_name; ?></td>
                        <td><?php echo $row->ship_mode; ?></td>
                        <td align="center"><?php echo $this->lang->line('sales_complited'); ?></td>
                        <td align="right"><?php if($row->currency_id == 1){ echo '$';} else{ echo '৳'; } echo $row->total; ?></td>
                        <td align="right">
                          <?php
                            if($row->paid_amount != null){
                              if($row->currency_id == 1){ echo '$';} else{ echo '৳'; } echo $row->paid_amount;
                            }
                          ?>
                        </td>
                        <td align="center">
                          <?php 
                            if($row->paid_amount == null){ 
                              echo $this->lang->line('sales_pending');
                            }
                            else{ 
                              echo $this->lang->line('sales_complited');
                            }
                          ?>
                        </td>
                        <td>
                          <div class="dropdown">
                            <button title="Action" type="button" class="btn btn-sm bg-gray gropdown-toggle" data-toggle="dropdown">
                              <i class="fa fa-cog"></i>&nbsp;
                              <span class="fa fa-angle-double-down"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                              <li>
                                <a onclick="view_items(<?php echo $row->sales_id; ?>)" href="javascript:void(0);"><i class="fa fa-file-text-o"></i>Sales Items</a>
                              </li>
                              <li>
                                <a href="<?php echo base_url('sales/pdf/');?><?php echo $id; ?>" target="_blank"><i class="fa fa-file-pdf-o"></i>Bill (PDF)</a>
                              </li>
                              <li>
                                <a href="<?php echo base_url('sales/ch_pdf/');?><?php echo $id; ?>" target="_blank"><i class="fa fa-file-pdf-o"></i>Challan (PDF)</a>
                              </li>
                              <!-- <li>
                                <a href="<?php echo base_url('sales/view/');?><?php echo $id; ?>"><i class="fa fa-file-text-o"></i><?php echo $this->lang->line('sales_sales_details'); ?></a>
                              </li> -->
                              <!-- <li>
                                <a href="<?php echo base_url('sales/email/'); ?><?php echo $id; ?>"><i class="fa fa-envelope"></i><?php echo $this->lang->line('sales_email_sales'); ?></a>
                              </li> -->
                              <?php if($row->paid_amount == 0.00){ ?>
                              <li>
                                <a href="<?php echo base_url('sales/payment/'); ?><?php echo $id; ?>"><i class="fa fa-money"></i><?php echo $this->lang->line('sales_add_payment'); ?></a>
                              </li>
                                <?php if($this->session->userdata('type') == 'admin'){ ?>
                                  <li>
                                    <a href="<?php echo base_url('sales/edit/'); ?><?php echo $id; ?>"><i class="fa fa-edit"></i><?php echo $this->lang->line('sales_edit_sales'); ?></a>
                                  </li>
                                <?php } ?>
                              <?php } ?>
                              <?php if($this->session->userdata('type') == 'admin'){ ?>
                                <li>
                                  <a href="javascript:delete_id(<?php echo $id;?>)"><i class="fa fa-trash-o"></i><?php echo $this->lang->line('sales_delete_sales'); ?></a>
                                </li>
                              <?php } ?>
                            </ul>
                          </div>
                        </td>
                      <?php
                        }
                      ?>
                  <tfoot>
                  <tr>
                    <th><?php echo $this->lang->line('product_no'); ?>.</th>
                    <!-- <th><?php echo $this->lang->line('purchase_date'); ?></th> -->
                    <th><?php echo $this->lang->line('purchase_reference_no'); ?></th>
                    <th>Company Name</th>
                    <th>Shipping Mode</th>
                    <th>Status</th>
                    <th><?php echo $this->lang->line('purchase_grand_total'); ?></th>
                    <th><?php echo $this->lang->line('sales_paid'); ?></th>
                    <th><?php echo $this->lang->line('sales_payment_status'); ?></th>
                    <th><?php echo $this->lang->line('product_action'); ?></th>
                  </tr>
                  </tfoot>
                </table>

                <div style="display: none;" id="print">
                  <div id="header" class="box-header with-border" style="text-align: center; display: none">
                    <!-- <img width="300" height="100" src="<?php echo base_url().'assets/images/winmarkFinal.png'; ?>"><br>
                    <hr> -->

                    <h3 class="box-title">
                      Sales List
                    </h3>
                    <br><br>

                    <table id="pindex" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th><?php echo $this->lang->line('product_no'); ?>.</th>
                        <!-- <th style="min-width: 80px"><?php echo $this->lang->line('purchase_date'); ?></th> -->
                        <th><?php echo $this->lang->line('purchase_reference_no'); ?></th>
                        <th>Company Name</th>
                        <th>Shipping Mode</th>
                        <th>Status</th>
                        <th style="min-width: 90px"><?php echo $this->lang->line('purchase_grand_total'); ?></th>
                        <th style="min-width: 90px"><?php echo $this->lang->line('sales_paid'); ?></th>
                        <th><?php echo $this->lang->line('sales_payment_status'); ?></th>
                      </tr>
                      </thead>
                      <tbody id="precords">
                        <?php 
                            $grand_tot_bdt = 0; 
                            $grand_tot_usd = 0; 
                            $paid_tot_bdt = 0; 
                            $paid_tot_usd = 0; 

                            foreach ($data as $key => $row) {
                               $id= $row->sales_id;
                          ?>
                          <tr>
                            <td><?php echo ++$key; ?></td>
                            <!-- <td><?php echo $row->date; ?></td> -->
                            <td><?php echo $row->reference_no; ?></td>
                            <td><?php echo $row->company_name; ?></td>
                            <td><?php echo $row->ship_mode; ?></td>
                            <td align="center"><?php echo $this->lang->line('sales_complited'); ?></td>
                            <td align="right"><?php if($row->currency_id == 1){ echo '$';} else{ echo '৳'; } echo $row->total; ?></td>
                            <td align="right">
                              <?php
                                if($row->paid_amount != null){
                                  if($row->currency_id == 1){ 
                                    echo '$';
                                  } 
                                  else{ 
                                    echo '৳'; 
                                  } 
                                  echo $row->paid_amount;
                                }
                              ?>
                            </td>
                            <td align="center">
                              <?php 
                                if($row->paid_amount == null){ 
                                  echo $this->lang->line('sales_pending');
                                }
                                else{ 
                                  echo $this->lang->line('sales_complited');
                                }
                              ?>
                            </td>
                          </tr>
                          <?php
                              if($row->currency_id == 1){
                                $grand_tot_usd += $row->total;

                                if($row->paid_amount != null){
                                  $paid_tot_usd += $row->paid_amount;
                                }
                                else{
                                  $paid_tot_usd += 0.00;
                                }
                              }

                              else{
                                $grand_tot_bdt += $row->total;

                                if($row->paid_amount != null){
                                  $paid_tot_bdt += $row->paid_amount;
                                }
                                else{
                                  $paid_tot_bdt += 0.00;
                                }
                              }
                            }
                          ?>
                        </tbody>
                      <tfoot>
                      <tr>
                        <th><?php echo $this->lang->line('product_no'); ?>.</th>
                        <!-- <th><?php echo $this->lang->line('purchase_date'); ?></th> -->
                        <th><?php echo $this->lang->line('purchase_reference_no'); ?></th>
                        <th>Company Name</th>
                        <th>Shipping Mode</th>
                        <th>Status</th>
                        <th><span id="ft_grand_tot"><?php echo 'Grand Total: <br>'; ?><?php echo '$' . number_format((float)$grand_tot_usd, 2, '.', '') . '<br>৳' . number_format((float)$grand_tot_bdt, 2, '.', ''); ?></span></th>
                        <th><span id="ft_paid_tot"><?php echo 'Paid: <br>'; ?><?php echo '$' . number_format((float)$paid_tot_usd, 2, '.', '') . '<br>৳' . number_format((float)$paid_tot_bdt, 2, '.', ''); ?></span></th>
                        <th><?php echo $this->lang->line('sales_payment_status'); ?></th>
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
                    <h3 class="modal-title">Sales Items</h3>
                  </div>
                  <div class="modal-body">
                    <table id="index1" class="table table-bordered table-striped product_table1">
                      <thead>
                        <th>No.</th>
                        <th>Sales ID</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Cost Mode</th>
                        <th>Cost</th>
                        <th>Grand Total</th>
                        <th>Status</th>
                      <thead>
                      <tbody id="records1">
                      </tbody>
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

  function view_items(sales_id){
    $.ajax({
      url: "<?php echo base_url('sales/items_view') ?>/"+sales_id,
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
        if(response.data[0].sales_items_status == 'active'){
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
            trHTML += '<td>' + item.sales_id + '</td>';
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
      url: "<?php echo base_url('sales/filterSales') ?>/",
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
            if(item.ship_mode != null){
              trHTML += item.ship_mode;
            }
          trHTML += '</td>';
          
          trHTML += '<td align="center">' + 'Completed' + '</td>';
          trHTML += '<td align="right">';
            if(item.currency_id == 1){
              trHTML += '$';
            } 
            else{ 
              trHTML += '৳'; 
            } 

            trHTML += item.total;
          trHTML += '</td>';

          trHTML += '<td align="right">';
            if(item.paid_amount != null){
              if(item.currency_id == 1){
                trHTML += '$';
              } 
              else{ 
                trHTML += '৳'; 
              } 

              trHTML += item.paid_amount;
            }
          trHTML += '</td>';

          trHTML += '<td align="center">';
            if(item.paid_amount == null){ 
              trHTML += 'Pending';
            }
            else{ 
              trHTML += 'Completed';
            }
          trHTML += '</td>';
          trHTML += '<td>';
            trHTML += '<div class="dropdown"><button title="Action" type="button" class="btn btn-sm bg-gray gropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> &nbsp;<span class="fa fa-angle-double-down"></span></button><ul class="dropdown-menu"><li><a onclick="view_items(' + item.sales_id + ')" href="javascript:void(0);"><i class="fa fa-file-text-o"></i>Sales Items</a></li><li><a href="<?php echo base_url('sales/pdf/');?>' + item.sales_id + '" target="_blank"><i class="fa fa-file-pdf-o"></i>Bill (PDF)</a></li><li><a href="<?php echo base_url('sales/ch_pdf/');?>' + item.sales_id + '" target="_blank"><i class="fa fa-file-pdf-o"></i>Challan (PDF)</a></li><li><a href="<?php echo base_url('sales/edit/'); ?>' + item.sales_id + '"><i class="fa fa-edit"></i>Edit Sales</a></li><li><a href="javascript:delete_id(' + item.sales_id + ')"><i class="fa fa-trash-o"></i>Delete Sales</a></li></ul></div></td>';
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
        var paid_tot_usd = 0;
        var paid_tot_bdt = 0;
        var trHTML = '';
        $.each(response.data, function (i, item) {
          trHTML += '<tr>';
          trHTML += '<td>'+(i+1)+'</td>';
          // trHTML += '<td>' + item.date + '</td>';
          trHTML += '<td>' + item.reference_no + '</td>';
          trHTML += '<td>' + item.company_name + '</td>';
          trHTML += '<td>' + item.ship_mode + '</td>';
          trHTML += '<td align="center">' + 'Completed' + '</td>';
          trHTML += '<td align="right">';
            if(item.currency_id == 1){
              trHTML += '$';
            } 
            else{ 
              trHTML += '৳'; 
            } 

            trHTML += item.total;
          trHTML += '</td>';

          trHTML += '<td align="right">';
            if(item.paid_amount != null){
              if(item.currency_id == 1){
                trHTML += '$';
              } 
              else{ 
                trHTML += '৳'; 
              } 

              trHTML += item.paid_amount;
            }
          trHTML += '</td>';

          trHTML += '<td align="center">';
            if(item.paid_amount == 0.00){ 
              trHTML += 'Pending';
            }
            else{ 
              trHTML += 'Completed';
            }
          trHTML += '</td>';
          trHTML += '</tr>';

          if(item.currency_id == 1){
            grand_tot_usd += +item.total;

            if(item.paid_amount != null){
              paid_tot_usd += +item.total;
            }
            else{
              paid_tot_usd += +0.00;
            }
          }
          else{
            grand_tot_bdt += +item.total;

            if(item.paid_amount != null){
              paid_tot_bdt += +item.total;
            }
            else{
              paid_tot_bdt += +0.00;
            }
          }
        });
        
        $('#ft_grand_tot').html('Grand Total: <br>$' + grand_tot_usd.toFixed(2) + '<br>৳' + grand_tot_bdt.toFixed(2));
        $('#ft_paid_tot').html('Paid: <br>$' + paid_tot_usd.toFixed(2) + '<br>৳' + paid_tot_bdt.toFixed(2));
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

    $("#pdf").html('<a href="<?php echo base_url('sales/filterSalesPDF/');?>' + new_start_date + '/' + new_end_date + '" target="_blank">PDF (On Letter Heads)</a>');
  });
</script>