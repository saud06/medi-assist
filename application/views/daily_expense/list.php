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
    window.location.href='<?php  echo base_url('daily_expense/delete/'); ?>'+id;
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
      <li class="active"><!-- Category --> 
        <!-- <?php echo $this->lang->line('header_category'); ?> -->Daily Expense
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
          <h3 class="box-title"><!-- List Category -->
            <!-- <?php echo $this->lang->line('category_lable_lcategory'); ?> -->List Daily Expense
          </h3>
          <a class="btn btn-sm btn-info pull-right" style="margin: 10px" href="<?php echo base_url('daily_expense/add');?>">Add New Expense</a>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="row">
            <div class="col-sm-1">
              <p><strong>Daily Expense List Filter:</strong></p>
            </div>
            <div class="col-sm-2">
              <select class="form-control select2" name="status" id="status" style="width: 100%;">
                <option value="">All Status</option>
                <option value="active" selected>Active</option>
                <option value="inactive">Inactive</option>
              </select>
            </div>
            <div class="col-sm-1">
              <button type="button" id="btn_ajax" class="btn btn-info">&nbsp;Filter&nbsp;</button>
            </div>
          </div>
          <br>

          <table id="index" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>No.</th>                  
                <th>Expense Title</th>
                <th>Expense Date</th> 
                <th>Expense Amount</th>
                <th>Expensed By</th>
                <th><?php echo $this->lang->line('category_lable_actions'); ?></th>
              </tr>
            </thead>
            <tbody id="records">
              <?php 
              $i = 1;
              foreach ($data as $row) {
                $id= $row->daily_expense_id;
                ?>
                <tr>
                  <td><?php echo $i; ?></td>
                  <td><?php echo $row->expense_title ?></td>
                  <td><?php echo $row->expense_date ?></td>
                  <td><?php echo $row->expense_amount ?></td>
                  <td><?php echo $row->expensed_by ?></td>
                  <td>
                    <div class="dropdown">
                      <button type="button" class="btn btn-default gropdown-toggle" data-toggle="dropdown">
                        <?php echo $this->lang->line('product_action'); ?>
                        <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu">
                        <li>
                          <a href="<?php echo base_url('daily_expense/edit/'); ?><?php echo $id; ?>"><i class="fa fa-edit"></i>Edit</a>
                        </li>
                        <li>
                          <a href="javascript:delete_id(<?php echo $id;?>)"><i class="fa fa-trash-o"></i>Delete</a>
                        </li>
                      </ul>
                    </div>
                  </td>
                </tr>
            <?php
            $i++;
          }
          ?>
          <tfoot>
            <tr>
             <th>No.</th>                  
             <th>Expense Title</th>
             <th>Expense Date</th> 
             <th>Expense Amount</th>
             <th>Expensed By</th>
             <th><?php echo $this->lang->line('category_lable_actions'); ?></th>
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

<script>
  $('#btn_ajax').click(function(){
    var status = $('#status').val();
    if(!status) status = 0;

    $.ajax({
      url: "<?php echo base_url('daily_expense/filter_daily_expense') ?>/",
      type: "POST",
      dataType: "JSON",
      data : {
        status: status
      },
      success: function (response) {
        //console.log(response.data)
        var table = $('#index').DataTable();
        table.destroy();
        $('#records').empty();

        var trHTML = '';
        $.each(response.data, function (i, item) {
          trHTML += '<tr>';
          trHTML += '<td>'+(i+1)+'</td>';
          trHTML += '<td>' + item.expense_title + '</td>';
          trHTML += '<td>' + item.expense_date + '</td>';
          trHTML += '<td>' + item.expense_amount + '</td>';
          trHTML += '<td>' + item.expensed_by + '</td>';
          trHTML += '<td>';
            trHTML += '<div class="dropdown"><button type="button" class="btn btn-default gropdown-toggle" data-toggle="dropdown"><?php echo $this->lang->line('product_action'); ?> <span class="caret"></span></button><ul class="dropdown-menu"><li><a href="<?php echo base_url('daily_expense/edit/'); ?>' + item.daily_expense_id + '<i class="fa fa-edit"></i>Edit</a></li><li><a href="javascript:delete_id(' + item.daily_expense_id + ')"><i class="fa fa-trash-o"></i>Delete</a></li></ul></div>';
          trHTML += '</td>';
          trHTML += '</tr>';
        });
        
        $('#records').append(trHTML);
        $('#index').DataTable({
          "columnDefs": [ {
              "searchable": false,
              "orderable": false,
              "targets": 0
          } ],
          "order": [[ 1, 'asc' ]],
          "pageLength": 100
        });
      }
    });
  });
</script>