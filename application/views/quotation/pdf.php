<!DOCTYPE html>
<html>
	<head>
	<title>GST</title>
		<style>
			table, th, td
			 {
	    			border: 1px solid black;
			}
			table 
			{
    			width: 70%;
			}
	</style>
	</head>
	<body>
		<table width="100%" border="1" cellspacing="0" style="border: 1px solid black; border-collapse: collapse">
	        <tbody>
	          <tr>
	            <td></td>
	            <td colspan="13" align="center"><h3><?php  echo $company[0]->name;?></h3></td>
	            <td colspan="2" rowspan="2"></td>
	            <td></td>
	          </tr>
	          <tr>
	            <td></td>
	            <td colspan="13" align="center"><b>Quotation</b></td>
	            <td></td>
	          </tr>
	          <tr>
	            <td></td>
	            <td colspan="9"><?php echo $data[0]->biller_company; ?>,<?php echo $data[0]->biller_address; ?>, Phone <?php echo $data[0]->biller_telephone; ?>, Fax <?php echo $data[0]->biller_fax; ?>, Email: <?php echo $data[0]->biller_email; ?></td>
	            <td colspan="2">GSTIN:</td>
	            <td colspan="4"><?php if($data[0]->biller_gstid){echo $data[0]->biller_gstid;}
	            			 else{echo "NA";}?></td>
	            <td></td>
	          </tr>
	          <tr>
	            <td></td>
	            <td colspan="15"><?php echo $this->lang->line('sales_client_details'); ?></td>
	            <td></td>
	          </tr>
	          <tr>
	            <td></td>
	            <td></td>
	            <td><?php echo $this->lang->line('product_name'); ?></td>
	            <td colspan="9"><?php echo $data[0]->client_name; ?></td>
	            <td colspan="2"><?php echo $this->lang->line('sales_pos'); ?></td>
	            
	             
	            <td colspan="2"><?php echo $this->lang->line('sales_invoice_hash'); ?></td>
	            <td></td>
	          </tr>
	          <tr>
	            <td></td>
	            <td></td>
	            <td rowspan="3"><?php echo $this->lang->line('sales_address'); ?></td>
	            <td colspan="9"><?php echo $data[0]->client_company; ?></td>
	            <td colspan="2"><?php echo $data[0]->reference_no; ?></td>
	            <td colspan="2"></td>
	            <td></td>
	          </tr>
	          <tr>
	            <td></td>
	            <td></td>
	            <td colspan="8"><?php echo $data[0]->client_address; ?></td>
	            <td colspan="3">GSTIN:</td>
	            <td colspan="2"><?php echo $this->lang->line('purchase_date'); ?></td>
	            
	            <td></td>
	          </tr>
	          <tr>
	            <td></td>
	            <td></td>
	            <td colspan="8"><?php echo $data[0]->client_city.','.$data[0]->client_postal_code; 
	            				?></td>
	            <td colspan="3"><?php if($data[0]->client_gstid){echo $data[0]->client_gstid;} ?></td>
	            <td colspan="2"><?php echo date('Y-m-d'); ?></td>
	            
	            <td></td>
	          </tr>
	          <tr>
	            <td></td>
	            <td></td>
	           
	            <td colspan="3">Tan:</td>
	            <td colspan="2">Cst Reg. No</td>
	            <td colspan="2">Excise Reg.No:</td>
	            <td colspan="2">Lbt Reg.No:</td>
	            <td colspan="4">Service Tax Reg.No:</td>
	            <td></td>
	            <td></td>
	          </tr>
	          <tr>
	            <td></td>
	            <td></td>
	            <td colspan="3"><?php if($data[0]->tan_no){echo $data[0]->tan_no;}
	            						else{echo "NA";}?></td>
	            <td colspan="2"><?php if($data[0]->cst_reg_no){echo $data[0]->cst_reg_no;}
	            							else{echo "NA";} ?></td>
	            <td colspan="2"><?php if($data[0]->excise_reg_no){echo $data[0]->excise_reg_no;}
	            						else{echo "NA";} ?></td>
	            <td colspan="2"><?php if($data[0]->lbt_reg_no){echo $data[0]->lbt_reg_no;}
	            						else{echo "NA";} ?></td>
	            <td colspan="4"><?php if($data[0]->servicetax_reg_no){echo $data[0]->servicetax_reg_no;}
	            				else{echo "NA";} ?></td>
	            <td></td>
	            <td></td>
	          </tr>
	          
	          <tr>
	            <td></td>
	            <td colspan="15"><?php echo $this->lang->line('sales_product_wise_details'); ?></td>
	            <td></td>
	          </tr>
	          <tr>
	            <td></td>
	            <td><?php echo $this->lang->line('product_no'); ?></td>
	            <td colspan="2"><?php echo $this->lang->line('product_description'); ?></td>
	            <td><?php echo $this->lang->line('product_hsn_sac_code'); ?></td>
	            <td><?php echo $this->lang->line('product_quantity'); ?></td>
	            <td><?php echo $this->lang->line('product_unit'); ?></td>
	            <td><?php echo $this->lang->line('product_price').'('.$this->session->userdata('symbol').')'; ?></td>
	            <td><?php echo $this->lang->line('sales_total_sales').'('.$this->session->userdata('symbol').')'; ?></td>
	            <td><?php echo $this->lang->line('header_discount').'('.$this->session->userdata('symbol').')'; ?></td>
	            <td><?php echo $this->lang->line('purchase_taxable_value').'('.$this->session->userdata('symbol').')'; ?></td>
	            <td><?php echo $this->lang->line('sales_cgst').'('.$this->session->userdata('symbol').')'; ?></td>
	            <td><?php echo $this->lang->line('sales_sgst').'('.$this->session->userdata('symbol').')'; ?></td>
	            <td><?php echo $this->lang->line('sales_igst').'('.$this->session->userdata('symbol').')'; ?></td>
	            <td><?php echo $this->lang->line('purchase_total').'('.$this->session->userdata('symbol').')'; ?></td>
	          </tr>
	          <?php $i = 1;$tot = 0;foreach ($items as $value) { ?>
		          <tr>
		            <td></td>
		            <td align="center"><?php echo $i;?></td>
		            <td colspan="2"><?php echo $value->name; ?></td>
		            <td><?php echo $value->hsn_sac_code; ?></td>
		            <td align="center"><?php echo $value->quantity; ?></td>
		            <td><?php echo $value->unit; ?></td>
		            <td align="right"><?php echo $value->price; ?></td>
		            <td align="right"><?php echo $value->gross_total; ?></td>
		            <td align="right"><?php echo $value->discount; ?></td>
		            <td align="right"><?php echo $value->gross_total - $value->discount; ?></td>
		            <td align="right">
		            	<?php 
		            		if($data[0]->biller_state_id == $data[0]->shipping_state_id){
		            			echo $value->tax/2;
		            		} 
		            		else{
		            			echo "0";
		            		}
		            	?>
		            </td>
		            <td align="right">
		            	<?php 
		            		if($data[0]->biller_state_id == $data[0]->shipping_state_id){
		            			echo $value->tax/2;
		            		} 
		            		else{
		            			echo "0";
		            		}
		            	?>
		            </td>
		            <td align="right">
		            	<?php 
		            		if($data[0]->biller_state_id != $data[0]->shipping_state_id){
		            			echo $value->tax;
		            		}
		            		else{
		            			echo "0";
		            		}
		            	?>
		            </td>
		            <td align="right"><?php echo $value->gross_total-$value->discount+$value->tax; ?></td>
		          </tr>
	          <?php $i++;$tot += $value->gross_total; } ?>
	          <tr>
	            <td></td>
	            <td colspan="7"></td>
	            <td align="right"><?php echo $tot; ?></td>
	            <td align="right"><?php echo $data[0]->discount_value; ?></td>
	            <td align="right"><?php echo $tot - $data[0]->discount_value; ?></td>
	            <td align="right">
	            	<?php 
	            		if($data[0]->biller_state_id == $data[0]->shipping_state_id){
	            			echo $data[0]->tax_value/2;
	            		}
	            		else{
	            			echo "0";
	            		}
	            	?>
	            </td>
	            <td align="right">
	            	<?php 
	            		if($data[0]->biller_state_id == $data[0]->shipping_state_id){
	            			echo $data[0]->tax_value/2;
	            		}
	            		else{
	            			echo "0";
	            		}
	            	?>
	            </td>
	            <td align="right">
	            	<?php 
	            		if($data[0]->biller_state_id != $data[0]->shipping_state_id){
	            			echo $data[0]->tax_value;
	            		}
	            		else{
	            			echo "0";
	            		}
	            	?>
	            </td>
	            <td align="right"><?php echo $data[0]->total; ?></td>
	          </tr>
	          <tr>
	            <td></td>
	            <td colspan="8"><?php echo $this->lang->line('sales_remarks'); ?></td>
	            <td colspan="5"><?php echo $this->lang->line('sales_summary'); ?></td>
	            <td colspan="2"><?php echo $this->lang->line('sales_amount'); ?></td>
	            <td></td>
	          </tr>
	          <tr>
	            <td></td>
	            <td colspan="8"></td>
	            <td colspan="5"><?php echo $this->lang->line('sales_total_invoice_value'); ?></td>
	            <td colspan="2" align="right"><?php echo $this->session->userdata('symbol').$tot; ?></td>
	            <td></td>
	          </tr>
	          <tr>
	            <td></td>
	            <td colspan="8"></td>
	            <td colspan="5"><?php echo $this->lang->line('purchase_total_discount'); ?></td>
	            <td colspan="2" align="right"><?php echo $this->session->userdata('symbol').$data[0]->discount_value; ?></td>
	            <td></td>
	          </tr>
	          <tr>
	            <td></td>
	            <td colspan="2" rowspan="2"></td>
	            <td></td>
	            <td colspan="4" rowspan="2"></td>
	            <td></td>
	            <td colspan="5"><?php echo $this->lang->line('sales_total_taxable_value'); ?></td>
	            <td colspan="2" align="right"><?php echo $this->session->userdata('symbol').($tot - $data[0]->discount_value); ?></td>
	            <td></td>
	          </tr>
	          <tr>
	            <td></td>
	            <td></td>
	            <td></td>
	            <td colspan="5"><?php echo $this->lang->line('sales_total_cgst'); ?></td>
	            <td colspan="2" align="right">
            	<?php 
            		if($data[0]->biller_state_id == $data[0]->shipping_state_id){
            			echo $this->session->userdata('symbol').($data[0]->tax_value/2);
            		}
            		else{
            			echo "0";
            		}
            	?>
	            </td>
	            <td></td>
	          </tr>
	          <tr>
	            <td></td>
	            <td colspan="2"><?php echo $this->lang->line('sales_receivers_signature'); ?></td>
	            <td></td>
	            <td colspan="4"><?php echo $this->lang->line('sales_senior_accounts_manager'); ?></td>
	            <td></td>
	            <td colspan="5"><?php echo $this->lang->line('sales_total_sgst'); ?></td>
	            <td colspan="2" align="right">
            	<?php 
            		if($data[0]->biller_state_id == $data[0]->shipping_state_id){
            			echo $this->session->userdata('symbol').($data[0]->tax_value/2);
            		}
            		else{
            			echo "0";
            		}
            	?>
	            </td>
	            <td></td>
	          </tr>
	          <tr>
	            <td></td>
	            <td colspan="8"><?php echo $this->lang->line('slaes_invoice_note'); ?></td>
	            <td colspan="5"><?php echo $this->lang->line('sales_igst'); ?></td>
	            <td colspan="2" align="right">
            	<?php 
            		if($data[0]->biller_state_id != $data[0]->shipping_state_id){
            			echo $this->session->userdata('symbol').($data[0]->tax_value);
            		}
            		else{
            			echo "0";
            		}
            	?>
	            </td>
	            <td></td>
	          </tr>
	          <tr>
	          	<td></td>
	          	<td colspan="8" rowspan="2"><?php echo $this->lang->line('sales_thank_you'); ?></td>
	          	<td colspan="5">Shipping Charge</td>
	          	<td colspan="2" align="right"><?php echo $this->session->userdata('symbol').$data[0]->shipping_charge;?></td>
	          	<td></td>
	          </tr>
	          <tr>
	            <td></td>
	            <td colspan="5"><?php echo $this->lang->line('purchase_grand_total'); ?></td>
	            <td colspan="2" align="right"><?php echo $this->session->userdata('symbol').($data[0]->shipping_charge+$data[0]->total); ?></td>
	            <td></td>
	          </tr>
	        </tbody>
    	</table>
	</body>
</html>
<script>
	window.print();
</script>