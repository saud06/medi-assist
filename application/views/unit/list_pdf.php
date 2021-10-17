<head>
	<title>Unit List</title>
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
	<h1 style="text-align: center;">Unit List</h1>

	<table width="99%" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>No.</th>                  
        <th>Unit Name</th>
        <th>Unit Symbol</th> 
        <th>Unit Size</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $i=1;
      foreach ($data as $row) {
        $id= $row->unit_id;
        ?>
        <tr>
          <td><?php echo $i ?></td>
          <td><?php echo $row->unit_name ?></td>
          <td><?php echo $row->unit_symbol ?></td>
          <td><?php echo $row->unit_size ?></td>
        </tr>
      <?php
      $i++;
      }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <th>No.</th>                  
        <th>Unit Name</th>
        <th>Unit Symbol</th> 
        <th>Unit Size</th>
      </tr>
    </tfoot>
  </table>
</body>

<script>
  window.print();
</script>