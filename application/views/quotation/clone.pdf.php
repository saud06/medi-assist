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
		            		<b><?php echo "Date : ".$data[0]->date; ?></b>
		            		<br>
		            		<b><?php echo "Reference No: ".$data[0]->reference_no; ?></b>
		            	</div>
		            	<div class="col-sm-12">
		            		<table width="100%">
			            		<tr>
			            			<td>To</td>
			            			<td>From</td>
			            		</tr>
			            		<tr>
			            			<td style="font-size: 18px;padding: 10px 10px 10px 0px;"><?php echo $data[0]->client_name; ?></td>
			            			<td style="font-size: 18px;padding: 10px 10px 10px 0px;"><?php echo $data[0]->biller_name ?></td>
			            		</tr>
			            		<tr>
			            			<td><?php echo $data[0]->client_address; ?></td>
			            			<td><?php echo $data[0]->biller_address; ?></td>
			            		</tr>
			            		<tr>
			            			<td><?php echo $data[0]->client_city; ?></td>
			            			<td><?php echo $data[0]->biller_city; ?></td>
			            		</tr>
			            		<tr>
			            			<td><?php echo $data[0]->client_country; ?></td>
			            			<td><?php echo $data[0]->biller_country; ?></td></td>
			            		</tr>
			            		<tr>
			            			<td><?php echo "Mo : ".$data[0]->client_mobile; ?></td>
			            			<td><?php echo "Mo : ".$data[0]->biller_mobile; ?></td>
			            		</tr>
			            		<tr>
			            			<td><?php echo "Email : ".$data[0]->client_email; ?></td>
			            			<td><?php echo "Email : ".$data[0]->biller_email; ?></td>
			            		</tr>
			            	</table>
			            	<br>
			            	<table width="100%">
			            		<tr>
			            			<td style="font-size: 18px;padding: 10px 10px 10px 0px;"><?php echo $company[0]->name; ?></td>
			            			<td style="font-size: 18px;padding: 10px 10px 10px 0px;"><?php echo "Reference No : ".$data[0]->reference_no; ?></td>
			            		</tr>
			            		<tr>
			            			<td><?php echo $data[0]->warehouse_name; ?></td>
			            			<td><?php echo "Date : ".$data[0]->date; ?></td>
			            		</tr>
			            		<tr>
			            			<td><?php echo $data[0]->branch_address; ?></td>
			            		</tr>
			            		<tr>
			            			<td><?php echo "Mo : ".$company[0]->phone; ?></td>
			            			<td style="font-size: 18px;padding: 10px 10px 10px 0px;"><?php echo "Invoice No : ".$data[0]->invoice_no; ?></td>
			            		</tr>
			            		<tr>
			            			<td><?php echo "Email : ".$company[0]->email; ?></td>
			            			<td><?php echo "Date : ".$data[0]->invoice_date; ?></td>
			            		</tr>
			            		</tr>
			            	</table>
			            </div>
			            <div class="col-sm-12" style="overflow-y: auto;margin-top: 4%">
			            	<table class="table table-hover table-bordered">
			            		<thead>
			            			<tr>
				            			<th style="text-align: center;">NO</th>
				            			<th width="40%">Description(Code)</th>
				            			<th style="text-align: center;">Quantity</th>
				            			<th style="text-align: center;">Unit Price</th>
				            			<th style="text-align: center;">Tax</th>
				            			<th style="text-align: center;">Subtotal</th>
				            		</tr>
			            		</thead>
			            		<tbody>
			            			<?php $i = 1;foreach ($items as $value) { ?>
			            			<tr>
			            				<td align="center"><?php echo $i;?></td>
			            				<td><?php echo $value->name; ?></td>
			            				<td align="center"><?php echo $value->quantity; ?></td>
			            				<td align="right"><?php echo $value->price; ?></td>
			            				<td align="right">
			            					<?php 
			            						echo $tax = ($value->tax_value * $value->price) / 100;
			            					?>		
			            				</td>
			            				<td align="right"><?php echo $value->gross_total; ?></td>
			            			</tr>
			            			<?php $i++; } ?>
			            			<tr>
			            				<td colspan="5" align="right"><b>Total Amount</b></td>
			            				<td align="right"><?php echo $items[0]->total; ?></td>
			            			</tr>
			            			<tr>
			            				<td colspan="5" align="right"><b>Paid</b></td>
			            				<?php if($data[0]->paid_amount == 0.00){ ?>
			            					<td align="right">0.00</td>
			            				<?php  }else{ ?>
			            					<td align="right"><?php echo $items[0]->total; ?></td>
			            				<?php } ?>
			            			</tr>
			            			<tr>
			            				<td colspan="5" align="right"><b>Balance</b></td>
			            				<?php if($data[0]->paid_amount == 0.00){ ?>
			            					<td align="right"><?php echo $items[0]->total; ?></td>
			            				<?php  }else{ ?>
			            					<td align="right">0.00</td>
			            				<?php } ?>
			            			</tr>
			            		</tbody>
			            	</table>
			            </div>
			            <div class="col-sm-12">
			            	<table align="left" width="100%">
			            		<tr>
			            			<td width="35%">Seller : <?php echo $data[0]->biller_name; ?></td>
			            			<td width="30%"></td>
			            			<td width="35%">Client : <?php echo $data[0]->client_name; ?></td>
			            		</tr>
			            		<tr>
			            			<td><br><br><br><br><br><br></td>
			            		</tr>
			            		<tr>
			            			<td style="border-bottom: 1px solid #000;"><br></td>
			            			<td></td>
			            			<td style="border-bottom: 1px solid #000;"><br></td>
			            		</tr>
			            		<tr>
			            			<td>Stamp & Signature</td>
			            			<td></td>
			            			<td>Stamp & Signature</td>
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