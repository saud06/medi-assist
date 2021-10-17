<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','accountant','manager');
if(!(in_array($this->session->userdata('type'),$p))){
  redirect('auth');
}
$this->load->view('layout/header');
?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
         <ol class="breadcrumb">
          <li><a href="<?php echo base_url('auth/dashboard'); ?>" class="text-black"><i class="fa fa-dashboard">&nbsp;</i><strong><?php echo $this->lang->line('header_dashboard'); ?></strong></a></li>
          <li class="active"><?php echo $this->lang->line('reports_sales_return_reports'); ?></li>
        </ol>
      </h5> 
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
      <!-- right column -->
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header with-border">
            <div class="control-group">
              <div class="controls">
                <input type="submit" class="btn btn-info" id="hide1" name="submit" value="<?php echo $this->lang->line('reports_hide_show'); ?>">
              </div>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row hide1">
              <form target="" id="edit-profile" method="post" action="<?php echo base_url('reports/sales_return_report');?>">
                <div class="col-md-6">

                  <div class="form-group">
                    <label for="reference_no"><?php echo $this->lang->line('purchase_reference_no'); ?></label>
                    <input type="text" class="form-control" id="reference_no" name="reference_no" value="" >
                    <span class="validation-color" id="err_reference_no"><?php echo form_error('reference_no'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="warehouse"><?php echo $this->lang->line('purchase_select_warehouse'); ?></label>
                    <select class="form-control select2" id="warehouse" name="warehouse" style="width: 100%;">
                      <option value=""><?php echo $this->lang->line('product_select'); ?></option>
                      <?php

                        foreach ($warehouse as $row) {
                          echo "<option value='$row->warehouse_id'".set_select('warehouse_id',$row->warehouse_id).">$row->warehouse_name</option>";
                        }
                      ?>
                    </select>
                    <span class="validation-color" id="err_warehouse"><?php echo form_error('warehouse'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="biller"><?php echo $this->lang->line('sales_select_biller'); ?></label>
                    <select class="form-control select2" id="biller" name="biller" style="width: 100%;">
                      <option value=""><?php echo $this->lang->line('product_select'); ?></option>
                      <?php

                        foreach ($biller as $row) {
                          echo "<option value='$row->biller_id'".set_select('biller_id',$row->biller_id).">$row->biller_name</option>";
                        }
                      ?>
                    </select>
                    <span class="validation-color" id="err_biller"><?php echo form_error('biller'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="client"><?php echo $this->lang->line('sales_select_client'); ?></label>
                    <select class="form-control select2" id="client" name="client" style="width: 100%;">
                      <option value=""><?php echo $this->lang->line('product_select'); ?></option>
                      <?php

                        foreach ($client as $row) {
                          echo "<option value='$row->client_id'".set_select('client_id',$row->client_id).">$row->client_name</option>";
                        }
                      ?>
                    </select>
                    <span class="validation-color" id="err_client"><?php echo form_error('client'); ?></span>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="discount">Select Discount </label>
                    <select class="form-control select2" id="discount" name="discount" style="width: 100%;">
                      <option value=""><?php echo $this->lang->line('product_select'); ?></option>
                      <?php

                        foreach ($discount as $row) {
                          echo "<option value='$row->discount_id'".set_select('discount_id',$row->discount_id).">$row->discount_name</option>";
                        }
                      ?>
                    </select>
                    <span class="validation-color" id="err_biller"><?php echo form_error('discount'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="user"><?php echo $this->lang->line('reports_created_by'); ?></label>
                    <select class="form-control select2" id="user" name="user" style="width: 100%;">
                      <option value=""><?php echo $this->lang->line('product_select'); ?></option>
                      <?php
                        foreach ($user as $value) {
                      ?>
                          <option value="<?php echo $value->id; ?>"><?php echo $value->first_name." ".$value->last_name ?></option>
                      <?php
                        }
                      ?>
                    </select>
                    <span class="validation-color" id="err_user"><?php echo form_error('user'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="start_date"><?php echo $this->lang->line('reports_start_date'); ?></label>
                    <input type="text" class="form-control datepicker" id="start_date" name="start_date" value="">
                    <span class="validation-color" id="err_start_date"><?php echo form_error('start_date'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="end_date"><?php echo $this->lang->line('reports_end_date'); ?></label>
                    <input type="text" class="form-control datepicker" id="end_date" name="end_date" value="<?php echo date("Y-m-d");  ?>">
                    <span class="validation-color" id="err_end_date"><?php echo form_error('end_date'); ?></span>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="box-footer">
                    <input type="submit" class="btn btn-info" id="submit" name="submit" value="Submit">
                  </div>
                </div>
              
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $this->lang->line('reports_sales_return_reports'); ?></h3>
              <input type="submit" class="pull-right btn btn-info btn-flat" id="pdf" name="submit" value="<?php echo $this->lang->line('product_alert_pdf'); ?>">
              <input type="submit" class="pull-right btn btn-info btn-flat" id="csv" name="submit" value="CSV">
              <input type="submit" class="pull-right btn btn-info btn-flat" id="print" name="submit" value="Print">
            </div></form>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="index" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><?php echo $this->lang->line('product_no'); ?></th>
                  <th><?php echo $this->lang->line('purchase_date'); ?></th>
                  <th><?php echo $this->lang->line('purchase_reference_no'); ?></th>
                  <th><?php echo $this->lang->line('reports_biller'); ?></th>
                  <th><?php echo $this->lang->line('reports_client'); ?></th>
                  <th><?php echo $this->lang->line('reports_product_qty'); ?></th>
                  <th><?php echo $this->lang->line('purchase_total'); ?></th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                      foreach ($sales_return as $row) {
                    ?>
                    <tr>
                      <td></td>
                      <td><?php echo $row->date; ?></td>
                      <td><?php echo $row->reference_no; ?></td>
                      <td><?php echo $row->biller_name; ?></td>
                      <td><?php echo $row->client_name; ?></td>
                      <td>
                        <?php
                          foreach ($sales_return_items as $value) {
                            foreach ($products as $key) {
                              if($row->id == $value->sale_return_id){
                                if($value->product_id == $key->product_id){
                                  echo $key->name."(".$value->quantity.")<br>";
                                }
                                
                              }
                            }
                          }
                        ?>
                          
                      </td>
                      <td><?php echo $this->session->userdata('symbol').$row->total; ?></td>
                    <?php
                      }
                    ?>
                <tfoot>
                <tr>
                  <th><?php echo $this->lang->line('product_no'); ?></th>
                  <th><?php echo $this->lang->line('purchase_date'); ?></th>
                  <th><?php echo $this->lang->line('purchase_reference_no'); ?></th>
                  <th><?php echo $this->lang->line('reports_biller'); ?></th>
                  <th><?php echo $this->lang->line('reports_client'); ?></th>
                  <th><?php echo $this->lang->line('reports_product_qty'); ?></th>
                  <th><?php echo $this->lang->line('purchase_total'); ?></th>
                </tr>
                </tfoot>
              </table>
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
<script type="text/javascript">
  $(document).ready(function(){
    $('#pdf').click(function(){
      $('form').attr('target','_blank');
    });
    $('#csv').click(function(){
      $('form').attr('target','_blank');
    });
     $('#print').click(function(){
      $('form').attr('target','_blank');
    });
    $('#submit').click(function(){
      $('form').attr('target','');
    });
  });
  $("#hide1").click(function(){
    $(".hide1").toggle();
  });
</script>
<script type="text/javascript">
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
</script>
