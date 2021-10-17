<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','sales_person','manager');
if(!(in_array($this->session->userdata('type'),$p))){
  redirect('auth');
}
  $this->load->view('layout/header');
?>
<script type="text/javascript">
  function delete_id(id)
  {
     if(confirm('<?php echo $this->lang->line('product_delete_conform'); ?>'))
     {
        window.location.href='<?php  echo base_url('sales/delete/'); ?>'+id;
     }
  }
</script>
<div class="content-wrapper">
	<?php 
	    // $this->load->view('layout/sticky_note');
	?>
  
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('auth/dashboard'); ?>" class="text-black"><i class="fa fa-dashboard">&nbsp;</i><strong><?php echo $this->lang->line('header_dashboard'); ?></strong></a></li>
          <li><a href="<?php echo base_url('sales'); ?>" class="text-black"><strong><?php echo $this->lang->line('header_sales'); ?></strong></a></li>
          <li class="active"><?php echo $this->lang->line('sales_sales_details'); ?></li>
        </ol>
      </h5>    
    </section>
    <!-- Main content -->
    <section class="content">
      	<div class="row">
	      	<!-- right column -->
	      	<div class="col-md-12">
		        <div class="box">
		            <div class="box-header with-border">
		              <h3 class="box-title"><?php echo $this->lang->line('sales_sales_details'); ?></h3>
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">
		            	<div class="col-sm-12 well well-sm">
			            	<div class="col-sm-12">
			            		<div class="col-sm-1">
			            			<i class="fa fa-3x fa-user padding010 text-muted"></i>
			            		</div>
			            		<div class="col-sm-3">
			            			<b><h4><?php echo $data[0]->company_name; ?></h4></b>
			            		</div>
			            		<div class="col-sm-1">
			            			<i class="fa fa-3x fa-map-marker padding010 text-muted"></i>
			            		</div>
			            		<div class="col-sm-3">
				            		<?php if(!empty($data[0]->house_no)){ echo 'House: ' . $data[0]->house_no . ', ';} else{ echo 'House: -'; } ?>
				            		<?php if(!empty($data[0]->road_no)){ echo 'Road: ' . $data[0]->road_no;} else{ echo 'Road: -'; } ?>
				            		<br>
				            		<?php
				            		$city_id = $data[0]->city_id;
				            		$this->db->where('id', $city_id);
									$city = $this->db->get('cities')->result_array();

									if($city){
										echo $city[0]['name'] . ', ';
				            		}
									else{
										$city = '';
									}
				            		
				            		$state_id = $data[0]->state_id;
				            		$this->db->where('id', $state_id);
									$state = $this->db->get('states')->result_array();

									if($state){
										echo $state[0]['name'] . ', ';
				            		}
									else{
										$state = '';
									}

				            		if(isset($data[0]->zip_code)){ 
				            			echo $data[0]->zip_code . '<br>';
				            		}
				            		else echo '';
				            		
				            		$country_id = $data[0]->country_id;
				            		$this->db->where('id', $country_id);
									$country = $this->db->get('countries')->result_array();

									if($country){
										echo $country[0]['name'];
				            		}
									else{
										$country = '';
									} 
									?>
				            	</div>
				            	<div class="col-sm-1">
			            			<i class="fa fa-3x fa-list-alt padding010 text-muted"></i>
			            		</div>
				            	<div class="col-sm-3">
				            		<?php echo $this->lang->line('purchase_mobile')." : ".$data[0]->company_phone; ?>
				            		<br>
				            		<?php echo $this->lang->line('company_setting_email')." : ".$data[0]->email; ?>
			            		</div>
			            	</div>
			            	<!-- <div class="col-sm-4">
			            		<div class="col-sm-2">
			            			<i class="fa fa-3x fa-building padding010 text-muted"></i>
			            		</div>
			            		<div class="col-sm-10">
			            			<b><h4><?php echo $data[0]->biller_name ?></h4></b>
			            					            		<?php echo $data[0]->biller_address; ?>
			            					            		<br>
			            					            		<?php echo $data[0]->biller_city; ?>
			            					            		<br>
			            					            		<?php echo $data[0]->biller_country; ?>
			            					            		<br><br>
			            					            		<?php echo $this->lang->line('purchase_mobile')." : ".$data[0]->biller_mobile; ?>
			            					            		<br>
			            					            		<?php echo $this->lang->line('company_setting_email')." : ".$data[0]->biller_email; ?>
			            		</div>
			            	</div>
			            	<div class="col-sm-4">
			            		<div class="col-sm-2">
			            										<i class="fa fa-3x fa-building-o padding010 text-muted"></i>
			            									</div>
			            									<div class="col-sm-10">
			            										<b><h4><?php echo $company[0]->name; ?></h4></b>
			            					            		<?php echo $data[0]->warehouse_name; ?>
			            					            		<br>
			            					            		<?php echo $data[0]->branch_address; ?>
			            					            		<br>
			            					            		<?php echo $data[0]->branch_city; ?>
			            					            		<br><br>
			            					            		<?php echo $this->lang->line('purchase_mobile')." : ".$company[0]->phone; ?>
			            					            		<br>
			            					            		<?php echo $this->lang->line('company_setting_email')." : ".$company[0]->email; ?>
			            		</div>
			            	</div> -->
			            </div>
			            <div class="col-sd-12">
			            	<div class="col-sm-3"></div>
			            	<div class="col-sm-4">
			            		<div class="col-sm-2">
			            			<i class="fa fa-3x fa-file-text-o padding010 text-muted"></i>
			            		</div>
			            		<div class="col-sm-10">
			            			<b><h4><?php echo $data[0]->reference_no; ?></h4></b>
				            		
				            		<b><?php echo $this->lang->line('purchase_date')." : ".$data[0]->date; ?></b>
				            		<br>
				            		<b><?php echo $this->lang->line('sales_status')." : "; ?></b>
				            		<span class="label bg-gray">Complited</span>
				            		<br>
				            		<b><?php echo $this->lang->line('sales_payment_status')." : "; ?></b>
				            		<?php if($data[0]->paid_amount == 0.00  || $data[0]->paid_amount == 0){ ?>
			                          <span class="label bg-gray"><?php echo $this->lang->line('sales_pending'); ?></span>
			                        <?php }else{ ?>
			                          <span class="label bg-gray"><?php echo $this->lang->line('sales_complited'); ?></span>
			                        <?php } ?>
			                        <br>
			                        <b>&nbsp;
			            		</div>
			            	</div>
			            	<div class="col-sm-4">
			            		<div class="col-sm-2">
			            			<i class="fa fa-3x fa-file-text-o padding010 text-muted"></i>
			            		</div>
			            		<div class="col-sm-10">
			            			<b><h4><?php echo $data[0]->invoice_no; ?></h4></b>
				            		
				            		<b><?php echo $this->lang->line('purchase_date')." : ".$data[0]->invoice_date; ?></b>
				            		<br>
			                        <b>&nbsp;
			            		</div>
			            	</div>
			            </div>
			            <div class="col-sm-12" style="overflow-y: auto;">
			            	<table class="table table-hover table-bordered">
			            		<thead>
			            			<th style="text-align: center;"><?php echo $this->lang->line('product_no'); ?></th>
			            			<th width="20%"><?php echo $this->lang->line('product_description'); ?></th>
			            			<th style="text-align: center;"><?php echo $this->lang->line('product_quantity'); ?></th>
			            			<th style="text-align: center;"><?php echo $this->lang->line('product_cost'); ?></th>
			            			<th colspan="2" style="text-align: center;">Total</th>
			            		</thead>
			            		<tbody>
			            			<?php 
			            			$i = 1; $tot = 0.00;
			            			foreach ($items as $value) { 
			            			?>
				            			<tr>
				            				<td align="center"><?php echo $i;?></td>
				            				<td><?php echo $value->name.' ('.$value->code.')'; ?></td>
				            				<td align="center"><?php echo $value->quantity; ?></td>
				            				<td align="right"><?php if($data[0]->currency_id == 1){ echo '$' . $value->cost; } else{ echo '৳' . $value->cost; } ?></td>
				            				<td colspan="2" align="right"><?php if($data[0]->currency_id == 1){ echo '$' . $value->gross_total; } else{ echo '৳' . $value->gross_total; } ?></td>
				            			</tr>
			            			<?php 
			            			$i++; 
			            			$tot += $value->gross_total; 
			            			} 
			            			?>
			            			<tr>
			            				<td colspan="4"></td>
			            				<td colspan="1" align="right"><b>Grand Total</b></td>
			            				<td colspan="1" align="right"><?php if($data[0]->currency_id == 1){ echo '$' . number_format($tot, 2, '.', ''); } else{ echo '৳' . number_format($tot, 2, '.', ''); } ?></td>
			            			</tr>
			            		</tbody>
			            	</table>
			            </div>
			            <!-- <div class="col-sm-6" style="padding-bottom:10px;">
			            	<button class="btn btn-primary btn-lg btn-block" type="submit" name="submit">
								<i class="fa fa-money"></i>
								Pay by Paypal
							</button>
			            </div> -->
			            <div class="col-sm-12">
			            	<div class="buttons">
								<div class="btn-group btn-group-justified">
									<?php if($data[0]->paid_amount == 0.00){ ?>
									<div class="btn-group" style="border: 2px solid black;">
										<a class="tip btn bg-gray tip" href="<?php echo base_url('sales/payment/'); ?><?php echo $data[0]->sales_id; ?>" title="Add Payment">
											<i class="fa fa-money"></i>
											<span class="hidden-sm hidden-xs"><?php echo $this->lang->line('sales_add_payment'); ?></span>
										</a>
									</div>
									<?php } ?>
									<!-- <div class="btn-group">
										<a class="tip btn btn-info tip" href="<?php echo base_url('sales/email/'); ?><?php echo $data[0]->sales_id; ?>" title="Email">
											<i class="fa fa-envelope-o"></i>
											<span class="hidden-sm hidden-xs"><?php echo $this->lang->line('company_setting_email'); ?></span>
										</a>
									</div>
									<div class="btn-group">
										<a class="tip btn btn-success" href="<?php echo base_url('sales/pdf/');?><?php echo $data[0]->sales_id; ?>" title="Download as PDF" target="_blank">
											<i class="fa fa-download"></i>
											<span class="hidden-sm hidden-xs"><?php echo $this->lang->line('product_alert_pdf'); ?></span>
										</a>
									</div>
									<div class="btn-group">
										<a class="tip btn btn-success" href="<?php echo base_url('sales/print1/');?><?php echo $data[0]->sales_id; ?>" title="Download as PDF" target="_blank">
											<i class="fa fa-download"></i>
											<span class="hidden-sm hidden-xs">Print<?php echo $this->lang->line('product_alert_pdf'); ?></span>
										</a>
									</div> -->
									<?php if($data[0]->paid_amount == 0.00){ ?>
										<?php if($this->session->userdata('type') == 'admin'){ ?>
											<div class="btn-group" style="border: 2px solid black;">
												<a class="tip btn bg-gray" href="<?php echo base_url('sales/edit/'); ?><?php echo $data[0]->sales_id; ?>" title="Edit">
													<i class="fa fa-edit"></i>
													<span class="hidden-sm hidden-xs"><?php echo $this->lang->line('purchase_edit'); ?></span>
												</a>
											</div>
										<?php }?>
									<?php } ?>
									<?php if($this->session->userdata('type') == 'admin'){ ?>
										<div class="btn-group" style="border: 2px solid black;">
											<a class="tip btn bg-gray bpo" href="javascript:delete_id(<?php echo $data[0]->sales_id;?>)" title="Delete Sale">
												<i class="fa fa-trash-o"></i>
												<span class="hidden-sm hidden-xs"><?php echo $this->lang->line('purchase_delete'); ?></span>
											</a>
										</div>
									<?php }?>									
									<div class="btn-group" style="border: 2px solid black;">
										<a class="tip btn bg-gray" href="<?php echo base_url('sales');?>" title="Sales List">
											<i class="fa fa-arrow-right"></i>
											<span class="hidden-sm hidden-xs">Proceed to List</span>
										</a>
									</div>
								</div>
							</div>
			            </div>
		            </div>
		            <!-- /.box-body -->
		        </div>
	            <!-- /.box -->
	        </div>
	        <!--/.col (right) -->
      	</div>
      	<!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
	$this->load->view('layout/footer');
?>