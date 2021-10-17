<head>
	<title>Employee List</title>
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
	<h1 style="text-align: center;">Employee List</h1>

	<table width="99%" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th><!-- No -->
            <?php echo $this->lang->line('biller_lable_no'); ?>.
        </th>
        <th><!-- Employee Photo -->
            Employee Photo
        </th>
        <th><!-- Employee ID -->
            Employee ID
        </th>
        <th><!-- Name -->
            Name
        </th>
        <th><!-- Phone -->
            Phone
        </th>
        <th><!-- Email -->
            Email
        </th>
        <th><!-- Address -->
            Address
        </th>
        <th><!-- Designation -->
            Designation
        </th>
        <th><!-- Start & End Time -->
            Start &<br>End Time
        </th>
        <th><!-- Weekly Holiday -->
            Weekly Holiday 
        </th>
      </tr>
    </thead>
    <tbody>
      <?php
        foreach ($data as $key => $row) {
          $id = $row->id;
      ?>
          <tr>
            <td><?php echo ++$key ?></td>
            <td><img class="img-circle" width="50" height="50" src="<?php echo $row->emp_photo; ?>"></td>
            <td><?php echo $row->employee_id ?></td>
            <td><?php echo $row->first_name . ' ' . $row->last_name; ?></td>
            <td><?php echo $row->cphone ?></td>
            <td><?php echo $row->cemail ?></td>
            <td><?php echo $row->pre_address ?></td>
            <td><?php echo $row->join_desg ?></td>
            <td><?php echo $row->start_time . ' -<br>' . $row->end_time; ?></td>
            <td><?php echo $row->wk_holiday ?></td>
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
        <th><!-- Employee Photo -->
            Employee Photo
        </th>
        <th><!-- Employee ID -->
            Employee ID
        </th>
        <th><!-- Name -->
            Name
        </th>
        <th><!-- Phone -->
            Phone
        </th>
        <th><!-- Email -->
            Email
        </th>
        <th><!-- Address -->
            Address
        </th>
        <th><!-- Designation -->
            Designation
        </th>
        <th><!-- Start & End Time -->
            Start &<br>End Time
        </th>
        <th><!-- Weekly Holiday -->
            Weekly Holiday 
        </th>
      </tr>
    </tfoot>
  </table>
</body>

<script>
  window.print();
</script>