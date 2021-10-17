<head>
	<title>Petty Cash History</title>
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
	<h1 style="text-align: center;">Petty Cash History</h1>

	<table width="99%" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th><!-- No -->
            <?php echo $this->lang->line('biller_lable_no'); ?>.
        </th>
        <th><!-- Employee ID -->
            Employee ID
        </th>
        <th><!-- Name -->
            Name
        </th>
        <th><!-- Assign Total -->
            Assigned Total
        </th>
      </tr>
    </thead>
    <tbody>
      <?php
        foreach ($data as $key => $row) {
          $id = $row->id;
          $emp_id = $row->employee_id;
          $name = $row->first_name . ' ' . $row->last_name;
      ?>
          <tr>
            <td><?php echo ++$key ?></td>
            <td><?php echo $row->employee_id ?></td>
            <td><?php echo $row->first_name . ' ' . $row->last_name; ?></td>
            <td>
              <?php 
                $this->db->select('SUM( amount ) AS total_amount')
                     ->from('petty_cash_assign_history')
                     ->where('emp_id', $emp_id);

                $query = $this->db->get();
                $result = $query->result();

                echo $result[0]->total_amount;
              ?>
            </td>
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
        <th><!-- Employee ID -->
            Employee ID
        </th>
        <th><!-- Name -->
            Name
        </th>
        <th><!-- Assign Total -->
            Assigned Total
        </th>
      </tr>
    </tfoot>
  </table>
</body>

<script>
  window.print();
</script>