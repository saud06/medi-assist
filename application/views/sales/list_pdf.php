<head>
	<title>Sales List</title>
	<style>
		body{
			font-family: arial;
			font-size: 14px;
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
	<h1 style="text-align: center;">Sales List</h1>

	<table width="99%" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th><?php echo $this->lang->line('product_no'); ?>.</th>
        <!-- <th><?php echo $this->lang->line('purchase_date'); ?></th> -->
        <th><?php echo $this->lang->line('purchase_reference_no'); ?></th>
        <th>Company Name</th>
        <th>Shipping Mode</th>
        <th>Status</th>
        <th><?php echo $this->lang->line('purchase_grand_total'); ?></th>
        <th><?php echo $this->lang->line('sales_paid'); ?></th>
        <th><?php echo $this->lang->line('sales_payment_status'); ?></th>
      </tr>
      </thead>
      <tbody>
        <?php 
            $tot_paid_bdt = 0; 
            $tot_paid_usd = 0; 
            $grand_tot_bdt = 0; 
            $grand_tot_usd = 0; 

            foreach ($data as $key => $row) {
               $id= $row->sales_id;
          ?>
          <tr>
            <td><?php echo ++$key; ?></td>
            <!-- <td><?php echo $row->date; ?></td> -->
            <td><?php echo $row->reference_no; ?></td>
            <td><?php echo $row->company_name; ?></td>
            <td><?php echo $row->ship_mode; ?></td>
            <td align="center"><?php echo $this->lang->line('sales_complited'); ?></td>
            <td align="right"><?php if($row->currency_id == 1){ echo '$';} else{ echo 'BDT '; } echo $row->total; ?></td>
            <td align="right">
              <?php
                if($row->paid_amount != null){
                  if($row->currency_id == 1){ 
                    echo '$';
                    $tot_paid_usd += $row->paid_amount;
                  } 
                  else{ 
                    echo 'BDT '; 
                    $tot_paid_bdt += $row->paid_amount;
                  } 
                  echo $row->paid_amount;
                }
                else{
                  $tot_paid_usd += 0.00;
                  $tot_paid_bdt += 0.00;
                }
              ?>
            </td>
            <td align="center">
              <?php 
                if($row->paid_amount == 0.00){ 
                  echo $this->lang->line('sales_pending');
                }
                else{ 
                  echo $this->lang->line('sales_complited');
                }
              ?>
            </td>
          <?php
              if($row->currency_id == 1){
                $grand_tot_usd += $row->total;
              }

              else{
                $grand_tot_bdt += $row->total;
              }
            }
          ?>
      <tfoot>
      <tr>
        <th><?php echo $this->lang->line('product_no'); ?>.</th>
        <!-- <th><?php echo $this->lang->line('purchase_date'); ?></th> -->
        <th><?php echo $this->lang->line('purchase_reference_no'); ?></th>
        <th>Company Name</th>
        <th>Shipping Mode</th>
        <th>Status</th>
        <th><span id="ft_grand_tot"><?php echo 'Grand Total: <br>'; ?><?php echo '$' . number_format((float)$grand_tot_usd, 2, '.', '') . '<br>BDT ' . number_format((float)$grand_tot_bdt, 2, '.', ''); ?></span></th>
        <th><span id="ft_paid_tot"><?php echo 'Paid: <br>'; ?><?php echo '$' . number_format((float)$tot_paid_usd, 2, '.', '') . '<br>BDT ' . number_format((float)$tot_paid_bdt, 2, '.', ''); ?></span></th>
        <th><?php echo $this->lang->line('sales_payment_status'); ?></th>
      </tr>
      </tfoot>
    </table>
</body>

<script>
  window.print();
</script>