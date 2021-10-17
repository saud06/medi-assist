<head>
	<title>Stock Record</title>
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
	<h1 style="text-align: center;">Stock Record</h1>

	<table width="99%" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>No.</th>
        <th>Product Name</th>
        <!-- <th>Category</th>
        <th>Sub Category</th> -->
        <th>Client</th>                
        <th>Location</th>
        <th style="text-align: center;">Transaction<br> Mode</th>
      </tr>
    </thead>
    <tbody>
      <?php
        foreach ($data as $i => $row){
          $id= $row->inventory_id;
      ?>
          <tr>
            <td><?php echo ++$i; ?> </td>
            <td><?php echo $row->name; ?></td>
            <!-- <td>
              <?php 
                $category_id= $row->category_id;
                $this->db->where('category_id', $category_id);
                $cat_id = $this->db->get('products')->result_array();
                $var = $cat_id[0]['category_id'];
                $cat_idd = explode(",", $var);
                foreach ($cat_idd as $value) {
                  $this->db->where('category_id', $value);
                  $cat_name = $this->db->get('category')->result_array();
                  echo $cat_name[0]['category_name'] . '<br>';
                }
              ?>
            </td> -->
            <!-- <td>
              <?php 
                $sub_category_id= $row->subcategory_id;
                $this->db->where('subcategory_id', $sub_category_id);
                $cat_id = $this->db->get('products')->result_array();
                $var = $cat_id[0]['subcategory_id'];
                $cat_idd = explode(",", $var);
                foreach ($cat_idd as $value) {
                  $this->db->where('sub_category_id', $value);
                  $cat_name = $this->db->get('sub_category')->result_array();
                  if($cat_name){
                    echo $cat_name[0]['sub_category_name'] . '<br>';
                  }
                }
              ?>
            </td> -->
            <td>
              <?php 
                $client_id= $row->client_id;
                $this->db->where('client_id', $client_id);
                $cat_id = $this->db->get('products')->result_array();
                $var = $cat_id[0]['client_id'];
                $cat_idd = explode(",", $var);
                foreach ($cat_idd as $key => $value) {
                  $this->db->where('client_id', $value);
                  $cat_name = $this->db->get('client')->result_array();
                  if($cat_name){
                    echo ($key+1) . '. ' . $cat_name[0]['company_name'] . '<br>';
                  }
                }
              ?>
            </td>
            <td>
              Shelf: <?php echo $row->shelf_name; ?><br>
              Rack: <?php echo $row->rack_name; ?>
            </td>
            <td style="text-align: center;">
              <?php 
                if($row->totalProduct > 0){
                  echo "Purchase <br>" ?> <strong><?php echo $row->totalProduct; ?></strong>
              <?php
                }
                else{
                  echo "Sales <br>"  ?> <strong><?php echo abs($row->totalProduct); ?></strong>
              <?php 
                }
              ?>
            </td>
          </tr>
      <?php
        }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <th>No.</th>
        <th>Product Name</th>
        <!-- <th>Category</th>
        <th>Sub Category</th> -->
        <th>Client</th>                
        <th>Location</th>
        <th style="text-align: center;">Transaction<br> Mode</th>
      </tr>
    </tfoot>
  </table>
</body>

<script>
  window.print();
</script>