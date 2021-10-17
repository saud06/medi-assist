<!DOCTYPE html>
<html>
<head>
	<title>Invoice</title>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
	<style type="text/css">
		body{
			font-family: arial;
			font-size: 10px;
		}
	</style>
</head>
<body>
	<table width="100%">
		<tr>
			<td align="center" style="font-size: 14px;">GST TAX INVOICE</td>
		</tr>
	</table>
	<table border="1" style="border: 1px solid black; border-collapse: collapse" width="100%">
		<tr>
			<td rowspan="5" width="20%" align="center"><img src="<?php echo base_url();?><?php echo $company[0]->logo;?>" alt="Company Logo" width="100" height="40"></td>
			<td rowspan="5" width="45%">
				<table>
					<tr>
						<td><h3><?php echo $company[0]->name; ?></h3></td>
					</tr>
					<tr>
						<td>
						<?php 
							if(!isset($company[0]->zip_code)){
								$zip_code = '-'.$company[0]->zip_code;
							}
							else{
								$zip_code = $company[0]->zip_code;
							}
							echo $company[0]->street.','.$company[0]->city_name.$zip_code;
						?>
						</td>
					</tr>
					<tr>
						<td>
							<?php 
								echo $company[0]->state_name.','.$company[0]->country_name; 
							?>
						</td>
					</tr>
					<tr>
						<td>
							<?php 
								echo 'Mo. : '.$company[0]->phone.' Email : '.$company[0]->email; 
							?>
						</td>
					</tr>
				</table>
			</td>
			<td align="center">
				<table style="border: 1px solid white; border-collapse: collapse;font-weight: bold;">
					<tr>
						<td><div style="border:1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </div></td>
						<td>Original for Recipient</td>
					</tr>
					<tr>
						<td><div style="border:1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </div></td>
						<td>Duplicate for Transport</td>
					</tr>
					<tr>
						<td><div style="border:1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </div></td>
						<td>Triplicate for Supplier</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td><b>GST No. : <?php echo $data[0]->client_gstid;?></b></td>
		</tr>
		<tr>
			<td><b>STATE : <?php echo $company[0]->state_name;?></b></td>
		</tr>
	</table>
	<table>
		<tr>
			<td></td>
		</tr>
	</table>
</body>
</html>