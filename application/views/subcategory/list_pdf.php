<head>
	<title>Subcategory List</title>
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
	<h1 style="text-align: center;">Subcategory List</h1>

	<table width="99%" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th><?php echo $this->lang->line('product_no'); ?>.</th>
        <th><?php echo $this->lang->line('product_code'); ?></th>
        <th><?php echo $this->lang->line('product_name'); ?></th>
        <th><?php echo $this->lang->line('header_category'); ?></th>
        <th>Description</th>
      </tr>
    </thead>
    <tbody>
      <?php 
        foreach ($data as $key => $row) {
          $id= $row->sub_category_id;
      ?>
          <tr>
            <td><?php echo ++$key; ?></td>
            <td><?php echo $row->sub_category_code; ?></td>
            <td><?php echo $row->sub_category_name; ?></td>
            <td><?php echo $row->category_name ?></td>
            <td><?php echo $row->sub_category_desc ?></td>
          </tr>
      <?php
        }
      ?>
    </tbody>
    <tfoot>
      <tr>
        <th><?php echo $this->lang->line('product_no'); ?>.</th>
        <th><?php echo $this->lang->line('product_code'); ?></th>
        <th><?php echo $this->lang->line('product_name'); ?></th>
        <th><?php echo $this->lang->line('header_category'); ?></th>
        <th>Description</th>
      </tr>
    </tfoot>
  </table>
</body>

<script>
  window.print();
</script>