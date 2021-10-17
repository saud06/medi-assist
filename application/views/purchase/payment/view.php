<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','purchaser','manager');
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
        window.location.href='<?php  echo base_url('purchase/delete/'); ?>'+id;
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
          <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li><a href="<?php echo base_url('purchase'); ?>">Purchase</a></li>
          <li class="active">Payment</li>
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
		              <h3 class="box-title">Payment</h3>
		              <a class="btn btn-sm btn-info pull-right" style="margin: 10px" href="<?php echo base_url('purchase/add');?>" title="Add New Purchase"> Add Payment </a>
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">
			            <div class="form-group">
		                   <label>Date : <?php echo date("d-m-Y"); ?></label><br>
		                </div>
		                <div class="form-group">
		                   <label>Reference No : <?php echo $data[0]->reference_no; ?></label><br>
		                </div>
		                <div class="form-group">
		                   <label>Amount : <?php echo $data[0]->total; ?></label>
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