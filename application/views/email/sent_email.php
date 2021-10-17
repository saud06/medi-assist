<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','manager');
if(!(in_array($this->session->userdata('type'),$p))){
  redirect('auth');
}
  $this->load->view('layout/header');
?>
  
  <style type="text/css">
    .btn-default.btn-on.active{
      background-color: #5BB75B;
      color: white;
    }
    .btn-default.btn-off.active{
      background-color: #DA4F49;
      color: white;
    }
    #email{
      color: gray;
      font-weight: bold;
    }
    #email:hover{
      text-decoration: underline;
    }

    table.dataTable thead > tr > th, table.dataTable tfoot > tr > th, table.dataTable tbody > tr > td{
      vertical-align: middle;
      text-align: center;
    }
  </style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php 
      // $this->load->view('layout/sticky_note');
    ?>
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('auth/dashboard'); ?>" class="text-black"><i class="fa fa-dashboard">&nbsp;</i><strong><?php echo $this->lang->line('header_dashboard'); ?></strong></a></li>
          <li class="active">Work Status</li>
        </ol>
      </h5>    
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- right column -->
        <?php
          if($fail = $this->session->flashdata('fail')){
        ?>
          <div class="col-sm-12">
            <div class="alert alert-success">
              <button class="close" data-dismiss="alert" type="button">×</button>
                <?php echo $fail; ?>
              <div class="alerts-con"></div>
            </div>
          </div>
        <?php
          }
        ?>
        
        <div class="row">
          <div class="col-md-2">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Work Templates</h3>
              </div>
              <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                  <li><a href="email/raw"><i class="fa fa-inbox"></i> New Email</a></li>

                  <li style="width: 70%; float: left;"><a href="email/inquiry_mail"><i class="fa fa-envelope-o"></i> Inquiry Mail</a></li>
                  <li style="width: 30%; float: right;"><a title="Inquiry Mail History" class="text-center" href="<?php echo base_url('email/email_history/inquiry_query');?>"><i class="fa fa-history"></i></a></li>

                  <li style="width: 70%; float: left;"><a href="email/quotation"><i class="fa fa-file-text-o"></i> Quotation</a></li>
                  <li style="width: 30%; float: right;"><a title="Quotation History" class="text-center" href="<?php echo base_url('email/email_history/quotation_query');?>"><i class="fa fa-history"></i></a></li>

                  <li style="width: 70%; float: left;"><a href="email/proforma_invoice"><i class="fa fa-filter"></i> Proforma Invoice / Indent</a></li>
                  <li style="width: 30%; float: right;"><a style="padding: 20px 15px" title="Indent History" class="text-center" href="<?php echo base_url('email/email_history/indent_query');?>"><i class="fa fa-history"></i></a></li>

                  <li style="width: 70%; float: left;"><a href="email/sample_draft"><i class="fa fa-check-square"></i> Forwarding / O.C</a></li>
                  <li style="width: 30%; float: right;"><a title="Forwarding / O.C History" class="text-center" href="<?php echo base_url('email/email_history/sample_draft_query');?>"><i class="fa fa-history"></i></a></li>
                </ul>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /. box -->

            <a onclick="view_bill_challan()" href="javascript:void(0);" class="btn bg-gray btn-block margin-bottom">Bills & Challans</a>
          </div>

          <div class="col-md-10">
            <div class="box">
              <div class="box-header with-border">
                <h3 class="box-title">
                  Work Status
                </h3>
              </div>

              <div class="box-body outer-scroll">
                <div class="inner-scroll">
                  <table id="index" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>
                          No.
                        </th>
                        <th>
                          Order No.
                        </th>
                        <!-- <th>
                          Email
                        </th> -->
                        <th>
                          Forwarding / O.C
                        </th>
                        <th>
                          Test Report
                        </th>
                        <th>
                          Inquiry
                        </th>
                        <th>
                          Price Quotation
                        </th>
                        <th>
                          Client Feedback
                        </th>
                        <th>
                          Indent
                        </th>
                        <th>
                          LC / TT
                        </th>
                        <th>
                          Shipping
                        </th>
                        <th>
                          Payment
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        foreach ($email_status as $key => $row) {
                          $id = $row->email_status_id;
                      ?>
                          <tr>
                            <td></td>
                            <td><?php echo $row->ref_no; ?></td>
                            <!-- <td><?php echo $row->email; ?></td> -->
                            <td>
                              <div style="width: 80px" class="btn-group status" data-toggle="buttons" onclick="get_id(<?php echo $key; ?>)">
                                <label class="btn btn-default btn-on btn-sm <?php if($row->sample_draft_status == 'YES'){ ?>  active <?php }?>">
                                <input type="radio" value="YES" class="status_radio" name="sample_draft_status" <?php if($row->sample_draft_status == 'YES'){ ?> checked="checked" <?php }?>>YES</label>
                                <label class="btn btn-default btn-off btn-sm <?php if($row->sample_draft_status == 'NO'){ ?>  active <?php }?>">
                                <input type="radio" value="NO" class="status_radio" name="sample_draft_status" <?php if($row->sample_draft_status == 'NO'){ ?> checked="checked" <?php }?>>NO</label>
                                <input type="hidden" id="mail_stat_id<?php echo $key; ?>" value="<?php echo $id; ?>">
                              </div><!-- <hr style="margin: 4px;"> -->

                              <!-- <a href="<?php echo base_url('email/sample_draft/'); ?><?php echo $row->ref_no; ?>" title="Compose" class="btn btn-sm bg-gray"><span class="glyphicon glyphicon-share-alt"></span></a>&nbsp;&nbsp; -->
                              <!-- <button title="List" class="btn btn-sm bg-gray" onclick="list('sample_draft', '<?php echo $row->ref_no; ?>'); "><span class="glyphicon glyphicon-th-list"></span></button> -->
                            </td>
                            <td>
                              <div style="width: 80px" class="btn-group status" data-toggle="buttons" onclick="get_id(<?php echo $key; ?>)">
                                <label class="btn btn-default btn-on btn-sm <?php if($row->test_report_status == 'YES'){ ?>  active <?php }?>">
                                <input type="radio" value="YES" class="status_radio" name="test_report_status" <?php if($row->test_report_status == 'YES'){ ?> checked="checked" <?php }?>>YES</label>
                                <label class="btn btn-default btn-off btn-sm <?php if($row->test_report_status == 'NO'){ ?>  active <?php }?>">
                                <input type="radio" value="NO" class="status_radio" name="test_report_status" <?php if($row->test_report_status == 'NO'){ ?> checked="checked" <?php }?>>NO</label>
                              </div><hr style="margin: 4px;">

                              <button class="btn bg-gray btn-sm" data-toggle="popover" title="Insert Remark" data-placement="bottom" id="remarks_label<?php echo $key; ?>1">Remark&nbsp;&nbsp;<span class="glyphicon glyphicon-pencil"></span></button>

                              <div style="display: none;" id="remarks_content<?php echo $key; ?>1">
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <textarea rows="3" class="form-control" id="remarks<?php echo $key; ?>1"><?php echo $row->test_report_remark; ?></textarea>
                                    
                                      <br><br>
                                      <button type="button" class="btn btn-success btn-sm" onclick="add_remarks('<?php echo $id; ?>', '<?php echo $key; ?>', '<?php echo 1; ?>')"><span class="glyphicon glyphicon-ok" title="Save"></span></button>&nbsp;
                                      <button type="button" onclick="close_remark('<?php echo $key; ?>', '<?php echo 1; ?>')" id="close<?php echo $key; ?>1" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove" title="Close"></span></button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </td>
                            <td>
                              <div style="width: 80px" class="btn-group status" data-toggle="buttons" onclick="get_id(<?php echo $key; ?>)">
                                <label class="btn btn-default btn-on btn-sm <?php if($row->inquiry_status == 'YES'){ ?>  active <?php }?>">
                                <input type="radio" value="YES" class="status_radio" name="inquiry_status" <?php if($row->inquiry_status == 'YES'){ ?> checked="checked" <?php }?>>YES</label>
                                <label class="btn btn-default btn-off btn-sm <?php if($row->inquiry_status == 'NO'){ ?>  active <?php }?>">
                                <input type="radio" value="NO" class="status_radio" name="inquiry_status" <?php if($row->inquiry_status == 'NO'){ ?> checked="checked" <?php }?>>NO</label>
                              </div><!-- <hr style="margin: 4px;"> -->

                              <!-- <a href="<?php echo base_url('email/inquiry_mail/'); ?><?php echo $row->ref_no; ?>" title="Compose" class="btn btn-sm bg-gray"><span class="glyphicon glyphicon-share-alt"></span>&nbsp;&nbsp;Compose</a> --><!-- &nbsp;&nbsp;
                              <button title="List" class="btn btn-sm bg-gray" onclick="list('inquiry', '<?php echo $row->ref_no; ?>'); "><span class="glyphicon glyphicon-th-list"></span></button> -->
                            </td>
                            <td>
                              <div style="width: 80px" class="btn-group status" data-toggle="buttons" onclick="get_id(<?php echo $key; ?>)">
                                <label class="btn btn-default btn-on btn-sm <?php if($row->price_quotation_status == 'YES'){ ?>  active <?php }?>">
                                <input type="radio" value="YES" class="status_radio" name="price_quotation_status" <?php if($row->price_quotation_status == 'YES'){ ?> checked="checked" <?php }?>>YES</label>
                                <label class="btn btn-default btn-off btn-sm <?php if($row->price_quotation_status == 'NO'){ ?>  active <?php }?>">
                                <input type="radio" value="NO" class="status_radio" name="price_quotation_status" <?php if($row->price_quotation_status == 'NO'){ ?> checked="checked" <?php }?>>NO</label>
                              </div><!-- <hr style="margin: 4px;"> -->

                              <!-- <a href="<?php echo base_url('email/quotation/'); ?><?php echo $row->ref_no; ?>" title="Compose" class="btn btn-sm bg-gray"><span class="glyphicon glyphicon-share-alt"></span></a>&nbsp;&nbsp; -->
                              <!-- <button title="List" class="btn btn-sm bg-gray" onclick="list('quotation', '<?php echo $row->ref_no; ?>'); "><span class="glyphicon glyphicon-th-list"></span></button> -->
                            </td>
                            <td>
                              <div style="width: 80px" class="btn-group status" data-toggle="buttons" onclick="get_id(<?php echo $key; ?>)">
                                <label class="btn btn-default btn-on btn-sm <?php if($row->customer_feedback_status == 'YES'){ ?>  active <?php }?>">
                                <input type="radio" value="YES" class="status_radio" name="customer_feedback_status" <?php if($row->customer_feedback_status == 'YES'){ ?> checked="checked" <?php }?>>YES</label>
                                <label class="btn btn-default btn-off btn-sm <?php if($row->customer_feedback_status == 'NO'){ ?>  active <?php }?>">
                                <input type="radio" value="NO" class="status_radio" name="customer_feedback_status" <?php if($row->customer_feedback_status == 'NO'){ ?> checked="checked" <?php }?>>NO</label>
                              </div><hr style="margin: 4px;">

                              <button class="btn bg-gray btn-sm" data-toggle="popover" title="Insert Remark" data-placement="bottom" id="remarks_label<?php echo $key; ?>2">Remark&nbsp;&nbsp;<span class="glyphicon glyphicon-pencil"></span></button>

                              <div style="display: none;" id="remarks_content<?php echo $key; ?>2">
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <textarea rows="3" class="form-control" id="remarks<?php echo $key; ?>2"><?php echo $row->customer_feedback_remark; ?></textarea>
                                    
                                      <br><br>
                                      <button type="button" class="btn btn-success btn-sm" onclick="add_remarks('<?php echo $id; ?>', '<?php echo $key; ?>', '<?php echo 2; ?>')"><span class="glyphicon glyphicon-ok" title="Save"></span></button>&nbsp;
                                      <button type="button" onclick="close_remark('<?php echo $key; ?>', '<?php echo 2; ?>')" id="close<?php echo $key; ?>2" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove" title="Close"></span></button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </td>
                            <td>
                              <div style="width: 80px" class="btn-group status" data-toggle="buttons" onclick="get_id(<?php echo $key; ?>)">
                                <label class="btn btn-default btn-on btn-sm <?php if($row->indent_status == 'YES'){ ?>  active <?php }?>">
                                <input type="radio" value="YES" class="status_radio" name="indent_status" <?php if($row->indent_status == 'YES'){ ?> checked="checked" <?php }?>>YES</label>
                                <label class="btn btn-default btn-off btn-sm <?php if($row->indent_status == 'NO'){ ?>  active <?php }?>">
                                <input type="radio" value="NO" class="status_radio" name="indent_status" <?php if($row->indent_status == 'NO'){ ?> checked="checked" <?php }?>>NO</label>
                              </div><!-- <hr style="margin: 4px;"> -->

                              <!-- <a href="<?php echo base_url('email/proforma_invoice/'); ?><?php echo $row->ref_no; ?>" title="Compose" class="btn btn-sm bg-gray"><span class="glyphicon glyphicon-share-alt"></span></a>&nbsp;&nbsp; -->
                              <!-- <button title="List" class="btn btn-sm bg-gray" onclick="list('indent', '<?php echo $row->ref_no; ?>'); "><span class="glyphicon glyphicon-th-list"></span></button> -->
                            </td>
                            <td>
                              <div style="width: 80px" class="btn-group status" data-toggle="buttons" onclick="get_id(<?php echo $key; ?>)">
                                <label class="btn btn-default btn-on btn-sm <?php if($row->lc_status == 'YES'){ ?>  active <?php }?>">
                                <input type="radio" value="YES" class="status_radio" name="lc_status" <?php if($row->lc_status == 'YES'){ ?> checked="checked" <?php }?>>YES</label>
                                <label class="btn btn-default btn-off btn-sm <?php if($row->lc_status == 'NO'){ ?>  active <?php }?>">
                                <input type="radio" value="NO" class="status_radio" name="lc_status" <?php if($row->lc_status == 'NO'){ ?> checked="checked" <?php }?>>NO</label>
                              </div><hr style="margin: 4px;">

                              <button class="btn bg-gray btn-sm" data-toggle="popover" title="Insert Remark" data-placement="bottom" id="remarks_label<?php echo $key; ?>3">Remark&nbsp;&nbsp;<span class="glyphicon glyphicon-pencil"></span></button>

                              <div style="display: none;" id="remarks_content<?php echo $key; ?>3">
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <textarea rows="3" class="form-control" id="remarks<?php echo $key; ?>3"><?php echo $row->lc_status_remark; ?></textarea>
                                    
                                      <br><br>
                                      <button type="button" class="btn btn-success btn-sm" onclick="add_remarks('<?php echo $id; ?>', '<?php echo $key; ?>', '<?php echo 3; ?>')"><span class="glyphicon glyphicon-ok" title="Save"></span></button>&nbsp;
                                      <button type="button" onclick="close_remark('<?php echo $key; ?>', '<?php echo 3; ?>')" id="close<?php echo $key; ?>3" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove" title="Close"></span></button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </td>
                            <td>
                              <div style="width: 80px" class="btn-group status" data-toggle="buttons" onclick="get_id(<?php echo $key; ?>)">
                                <label class="btn btn-default btn-on btn-sm <?php if($row->shipping_status == 'YES'){ ?>  active <?php }?>">
                                <input type="radio" value="YES" class="status_radio" name="shipping_status" <?php if($row->shipping_status == 'YES'){ ?> checked="checked" <?php }?>>YES</label>
                                <label class="btn btn-default btn-off btn-sm <?php if($row->shipping_status == 'NO'){ ?>  active <?php }?>">
                                <input type="radio" value="NO" class="status_radio" name="shipping_status" <?php if($row->shipping_status == 'NO'){ ?> checked="checked" <?php }?>>NO</label>
                              </div><hr style="margin: 4px;">

                              <button class="btn bg-gray btn-sm" data-toggle="popover" title="Insert Remark" data-placement="bottom" id="remarks_label<?php echo $key; ?>4">Remark&nbsp;&nbsp;<span class="glyphicon glyphicon-pencil"></span></button>

                              <div style="display: none;" id="remarks_content<?php echo $key; ?>4">
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <textarea rows="3" class="form-control" id="remarks<?php echo $key; ?>4"><?php echo $row->shipping_status_remark; ?></textarea>
                                    
                                      <br><br>
                                      <button type="button" class="btn btn-success btn-sm" onclick="add_remarks('<?php echo $id; ?>', '<?php echo $key; ?>', '<?php echo 4; ?>')"><span class="glyphicon glyphicon-ok" title="Save"></span></button>&nbsp;
                                      <button type="button" onclick="close_remark('<?php echo $key; ?>', '<?php echo 4; ?>')" id="close<?php echo $key; ?>4" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove" title="Close"></span></button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </td>
                            <td>
                              <div style="width: 80px" class="btn-group status" data-toggle="buttons" onclick="get_id(<?php echo $key; ?>)">
                                <label class="btn btn-default btn-on btn-sm <?php if($row->payment_status == 'YES'){ ?>  active <?php }?>">
                                <input type="radio" value="YES" class="status_radio" name="payment_status" <?php if($row->payment_status == 'YES'){ ?> checked="checked" <?php }?>>YES</label>
                                <label class="btn btn-default btn-off btn-sm <?php if($row->payment_status == 'NO'){ ?>  active <?php }?>">
                                <input type="radio" value="NO" class="status_radio" name="payment_status" <?php if($row->payment_status == 'NO'){ ?> checked="checked" <?php }?>>NO</label>
                              </div><hr style="margin: 4px;">

                              <button class="btn bg-gray btn-sm" data-toggle="popover" title="Insert Remark" data-placement="bottom" id="remarks_label<?php echo $key; ?>5">Remark&nbsp;&nbsp;<span class="glyphicon glyphicon-pencil"></span></button>

                              <div style="display: none;" id="remarks_content<?php echo $key; ?>5">
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      <textarea rows="3" class="form-control" id="remarks<?php echo $key; ?>5"><?php echo $row->payment_status_remark; ?></textarea>
                                    
                                      <br><br>
                                      <button type="button" class="btn btn-success btn-sm" onclick="add_remarks('<?php echo $id; ?>', '<?php echo $key; ?>', '<?php echo 5; ?>')"><span class="glyphicon glyphicon-ok" title="Save"></span></button>&nbsp;
                                      <button type="button" onclick="close_remark('<?php echo $key; ?>', '<?php echo 5; ?>')" id="close<?php echo $key; ?>5" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove" title="Close"></span></button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </td>
                          </tr>
                      <?php
                        }
                      ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th>
                          No.
                        </th>
                        <th>
                          Order No.
                        </th>
                        <!-- <th>
                          Email
                        </th> -->
                        <th>
                          Forwarding / O.C
                        </th>
                        <th>
                          Test Report
                        </th>
                        <th>
                          Inquiry
                        </th>
                        <th>
                          Price Quotation
                        </th>
                        <th>
                          Client Feedback
                        </th>
                        <th>
                          Indent
                        </th>
                        <th>
                          LC / TT
                        </th>
                        <th>
                          Shipping
                        </th>
                        <th>
                          Payment
                        </th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
            </div>

            <!-- modal -->
            <div class="modal fade" id="modal_form" role="dialog">
              <div class="modal-dialog" style="width: 80%">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title"></h3>
                  </div>
                  <div class="modal-body">
                    <form name="actionForm" action="<?php echo base_url('email/delete_mul'); ?>" method="post" onsubmit="return deleteConfirm();"/>

                      <div class="box-body no-padding">
                        <div class="table-responsive mailbox-messages">
                          <table class="table table-hover table-striped">
                            <tbody id="records">
                              
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div class="box-footer no-padding">
                        <div class="mailbox-controls">
                          Check All &nbsp;
                          <button type="button" class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i>
                          </button>
                          <div class="btn-group">
                            <button type="submit" class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
          </div>
        </div>
      </div>
      <!-- /.row -->

      <!-- modal -->
      <div class="modal fade" id="modal_form2" role="dialog">
        <div class="modal-dialog" style="width: 80%">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h3 class="modal-title">Bills & Challans</h3>
            </div>
            <div class="modal-body">
              <table id="index1" class="table table-bordered table-striped product_table1">
                <thead>
                  <th>No.</th>
                  <th>Date</th>
                  <th>Reference No.</th>
                  <th>Company Name</th>
                  <th>Shipping Mode</th>
                  <th>Status</th>
                  <th>Grand Total</th>
                  <th>Paid</th>
                  <th>Payment Status</th>
                  <th>Bill & Challan</th>
                <thead>
                <tbody id="records1">
                </tbody>
              </table>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
    $this->load->view('layout/footer');
  ?>
