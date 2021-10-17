<?php 
	function convert_number_to_words($number) {
		$hyphen      = '-';
		$conjunction = ' and ';
		$separator   = ', ';
		$negative    = 'negative ';
		$decimal     = ' point ';
		$dictionary  = array(
	 						0                   => 'Zero',
	 						1                   => 'One',
	 						2                   => 'Two',
	 						3                   => 'Three',
	 						4                   => 'Four',
	 						5                   => 'Five',
	 						6                   => 'Six',
	 						7                   => 'Seven',
	 						8                   => 'Eight',
	 						9                   => 'Nine',
	 						10                  => 'Ten',
	 						11                  => 'Eleven',
	 						12                  => 'Twelve',
	 						13                  => 'Thirteen',
	 						14                  => 'Fourteen',
	 						15                  => 'Fifteen',
	 						16                  => 'Sixteen',
	 						17                  => 'Seventeen',
	 						18                  => 'Eighteen',
	 						19                  => 'Nineteen',
	 						20                  => 'Twenty',
	 						30                  => 'Thirty',
	 						40                  => 'Fourty',
	 						50                  => 'Fifty',
	 						60                  => 'Sixty',
	 						70                  => 'Seventy',
	 						80                  => 'Eighty',
	 						90                  => 'Ninety',
	 						100                 => 'Hundred',
	  						1000                => 'Thousand',
	  						1000000             => 'Million',
	  						1000000000          => 'Billion',
	  						1000000000000       => 'Trillion',
	  						1000000000000000    => 'Quadrillion',
	  						1000000000000000000 => 'Quintillion'
	 	);

		if (!is_numeric($number)) {
			return false;
		}
 		if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
        	// overflow
  			trigger_error(
   			'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
   			E_USER_WARNING
  			);
  			return false;
 		}
 		if ($number < 0) {
  			return $negative . convert_number_to_words(abs($number));
 		}
		$string = $fraction = null;
		if (strpos($number, '.') !== false) {
		  	list($number, $fraction) = explode('.', $number);
		}
 		switch (true) {
  			case $number < 21:
  			$string = $dictionary[$number];
  			break;
  			case $number < 100:
  			$tens   = ((int) ($number / 10)) * 10;
  			$units  = $number % 10;
  			$string = $dictionary[$tens];
			if ($units) {
				$string .= $hyphen . $dictionary[$units];
			}
  			break;
		  	case $number < 1000:
		  	$hundreds  = $number / 100;
		  	$remainder = $number % 100;
		  	$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
		  	if ($remainder) {
		   		$string .= $conjunction . convert_number_to_words($remainder);
		  	}
		  	break;
  			default:
		  	$baseUnit = pow(1000, floor(log($number, 1000)));
		  	$numBaseUnits = (int) ($number / $baseUnit);
		  	$remainder = $number % $baseUnit;
		  	$string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
  			if ($remainder) {
   				$string .= $remainder < 100 ? $conjunction : $separator;
   				$string .= convert_number_to_words($remainder);
  			}
  			break;
 		}
 		if (null !== $fraction && is_numeric($fraction)) {
  			$string .= $decimal;
  			$words = array();
  			foreach (str_split((string) $fraction) as $number) {
   				$words[] = $dictionary[$number];
  			}
  			$string .= implode(' ', $words);
 		}

 		return $string;
	}
?>

<head>
	<title>Sales Bill</title>
	<style>
		body{
			font-family: arial;
			font-size: 14px;
		}
      	.table, th, td{
            border: 1px solid black;
      	}
      	.table td .table1 td{
        	border: 1px solid black;
        }
      	.table{
        	width: 99%;
      	}
      	.table table td{
        	border: 0px solid black;
      	}
  	</style>
