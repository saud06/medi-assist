<head>
	<title>Check In History</title>
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
	<h1 style="text-align: center;">Check In History</h1>

	<table width="99%" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>No.</th>
        <th>Product Name</th>
        <!-- <th>Category</th>
        <th>Sub Category</th> -->
        <th>Customer</th>
        <th>Returned Datetime</th>
        <th>Return Quantity</th>
        <th>Status</th>
        <th>Remarks</th>
        <th>Checked By</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($data as $i => $row) {
       $id= $row->check_in_history_id;
       ?>
       <tr>
        <td><?php echo ++$i; ?> </td>
        <!-- <td><?php echo $row->name; ?></td> -->
        <td><?php 
        $product_id= $row->product_id;
        $this->db->where('product_id', $product_id);
        $cat_id = $this->db->get('check_in_history')->result_array();
        $var = $cat_id[0]['product_id'];
        $cat_idd = explode(",", $var);
        foreach ($cat_idd as $key => $value) {
          $this->db->where('product_id', $value);
          $cat_name = $this->db->get('products')->result_array();
          echo $cat_name[0]['name'] . '<br>';
        }
        
        ?>
        </td>
        <!-- <td><?php 
        $product_id= $row->product_id;
        $this->db->where('product_id', $product_id);
        $cat_id = $this->db->get('products')->result_array();
        $var = $cat_id[0]['category_id'];
        $cat_idd = explode(",", $var);
        foreach ($cat_idd as $key => $value) {
          $this->db->where('category_id', $value);
          $cat_name = $this->db->get('category')->result_array();
          echo $cat_name[0]['category_name'] . '<br>';
        }
        ?>
        </td> -->
        <!-- <td><?php 
        $product_id= $row->product_id;
        $this->db->where('product_id', $product_id);
        $cat_id = $this->db->get('products')->result_array();
        $var = $cat_id[0]['subcategory_id'];
        $cat_idd = explode(",", $var);
        foreach ($cat_idd as $key => $value) {
          $this->db->where('sub_category_id', $value);
          $cat_name = $this->db->get('sub_category')->result_array();
          echo $cat_name[0]['sub_category_name'] . '<br>';
        }
        ?>
        </td> -->
        <td><?php echo $row->company_name; ?></td> 
        <td><?php echo $row->in_date; ?></td>         
        <td><?php echo $row->in_quantity; ?></td> 
        <td><?php echo $row->status; ?></td> 
        <td><?php echo $row->remarks; ?></td> 
        <td><?php echo $row->user_name; ?></td> 
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
        <th>Customer</th>
        <th>Returned Datetime</th>
        <th>Return Quantity</th>
        <th>Status</th>
        <th>Remarks</th>
        <th>Checked By</th>
      </tr>
    </tfoot>
  </table>
</body>

<script>
  window.print();
</script>