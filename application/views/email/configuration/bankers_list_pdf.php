<head>
	<title>Banker List</title>
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
	<h1 style="text-align: center;">Banker List</h1>

	<table width="99%" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>No.</th>
        <th>Name</th>
        <th>Details</th>
        <th>Address</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      foreach ($data as $key => $row) {
       $id= $row->bankers_ec_id;
       ?>
       <tr>
        <td><?php echo ++$key; ?></td>
        <td><?php echo $row->bankers_ec_name; ?></td>
        <td><?php echo $row->bankers_ec_details; ?></td>
        <td><?php echo $row->bankers_ec_address; ?></td>
       </tr>
      <?php
      }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <th>No.</th>
        <th>Name</th>
        <th>Details</th>
        <th>Address</th>
      </tr>
    </tfoot>
  </table>
</body>

<script>
  window.print();
</script>