</head>
<body>
	<table width="99%">
		<tr>
			<td width="70%" style="border: none;">Date: <?php echo $data[0]->date; ?></td>
			<td width="29%" style="border: none;"><strong>Bill No.:</strong></td>
		</tr>
		<tr>
			<td style="border: none;"></td>
		</tr>
		<tr>
			<td width="70%" style="border: none;">
				To,<br>
				<strong><?php echo $data[0]->company_name; ?></strong>
				<br>

				<?php if(!empty($data[0]->house_no)){ echo 'House: ' . $data[0]->house_no . ', ';} ?>
        		<?php if(!empty($data[0]->road_no)){ echo 'Road: ' . $data[0]->road_no;} ?>
        		<?php
        		$city_id = $data[0]->city_id;
        		$this->db->where('id', $city_id);
				$city = $this->db->get('cities')->result_array();

				if($city){
					echo $city[0]['name'] . ', ';
        		}
				else{
					$city = '';
				}
        		
        		$state_id = $data[0]->state_id;
        		$this->db->where('id', $state_id);
				$state = $this->db->get('states')->result_array();

				if($state){
					echo $state[0]['name'] . ', ';
        		}
				else{
					$state = '';
				}

        		if(!empty($data[0]->zip_code)){ 
        			echo $data[0]->zip_code . ', ';
        		}
        		else echo '';
        		
        		$country_id = $data[0]->country_id;
        		$this->db->where('id', $country_id);
				$country = $this->db->get('countries')->result_array();

				if($country){
					echo $country[0]['name'];
        		}
				else{
					$country = '';
				} 
				?>

			</td>
			<td width="29%" style="border: none;"><?php echo $data[0]->invoice_no; ?></td>
		</tr>
	</table>

	<br>

	<table align="center" class="table" style="border: 1px solid black; border-collapse: collapse">
		<tbody>
			<tr>
				<td width="45%" align="center"><strong>Description</strong></td>
				<td width="10%" align="center"><strong>QTY (kg)</strong></td>

				<?php 
					$currency_id = $data[0]->currency_id;
	        		$this->db->where('id', $currency_id);
					$currency = $this->db->get('currency')->result_array();
				?>

				<td width="15%" align="center"><strong>Unit Price (<?php echo $currency[0]['name']; ?>)</strong></td>
				<td width="20%" align="center"><strong>Value in <?php echo $currency[0]['name']; ?></strong></td>
			</tr>

			<style type="text/css">
        		tr.no-bottom-border td {
				  border-bottom: none
				}
				tr.no-top-border td {
				  border-top: none
				}
        	</style>

			<?php 
				$grand_total = 0;
              	foreach ($items as $row) {
            ?>
	            	<tr class="no-bottom-border">
	            		<td height="30px"><?php echo '&nbsp;&nbsp;<strong>' . $row->product_name . '</strong>'; ?></td>
						<td height="30px" align="center"><?php echo '&nbsp;&nbsp;' . $row->quantity; ?></td>
						<td height="30px" align="center"><?php echo '&nbsp;&nbsp;' . $row->cost; ?></td>
						<td height="30px" align="center"><?php echo '&nbsp;&nbsp;' . $row->gross_total; ?></td>
					</tr>
			<?php 
					$grand_total += $row->gross_total;
              	}
            ?>
            <tr class="no-top-border">
            	<td height="450px"></td>
			    <td height="450px"></td>
			    <td height="450px"></td>
			    <td height="450px"></td>
            </tr>
			<tr>
				<td colspan="3" align="center">Total Amount</td>
				<td align="center"><?php echo number_format((float)$grand_total, 2, '.', ''); ?></td>
			</tr>
			<tr>
				<td colspan="4" align="center">In Words: <?php echo $currency[0]['name'] . ' ' . convert_number_to_words(number_format((float)$grand_total, 2, '.', '')) . ' Only.'; ?></td>
			</tr>
		</tbody>
	</table>

	<br>

	<table width="99%">
		<tr>
			<td width="20%" height="150px" style="vertical-align: top; border: none;">With Best Regards: </td>
		</tr>
	</table>
</body>

<script>
  	window.print();
</script>