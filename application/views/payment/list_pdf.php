<head>
	<title>Payment List</title>
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
	<h1 style="text-align: center;">Payment List</h1>

	<table width="99%" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th><?php echo $this->lang->line('product_no'); ?></th>
        <!-- <th><?php echo $this->lang->line('purchase_date'); ?></th> -->
        <th><?php echo $this->lang->line('purchase_reference_no'); ?></th>
        <th>Payment Method</th>
        <th><?php echo $this->lang->line('sales_amount'); ?></th>
        <th>Taken By</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        foreach ($data as $key => $row) {
           $id= $row->id;
      ?>
      <tr>
        <td><?php echo ++$key; ?></td>
        <!-- <td><?php echo $row->date; ?></td> -->
        <td><?php echo $row->reference_no; ?></td>
        <td><?php echo $row->paying_by ?></td>
        <td>
          <?php 
            if($row->currency_id == 1){
              echo '$ ';
            }
            else{
              echo '৳ ';
            }
            echo $row->amount;
          ?>
        </td>
        <td><?php echo $row->name; if($row->designation){ echo ' (' . $row->designation . ')'; } echo ', ' . $row->contact; ?></td>
      <?php
        }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <th><?php echo $this->lang->line('product_no'); ?></th>
        <!-- <th><?php echo $this->lang->line('purchase_date'); ?></th> -->
        <th><?php echo $this->lang->line('purchase_reference_no'); ?></th>
        <th>Payment Method</th>
        <th><?php echo $this->lang->line('sales_amount'); ?></th>
        <th>Taken By</th>
      </tr>
    </tfoot>
  </table>
</body>

<script>
  window.print();
</script>