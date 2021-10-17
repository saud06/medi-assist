<head>
	<title>Check Out History</title>
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
	<h1 style="text-align: center;">Check Out History</h1>

	<table width="99%" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>No.</th>
        <th>Reference No.</th>
        <th>Product Name</th>
        <!-- <th>Category</th>
        <th>Sub Category</th> -->
        <th>Customer</th>
        <th>Issued Datetime</th>
        <th>Quantity</th>
        <th>Checked By</th> 
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($data as $i => $row) {
       $id= $row->check_out_history_id; ?>
       <tr>
        <td><?php echo ++$i; ?> </td>
        <td><?php echo $row->reference_no; ?></td> 
        <td><?php 
        $product_id= $row->product_id;
        $this->db->where('product_id', $product_id);
        $cat_id = $this->db->get('check_out_history')->result_array();
        $var = $cat_id[0]['product_id'];
        $cat_idd = explode(",", $var);
        foreach ($cat_idd as $value) {
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
        foreach ($cat_idd as $value) {
          $this->db->where('category_id', $value);
          $cat_name = $this->db->get('category')->result_array();
          echo $cat_name[0]['category_name'] . '<br>';
        }
        ?>
        </td> -->
        <<!-- td><?php 
        $product_id= $row->product_id;
        $this->db->where('product_id', $product_id);
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

        <td><?php echo $row->company_name; ?></td> 
        <td><?php echo $row->out_date; ?></td>
        <td><?php echo $row->out_quantity; ?></td> 
        <td><?php echo $row->user_name; ?></td> 
       </tr>
      <?php
      }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <th>No.</th>
        <th>Reference No.</th>
        <th>Product Name</th>
        <!-- <th>Category</th>
        <th>Sub Category</th> -->
        <th>Customer</th>
        <th>Issued Datetime</th>
        <th>Quantity</th>
        <th>Checked By</th> 
      </tr>
    </tfoot>
  </table>
</body>

<script>
  window.print();
</script>