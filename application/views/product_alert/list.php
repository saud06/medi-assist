<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','manager','purchaser');
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
          <li><a href="<?php echo base_url('auth'); ?>"><i class="fa fa-dashboard"></i> <?php echo $this->lang->line('header_dashboard'); ?></a></li>
          <li class="active"><?php echo $this->lang->line('header_product_alert'); ?></li>
        </ol>
      </h5> 
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
      <!-- right column -->
      <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $this->lang->line('header_list_product_alert'); ?></h3>
              <a class="btn btn-sm btn-info pull-right" style="margin: 10px" href="<?php echo base_url('product_alert/create_pdf');?>" target="_new" title="PDF"> &nbsp;<?php echo $this->lang->line('product_alert_pdf'); ?>&nbsp; </a>
              <a class="btn btn-sm btn-info pull-right" style="margin: 10px" href="<?php echo base_url('product_alert/create_csv');?>" target="_new" title="PDF"> &nbsp;CSV&nbsp; </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="index" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><?php echo $this->lang->line('product_no'); ?></th>
                  <th><?php echo $this->lang->line('product_code'); ?></th>
                  <th><?php echo $this->lang->line('product_name'); ?></th>
                  <th><?php echo $this->lang->line('product_category'); ?></th>
                  <th><?php echo $this->lang->line('product_cost'); ?></th>
                  <th><?php echo $this->lang->line('product_price'); ?></th>
                  <th><?php echo $this->lang->line('product_unit'); ?></th>
                  <th><?php echo $this->lang->line('product_quantity'); ?></th>
                  <th><?php echo $this->lang->line('product_alert_quantity'); ?></th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                      foreach ($data as $row) {
                         $id= $row->product_id;
                    ?>
                    <tr>
                      <td></td>
                      <td><?php echo $row->code; ?></td>
                      <td><?php echo $row->name; ?></td>
                      <td><?php echo $row->cname; ?></td>
                      <td align="right"><?php echo $this->session->userdata('symbol').$row->cost;?></td>
                      <td align="right"><?php echo $this->session->userdata('symbol').$row->price;?></td>
                      <td><?php echo $row->unit; ?></td>
                      <td><?php echo $row->quantity; ?></td>
                      <td><?php echo $row->alert_quantity; ?></td>
                    </tr>
                    <?php
                      }
                    ?>
                <tfoot>
                <tr>
                  <th><?php echo $this->lang->line('product_no'); ?></th>
                  <th><?php echo $this->lang->line('product_code'); ?></th>
                  <th><?php echo $this->lang->line('product_name'); ?></th>
                  <th><?php echo $this->lang->line('product_category'); ?></th>
                  <th><?php echo $this->lang->line('product_cost'); ?></th>
                  <th><?php echo $this->lang->line('product_price'); ?></th>
                  <th><?php echo $this->lang->line('product_unit'); ?></th>
                  <th><?php echo $this->lang->line('product_quantity'); ?></th>
                  <th><?php echo $this->lang->line('product_alert_quantity'); ?></th>
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
