<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','manager');
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
        window.location.href='<?php  echo base_url('warehouse/delete/'); ?>'+id;
     }
  }
</script>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
         <ol class="breadcrumb">
          <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-dashboard"></i> 
                <!-- Dashboard -->
                <?php echo $this->lang->line('header_dashboard'); ?></a></li>
          <li class="active"><!-- Warehouse -->
                  <?php echo $this->lang->line('warehouse_header'); ?>
                    
          </li>
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
              <h3 class="box-title"><!-- List Warehouse -->
                <?php echo $this->lang->line('warehouse_label'); ?>
              </h3>
              <a class="btn btn-sm btn-info pull-right" style="margin: 10px" href="<?php echo base_url('warehouse/add');?>" title="Add New Category" onclick="">
                  <!-- Add New Warehouse -->
                <?php echo $this->lang->line('warehouse_btn_new'); ?>
              </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="index" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><!-- No -->
                      <?php echo $this->lang->line('warehouse_label_no'); ?>
                  </th>
                  <th><!-- Warehose Name -->
                      <?php echo $this->lang->line('warehouse_label_wname'); ?>
                  </th>
                  <th><!-- Branch Name -->
                      <?php echo $this->lang->line('warehouse_label_bname'); ?>
                  </th>
                  <th><!-- User Name -->
                      <?php echo $this->lang->line('warehouse_label_uname'); ?>
                  </th>
                  <th><!-- Actions -->
                      <?php echo $this->lang->line('warehouse_label_action'); ?>
                  </th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                      foreach ($data as $row) {
                         $id= $row->warehouse_id;
                    ?>
                    <tr>
                      <td></td>
                      <td><?php echo $row->warehouse_name; ?></td>
                      <td><?php echo $row->branch_name; ?></td>
                      <td><?php echo $row->first_name.' '.$row->last_name; ?></td>
                      <td>
                          <!-- <a href="" title="View Details" class="btn btn-xs btn-warning"><span class="fa fa-eye"></span></a>&nbsp;&nbsp; -->
                          <a href="<?php echo base_url('warehouse/edit/'); ?><?php echo $id; ?>" title="Edit" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;
                          <a href="javascript:delete_id(<?php echo $id;?>)" title="Delete" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                    <?php
                      }
                    ?>
                <tfoot>
                <tr>
                  <th><!-- No -->
                      <?php echo $this->lang->line('warehouse_label_no'); ?>
                  </th>
                  <th><!-- Warehose Name -->
                      <?php echo $this->lang->line('warehouse_label_wname'); ?>
                  </th>
                  <th><!-- Branch Name -->
                      <?php echo $this->lang->line('warehouse_label_bname'); ?>
                  </th>
                  <th><!-- User Name -->
                      <?php echo $this->lang->line('warehouse_label_uname'); ?>
                  </th>
                  <th><!-- Actions -->
                      <?php echo $this->lang->line('warehouse_label_action'); ?>
                  </th>
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
