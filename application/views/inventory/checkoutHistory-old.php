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
      <li class="active">Checkout History</li>
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
          <h3 class="box-title">Checkout History</h3>
          <!--    <a class="btn btn-sm btn-info pull-right" style="margin: 10px" href="<?php echo base_url('inventory/add');?>"><?php echo $this->lang->line('inventory_add_new_inventory'); ?></a> -->
        </div>
        <!-- /.box-header -->

        <div class="nav-tabs-custom">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">Checkout </a></li>
            <li><a href="#tab_2" data-toggle="tab">Sales</a></li>
          </ul>
          <div class="tab-content">
            <div class="tab-pane active" id="tab_1">

              <div class="box-body outer-scroll"> 
                <table id="index" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Reference No</th>
                      <th>Product Name</th>
                      <th>Category</th>
                      <th>Sub Category</th>
                      <th>Customer</th>                
                      <th>Issue Date</th>
                      <th>Quantity</th> 
                      <th>CheckIn</th> 
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($data as $i => $row) {
                     $id= $row->check_out_history_id;
                     ?>
                     <tr>
                      <td><?php echo $i++; ?> </td>
                      <td><?php echo $row->reference_no; ?></td> 
                      <td><?php 
                      $product_id= $row->product_id;
                      $this->db->where('product_id', $product_id);
                      $cat_id = $this->db->get('check_out_history')->result_array();
                      $var = $cat_id[0]['product_id'];
                      $cat_idd = explode(",", $var);
                      foreach ($cat_idd as $value) {
                        $this->db->where('product_id', $value);
                        $cat_name = $this->db->get('products')->result_array();
                        echo $cat_name[0]['name'] . '<br>';
                      }
                      ?>
                    </td>
                    <td><?php 
                    $product_id= $row->product_id;
                    $this->db->where('product_id', $product_id);
                    $cat_id = $this->db->get('products')->result_array();
                    $var = $cat_id[0]['category_id'];
                    $cat_idd = explode(",", $var);
                    foreach ($cat_idd as $value) {
                      $this->db->where('category_id', $value);
                      $cat_name = $this->db->get('category')->result_array();
                      echo $cat_name[0]['category_name'] . '<br>';
                    }
                    ?>
                  </td>
                  <td><?php 
                  $product_id= $row->product_id;
                  $this->db->where('product_id', $product_id);
                  $cat_id = $this->db->get('products')->result_array();
                  $var = $cat_id[0]['subcategory_id'];
                  $cat_idd = explode(",", $var);
                  foreach ($cat_idd as $value) {
                    $this->db->where('sub_category_id', $value);
                    $cat_name = $this->db->get('sub_category')->result_array();
                    echo $cat_name[0]['sub_category_name'] . '<br>';
                  }
                  ?>
                </td>

                <td><?php echo $row->company_name; ?></td> 
                <td><?php echo $row->out_date; ?></td>
                <td><?php echo $row->out_quantity; ?></td> 
                <td><button class="btn btn-xs btn-success" onclick="checkout(<?php echo $id;?>); "><i class="glyphicon glyphicon-plus"></i> CheckIn</button></td>

                <?php
              }
              ?>

              <tfoot>
                <tr>
                  <th>No.</th>
                  <th>Reference No</th>
                  <th>Product Name</th>
                  <th>Category</th>
                  <th>Sub Category</th>
                  <th>Customer</th>                
                  <th>Issue Date</th>
                  <th>Quantity</th> 
                  <th>Sales</th>   
                </tr>
              </tfoot>

            </table>

          </div>

          <!-- /.box-body -->
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_2">
          <h2>Product List</h2>
          <div class="form-group">
            <div class="col-sm-3"></div>
            <label for="subcategory">
              Select Client 
              <span class="validation-color">*</span></label>
              <select class="form-control select2" id="client_id"  name="client_id" style="width: 30%" onchange="clientAjax()">
               <option value="">Select</option>
              <?php
              foreach ($client as $value) {
                echo "<option value='$value->client_id'".set_select('client',$value->client_id).">$value->company_name</option>";
              }
              ?>
            </select>                      
          </div>
          <!-- /.box-header -->
          <div class="box-body">


          <table id="index1" class="table table-bordered table-striped">
              <thead>
                <thead>
                  <tr>
                    <th>No.</th>
                    <th>Reference No</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Sub Category</th>
                    <th>Customer</th>                
                    <th>Issue Date</th>
                    <th>Quantity</th> 
                    <th>Sales</th> 
                  </tr>
                </thead>
                <tbody>
                  <?php
                  foreach ($data as $i => $row) {
                   $id= $row->check_out_history_id;
                   ?>
                   <tr>
                    <td><?php echo $i++; ?> </td>
                    <td><?php echo $row->reference_no; ?></td> 
                    <td><?php 
                    $product_id= $row->product_id;
                    $this->db->where('product_id', $product_id);
                    $cat_id = $this->db->get('check_out_history')->result_array();
                    $var = $cat_id[0]['product_id'];
                    $cat_idd = explode(",", $var);
                    foreach ($cat_idd as $value) {
                      $this->db->where('product_id', $value);
                      $cat_name = $this->db->get('products')->result_array();
                      echo $cat_name[0]['name'] . '<br>';
                    }

                    ?>
                  </td>
                  <td><?php 
                  $product_id= $row->product_id;
                  $this->db->where('product_id', $product_id);
                  $cat_id = $this->db->get('products')->result_array();
                  $var = $cat_id[0]['category_id'];
                  $cat_idd = explode(",", $var);
                  foreach ($cat_idd as $value) {
                    $this->db->where('category_id', $value);
                    $cat_name = $this->db->get('category')->result_array();
                    echo $cat_name[0]['category_name'] . '<br>';
                  }
                  ?>
                </td>
                <td><?php 
                $product_id= $row->product_id;
                $this->db->where('product_id', $product_id);
                $cat_id = $this->db->get('products')->result_array();
                $var = $cat_id[0]['subcategory_id'];
                $cat_idd = explode(",", $var);
                foreach ($cat_idd as $value) {
                  $this->db->where('sub_category_id', $value);
                  $cat_name = $this->db->get('sub_category')->result_array();
                  echo $cat_name[0]['sub_category_name'] . '<br>';
                }
                ?>
              </td>

              <td><?php echo $row->company_name; ?></td> 
              <td><?php echo $row->out_date; ?></td>
              <td><?php echo $row->out_quantity; ?></td> 
              <td><button class="btn btn-xs btn-success" onclick="checkout(<?php echo $id;?>); "><i class="glyphicon glyphicon-plus"></i> Sales</button></td>

              <?php
            }
            ?>

            <tfoot>
              <tr>
                <th>No.</th>
                <th>Reference No</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Sub Category</th>
                <th>Customer</th>                
                <th>Issue Date</th>
                <th>Quantity</th> 
                <th>Sales</th>   
              </tr>
            </tfoot>
          </table> 

        </div>
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
<!-- for sales -->
<script>
  function clientAjax(){
    var client_id = $("#client_id").val();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("client_list").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "clientAjax.php?client_id=" + client_id, true);
    xmlhttp.send();
  }
