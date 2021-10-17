<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->view('layout/header');
?>
<script type="text/javascript">
  function delete_id(id)
  {
     if(confirm('Sure To Remove This Record ?'))
     {
        window.location.href='<?php  echo base_url('transfer/delete/'); ?>'+id;
     }
  }
</script>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
         <ol class="breadcrumb">
          <li><a href="<?php echo base_url('auth'); ?>"><i class="fa fa-dashboard"></i><?php echo $this->lang->line('header_dashboard'); ?></a></li>
          <li class="active"><?php echo $this->lang->line('transfer_transfers'); ?></li>
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
              <h3 class="box-title"><?php echo $this->lang->line('transfer_listtransfers'); ?></h3>
              <a class="btn btn-sm btn-info pull-right" style="margin: 10px" href="<?php echo base_url('transfer/add');?>" title="Add New Transfer" onclick=""><?php echo $this->lang->line('transfer_add_new_transfer'); ?></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="index" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><?php echo $this->lang->line('transfer_no'); ?></th>
                  <th><?php echo $this->lang->line('transfer_date'); ?></th>
                  <th><?php echo $this->lang->line('transfer_warehouse_from'); ?></th>
                  <th><?php echo $this->lang->line('transfer_warehouse_to'); ?></th>
                  <th><?php echo $this->lang->line('transfer_total'); ?></th>
                  <th><?php echo $this->lang->line('transfer_actions'); ?></th>
                </tr>
                </thead>
                <tbody>
                    <?php 
                      foreach ($data as $row) {
                        $id= $row->id;
                    ?>
                    <tr>
                      <td></td>
                      <td><?php echo $row->date; ?></td>
                      <td><?php echo $row->from_warehouse_name; ?></td>
                      <td><?php echo $row->to_warehouse_name; ?></td>
                      <td><?php echo $this->session->userdata('symbol').$row->total; ?></td>
                      <td>
                          <!-- <a href="" title="View Details" class="btn btn-xs btn-warning"><span class="fa fa-eye"></span></a>&nbsp;&nbsp; -->
                          <a href="<?php echo base_url('transfer/edit/'); ?><?php echo $id; ?>" title="Edit" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;
                          <a href="javascript:delete_id(<?php echo $id;?>)" title="Delete" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                      </td>
                    </tr>
                    <?php
                      }
                    ?>
                <tfoot>
                <tr>
                  <th><?php echo $this->lang->line('transfer_no'); ?></th>
                  <th><?php echo $this->lang->line('transfer_date'); ?></th>
                  <th><?php echo $this->lang->line('transfer_warehouse_from'); ?></th>
                  <th><?php echo $this->lang->line('transfer_warehouse_to'); ?></th>
                  <th><?php echo $this->lang->line('transfer_total'); ?></th>
                  <th><?php echo $this->lang->line('transfer_actions'); ?></th>
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