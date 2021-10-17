<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','manager');
if(!(in_array($this->session->userdata('type'),$p))){
  redirect('auth');
}
$this->load->view('layout/header');
?>
<script type="text/javascript">
  function delete_id(id)
  {
     if(confirm('Sure To Remove This Record ?'))
     {
        window.location.href='<?php  echo base_url('tax/delete/'); ?>'+id;
     }
  }
</script>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
         <ol class="breadcrumb">
          <li><a href="<?php echo base_url('auth/dashboard'); ?>" class="text-black"><i class="fa fa-dashboard">&nbsp;</i><strong><?php echo $this->lang->line('header_dashboard'); ?></strong></a></li>
          <li class="active"><!-- Tax --> <?php echo $this->lang->line('tax_label'); ?></li>
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
              <h3 class="box-title"><!-- List Tax --> <?php echo $this->lang->line('tax_label_list'); ?></h3>
              <a class="btn btn-sm btn-info pull-right" style="margin: 10px" href="<?php echo base_url('tax/add');?>" title="Add New Category" onclick="">Add New Tax</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="index" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><!-- No --> <?php echo $this->lang->line('category_lable_no'); ?></th>
                  <th><!-- Tax Name --> <?php echo $this->lang->line('tax_label_name'); ?></th>
                  <th><!-- Registration Number --> <?php echo $this->lang->line('tax_label_rnumber'); ?></th>
                  <th><!-- Filling Frequency --> <?php echo $this->lang->line('tax_label_frequency'); ?></th>
                  <th><!-- Sales Tax Rate --> <?php echo $this->lang->line('tax_label_salesrate'); ?></th>
                  <th><!-- Purchase Tax Rate --> <?php echo $this->lang->line('tax_label_purchaserate'); ?></th>
                  <th><!-- Actions --> <?php echo $this->lang->line('category_lable_actions'); ?></th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                      foreach ($data as $row) {
                         $id= $row->tax_id;
                    ?>
                    <tr>
                      <td></td>
                      <td><?php echo $row->tax_name; ?></td>
                      <td><?php echo $row->registration_number; ?></td>
                      <td><?php echo $row->filling_frequency; ?></td>
                      <td align="right"><?php echo $row->tax_value; ?>%</td>
                      <td align="right"><?php echo $row->purchase_tax_value; ?>%</td>
                      <td>
                          <?php
                            if($row->active==1){
                          ?>
                              <a href="#" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#<?php echo $row->tax_id;?>">Inactive</a>&nbsp;&nbsp;
                          <?php
                            }
                            else{
                          ?>
                              <a href="<?php echo base_url('tax/active/'); echo $row->tax_id;?>" class="btn btn-xs btn-success">Active</span></a>&nbsp;&nbsp;
                          <?php
                            }
                          ?>
                          <!-- Modal -->
                            <div id="<?php echo $row->tax_id;?>" class="modal fade" role="dialog">
                              <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Mark Inactive</h4>
                                  </div>
                                  <form action="<?php echo base_url('tax/in_active/'); ?><?php echo $row->tax_id;?>" method="post">
                                    <div class="modal-body">
                                     Inactive Date
                                        <input type="text" class="form-control datepicker" id="date" name="date" value="<?php echo date('Y-m-d');?>">
                                    </div>
                                    <div class="modal-footer">
                                      <button type="submit" class="btn btn-info btn-flat">Save</button>
                                      <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Close</button>
                                    </div>
                                  </form>
                                </div>

                              </div>
                            </div>

                          <a href="<?php echo base_url('tax/edit/'); ?><?php echo $id; ?>" title="Edit" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;
                          <a href="javascript:delete_id(<?php echo $id;?>)" title="Delete" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                      </td>
                    <?php
                      }
                    ?>
                <tfoot>
                 <tr>
                  <th><!-- No --> <?php echo $this->lang->line('category_lable_no'); ?></th>
                  <th><!-- Tax Name --> <?php echo $this->lang->line('tax_label_name'); ?></th>
                  <th><!-- Registration Number --> <?php echo $this->lang->line('tax_label_rnumber'); ?></th>
                  <th><!-- Filling Frequency --> <?php echo $this->lang->line('tax_label_frequency'); ?></th>
                  <th><!-- Sales Tax Rate --> <?php echo $this->lang->line('tax_label_salesrate'); ?></th>
                  <th><!-- Purchase Tax Rate --> <?php echo $this->lang->line('tax_label_purchaserate'); ?></th>
                  <th><!-- Actions --> <?php echo $this->lang->line('category_lable_actions'); ?></th>
                </tr> 
                </tfoot>
              </table>
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
  $this->load->view('layout/product_footer');
?>
