<head>
	<title>Petty Cash List</title>
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
	<h1 style="text-align: center;">Petty Cash List</h1>

	<table width="99%" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th><!-- No -->
            <?php echo $this->lang->line('biller_lable_no'); ?>.
        </th>
        <th><!-- Date -->
            Date
        </th>
        <th><!-- Amount -->
            Amount
        </th>
        <th><!-- Remarks -->
            Remarks
        </th>
      </tr>
    </thead>
    <tbody>
      <?php
        foreach ($data as $key => $row) {
      ?>
          <tr>
            <td><?php echo ++$key ?></td>
            <td><?php echo $row->cash_date ?></td>
            <td><?php echo $row->amount; ?></td>
            <td><?php echo $row->remarks; ?></td>
          </tr>
      <?php
        }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <th><!-- No -->
            <?php echo $this->lang->line('biller_lable_no'); ?>.
        </th>
        <th><!-- Date -->
            Date
        </th>
        <th><!-- Amount -->
            Amount
        </th>
        <th><!-- Remarks -->
            Remarks
        </th>
      </tr>
    </tfoot>
  </table>
</body>

<script>
  window.print();
</script>