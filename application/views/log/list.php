<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','manager');
if(!(in_array($this->session->userdata('type'),$p))){
  redirect('auth');
}
$this->load->view('layout/header');
?>
<div class="content-wrapper">
  <?php 
    // $this->load->view('layout/sticky_note');
  ?>
  
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
         <ol class="breadcrumb">
          <li><a href="<?php echo base_url('auth/dashboard'); ?>" class="text-black"><i class="fa fa-dashboard">&nbsp;</i><strong><?php echo $this->lang->line('header_dashboard'); ?></strong></a></li>
          <li class="active">Logs <!-- <?php echo $this->lang->line('branch_label'); ?> --></li>
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
              <h3 class="box-title">Logs</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body outer-scroll">
              <div class="inner-scroll">
                <table id="log_datatable" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No.</th>
                    <th>Date and Time</th>
                    <th>USER</th>
                    <th>Event</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                      foreach ($data as $row) {
                    ?>
                    <tr>
                        <td></td>
                        <td><?php echo $row->timestamp;?></td>
                        <td><?php echo $row->first_name.' '.$row->last_name;?></td>
                        <td><?php echo $row->message;?></td>
                    </tr>
                    <?php
                      }
                    ?>
                  <tfoot>
                    <tr>
                      <th>No.</th>
                      <th>Date and Time</th>
                      <th>USER</th>
                      <th>Event</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
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
