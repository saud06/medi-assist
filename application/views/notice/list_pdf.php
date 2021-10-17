<head>
	<title>Notice List</title>
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
	<h1 style="text-align: center;">Notice List</h1>

	<table width="99%" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>No.</th>
        <th>Title</th>
        <!-- <th>Date</th> -->
        <th>Description</th>
      </tr>
    </thead>
    <tbody>
      <?php 
          foreach ($data as $key => $row) {
          $id= $row->notice_id;
      ?>
      <tr>
        <td><?php echo ++$key; ?></td>
        <td><?php echo $row->notice_title; ?></td>
        <!-- <td><?php echo $row->notice_date ?></td> -->
        <td><?php echo $row->notice_desc ?></td>
      </tr>
      <?php
        }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <th>No.</th>
        <th>Title</th>
        <!-- <th>Date</th> -->
        <th>Description</th>
      </tr>
    </tfoot>
  </table>
</body>

<script>
  window.print();
</script>