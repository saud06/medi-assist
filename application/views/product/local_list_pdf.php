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
        <!-- <th><?php echo $this->lang->line('product_image'); ?></th> -->
        <th><?php echo $this->lang->line('product_name'); ?></th>
        <th>Customer (Local Client) </th>
        <th>Contact Person </th>
        <th>Responsible Person</th>
        <th>Inventory</th>
        <th>Check-Out Status</th>
        <th>Approval Status</th>
      </tr>
    </thead>
    <tbody>
      <?php 
      $row_counter = 0;
      foreach ($data as $row){
        if($row->category_name == $category_name){
          $id = $row->product_id;
          $this->db->where('product_id', $id);
          $products = $this->db->get('products')->result_array();
          $client_ids = $products[0]['client_id'];
          $client_id = explode(",", $client_ids);

          $client_data = array();
          $client_id_data = array();
          $contact_person_data = array();
          $responsible_person_data = array();
          foreach ($client_id as $key => $value) {
            $this->db->where('client_id', $value);
            $clients = $this->db->get('client')->result_array();

            if(isset($clients[0])){
              if($clients[0]['client_type_id'] == 1){
                array_push($client_id_data, $clients[0]['client_id']);
                array_push($client_data, $clients[0]['company_name']);
                array_push($contact_person_data, ['name' => $clients[0]['contact_person'], 'phone' => $clients[0]['contact_person_phone'], 'email' => $clients[0]['email']]);
                array_push($responsible_person_data, $clients[0]['responsible_person_id']);
              }
            }
          }

          $this->db->select('ch.client_id, cl.company_name, SUM(ch.out_quantity) AS out_quantity')
                   ->where('ch.product_id', $id)
                   ->join('client cl', 'ch.client_id = cl.client_id')
                   ->group_by('ch.client_id');
          $check_outs = $this->db->get('check_out_history ch')->result_array();

          $this->db->select('a.*, p.product_id')
                   ->where('a.product_id', $id)
                   ->join('products p', 'a.product_id = p.product_id');
          $approvals = $this->db->get('prod_approve_status a')->result();

          if(count($client_data) > 0){
    ?>
            <tr>
              <td><?php echo ++$row_counter; ?></td>
              <!-- <td width="5%"><img src="<?php echo $row->image; ?>" width="100%" height="60px"></td> -->
              <td><?php echo $row->name; ?></td>
              <td>
                <?php
                  foreach ($client_data as $key => $value) {
                    echo ($key+1) . '. ' . $value . '<br>';

                    /*$approved_checked = ''; $not_approved_checked = ''; $pending_checked = ''; $not_applicable_checked = '';
                    $this->db->select('*')
                             ->where('product_id', $id)
                             ->where('client_id', $client_id_data[$key]);
                    $approvals = $this->db->limit(1)->get('product_approval_status')->result();

                    if(isset($approvals) && !empty($approvals)){
                      echo '<strong>[' . $approvals[0]->approval_status . ']</strong><br>';
                    } */
                ?>
                <?php
                  }
                ?>
              </td>
              <td>
                <?php
                  foreach ($contact_person_data as $key => $value) {
                    if($value['name']){
                      echo ($key+1) . '. ' . $value['name'] . '<br>';
                    }
                  }
                ?>
              </td>
              <td>
                <?php
                  foreach ($responsible_person_data as $key => $value) {
                    foreach ($user as $key2 => $value2) {
                      if(in_array($value2->id, explode(",", $value))){
                        echo ($key+1) . '. ' . $value2->first_name . ' ' . $value2->last_name;

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
                  if($row->is_inventory == 1){
                    echo 'Available';
                  } 
                  else{ 
                    echo 'N/A'; 
                  } 
                ?>
              </td>
              <td>
                <span class="pull-left">
                  <?php 
                    foreach ($check_outs as $key => $value) {
                      if(isset($check_outs[$key])){
                        echo ($key+1) . '. ' . '<strong>Name:</strong> ' . $check_outs[$key]['company_name'] . '&emsp;<strong>Quantity:</strong> ' . $check_outs[$key]['out_quantity'] . '<br>';
                      }
                    }
                  ?>
                </span>
              </td>
              <td>
                <?php if($approvals) echo $approvals[0]->approval_status; ?>
              </td>
            </tr>
    <?php
          }
        }
      }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <th><?php echo $this->lang->line('product_no'); ?>.</th>
        <!-- <th><?php echo $this->lang->line('product_image'); ?></th> -->
        <th><?php echo $this->lang->line('product_name'); ?></th>
        <th>Customer (Local Client) </th>
        <th>Contact Person </th>
        <th>Responsible Person</th>
        <th>Inventory</th>
        <th>Check-Out Status</th>
        <th>Approval Status</th>
      </tr>
    </tfoot>
  </table>
</body>

<script>
  window.print();
</script>