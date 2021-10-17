<head>
	<title>User List</title>
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
	<h1 style="text-align: center;">User List</h1>

	<table width="99%" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>
            <?php echo $this->lang->line('product_no'); ?>.
        </th>
        <th><!-- Employee ID -->
            Employee ID
        </th>
        <th><!-- First Name -->
            <?php echo $this->lang->line('user_lable_fname'); ?>
        </th>
        <th><!-- Last Name -->
            <?php echo $this->lang->line('user_lable_lname'); ?>
        </th>
        <th><!-- Email -->
            <?php echo $this->lang->line('user_lable_email'); ?>
        </th>
        <th><!-- Type -->
            Type
        </th>
        <th><!-- Category -->
            Category
        </th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $key => $user):?>
        <tr>
          <td><?php echo ++$key;?></td>
          <td><?php echo $user->emp_id;?></td>
          <td><?php echo $user->first_name;?></td>
          <td><?php echo $user->last_name;?></td>
          <td><?php echo $user->username;?></td>
          <td>
            <?php foreach ($user->groups as $key2 => $group):
                    echo $key2+1 . '. ' . $group->description . '<br>';
                  endforeach
              ?>
          </td>
          <td>
            <!-- <?php 
              foreach ($users[$key]->categories as $category): 
                if($category->category_id == $user->category_id){
                  echo $category->category_name;
                }
              endforeach;
              
              if(!$user->category_id){
                echo 'N/A';
              }
            ?> -->

            <?php 
              $this->db->where('id', $user->id);
              $cat_id = $this->db->get('users')->result_array();
              $var = $cat_id[0]['category_id'];
              $cat_idd = explode(",", $var);

              $cat_data = array();
              foreach ($cat_idd as $key2 => $value) {
                $this->db->where('category_id', $value);
                $categories = $this->db->get('category')->result_array();
                
                if(empty($categories)){ 
                  array_push($cat_data, 'N/A');
                }
                else{ 
                  array_push($cat_data, $categories[0]['category_name']);
                }
              }

              foreach ($cat_data as $key3 => $value) {
                if($value == 'N/A'){ 
                  echo $value;
                }
                else{
                  echo ($key3+1) . '. ' . $value . '<br>';
                }
              }
            ?>
          </td>
        </tr>
      <?php endforeach;?>
    </tbody>
    <tfoot>
      <tr>
        <th>
            <?php echo $this->lang->line('product_no'); ?>.
        </th>
        <th><!-- Employee ID -->
            Employee ID
        </th>
        <th><!-- First Name -->
            <?php echo $this->lang->line('user_lable_fname'); ?>
        </th>
        <th><!-- Last Name -->
            <?php echo $this->lang->line('user_lable_lname'); ?>
        </th>
        <th><!-- Email -->
            <?php echo $this->lang->line('user_lable_email'); ?>
        </th>
        <th><!-- Type -->
            Type
        </th>
        <th><!-- Category -->
            Category
        </th>
      </tr>
    </tfoot>
  </table>
</body>

<script>
  window.print();
</script>