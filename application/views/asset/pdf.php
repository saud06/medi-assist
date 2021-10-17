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
	<title>Asset Bill</title>
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
		</tr>
		<tr>
			<td style="border: none;"></td>
		</tr>
		<tr>
			<td width="70%" style="border: none;">
				<strong>Title:</strong> <?php echo $data[0]->title; ?>
				<br>
			</td>
		</tr>
	</table>

	<br>

	<table align="center" class="table" style="border: 1px solid black; border-collapse: collapse">
		<tbody>
			<tr>
				<td width="15%" align="center"><strong>Asset</strong></td>
				<td width="20%" align="center"><strong>Description</strong></td>
				<td width="20%" align="center"><strong>Purpose</strong></td>
				<td width="15%" align="center"><strong>Warranty</strong></td>
				<td width="10%" align="center"><strong>QTY</strong></td>
				<td width="10%" align="center"><strong>Amount (BDT)</strong></td>
				<td width="10%" align="center"><strong>Total (BDT)</strong></td>
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
	            		<td height="30px" align="center"><?php echo '&nbsp;&nbsp;' . $row->asset_name; ?></td>
						<td height="30px" align="center"><?php echo '&nbsp;&nbsp;' . $row->asset_description; ?></td>
						<td height="30px" align="center"><?php echo '&nbsp;&nbsp;' . $row->purpose; ?></td>
						<td height="30px" align="center"><?php echo '&nbsp;&nbsp;' . $row->warranty_period; ?></td>
						<td height="30px" align="center"><?php echo '&nbsp;&nbsp;' . $row->quantity; ?></td>
						<td height="30px" align="center"><?php echo '&nbsp;&nbsp;' . $row->amount; ?></td>
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
			    <td height="450px"></td>
			    <td height="450px"></td>
			    <td height="450px"></td>
            </tr>
			<tr>
				<td colspan="6" align="center">Grand Total</td>
				<td align="center"><?php echo number_format((float)$grand_total, 2, '.', ''); ?></td>
			</tr>
			<tr>
				<td colspan="7" align="center">In Words: <?php echo 'BDT ' . convert_number_to_words(number_format((float)$grand_total, 2, '.', '')) . ' Only.'; ?></td>
			</tr>
		</tbody>
	</table>
</body>

<script>
  window.print();
</script>