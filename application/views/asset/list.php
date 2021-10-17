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
     if(confirm('Sure To Remove This Record?'))
     {
        window.location.href='<?php  echo base_url('asset/delete/'); ?>'+id;
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
          <li class="active">Asset <?= phpversion(); ?></li>
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
              <h3 class="box-title">Asset Bill List</h3>
              <a title="Add Asset" class="btn bg-gray" style="margin: 10px" href="<?php echo base_url('asset/add');?>"><i class="fa fa-plus"></i></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body outer-scroll">
              <div class="inner-scroll">
                <div class="row">
                  <div class="col-sm-1">
                    <p><strong>Asset Bill List Filter:</strong></p>
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
                    <button title="Filter Asset Bill List" type="button" id="btn_ajax" class="btn bg-gray"><i class="fa fa-search"></i></button> &emsp;
                    <div class="btn-group">
                      <button title="Print Asset Bill List" type="button" class="btn bg-gray gropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-print" aria-hidden="true"></i>&nbsp;
                        <span class="fa fa-angle-double-down"></span>
                      </button>
                      <ul class="dropdown-menu">
                        <li>
                          <a href="#" onclick="printContent('print')">Print (Default)</a>
                        </li>
                        <li id="pdf">
                          <a href="<?php echo base_url('asset/list_pdf');?>" target="_blank">PDF (On Letter Head)</a>
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
                    <th>Date</th>
                    <th>Title</th>
                    <th>Total Amount</th>
                    <th>Description</th>
                    <th>Expensed By</th>
                    <th>Status</th>
                    <th><?php echo $this->lang->line('product_action'); ?></th>
                  </tr>
                  </thead>
                  <tbody id="records2">
                    <?php 
                      foreach ($data as $row) {
                        $id= $row->asset_id;
                    ?>
                        <tr>
                          <td></td>
                          <td><?php echo $row->date; ?></td>
                          <td><?php echo $row->title; ?></td>
                          <td><?php echo $row->total_amount; ?></td>
                          <td><?php echo $row->bill_description; ?></td>
                          <td><?php echo $row->username; ?></td>
                          <td>
                            <?php 
                              $finalization_status = $row->finalization_status;
                              
                              if($finalization_status == 'Finalized'){
                                echo 'Finalized';
                              }
                              else{
                            ?>
                                <input type="checkbox" name="finalization_status" id="finalization_status" onchange="update_status(<?= $id ?>)">
                            <?php
                                echo '&nbsp;Finalize';
                              }
                            ?>
                          </td>
                          <td>
                            <div class="dropdown">
                              <button title="Action" type="button" class="btn btn-sm bg-gray gropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-cog"></i>&nbsp;
                                <span class="fa fa-angle-double-down"></span>
                              </button>
                              <ul class="dropdown-menu">
                                <li>
                                  <a onclick="view_categories(<?php echo $row->asset_id; ?>)" href="javascript:void(0);"><i class="fa fa-file-text-o"></i>Assets</a>
                                </li>
                                <?php if($finalization_status == 'Finalized'){ ?>
                                  <li>
                                    <a href="<?php echo base_url('asset/pdf/');?><?php echo $id; ?>" target="_blank"><i class="fa fa-file-pdf-o"></i>Bill (PDF)</a>
                                  </li>
                                <?php } ?>
                                <?php if($this->session->userdata('type') == 'admin'){ ?>
                                  <li>
                                    <a href="<?php echo base_url('asset/edit/'); ?><?php echo $id; ?>"><i class="fa fa-edit"></i>Edit</a>
                                  </li>
                                  <li>
                                    <a href="javascript:delete_id(<?php echo $id;?>)"><i class="fa fa-trash-o"></i>Delete</a>
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
                    <th>Date</th>
                    <th>Title</th>
                    <th>Amount</th>
                    <th>Description</th>
                    <th>Expensed By</th>
                    <th>Status</th>
                    <th><?php echo $this->lang->line('product_action'); ?></th>
                  </tr>
                  </tfoot>
                </table>

                <div style="display: none;" id="print">
                  <div id="header" class="box-header with-border" style="text-align: center; display: none">
                    <!-- <img width="300" height="100" src="<?php echo base_url().'assets/images/winmarkFinal.png'; ?>"><br>
                    <hr> -->

                    <h3 class="box-title">
                      Asset List
                    </h3>
                    
                    <br>

                    <span id="date_range"></span>

                    <br><br>

                    <span id="finalization_text"></span>

                    <br>

                    <table id="pindex" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th><?php echo $this->lang->line('product_no'); ?>.</th>
                        <th>Date</th>
                        <th>Title</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Expensed By</th>
                        <th class="status-col">Status</th>
                      </tr>
                      </thead>
                      <tbody id="precords2">
                        <?php 
                          $grand_tot = 0; 

                          foreach ($data as $key => $row) {
                            $id= $row->asset_id;
                        ?>
                          <tr>
                            <td><?php echo ++$key; ?></td>
                            <td><?php echo $row->date; ?></td>
                            <td><?php echo $row->title; ?></td>
                            <td><?php echo $row->total_amount; ?></td>
                            <td><?php echo $row->bill_description; ?></td>
                            <td><?php echo $row->username; ?></td>
                            <td class="status-col"><?php echo $row->finalization_status; ?></td>
                          </tr>
                        <?php
                            $grand_tot += $row->total_amount;
                          }
                        ?>
                      </tbody>
                      <tfoot>
                      <tr>
                        <th><?php echo $this->lang->line('product_no'); ?>.</th>
                        <th>Date</th>
                        <th>Title</th>
                        <th><span id="ft_grand_tot"><?php echo 'Grand Total: <br>'; ?><?php echo number_format((float)$grand_tot, 2, '.', ''); ?></span></th>
                        <th>Description</th>
                        <th>Expensed By</th>
                        <th class="status-col">Status</th>
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
                    <h3 class="modal-title">Assets</h3>
                  </div>
                  <div class="modal-body">
                    <table id="index1" class="table table-bordered table-striped product_table1">
                      <thead>
                        <th>No.</th>
                        <th>Asset ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Purpose</th>
                        <th>Warranty Period</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                        <th>Gross Total</th>
                      <thead>
                      <tbody id="records">
                      </tbody>
                      <tfoot>
                        <th>No.</th>
                        <th>Asset ID</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Purpose</th>
                        <th>Warranty Period</th>
                        <th>Quantity</th>
                        <th>Amount</th>
                        <th>Gross Total</th>
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
    
    var flag = 0;
    $.ajax({
      url: "<?php echo base_url('asset/filterAsset') ?>/",
      type: "POST",
      dataType: "JSON",
      async: false,
      success: function (response) {
        var count = 0;
        for(i=0; i<response.data.length; i++){
          if(response.data[i].finalization_status !== 'Finalized') break;
          else count++;
        }

        if(count == response.data.length) flag = 1;
      }
    });

    if(flag == 1){
      $('#finalization_text').html('<p style="text-align: center;"><strong>FINALIZED</strong></p>');
      $('.status-col').css('display', 'none');
    }

    //var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    //document.body.innerHTML = restorepage;
  }
  
  window.onafterprint = function(){
    window.location.reload(true);
  }

  function update_status(asset_id){
    $.ajax({
      url: "<?php echo base_url('asset/update_status') ?>/"+asset_id,
      type: "GET",
      dataType: "JSON",
      success: function (response) {
        if(response.status == true) window.location.reload(true);
      }
    });
  }

  function view_categories(asset_id){
    $.ajax({
      url: "<?php echo base_url('asset/categories_view') ?>/"+asset_id,
      type: "GET",
      dataType: "JSON",
      success: function (response) {
        var table = $('#index1').DataTable();
        table.destroy();
        $('#records').empty();

        var trHTML = '';
        $.each(response.data, function (i, item) {
            trHTML += '<tr>';
            trHTML += '<td></td>';
            trHTML += '<td>' + item.asset_id + '</td>';
            trHTML += '<td>' + item.asset_name + '</td>';
            trHTML += '<td>' + item.asset_description + '</td>';
            trHTML += '<td>' + item.purpose + '</td>';
            trHTML += '<td>' + item.warranty_period + '</td>';
            trHTML += '<td>' + item.quantity + '</td>';
            trHTML += '<td>' + item.amount + '</td>';
            trHTML += '<td>' + item.gross_total + '</td>';
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

    var split_date_range = date_range.split(' - ');
    var start_date = split_date_range[0];
    start_date = start_date.split('/').join('-');
    var start_date_parts = start_date.split('-');
    var new_start_date = start_date_parts[2] + '-' + start_date_parts[0] + '-' + start_date_parts[1];
    var end_date = split_date_range[1];
    end_date = end_date.split('/').join('-');
    var end_date_parts = end_date.split('-');
    var new_end_date = end_date_parts[2] + '-' + end_date_parts[0] + '-' + end_date_parts[1];

    $.ajax({
      url: "<?php echo base_url('asset/filterAsset') ?>/",
      type: "POST",
      dataType: "JSON",
      data : {
        date_range: date_range
      },
      success: function (response) {
        var table = $('#index').DataTable();
        table.destroy();
        $('#records2').empty();

        var trHTML = '';
        $.each(response.data, function (i, item) {
            trHTML += '<tr>';
            trHTML += '<td>'+(i+1)+'</td>';
            trHTML += '<td>' + item.date + '</td>';
            trHTML += '<td>' + item.title + '</td>';
            trHTML += '<td>' + item.total_amount + '</td>';
            trHTML += '<td>' + item.bill_description + '</td>';
            trHTML += '<td>' + item.username + '</td>';
            trHTML += '<td>';
              var finalization_status = item.finalization_status;
                            
              if(finalization_status == 'Finalized'){
                trHTML += 'Finalized';
              }
              else{
                trHTML += '<input type="checkbox" name="finalization_status" id="finalization_status" onchange="update_status('+ item.asset_id +')">';
                trHTML += '&nbsp;Finalize';
              }
            trHTML += '</td>';
            
            trHTML += '<td>';
              trHTML += '<div class="dropdown"><button title="Action" type="button" class="btn btn-sm bg-gray gropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> &nbsp;<span class="fa fa-angle-double-down"></span></button><ul class="dropdown-menu"><li><a onclick="view_categories(' + item.asset_id + ')" href="javascript:void(0);"><i class="fa fa-file-text-o"></i>Assets</a></li><li><a href="<?php echo base_url('asset/pdf/');?>' + item.asset_id + '" target="_blank"><i class="fa fa-file-pdf-o"></i>Bill (PDF)</a></li><li><a href="<?php echo base_url('asset/edit/'); ?>' + item.asset_id + '"><i class="fa fa-edit"></i>Edit</a></li><li><a href="javascript:delete_id(' + item.asset_id + ')"><i class="fa fa-trash-o"></i>Delete</a></li></ul></div></td>';
            trHTML += '</td>'; 
            trHTML += '</tr>';
        });
        
        $('#records2').append(trHTML);
        $('#index').DataTable( {
            "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": 0
            } ],
            "order": [[ 1, 'asc' ]],
            "pageLength": 100
        });

        $('#date_range').html('(From <strong>' + new_start_date + '</strong> To <strong>' + new_end_date + '</strong>)');

        $('#precords2').empty();

        var count = 0;
        for(i=0; i<response.data.length; i++){
          if(response.data[i].finalization_status !== 'Finalized') break;
          else count++;
        }

        if(count == response.data.length){
          $('#finalization_text').html('<p style="text-align: center;"><strong>FINALIZED</strong></p>');
          $('.status-col').css('display', 'none');
        }

        var grand_tot = 0;
        var trHTML = '';
        $.each(response.data, function (i, item) {
            trHTML += '<tr>';
            trHTML += '<td>' + (i+1) + '</td>';
            trHTML += '<td>' + item.date + '</td>';
            trHTML += '<td>' + item.title + '</td>';
            trHTML += '<td>' + item.total_amount + '</td>';
            trHTML += '<td>' + item.bill_description + '</td>';
            trHTML += '<td>' + item.username + '</td>';

            if(count != response.data.length){
              trHTML += '<td>' + item.finalization_status + '</td>';
            }

            trHTML += '</tr>';

            grand_tot += +item.total_amount;
        });
        
        $('#ft_grand_tot').html('Grand Total: <br>' + grand_tot.toFixed(2));
        $('#precords2').append(trHTML);
      }
    });

    $("#pdf").html('<a href="<?php echo base_url('asset/filterAssetPDF/');?>' + new_start_date + '/' + new_end_date + '" target="_blank">PDF (On Letter Heads)</a>');
  });
</script>