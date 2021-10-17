<head>
	<title>
        <?php 
            if($type == 1){ 
                echo  'Manufacturer & Supplier List';
            } 
            else{
                echo 'BD Customer List';
            }
        ?>
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
        <?php 
            if($type == 1){ 
                echo  'Manufacturer & Supplier List';
            } 
            else{
                echo 'BD Customer List';
            }
        ?>
    </h1>

	<table width="99%" class="table table-bordered table-striped">
    <thead>
      <tr>
          <th><!-- No -->
              <?php echo $this->lang->line('biller_lable_no'); ?>.
          </th>
          <th><!-- Company Name -->
              Company Name
          </th>
          <th><!-- Company Phone -->
              Company Phone
          </th>
          <th><!-- Name -->
              Contact Person
          </th>
          <th><!-- Phone -->
              Phone
          </th>
          <th><!-- Email Address -->
              <?php echo $this->lang->line('biller_lable_email'); ?>
          </th>
          <th><!-- Client Address -->
              Client Address
          </th>
          <th><!-- Type -->
              Type
          </th>
          <th><!-- Category -->
              Category
          </th>
          <th><!-- Responsible Person -->
              Responsible Person
          </th>
        </tr>
    </thead>
    <tbody>
      <?php
        if($type == 1){
            $ctypname = array('Manufacturer', 'Supplier', 'Manufacturer & Supplier');
        }
        else{
            $ctypname = array('Customer'); 
        }

        $counter = 0;
        foreach ($data as $row) {
          if(in_array($row->ctypname, $ctypname)){
            $id= $row->client_id;
      ?>
            <tr>
              <td><?php echo $counter+1; ?></td>
              <td><?php echo $row->company_name; ?></td>
              <td><?php echo $row->company_phone ?></td>
              <td><?php echo $row->contact_person ?></td>
              <td><?php echo $row->contact_person_phone ?></td>
              <td><?php echo $row->email ?></td>
              <td>
                <?php
                  if(!empty($row->house_no)) echo $row->house_no . ', ';
                  if(!empty($row->road_no)) echo $row->road_no . ',<br>';
                  if(!empty($row->loc_city)){ 
                    if(!empty($row->loc_area)){
                      echo $row->loc_area . ', ';
                    }
                    echo $row->loc_city . ', ';
                  }
                  else{
                    if(!empty($row->ctname)){
                      echo $row->ctname . ', ';
                    }
                    if(!empty($row->stname)){
                      echo $row->stname;
                    }
                  }
                  if(!empty($row->zip_code)){
                    echo ' ' . $row->zip_code;
                  }
                  if(empty($row->house_no) && empty($row->road_no) && empty($row->loc_city) && empty($row->loc_area) && empty($row->ctname) && empty($row->stname) && empty($row->zip_code)){
                    echo $row->cname;
                  }
                  else{
                    echo ', ' . $row->cname;
                  }
                ?>
              </td>
              <td><?php echo $row->ctypname ?></td>
              <td>
                <?php 
                  $this->db->where('client_id', $id);
                  $cat_id = $this->db->get('client')->result_array();
                  $var = $cat_id[0]['category_id'];
                  $cat_idd = explode(",", $var);

                  $cat_data = array();
                  foreach ($cat_idd as $key => $value) {
                    $this->db->where('category_id', $value);
                    $categories = $this->db->get('category')->result_array();
                    
                    array_push($cat_data, $categories[0]['category_name']);
                  }

                  foreach ($cat_data as $key => $value) {
                    echo ($key+1) . '. ' . $value . '<br>';
                  }
                ?>
              </td>
              <td>
                <?php 
                  $this->db->where('client_id', $id);
                  $res_id = $this->db->get('client')->result_array();
                  $var = $res_id[0]['responsible_person_id'];
                  $res_idd = explode(",", $var);

                  $res_data = array();
                  foreach ($res_idd as $key => $value) {
                    $this->db->where('id', $value);
                    $responsible_persons = $this->db->get('users')->result_array();
                    
                    if($responsible_persons){
                      array_push($res_data, $responsible_persons[0]['first_name'] . ' ' . $responsible_persons[0]['last_name']);
                    }
                  }

                  foreach ($res_data as $key => $value) {
                    echo ($key+1) . '. ' . $value . '<br>';
                  }
                ?>
              </td>
            </tr>
      <?php
            $counter++;
          }
        }
      ?>
    </tbody>
    <tfoot>
      <tr>
          <th><!-- No -->
              <?php echo $this->lang->line('biller_lable_no'); ?>.
          </th>
          <th><!-- Company Name -->
              Company Name
          </th>
          <th><!-- Company Phone -->
              Company Phone
          </th>
          <th><!-- Name -->
              Contact Person
          </th>
          <th><!-- Phone -->
              Phone
          </th>
          <th><!-- Email Address -->
              <?php echo $this->lang->line('biller_lable_email'); ?>
          </th>
          <th><!-- Client Address -->
              Client Address
          </th>
          <th><!-- Type -->
              Type
          </th>
          <th><!-- Category -->
              Category
          </th>
          <th><!-- Responsible Person -->
              Responsible Person
          </th>
        </tr>
    </tfoot>
  </table>
</body>

<script>
  window.print();
</script>