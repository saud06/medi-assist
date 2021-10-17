<head>
	<title>Receipt List</title>
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
	<h1 style="text-align: center;">Receipt List</h1>

	<table width="99%" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th><?php echo $this->lang->line('product_no'); ?>.</th>
        <!-- <th><?php echo $this->lang->line('purchase_date'); ?></th> -->
        <th><?php echo $this->lang->line('sales_invoice_no'); ?></th>
        <th>Purchase Amount</th>
      </tr>
    </thead>
    <tbody>
      <?php 
          foreach ($data as $key => $row) {
             $id= $row->purchase_id;
        ?>
        <tr>
          <td><?php echo ++$key; ?></td>
          <!-- <td><?php echo $row->receipt_voucher_date; ?></td> -->
          <td align="center"><?php echo $row->invoice_no; ?></td>
          <td align="right">
            <?php 
              if($row->currency_id == 1){
                echo '$ ';
              }
              else{
                echo '৳ ';
              }
              echo $row->receipt_amount;
            ?>
          </td>
        </tr>
      <?php
        }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <th><?php echo $this->lang->line('product_no'); ?>.</th>
        <!-- <th><?php echo $this->lang->line('purchase_date'); ?></th> -->
        <th><?php echo $this->lang->line('sales_invoice_no'); ?></th>
        <th>Purchase Amount</th>
      </tr>
    </tfoot>
  </table>
</body>

<script>
  window.print();
</script>