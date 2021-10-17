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
   if(confirm('<?php echo $this->lang->line('inventory_delete_conform'); ?>'))
   {
    window.location.href='<?php  echo base_url('inventory/delete/'); ?>'+id;
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
      <li class="active">Check-In History</li>
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
          <h3 class="box-title">Check-In History</h3>
        </div>
        <!-- /.box-header -->

        <div class="box-body outer-scroll"> 
          <div class="inner-scroll">
            <div class="row">
              <div class="col-sm-12">
                <strong>Check-In History Filter:</strong> &emsp;

                <select class="form-control select2" name="category_id" id="category_id" style="width: 20%;">
                  <option value="" selected>All Categories</option>

                  <?php 
                    foreach ($categories as $category) {
                  ?>
                      <option value="<?php echo $category->category_id ?>"><?php echo $category->category_name ?></option>
                  <?php
                    }
                  ?>
                </select> &emsp;

                <select class="form-control select2" name="sub_category_id" id="sub_category_id" style="width: 20%;">
                  <option value="" selected>All Subcategories</option>
                  
                  <?php 
                    foreach ($subcategories as $subcategory) {
                  ?>
                      <option value="<?php echo $subcategory->sub_category_id ?>"><?php if($subcategory->category_id == 0){ echo 'N/A'; } else{ echo $subcategory->sub_category_name; } ?></option>
                  <?php
                    }
                  ?>
                </select> &emsp;

                <button title="Filter Inventory Item List" type="button" id="btn_ajax" class="btn bg-gray"><i class="fa fa-search" aria-hidden="true"></i></button>&emsp;

                <div class="btn-group">
                  <button title="Print Check-In History" type="button" class="btn bg-gray gropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-print" aria-hidden="true"></i>&nbsp;
                    <span class="fa fa-angle-double-down"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li>
                      <a href="#" target="_blank" onclick="printContent('print')">Print (Default)</a>
                    </li>
                    <li id="pdf">
                      <a href="<?php echo base_url('inventory/check_in_history_pdf');?>" target="_blank">PDF (On Letter Head)</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <br>

            <table id="index" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Product Name</th>
                  <!-- <th>Category</th>
                  <th>Sub Category</th> -->
                  <th>Customer</th>                
                  <th>Returned Datetime</th>
                  <th>Return Quantity</th> 
                  <th>Status</th> 
                  <th>Remarks</th> 
                  <th>Checked By</th> 
                </tr>
              </thead>
              <tbody id="records">
                <?php
                foreach ($data as $i => $row) {
                 $id= $row->check_in_history_id;
                 ?>
                 <tr>
                  <td><?php echo $i++; ?> </td>
                  <!-- <td><?php echo $row->name; ?></td> -->
                  <td><?php 
                  $product_id= $row->product_id;
                  $this->db->where('product_id', $product_id);
                  $cat_id = $this->db->get('check_in_history')->result_array();
                  $var = $cat_id[0]['product_id'];
                  $cat_idd = explode(",", $var);
                  foreach ($cat_idd as $key => $value) {
                    $this->db->where('product_id', $value);
                    $cat_name = $this->db->get('products')->result_array();
                    echo $cat_name[0]['name'] . '<br>';
                  }
                  
                  ?>
                  </td>
                  <!-- <td><?php 
                  $product_id= $row->product_id;
                  $this->db->where('product_id', $product_id);
                  $cat_id = $this->db->get('products')->result_array();
                  $var = $cat_id[0]['category_id'];
                  $cat_idd = explode(",", $var);
                  foreach ($cat_idd as $key => $value) {
                    $this->db->where('category_id', $value);
                    $cat_name = $this->db->get('category')->result_array();
                    echo $cat_name[0]['category_name'] . '<br>';
                  }
                  ?>
                  </td> -->
                  <!-- <td><?php 
                  $product_id= $row->product_id;
                  $this->db->where('product_id', $product_id);
                  $cat_id = $this->db->get('products')->result_array();
                  $var = $cat_id[0]['subcategory_id'];
                  $cat_idd = explode(",", $var);
                  foreach ($cat_idd as $key => $value) {
                    $this->db->where('sub_category_id', $value);
                    $cat_name = $this->db->get('sub_category')->result_array();
                    echo $cat_name[0]['sub_category_name'] . '<br>';
                  }
                  ?>
                  </td> -->
                  <td><?php echo $row->company_name; ?></td> 
                  <td><?php echo $row->in_date; ?></td>         
                  <td><?php echo $row->in_quantity; ?></td> 
                  <td><?php echo $row->status; ?></td> 
                  <td><?php echo $row->remarks; ?></td> 
                  <td><?php echo $row->user_name; ?></td> 
                 </tr>
                <?php
                }
                ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>No.</th>
                  <th>Product Name</th>
                  <!-- <th>Category</th>
                  <th>Sub Category</th> -->
                  <th>Customer</th>                
                  <th>Returned Datetime</th>
                  <th>Return Quantity</th> 
                  <th>Status</th> 
                  <th>Remarks</th>   
                  <th>Checked By</th>   
                </tr>
              </tfoot>
            </table>

            <div style="display: none;" id="print">
              <div id="header" class="box-header with-border" style="text-align: center; display: none">
                <!-- <img width="300" height="100" src="<?php echo base_url().'assets/images/winmarkFinal.png'; ?>"><br>
                <hr> -->

                <h3 class="box-title">
                  Check-Out History
                </h3>
                <br><br>

                <table id="pindex" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Product Name</th>
                      <!-- <th>Category</th>
                      <th>Sub Category</th> -->
                      <th>Customer</th>
                      <th>Returned Datetime</th>
                      <th>Return Quantity</th>
                      <th>Status</th>
                      <th>Remarks</th>
                      <th>Checked By</th>
                    </tr>
                  </thead>
                  <tbody id="precords">
                    <?php
                    foreach ($data as $i => $row) {
                     $id= $row->check_in_history_id;
                     ?>
                     <tr>
                      <td><?php echo ++$i; ?> </td>
                      <!-- <td><?php echo $row->name; ?></td> -->
                      <td><?php 
                      $product_id= $row->product_id;
                      $this->db->where('product_id', $product_id);
                      $cat_id = $this->db->get('check_in_history')->result_array();
                      $var = $cat_id[0]['product_id'];
                      $cat_idd = explode(",", $var);
                      foreach ($cat_idd as $key => $value) {
                        $this->db->where('product_id', $value);
                        $cat_name = $this->db->get('products')->result_array();
                        echo $cat_name[0]['name'] . '<br>';
                      }
                      
                      ?>
                      </td>
                      <!-- <td><?php 
                      $product_id= $row->product_id;
                      $this->db->where('product_id', $product_id);
                      $cat_id = $this->db->get('products')->result_array();
                      $var = $cat_id[0]['category_id'];
                      $cat_idd = explode(",", $var);
                      foreach ($cat_idd as $key => $value) {
                        $this->db->where('category_id', $value);
                        $cat_name = $this->db->get('category')->result_array();
                        echo $cat_name[0]['category_name'] . '<br>';
                      }
                      ?>
                      </td> -->
                      <!-- <td><?php 
                      $product_id= $row->product_id;
                      $this->db->where('product_id', $product_id);
                      $cat_id = $this->db->get('products')->result_array();
                      $var = $cat_id[0]['subcategory_id'];
                      $cat_idd = explode(",", $var);
                      foreach ($cat_idd as $key => $value) {
                        $this->db->where('sub_category_id', $value);
                        $cat_name = $this->db->get('sub_category')->result_array();
                        echo $cat_name[0]['sub_category_name'] . '<br>';
                      }
                      ?>
                      </td> -->
                      <td><?php echo $row->company_name; ?></td> 
                      <td><?php echo $row->in_date; ?></td>         
                      <td><?php echo $row->in_quantity; ?></td> 
                      <td><?php echo $row->status; ?></td> 
                      <td><?php echo $row->remarks; ?></td> 
                      <td><?php echo $row->user_name; ?></td> 
                     </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>No.</th>
                      <th>Product Name</th>
                      <!-- <th>Category</th>
                      <th>Sub Category</th> -->
                      <th>Customer</th>
                      <th>Returned Datetime</th>
                      <th>Return Quantity</th>
                      <th>Status</th>
                      <th>Remarks</th>
                      <th>Checked By</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>  
    </div>
  <!-- /.box-body -->
  </div>
  <!-- /.box -->
<!-- /.row -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
$this->load->view('layout/footer');
?>

<script type="text/javascript">
  $('#btn_ajax').click(function(){
    var category_id = $('#category_id').val();
    if(!category_id) category_id = 0;
    var sub_category_id = $('#sub_category_id').val();
    if(!sub_category_id) sub_category_id = 0;

    $.ajax({
      url: "<?php echo base_url('inventory/filter_check_in_history') ?>/",
      type: "POST",
      dataType: "JSON",
      data : {
        category_id: category_id,
        sub_category_id: sub_category_id
      },
      success: function (response){
        var table = $('#index').DataTable();
        table.destroy();
        $('#records').empty();

        var trHTML = '';
        $.each(response.data, function (i, item) {
          trHTML += '<tr>';
          trHTML += '<td>'+(i+1)+'</td>';
          trHTML += '<td>' + item.name + '</td>';
          /*trHTML += '<td>' + item.category_name + '</td>';

          var sub_category_name = item.sub_category_name;
          if(sub_category_name == null){
            sub_category_name = '';
          }
          trHTML += '<td>' + sub_category_name + '</td>';*/
          
          trHTML += '<td>' + item.company_name + '</td>';
          trHTML += '<td>' + item.in_date + '</td>';
          trHTML += '<td>' + item.in_quantity + '</td>';
          trHTML += '<td>' + item.status + '</td>';
          trHTML += '<td>' + item.remarks + '</td>';
          trHTML += '<td>' + item.user_name + '</td>';
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

        $('#precords').empty();

        var trHTML = '';
        $.each(response.data, function (i, item) {
          trHTML += '<tr>';
          trHTML += '<td>'+(i+1)+'</td>';
          trHTML += '<td>' + item.name + '</td>';
          /*trHTML += '<td>' + item.category_name + '</td>';

          var sub_category_name = item.sub_category_name;
          if(sub_category_name == null){
            sub_category_name = '';
          }
          trHTML += '<td>' + sub_category_name + '</td>';*/
          
          trHTML += '<td>' + item.company_name + '</td>';
          trHTML += '<td>' + item.in_date + '</td>';
          trHTML += '<td>' + item.in_quantity + '</td>';
          trHTML += '<td>' + item.status + '</td>';
          trHTML += '<td>' + item.remarks + '</td>';
          trHTML += '<td>' + item.user_name + '</td>';
          trHTML += '</tr>';
        });
        
        $('#precords').append(trHTML);
      }
    });

    $("#pdf").html('<a href="<?php echo base_url('inventory/filterCheckInHistoryPDF/');?>' + category_id + '/' + sub_category_id + '" target="_blank">PDF (On Letter Heads)</a>');
  });

  function printContent(el){
    $('#header').show();
    // $('.table-bordered th').eq(0).css("min-width", "");
    $('.table-bordered').css("font-size", "12px");
    $('.table-bordered tfoot').css( "display", "table-row-group");
    $(".table-bordered td, .table-bordered th").each(function(){ $(this).css("text-align", "center") });
    $(".table-bordered td, .table-bordered th").each(function(){ $(this).css("vertical-align", "middle") });
    //var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    //document.body.innerHTML = restorepage;
  }
  
  window.onafterprint = function(){
    window.location.reload(true);
  }

  function deleteConfirm(){
    var result = confirm("Do you really want to delete selected records?");
    if(result){
      return true;
    }else{
      return false;
    }
  }
  $(document).ready(function(){
    $('#check_all').on('click',function(){
      if(this.checked){
        $('.checkbox').each(function(){
          this.checked = true;
        });
      }else{
       $('.checkbox').each(function(){
        this.checked = false;
      });
     }
   });

    $('.checkbox').on('click',function(){
      if($('.checkbox:checked').length == $('.checkbox').length){
        $('#check_all').prop('checked',true);
      }else{
        $('#check_all').prop('checked',false);
      }
    });
  });
</script>