<head>
  <title>
    <?php echo $category_name . ' Product List'; ?>
  </title>
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
  <h1 style="text-align: center;">
    <?php echo $category_name . ' Product List'; ?>
  </h1>

  <table width="99%" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th><?php echo $this->lang->line('product_no'); ?>.</th>
          <th><?php echo $this->lang->line('product_image'); ?></th>
          <th><?php echo $this->lang->line('product_name'); ?></th>
          <th>Customer (Local Client) </th>
          <th>Contact Person </th>
          <th>Responsible Person</th>
          <th>Inventory</th>
          <!-- <th>Check-Out Status</th> -->
        </tr>
      </thead>
      <tbody>
        <?php 
        $row_counter = 0;
        foreach ($data as $row){
          $clients = $row->clients;
          $check_outs = $row->check_outs;
          $users = $row->users;
          $responsible_person_data = [];

          if(count($clients) > 0){
        ?>
            <tr>
              <td><?php echo ++$row_counter; ?></td>
              <td width="5%"><img src="<?php echo $row->image; ?>" width="100%" height="60px"></td>
              <td><?php echo $row->name; ?></td>
              <td>
                <?php
                  for($i=0; $i<count($clients); $i++){
                    if($client_id == 0){
                      echo ($i+1) . '. ' . $clients[$i]->company_name . '<br>';
                    }
                    else{
                      if($clients[$i]->client_id == $client_id){
                        echo ($i+1) . '. ' . $clients[$i]->company_name . '<br>';
                        break;
                      }
                    }
                  }
                ?>
              </td>
              <td>
                <?php 
                  for($i=0; $i<count($clients); $i++){
                    if($clients[$i]->contact_person){
                      echo '<p style="cursor: help;" data-html="true" data-toggle="tooltip" title="<u>Contact Details</u><br><br>Phone: ' . $clients[$i]->contact_person_phone . '<br>Email: ' . $clients[$i]->email . '<br><br>">' . ($i+1) . '. ' . $clients[$i]->contact_person . '</p>';
                    }
                  }
                ?>
              </td>
              <td>
                <?php
                  for($i=0; $i<count($clients); $i++){
                    if($client_id == 0){
                      array_push($responsible_person_data, $clients[$i]->responsible_person_id);
                    }
                    else{
                      if($clients[$i]->client_id == $client_id){
                        array_push($responsible_person_data, $clients[$i]->responsible_person_id);
                        break;
                      }
                    }
                  }

                  foreach ($responsible_person_data as $key => $value) {
                   echo $key+1 . '. ';

                    foreach ($users as $key2 => $value2) {
                      if(in_array($value2->id, explode(",", $value))){
                        echo $value2->first_name . ' ' . $value2->last_name;

                        if(sizeof(explode(",", $value)) > 1){
                          if($key2 != sizeof(explode(",", $value))-1){
                            echo ', ';
                          }
                        }
                      }
                    }

                    echo '<br>'; 
                  }
                ?>
              </td>
              <td>
                <?php 
                  $inv_status = '';
                  if($row->is_inventory == 1){
                    echo $inv_status = 'Available';
                  }
                  else{
                    echo $inv_status = 'N/A';
                  }
                ?>
              </td>
              <!-- <td>
                <?php 
                  echo '<span class="pull-left">';
                    for($i=0; $i<count($check_outs); $i++){
                      echo ($i+1) . '. <strong>Name:</strong> ' . $check_outs[$i]->company_name . '&emsp;<strong>Quantity:</strong> ' . $check_outs[$i]->out_quantity . '<br>';
                    }
                  echo '</span>';
                ?>
              </td> -->
            </tr>
      <?php
          }
        }
        ?>
      </tbody>
      <tfoot>
        <tr>
          <th><?php echo $this->lang->line('product_no'); ?>.</th>
          <th><?php echo $this->lang->line('product_image'); ?></th>
          <th><?php echo $this->lang->line('product_name'); ?></th>
          <th>Customer (Local Client) </th>
          <th>Contact Person </th>
          <th>Responsible Person</th>
          <th>Inventory</th>
          <!-- <th>Check-Out Status</th> -->
        </tr>
      </tfoot>
    </table>
</body>

<script>
  window.print();
</script>