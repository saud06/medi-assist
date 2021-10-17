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
                      <th width="30%"><?php echo $this->lang->line('product_product_name'); ?></th>
                      <th width="10%"><?php echo $this->lang->line('product_product_code'); ?></th>
                      <th width="10%"><?php echo $this->lang->line('reports_purchased'); ?></th>
                      <th width="10%"><?php echo $this->lang->line('product_cost'); ?></th>
                      <th width="10%"><?php echo $this->lang->line('reports_sold'); ?></th>
                      <th width="10%"><?php echo $this->lang->line('product_price'); ?></th>
                      <th width="10%"><?php echo $this->lang->line('purchase_total'); ?></th>
                      <th width="10%"><?php echo $this->lang->line('reports_profite_title'); ?></th>
                    </tr>
                </thead>
                  <tbody>
                  <?php 
                      foreach ($purchase as $row) {
                        foreach ($sales as  $srow) {
                         if($row->product_id == $srow->product_id){
                    ?>
                          <tr>
                            <td><?php echo $row->name; ?></td>
                            <td><?php echo $row->code; ?></td>
                            <td><?php echo $row->pquantity; ?></td>
                            <td align="right"><?php echo $this->session->userdata('symbol').$row->cost; ?></td>
                            <td>
                              <?php
                                foreach ($sales as $value) {
                                  if($row->product_id == $value->product_id){
                                    echo $value->squantity;
                                  }
                                }
                              ?>
                            </td>
                            <td align="right"><?php echo $this->session->userdata('symbol').$row->price; ?></td>
                            <td align="right"><?php echo $this->session->userdata('symbol').$row->total; ?></td>
                            <td align="right">
                              <?php
                                foreach ($sales as $value) {
                                  if($row->product_id == $value->product_id){
                                    $profit = ($value->squantity*$row->price) - ($value->squantity*$row->cost);
                                    echo $this->session->userdata('symbol')."<span style='color:green;'>".$profit."</span>";
                                  }
                                }
                              ?>
                            </td>
                          </tr>
                    <?php
                          }
                        }
                      }
                    ?>
                  </tbody>
                </table>
              