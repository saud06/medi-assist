<head>
  <title>TA / DA List</title>
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
  <h1 style="text-align: center;">TA /DA List</h1>
  
  <p style="text-align: center;"><?php if($this->uri->segment('4') && $this->uri->segment('5')){ ?> (From <strong><?= $this->uri->segment('4'); ?></strong> To <strong><?= $this->uri->segment('5'); ?></strong>) <?php } ?></p>
  
  <?php 
      $count = 0;
      foreach ($data as $row) {
          if($row->finalization_status !== 'Finalized') break;
          else $count++;
      }
     
      if($count == count($data)) echo '<p style="text-align: center;"><strong>FINALIZED</strong></p>';
  ?>

  <table width="99%" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th><?php echo $this->lang->line('product_no'); ?>.</th>
        <th>Date</th>
        <th>Title</th>
        <th>Total Amount</th>
        <th>Description</th>
        <th>Expensed By</th>
        <?php if($count != count($data)){ ?> <th>Status</th> <?php } ?>
      </tr>
    </thead>
    <tbody>
      <?php 
        $grand_tot = 0;

        foreach ($data as $key => $row) {
          $id= $row->ta_da_id;
      ?>
        <tr>
          <td><?php echo ++$key; ?></td>
          <td><?php echo $row->date; ?></td>
          <td><?php echo $row->title; ?></td>
          <td><?php echo $row->total_amount; ?></td>
          <td><?php echo $row->description; ?></td>
          <td><?php echo $row->expensed_by; ?></td>
          <?php if($count != count($data)){ ?> <td><?php echo $row->finalization_status; ?></td> <?php } ?>
        </tr>
      <?php
          $grand_tot += $row->total_amount;
        }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <th><?php echo $this->lang->line('product_no'); ?>.</th>
        <th>Date</th>
        <th>Title</th>
        <th><?php echo 'Grand Total: <br>'; ?><?php echo number_format((float)$grand_tot, 2, '.', ''); ?></th>
        <th>Description</th>
        <th>Expensed By</th>
        <?php if($count != count($data)){ ?> <th>Status</th> <?php } ?>
      </tr>
    </tfoot>
  </table>
</body>

<script>
  window.print();
</script>