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
        window.location.href='<?php  echo base_url('discount/delete/'); ?>'+id;
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
          <li class="active"><!-- Discount --> <?php echo $this->lang->line('discount_label'); ?></li>
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
              <h3 class="box-title"><!-- List Discount --> <?php echo $this->lang->line('discount_label_list'); ?></h3>
              <a class="btn btn-sm btn-info pull-right" style="margin: 10px" href="<?php echo base_url('discount/add');?>" title="Add New Category" onclick="">Add New Discount</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="index" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th><!-- No --> <?php echo $this->lang->line('category_lable_no'); ?></th>
                 <!--  <th>Discount Type</th> -->
                  <th><!-- Discount Name --> <?php echo $this->lang->line('discount_label_name'); ?></th>
                  <th><!-- Discount Value --> <?php echo $this->lang->line('discount_label_value'); ?></th>
                  <th><!-- User Name --> <?php echo $this->lang->line('discount_label_username'); ?></th>
                  <th><!-- Actions --> <?php echo $this->lang->line('category_lable_actions'); ?></th>
                </tr>
                </thead>
                <tbody>
                  <?php 
                      foreach ($data as $row) {
                         $id= $row->discount_id;
                    ?>
                    <tr>
                      <td></td>
                     <!--  <td><?php echo $row->discount_type; ?></td> -->
                      <td><?php echo $row->discount_name; ?></td>
                      <td align="right"><?php echo $row->discount_value;?></td>

                      <td><?php echo $row->first_name." ".$row->last_name; ?></td>
                      <td>
                        <!-- <a href="" title="View Details" class="btn btn-xs btn-warning"><span class="fa fa-eye"></span></a>&nbsp;&nbsp; -->
                        <a href="<?php echo base_url('discount/edit/'); ?><?php echo $id; ?>" title="Edit" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;
                        <a href="javascript:delete_id(<?php echo $id;?>)" title="Delete" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>
                      </td>
                    <?php
                      }
                    ?>
                <tfoot>
                <tr>
                 <tr>
                  <th><!-- No --> <?php echo $this->lang->line('category_lable_no'); ?></th>
                 <!--  <th>Discount Type</th> -->
                  <th><!-- Discount Name --> <?php echo $this->lang->line('discount_label_name'); ?></th>
                  <th><!-- Discount Value --> <?php echo $this->lang->line('discount_label_value'); ?></th>
                  <th><!-- User Name --> <?php echo $this->lang->line('discount_label_username'); ?></th>
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
  $this->load->view('layout/footer');
?>
