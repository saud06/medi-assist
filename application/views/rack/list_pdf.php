<head>
	<title>Rack List</title>
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
	<h1 style="text-align: center;">Rack List</h1>

	<table width="99%" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>No.</th>
        <th>Rack Name</th>
        <th>Shelf Name</th>
        <th>Location</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        foreach ($data as $key => $row) {
           $id= $row->rack_id;
      ?>
      <tr>
        <td><?php echo ++$key; ?></td>
        <td><?php echo $row->rack_name; ?></td>
        <td><?php echo $row->shelf_name; ?></td>
        <td><?php echo $row->rack_location; ?></td>
      </tr>
      <?php
        }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <th>No.</th>
        <th>Rack Name</th>
        <th>Shelf Name</th>
        <th>Location</th>
      </tr>
    </tfoot>
  </table>
</body>

<script>
  window.print();
</script>