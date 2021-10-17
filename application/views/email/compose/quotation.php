<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','manager');
if(!(in_array($this->session->userdata('type'),$p))){
  redirect('auth');
}
  $this->load->view('layout/header');
?>

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
          <li class="active">Quotation</li>
        </ol>
      </h5>    
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- <?php
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
      ?> -->
      <div class="row">
        <!-- <form role="form" id="form" method="post" action="<?php echo base_url('email/send_email');?>" encType="multipart/form-data"> -->
        <form role="form" id="form" method="post" target="preview_email" action="<?php echo base_url('email/preview_email/') ?>" onsubmit="window.open('about:blank', 'preview_email', 'width=1200, height=800');">
          <div class="col-md-2">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Work Templates</h3>
              </div>
              <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                  <li><a href="<?php if($ref_no){ echo '../'; } ?>raw"><i class="fa fa-inbox"></i> New Email</a></li>
                  
                  <li style="width: 70%; float: left;"><a href="<?php if($ref_no){ echo '../'; } ?>inquiry_mail"><i class="fa fa-envelope-o"></i> Inquiry Mail</a></li>
                  <li style="width: 30%; float: right;"><a title="Inquiry Mail History" class="text-center" href="<?php echo base_url('email/email_history/inquiry_query');?>"><i class="fa fa-history"></i></a></li>

                  <li style="width: 70%; float: left;"><a href="<?php if($ref_no){ echo '../'; } ?>quotation"><i class="fa fa-file-text-o"></i> Quotation</a></li>
                  <li style="width: 30%; float: right;"><a title="Quotation History" class="text-center" href="<?php echo base_url('email/email_history/quotation_query');?>"><i class="fa fa-history"></i></a></li>

                  <li style="width: 70%; float: left;"><a href="<?php if($ref_no){ echo '../'; } ?>proforma_invoice"><i class="fa fa-filter"></i> Proforma Invoice / Indent</a></li>
                  <li style="width: 30%; float: right;"><a style="padding: 20px 15px" title="Indent History" class="text-center" href="<?php echo base_url('email/email_history/indent_query');?>"><i class="fa fa-history"></i></a></li>

                  <li style="width: 70%; float: left;"><a href="<?php if($ref_no){ echo '../'; } ?>sample_draft"><i class="fa fa-check-square"></i> Forwarding / O.C</a></li>
                  <li style="width: 30%; float: right;"><a title="Forwarding / O.C History" class="text-center" href="<?php echo base_url('email/email_history/sample_draft_query');?>"><i class="fa fa-history"></i></a></li>
                </ul>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /. box -->

            <a href="<?php echo base_url('Email');?>" class="btn bg-gray btn-block margin-bottom">Work Status</a>
            <a onclick="view_bill_challan()" href="javascript:void(0);" class="btn bg-gray btn-block margin-bottom">Bills & Challans</a>
            
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Custom Attributes</h3>
              </div>
              <div class="form-group box-body">
                <label for="date">Date </label>
                
                <input type="text" class="form-control datepicker" id="date" name="date" placeholder="Insert Date" autocomplete="off">
              </div>

              <div class="form-group box-body">
                <label for="product">Product </label>
                
                <select class="form-control select2" id="product" name="product" style="width: 100%;">
                  <option value="">Select Product</option>
                  <?php
                    foreach ($product as $key) { ?>
                      <option value="<?php echo $key->name ?>"><?php echo $key->name; ?></option>
                  <?php  
                    }
                  ?>
                </select>
              </div>
              
              <div class="form-group box-body">
                <label for="client">Client </label>
                
                <select class="form-control select2" id="client" name="client" style="width: 100%;">
                  <option value="">Select Client</option>
                  <?php
                    foreach ($client as $key) { ?>
                      <option value="<?php echo $key->client_id . '|' . $key->company_name . '|' . $key->contact_person . '|' . $key->email . '|' . $key->cc . '|' . $key->bcc . '|' . $key->house_no . '|' .  $key->road_no . '|' .  $key->state_id . '|' .  $key->city_id . '|' .  $key->country_id . '|' .  $key->zip_code; ?>"><?php echo $key->company_name; ?></option>
                  <?php  
                    }
                  ?>
                </select>
              </div>

              <div class="form-group box-body">
                <label for="shipping_mode">Shipping Mode </label>
                
                <select class="form-control select2" id="shipping_mode" name="shipping_mode" style="width: 100%;">
                  <option value="">Select Shipping Mode</option>
                  <?php
                    foreach ($shipping as $key) { ?>
                      <option value="<?php echo $key->shipping_mode_ec_name ?>"><?php echo $key->shipping_mode_ec_name; ?></option>
                  <?php  
                    }
                  ?>
                </select>
              </div>

              <div class="form-group box-body">
                <label for="payment_mode">Payment Mode </label>
                
                <select class="form-control select2" id="payment_mode" name="payment_mode" style="width: 100%;">
                  <option value="">Select Payment Mode</option>
                  <?php
                    foreach ($payment_mode as $key) { ?>
                      <option value="<?php echo $key->payment_ec_name ?>"><?php echo $key->payment_ec_name; ?></option>
                  <?php  
                    }
                  ?>
                </select>
              </div>

              <div class="form-group box-body">
                <div class="row">
                  <div class="col-sm-6">
                    <label for="currency">Currency </label>
                
                    <select class="form-control select2" id="currency" name="currency" style="width: 100%;">
                      <option value="">Select Currency</option>
                      <?php
                        foreach ($currency as $key) { ?>
                          <option value="<?php echo $key->name ?>"><?php echo $key->name; ?></option>
                      <?php  
                        }
                      ?>
                    </select>
                  </div>
                  <div class="col-sm-6">
                    <label for="unit">Unit </label>
                
                    <select class="form-control select2" id="unit" name="unit" style="width: 100%;">
                      <option value="">Select Unit</option>
                      <?php
                        foreach ($unit as $key) { ?>
                          <option value="<?php echo $key->unit_symbol ?>"><?php echo $key->unit_symbol; ?></option>
                      <?php  
                        }
                      ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group box-body">
                <label for="client2">Manufacturer &amp; Supplier </label>
                
                <select class="form-control select2" id="client2" name="client2" style="width: 100%;">
                  <option value="">Select Manufacturer &amp; Supplier</option>
                  <?php
                    foreach ($client2 as $key) { ?>
                      <option value="<?php echo $key->client_id . '|' . $key->company_name . '|' . $key->house_no . '|' .  $key->road_no . '|' .  $key->state_id . '|' .  $key->city_id . '|' .  $key->country_id . '|' .  $key->zip_code; ?>"><?php echo $key->company_name; ?></option>
                  <?php  
                    }
                  ?>
                </select>
              </div>
            </div>

            <div class="form-group">
              <div class="callout bg-gray-light">
                <h4>Custom Attributes</h4>

                <p>Choose optional custom attribute(s) to replace information with [...] into the Email body.</p>
              </div>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-md-7">
            <div class="box box-default">
              <div class="box-header with-border">
                <div class="col-sm-9" style="padding-left: 0;">
                  <h3 class="box-title">Work Details</h3>
                </div>

                <?php
                  if($quotation_no == null){
                    $qt_no = sprintf('%06d', intval(101));
                  } else{
                    foreach($quotation_no as $value){
                      $qt_no = sprintf('%06d', intval($value->id)+101);
                    }
                  }
                ?>

                <div class="col-sm-3" style="padding-right: 0;">
                  <label>Ref no.</label>
                  <input style="text-align: center;" class="form-control" name="ref_no" id="ref_no" value="<?= 'WREF:QTN' . $qt_no . '-' . date('m') . date('y'); ?>" readonly>
                </div>

                <input type="hidden" name="mail_type" id="mail_type" value="quotation">
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                  <label for="from">From</label>

                  <input class="form-control" name="from" id="from" placeholder="From:">
                </div>
                <div class="form-group">
                  <label for="to">To</label>

                  <input class="form-control" name="to" id="to" placeholder="To:">
                </div>
                <div class="form-group">
                  <label for="cc">Cc </label>

                  <input class="form-control" name="cc" id="cc" placeholder="Cc:" data-toggle="tooltip" title="For multiple Cc, separate them by comma (,)">
                </div>
                <div class="form-group">
                  <label for="bcc">Bcc </label>

                  <input class="form-control" name="bcc" id="bcc" placeholder="Bcc:" data-toggle="tooltip" title="For multiple Bcc, separate them by comma (,)">
                </div>
                <div class="form-group">
                  <label for="subject">Subject </label>

                  <input class="form-control" name="subject" id="subject" placeholder="Subject:">
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="mail_body" id="mail_body">
                    <div class="fr-view">
                      <p><strong><?php echo 'Ref no.: &nbsp;&nbsp;'; echo 'WREF:QTN' . $qt_no . '-' . date('m') . date('y'); ?></strong></p>

                      <p><span id="span_date">[DATE]</span></p>
                      <p>
                        To,
                        <br><span id="span_contact_person">[CONTACT PERSON]</span>
                        <br><span id="span_client">[CLIENT NAME]</span>
                        <br><span id="span_address">[CLIENT ADDRESS]</span>
                      </p>
                      <p><strong>K/A: </strong><span id="span_ka">[KIND ATTENTION NAME(S) AND DESIGNATION(S)]</span></p>
                      <br>
                      <p><strong><u>Sub: Quotation for <span id="span_product">[PRODUCT NAME]</span></u></strong></p><br>
                      Dear Sir, We are pleased to quote our best price for the following item:
                      <table style="width: 100%; border: 1px solid black; border-collapse: collapse;">
                        <tbody>
                          <tr>
                            <td style="width: 49.9567%; border: 1px solid black; border-collapse: collapse;">&nbsp;<strong>Item</strong></td>
                            <td style="width: 49.9567%; border: 1px solid black; border-collapse: collapse;">&nbsp;<span id="span_item">[PRODUCT NAME]</span></td>
                          </tr>
                          <tr>
                            <td style="border: 1px solid black; border-collapse: collapse;">&nbsp;Quantity</td>
                            <td style="border: 1px solid black; border-collapse: collapse;">&nbsp;
                              <br>
                            </td>
                          </tr>
                          <tr>
                            <td style="border: 1px solid black; border-collapse: collapse;">&nbsp;Price</td>
                            <td style="border: 1px solid black; border-collapse: collapse;">&nbsp;<span id="span_currency">[CURRENCY]</span> /<span id="span_unit">[UNIT]</span> <span id="span_shipping_mode">[SHIPPING MODE]</span></td>
                          </tr>
                          <tr>
                            <td style="border: 1px solid black; border-collapse: collapse;">&nbsp;Payment</td>
                            <td style="border: 1px solid black; border-collapse: collapse;">&nbsp;<span id="span_payment_mode">[PAYMENT MODE]</span></td>
                          </tr>
                          <tr>
                            <td style="border: 1px solid black; border-collapse: collapse;">&nbsp;Delivery</td>
                            <td style="border: 1px solid black; border-collapse: collapse;">&nbsp;
                              <br>
                            </td>
                          </tr>
                          <tr>
                            <td style="width: 50.0000%; border: 1px solid black; border-collapse: collapse;">&nbsp;Price Validity</td>
                            <td style="width: 50.0000%; border: 1px solid black; border-collapse: collapse;">&nbsp;
                              <br>
                            </td>
                          </tr>
                        </tbody>
                      </table><br>
                      <p><strong>Manufacturer &amp; Supplier:</strong> <span id="span_client2">[MANUFACTURER &amp; SUPPLIER NAME WITH ADDRESS]</span></p><br>
                      <p>We hope you will find our offer competitive and will favor us with your valued order. Yours faithfully, On behalf of Winmark BD. Ltd.</p>
                      <p>With best regards,</p>
                      <p>
                        <?php echo '<strong>' . $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . '</strong>'; ?><br>
                        <?php echo $this->session->userdata('join_desg'); ?><br>
                        Cell: <?php echo $this->session->userdata('phone'); ?>
                        <?php if($this->session->userdata('email') == 'WEMP-000101') echo '| Skype: anik.arafin | QQ: 2037024365'; ?>
                      </p>
                    </div>
                  </textarea>
                </div>
                
                <!-- <div class="form-group">
                  <div class="btn btn-default btn-file">
                    <i class="fa fa-paperclip"></i> Attachment
                    <input type="file" name="attachment" id="attachment">
                  </div>
                  <p class="help-block">Max. 2MB</p>
                </div> -->
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="pull-right">
                  <input type="hidden" name="type" id="type">

                  <button type="submit" id="draft" class="btn bg-gray"><i class="fa fa-clipboard"></i>&nbsp;&nbsp;Preview</button>
                  <button class="btn bg-gray" type="button" onclick="printContent();"><i class="fa fa-print"></i>&nbsp;&nbsp;Print</button>
                </div>
                <p><strong>*** Note: In case you want to add information instead choosing custom attribute(s) from left panel, remove [...] parts (e.g. [CLIENT NAME]).</strong></p>
              </div>
              <!-- /.box-footer -->
            </div>
            <!-- /. box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3">
            <div class="callout bg-gray-light">
              <div class="box-body">
                <h4 class="box-title" style="color: #000;">All Status</h4>
                <hr>
                <?php 
                  if($ref_no == 'quotation' || $ref_no == ''){
                ?>
                    <h4 class="box-title" style="color: #888;">Forwarding / O.C <small class="pull-right"><p style="color: #888;">Status: <?php ?><span class="label label-danger">NO</span></p></small></h4>
                    <hr>

                    <h4 style="color: #888;">Test Report <small class="pull-right"><p style="color: #888;">Status: <span class="label label-danger">NO</span></p></small></h4>
                    <hr>

                    <h4 style="color: #888;">Inquiry <small class="pull-right"><p style="color: #888;">Status: <span class="label label-danger">NO</span></p></small></h4>
                    <hr>

                    <h4 style="color: #888;">Price Quotation <small class="pull-right"><p style="color: #888;">Status: <span class="label label-danger">NO</span></p></small></h4>
                    <hr>

                    <h4 style="color: #888;">Customer Feedback <small class="pull-right"><p style="color: #888;">Status: <span class="label label-danger">NO</span></p></small></h4>
                    <hr>

                    <h4 style="color: #888;">Proforma Invoice / Indent <small class="pull-right"><p style="color: #888;">Status: <span class="label label-danger">NO</span></p></small></h4>
                    <hr>

                    <h4 style="color: #888;">LC / TT <small class="pull-right"><p style="color: #888;">Status: <span class="label label-danger">NO</span></p></small></h4>
                    <hr>

                    <h4 style="color: #888;">Shipping <small class="pull-right"><p style="color: #888;">Status: <span class="label label-danger">NO</span></p></small></h4>
                    <hr>

                    <h4 style="color: #888;">Payment <small class="pull-right"><p style="color: #888;">Status: <span class="label label-danger">NO</span></p></small></h4>
                <?php
                  } else {
                      foreach ($email_status as $row){
                        if($row->ref_no == $ref_no){
                ?>
                          <h4 class="box-title" style="color: #888;">Forwarding / O.C <small class="pull-right"><p style="color: #888;">Status: <?php if($row->sample_draft_status == 'YES'){ ?><span class="label label-success">YES</span><?php } else{ ?><span class="label label-danger">NO</span><?php }?></p></small></h4>
                          <hr>

                          <h4 style="color: #888;">Test Report <small class="pull-right"><p style="color: #888;">Status: <?php if($row->test_report_status == 'YES'){ ?><span class="label label-success">YES</span><?php } else{ ?><span class="label label-danger">NO</span><?php }?></p></small></h4>
                          <hr>

                          <h4 style="color: #888;">Inquiry <small class="pull-right"><p style="color: #888;">Status: <?php if($row->inquiry_status == 'YES'){ ?><span class="label label-success">YES</span><?php } else{ ?><span class="label label-danger">NO</span><?php }?></p></small></h4>
                          <hr>

                          <h4 style="color: #888;">Price Quotation <small class="pull-right"><p style="color: #888;">Status: <?php if($row->price_quotation_status == 'YES'){ ?><span class="label label-success">YES</span><?php } else{ ?><span class="label label-danger">NO</span><?php }?></p></small></h4>
                          <hr>

                          <h4 style="color: #888;">Customer Feedback <small class="pull-right"><p style="color: #888;">Status: <?php if($row->customer_feedback_status == 'YES'){ ?><span class="label label-success">YES</span><?php } else{ ?><span class="label label-danger">NO</span><?php }?></p></small></h4>
                          <hr>

                          <h4 style="color: #888;">Proforma Invoice / Indent <small class="pull-right"><p style="color: #888;">Status: <?php if($row->indent_status == 'YES'){ ?><span class="label label-success">YES</span><?php } else{ ?><span class="label label-danger">NO</span><?php }?></p></small></h4>
                          <hr>

                          <h4 style="color: #888;">LC / TT <small class="pull-right"><p style="color: #888;">Status: <?php if($row->lc_status == 'YES'){ ?><span class="label label-success">YES</span><?php } else{ ?><span class="label label-danger">NO</span><?php }?></p></small></h4>
                          <hr>

                          <h4 style="color: #888;">Shipping <small class="pull-right"><p style="color: #888;">Status: <?php if($row->shipping_status == 'YES'){ ?><span class="label label-success">YES</span><?php } else{ ?><span class="label label-danger">NO</span><?php }?></p></small></h4>
                          <hr>

                          <h4 style="color: #888;">Payment <small class="pull-right"><p style="color: #888;">Status: <?php if($row->payment_status == 'YES'){ ?><span class="label label-success">YES</span><?php } else{ ?><span class="label label-danger">NO</span><?php }?></p></small></h4>
                <?php 
                        }
                      }
                  }
                ?>
              </div>
            </div>
          </div>
          <!-- /.col -->

          <input type="hidden" name="customer_id" id="customer_id">
          <input type="hidden" name="customer_name" id="customer_name">
        </form>

        <form style="display: none;" id="print_form" action="<?php echo base_url('email/send_email/') ?>" method="post">
          <input type="hidden" name="type" id="pr_type">
          <input type="hidden" name="ref_no" id="pr_ref_no">
          <input type="hidden" name="mail_no" id="pr_mail_no">
          <input type="hidden" name="mail_type" id="pr_mail_type">
          <input type="hidden" name="from" id="pr_from">
          <input type="hidden" name="to" id="pr_to">
          <input type="hidden" name="cc" id="pr_cc">
          <input type="hidden" name="bcc" id="pr_bcc">
          <input type="hidden" name="subject" id="pr_subject">

          <input type="hidden" name="mail_body" id="pr_body">

          <input type="hidden" name="customer_id" id="pr_customer_id">
          <input type="hidden" name="customer_name" id="pr_customer_name">

          <input type="hidden" name="process" value="print">
        </form>

        <div class="col-md-3">
          <form role="form" id="form2" method="post" target="print_popup" action="<?php echo base_url('email/view_pdf/') ?>" onsubmit="window.open('about:blank', 'print_popup', 'width=1200, height=800');">
            <input type="hidden" name="email_pdf" id="email_pdf">
            <input type="hidden" name="file_name" id="file_name">

            <button style="width: 100%" class="btn bg-gray" type="button" onclick="view_pdf('pdf');"><strong><i class="fa fa-file-pdf-o"></i>&nbsp;&nbsp;Export Email Content As PDF</strong></button>
          </form>
        </div>
      </div>
      <!-- /.row -->

      <!-- modal -->
      <div class="modal fade" id="modal_form" role="dialog">
        <div class="modal-dialog" style="width: 80%">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h3 class="modal-title">Bills & Challans</h3>
            </div>
            <div class="modal-body">
              <table id="index" class="table table-bordered table-striped product_table1">
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
                <tbody id="records">
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

