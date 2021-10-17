<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','purchaser','manager');
$p = array('admin','purchaser','manager');
if(!(in_array($this->session->userdata('type'),$p))){
  redirect('auth');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<style type="text/css">
		table tr td,th{
			padding:3px;
		}
	</style>
</head>
<body>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      	<div class="row">
	      	<!-- right column -->
	      	<div class="col-md-12">
		        <div class="box box-info">
		            <div class="box-header with-border">
		              <table width="100%">
		              	<tr>
		              		<td align="center">
		              			<h3 class="box-title"><img src="<?php  echo base_url(); ?>assets/images/logo.png"/></h3>
		              		</td>
		              	</tr>
		              </table>
		              
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">
		            	<div class="col-sm-12 well well-sm">
		            		<b><?php echo $this->lang->line('purchase_date')." : ".$data[0]->date; ?></b>
		            		<br>
		            		<b><?php echo $this->lang->line('purchase_reference_no')." : ".$data[0]->reference_no; ?></b>
		            	</div>
		            	<div class="col-sm-12">
		            		<table width="100%">
			            		<tr>
			            			<td><?php echo $this->lang->line('purchase_to'); ?></td>
			            			<td><?php echo $this->lang->line('purchase_from'); ?></td>
			            		</tr>
			            		<tr>
			            			<td style="font-size: 24px;padding: 10px 10px 10px 0px;"><?php echo $company[0]->name; ?></td>
			            			<td style="font-size: 24px;padding: 10px 10px 10px 0px;"><?php echo $data[0]->supplier_name ?></td>
			            		</tr>
			            		<tr>
			            			<td><?php echo $data[0]->warehouse_name; ?></td>
			            			<td><?php echo $data[0]->supplier_address; ?></td>
			            		</tr>
			            		<tr>
			            			<td><?php echo $data[0]->branch_address; ?></td>
			            			<td><?php echo $data[0]->supplier_city; ?></td>
			            		</tr>
			            		<tr>
			            			<td><?php echo $data[0]->branch_city; ?></td>
			            			<td></td>
			            		</tr>
			            		<tr>
			            			<td><?php echo $this->lang->line('purchase_mobile')." : ".$company[0]->phone; ?></td>
			            			<td><?php echo $this->lang->line('purchase_mobile')." : ".$data[0]->supplier_mobile; ?></td>
			            		</tr>
			            		<tr>
			            			<td><?php echo $this->lang->line('company_setting_email')." : ".$company[0]->email; ?></td>
			            			<td><?php echo $this->lang->line('company_setting_email')." : ".$data[0]->supplier_email; ?></td>
			            		</tr>
			            	</table>
			            </div>
			            <div class="col-sm-12" style="overflow-y: auto;margin-top: 4%">
			            	<table class="table table-hover table-bordered">
			            		<thead>
			            			<tr>
				            			<th style="text-align: center;"><?php echo $this->lang->line('product_no'); ?></th>
				            			<th width="40%"><?php echo $this->lang->line('product_description'); ?></th>
				            			<th width="10%"><?php echo $this->lang->line('product_hsn_sac_code'); ?></th>
				            			<th style="text-align: center;"><?php echo $this->lang->line('product_quantity'); ?></th>
				            			<th style="text-align: center;"><?php echo $this->lang->line('product_cost'); ?></th>
				            			<th style="text-align: center;"><?php echo $this->lang->line('purchase_total_sales'); ?></th>
				            			<th style="text-align: center;"><?php echo $this->lang->line('header_discount'); ?></th>
				            			<th style="text-align: center;"><?php echo $this->lang->line('product_quantity'); ?></th>
				            			<th style="text-align: center;"><?php echo $this->lang->line('header_tax'); ?></th>
				            			<th style="text-align: center;"><?php echo $this->lang->line('product_quantity'); ?></th>
				            		</tr>
			            		</thead>
			            		<tbody>
			            			<?php $i = 1;foreach ($items as $value) { ?>
			            			<tr>
			            				<td align="center"><?php echo $i;?></td>
			            				<td><?php echo $value->name; ?></td>
			            				<td><?php echo $value->hsn_sac_code; ?></td>
			            				<td align="center"><?php echo $value->quantity; ?></td>
			            				<td align="right"><?php echo $this->session->userdata('symbol').$value->cost; ?></td>
			            				<td align="right"><?php echo $this->session->userdata('symbol').$value->gross_total; ?></td>
			            				<td align="right"><?php echo $this->session->userdata('symbol').$value->discount; ?></td>
			            				<td align="right"><?php echo $this->session->userdata('symbol').($value->gross_total-$value->discount); ?></td>
			            				<td align="right"><?php echo $this->session->userdata('symbol').$value->tax; ?></td>
			            				<td align="right"><?php echo $this->session->userdata('symbol').($value->gross_total-$value->discount+$value->tax); ?></td>
			            			</tr>
			            			<?php $i++; } ?>
			            			<tr>
			            				<td colspan="7" align="right"><b><?php echo $this->lang->line('purchase_total_amount'); ?></b></td>
			            				<td align="right" colspan="7"><?php echo $this->session->userdata('symbol').$data[0]->total; ?></td>
			            			</tr>
			            		</tbody>
			            	</table>
			            </div>
			            <div class="col-sm-12">
			            	<table align="right" width="35%">
			            		<tr>
			            			<td><?php echo $this->lang->line('purchase_ordered_by'); ?> : <?php echo $data[0]->first_name.' '.$data[0]->last_name; ?></td>
			            		</tr>
			            		<tr>
			            			<td><br><br><br><br><br><br></td>
			            		</tr>
			            		<tr>
			            			<td style="border-bottom: 1px solid #000;"><br></td>
			            		</tr>
			            		<tr>
			            			<td><?php echo $this->lang->line('purchase_stamp_and_signature'); ?></td>
			            		</tr>
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
</body>
</html>
<?php
	
?>