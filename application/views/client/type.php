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
        window.location.href='<?php  echo base_url('client/deleteType/'); ?>'+id;
     }
  }
</script>
<div class="content-wrapper">
  <?php 
    // $this->load->view('layout/sticky_note');
  ?>

  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
         <ol class="breadcrumb">
          <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-dashboard"></i>
                 <!-- Dashboard -->
                Dashboard
              </a>
          </li>
          <li><a href="<?php echo base_url('client'); ?>" class="text-black">
              <!-- Client -->
              <strong>Client</strong></a>
          </li>
          <li class="active"><!-- Client Type -->
              Client Type
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
              <h3 class="box-title">
                <!-- List Client -->
                Client Type
              </h3>
              <a class="btn bg-gray" style="margin: 10px" href="<?php echo base_url('client/addType');?>"> 
                  <!-- Add New Client -->
                  Add Client Type  
               </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="index" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><!-- No -->
                      No.
                  </th>
                  <th><!-- Name -->
                      Name
                  </th>
                  <th><!-- Status -->
                      Status
                  </th>
                  <th><!-- Actions -->
                      Action
                  </th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                      foreach ($data as $row) {
                         $id = $row->client_type_id;
                    ?>
                    <tr>
                      <td></td>
                      <td><?php echo $row->name; ?></td>
                      <td><?php echo $row->status; ?></td>
                      <td>
                          <!-- <a href="" title="View Details" class="btn btn-xs btn-warning"><span class="fa fa-eye"></span></a>&nbsp;&nbsp; -->
                          <a href="<?php echo base_url('client/editType/'); ?><?php echo $id; ?>" title="Edit" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;
                          <a href="javascript:delete_id(<?php echo $id;?>)" title="Delete" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                      </td>
                    <?php
                      }
                    ?>
                <tfoot>
                <tr>
                  <th><!-- No -->
                      No.
                  </th>
                  <th><!-- Name -->
                      Name
                  </th>
                  <th><!-- Status -->
                      Status
                  </th>
                  <th><!-- Actions -->
                      Action
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