<script>
  function view_bill_challan(){
    $.ajax({
      url: "<?php echo base_url('email/get_bill_challan') ?>/",
      type: "POST",
      dataType: "JSON",
      success: function (response) {
        var table = $('#index1').DataTable();
        table.destroy();
        $('#records1').empty();

        var trHTML = '';
        $.each(response.data, function (i, item) {
          trHTML += '<tr>';
          trHTML += '<td>'+(i+1)+'</td>';
          trHTML += '<td>' + item.date + '</td>';
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
            trHTML += '<div class="dropdown"><button title="Bill & Challan" type="button" class="btn btn-sm bg-gray gropdown-toggle" data-toggle="dropdown"><i class="fa fa-file-pdf-o"></i> &nbsp;<span class="fa fa-angle-double-down"></span></button><ul class="dropdown-menu"><li><a href="<?php echo base_url('email/bl_pdf/');?>' + item.sales_id + '" target="_blank"><i class="fa fa-file-pdf-o"></i>Bill (PDF)</a></li><li><a href="<?php echo base_url('email/ch_pdf/');?>' + item.sales_id + '" target="_blank"><i class="fa fa-file-pdf-o"></i>Challan (PDF)</a></li></ul></div></td>';
          trHTML += '</td>'; 
          trHTML += '</tr>';
        });
        
        $('#records1').append(trHTML);
        $('#index1').DataTable({
          "columnDefs": [ {
              "searchable": false,
              "orderable": false,
              "targets": 0
          } ],
          "order": [[ 1, 'asc' ]],
          "pageLength": 100
        });
      }
    });

    $('#modal_form2').modal('show');
  }

  $(document).ready(function(){
    $('#btn_ajax').click(function(){
      var email_id = $('#email_id').val();
      var email_address = $('#email_address').val();

      if(!email_id && !email_address){
        alert('Insert Something to Filter!');
      } else {
          $.ajax({
            url: "<?php echo base_url('email/filter_email') ?>",
            type: "POST",
            dataType: "JSON",
            data : {
              email_id: email_id,
              email_address
            },
            success: function (response) {
              var email_saved = response.data;
              console.log(email_saved);

              var mail_id_arr = [],
                  mail_sType_arr = [],
                  mail_lType_arr = [],
                  mail_no_arr = [],
                  mail_too_arr = [],
                  mail_subject_arr = [],
                  mail_pieces_arr = [],
                  mail_datetime_arr = [];

              var counter = 0;

              for(i=0; i<email_saved.sample_draft_query.length; i++) {
                var body = $(email_saved.sample_draft_query[i].body).text();
                var exp_body = body.split(" ");

                if(email_saved.sample_draft_query[i].mail_no.substr(0, 5) == 'WSD'){
                  var sType = 'sd';
                  var lType = 'sample_draft';
                }

                mail_id_arr.push(email_saved.sample_draft_query[i].id);
                mail_sType_arr.push(sType);
                mail_lType_arr.push(lType);
                mail_no_arr.push(email_saved.sample_draft_query[i].mail_no);
                mail_too_arr.push(email_saved.sample_draft_query[i].too);
                mail_subject_arr.push(email_saved.sample_draft_query[i].subject);
                mail_pieces_arr.push(exp_body[0] + ' ' + exp_body[1] + ' ' + exp_body[2] + ' ' + exp_body[3] + ' ' + exp_body[4] + '...');
                mail_datetime_arr.push(email_saved.sample_draft_query[i].datetime);

                counter++;
              }

              for(j=0; j<email_saved.quotation_query.length; j++) {
                var body = $(email_saved.quotation_query[j].body).text();
                var exp_body = body.split(" ");

                if(email_saved.quotation_query[j].mail_no.substr(0, 6) == 'WQTN'){
                  var sType = 'qt';
                  var lType = 'quotation';
                }

                mail_id_arr.push(email_saved.quotation_query[j].id);
                mail_sType_arr.push(sType);
                mail_lType_arr.push(lType);
                mail_no_arr.push(email_saved.quotation_query[j].mail_no);
                mail_too_arr.push(email_saved.quotation_query[j].too);
                mail_subject_arr.push(email_saved.quotation_query[j].subject);
                mail_pieces_arr.push(exp_body[0] + ' ' + exp_body[1] + ' ' + exp_body[2] + ' ' + exp_body[3] + ' ' + exp_body[4] + '...');
                mail_datetime_arr.push(email_saved.quotation_query[j].datetime);

                counter++;
              }

              for(k=0; k<email_saved.indent_query.length; k++) {
                var body = $(email_saved.indent_query[k].body).text();
                var exp_body = body.split(" ");

                if(email_saved.indent_query[k].mail_no.substr(0, 6) == 'WIND'){
                  var sType = 'it';
                  var lType = 'indent';
                }

                mail_id_arr.push(email_saved.indent_query[k].id);
                mail_sType_arr.push(sType);
                mail_lType_arr.push(lType);
                mail_no_arr.push(email_saved.indent_query[k].mail_no);
                mail_too_arr.push(email_saved.indent_query[k].too);
                mail_subject_arr.push(email_saved.indent_query[k].subject);
                mail_pieces_arr.push(exp_body[0] + ' ' + exp_body[1] + ' ' + exp_body[2] + ' ' + exp_body[3] + ' ' + exp_body[4] + '...');
                mail_datetime_arr.push(email_saved.indent_query[k].datetime);

                counter++;
              }

              for(l=0; l<email_saved.inquiry_query.length; l++) {
                var body = $(email_saved.sample_draft_query[l].body).text();
                var exp_body = body.split(" ");

                if(email_saved.inquiry_query[l].mail_no == ''){
                  var sType = 'iq';
                  var lType = 'inquiry';
                }

                mail_id_arr.push(email_saved.inquiry_query[l].id);
                mail_sType_arr.push(sType);
                mail_lType_arr.push(lType);
                mail_no_arr.push(email_saved.inquiry_query[l].mail_no);
                mail_too_arr.push(email_saved.inquiry_query[l].too);
                mail_subject_arr.push(email_saved.inquiry_query[l].subject);
                mail_pieces_arr.push(exp_body[0] + ' ' + exp_body[1] + ' ' + exp_body[2] + ' ' + exp_body[3] + ' ' + exp_body[4] + '...');
                mail_datetime_arr.push(email_saved.inquiry_query[l].datetime);

                counter++;
              }

              $('#records2').empty();
              var trHTML = '';

              for(m=0; m<counter; m++){
                trHTML += '<tr>';
                trHTML += '<td style="width: 5%"><input name="selected_id1[]" value="' + mail_sType_arr[m] + mail_id_arr[m] + '" type="checkbox"></td>';
                trHTML += '<td width="10%"><b>[</b>' + mail_no_arr[m] + '<b>]</b></td>';
                trHTML += '<td width="20%" class="mailbox-name"><a target="_blank" id="email" href="email/read_email/' + mail_lType_arr[m] + '/' + mail_id_arr[m] + '">' + mail_too_arr[m] + '</a></td>';
                trHTML += '<td width="55%" class="mailbox-subject"><b>' + mail_subject_arr[m] + '</b> - ' + mail_pieces_arr[m] + '...</td>';
                trHTML += '<td width="10%" class="mailbox-date">' + mail_datetime_arr[m] + '</td>';
                trHTML += '</tr>';
              }

              $('#records2').append(trHTML);
            }
          });
      }
    });
  });

  var got_id;
  function get_id(ele){
    got_id = ele;
  }

  $('.status').click(function(){
    var this_element = $(this);
    setTimeout(function() {
      var id = $('#mail_stat_id' + got_id).val();
      var value = this_element.find('.status_radio:checked').val();
      var name = this_element.find('.status_radio:checked').attr('name');

      $.ajax({
        url : "<?php echo base_url('Email/status/')?>"+id,
        type: "POST",
        data: "value="+value + "&name="+name,
        success: function(data)
        {
          // location.reload();
        }
      });
    }, 50);
  });
  
  var counter = '<?php echo $key ?>';

  $(document).ready(function(){
    for(var i=0; i<=counter; i++){
      for(var j=1; j<=5; j++){
        var body_content = $('#remarks_content' + i + j).html();
        $('#remarks_label' + i + j).popover({
          content: body_content, 
          html: true
        });
      }
    }
  });

  function close_remark(row, col){
    $(document).on("click", "#close" + row + col, function () {
      $('#remarks_label' + row + col).trigger('click');
    });

    $(function () {
      $('#remarks_label' + row + col).popover();
    });
  }

  function add_remarks(id, row, col){
    var remarks = $('#remarks' + row + col).val();

    $.ajax({
      url : "<?php echo base_url('Email/remarks/')?>"+col,
      type: "POST",
      data: "id="+id + "&remarks="+remarks,
      success: function(data)
      {
        location.reload();
      }
    });
  }

  function list(ele, ele2){
    $.ajax({
      url: "<?php echo base_url('email/emails_view') ?>/"+ele+'/'+ele2,
      type: "GET",
      dataType: "JSON",
      success: function (response) {
        $('#records').empty();

        var trHTML = '';
        $.each(response.data, function (i, item) {
          var mail_body = item.body;
          var stripped_body = mail_body.replace(/(<([^>]+)>)/ig,"");
          var pieces = stripped_body.split(" ").slice(0,4).join(" ");
            
          trHTML += '<tr>';
          trHTML += '<td width="5%"><input name="selected_id2[]" value="' + item.id + '" type="checkbox"><input type="hidden" name="type2" value="' + ele + '"></td>';
          trHTML += '<td width="10%"><b>[</b>' + item.mail_no + '<b>]</b></td>';
          trHTML += '<td width="20%" class="mailbox-name"><a target="_blank" id="email" href="email/read_email/' + ele + '/' + item.id + '">' + item.too + '</a></td>';
          trHTML += '<td width="55%" class="mailbox-subject"><b>' + item.subject + '</b> - ' + pieces + '...</td>'; 
          trHTML += '<td width="10%" class="mailbox-date">' + item.datetime + '</td>';
          trHTML += '</tr>';
        });

        $('#records').append(trHTML);
      }
    });

    $('#modal_form').modal('show');

    if(ele == 'sample_draft'){
      $('.modal-title').text('Forwarding / O.C List');
    }
    else if(ele == 'quotation'){
      $('.modal-title').text('Price Quotation List');
    }
    else if(ele == 'indent'){
      $('.modal-title').text('Proforma Invoice / Indent List');
    }
    else if(ele == 'inquiry'){
      $('.modal-title').text('Inquiry List');
    }
  }

  $(document).ready(function(){
    var email_encription_empty = "Please Enter Email Encription.";
    var smtp_host_empty = "Please Enter SMTP Host.";
    var email_empty = "Please Enter Email.";
    var email_invalid = "Please Enter Valid Email";
    var smtp_port_empty = "Please Enter SMTP Port.";
    var smtp_port_invalid = "Please Enter Valid SMTP Port";
    var from_address_empty = "Please Enter From address.";
    var from_name_empty = "Please Enter From Name.";
    var smtp_username_empty = "Please SMTP Username.";
    var smtp_password_empty = "Please SMTP Password.";
    $("#submit").click(function(event){
      var name_regex = /^[-a-zA-Z\s]+$/;
      var email_regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      var smtp_port_regex = /^[0-9]+$/; 
      var email_encription = $('#email_encription').val().trim();
      var smtp_host = $('#smtp_host').val().trim();
      var smtp_port = $('#smtp_port').val().trim();
      var email = $('#smtp_email').val().trim();
      var from_address = $('#from_address').val().trim();
      var from_name = $('#from_name').val().trim();
      var smtp_username = $('#smtp_username').val().trim();
      var smtp_password = $('#smtp_password').val();

      if(email_encription==null || email_encription==""){
        $("#err_email_encription").text(email_encription_empty);
        return false;
      }
      else{
        $("#err_email_encription").text("");
      }
      
      if(smtp_host==null || smtp_host==""){
        $("#err_smtp_host").text(smtp_host_empty);
        return false;
      }
      else{
        $("#err_smtp_host").text("");
      }

      var smtp_port = $('#smtp_port').val();
      if(smtp_port==null || smtp_port==""){
        $("#err_smtp_port").text(smtp_port_empty);
        return false;
      }
      else{
        $("#err_smtp_port").text("");
      }
      if (!smtp_port.match(smtp_port_regex) ) {
        $('#err_smtp_port').text(smtp_port_invalid);   
        return false;
      }
      else{
        $("#err_smtp_port").text("");
      }

      if(email==null || email==""){
        $("#err_smtp_email").text(email_empty);
        return false;
      }
      else{
        $("#err_smtp_email").text("");
      }
      if (!email.match(email_regex) ) {
        $('#err_smtp_email').text(email_invalid);   
        return false;
      }
      else{
        $("#err_smtp_email").text("");
      }
      
      if(from_address==null || from_address==""){
        $("#err_from_address").text(from_address_empty);
        return false;
      }
      else{
        $("#err_from_address").text("");
      }

      if(from_name == "" || from_name == null){
        $('#err_from_name').text(from_name_empty);
        return false;
      }
      else{
        $('#err_from_name').text("");
      }

      if(smtp_username == "" || smtp_username == null){
        $('#err_smtp_username').text(smtp_username_empty);
        return false;
      }
      else{
        $('#err_smtp_username').text("");
      }

      if(smtp_password == "" || smtp_password == null){
        $('#err_smtp_password').text(smtp_password_empty);
        return false;
      }
      else{
        $('#err_smtp_password').text("");
      }
    });

    $("#email_encription").on("blur keyup",  function (event){
      var email_encription = $('#email_encription').val();
      if(email_encription==null || email_encription==""){
        $("#err_email_encription").text(email_encription_empty);
        return false;
      }
      else{
        $("#err_email_encription").text("");
      }
    });
    $("#smtp_host").on("blur keyup",  function (event){
      var name_smtp_hostregex = /^[-a-zA-Z\s]+$/;
      var smtp_host = $('#smtp_host').val();
      if(smtp_host==null || smtp_host==""){
        $("#err_smtp_host").text(smtp_host_empty);
        return false;
      }
      else{
        $("#err_smtp_host").text("");
      }
    });
    $("#smtp_email").on("blur keyup",  function (event){
      var email_regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      var email = $('#smtp_email').val();
      if(email==null || email==""){
        $("#err_smtp_email").text(email_empty);
        return false;
      }
      else{
        $("#err_smtp_email").text("");
      }
      if (!email.match(email_regex) ) {
        $('#err_smtp_email').text(email_invalid);   
        return false;
      }
      else{
        $("#err_smtp_email").text("");
      }
    });
    $("#smtp_port").on("blur keyup",  function (event){
      var smtp_port_regex = /^[0-9]+$/; 
      var smtp_port = $('#smtp_port').val();
      if(smtp_port==null || smtp_port==""){
        $("#err_smtp_port").text(smtp_port_empty);
        return false;
      }
      else{
        $("#err_smtp_port").text("");
      }
      if (!smtp_port.match(smtp_port_regex) ) {
        $('#err_smtp_port').text(smtp_port_invalid);   
        return false;
      }
      else{
        $("#err_smtp_port").text("");
      }
    });
    $("#from_address").on("blur keyup",  function (event){
      var name_regex = /^[-a-zA-Z\s]+$/;
      var from_address = $('#from_address').val();
      if(from_address==null || from_address==""){
        $("#err_from_address").text(from_address_empty);
        return false;
      }
      else{
        $("#err_from_address").text("");
      }
    });
    $("#from_name").change(function(){
      var from_name = $('#from_name').val();
      if(from_name == "" || from_name == null){
        $('#err_from_name').text(from_name_empty);
        return false;
      }
      else{
        $('#err_from_name').text("");
      }
    });
    $("#smtp_username").change(function(){
      var smtp_username = $('#smtp_username').val();
      if(smtp_username == "" || smtp_username == null){
        $('#err_smtp_username').text(smtp_username_empty);
        return false;
      }
      else{
        $('#err_smtp_username').text("");
      }
    });
    $('#smtp_password').change(function(){
      var smtp_password = $('#smtp_password').val();
      if(smtp_password == "" || smtp_password == null){
        $('#err_smtp_password').text(smtp_password_empty);
        return false;
      }
      else{
        $('#err_smtp_password').text("");
      }
    });
}); 
</script>

<script>
  $(function () {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });
  });

  function deleteConfirm(){
    var result = confirm("Do you really want to delete selected records?");
    if(result){
        return true;
    }else{
        return false;
    }
  }
</script>