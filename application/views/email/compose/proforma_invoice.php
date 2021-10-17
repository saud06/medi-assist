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
          <li class="active">Proforma Invoice</li>
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
                <label for="client">Client </label>
                
                <select class="form-control select2" id="client" name="client" style="width: 100%;">
                  <option value="">Select Client</option>
                  <?php
                    foreach ($client as $key) { ?>
                      <option value="<?php echo $key->client_id . '|' . $key->company_name . '|' . $key->contact_person . '|' . $key->email . '|' . $key->cc . '|' . $key->bcc . '|' . $key->house_no . '|' .  $key->road_no . '|' .  $key->state_id . '|' .  $key->city_id . '|' .  $key->country_id . '|' .  $key->zip_code . '|' .  $key->factory_address; ?>"><?php echo $key->company_name; ?></option>
                  <?php  
                    }
                  ?>
                </select>
              </div>

              <div class="form-group box-body">
                <label for="client">PO / Indent No. </label>

                <input type="text" name="indent_no" id="indent_no" class="form-control" placeholder="Insert PO/Indent No.">
              </div>

              <div class="form-group box-body">
                <label for="client2">Manufacturer </label>
                
                <select class="form-control select2" id="client2" name="client2" style="width: 100%;">
                  <option value="">Select Manufacturer</option>
                  <?php
                    foreach ($client2 as $key) { ?>
                      <option value="<?php echo $key->client_id . '|' . $key->company_name . '|' . $key->house_no . '|' .  $key->road_no . '|' .  $key->state_id . '|' .  $key->city_id . '|' .  $key->country_id . '|' .  $key->zip_code; ?>"><?php echo $key->company_name; ?></option>
                  <?php  
                    }
                  ?>
                </select>
              </div>

              <div class="form-group box-body">
                <label for="client3">Supplier &amp; LC Beneficiary </label>
                
                <select class="form-control select2" id="client3" name="client3" style="width: 100%;">
                  <option value="">Select Supplier &amp; LC Beneficiary</option>
                  <?php
                    foreach ($client3 as $key) { ?>
                      <option value="<?php echo $key->client_id . '|' . $key->company_name . '|' .  $key->factory_address; ?>"><?php echo $key->company_name; ?></option>
                  <?php  
                    }
                  ?>
                </select>
              </div>

              <div class="form-group box-body">
                <label for="consignee">Consignee </label>
                
                <select class="form-control select2" id="consignee" name="consignee" style="width: 100%;">
                  <option value="">Select Consignee</option>
                  <?php
                    foreach ($consignee as $key) { ?>
                      <option value="<?php echo $key->consignee_ec_name . '|' . $key->consignee_ec_address; ?>"><?php echo $key->consignee_ec_name; ?></option>
                  <?php  
                    }
                  ?>
                </select>
              </div>

              <div class="form-group box-body">
                <label for="country_of_goods">Country of Goods </label>
                
                <select class="form-control select2" id="country_of_goods" name="country_of_goods" style="width: 100%;">
                  <option value="">Select Country of Goods</option>
                  <?php
                    foreach ($country_of_goods as $key) { ?>
                      <option value="<?php echo $key->name; ?>"><?php echo $key->name; ?></option>
                  <?php  
                    }
                  ?>
                </select>
              </div>

              <div class="form-group box-body">
                <label for="port_of_loading">Port of Loading </label>
                
                <select class="form-control select2" id="port_of_loading" name="port_of_loading" style="width: 100%;">
                  <option value="">Select Port of Loading</option>
                  <?php
                    foreach ($port_of_loading as $key) { ?>
                      <option value="<?php echo $key->port_ec_name; ?>"><?php echo $key->port_ec_name; ?></option>
                  <?php  
                    }
                  ?>
                </select>
              </div>

              <div class="form-group box-body">
                <label for="port_of_discharge">Port of Discharge </label>
                
                <select class="form-control select2" id="port_of_discharge" name="port_of_discharge" style="width: 100%;">
                  <option value="">Select Port of Discharge</option>
                  <?php
                    foreach ($port_of_discharge as $key) { ?>
                      <option value="<?php echo $key->port_of_discharge_ec_name; ?>"><?php echo $key->port_of_discharge_ec_name; ?></option>
                  <?php  
                    }
                  ?>
                </select>
              </div>

              <div class="form-group box-body">
                <label for="country_of_final_destination">Country of Final Destination </label>
                
                <select class="form-control select2" id="country_of_final_destination" name="country_of_final_destination" style="width: 100%;">
                  <option value="">Select Country of Final Destination</option>
                  <?php
                    foreach ($country_of_final_destination as $key) { ?>
                      <option value="<?php echo $key->name; ?>"><?php echo $key->name; ?></option>
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
                    <label for="shipment_date">Shipment Date </label>
                
                    <input type="text" class="form-control datepicker" id="shipment_date" name="shipment_date" placeholder="Insert Shipment Date" autocomplete="off">
                  </div>
                  <div class="col-sm-6">
                    <label for="expiry_date">Expiry Date </label>
                
                    <input type="text" class="form-control datepicker2" id="expiry_date" name="expiry_date" placeholder="Insert Expiry Date" autocomplete="off">
                  </div>
                </div>
              </div>

              <div class="form-group box-body">
                <label for="banker">Banker </label>
                
                <select class="form-control select2" id="banker" name="banker" style="width: 100%;">
                  <option value="">Select Banker</option>
                  <?php
                    foreach ($banker as $key) { ?>
                      <option value="<?php echo $key->bankers_ec_name . '|' . $key->bankers_ec_address; ?>"><?php echo $key->bankers_ec_name; ?></option>
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
                  if($proforma_invoice_no == null){
                    $pf_no = sprintf('%06d', intval(101));
                  } else{
                    foreach($proforma_invoice_no as $value){
                      $pf_no = sprintf('%06d', intval($value->id)+101);
                    }
                  }
                ?>

                <div class="col-sm-3" style="padding-right: 0;">
                  <label>Ref no.</label>
                  <input style="text-align: center;" class="form-control" name="ref_no" id="ref_no" value="<?= 'WREF:IND' . $pf_no . '-' . date('m') . date('y'); ?>" readonly>
                </div>

                <input type="hidden" name="mail_type" id="mail_type" value="indent">
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
                      <p><strong><?php echo 'Ref no.: &nbsp;&nbsp;'; echo 'WREF:IND' . $pf_no . '-' . date('m') . date('y'); ?></strong></p>

                      <table style="width: 100%; border: 1px solid black; border-collapse: collapse;">
                        <tbody>
                          <tr>
                            <td colspan="3" style="vertical-align: top; border: 1px solid black; border-collapse: collapse;">&nbsp;<strong><u>CUSTOMER / IMPORTER &amp; SHIP TO:</u></strong>
                              <br>&nbsp;<span id="span_client">[NAME]</span>
                              <br>&nbsp;<span id="span_address">[ADDRESS]</span>
                              <br>&nbsp;FACTORY ADDRESS: <span id="span_factory">[FACTORY ADDRESS]</span></td>
                            <td colspan="2" style="vertical-align: top; border: 1px solid black; border-collapse: collapse;">&nbsp;PO/Indent No.:&nbsp;<span id="span_indent" style="color: red;">[NUMBER]</span>
                              <br>&nbsp;IRC REG NO.:&nbsp;
                              <br>&nbsp;BB Permission No.:&nbsp;
                              <br>&nbsp;TIN:&nbsp;</td>
                          </tr>
                          <tr>
                            <td colspan="2" style="border: 1px solid black; border-collapse: collapse;">&nbsp;<strong><u>MANUFACTURER:</u></strong>
                              <br>&nbsp;<span id="span_client2">[NAME]</span>
                              <br>&nbsp;<span id="span_address2">[ADDRESS]</span>
                              <br>&nbsp;
                              <br>&nbsp;<strong><u>SUPPLIER &amp; LC BENEFICIARY:</u></strong>
                              <br>&nbsp;<span id="span_client3">[NAME]</span>
                              <br>&nbsp;<span id="span_factory2">[FACTORY ADDRESS]</span></td>
                            <td colspan="3" style="vertical-align: top; border: 1px solid black; border-collapse: collapse;">&nbsp;<strong><u>NOTIFY:</u></strong>
                              <br>&nbsp;SAME AS IMPORTER
                              <br>&nbsp;
                              <br>&nbsp;
                              <br>&nbsp;<strong><u>CONSIGNEE:</u></strong>
                              <br>&nbsp;<span id="span_consignee">[CONSIGNEE NAME]</span>
                              <br>&nbsp;<span id="span_consignee_address">[CONSIGNEE ADDRESS]</span></td>
                          </tr>
                          <tr>
                            <td colspan="2" style="border: 1px solid black; border-collapse: collapse;">&nbsp;<strong><u>COUNTRY OF ORIGIN OF GOODS &amp; SUPPLY:</u></strong>&nbsp;
                              <br>&nbsp;<span id="span_country_of_goods">[COUNTRY NAME]</span>
                              <br>&nbsp;
                              <br>&nbsp;<strong><u>PORT OF LOADING:</u></strong>&nbsp;
                              <br>&nbsp;<span id="span_port_of_loading">[PORT NAME]</span>
                              <br>&nbsp;
                              <br>&nbsp;<strong><u>PORT OF DISCHARGE:</u></strong>&nbsp;
                              <br>&nbsp;<span id="span_port_of_discharge">[PORT NAME]</span>
                              <br>&nbsp;
                              <br>&nbsp;<strong><u>COUNTRY OF FINAL DESTINATION:</u></strong>&nbsp;
                              <br>&nbsp;<span id="span_country_of_final_destination">[COUNTRY NAME]</span></td>
                            <td colspan="3" style="vertical-align: top; border: 1px solid black; border-collapse: collapse;">&nbsp;<strong><u>TERMS OF DELIVERY AND PAYMENT:</u></strong>&nbsp;
                              <br>&nbsp;SHIPMENT: <span id="span_shipping_mode">[SHIPPING MODE]</span>
                              <br>&nbsp;PAYMENT: <span id="span_payment_mode">[PAYMENT MODE]</span>
                              <br>&nbsp;L/C LATEST SHIPMENT DATE: <span id="span_shipment_date">[SHIPMENT DATE]</span>
                              <br>&nbsp;L/C EXPIRY DATE: <span id="span_expiry_date">[EXPIRY DATE]</span>
                              <br>&nbsp;PACKING: EXPORT STANDARD
                              <br>&nbsp;
                              <br>&nbsp;
                              <br>&nbsp;<strong><u>BANKER:</u></strong>
                              <br>&nbsp;<span id="span_banker">[BANKER NAME]</span>
                              <br>&nbsp;<span id="span_banker_address">[BANKER ADDRESS]</span></td>
                          </tr>
                          <tr>
                            <td style="width: 6.3993%; vertical-align: top; border: 1px solid black; border-collapse: collapse; text-align: center;">
                              <div><strong>SL NO.</strong></div>
                            </td>
                            <td style="width: 44.0273%; vertical-align: top; border: 1px solid black; border-collapse: collapse; text-align: center;">
                              <div data-empty="true"><strong>DESCRIPTION OF GOODS</strong></div>
                            </td>
                            <td style="width: 17.3208%; vertical-align: top; border: 1px solid black; border-collapse: collapse; text-align: center;">
                              <div data-empty="true"><strong>QUANTITY</strong></div>
                        
                              <p><span id="span_unit">[UNIT NAME]</span></p>
                            </td>
                            <td style="width: 16.8089%; vertical-align: top; border: 1px solid black; border-collapse: collapse; text-align: center;">
                              <div data-empty="true"><strong>PRICE / UNIT</strong></div>
                        
                              <p><span id="span_currency">[CURRENCY NAME]</span></p>
                            </td>
                            <td style="width: 15.273%; vertical-align: top; border: 1px solid black; border-collapse: collapse; text-align: center;">
                              <div data-empty="true"><strong>AMOUNT</strong></div>
                        
                              <p><span id="span_currency2">[CURRENCY NAME]</span></p>
                            </td>
                          </tr>
                        </tbody>
                        <tbody id="product_list">
                          <tr>
                            <td style="border: 1px solid black; border-collapse: collapse; text-align: center;">
                              <div>1</div>
                            </td>
                            <td style="text-align: center; border: 1px solid black; border-collapse: collapse;"><u>DESCRIPTION:</u>
                              <br><span id="span_category">[CATEGORY NAME]</span> RAW MATERIAL
                              <div><span id="span_product" style="color: red;">[PRODUCT NAME]</span></div>

                              <p>HS CODE:&nbsp;</p>
                            </td>
                            <td style="vertical-align: middle; text-align: center; border: 1px solid black; border-collapse: collapse;">
                              <span id="span_quantity" style="color: red;">[QUANTITY]</span>
                              <br>
                            </td>
                            <td style="vertical-align: middle; border: 1px solid black; border-collapse: collapse; text-align: center;">
                              <div>FOB: <span id="span_fob" style="color: red;">[PRICE]</span>/<span id="span_unit2">[UNIT]</span></div>
                              <div>FREIGHT: <span id="span_frt" style="color: red;">[PRICE]</span>/<span id="span_unit3">[UNIT]</span></div>
                              <div>CPT: <span id="span_cpt" style="color: red;">[PRICE]</span>/<span id="span_unit4">[UNIT]</span></div>
                            </td>
                            <td style="text-align: center; border: 1px solid black; border-collapse: collapse;">CPT: 
                              <span id="span_currency3">[CURRENCY]</span>&nbsp;
                              <span id="span_tot_cpt" style="color: red;">[PRICE]</span>
                            </td>
                          </tr>
                        </tbody>
                        <tbody>
                          <tr>
                            <td colspan="3" style="border: 1px solid black; border-collapse: collapse; padding-left: 5px; padding-right: 5px;">(IN WORDS: <span id="span_currency4">[CURRENCY]</span>&nbsp;<span id="span_tot_price_in_words" style="color: red;">[PRICE IN WORDS]</span>&nbsp;ONLY.)</td>
                            <td colspan="4" style="border: 1px solid black; border-collapse: collapse; padding-left: 5px; padding-right: 5px;">TOTAL PRICE:&nbsp;<span id="span_currency5">[CURRENCY]</span>&nbsp;<span id="span_tot_price" style="color: red;">[PRICE]</span></td>
                          </tr>
                        </tbody>
                      </table>
                          
                      <br>
                        
                      <table style="width: 100%; border: 1px solid black; border-collapse: collapse;">
                        <tbody>
                          <tr>
                            <td style="width: 100.0000%; border: 1px solid black; border-collapse: collapse; padding-left: 5px; padding-right: 5px;"><strong><u>Note For Exporter:</u></strong>&nbsp;
                              <br>Shipment: Within 6 (six) weeks from issuing date of PO / Indent &amp; 1 (one) week after receiving original L/C by exporter bank.
                              <br>Packing: Export Standard.
                              <br>Pre-shipment sample must should approved by customer QC before final shipment of commercial lot.
                              <br>Documents required: AWB (if air shipment), BL (if sea shipment), Invoice, packing list, COA, COO and Form 9.
                              <br>Name of the manufacturer, item, batch number, date of Mfg &amp; expiry, country of origin, name of the importer and L/C number with date to be mentioned on the labels &amp; in the respective shipping documents.</td>
                          </tr>
                        </tbody>
                      </table>
                          
                      <br>

                      <p>With Best Regards,</p>
                      <p>
                        <?php echo '<strong>' . $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') . '</strong>'; ?><br>
                        <?php echo $this->session->userdata('join_desg'); ?><br>
                        Cell: <?php echo $this->session->userdata('phone'); ?>
                        <?php if($this->session->userdata('email') == 'WEMP-000101') echo '| Skype: anik.arafin | QQ: 2037024365'; ?>
                      </p><br>
                      <p>______________________</p>
                      <p><strong>AUTHORIZED SIGNATURE</strong></p>
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
                  if($ref_no == 'proforma_invoice' || $ref_no == ''){
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

            <div class="callout bg-gray" style="border-left-color: #bcc0c6; margin-bottom: 5px;">
              <h4 class="box-title" style="color: #000;">Product</h4>
              <hr>

              <div class="form-group">
                <label for="product">Select Product </label>

                <select class="form-control select2" id="product" name="product" style="width: 100%;">
                  <option value="">Select Product</option>
                  <?php
                    foreach ($product as $key) { ?>
                      <option value="<?php echo $key->product_id . '|' . $key->name; ?>"><?php echo $key->name; ?></option>
                  <?php  
                    }
                  ?>
                </select>
              </div>

              <div class="form-group">
                <label for="quantity">Insert Quantity </label>

                <input type="number" name="quantity" id="quantity" class="form-control" placeholder="Quantity" readonly>
              </div>

              <div class="form-group">
                <label for="price">Insert Price / Unit </label>

                <div class="row">
                  <div class="col-sm-6">
                    <input type="number" name="fob" id="fob" class="form-control" placeholder="FOB" readonly>
                  </div>

                  <div class="col-sm-6">
                    <input type="number" name="frt" id="frt" class="form-control" placeholder="Freight" readonly>
                  </div>
                </div>
              </div>

              <div class="box-body" style="padding-right: 0">
                <button title="Add to List" type="button" id="add" class="btn bg-gray-light pull-right" disabled><i class="fa fa-arrow-right"></i></button>
              </div>
            </div>
          </div>

          <input type="hidden" name="contact_person" id="contact_person">
          <input type="hidden" name="customer_id" id="customer_id">
          <input type="hidden" name="customer_name" id="customer_name">
          <input type="hidden" name="hidden_indent_no" id="hidden_indent_no">
          <input type="hidden" name="manufacturer_id" id="manufacturer_id">
          <input type="hidden" name="manufacturer_name" id="manufacturer_name">
          <input type="hidden" name="grand_total" id="grand_total">
          <input type="hidden" name="product_data" id="product_data">
          <!-- /.col -->
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

          <input type="hidden" name="contact_person" id="pr_contact_person">
          <input type="hidden" name="customer_id" id="pr_customer_id">
          <input type="hidden" name="customer_name" id="pr_customer_name">
          <input type="hidden" name="indent_no" id="pr_indent_no">
          <input type="hidden" name="manufacturer_id" id="pr_manufacturer_id">
          <input type="hidden" name="manufacturer_name" id="pr_manufacturer_name">
          <input type="hidden" name="grand_total" id="pr_grand_total">
          <input type="hidden" name="product_data" id="pr_product_data">

          <input type="hidden" name="process" value="print">
        </form>

        <div class="col-md-3">
          <p style="color: red;">*** Note: Do not <strong>CHANGE / UPDATE</strong> red marked texts / values in the Email body manually. Remittance History won't be affected by doing them. You must <strong>INSERT / UPDATE</strong> data using 'Product' panel.</p>
          <br>
        </div>

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
      height: 1030
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
      var contact_person = client[2];
      var email = client[3];
      var cc = client[4];
      var bcc = client[5];
      var house = client[6] + ', ';
      var road = client[7] + ',<br>';
      var state = client[8];
      var city = client[9];
      var country = client[10];
      var zip_code = '-' + client[11] + ', ';
      var factory = client[12];

      $('#contact_person').val(contact_person);
      $('#customer_id').val(client_id);
      $('#customer_name').val(name);

      $('#to').val(email);
      $('#cc').val(cc);
      $('#bcc').val(bcc);
      $('#span_client').html(name);

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
      $('#span_factory').html(factory);
    });

    $('#indent_no').on('input', function(){
      $('#span_indent').html($(this).val()).css('color', '#000');
      $('#hidden_indent_no').val($(this.val()));
    });

    $('#client2').change(function(){
      var client = $('#client2').val();
      var client = client.split('|');
      var client_id = client[0];
      var name = client[1];
      var house = ', ' + client[2] + ', ';
      var road = client[3] + ', ';
      var state = client[4];
      var city = client[5];
      var country = client[6];
      var zip_code = '-' + client[7] + ', ';

      $('#manufacturer_id').val(client_id);
      $('#manufacturer_name').val(name);

      $('#span_client2').html(name);

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

      $('#span_address2').html(house + road + state + city + zip_code + country);
    });

    $('#client3').change(function(){
      var client = $('#client3').val();
      var client = client.split('|');
      var client_id = client[0];
      var name = client[1];
      var factory = client[2];

      $('#span_client3').html(name);
      $('#span_factory2').html(factory);
    });

    $('#consignee').change(function(){
      var consignee = $('#consignee').val();
      var consignee = consignee.split('|');
      var name = consignee[0];
      var address = consignee[1];

      $('#span_consignee').html(name);
      $('#span_consignee_address').html(address);
    });

    $('#country_of_goods').change(function(){
      $('#span_country_of_goods').html($(this).val());
    });

    $('#port_of_loading').change(function(){
      $('#span_port_of_loading').html($(this).val());
    });

    $('#port_of_discharge').change(function(){
      $('#span_port_of_discharge').html($(this).val());
    });

    $('#country_of_final_destination').change(function(){
      $('#span_country_of_final_destination').html($(this).val());
    });

    $('#shipment_date').change(function(){
      $('#span_shipment_date').text($('#shipment_date').val());
    });

    $('#expiry_date').change(function(){
      $('#span_expiry_date').text($('#expiry_date').val());
    });

    $('.datepicker').datepicker({
      autoclose: true,
      format: "MM dd, yyyy",
      todayHighlight: true,
      orientation: "auto",
      todayBtn: true,
      todayHighlight: true,  
    });

    $('.datepicker2').datepicker({
      autoclose: true,
      format: "MM dd, yyyy",
      todayHighlight: true,
      orientation: "auto",
      todayBtn: true,
      todayHighlight: true,  
    });

    $('#banker').change(function(){
      var banker = $('#banker').val();
      var banker = banker.split('|');
      var name = banker[0];
      var address = banker[1];

      $('#span_banker').html(name);
      $('#span_banker_address').html(address);
    });

    $('#shipping_mode').change(function(){
      $('#span_shipping_mode').html($(this).val());
    });

    $('#payment_mode').change(function(){
      $('#span_payment_mode').html($(this).val());
    });

    var product; var quantity; var fob;
    $('#product').on("change", function(){
      product = $(this).val();
      if (product == ''){
        $('#quantity').val('');
        $('#fob').val('');
        $('#frt').val('');
        $('#quantity').attr('readonly', 'readonly');
        $('#fob').attr('readonly', 'readonly');
        $('#frt').attr('readonly', 'readonly');
        $('#add').attr('disabled', 'disabled');
      }
      else{
        $('#quantity').removeAttr('readonly');
      }
    });

    $('#quantity').on("input", function(){
      quantity = $(this).val();
      if (quantity == ''){
        $('#fob').val('');
        $('#frt').val('');
        $('#fob').attr('readonly', 'readonly');
        $('#frt').attr('readonly', 'readonly');
        $('#add').attr('disabled', 'disabled');
      }
      else{
        $('#fob').removeAttr('readonly');
      }
    });

    $('#fob').on("input", function(){
      fob = $(this).val();
      if (fob == ''){
        $('#frt').val('');
        $('#frt').attr('readonly', 'readonly');
        $('#add').attr('disabled', 'disabled');
      }
      else{
        $('#frt').removeAttr('readonly');
      }
    });

    $('#frt').on("input", function(){
      frt = $(this).val();
      if(frt != ''){  
        $('#add').removeAttr('disabled');
      }
      else{
        $('#add').attr('disabled', 'disabled');
      }
    });

    var flag = 0;
    var counter = 1;
    var tot_price = 0;
    var product_data = new Array();
    $('#add').click(function(i){
      var id = $('#product').val().split('|')[0];
      var name = $('#product').val().split('|')[1];

      var category;

      var span_unit = $('#unit').val();
      var span_currency = $('#currency').val();

      var price = +fob + +frt;
      tot_price += (price * quantity);

      $.ajax({
          url: "<?php echo base_url('email/get_product_category') ?>/"+id,
          type: "GET",
          dataType: "JSON",
          async: false,
          success: function(data){
            //console.log(data);
            category = data[0].category_name;
          }
      });

      if(flag == 0){
        $('#product_list').empty();
        flag = 1;
      }

      $('#product_list').append('<tr><td style="border: 1px solid black; border-collapse: collapse; text-align: center;"><div>' + counter + '</div></td><td style="text-align: center; border: 1px solid black; border-collapse: collapse;"><u>DESCRIPTION:</u><br><span id="span_category">' + category + '</span> RAW MATERIAL<div><span id="span_product" style="color: #000;">' + name + '</span></div><p>HS CODE:&nbsp;</p></td><td style="vertical-align: middle; text-align: center; border: 1px solid black; border-collapse: collapse;"><span id="span_quantity" style="color: #000;">' + quantity + '</span></td><td style="vertical-align: middle; border: 1px solid black; border-collapse: collapse; text-align: center;"><div>FOB: <span id="span_fob" style="color: #000;">' + fob + '</span>/<span id="span_unit2">' + span_unit + '</span></div><div>FREIGHT: <span id="span_frt" style="color: #000;">' + frt + '</span>/<span id="span_unit3">' + span_unit + '</span></div><div>CPT: <span id="span_cpt" style="color: #000;">' + price + '</span>/<span id="span_unit4">' + span_unit + '</span></div></td><td style="text-align: center; border: 1px solid black; border-collapse: collapse;">CPT: <span id="span_currency3">' + span_currency + '</span>&nbsp;<span id="span_tot_cpt" style="color: #000;">' + (price * quantity) + '</span></td></tr>');

      $('#span_tot_price').html(tot_price).css('color', '#000');
      $('#grand_total').val(tot_price);

      $.ajax({
          url: "<?php echo base_url('email/numtowords') ?>/"+tot_price,
          type: "GET",
          data : {
            '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
          },
          dataType: "JSON",
          success: function(data){
            $('#span_tot_price_in_words').html(data);
            $('#span_tot_price_in_words').css('color', '#000');
          },
          error: function(xhr, status, error){
            alert('Error check out adding data '+error);
          }
      });

      product_data.push({ name: name, price: price, quantity: quantity, value: (price * quantity) });
      var email_data = JSON.stringify(product_data);
      $('#product_data').val(email_data);

      counter++;

      $('#product').val('').change();
      $('#add').attr('disabled', 'disabled');
    });

    $('#currency').change(function(){
      $('#span_currency').html('(' + $(this).val() + ')');
      $('#span_currency2').html('(' + $(this).val() + ')');
      $("#span_currency").css("font-weight", "bold");
      $("#span_currency2").css("font-weight", "bold");
      $('#span_currency3').html($(this).val());
      $('#span_currency4').html($(this).val());
      $('#span_currency5').html($(this).val());
    });

    $('#unit').change(function(){
      $('#span_unit').html('(' + $(this).val() + ')');
      $("#span_unit").css("font-weight", "bold");
      $('#span_unit2').html($(this).val());
      $('#span_unit3').html($(this).val());
      $('#span_unit4').html($(this).val());
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