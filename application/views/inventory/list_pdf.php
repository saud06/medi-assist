<head>
	<title>Inventory Item List</title>
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
	<h1 style="text-align: center;">Inventory Item List</h1>

	<table width="99%" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>No.</th>
        <th>Product Name</th>
        <th>Client</th>
        <th>Sales<br>Quantity</th> 
        <th>Check-Out<br>Quantity</th>
        <th>Check-In<br>Quantity</th>
        <th>Available<br>Quantity</th>
      </tr>
    </thead>
    <tbody>
      <?php
        foreach ($data as $i => $row) {
          $id= $row->inventory_id;
      ?>
          <tr>
            <td><?php echo ++$i; ?></td>
            <td><?php echo $row->name; ?></td>
            <td>
              <?php 
                $client_id= $row->client_id;
                $this->db->where('client_id', $client_id);
                $cat_id = $this->db->get('products')->result_array();
                $var = $cat_id[0]['client_id'];
                $cat_idd = explode(",", $var);
                foreach ($cat_idd as $key => $value) {
                  $this->db->where('client_id', $value);
                  $cat_name = $this->db->get('client')->result_array();
                  if($cat_name){
                    echo ($key+1) . '. ' . $cat_name[0]['company_name'] . '<br>';
                  }
                }
              ?>
            </td>
            <td><?php echo $row->totalSales; ?></td>
            <td><?php echo $row->totalOut; ?></td>
            <td><?php echo $row->totalIn; ?></td>
            <td><?php echo ($row->totalProduct - $row->totalOut) + $row->totalIn; ?></td>
          </tr>
      <?php
        }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <th>No.</th>
        <th>Product Name</th>
        <th>Client</th>
        <th>Sales<br>Quantity</th> 
        <th>Check-Out<br>Quantity</th>
        <th>Check-In<br>Quantity</th>
        <th>Available<br>Quantity</th>
      </tr>
    </tfoot>
  </table>
</body>

<script>
  window.print();
</script>