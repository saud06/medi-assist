<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('layout/header');
?>
<script type="text/javascript">
  function delete_id(id)
  {
     if(confirm('Sure To Remove This Record ?'))
     {
        window.location.href='<?php  echo base_url('accountgroup/delete/'); ?>'+id;
     }
  }
</script>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
         <ol class="breadcrumb">
          <li><a href="<?php echo base_url('auth/dashboard'); ?>" class="text-black"><i class="fa fa-dashboard">&nbsp;</i><strong><?php echo $this->lang->line('header_dashboard'); ?></strong></a></li>
          <li class="active">Account Group <!-- <?php echo $this->lang->line('branch_label'); ?> --></li>
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
              <h3 class="box-title"><!-- List Branch --></h3>
              <a class="btn btn-sm btn-info pull-right" style="margin: 10px" href="<?php echo base_url('accountgroup/add');?>" title="Add New Branch" onclick="">New Account Group <!-- <?php echo $this->lang->line('branch_label_newbranch'); ?> --></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="index" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Account Group No</th>
                  <th>Branch</th>
                  <th>Group Title</th>
                  <th>Category</th>
                  <th>Opening Balance</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                    foreach ($data as $row) {
                       $id= $row->id;
                  ?>
                  <tr>
                    <td></td>
                    <td><?php echo $row->branch_name; ?></td>
                    
                    <td><?php echo $row->group_title; ?></td>
                    <td><?php echo $row->category; ?></td>
                    <td align="right"><?php echo $this->session->userdata('symbol').$row->opening_balance; ?></td>
                    <td>
                        <!-- <a href="" title="View Details" class="btn btn-xs btn-warning"><span class="fa fa-eye"></span></a>&nbsp;&nbsp; -->
                        <a href="<?php echo base_url('accountgroup/edit/'); ?><?php echo $id; ?>" title="Edit" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;
                        <a href="javascript:delete_id(<?php echo $id;?>)" title="Delete" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                    </td>
                  <?php
                    }
                  ?>
                <tfoot>
                <tr>
                  <th>Account Group No</th>
                  <th>Branch</th>
                  <th>Group Title</th>
                  <th>Category</th>
                  <th>Opening Balance</th>
                  <th>Actions</th>
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
