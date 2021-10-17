<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','purchaser','manager');
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
          <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li><a href="<?php echo base_url('purchase'); ?>">List Purchase</a></li>
          <li class="active">Add Purchase</li>
        </ol>
      </h5>    
    </section>

  <!-- Main content -->
    <section class="content">
      <div class="row">
      <!-- right column -->
        <div class="col-md-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Add New Purchase</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <form role="form" id="form" method="post" action="<?php echo base_url('purchase/addPurchase');?>">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="date">Date<span class="validation-color">*</span></label>
                    <input type="text" class="form-control datepicker" id="date" name="date" value="<?php echo date("Y-m-d");  ?>">
                    <span class="validation-color pull-right" id="err_date"><?php echo form_error('date'); ?></span>
                  </div>

                  <?php
                    if($p_reference_no==null){
                        $no = sprintf('%06d',intval(1));
                    }
                    else{
                      foreach ($p_reference_no as $value) {
                        $no = sprintf('%06d',intval($value->id)+1); 
                      }
                    }
                  ?>
                  <div class="form-group">
                    <label for="reference_no">Reference No<span class="validation-color">*</span></label>
                    <input type="text" class="form-control" id="reference_no" name="reference_no" value="PM-<?php echo $no;?>" readonly>
                    <span class="validation-color" id="err_reference_no"><?php echo form_error('reference_no'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="reference_no">Amount<span class="validation-color">*</span></label>
                    <input type="text" class="form-control" id="reference_no" name="reference_no" value="<?php echo $data[0]->total;?>" readonly>
                    <span class="validation-color" id="err_reference_no"><?php echo form_error('reference_no'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="warehouse">Paying By <span class="validation-color">*</span></label>
                    <select class="form-control select2" id="warehouse" name="warehouse" style="width: 100%;">
                      <option value="">Select</option>
                      <option>Cash</option>
                      <option>PayPal</option>
                      <option>PayTm</option>
                      <option>Debit Card</option>
                      <option>Credit Card</option>
                      <option>Gift Card</option>
                      <option>Cheque</option>
                    </select>
                    <span class="validation-color" id="err_warehouse"><?php echo form_error('warehouse'); ?></span>
                  </div>

                </div>
                <div class="col-md-12">
                  <div class="form-group">
                      <label for="note">Note </label>
                      <textarea class="form-control" id="note" name="note"><?php echo set_value('details'); ?></textarea>
                      <span class="validation-color" id="err_details"><?php echo form_error('details'); ?></span>
                    </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="box-footer">
                    <button type="submit" id="submit" class="btn btn-primary">Pay</button>
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
  <?php
    $this->load->view('layout/footer');
  ?>