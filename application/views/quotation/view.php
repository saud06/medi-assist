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
          <li><a href="<?php echo base_url('quotation'); ?>" class="text-black"><strong>Quotation</strong></a></li>
          <li class="active">Quotation Details</li>
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
		              <h3 class="box-title">Quotation Details</h3>
		              <?php
		              	if(isset($check_invoice->quotation_id)){
		              		if($check_invoice->quotation_id==null){
		              ?>
		              			<a class="btn btn-sm btn-info pull-right"  href="<?php echo base_url('quotation/generate_invoice/');?><?php echo $data[0]->quotation_id; ?>">Generate Invoice</a>
		              <?php	
		              		}
		              	}
		              	else{
		              ?>
		              	<a class="btn btn-sm btn-info pull-right"  href="<?php echo base_url('quotation/generate_invoice/');?><?php echo $data[0]->quotation_id; ?>">Generate Invoice</a>
		              <?php
		              	}
		              ?>
		              
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">
		            	<div class="col-sm-12 well well-sm">
			            	<div class="col-sm-4">
			            		<div class="col-sm-2">
			            			<i class="fa fa-3x fa-truck padding010 text-muted"></i>
			            		</div>
			            		<div class="col-sm-10">
			            			<b><h4><?php echo $data[0]->client_name; ?></h4></b>
				            		<?php echo $data[0]->client_address; ?>
				            		<br>
				            		<?php echo $data[0]->client_city; ?>
				            		<br>
				            		<?php echo $data[0]->client_country; ?>
				            		<br><br>
				            		<?php echo $this->lang->line('purchase_mobile')." : ".$data[0]->client_mobile; ?>
				            		<br>
				            		<?php echo $this->lang->line('company_setting_email')." : ".$data[0]->client_email; ?>
			            		</div>
			            	</div>
			            	<div class="col-sm-4">
			            		<div class="col-sm-2">
			            			<i class="fa fa-3x fa-building padding010 text-muted"></i>
			            		</div>
			            		<div class="col-sm-10">
			            			<b><h4><?php echo $data[0]->biller_name ?></h4></b>
				            		<?php echo $data[0]->biller_address; ?>
				            		<br>
				            		<?php echo $data[0]->biller_city; ?>
				            		<br>
				            		<?php echo $data[0]->biller_country; ?>
				            		<br><br>
				            		<?php echo $this->lang->line('purchase_mobile')." : ".$data[0]->biller_mobile; ?>
				            		<br>
				            		<?php echo $this->lang->line('company_setting_email')." : ".$data[0]->biller_email; ?>
			            		</div>
			            	</div>
			            	<div class="col-sm-4">
			            		<div class="col-sm-2">
									<i class="fa fa-3x fa-building-o padding010 text-muted"></i>
								</div>
								<div class="col-sm-10">
									<b><h4><?php echo $company[0]->name; ?></h4></b>
				            		<?php echo $data[0]->warehouse_name; ?>
				            		<br>
				            		<?php echo $data[0]->branch_address; ?>
				            		<br>
				            		<?php echo $data[0]->branch_city; ?>
				            		<br><br>
				            		<?php echo $this->lang->line('purchase_mobile')." : ".$company[0]->phone; ?>
				            		<br>
				            		<?php echo $this->lang->line('company_setting_email')." : ".$company[0]->email; ?>
			            		</div>
			            	</div>
			            </div>
			            <div class="col-sd-12">
			            	<div class="col-sm-4">
			            		<div class="col-sm-2">
			            			<i class="fa fa-3x fa-file-text-o padding010 text-muted"></i>
			            		</div>
			            		<div class="col-sm-10">
			            			<b><h4><?php echo $data[0]->reference_no; ?></h4></b>
				            		
				            		<b><?php echo $this->lang->line('purchase_date')." : ".$data[0]->date; ?></b>
				            		<br>
				            		<br>
			            		</div>
			            	</div>
			            	
			            </div>
			            <div class="col-sm-12" style="overflow-y: auto;">
			            	<table class="table table-hover table-bordered">
			            		<thead>
			            			<th style="text-align: center;"><?php echo $this->lang->line('product_no'); ?></th>
			            			<th width="20%"><?php echo $this->lang->line('product_description'); ?></th>
			            			<th width="20%"><?php echo $this->lang->line('product_hsn_sac_code'); ?></th>
			            			<th style="text-align: center;"><?php echo $this->lang->line('product_quantity'); ?></th>
			            			<th style="text-align: center;"><?php echo $this->lang->line('product_cost'); ?></th>
			            			<th style="text-align: center;"><?php echo $this->lang->line('purchase_total_sales'); ?></th>
			            			<th style="text-align: center;"><?php echo $this->lang->line('header_discount'); ?></th>
			            			<th style="text-align: center;"><?php echo $this->lang->line('purchase_taxable_value'); ?></th>
			            			<th style="text-align: center;"><?php echo $this->lang->line('header_tax'); ?></th>
			            			<th style="text-align: center;"><?php echo $this->lang->line('purchase_total'); ?></th>
			            		</thead>
			            		<tbody>
			            			<?php $i = 1; $tot = 0;foreach ($items as $value) { ?>
			            			<tr>
			            				<td align="center"><?php echo $i;?></td>
			            				<td><?php echo $value->name.'('.$value->code.')'; ?></td>
			            				<td align="center"><?php echo $value->hsn_sac_code; ?></td>
			            				<td align="center"><?php echo $this->session->userdata('symbol').$value->quantity; ?></td>
			            				<td align="right"><?php echo $this->session->userdata('symbol').$value->price; ?></td>
			            				<td align="right"><?php echo $this->session->userdata('symbol').$value->gross_total; ?></td>
			            				<td align="right"><?php echo $this->session->userdata('symbol').$value->discount; ?></td>
			            				<td align="right"><?php echo $this->session->userdata('symbol').($value->gross_total - $value->discount); ?></td>
			            				<td align="right"><?php echo $this->session->userdata('symbol').$value->tax; ?></td>
			            				<td align="right"><?php echo $this->session->userdata('symbol').($value->gross_total - $value->discount + $value->tax); ?></td>
			            			</tr>
			            			<?php $i++; $tot += $value->gross_total; } ?>
			            			<tr>
			            				<td colspan="7" align="right"><b><?php echo $this->lang->line('purchase_total_value'); ?></b></td>
			            				<td align="right" colspan="3"><?php echo $this->session->userdata('symbol').$tot; ?></td>
			            			</tr>
			            			<tr>
			            				<td colspan="7" align="right"><b><?php echo $this->lang->line('purchase_total_discount'); ?></b></td>
			            				<td align="right" colspan="3"><?php echo $this->session->userdata('symbol').$data[0]->discount_value;?></td>
			            			</tr>
			            			<tr>
			            				<td colspan="7" align="right"><b><?php echo $this->lang->line('purchase_total_tax'); ?></b></td>
			            				<td align="right" colspan="3"><?php echo $this->session->userdata('symbol').$data[0]->tax_value;?></td>
			            			</tr>
			            			<tr>
			            				<td colspan="7" align="right"><b>Shipping Charge</b></td>
			            				<td align="right" colspan="3"><?php echo $this->session->userdata('symbol').$data[0]->shipping_charge;?></td>
			            			</tr>
			            			<tr>
			            				<td colspan="7" align="right"><b><?php echo $this->lang->line('sales_balance'); ?></b></td>
			            				<td align="right" colspan="3"><?php echo $this->session->userdata('symbol').($data[0]->shipping_charge+$data[0]->total); ?></td>
			            			</tr>
			            		</tbody>
			            	</table>
			            </div>
			            <!-- <div class="col-sm-6" style="padding-bottom:10px;">
			            	<button class="btn btn-primary btn-lg btn-block" type="submit" name="submit">
								<i class="fa fa-money"></i>
								Pay by Paypal
							</button>
			            </div> -->
			            <div class="col-sm-12">
			            	<div class="buttons">
								<div class="btn-group btn-group-justified">
									
									<div class="btn-group">
										<a class="tip btn btn-info tip" href="<?php echo base_url('quotation/email/'); ?><?php echo $data[0]->quotation_id; ?>" title="Email">
											<i class="fa fa-envelope-o"></i>
											<span class="hidden-sm hidden-xs"><?php echo $this->lang->line('company_setting_email'); ?></span>
										</a>
									</div>
									<div class="btn-group">
										<a class="tip btn btn-success" href="<?php echo base_url('quotation/pdf/');?><?php echo $data[0]->quotation_id; ?>" title="Download as PDF" target="_blank">
											<i class="fa fa-download"></i>
											<span class="hidden-sm hidden-xs"><?php echo $this->lang->line('product_alert_pdf'); ?></span>
										</a>
									</div>
									<div class="btn-group">
										<a class="tip btn btn-success" href="<?php echo base_url('quotation/print1/');?><?php echo $data[0]->quotation_id; ?>" title="Download as PDF" target="_blank">
											<i class="fa fa-download"></i>
											<span class="hidden-sm hidden-xs">Print<!-- <?php echo $this->lang->line('product_alert_pdf'); ?> --></span>
										</a>
									</div>
									<?php if(isset($check_invoice->quotation_id)){
											if($check_invoice->quotation_id==null){ ?>
									<div class="btn-group">
										<a class="tip btn btn-warning tip" href="<?php echo base_url('quotation/edit/'); ?><?php echo $data[0]->quotation_id; ?>" title="Edit">
											<i class="fa fa-edit"></i>
											<span class="hidden-sm hidden-xs"><?php echo $this->lang->line('purchase_edit'); ?></span>
										</a>
									</div>
									<?php }}else{
									?>
										<div class="btn-group">
										<a class="tip btn btn-warning tip" href="<?php echo base_url('quotation/edit/'); ?><?php echo $data[0]->quotation_id; ?>" title="Edit">
											<i class="fa fa-edit"></i>
											<span class="hidden-sm hidden-xs"><?php echo $this->lang->line('purchase_edit'); ?></span>
										</a>
									</div>
									<?php
										} ?>
									<div class="btn-group">
										<a class="tip btn btn-danger bpo" href="javascript:delete_id(<?php echo $data[0]->quotation_id;?>)" title="Delete Purchase">
											<i class="fa fa-trash-o"></i>
											<span class="hidden-sm hidden-xs"><?php echo $this->lang->line('purchase_delete'); ?></span>
										</a>
									</div>
								</div>
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