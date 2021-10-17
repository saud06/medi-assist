<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','purchaser','manager');
if(!(in_array($this->session->userdata('type'),$p))){
  redirect('auth');
}
$this->load->view('layout/header');
?>

<style type="text/css">
  div.processCls, div.bank_name, div.receive_date, div.receipt_no{
    display: none;
  }
</style>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <?php 
    // $this->load->view('layout/sticky_note');
  ?>
  
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h5>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('auth/dashboard'); ?>" class="text-black"><i class="fa fa-dashboard">&nbsp;</i><strong><?php echo $this->lang->line('header_dashboard'); ?></strong></a></li>
        <li><a href="<?php echo base_url('ta_da'); ?>" class="text-black"><strong>TA/DA</strong></a></li>
        <li class="active">Edit TA/DA</li>
      </ol>
    </h5>    
  </section>

  <?php 
    $session_emp_id = $this->session->userdata('identity');

    $assigned_total = $this->db->select('SUM(amount) as tot')
                               ->from('petty_cash')
                               ->get()
                               ->result();
    $costed_total = $this->db->select('SUM(amount) as tot')
                             ->from('petty_cash_assign_history')
                             ->get()
                             ->result();
    $costed_particular = $this->db->select('SUM(amount) as tot')
                             ->from('petty_cash_assign_history')
                             ->where('emp_id', $session_emp_id)
                             ->get()
                             ->result();

    if($session_emp_id === 'WEMP-000001'){
      $petty_cash_remains = $assigned_total[0]->tot - $costed_total[0]->tot;
    }
    else{
      $petty_cash_remains = $costed_particular[0]->tot;
    }
  ?>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <!-- right column -->
      <div class="col-sm-12">
        <div class="box">
          <div class="box-header with-border">
            <h3 class="box-title">Edit TA/DA</h3>

            <div class="col-md-3 callout pull-right" style="background-color: #dd9e96; border-color: #000000; padding: 6px; margin-bottom: 0">
              <h4 class="pull-left" style="font-style: italic; margin-bottom: 0">
                <?php echo 'Petty Cash Remains: ' . number_format((float)$petty_cash_remains, 2, '.', ''); ?>
              </h4>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="row">
              <form role="form" id="form" method="post" action="<?php echo base_url('ta_da/editTaDa');?>">
                <div class="col-sm-12">
                  <label>Bill</label>
                  <hr style="margin-top: 0">
                </div>

                <?php foreach($data as $row){?>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="date"><?php echo $this->lang->line('purchase_date'); ?><span class="validation-color">*</span></label>
                    <input type="text" class="form-control datepicker" id="date" name="date" value="<?php echo $row->date;?>">
                    <input type="hidden" name="ta_da_id" value="<?php echo $row->ta_da_id;?>">
                    <span class="validation-color pull-right" id="err_date"><?php echo form_error('date'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="amount">Total Amount </label>
                    <input type="number" class="form-control" id="total_amount" name="total_amount" value="<?php echo $row->total_amount; ?>" readonly>
                    <span class="validation-color" id="err_total_amount"><?php echo form_error('total_amount'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="image">Image </label>
                    <input type="file" class="form-control" id="image" name="image">
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="title">Title <span class="validation-color">*</span></label>
                    <input type="text" class="form-control" id="title" name="title" value="<?php echo $row->title; ?>">
                    <span class="validation-color" id="err_title"><?php echo form_error('title'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="ship_mode">Description </label>
                    <textarea rows="1" class="form-control" id="description" name="description"><?php echo $row->description; ?></textarea>
                  </div>
                </div>

                <div class="col-sm-12">
                  <hr>
                  <button id="category" type="button" title="Add" class="btn btn-warning pull-right"><i class="fa fa-plus" aria-hidden="true"></i></button><br><br>
                  <span class="validation-color pull-right" id="err_category"></span>
                  <br><br>
                </div>
                
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>TA/DA</label>

                    <hr style="margin-top: 0">

                    <div style="overflow-y: auto;">
                      <table class="table items table-striped table-bordered table-condensed table-hover category_table" name="category_data" id="category_data">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Details / Remarks</th>
                            <th width="15%">Amount</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $i=0;
                          $tot=0;
                          foreach ($categories as $key) {
                            ?>
                            <tr>
                              <td><input type="text" class="form-control" name="category_name" id="category_name" value="<?php echo $key->category_name; ?>" required><input type="hidden" name="id" value="<?php echo $i ?>"></td>

                              <td><input type="text" class="form-control" name="category_details" id="category_details" value="<?php echo $key->category_details; ?>"></td>
                              
                              <td><input type="number" class="form-control text-right" value="<?php echo $key->amount ?>" data-rule="quantity" min="1" name="amount" id="amount" required></td>
                            </tr>
                          <?php
                            $category_data[$i] = $i+1;
                            $i++;
                            $tot += $key->amount;
                          }
                          ?>
                        </tbody>
                      </table>
                      
                      <input type="hidden" name="table_data1" id="table_data1">

                      <table class="table table-striped table-bordered table-condensed table-hover">
                        <tr>
                          <td align="right" width="80%">Grand Total</td>
                          <td align='right'><span id="totalValue"><?php echo $tot; ?></span></td>
                          <input type="hidden" name="total_value2" id="total_value2"></td>
                          <input type="hidden" name="totalValue" value="<?php echo $tot; ?>" id="totalValue"></td>
                        </tr>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>

                <div class="col-sm-12">
                  <div class="box-footer">
                    <button type="submit" id="submit" class="button btn bg-gray">
                      <span class="submit" style="left: 16%">Update</span>
                      <span class="loading" style="left: 32%"><i class="fa fa-circle-o-notch"></i></span>
                    </button>
                    <span class="btn btn-danger" id="cancel" style="margin-left: 2%" onclick="cancel('ta_da')"><?php echo $this->lang->line('product_cancel'); ?></span>
                  </div>
                </div>
                <?php } ?>
              </form>
            </div>
          </div>
          <!-- /.box-body -->
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col -->
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
    $(document).ready(function(){
    var i = 0;
      var category_data = new Array();
      var counter = 1;
      $('#category').click(function(){
        var category = { "sl" : counter };

          category_data[i] = category;
          length = category_data.length - 1;

          var newRow = $("<tr>");
          var cols = "";

      cols += "<td>"
          +"<input type='text' class='form-control' name='category_name"+ counter +"' id='category_name"+ counter +"' required><input type='hidden' name='id' value="+i+">"
          +"</td>";

          cols += "<td>"
            +"<input type='text' class='form-control' name='category_details"+ counter +"' id='category_details"+ counter +"' >"
            +"</td>";

          cols += "<td>"
            +"<input type='number' class='form-control text-right' value='0.00' data-rule='quantity' min='1' name='amount"+ counter +"' id='amount"+ counter +"' required>"
            +"</td>";

          cols += "</tr>";
          counter++;

          newRow.append(cols);
          $("table.category_table").append(newRow);
          var table_data = JSON.stringify(category_data);
          $('#table_data1').val(table_data);
          i++;
      });

      $("table.category_table").on("click", "a.deleteRow", function (event) {
        deleteRow($(this).closest("tr"));
        $(this).closest("tr").remove();
        calculateGrandTotal();
      });

      function deleteRow(row){
        var id = +row.find('input[name^="id"]').val();
        category_data[id] = null;

        var table_data = JSON.stringify(category_data);
        $('#table_data1').val(table_data);
      }

      $("table.category_table").on("keyup", 'input[name^="category_name"], input[name^="category_details"], input[name^="amount"]', function (event) {
        calculateRow($(this).closest("tr"));
        calculateGrandTotal();
      });

      function calculateRow(row) {
        var key = +row.find('input[name^="id"]').val();
        var category_name = row.find('input[name^="category_name"]').val();
        var category_details = row.find('input[name^="category_details"]').val();
        var amount = +row.find('input[name^="amount"]').val();

        if(category_data[key]==null){
          var temp = {
            "category_name" : category_name,
            "category_details" : category_details,
            "amount" : amount
          };
          category_data[key] = temp;
        }

        category_data[key].category_name = category_name;
        category_data[key].category_details = category_details;
        category_data[key].amount = amount.toFixed(2);
        var table_data = JSON.stringify(category_data);
        $('#table_data1').val(table_data);
      }
      
      function calculateGrandTotal() {
        var totalValue = 0.00;

        $("table.category_table").find('input[name^="amount"]').each(function () {
          totalValue += +$(this).val();
        });

        $('#totalValue').text(totalValue.toFixed(2));
        $('#total_amount').val(totalValue.toFixed(2));
      }
    });
</script>

<script>
  $(document).ready(function(){
    var days = 7; // Days you want to subtract
    var date = new Date();
    var last = new Date(date.getTime() - (days * 24 * 60 * 60 * 1000));
    var day = last.getDate();
    var month = last.getMonth() + 1;
    if(month <= 9){
      month = '0' + month;
    }

    var year = last.getFullYear();
    var date2 = year + '-' + month + '-' + day;

    $('#form').submit(function(){
      var name_regex = /^[a-zA-Z]+$/;
      var num_regex = /^[0-9]+$/;
      var date_regex = /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
      var date = $('#date').val();
      var title = $('#title').val();
      var description = $('#description').val();
      var total_amount = $('#total_amount').val();
      total_amount = parseFloat(total_amount);
      var petty_cash_remains = '<?= $petty_cash_remains ?>';
      petty_cash_remains = parseFloat(petty_cash_remains);

      if(date < date2){
        $("#err_date").text("Invalid Date. You Cannot Enter Date of 7 Days Before Current Date.");
        $('#date').focus();
        return false;
      }
      else{
        $("#err_date").text("");
      }
      if(date==null || date==""){
        $("#err_date").text("Please Enter Date");
        $('#date').focus();
        return false;
      }
      else{
        $("#err_date").text("");
      }
      if (!date.match(date_regex) ) {
        $('#err_date').text(" Please Enter Valid Date ");   
        $('#date').focus();
        return false;
      }
      else{
        $("#err_date").text("");
      }
      //date codevalidation complite.

      if(title==""){
        $("#err_title").text("Please Enter Title");
        $('#title').focus();
        return false;
      }
      else{
        $("#err_title").text("");
      }
      //title validation complite.

      if(total_amount==0.00){
        $("#err_category").text("Please Enter At Least 1 Category");
        $('#category').focus();
        return false;
      }
      else{
        $("#err_category").text("");
      }
      //title validation complite.

      if(petty_cash_remains < total_amount){
        alert('Petty Cash Amount is Low!');
        return false;
      }

      $(this).find(':button[type=submit]').prop('disabled', true);
      $('.button').css('cursor', 'default');
      $('.button').toggleClass('active');
    }); 

    $("#date").change(function(event){
      var date = $('#date').val(); 
      var date_regex = /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;

      if(date < date2){
        $("#err_date").text("Invalid Date. You Cannot Enter Date of 7 Days Before Current Date.");
        $('#date').focus();
        return false;
      }
      else{
        $("#err_date").text("");
      }
      if(date==null || date==""){
        $("#err_date").text("Please Enter Date. ");
        $('#date').focus();
        return false;
      }
      else{
        $("#err_date").text("");
      }
      if (!date.match(date_regex) ) {
        $('#err_date').text("Please Enter Valid Date. ");   
        $('#date').focus();
        return false;
      }
      else{
        $("#err_date").text("");
      }
    });
    $("#title").change(function(event){
      var title = $('#title').val();
      if(title==""){
        $("#err_title").text("Please Enter Title. ");
        return false;
      }
      else{
        $("#err_title").text("");
      }
    });
  }); 
</script>