</script>

<script type="text/javascript">
 var save_method;
/* function add_book()
 {
  save_method = 'add';
      $('#form')[0].reset(); // reset form on modals
      $('#modal_checkin').modal('show'); // show bootstrap modal

    }*/
    function checkout(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals
      //Ajax Load data from ajax
      $.ajax({
        url : "<?php echo base_url('inventory/check_in/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data)
        {
          //console.log(data);

          $('input[name="inventory_id"]').val(data[0].inventory_id);
          $('input[name="product_id"]').val(data[0].product_id);
          $('[name="name"]').val(data[0].name);
          $('[name="quantity"]').val(data[0].quantity);
          $('[name="company_name"]').val(data[0].company_name);
          $('[name="cost"]').val(data[0].cost);
          $('[name="out_quantity"]').val(data[0].out_quantity);
          $('[name="out_date"]').val(data[0].out_date);
          $('[name="client_id"]').val(data[0].client_id);
          $('[name="check_out_history_id"]').val(data[0].check_out_history_id);
          $('[name="reference_no"]').val(data[0].reference_no);
          //$('[name="in_quantity"]').attr("max",0);
          




          $('#modal_checkin').modal('show'); 
          $('.modal-title').text('Product CheckIn'); 

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
          alert('Error get data from ajax');
        }
      });
    }


    function checkInSave()
    {
      var url;
      url = "<?php echo base_url('inventory/checkin_add/')?>";
 /*     if(save_method == 'add')
      {
        url = "<?php echo base_url('inventory/ckh_add/')?>";
      }
      else
      {
        url = "<?php echo base_url('inventory/ckh_add/')?>";
      }*/
       // ajax adding data to database
       //alert($('#form').serialize());
       $.ajax({
        url : url,
        type: "POST",
        data: $('#form').serialize(),
        dataType: "JSON",
        success: function(data)
        {
          //  console.log(data);
          /*  $('#modal_form').modal('hide');*/
             location.reload();// for reload a page

           },
           error: function (jqXHR, textStatus, errorThrown)
           {
            /*console.log(data);*/
            alert('Error check out adding data'+errorThrown);
          }
        });
     }       

   </script>



   <!-- modal -->

   <div class="modal fade" id="modal_checkin" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h3 class="modal-title">Product CheckIn</h3>
        </div>
        <div class="modal-body form">
          <form action="#" id="form" class="form-horizontal">
            <input type="hidden" value="" name="inventory_id" id="inventory_id" />
            <input type="hidden" value="" name="product_id" id="product_id" />
            <input type="hidden" value="" name="check_out_history_id" id="check_out_history_id" />
            <input type="hidden" value="" name="client_id" id="client_id" />

            <div class="form-body">
              <div class="form-group">
                <label class="control-label col-md-3">CheckOut No</label>
                <div class="col-md-9">
                  <input name="reference_no" placeholder="name" class="form-control" type="text" readonly="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Product</label>
                <div class="col-md-9">
                  <input name="name" placeholder="name" class="form-control" type="text" readonly="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Client</label>
                <div class="col-md-9">
                  <input name="company_name" placeholder="company_name" class="form-control" type="text" readonly="">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Cost</label>
                <div class="col-md-9">
                  <input name="cost" placeholder="cost" class="form-control" type="text" readonly="">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Out Quantity</label>
                <div class="col-md-9">
                  <input name="out_quantity" placeholder="Out quantity" class="form-control" type="number" readonly="">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3">Last Issue Date</label>
                <div class="col-md-9">
                  <input name="out_date" placeholder="Out quantity" class="form-control" type="text" readonly="">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">In Quantity<span class="validation-color">*</span></label>
                <div class="col-md-9">
                  <input name="in_quantity" placeholder="In Quantity" class="form-control" type="number" min="1" required>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Status</label>
                <div class="col-md-9">
                  <select class="form-control select2" id="status" name="status" style="width: 100%;">
                    <option value="Fully Returned">Select </option>                
                    <option value="Fully Returned">Fully Returned</option>
                    <option value="Partially Returned">Partially Returned</option>
                    <option value="Fully Sold">Fully Sold</option>
                    <option value="Partially Sold">Partially Sold</option>
                  </select>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3">Remarks</label>
                <div class="col-md-9">
                  <input name="remarks" placeholder="Remarks" class="form-control" type="text">

                </div>
              </div>

            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" id="btnSave" onclick="checkInSave()" class="btn btn-success">CheckIn</button>
          <!-- <input type="submit" class="btn btn-xs btn-danger"  id="btnSave" onclick="save()"  value="CheckOut" /> -->
          <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>

  <!-- /.modal -->



  <?php
  $this->load->view('layout/footer');
  ?>




  <script type="text/javascript">
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

