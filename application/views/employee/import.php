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
          <li><a href="<?php echo base_url('employee'); ?>" class="text-black"><strong>Employee</strong></a></li>
          <li class="active">Import</li>
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
              <h3 class="box-title">Import Employees by CSV</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-lg-12">
                  <form id="form" action="<?php echo base_url('employee/import_csv'); ?>" class="form-horizontal" data-toggle="validator" role="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <input type="hidden" name="token" value="b83dfa00669b155a37f921dd34e01d69" />  
                      <div class="row">
                        <div class="col-md-12">
                          <div class="well well-small">
                            <a href="<?php echo base_url('assets/csv/attendance.csv') ?>" class="btn bg-gray pull-right"><i class="fa fa-download"></i> Download Sample File</a>
                            <span class="text-warning">The first line in downloaded csv file should remain as it is. Please do not change the order of columns.</span>
                            <br/>The correct column order is <strong>(AC-No., Name, Auto-Assign, Date, Timetable, On duty, Off duty, Clock In, Clock Out, Normal, Real time, Late, Early, Absent, OT Time, Work Time, Exception, Must C/In, Must C/Out, Department, NDays, WeekEnd, Holiday, ATT_Time, NDays_OT, WeekEnd_OT, Holiday_OT)</strong> &amp; you must follow this.<br>Please make sure the csv file is UTF-8 encoded and not saved with byte order mark (BOM).
                        </div>

                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="csv_file">Upload File</label>
                            <input type="file" data-browse-label="Browse ..." name="csv" class="form-control file" data-show-upload="false" data-show-preview="false" id="csv" required="required" accept=".csv"/>
                          </div>
                          <div class="form-group">
                            <button type="submit" id="submit" class="button btn bg-gray">
                              <span class="submit" style="left: 20%">Import</span>
                              <span class="loading" style="left: 32%"><i class="fa fa-circle-o-notch"></i></span>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>        
                </div>
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

<script type="text/javascript">
  $(document).ready(function(){
    $('#form').submit(function(){
      $(this).find(':button[type=submit]').prop('disabled', true);
      $('.button').css('cursor', 'default');
      $('.button').toggleClass('active');
    });
  });
</script>