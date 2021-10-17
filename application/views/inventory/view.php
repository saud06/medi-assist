<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','purchaser','manager');
$p = array('admin','purchaser','manager');
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
          <li><a href="<?php echo base_url('auth/dashboard'); ?>" class="text-black"><i class="fa fa-dashboard">&nbsp;</i><strong><?php echo $this->lang->line('header_dashboard'); ?></strong></a></li>
          <li><a href="<?php echo base_url('purchase'); ?>" class="text-black"><strong><?php echo $this->lang->line('header_purchase'); ?></strong></a></li>
          <li class="active"><?php echo $this->lang->line('purchase_purchase_details'); ?></li>
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
		              <h3 class="box-title"><?php echo $this->lang->line('purchase_purchase_details'); ?></h3>
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">
		            	<div class="col-sm-12 well well-sm">
			            	<div class="col-sm-5">
			            		<div class="col-sm-2">
			            			<i class="fa fa-3x fa-truck padding010 text-muted"></i>
			            		</div>
			    <!--         		<div class="col-sm-10">
			            			<b><h4><?php echo $company[0]->name; ?></h4></b>
				            		<br>
				            		<?php echo $data[0]->warehouse_name; ?>
				            		<br>
				            		<?php echo $data[0]->branch_address; ?>
				            		<br>
				            		<?php echo $data[0]->branch_city; ?>
				            		<br><br>
				            		<?php echo $this->lang->line('purchase_mobile')." : ".$company[0]->phone; ?>
				            		<br>
				            		<?php echo $this->lang->line('company_setting_email')." : ".$company[0]->email; ?>
			            		</div> -->
			            	</div>
			            	<div class="col-md-4">
			            		<div class="col-sm-2">
			            			<i class="fa fa-3x fa-building padding010 text-muted"></i>
			            		</div>
			      <!--       		<div class="col-sm-10">
			            			<b><h4><?php echo $data[0]->supplier_name ?></h4></b>
				            		<br>
				            		<?php echo $data[0]->supplier_address; ?>
				            		<br>
				            		<?php echo $data[0]->supplier_city; ?>
				            		<br><br>
				            		<?php echo $this->lang->line('purchase_mobile')." : ".$data[0]->supplier_mobile; ?>
				            		<br>
				            		<?php echo $this->lang->line('company_setting_email')." : ".$data[0]->supplier_email; ?>
			            		</div> -->
			            	</div>
			            	<div class="col-md-3">
			            		<div class="col-sm-3">
									<i class="fa fa-3x fa-file-text-o padding010 text-muted"></i>
								</div>
						<!-- 		<div class="col-sm-9">
				            		<b><h4><?php echo $data[0]->reference_no; ?></h4></b>
				            		<br>
				            		<b><?php echo $this->lang->line('purchase_date')." : ".$data[0]->date; ?></b>		            	
				            	</div> -->
			            	</div>
			            </div>
			            <div class="col-sm-12" style="overflow-y: auto;">
			            	<table class="table table-hover table-bordered">
			            		<thead>
			            			<th style="text-align: center;">No</th>
			            			<th style="text-align: center;">Name</th>
			            			<th style="text-align: center;">Code</th>
			            			<th style="text-align: center;">Location (Shelf)</th>
			            			<th style="text-align: center;">Location (Rack)</th>
			            			<th style="text-align: center;">Cost</th>
			            			<th style="text-align: center;">Quantity</th>		
			            		</thead>
			            		<tbody>
			            			<?php $i = 1;foreach ($data as $value) { ?>
			            			<tr>
			            				<td align="center"><?php echo $i;?></td>
			            				<td style="text-align: center;"><?php echo $value->name; ?></td>
			            				<td style="text-align: center;"><?php echo $value->code; ?></td>
			            				<td style="text-align: center;"><?php echo $value->shelf_name; ?></td>
			            				<td style="text-align: center;"><?php echo $value->rack_name; ?></td>
			            				<td align="right"><?php echo $this->session->userdata('symbol').$value->cost; ?></td>
			            				<td align="center"><?php echo $value->quantity; ?></td>

			            			</tr>
			            			<?php $i++; } ?>
			            		<!-- 	<tr>
			            				<td colspan="7" align="right"><b><?php echo $this->lang->line('purchase_total_amount'); ?></b></td>
			            				<td align="right" colspan="7"><?php echo $this->session->userdata('symbol').$data[0]->total; ?></td>
			            			</tr> -->
			            		</tbody>
			            	</table>
			            </div>
			            <div class="col-sm-12">
			            	<div class="buttons">
								<!-- <div class="btn-group btn-group-justified">
									<div class="btn-group">
										<a class="tip btn btn-primary tip" href="<?php echo base_url('purchase/payment/'); ?><?php echo $data[0]->purchase_id; ?>" title="Add Payment">
											<i class="fa fa-money"></i>
											<span class="hidden-sm hidden-xs"><?php echo $this->lang->line('sales_add_payment'); ?></span>
										</a>
									</div>
									<div class="btn-group">
										<a class="tip btn btn-info tip" href="<?php echo base_url('purchase/email/');?><?php echo $data[0]->purchase_id; ?>" title="Email">
											<i class="fa fa-envelope-o"></i>
											<span class="hidden-sm hidden-xs"><?php echo $this->lang->line('company_setting_email'); ?></span>
										</a>
									</div>
									<div class="btn-group">
										<a class="tip btn btn-success" href="<?php echo base_url('purchase/pdf/');?><?php echo $data[0]->purchase_id; ?>" title="Download as PDF" target="_blank">
											<i class="fa fa-download"></i>
											<span class="hidden-sm hidden-xs"><?php echo $this->lang->line('product_alert_pdf'); ?></span>
										</a>
									</div>
									<div class="btn-group">
										<a class="tip btn btn-warning tip" href="<?php echo base_url('purchase/edit/'); ?><?php echo $data[0]->purchase_id; ?>" title="Edit">
											<i class="fa fa-edit"></i>
											<span class="hidden-sm hidden-xs"><?php echo $this->lang->line('purchase_edit'); ?></span>
										</a>
									</div>
									<div class="btn-group">
										<a class="tip btn btn-danger bpo" href="javascript:delete_id(<?php echo $data[0]->purchase_id;?>)" title="Delete Purchase">
											<i class="fa fa-trash-o"></i>
											<span class="hidden-sm hidden-xs"><?php echo $this->lang->line('purchase_delete'); ?></span>
										</a>
									</div>
								</div> -->
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