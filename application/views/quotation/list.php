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
     if(confirm('<?php echo $this->lang->line('product_delete_conform'); ?>'))
     {
        window.location.href='<?php  echo base_url('quotation/delete/'); ?>'+id;
     }
  }
</script>
<div class="content-wrapper">
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
              <h3 class="box-title">Quotation List</h3>
              <a class="btn btn-sm btn-info pull-right" style="margin: 10px" href="<?php echo base_url('quotation/add');?>">Add New Quotation</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="index" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><?php echo $this->lang->line('product_no'); ?></th>
                  <th><?php echo $this->lang->line('purchase_date'); ?></th>
                  <th><?php echo $this->lang->line('purchase_reference_no'); ?></th>
                  <th><?php echo $this->lang->line('sales_biller'); ?></th>
                  <th><?php echo $this->lang->line('sales_client'); ?></th>
                  <th><?php echo $this->lang->line('purchase_grand_total'); ?></th>
                  <th><?php echo $this->lang->line('product_action'); ?></th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                      foreach ($data as $row) {
                         $id= $row->quotation_id;
                    ?>
                    <tr>
                      <td></td>
                      <td><?php echo $row->date; ?></td>
                      <td><?php echo $row->reference_no; ?></td>
                      <td><?php echo $row->biller_name ?></td>
                      <td><?php echo $row->client_name ?></td>
                      <td align="right"><?php echo $this->session->userdata('symbol').($row->total+$row->shipping_charge) ?></td>
                      </td>
                      <td>
                          <div class="dropdown">
                            <button type="button" class="btn btn-default gropdown-toggle" data-toggle="dropdown">
                              <?php echo $this->lang->line('product_action'); ?>
                              <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-right">
                              <li>
                                <a href="<?php echo base_url('quotation/view/');?><?php echo $id; ?>"><i class="fa fa-file-text-o"></i>Quotation Details</a>
                              </li>
                              <?php if($row->sales_id==null){ ?>
                              <li>
                                <a href="<?php echo base_url('quotation/edit/'); ?><?php echo $id; ?>"><i class="fa fa-edit"></i>Edit Quotation</a>
                              </li>
                              <?php } ?>
                              <li>
                                <a href="<?php echo base_url('quotation/pdf/');?><?php echo $id; ?>" target="_blank  "><i class="fa fa-file-pdf-o"></i><?php echo $this->lang->line('purchase_download_as_pdf'); ?></a>
                              </li>
                              <li>
                                <a href="<?php echo base_url('quotation/email/'); ?><?php echo $id; ?>"><i class="fa fa-envelope"></i><?php echo $this->lang->line('sales_email_sales'); ?></a>
                              </li>
                              <li>
                                <a href="javascript:delete_id(<?php echo $id;?>)"><i class="fa fa-trash-o"></i><?php echo $this->lang->line('sales_delete_sales'); ?></a>
                              </li>
                            </ul>
                          </div>
                      </td>
                    <?php
                      }
                    ?>
                <tfoot>
                <tr>
                  <th><?php echo $this->lang->line('product_no'); ?></th>
                  <th><?php echo $this->lang->line('purchase_date'); ?></th>
                  <th><?php echo $this->lang->line('purchase_reference_no'); ?></th>
                  <th><?php echo $this->lang->line('sales_biller'); ?></th>
                  <th><?php echo $this->lang->line('sales_client'); ?></th>
                  <th><?php echo $this->lang->line('purchase_grand_total'); ?></th>
                  <th><?php echo $this->lang->line('product_action'); ?></th>
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
