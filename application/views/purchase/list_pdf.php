<head>
	<title>Purchase List</title>
	<style>
		body{
			font-family: arial;
			font-size: 12px;
		}
      	.table, th, td{
            border: 1px solid gray;
            border-collapse: collapse;
            padding: 5px;
            text-align: center;
            vertical-align: middle;
      	}
  	</style>
</head>
<body>
	<h1 style="text-align: center;">Purchase List</h1>

	<table width="99%" class="table table-bordered table-striped">
	  <thead>
	  <tr>
	    <th><?php echo $this->lang->line('product_no'); ?>.</th>
	    <!-- <th><?php echo $this->lang->line('purchase_date'); ?></th> -->
	    <th><?php echo $this->lang->line('purchase_reference_no'); ?></th>
	    <th>Manufacturer / Supplier</th>
	    <th>Shipping Mode</th>
	    <th>Status</th>
	    <th><?php echo $this->lang->line('purchase_grand_total'); ?></th>
	  </tr>
	  </thead>
	  <tbody>
	    <?php 
	      $grand_tot_bdt = 0; 
          $grand_tot_usd = 0; 

	      foreach ($data as $key => $row) {
	        $id= $row->purchase_id;
	    ?>
	      <tr>
	        <td><?php echo ++$key; ?></td>
	        <!-- <td><?php echo $row->date; ?></td> -->
	        <td><?php echo $row->reference_no; ?></td>
	        <td><?php echo $row->company_name; ?></td>
	        <td>
	          <?php 
	            echo '<strong>Mode: </strong>' . $row->ship_mode . '<br>'; 
	            if($row->ship_mode == 'Courier'){
                  if($row->type){
                    $type = $this->db->get_where('courier', array('courier_id' => $row->type))->row();
                    echo '<strong>Type: </strong>' . $type->courier_name . '<br>'; 
                  }
                  else{
                    echo '<strong>Type: </strong><br>';
                  }
                }
	            echo '<hr style="margin: 2px">';
	            echo '<strong>Method: </strong>' . $row->method; 
	          ?>
	        </td>
	        <td align="center"><?php echo $this->lang->line('purchase_received'); ?></td>
	        <td align="right"><?php if($row->currency_id == 1){ echo '$';} else{ echo 'BDT '; } echo $row->total; ?></td>
	      </tr>
	    <?php
	    	if($row->currency_id == 1){
              $grand_tot_usd += $row->total;
            }

            else{
              $grand_tot_bdt += $row->total;
            }
	      }
	    ?>
	  </tbody>
	  <tfoot>
	  	<tr>
		  <th><?php echo $this->lang->line('product_no'); ?>.</th>
		  <!-- <th><?php echo $this->lang->line('purchase_date'); ?></th> -->
		  <th><?php echo $this->lang->line('purchase_reference_no'); ?></th>
		  <th>Manufacturer / Supplier</th>
		  <th>Shipping Mode</th>
		  <th>Status</th>
	   	  <th><?php echo 'Grand Total: <br>'; ?><?php echo '$' . number_format((float)$grand_tot_usd, 2, '.', '') . '<br>BDT ' . number_format((float)$grand_tot_bdt, 2, '.', ''); ?></th>
	  	</tr>
	  </tfoot>
	</table>
</body>

<script>
  window.print();
</script>