<!-- Froala Editor -->
<script src="<?php echo base_url();?>assets/plugins/froala/js/froala_editor.pkgd.min.js"></script>

<script>
  $(function(){ 
    $('textarea').froalaEditor({
      height: 650
    }) 
  });

  /*$(function(){ 
    $('div.fr-view').froalaEditor({
      height: 750
    });
  });*/

  function view_bill_challan(){
    $.ajax({
      url: "<?php echo base_url('email/get_bill_challan') ?>/",
      type: "POST",
      dataType: "JSON",
      success: function (response) {
        var table = $('#index').DataTable();
        table.destroy();
        $('#records').empty();

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
      }
    });

    $('#modal_form').modal('show');
  }

  function view_pdf(type){
    if(!$('#customer_id').val()){
      alert('Please choose a client!');

      return false;
    }
    else{
      $('#pr_type').val('save');
      $('#pr_ref_no').val($('#ref_no').val());
      $('#pr_mail_no').val('');
      $('#pr_mail_type').val($('#mail_type').val());
      $('#pr_from').val($('#from').val());
      $('#pr_to').val($('#to').val());
      $('#pr_cc').val($('#cc').val());
      $('#pr_bcc').val($('#bcc').val());
      $('#pr_subject').val($('#subject').val());
      $('#pr_body').val($('textarea').froalaEditor('html.get'));

      $('#pr_contact_person').val($('#contact_person').val());
      $('#pr_customer_id').val($('#customer_id').val());
      $('#pr_customer_name').val($('#customer_name').val());
      $('#pr_indent_no').val($('#indent_no').val());
      $('#pr_manufacturer_id').val($('#manufacturer_id').val());
      $('#pr_manufacturer_name').val($('#manufacturer_name').val());
      $('#pr_grand_total').val($('#grand_total').val());
      $('#pr_product_data').val($('#product_data').val());

      var frm = $('#print_form');

      $.ajax({
          type: frm.attr('method'),
          url: frm.attr('action'),
          data: frm.serialize(),
          success: function (data) {
              console.log(data);
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
          }
      });

      var email_body = $('textarea').froalaEditor('html.get');
      var ref_no = $('#ref_no').val();

      $('#email_pdf').val(email_body);
      $('#file_name').val(ref_no);
      
      $("#form2").submit();

      window.location.reload(true);
    }
  }

  function preview_email(){
    var type = $('#type').val('send');
    $("#form").submit();
  }

  $(document).ready(function(){
    $('#client').change(function(){
      var client = $('#client').val();
      var client = client.split('|');
      var client_id = client[0];
      var name = client[1];
      var contact_person = client[2];
      var email = client[3];
      var cc = client[4];
      var bcc = client[5];
      var house = client[6] + ', ';
      var road = client[7] + ',<br>';
      var state = client[8];
      var city = client[9];
      var zip_code = '-' + client[11] + ', ';
      var country = client[10];

      $('#to').val(email);
      $('#cc').val(cc);
      $('#bcc').val(bcc);
      $('#span_contact_person').text(contact_person);
      $('#span_client').text(name);
      $("#span_client").css("font-weight", "bold");

      $('#customer_id').val(client_id);
      $('#customer_name').val(name);

      $.ajax({
          url: "<?php echo base_url('email/get_state') ?>/"+state,
          type: "GET",
          dataType: "JSON",
          async: false,
          success: function(data){
            state = data[0].name + ', ';
          }
      });

      $.ajax({
          url: "<?php echo base_url('email/get_city') ?>/"+city,
          type: "GET",
          dataType: "JSON",
          async: false,
          success: function(data){
            if(zip_code == '-, '){
              city = data[0].name + ', ';
            }
            else{
              city = data[0].name;
            }
          }
      });

      $.ajax({
          url: "<?php echo base_url('email/get_country') ?>/"+country,
          type: "GET",
          dataType: "JSON",
          async: false,
          success: function(data){
            country = data[0].name;
          }
      });

      if(house == ', ') house = '';
      if(road == ',<br>') road = '<br>';
      if(zip_code == '-, ') zip_code = '';

      $('#span_address').html(house + road + state + city + zip_code + country);

      var name;
      var designation;
      var kind_attention="";

      $.ajax({
          url: "<?php echo base_url('email/get_kind_attention') ?>/"+client_id,
          type: "GET",
          dataType: "JSON",
          async: false,
          success: function(data){
            for(i=0; i<data['name'].length; i++){
              name = data['name'][i];
              designation = data['designation'][i];
              if(!name && !designation){
                kind_attention += '';
              }
              else{
                kind_attention += name + ', ' + designation + '<br>';
              }
            }
          }
      });

      $('#span_ka').html(kind_attention);
    });

    $('#product').change(function(){
      var item = $(this).val();

      $('#span_product').text(item);
      $('#span_item').text(item);
      $("#span_item").css("font-weight", "bold");
    });

    $('#shipping_mode').change(function(){
      $('#span_shipping_mode').text($(this).val());
    });

    $('#payment_mode').change(function(){
      $('#span_payment_mode').text($(this).val());
    });

    $('#currency').change(function(){
      $('#span_currency').text($(this).val());
    });

    $('#unit').change(function(){
      $('#span_unit').text($(this).val());
    });

    $('#client2').change(function(){
      var client = $('#client2').val();
      var client = client.split('|');
      var client_id = client[0];
      var name = client[1] + ', ';
      var house = client[2] + ', ';
      var road = client[3] + ', ';
      var state = client[4];
      var city = client[5];
      var zip_code = '-' + client[7] + ', ';
      var country = client[6];

      $.ajax({
          url: "<?php echo base_url('email/get_state') ?>/"+state,
          type: "GET",
          dataType: "JSON",
          async: false,
          success: function(data){
            state = data[0].name + ', ';
          }
      });

      $.ajax({
          url: "<?php echo base_url('email/get_city') ?>/"+city,
          type: "GET",
          dataType: "JSON",
          async: false,
          success: function(data){
            if(zip_code == '-, '){
              city = data[0].name + ', ';
            }
            else{
              city = data[0].name;
            }
          }
      });

      $.ajax({
          url: "<?php echo base_url('email/get_country') ?>/"+country,
          type: "GET",
          dataType: "JSON",
          async: false,
          success: function(data){
            country = data[0].name;
          }
      });

      if(house == ', ') house = '';
      if(road == ', ') road = '';
      if(zip_code == '-, ') zip_code = '';

      $('#span_client2').html(name + house + road + state + city + zip_code + country);
      $("#span_client2").css("font-weight", "bold");
    });

    $('#date').change(function(){
      $('#span_date').text($('#date').val());
      $("#span_date").css("font-weight", "bold");
    });

    $('.datepicker').datepicker({
      autoclose: true,
      format: "MM dd, yyyy",
      todayHighlight: true,
      orientation: "auto",
      todayBtn: true,
      todayHighlight: true,  
    });
  });

  $(document).ready(function(){
    $("#submit").click(function(event){
      var type = $('#type').val('send');
    });

    $("#draft").click(function(event){
      var type = $('#type').val('save');

      if(!$('#customer_id').val()){
        alert('Please choose a client!');

        return false;
      }
    });
  }); 

  function printContent(){
    if(!$('#customer_id').val()){
      alert('Please choose a client!');

      return false;
    }
    else{
      $('#pr_type').val('save');
      $('#pr_ref_no').val($('#ref_no').val());
      $('#pr_mail_no').val('');
      $('#pr_mail_type').val($('#mail_type').val());
      $('#pr_from').val($('#from').val());
      $('#pr_to').val($('#to').val());
      $('#pr_cc').val($('#cc').val());
      $('#pr_bcc').val($('#bcc').val());
      $('#pr_subject').val($('#subject').val());
      $('#pr_body').val($('textarea').froalaEditor('html.get'));

      $('#pr_customer_id').val($('#customer_id').val());
      $('#pr_customer_name').val($('#customer_name').val());

      var frm = $('#print_form');

      $.ajax({
          type: frm.attr('method'),
          url: frm.attr('action'),
          data: frm.serialize(),
          success: function (data) {
              console.log(data);
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
          }
      });

      //var restorepage = document.body.innerHTML;
      var printcontent = $('#pr_body').val();
      document.body.innerHTML = printcontent;
      window.print();
      //document.body.innerHTML = restorepage;
    }
  }
  
  window.onafterprint = function(){
    window.location.reload(true);
  }
</script>