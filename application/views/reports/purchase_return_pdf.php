
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
                      <th width="10%"><?php echo $this->lang->line('product_no'); ?></th>
                      <th width="10%"><?php echo $this->lang->line('purchase_reference_no'); ?></th>
                      <th width="20%"><?php echo $this->lang->line('header_warehouse'); ?></th>
                      <th width="20%"><?php echo $this->lang->line('reports_supplier'); ?></th>
                      <th width="30%"><?php echo $this->lang->line('reports_product_qty'); ?></th>
                      <th width="10%"><?php echo $this->lang->line('purchase_total'); ?></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                      foreach ($purchase_return as $row) {
                    ?>
                    <tr>
                      <td><?php echo $row->date; ?></td>
                      <td><?php echo $row->reference_no; ?></td>
                      <td><?php echo $row->warehouse_name; ?></td>
                      <td><?php echo $row->supplier_name; ?></td>
                      <td>
                        <?php
                          foreach ($purchase_return_items as $value) {
                            foreach ($products as $key) {
                              if($row->id == $value->purchase_return_id){
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