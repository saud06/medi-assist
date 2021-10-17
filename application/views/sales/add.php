<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','sales_person','manager');
if(!(in_array($this->session->userdata('type'),$p))){
  redirect('auth');
}
  $this->load->view('layout/header');
?>

  <style type="text/css">
    select.courierSelect{ 
      display: none;
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
          <li><a href="<?php echo base_url('sales'); ?>" class="text-black"><strong>Sales / Sample Submit</strong></a></li>
          <li class="active"><?php echo $this->lang->line('sales_add_sales'); ?></li>
        </ol>
      </h5>    
    </section>

  <!-- Main content -->
    <section class="content">
      <div class="row">
      <!-- right column -->
        <div class="col-sm-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $this->lang->line('sales_add_new_sales'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <form role="form" id="form" method="post" action="<?php echo base_url('sales/addSales');?>">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="date"><?php echo $this->lang->line('purchase_date'); ?><span class="validation-color">*</span></label>
                    <input type="text" class="form-control datepicker" id="date" name="date" value="<?php echo date("Y-m-d");  ?>">
                    <span class="validation-color pull-right" id="err_date"><?php echo form_error('date'); ?></span>
                  </div>

                  <?php
                    if($reference_no==null){
                        $no = sprintf('%06d',intval(1));
                    }
                    else{
                      foreach ($reference_no as $value) {
                        $no = sprintf('%06d',intval($value->sales_id)+1); 
                      }
                    }
                  ?>
                  <div class="form-group">
                    <label for="reference_no"><?php echo $this->lang->line('purchase_reference_no'); ?></label>
                    <input type="text" class="form-control" id="reference_no" name="reference_no" value="WSLS-<?php echo $no;?>" readonly>
                    <span class="validation-color" id="err_reference_no"><?php echo form_error('reference_no'); ?></span>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-6" style="padding-left: 0">
                      <label for="ship_mode">
                        Shipping Mode 
                      </label><br>

                      <input type="radio" name="ship_mode" id="" class="courierCls" value="Air"> Air &emsp;
                      <input type="radio" name="ship_mode" id="courier" class="courierCls" value="Courier"> Courier &emsp;
                      <input type="radio" name="ship_mode" id="" class="courierCls" value="Sea"> Sea &emsp;
                      <input type="radio" name="ship_mode" id="" class="courierCls" value="Road"> Road &emsp;

                      <br><br>

                      <select class="form-control courierSelect" name="courier_type" id="courier_type" style="width: 100%;">
                        <?php
                          foreach ($couriers as $val) { ?>
                            <optgroup label="<?php echo $val->courier_name; ?>">
                              <option value="<?php echo $val->courier_id . ',Freight'; ?>">Freight</option>
                              <option value="<?php echo $val->courier_id . ',Custom'; ?>">Custom</option>
                              <option value="<?php echo $val->courier_id . ',Clearance Charge'; ?>">Clearance Charge</option>
                            </optgroup>
                          <?php 
                          }
                          ?>
                      </select>
                      <span class="validation-color" id="err_ship_mode"><?php echo form_error('ship_mode'); ?></span>
                    </div>

                    <div class="col-sm-6" style="padding-right: 0">
                      <label for="currency">
                        Currency <span class="validation-color">*</span>
                      </label><br>

                      <select class="form-control" name="currency" id="currency" style="width: 100%;">
                        <option value="">Select Currency</option>
                        <?php
                          foreach ($currency as $curr) { ?>
                            <option value="<?php echo $curr->id . '|' . $curr->name; ?>"><?php echo $curr->name; ?></option>
                          <?php 
                          }
                          ?>
                      </select>

                      <span class="validation-color" id="err_currency"><?php echo form_error('currency'); ?></span>
                    </div>
                  </div>
                </div>
                
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="client">
                      Customer <span class="validation-color">*</span>
                    </label>

                    <select class="form-control select2" id="client" name="client_id" style="width: 100%;">
                      <option value="">Select Customer</option>
                      <?php
                        foreach ($client as $key) { ?>
                          <option value="<?php echo $key->client_id ?>" <?php if(isset($client_id)){ if($key->client_id == $client_id){ ?> selected <?php }}?>><?php echo $key->company_name; ?></option>
                      <?php  
                        }
                      ?>
                    </select>
                    <span class="validation-color" id="err_client"><?php echo form_error('client'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="employee"> 
                      Employee 
                    </label>

                     <input type="text" name="emp_id" id="employee" class="form-control" value="<?php echo $this->session->userdata('first_name') . ' ' . $this->session->userdata('last_name') ?>" readonly>
                  </div>
                  
                  <!-- <div class="form-group">
                    <label for="shipping_charge">Shipping Charge</label>
                    <input type="text" class="form-control text-right" id="shipping_charge" name="shipping_charge" value="<?php echo set_value('shipping_charge'); ?>">
                    <span class="validation-color" id="err_shipping_charge"><?php echo form_error('shipping_charge'); ?></span>
                  </div>
                  <div class="form-group">
                    <input type="checkbox" name="transporter" id="transporter" onchange="transport()"> <label> Enable Transport Details</label>
                  </div>
                  <div class="transporter">
                    <div class="form-group">
                      <label for="mode_of_transport">Mode of Transport</label>
                      <input type="text" class="form-control" id="mode_of_transport" name="mode_of_transport" value="<?php echo set_value('mode_of_transport'); ?>">
                      <span class="validation-color" id="err_mode_of_transport"><?php echo form_error('mode_of_transport'); ?></span>
                    </div>
                    <div class="form-group">
                      <label for="transporter_name">Transporter Name</label>
                      <input type="text" class="form-control" id="transporter_name" name="transporter_name" value="<?php echo set_value('transporter_name'); ?>">
                      <span class="validation-color" id="err_transporter_name"><?php echo form_error('transporter_name'); ?></span>
                    </div>
                    <div class="form-group">
                      <label for="transporter_code">Transporter Code</label>
                      <input type="text" class="form-control" id="transporter_code" name="transporter_code" value="<?php echo set_value('transporter_code'); ?>">
                      <span class="validation-color" id="err_transporter_code"><?php echo form_error('transporter_code'); ?></span>
                    </div>
                    <div class="form-group">
                      <label for="vehicle_regn_no">Vehicle Regn No.</label>
                      <input type="text" class="form-control" id="vehicle_regn_no" name="vehicle_regn_no" value="<?php echo set_value('vehicle_regn_no'); ?>">
                      <span class="validation-color" id="err_vehicle_regn_no"><?php echo form_error('vehicle_regn_no'); ?></span>
                    </div>
                  </div>
                  <script>
                    $('.transporter').hide();
                  </script> -->
                </div>
                <!-- <div class="col-sm-6">
                  <div class="well well-small">
                    <h4>Shipping Address</h4><br>
                    <div class="form-group">
                      <label for="country">Country 
                          <?php echo $this->lang->line('biller_lable_country'); ?> <span class="validation-color">*</span>
                        </label>
                      <select class="form-control select2" id="country" name="country" style="width: 100%;">
                        <option value="">
                          Select
                          <?php echo $this->lang->line('add_biller_select'); ?>    
                        </option>
                      </select>
                      <span class="validation-color" id="err_country"><?php echo form_error('country'); ?></span>
                    </div>
                  <div class="form-group">
                      <label for="state">State 
                          <?php echo $this->lang->line('add_biller_state'); ?> 
                          <span class="validation-color">*</span>
                      </label>
                      <select class="form-control select2" id="state" name="state" style="width: 100%;">
                        <option value="">Select
                            <?php echo $this->lang->line('add_biller_select'); ?>
                            
                        </option>
                      </select>
                      <span class="validation-color" id="err_state"><?php echo form_error('state'); ?></span>
                    </div>
                  <div class="form-group">
                      <label for="city">City 
                          <?php echo $this->lang->line('biller_lable_city'); ?> 
                          <span class="validation-color">*</span>
                      </label>
                      <select class="form-control select2" id="city" name="city" style="width: 100%;">
                        <option value="">Select
                            <?php echo $this->lang->line('add_biller_select'); ?>
                            
                            </option>
                      </select>
                      <span class="validation-color" id="err_city"><?php echo form_error('city'); ?></span>
                    </div>
                    <div class="form-group">
                      <label for="address">Address 
                          <?php echo $this->lang->line('add_biller_address'); ?> 
                          <span class="validation-color">*</span>
                      </label>
                      <textarea class="form-control" id="address" rows="2" name="address"><?php echo set_value('address'); ?></textarea>
                      <span class="validation-color" id="err_address"><?php echo form_error('address'); ?></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="l_r_no">L.R No</label>
                    <input type="text" class="form-control" id="l_r_no" name="l_r_no" value="<?php echo set_value('l_r_no'); ?>">
                    <span class="validation-color" id="err_l_r_no"><?php echo form_error('l_r_no'); ?></span>
                  </div>
                  <div class="form-group">
                    <label for="chalan_no">Chalan No</label>
                    <input type="text" class="form-control" id="chalan_no" name="chalan_no" value="<?php echo set_value('chalan_no'); ?>">
                    <span class="validation-color" id="err_chalan_no"><?php echo form_error('chalan_no'); ?></span>
                  </div>
                  <div class="form-group">
                    <label for="indent_no">Indent No</label>
                    <input type="text" class="form-control" id="indent_no" name="indent_no" value="<?php echo set_value('indent_no'); ?>">
                    <span class="validation-color" id="err_indent_no"><?php echo form_error('indent_no'); ?></span>
                  </div>
                  <div class="form-group">
                    <label for="credit_days">credit Days</label>
                    <input type="text" class="form-control" id="credit_days" name="credit_days" value="<?php echo set_value('credit_days'); ?>">
                    <span class="validation-color" id="err_credit_days"><?php echo form_error('credit_days'); ?></span>
                  </div>
                  <div class="form-group">
                    <label for="broker">Broker</label>
                    <input type="text" class="form-control" id="broker" name="broker" value="<?php echo set_value('broker'); ?>">
                    <span class="validation-color" id="err_broker"><?php echo form_error('broker'); ?></span>
                  </div>
                  <div class="form-group">
                    <label for="date_of_supply">Date of Supply</label>
                    <input type="text" class="form-control datepicker" id="date_of_supply" name="date_of_supply" value="<?php echo set_value('date_of_supply'); ?>">
                    <span class="validation-color" id="err_date_of_supply"><?php echo form_error('date_of_supply'); ?></span>
                  </div>
                  <div class="form-group">
                    <label for="electronic_ref_no">Electronic Ref. No</label>
                    <input type="text" class="form-control" id="electronic_ref_no" name="electronic_ref_no" value="<?php echo set_value('electronic_ref_no'); ?>">
                    <span class="validation-color" id="err_electronic_ref_no"><?php echo form_error('electronic_ref_no'); ?></span>
                  </div>
                  <div class="form-group">
                    <label for="gst_payable">GST Payable On Reverse Charge</label>&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="checkbox" class="" id="gst_payable" name="gst_payable" value="YES">
                    <span class="validation-color" id="err_gst_payable"><?php echo form_error('gst_payable'); ?></span>
                  </div>
                </div> -->
                <!-- <div class="col-sm-12">
                  <br><br><br><br>
                  <div class="col-sm-2"></div>
                  <div class="col-sm-5">
                    <div class="form-group">
                      <select class="form-control select2" id="product" name="product" style="width: 100%;">
                      <option value=""><?php echo $this->lang->line('purchase_select_product'); ?></option>
                      
                      ?>
                    </select>
                    </div> /form group
                  </div> /col-md-6
                  <div class="col-sm-4">
                    <span class="validation-color" id="err_product"></span>
                  </div>
                </div> /col-md-12 -->

                <div class="col-sm-12">
                  <br><br><br><br>
                  <div class="col-sm-4"></div>
                  <div class="col-sm-4">
                    <div class="form-group">
                    <?php 
                      if(!isset($selected_product)){
                    ?>
                        <label for="product"> 
                          Product <span class="validation-color">*</span>
                        </label>
                        
                        <select class="form-control select2" id="product" name="product" style="width: 100%;" >
                          <option value="">Select Product</option>
                        </select>
                        <span class="validation-color" id="err_product"><?php echo form_error('product'); ?></span>
                    <?php
                      }
                    ?>
                    </div> <!--/form group  -->
                  </div> <!--/col-md-4 -->
                  <div class="col-sm-4"></div>
                </div> <!--/col-md-12 -->

                <div class="col-sm-12">
                  <div class="form-group">
                    <label><?php echo $this->lang->line('purchase_inventory_items'); ?></label>
                    
                    <div style="overflow-y: auto;">
                      <table class="table items table-striped table-bordered table-condensed table-hover product_table" name="product_data" id="product_data">
                        <thead>
                          <tr>
                            <?php 
                              if(isset($selected_product)){
                            ?>
                                <th width="5%">SL.</th>
                            <?php
                              }
                              else{
                            ?>
                                <th width="5%"><img src="<?php  echo base_url(); ?>assets/images/bin1.png" /></th>
                            <?php  
                              }
                            ?>
                            <th class="span2"><?php echo $this->lang->line('product_code'); ?></th>
                            <th class="span2"><?php echo $this->lang->line('purchase_product_description'); ?></th>
                            <th class="span2" width="10%">FOC</th>
                            <th class="span2" width="15%">Inventory</th>
                            <th class="span2" width="10%"><?php echo $this->lang->line('product_quantity'); ?></th>
                            <?php 
                              if(!isset($selected_product)){
                            ?>
                              <th class="span2" width="10%"><?php echo $this->lang->line('product_available_quantity'); ?></th>
                            <?php
                              }
                            ?>
                            <th class="span2" width="10%"><?php echo $this->lang->line('product_price'); ?> (<span id="span_currency"></span>)</th>
                            <th class="span2" width="10%"> Total (<span id="span_currency2"></span>) </th> 
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                            if(isset($selected_product)){
                              $i=0;
                              $tot=0;
                              foreach ($selected_product as $key) {
                                ?>
                                <tr>
                                  <td><?php echo $i+1; ?> <input type='hidden' name='id' name='id' value="<?php echo $i ?>"><input type='hidden' name='product_id' name='product_id' value="<?php echo $key->product_id ?>"></td>
                                  <td><?php echo $key->code; ?></td>
                                  <td><?php echo $key->name; ?></td>
                                  <td><input type="checkbox" id="fop" name="fop"></td>
                                  <td>
                                    <div class="form-group">
                                      <select required class="form-control" id="item_shelf" name="item_shelf" style="width: 100%;" <?php if(isset($selected_product)){ ?> readonly <?php }?>>
                                        <?php 
                                          $this->db->select('*');
                                          $shelfs = $this->db->get('shelf')->result();
                                        
                                          foreach ($shelfs as $shelf){
                                        ?>
                                            <optgroup label="<?php echo $shelf->shelf_name; ?>">
                                              <?php 
                                                $shelf_id = $shelf->shelf_id;
                                                $this->db->select('*');
                                                $racks = $this->db->get('rack')->result();

                                                foreach ($racks as $rack){
                                                  $rack_id = $rack->rack_id;
                                                  if($rack->shelf_id == $shelf_id){
                                              ?>
                                                    <option value="<?php echo $shelf_id . '0.1' . $rack_id; ?>" <?php if($shelf_id == $key->shelf_id && $rack_id == $key->rack_id){ ?>selected<?php }?>><?php echo $rack->rack_name; ?></option>
                                              <?php
                                                  }
                                                }
                                              ?>
                                            </optgroup>
                                        <?php
                                          }
                                        ?>
                                      </select>
                                    </div>
                                  </td>
                                  <td><input type="number" class="form-control text-right" value="<?php echo $key->quantity ?>" data-rule="quantity" name='qty' id='qty' readonly>
                                  </td>
                                  <td><input type="number" class="form-control text-right" name="price" id="price" value="0.00"></td>
                                  <td><input type="number" class="form-control text-right" name="linetotal" id="linetotal" value="0.00" readonly></td>
                                </tr>
                                <?php
                                  $product_data[$i] = $key->product_id;
                                    //array_push($product_data,$product);
                                $i++;
                                //$tot += $key->gross_total;
                              }
                              //echo "<pre>";
                              //print_r($product_data);
                              //$grandtotal = $row->total;
                              //$product = json_encode($product_data);
                            }
                          ?>
                        </tbody>
                      </table>
                    </div>

                    <input type="hidden" name="total_value" id="total_value">
                    <input type="hidden" name="total_discount" id="total_discount">
                    <input type="hidden" name="total_tax" id="total_tax">
                    <input type="hidden" name="grand_total" id="grand_total">
                    <input type="hidden" name="table_data" id="table_data">
                    
                    <table class="table table-striped table-bordered table-condensed table-hover">
                      <tr>
                        <td align="right" width="80%"><?php echo $this->lang->line('purchase_total_value'); ?></td>
                        <td align='right'><span id="span_currency3"></span><span id="totalValue">0.00</span>
                          <input type="hidden" name="total_value2" id="total_value2"></td>
                      </tr>
                      <!-- <tr>
                        <td align="right"><?php echo $this->lang->line('purchase_total_discount'); ?></td>
                        <td align='right'><?php echo $this->session->userdata('symbol'); ?>
                          <span id="totalDiscount">&nbsp;0.00</span>
                        </td>
                      </tr>
                      <tr>
                        <td align="right"><?php echo $this->lang->line('purchase_total_tax'); ?></td>
                        <td align='right'><?php echo $this->session->userdata('symbol'); ?>
                          <span id="totalTax">&nbsp;0.00</span>
                        </td>
                      </tr> -->
                   <!--    <tr>
                        <td align="right"><?php echo $this->lang->line('purchase_total'); ?></td>
                        <td align='right'><?php echo $this->session->userdata('symbol'); ?><span id="grandTotal">&nbsp;0.00</span></td>
                      </tr> -->
                    </table>
                  </div>
                </div>
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="note"><?php echo $this->lang->line('purchase_note'); ?></label>
                    <textarea class="form-control" id="note" name="note"><?php echo set_value('details'); ?></textarea>
                    <span class="validation-color" id="err_details"><?php echo form_error('details'); ?></span>
                  </div>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="box-footer">
                  <button type="submit" id="submit" class="button btn bg-gray">
                    <span class="submit" style="left: 32%">Add</span>
                    <span class="loading" style="left: 32%"><i class="fa fa-circle-o-notch"></i></span>
                  </button>
                  <span class="btn btn-danger" id="cancel" style="margin-left: 2%" onclick="cancel('sales')"><?php echo $this->lang->line('product_cancel'); ?></span>
                </div>
              </div>
            </form>
          </div>
          <!-- /.box-body -->
        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog"> -->

    <!-- Modal content-->
    <!-- <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4><?php echo $this->lang->line('product_hsn_sac_lookup'); ?>
          Add New Client
        </h4>
      </div>
      <div class="modal-body">
        <div class="control-group">                     
          <div class="controls">
            <div class="tabbable">
              <div class="box-body">
                <div class="row">
                  <form>
                  <div class="col-md-9">
                    <div class="form-group">
                      <label for="client_name">
                        <?php echo $this->lang->line('add_client_cname'); ?>
                      </label>
                      <input type="text" class="form-control" id="client_name" name="client_name" value="<?php echo set_value('client_name'); ?>">
                    </div>
                  <div class="form-group">
                    <label for="address">
                        <?php echo $this->lang->line('add_biller_address'); ?> 
                    </label>
                    <textarea class="form-control" id="address" rows="4" name="address"><?php echo set_value('address'); ?></textarea>
                  </div>
                  <?php
                      $country=$this->db->get('countries')->result();
                  ?>
                  <div class="form-group">
                    <label for="country">Country 
                      <?php echo $this->lang->line('biller_lable_country'); ?>
                    </label>
                    <select class="form-control select2" id="country" name="country" style="width: 100%;">
                      <option value=""><?php echo $this->lang->line('add_biller_select'); ?></option>
                      <?php
                        foreach ($country as  $key) {
                      ?>
                      <option value='<?php echo $key->id ?>' <?php if($key->id == 101){ echo "selected";}?>>
                          <?php echo $key->name; ?>
                      </option>
                      <?php
                        }
                      ?>
                    </select>
                  </div>
                    <?php
                        /*$country=$this->db->get('states')->where('s.country_id')->result();*/
                        $country= $this->db->select('s.*')
                        ->from('states s')
                        ->join('countries c','c.id = s.country_id')
                        ->where('s.country_id',101)
                        ->get()
                        ->result();
                    ?>
                  <div class="form-group">
                    <label for="state">State 
                      <?php echo $this->lang->line('add_biller_state'); ?> 
                    </label>
                    <select class="form-control select2" id="state" name="state" style="width: 100%;">
                      <option value="">Select
                        <?php echo $this->lang->line('add_biller_select'); ?>
                      </option>
                          <?php
                            foreach ($country as  $key) {
                          ?>
                          <option value='<?php echo $key->id ?>' <?php if($key->id == 101){ echo "selected";}?>>
                              <?php echo $key->name; ?>
                          </option>
                          <?php
                            }
                          ?>
                    </select>
                  </div>
                  <?php
                      $this->db->select('c.*')
                         ->from('cities c')
                         ->join('states s','s.id = c.state_id')
                         ->where('c.state_id',12)
                         ->get()
                         ->result();
                    ?>
                  <div class="form-group">
                    <label for="city">City 
                      <?php echo $this->lang->line('biller_lable_city'); ?> 
                    </label>
                    <select class="form-control select2" id="city" name="city" style="width: 100%;">
                      <option value="">Select
                        <?php echo $this->lang->line('add_biller_select'); ?>
                      </option>
                      <?php
                            foreach ($country as  $key) {
                          ?>
                          <option value='<?php echo $key->id ?>' <?php if($key->id == 101){ echo "selected";}?>>
                              <?php echo $key->name; ?>
                          </option>
                          <?php
                            }
                          ?>
                    </select>
                  </div>
    
                  <div class="form-group">
                    <label for="mobile">Mobile 
                        <?php echo $this->lang->line('add_biller_mobile'); ?> 
                    </label>
                    <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo set_value('mobile'); ?>">
                  </div>
                </div>
                
                <div class="col-sm-12">
                  <div class="box-footer">
                    <button type="submit" id="btn_submit" class="btn btn-info" class="close"  data-dismiss="modal">&nbsp;&nbsp;&nbsp;Add
                        <?php echo $this->lang->line('add_user_btn'); ?>&nbsp;&nbsp;&nbsp;</button>
                    <span class="btn btn-default" id="cancel" style="margin-left: 2%" onclick="cancel('client')">
                      <?php echo $this->lang->line('add_user_btn_cancel'); ?></span>
                  </div>
                </div>
              </form>
              </div>
          /.box-body
              </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $this->lang->line('product_close'); ?></button>
                </div>
            </div>
          </div>
        </div> /controls       
      </div> /control-group 
    </div> -->
      
      <!-- </div>
      
      </div>
          </div> -->
  <?php
    $this->load->view('layout/product_footer');
  ?>
<!-- <script src="<?php echo base_url('assets/jquery/jquery-3.1.1.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script> -->
<!-- <script>
  $('#btn_submit').click(function(){
    $.ajax({
      url : '<?php echo base_url('client/test') ?>',
      datatype : 'JSON',
      method : 'POST',
      data:{
          'client_name':$('#client_name').val(),
          'address':$("#address").val(),
          'country':$("#country").val(),
          'state':$("#state").val(),
          'city':$("#city").val(),
          'mobile':$('#mobile').val()
      },
      success : function(data){
         window.location.href='<?php echo base_url('sales/add')?>';
        if(data==1)
        {
          $('#myModal').modal('hide');

        }
        else
        {
          alert("Try again");
        }
      }
    }); 
  });
</script> -->
<!-- <script type="text/javascript">
  $(document).ready(function() {
      //datepicker
      $('.datepicker').datepicker({
          autoclose: true,
          format: "yyyy-mm-dd",
          todayHighlight: true,
          orientation: "auto",
          todayBtn: true,
          todayHighlight: true,  
      });
  });
  /*function transport(){
      $('.transporter').toggle();
  }*/
</script> -->
<!-- close datepicker  -->
<!-- <script>
  $(document).ready(function(){
    $('#client').change(function(){
      var client_id = $(this).val();
      $.ajax({
          url: "<?php echo base_url('sales/getClientData') ?>/"+client_id,
          type: "GET",
          dataType: "JSON",
          data:{
                '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
          },
          success: function(data){
            $('#country').text('');
            $('#state').text('');
            $('#city').text('');
            $('#err_country').text('');
            $('#err_state').text('');
            $('#err_city').text('');
            for(a=0;a<data['country'].length;a++){
              $('#country').append('<option value="' + data['country'][a].id + '">' + data['country'][a].name+'</option>');
            }
            for(a=0;a<data['state'].length;a++){
              $('#state').append('<option value="' + data['state'][a].id + '">' + data['state'][a].name+'</option>');
            }
            for(a=0;a<data['city'].length;a++){
              $('#city').append('<option value="' + data['city'][a].id + '">' + data['city'][a].name+'</option>');
            }
            $('#country').val(data['data'][0].country_id).attr("selected","selected");
            $('#state').val(data['data'][0].state_id).attr("selected","selected");
            $('#city').val(data['data'][0].city_id).attr("selected","selected");
            $('#address').val(data['data'][0].address);
          }
        });
    });
  });
</script>
<script>
    $('#country').change(function(){
      var id = $(this).val();
      $('#state').html('<option value="">Select</option>');
      $('#city').html('<option value="">Select</option>');
      $.ajax({
          url: "<?php echo base_url('client/getState') ?>/"+id,
          type: "GET",
          dataType: "JSON",
          success: function(data){
            for(i=0;i<data.length;i++){
              $('#state').append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
            }
          }
        });
    });
</script>
<script>
    $('#state').change(function(){
      var id = $(this).val();
      $('#city').html('<option value="">Select</option>');
      $.ajax({
          url: "<?php echo base_url('client/getCity') ?>/"+id,
          type: "GET",
          dataType: "JSON",
          success: function(data){
            for(i=0;i<data.length;i++){
              $('#city').append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
            }
          }
        });
    });
</script> -->

<script>
  $('#client').change(function(){
    var id = $(this).val();
    $('#product').html('<option value="">Select Product</option>');
    $.ajax({
        url: "<?php echo base_url('sales/getProductList') ?>/"+id,
        type: "GET",
        dataType: "JSON",
        success: function(data){
          //console.log(data);
          for(i=0;i<data.length;i++){
            $('#product').append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
          }
        }
    });
  });

  $('#currency').change(function(){
    var symbol = $(this).val().split('|')[1];
    if(symbol == 'BDT'){
      symbol = '‎৳';
    }
    else{
      symbol = '$';
    }

    $('#span_currency').text(symbol);
    $('#span_currency2').text(symbol);
    $('#span_currency3').text(symbol);
  });
</script>

<script>
 $(document).ready(function(){
    var i = 0;
    var product_data = new Array();
    var counter = 1;
    $('#product').change(function(){
      var id = $('#product').val();
      $('#err_product').text('');
      var flag = 0;
      if(id != ""){
        $.ajax({
          url: "<?php echo base_url('sales/getProductAjax') ?>/"+id,
          type: "GET",
          data:{
            '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
          },
          datatype: "JSON",
          success: function(d){
            data = JSON.parse(d);

            $("table.product_table").find('input[name^="product_id"]').each(function () {
              if(data[0].product_id  == +$(this).val()){
                flag = 1;
              }
            });

            if(flag == 0){
              var id = data[0].product_id;
              var code = data[0].code;
              var hsn_sac_code = data[0].hsn_sac_code;
              var name = data[0].name;
              var unit_id = data[0].unit_id;

              var price = data[0].cost
              var product = { "product_id" : id, "cost" : price };

              product_data[i] = product;
              length = product_data.length - 1 ;

              var select_discount = "";
              select_discount += '<div class="form-group">';
              select_discount += '<select class="form-control select2" id="item_discount" name="item_discount" style="width: 100%;">';
              select_discount += '<option value="">Select</option>';
              for(a=0;a<data['discount'].length;a++){
                select_discount += '<option value="' + data['discount'][a].discount_id + '">' + data['discount'][a].discount_name+'('+data['discount'][a].discount_value +'%)'+ '</option>';
              }
              select_discount += '</select></div>';

              var select_shelf = "";
              select_shelf += '<div class="form-group">';
              select_shelf += '<select required class="form-control" id="item_shelf" name="item_shelf" style="width: 100%;">';
                
                var shelf_id;
                var rack_id;
                for(b=0;b<data['shelf'].length;b++){
                  select_shelf += '<optgroup label="' + data['shelf'][b].shelf_name + '">';
                    shelf_id = data['shelf'][b].shelf_id;
                    for(c=0;c<data['rack'].length;c++){
                      if(data['rack'][c].shelf_id == shelf_id){
                        select_shelf += '<option value="' + (shelf_id.concat(.1, data['rack'][c].rack_id)) + '">' + data['rack'][c].rack_name + '</option>';
                      }
                    }
                  select_shelf += '</optgroup>';
                }
              select_shelf += '</select></div>';

              var newRow = $("<tr>");
              var cols = "";
              cols += "<td><a class='deleteRow'> <img src='<?php  echo base_url(); ?>assets/images/bin3.png' /> </a><input type='hidden' name='id' name='id' value="+i+"><input type='hidden' name='product_id' name='product_id' value="+id+"></td>";
              cols += "<td>"+code+"</td>";
              cols += "<td>"+name+"</td>";

              /*  cols += "<td>"+unit_id+"</td>";*/
              /*"<td><input type='hidden' name='unit_id'  value="+unit_id+"><input type='hidden' name='unit_id' name='unit_id' value="+unit_id+"></td>";*/

              cols += "<td><input type='checkbox' id='fop' name='fop' ></td>";

              cols += "<td><input type='hidden' id='shelf_value' name='shelf_value'><input type='hidden' id='hidden_shelf' name='hidden_shelf'>"+select_shelf+"</td>";
              
              if(data[0].pQuantity == null || ((data[0].pQuantity - data[0].ckoQuantity) + +data[0].ckiQuantity) == 0){
                cols += "<td>"
              +"<input type='number' class='form-control text-right' value='0' data-rule='quantity' min='1' name='qty"+ counter +"' id='qty"+ counter +"' required onkeypress='return false;'>"
              +"</td>";
              }
              else{
                cols += "<td>"
                +"<input type='number' class='form-control text-right' value='0' data-rule='quantity' min='1' max='"+ ((data[0].pQuantity - data[0].ckoQuantity) + +data[0].ckiQuantity) +"' name='qty"+ counter +"' id='qty"+ counter +"' >"
                +"</td>";
              }
              
              cols += "<td>"
              +"<span id='product_available_quantity'>"
              +"<input type='number' class='form-control text-right' style='' value='"+ ((data[0].pQuantity - data[0].ckoQuantity) + +data[0].ckiQuantity) +"' name='available_qty' id='available_qty' readonly>"
              +"</span>"
              +"</td>";
              cols += "<td align='right'>" 
              +"<span id='price'>"
              +"<input type='number' class='form-control text-right' name='price"+ counter +"' id='price"+ counter +"' value='0.00'></span>"
              +"</td>";
              cols += "<td>"
              +"<span id='sub_total'>"
              +"<input type='number' class='form-control text-right' style='' value='0.00' name='linetotal"+ counter +"' id='linetotal"+ counter +"' readonly>"
              +"</span>"
              +"</td>";

              /*cols += '<td><input type="hidden" id="discount_value" name="discount_value"><input type="hidden" id="hidden_discount" name="hidden_discount">'+select_discount+'</td>';
              cols += '<td align="right"><span id="taxable_value"></span></td>';
              cols += '<td><input type="hidden" id="tax_value" name="tax_value"><input type="hidden" id="hidden_tax" name="hidden_tax">'+select_tax+'</td>';
              cols += '<td><input type="text" class="form-control text-right" id="product_total" name="product_total" readonly></td>';*/

              cols += "</tr>";
              counter++;

              newRow.append(cols);
              $("table.product_table").append(newRow);
              var table_data = JSON.stringify(product_data);
              $('#table_data').val(table_data);
              i++;
            }
            else{
              $('#err_product').text('Product Already Added').animate({opacity: '0.0'}, 2000).animate({opacity: '0.0'}, 1000).animate({opacity: '1.0'}, 2000);
            }

            /*var quantity = $('input[name^="quantity"]').val();
            var price = $('input[name^="price"]').val();*/
          },
          error: function(xhr, status, error) {
            $('#err_product').text('Enter Product Code / Name').animate({opacity: '0.0'}, 2000).animate({opacity: '0.0'}, 1000).animate({opacity: '1.0'}, 2000);
          }
        });
      }
    });
    
    $("table.product_table").on("click", "a.deleteRow", function (event) {
      deleteRow($(this).closest("tr"));
      $(this).closest("tr").remove();
      calculateGrandTotal();
    });

    $("table.product_table").on("click", "a.deleteRow1", function (event) {
      deleteRow1($(this).closest("tr"));
      $(this).closest("tr").remove();
      calculateGrandTotal();
    });

    function deleteRow(row){
      var id = +row.find('input[name^="id"]').val();
      var array_id = product_data[id].product_id;
      product_data[id] = null;
      var table_data = JSON.stringify(product_data);
      $('#table_data').val(table_data);
    }

    $("table.product_table").on("keyup change", 'input[name^="price"], input[name^="qty"]', function (event) {
      calculateRow($(this).closest("tr"));
      calculateDiscountTax($(this).closest("tr"));
      calculateGrandTotal();
    });

    $("table.product_table").on("change",'input[id^="fop"]',function (event) {
      makeDisable($(this).closest("tr"));
    });

    function makeDisable(row){
      var fop = +row.find('input[id^="fop"]').is(':checked');
      
      if(fop){
        var zero = 0;
        +row.find('input[id^="price"]').attr('readonly', 'true');
        row.find('input[id^="price"]').val(zero.toFixed(2));
        row.find('input[id^="linetotal"]').val(zero.toFixed(2));
        
        calculateGrandTotal();
      }
      else{
        +row.find('input[id^="price"]').removeAttr('readonly');
      }
    }

    $("table.product_table").on("change","#item_shelf",function (event) {
      availableQty($(this).closest("tr"));
    });

    function availableQty(row){
      var product_id = +row.find('input[name^="product_id"]').val();
      var shelf_and_rack_id = +row.find('#item_shelf').val();
      var av_quantity;

      $.ajax({
        url: "<?php echo base_url('sales/getAvailableQty') ?>/"+product_id+'/'+shelf_and_rack_id,
        type: "GET",
        dataType: "JSON",
        async: false,
        success: function (response) {
          //console.log(response);
          row.find('input[id^="available_qty"]').val(response.data[0].available_qty);
          av_quantity = response.data[0].available_qty;
        }
      });

      if(av_quantity == null || av_quantity == 0){
        +row.find('input[id^="qty"]').attr({'required': "true", 'onkeypress': 'return false'});
        row.find('input[id^="qty"]').val(0);
      }

      else{
        +row.find('input[id^="qty"]').attr({'required': "false", 'onkeypress': 'return true'});
      }
    }

    function calculateDiscountTax(row,data = 0,data1 = 0){
      var discount;
      var tax;
      if(data == 0 ){
        discount = +row.find('#discount_value').val();
      }
      else{
        discount = data;
      }
      if(data1 == 0 ){
        tax = +row.find('#tax_value').val();
      }
      else{
        tax = data1;
      }
      var sales_total = +row.find('input[name^="linetotal"]').val();
      var total_discount = sales_total*discount/100;
      var taxable_value = sales_total - total_discount;
      row.find('#taxable_value').text(taxable_value);
      var total_tax = taxable_value*tax/100;
      row.find('#product_total').val(taxable_value + total_tax);

      row.find('#hidden_discount').val(total_discount);
      row.find('#hidden_tax').val(total_tax);

      var key = +row.find('input[name^="id"]').val();
      product_data[key].discount = total_discount;
      product_data[key].discount_value = +row.find('#discount_value').val();
      product_data[key].discount_id = +row.find('#item_discount').val();
      product_data[key].tax = total_tax;
      product_data[key].shelf_value = +row.find('#shelf_value').val();
      product_data[key].shelf_and_rack_id = +row.find('#item_shelf').val();
      var table_data = JSON.stringify(product_data);
      $('#table_data').val(table_data);
    }
    
    function calculateRow(row) {
      var key = +row.find('input[name^="id"]').val();
      var fop = +row.find('input[name^="fop"]').is(':checked');
      var price = +row.find('input[name^="price"]').val();
      var shelf_and_rack_id = +row.find('#item_shelf').val();
      var qty = +row.find('input[name^="qty"]').val();
      var product_id = +row.find('input[name^="product_id"]').val();
      var sales_type = 'Inventory';
      row.find('input[name^="linetotal"]').val((price * qty).toFixed(2));

      if(product_data[key]==null/* || product_data[fop]==null*/){
        var temp = {
          "product_id" : product_id,
          "shelf_and_rack_id" : shelf_and_rack_id,
          "quantity" : qty,
          "total" : (price * qty).toFixed(2),
          "sales_type" : sales_type
        };
        product_data[key] = temp;
      }

      product_data[key].quantity = qty;
      product_data[key].total = (price * qty).toFixed(2);
      var table_data = JSON.stringify(product_data);
      $('#table_data').val(table_data);
      // alert(table_data);
      //console.log(temp);
    }

    function calculateGrandTotal() {
      var totalValue = 0.00;    

      var totalDiscount = 0;
      var grandTax = 0;
      var grandTotal = 0;
      $("table.product_table").find('input[name^="linetotal"]').each(function () {
        totalValue += +$(this).val();
      });
      $("table.product_table").find('input[name^="hidden_discount"]').each(function () {
        totalDiscount += +$(this).val();
      });
      $("table.product_table").find('input[name^="hidden_tax"]').each(function () {
        grandTax += +$(this).val();
      });
      $("table.product_table").find('input[name^="product_total"]').each(function () {
        grandTotal += +$(this).val();
      });
      $('#totalValue').text(totalValue.toFixed(2));
      $('#total_value').val(totalValue.toFixed(2));
      $('#total_value2').val(totalValue.toFixed(2));
      $('#totalDiscount').text(totalDiscount.toFixed(2));
      $('#total_discount').val(totalDiscount.toFixed(2));
      $('#totalTax').text(grandTax.toFixed(2));
      $('#total_tax').val(grandTax.toFixed(2));
      $('#grandTotal').text(grandTotal.toFixed(2));
      $('#grand_total').val(grandTotal.toFixed(2));
    }
  });
</script>

<script>
  $(document).ready(function(){
    $('.courierCls').click(function(){
      if($('#courier').is(':checked')){ 
        $('.courierSelect').show();
      }
      else { 
        $('.courierSelect').hide();
      }
    });

    $('#form').submit(function(){
      var name_regex = /^[a-zA-Z]+$/;
      var sname_regex = /^[a-zA-Z0-9]+$/;
      var num_regex = /^[0-9]+$/;
      var date_regex = /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
      var date = $('#date').val();
      var currency = $('#currency').val();
      var client = $('#client').val();
      var product = $('#product').val();
      var grand_total = $('#grand_total').val();

      var selected_procuct = '<?php if(isset($selected_product)){ echo 'available'; } ?>';
      if(selected_procuct == 'available'){
        product = 'availabe';
      }

      if(date==null || date==""){
        $("#err_date").text("Please Enter Date");
        $('#date').focus();
        return false;
      }
      else{
        $("#err_date").text("");
      }
      if (!date.match(date_regex) ) {
        $('#err_date').text(" Please Enter Valid Date ");   
        $('#date').focus();
        return false;
      }
      else{
        $("#err_date").text("");
      }
      //date codevalidation complite.

      if(client==""){
        $("#err_client").text("Please Enter Customer");
        $('#client').focus();
        return false;
      }
      else{
        $("#err_client").text("");
      }
      //client validation complite.

      if(currency==""){
        $("#err_currency").text("Please Enter Currency");
        $('#currency').focus();
        return false;
      }
      else{
        $("#err_currency").text("");
      }
      //currency validation complite.

      if(product==""){
        $("#err_product").text("Please Enter Product");
        $('#product').focus();
        return false;
      }
      else{
        $("#err_product").text("");
      }
      //product code validation complite.

      /*if(warehouse==""){
        $("#err_warehouse").text("Please Enter Warehouse");
        $('#warehouse').focus();
        return false;
      }
      else{
        $("#err_warehouse").text("");
      }*/
      //warehouse code validation complite.

      /*if(supplier==""){
        $("#err_supplier").text("Please Enter supplier");
        $('#supplier').focus();
        return false;
      }
      else{
        $("#err_supplier").text("");
      }*/
      //supplier validation complite.

      $(this).find(':button[type=submit]').prop('disabled', true);
      $('.button').css('cursor', 'default');
      $('.button').toggleClass('active');
    }); 

    $("#date").change(function(event){
      var date = $('#date').val(); 
      var date_regex = /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
      if(date==null || date==""){
        $("#err_date").text("Please Enter Date. ");
        $('#date').focus();
        return false;
      }
      else{
        $("#err_date").text("");
      }
      if (!date.match(date_regex) ) {
        $('#err_date').text(" Please Enter Valid Date. ");   
        $('#date').focus();
        return false;
      }
      else{
        $("#err_date").text("");
      }
    });
    $("#client").change(function(event){
      var client = $('#client').val();
      if(client==""){
        $("#err_client").text("Select the Customer. ");
        return false;
      }
      else{
        $("#err_client").text("");
      }
    });
    $("#currency").change(function(event){
      var currency = $('#currency').val();
      if(currency==""){
        $("#err_currency").text("Select the Currency. ");
        return false;
      }
      else{
        $("#err_currency").text("");
      }
    });
    $("#product").change(function(event){
      var product = $('#product').val();
      if(product==""){
        $("#err_product").text("Select the Product. ");
        return false;
      }
      else{
        $("#err_product").text("");
      }
    });
    /*$("#warehouse").change(function(event){
      var warehouse = $('#warehouse').val();
      if(warehouse==""){
        $("#err_warehouse").text("Please Enter Warehouse");
        $('#warehouse').focus();
        return false;
      }
      else{
        $("#err_warehouse").text("");
      }
    });*/
    /*$("#supplier").change(function(event){
      var supplier = $('#supplier').val();
      if(supplier==""){
        $("#err_supplier").text("Please Enter Supplier");
        $('#supplier').focus();
        return false;
      }
      else{
        $("#err_supplier").text("");
      }
    });*/
  }); 
</script>