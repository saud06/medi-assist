<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','accountant','manager');
if(!(in_array($this->session->userdata('type'),$p))){
  redirect('auth/dashboard');
}
?> 

                <table border="1">
                   <thead>
                    <tr>
                      <th width="10%"><?php echo $this->lang->line('purchase_date'); ?></th>
                      <th width="10%"><?php echo $this->lang->line('purchase_reference_no'); ?></th>
                      <th width="20%"><?php echo $this->lang->line('reports_biller'); ?></th>
                      <th width="20%"><?php echo $this->lang->line('reports_client'); ?></th>
                      <th width="30%"><?php echo $this->lang->line('reports_product_qty'); ?></th>
                      <th width="10%"><?php echo $this->lang->line('purchase_total'); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                      foreach ($sales_return as $row) {
                    ?>
                    <tr>
                      <td><?php echo $row->date; ?></td>
                      <td><?php echo $row->reference_no; ?></td>
                      <td><?php echo $row->biller_name; ?></td>
                      <td><?php echo $row->client_name; ?></td>
                      <td>
                      	<?php
                      		foreach ($sales_return_items as $value) {
                      			foreach ($products as $key) {
	                      			if($row->id == $value->sale_return_id){
	                      				if($value->product_id == $key->product_id){
	                      					echo $key->name."(".$value->quantity.")<br>";
	                      				}
	                      				
	                      			}
	                      		}
                      		}
                      	?>
                      		
                      </td>
                      <td><?php echo $this->session->userdata('symbol').$row->total; ?></td>
                    <?php
                      }
                    ?>
                    </tr>
                  </tbody>
                </table>
<script>
  window.print();
</script>  