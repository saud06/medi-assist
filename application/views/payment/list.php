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
     if(confirm('Sure To Remove This Record ?'))
     {
        window.location.href='<?php  echo base_url('payment/delete/'); ?>'+id;
     }
  }
</script>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
         <ol class="breadcrumb">
          <li><a href="<?php echo base_url('auth/dashboard'); ?>" class="text-black"><i class="fa fa-dashboard">&nbsp;</i><strong><?php echo $this->lang->line('header_dashboard'); ?></strong></a></li>
          <li class="active"><?php echo $this->lang->line('header_payment'); ?></li>
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
              <h3 class="box-title">Payment List</h3>
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
                    <button title="Filter Payment List" type="button" id="btn_ajax" class="btn bg-gray"><i class="fa fa-search"></i></button> &emsp;
                    
                    <div class="btn-group">
                      <button title="Print Payment List" type="button" class="btn bg-gray gropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-print" aria-hidden="true"></i>&nbsp;
                        <span class="fa fa-angle-double-down"></span>
                      </button>
                      <ul class="dropdown-menu">
                        <li>
                          <a href="#" target="_blank" onclick="printContent('print')">Print (Default)</a>
                        </li>
                        <li id="pdf">
                          <a href="<?php echo base_url('payment/list_pdf');?>" target="_blank">PDF (On Letter Head)</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <br>

                <table id="index" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th><?php echo $this->lang->line('product_no'); ?></th>
                    <!-- <th><?php echo $this->lang->line('purchase_date'); ?></th> -->
                    <th><?php echo $this->lang->line('purchase_reference_no'); ?></th>
                    <th>Payment Method</th>
                    <th><?php echo $this->lang->line('sales_amount'); ?></th>
                    <th>Taken By</th>
                    <?php if($this->session->userdata('type') == 'admin'){ ?>
                      <th><?php echo $this->lang->line('product_action'); ?></th>
                    <?php }?>
                  </tr>
                  </thead>
                  <tbody id="records">
                    <?php 
                        foreach ($data as $row) {
                           $id= $row->id;
                      ?>
                      <tr>
                        <td></td>
                        <!-- <td><?php echo $row->date; ?></td> -->
                        <td><?php echo $row->reference_no; ?></td>
                        <td><?php echo $row->paying_by ?></td>
                        <td>
                          <?php 
                            if($row->currency_id == 1){
                              echo '$ ';
                            }
                            else{
                              echo '৳ ';
                            }
                            echo $row->amount;
                          ?>
                        </td>
                        <td><?php echo $row->name; if($row->designation){ echo ' (' . $row->designation . ')'; } echo ', ' . $row->contact; ?></td>
                        <?php if($this->session->userdata('type') == 'admin'){ ?>    
                          <td>
                            <div class="dropdown">
                              <button title="Action" type="button" class="btn btn-sm bg-gray gropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-cog"></i>&nbsp;
                                <span class="fa fa-angle-double-down"></span>
                              </button>
                              <ul class="dropdown-menu">
                                <li>
                                  <a href="<?php echo base_url('payment/edit/'); ?><?php echo $id; ?>"><i class="fa fa-edit"></i>Edit</a>
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
                  </tbody>
                  <tfoot>
                  <tr>
                    <th><?php echo $this->lang->line('product_no'); ?></th>
                    <!-- <th><?php echo $this->lang->line('purchase_date'); ?></th> -->
                    <th><?php echo $this->lang->line('purchase_reference_no'); ?></th>
                    <th>Payment Method</th>
                    <th><?php echo $this->lang->line('sales_amount'); ?></th>
                    <th>Taken By</th>
                    <?php if($this->session->userdata('type') == 'admin'){ ?>
                      <th><?php echo $this->lang->line('product_action'); ?></th>
                    <?php }?>
                  </tr>
                  </tfoot>
                </table>

                <div style="display: none;" id="print">
                  <div id="header" class="box-header with-border" style="text-align: center; display: none">
                    <!-- <img width="300" height="100" src="<?php echo base_url().'assets/images/winmarkFinal.png'; ?>"><br>
                    <hr> -->

                    <h3 class="box-title">
                      Payment List
                    </h3>
                    <br><br>

                    <table id="pindex" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th><?php echo $this->lang->line('product_no'); ?></th>
                        <!-- <th><?php echo $this->lang->line('purchase_date'); ?></th> -->
                        <th><?php echo $this->lang->line('purchase_reference_no'); ?></th>
                        <th>Payment Method</th>
                        <th><?php echo $this->lang->line('sales_amount'); ?></th>
                        <th>Taken By</th>
                      </tr>
                      </thead>
                      <tbody id="precords">
                        <?php 
                            foreach ($data as $key => $row) {
                               $id= $row->id;
                          ?>
                          <tr>
                            <td><?php echo ++$key; ?></td>
                            <!-- <td><?php echo $row->date; ?></td> -->
                            <td><?php echo $row->reference_no; ?></td>
                            <td><?php echo $row->paying_by ?></td>
                            <td>
                              <?php 
                                if($row->currency_id == 1){
                                  echo '$ ';
                                }
                                else{
                                  echo '৳ ';
                                }
                                echo $row->amount;
                              ?>
                            </td>
                            <td><?php echo $row->name; if($row->designation){ echo ' (' . $row->designation . ')'; } echo ', ' . $row->contact; ?></td>
                          </tr>
                          <?php
                            }
                          ?>
                      </tbody>
                      <tfoot>
                      <tr>
                        <th><?php echo $this->lang->line('product_no'); ?></th>
                        <!-- <th><?php echo $this->lang->line('purchase_date'); ?></th> -->
                        <th><?php echo $this->lang->line('purchase_reference_no'); ?></th>
                        <th>Payment Method</th>
                        <th><?php echo $this->lang->line('sales_amount'); ?></th>
                        <th>Taken By</th>
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
<?php
  $this->load->view('layout/footer');
?>

<script>
  $('#btn_ajax').click(function(){
    var date_range = $('#reservation').val();

    $.ajax({
      url: "<?php echo base_url('payment/filterPayment') ?>/",
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
          trHTML += '<td>' + item.paying_by + '</td>';
          trHTML += '<td>';
            if(item.currency_id == 1){
              trHTML += '$ ';
            }
            else{
              trHTML += '৳ ';
            }
            trHTML += item.amount;
          trHTML += '</td>';
          trHTML += '<td>' + item.name; 
            if(item.designation){ 
              trHTML += ' (' + item.designation + ')'; 
            } 
            trHTML += ', ' + item.contact;
          trHTML += '</td>';
          var type = '<?php echo $this->session->userdata("type") ?>';
          if(type == 'admin'){
            trHTML += '<td>';
              trHTML += '<div class="dropdown"><button title="Action" type="button" class="btn btn-sm bg-gray gropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> &nbsp;<span class="fa fa-angle-double-down"></span></button><ul class="dropdown-menu"><li><a href="<?php echo base_url('payment/edit/'); ?>' + item.id + '"><i class="fa fa-edit"></i>Edit</a></li><li><a href="javascript:delete_id(' + item.id + ')"><i class="fa fa-trash-o"></i>Delete</a></li></ul></div></td>';
            trHTML += '</td>';
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
          // trHTML += '<td>' + item.date + '</td>';
          trHTML += '<td>' + item.reference_no + '</td>';
          trHTML += '<td>' + item.paying_by + '</td>';
          trHTML += '<td>';
            if(item.currency_id == 1){
              trHTML += '$ ';
            }
            else{
              trHTML += '৳ ';
            }
            trHTML += item.amount;
          trHTML += '</td>';
          trHTML += '<td>' + item.name; 
            if(item.designation){ 
              trHTML += ' (' + item.designation + ')'; 
            } 
            trHTML += ', ' + item.contact;
          trHTML += '</td>';
          trHTML += '</tr>';
        });
        
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

    $("#pdf").html('<a href="<?php echo base_url('payment/filterPaymentPDF/');?>' + new_start_date + '/' + new_end_date + '" target="_blank">PDF (On Letter Heads)</a>');
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
</script>