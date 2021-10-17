<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','manager');
if(!(in_array($this->session->userdata('type'),$p))){
  redirect('auth');
}
$this->load->view('layout/header');
?>
<div class="content-wrapper">
  <?php 
    // $this->load->view('layout/sticky_note');
  ?>

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h5>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('auth/dashboard'); ?>" class="text-black"><i class="fa fa-dashboard">&nbsp;</i><strong><?php echo $this->lang->line('header_dashboard'); ?></strong></a></li>
        <li><a href="<?php echo base_url('daily_expense'); ?>" class="text-black"><!-- daily_expense --> <strong>Daily Expense</strong></a></li>
        <li class="active"><!-- Edit daily_expense --> Daily Expense</li>
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
            <h3 class="box-title"><!--Edit daily_expense--> Edit Daily Expense</h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="col-sm-12">
              <form role="form" id="form" method="post" action="<?php echo base_url('daily_expense/editDailyExpense');?>">
                  <?php foreach($data as $row){?>
                  <div class="form-group">
                    <div class="col-sm-12">
                      <div class="col-sm-6">                  
                        <label for="expense_title">Expense Title <span class="validation-color">*</span></label>
                        <input type="text" class="form-control" id="expense_title" name="expense_title" value="<?php echo $row->expense_title; ?>">
                        <input type="hidden" name="id" value="<?php echo $row->daily_expense_id;?>">
                        <span class="validation-color" id="err_expense_title"><?php echo form_error('expense_title'); ?></span>
                      </div>
                      <div class="col-sm-6">
                        <div class="form-group">
                          <label for="expense_date">Expense Date <span class="validation-color">*</span></label>
                          <input type="text" class="form-control datepicker" id="expense_date" name="expense_date" value="<?php echo $row->expense_date; ?>">
                          <span class="validation-color" id="err_expense_date"><?php echo form_error('expense_date'); ?></span>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                   <div class="col-sm-12">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="expense_amount">Expense Amount <span class="validation-color">*</span></label>
                        <input type="number" class="form-control" id="expense_amount" name="expense_amount" value="<?php echo $row->expense_amount; ?>">
                        <span class="validation-color" id="err_expense_amount"><?php echo form_error('expense_amount'); ?></span>
                      </div>
                    </div>

                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="daily_expense_status">Status <span class="validation-color">*</span></label><br>
                        Active
                        <input type="radio" name="confirm" value="Active" <?php if($row->expense_status == 'Active') {?> checked="checked" <?php }?> class="minimal"/>&nbsp;&nbsp;
                        Inactive
                        <input type="radio" name="confirm" value="Inactive" <?php if($row->expense_status == 'Inactive') {?> checked="checked" <?php }?> class="minimal"/>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                   <div class="col-sm-12">
                    <div class="col-sm-6">
                      <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description"><?php echo $row->description; ?></textarea>
                      </div>
                    </div>
                  </div>
                  <?php } ?>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="box-footer">
                  <button type="submit" id="submit" class="button btn bg-gray">
                    <span class="submit" style="left: 16%">Update</span>
                    <span class="loading" style="left: 32%"><i class="fa fa-circle-o-notch"></i></span>
                  </button>
                  <span class="btn btn-default" id="cancel" style="margin-left: 2%" onclick="cancel('daily_expense')">Cancel </span>
                </div>
              </div>
            </form>
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
<script>
  $(document).ready(function(){
    var daily_expense_name_empty = "Please Enter the daily_expense Name.";
    var daily_expense_name_invalid = "Please Enter Valid daily_expense Name";
    var daily_expense_name_length = "Please Enter daily_expense Name Minimun 3 Character";
    
    $('#form').submit(function(){
      var name_regex = /^[a-z0-9\040\.\-\,\/]+$/i;
      var daily_expense_name = $('#daily_expense_name').val().trim();
      $('#daily_expense_name').val(daily_expense_name);
      if(daily_expense_name==null || daily_expense_name==""){
        $("#err_daily_expense_name").text(daily_expense_name_empty);
        return false;
      }
      else{
        $("#err_daily_expense_name").text("");
      }
      if (!daily_expense_name.match(name_regex) ) {
        $('#err_daily_expense_name').text(daily_expense_name_invalid);   
        return false;
      }
      else{
        $("#err_daily_expense_name").text("");
      }
      if (daily_expense_name.length < 3) {
        $('#err_daily_expense_name').text(daily_expense_name_length);  
        return false;
      }
      else{
        $("#err_daily_expense_name").text("");
      }

      $(this).find(':button[type=submit]').prop('disabled', true);
      $('.button').css('cursor', 'default');
      $('.button').toggleClass('active');
    });

    $("#daily_expense_name").on("blur keyup",  function (event){
      var name_regex = /^[a-z0-9\040\.\-\,\/]+$/i;
      var daily_expense_name = $('#daily_expense_name').val();
      if(daily_expense_name==null || daily_expense_name==""){
        $("#err_daily_expense_name").text(daily_expense_name_empty);
        return false;
      }
      else{
        $("#err_daily_expense_name").text("");
      }
      if (!daily_expense_name.match(name_regex)) {
        $('#err_daily_expense_name').text(daily_expense_name_invalid);  
        return false;
      }
      else{
        $("#err_daily_expense_name").text("");
      }
      if (daily_expense_name.length < 3) {
        $('#err_daily_expense_name').text(daily_expense_name_length);  
        return false;
      }
      else{
        $("#err_daily_expense_name").text("");
      }
    });

  }); 
</script>