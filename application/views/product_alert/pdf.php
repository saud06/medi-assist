<?php
/*defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','manager');
if(!(in_array($this->session->userdata('type'),$p))){
  redirect('auth/dashboard');
}*/
?>              
				<h3 style="padding-left: 40%"><center><?php echo $this->lang->line('header_list_product_alert'); ?></center></h3>
	
                <table border="1">
                   <thead>
                    <tr>
                      <th width="10%"><?php echo $this->lang->line('product_code'); ?></th>
                      <th width="15%"><?php echo $this->lang->line('product_name'); ?></th>
                      <th width="15%"><?php echo $this->lang->line('product_category'); ?></th>
                      <th width="10%"><?php echo $this->lang->line('product_cost'); ?></th>
                      <th width="10%"><?php echo $this->lang->line('product_price'); ?></th>
                      <th width="10%"><?php echo $this->lang->line('product_unit'); ?></th>
                      <th width="10%"><?php echo $this->lang->line('product_quantity'); ?></th>
                      <th width="10%"><?php echo $this->lang->line('product_alert_quantity'); ?></th>
                      <!-- <th>Action</th> -->
                    </tr>
                </thead>
	              <tbody>
	                <?php 
	                  foreach ($data as $row) {
	                     $id= $row->product_id;
	                ?>
	                <tr>
	                  <td align="center"><?php echo $row->code; ?></td>
	                  <td><?php echo $row->name; ?></td>
	                  <td><?php echo $row->cname; ?></td>
	                  <td align="right"><?php echo $this->session->userdata('symbol').$row->cost;?></td>
                      <td align="right"><?php echo $this->session->userdata('symbol').$row->price;?></td>
	                  <td><?php echo $row->unit; ?></td>
	                  <td align="center"><?php echo $row->quantity; ?></td>
	                  <td align="center"><?php echo $row->alert_quantity; ?></td>
	                <?php
	                  }
	                ?>
	                </tr>
	              </tbody>
            	</table>
              