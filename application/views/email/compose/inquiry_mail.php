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
          <li class="active">Inquiry Email</li>
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
                  <li><a href="<?php if(isset($client)){ echo '../../'; } else if($ref_no){ echo '../'; } ?>raw"><i class="fa fa-inbox"></i> New Email</a></li>

                  <li style="width: 70%; float: left;"><a href="<?php if(isset($client)){ echo '../../'; } else if($ref_no){ echo '../'; } ?>inquiry_mail"><i class="fa fa-envelope-o"></i> Inquiry Mail</a></li>
                  <li style="width: 30%; float: right;"><a title="Inquiry Mail History" class="text-center" href="<?php echo base_url('email/email_history/inquiry_query');?>"><i class="fa fa-history"></i></a></li>

                  <li style="width: 70%; float: left;"><a href="<?php if(isset($client)){ echo '../../'; } else if($ref_no){ echo '../'; } ?>quotation"><i class="fa fa-file-text-o"></i> Quotation</a></li>
                  <li style="width: 30%; float: right;"><a title="Quotation History" class="text-center" href="<?php echo base_url('email/email_history/quotation_query');?>"><i class="fa fa-history"></i></a></li>

                  <li style="width: 70%; float: left;"><a href="<?php if(isset($client)){ echo '../../'; } else if($ref_no){ echo '../'; } ?>proforma_invoice"><i class="fa fa-filter"></i> Proforma Invoice / Indent</a></li>
                  <li style="width: 30%; float: right;"><a style="padding: 20px 15px" title="Indent History" class="text-center" href="<?php echo base_url('email/email_history/indent_query');?>"><i class="fa fa-history"></i></a></li>

                  <li style="width: 70%; float: left;"><a href="<?php if(isset($client)){ echo '../../'; } else if($ref_no){ echo '../'; } ?>sample_draft"><i class="fa fa-check-square"></i> Forwarding / O.C</a></li>
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
              
              <!-- small box -->
              <div class="bg-gray" style="padding: 0; margin: 3%;"><br>
                <div class="box-body bg-gray-light" style="padding: 0; margin: 3%;">
                  <div class="form-group box-body">
                    <label for="product">Product </label>

                    <select class="form-control select2" id="product" name="product" style="width: 100%;">
                      <option value="">Select Product</option>
                      <?php
                        foreach ($product as $key) { ?>
                          <option <?php if(isset($client) && $key->product_id == $product_id){?> selected <?php }?> value="<?php echo $key->name; ?>"><?php echo $key->name; ?></option>
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

                  <div class="box-body">
                    <button title="Add" type="button" id="add" class="btn bg-gray pull-right"><i class="fa fa-arrow-right"></i></button>
                  </div>
                </div>

                <div class="form-group box-body">
                  <label for="client">Client </label>

                  <?php if(isset($client)){ ?>
                    <select class="form-control select2" id="client" name="client" style="width: 100%;">
                      <option value="">Select Client</option>
                      <?php 
                        $sql = "SELECT * FROM products WHERE product_id = '$product_id'";
                        $client_id = $this->db->query($sql,array($product_id))->row()->client_id;

                        $sql2 = $this->db->query("SELECT * FROM client WHERE client_type_id = 1 AND client_id IN ($client_id)");
                        $result = $sql2->result();
                      
                        foreach ($result as $list) { 
                      ?>
                          <option value="<?php echo $list->client_id . '|' . $list->company_name; ?>"><?php echo $list->company_name; ?></option>
                      <?php 
                        } 
                      ?>
                    </select>
                  <?php } else {?>
                    <select class="form-control select2" id="client" name="client" style="width: 100%;">
                      <option value="">Select Client</option>
                      <?php
                        foreach ($clients as $key) { ?>
                          <option value="<?php echo $key->client_id . '|' . $key->company_name; ?>"><?php echo $key->company_name; ?></option>
                      <?php  
                        }
                      ?>
                    </select>
                  <?php }?>
                </div>

                <div class="box-body">
                  <button title="Add" type="button" id="add2" class="btn bg-gray-light pull-right"><i class="fa fa-arrow-right"></i></button>
                </div>
              </div>

              <div class="form-group box-body">
                <label for="commission">Commission </label>
                
                <select class="form-control select2" id="commission" name="commission" style="width: 100%;">
                  <option value="">Select Commission</option>
                  <?php
                    foreach ($commission as $key) { ?>
                      <option value="<?php echo $key->commission_ec_name . '%' ?>"><?php echo $key->commission_ec_name . '%'; ?></option>
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
                  if($inquiry_no == null){
                    $iq_no = sprintf('%06d', intval(101));
                  } else{
                    foreach($inquiry_no as $value){
                      $iq_no = sprintf('%06d', intval($value->id)+101);
                    }
                  }
                ?>

                <div class="col-sm-3" style="padding-right: 0;">  
                  <label>Ref no.</label>
                  <input style="text-align: center;" class="form-control" name="ref_no" id="ref_no" value="<?= 'WREF:INQ' . $iq_no . '-' . date('m') . date('y'); ?>" readonly>
                </div>

                <input type="hidden" name="mail_type" id="mail_type" value="inquiry">
              </div>
              
              <!-- /.box-header -->
              <div class="box-body">
                <div class="form-group">
                  <label for="from">From</label>

                  <input class="form-control" name="from" id="from" placeholder="From:">
                </div>
                <div class="form-group">
                  <label for="to">To</label>

                  <?php 
                    if(isset($product_id)){
                      $sql = "SELECT client_id, client_email FROM products WHERE product_id = '$product_id'";
                      $client_id = $this->db->query($sql,array($product_id))->row()->client_id;
                      $client_idd = explode(',', $client_id);
                      $client_email = $this->db->query($sql,array($product_id))->row()->client_email;
                      $client_emaill = explode(',', $client_email);

                      foreach ($client_idd as $key => $value) {
                        if($value == $client[0]->client_id){
                          break;
                        }
                      }

                      foreach ($client_emaill as $key2 => $value) {
                        if($key2 == $key){
                          $client_emailll = $value;
                          break;
                        }
                      }
                    }
                  ?>

                  <input class="form-control" name="to" id="to" placeholder="To:" value="<?php if(isset($client)) echo $client[0]->email; if((isset($client) && !empty($client[0]->email)) && (isset($product_id) && !empty($client_emailll))){ echo ',';} if(isset($product_id)) echo $client_emailll; ?>">
                </div>
                <div class="form-group">
                  <label for="cc">Cc </label>

                  <input class="form-control" name="cc" id="cc" placeholder="Cc:" value="<?php if(isset($client)) echo $client[0]->cc; ?>" data-toggle="tooltip" title="For multiple Cc, separate them by comma (,)">
                </div>
                <div class="form-group">
                  <label for="bcc">Bcc </label>

                  <input class="form-control" name="bcc" id="bcc" placeholder="Bcc:" value="<?php if(isset($client)) echo $client[0]->bcc; ?>" data-toggle="tooltip" title="For multiple Bcc, separate them by comma (,)">
                </div>
                <div class="form-group">
                  <label for="subject">Subject </label>

                  <input class="form-control" name="subject" id="subject" placeholder="Subject:">
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="mail_body" id="mail_body">
                    <div class="fr-view">
                      <p class="pull-left"><strong><?php echo 'Ref no.: &nbsp;&nbsp;&nbsp;&nbsp;'; echo 'WREF:INQ' . $iq_no . '-' . date('m') . date('y'); ?></strong></p>
                      <br><br>

                      <p>
                        Dear Concern,<br>
                        We have an inquiry -
                      </p>
                      <p>
                        <span id="span_details">Under the client: <span id="span_client"><strong>[CLIENT NAME]</strong></span><br><?php 
                            if(isset($client)){
                              $sql3 = "SELECT * FROM products WHERE product_id = '$product_id'";
                              $name = $this->db->query($sql3,array($product_id))->row()->name;
                              echo '<span id="span_product">' . $name . '</strong>';
                            } else {
                              echo '<span id="span_product"><strong>[PRODUCT NAME]</strong></span>';
                            }
                          ?>
                          INN--MOQ--<span id="span_shipping_mode"><strong>[SHIPPING MODE]</strong></span>
                          <br><br>
                        </span>
                      </p>
                      <p>
                        Please quote us your best price as <span id="span_commission"><strong>[COMMISSION]</strong></span> <span id="span_payment_mode"><strong>[PAYMENT MODE]</strong></span> immediately.
                      </p><br>
                      <p>With Best Regards,</p>
                      <p>
                        <?php echo '<strong>' . $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . '</strong>'; ?><br>
                        <?php echo $this->session->userdata('join_desg'); ?><br>
                        Cell: <?php echo $this->session->userdata('phone'); ?>
                        <?php if($this->session->userdata('email') == 'WEMP-000101') echo '| Skype: anik.arafin | QQ: 2037024365'; ?>
                      </p>
                      <hr>
                      <p>
                        WINMARK BD. Ltd. (Formerly Winmark Corporation) | 56/B, Ansar Camp Road | Mirpur 1 | Dhaka 1216 | Bangladesh<br>
                        Phone: +88 018 4049/50/51/52 | Email: winmarkbdltd@gmail.com<br>
                        Please consider the environment before printing this email.
                      </p>
                    </div>
                  </textarea>
                </div>
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
                  if($ref_no == 'inquiry_mail' || $ref_no == '' || is_numeric($ref_no[0])){
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
      height: 450
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

  $(document).ready(function(){
    $('#client').change(function(){
      var client = $('#client').val();
      var client = client.split('|');
      var client_id = client[0];
      var name = client[1];

      $('#customer_id').val(client_id);
      $('#customer_name').val(name);
    });

    var clients = [];
    $('#add').click(function(){
      var product = $('#product').val();
      var shipping_mode = $('#shipping_mode').val();

      var temp = {
        p_name: product,
        shipping: shipping_mode
      };

      clients[(clients.length - 1)].products.push(temp);
      remakeClientSpan();
    });

    $('#add2').click(function(){
      var product = $('#product').val();
      var client = $('#client').val();
      var shipping_mode = $('#shipping_mode').val();

      var temp = {
        c_name: client,
        products: [{
          p_name: product,
          shipping: shipping_mode
        }]
      };

      clients.push(temp);
      remakeClientSpan();
    });

    function remakeClientSpan(){
      var str = "";
      for(var i=0; i<clients.length; i++){
        str += 'Under the client: ' + clients[i].c_name + '<br>';
        for(var j=0; j<clients[i].products.length; j++){
          str += clients[i].products[j].p_name + ' INN--MOQ--' + clients[i].products[j].shipping + '<br>';
        }
        str += '<br><br>';
      }
      $('#span_details').html(str);
    }

    $('#commission').change(function(){
      $('#span_commission').text($(this).val());
    });

    $('#payment_mode').change(function(){
      $('#span_payment_mode').text($(this).val());
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