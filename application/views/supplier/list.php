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
        window.location.href='<?php  echo base_url('supplier/delete/'); ?>'+id;
     }
  }
</script>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
         <ol class="breadcrumb">
          <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-dashboard"></i> 
                <!-- Dashboard -->
                <?php echo $this->lang->line('header_dashboard'); ?></a></li>
          <li class="active"><!-- Suppliers -->
              <?php echo $this->lang->line('supplier_header'); ?>
          </li>
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
              <h3 class="box-title"><!-- List Suppliers -->
                  <?php echo $this->lang->line('supplier_label'); ?>
              </h3>
              <a class="btn btn-sm btn-info pull-right" style="margin: 10px" href="<?php echo base_url('supplier/add');?>" title="PDF"> <!-- Add New Suppliers --> 
                  <?php echo $this->lang->line('supplier_btn_add'); ?>
              </a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="index" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><!-- No -->
                      <?php echo $this->lang->line('biller_lable_no'); ?>
                  </th>
                  <th><!-- Name -->
                      <?php echo $this->lang->line('biller_lable_name'); ?>
                  </th>
                  <th><!-- Company -->
                      <?php echo $this->lang->line('biller_lable_company'); ?>                    
                  </th>
                  <th><!-- Phone -->
                      <?php echo $this->lang->line('biller_lable_phone'); ?>
                  </th>
                  <th><!-- Email Address -->
                      <?php echo $this->lang->line('biller_lable_email'); ?>
                  </th>
                  <th><!-- city -->
                      <?php echo $this->lang->line('biller_lable_city'); ?>
                  </th>
                  <th><!-- Country -->
                      <?php echo $this->lang->line('biller_lable_country'); ?>
                  </th>
                  <th><!-- Actions -->
                      <?php echo $this->lang->line('biller_lable_action'); ?>
                  </th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                      foreach ($data as $row) {
                         $id= $row->supplier_id;
                    ?>
                    <tr>
                      <td></td>
                      <td><?php echo $row->supplier_name; ?></td>
                      <td><?php echo $row->company_name; ?></td>
                      <td><?php echo $row->mobile ?></td>
                      <td><?php echo $row->email ?></td>
                      <td><?php echo $row->ctname ?></td>
                      <td><?php echo $row->cname ?></td>
                      <td>
                          <!-- <a href="" title="View Details" class="btn btn-xs btn-warning"><span class="fa fa-eye"></span></a>&nbsp;&nbsp; -->
                          <a href="<?php echo base_url('supplier/edit/'); ?><?php echo $id; ?>" title="Edit" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;
                          <a href="javascript:delete_id(<?php echo $id;?>)" title="Delete" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                      </td>
                    <?php
                      }
                    ?>
                <tfoot>
                <tr>
                  <th><!-- No -->
                      <?php echo $this->lang->line('biller_lable_no'); ?>
                  </th>
                  <th><!-- Name -->
                      <?php echo $this->lang->line('biller_lable_name'); ?>
                  </th>
                  <th><!-- Company -->
                      <?php echo $this->lang->line('biller_lable_company'); ?>                    
                  </th>
                  <th><!-- Phone -->
                      <?php echo $this->lang->line('biller_lable_phone'); ?>
                  </th>
                  <th><!-- Email Address -->
                      <?php echo $this->lang->line('biller_lable_email'); ?>
                  </th>
                  <th><!-- city -->
                      <?php echo $this->lang->line('biller_lable_city'); ?>
                  </th>
                  <th><!-- Country -->
                      <?php echo $this->lang->line('biller_lable_country'); ?>
                  </th>
                  <th><!-- Actions -->
                      <?php echo $this->lang->line('biller_lable_action'); ?>
                  </th>
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
  $this->load->view('layout/footer');
?>
