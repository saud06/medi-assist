<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','sales_person','manager');
if(!(in_array($this->session->userdata('type'),$p))){
  redirect('auth');
}
  $this->load->view('layout/header');
?>
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
          <li><a href="<?php echo base_url('sales'); ?>" class="text-black"><strong>Sales / Sample Submit</strong></a></li>
          <li class="active"><?php echo $this->lang->line('header_payment'); ?></li>
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
              <h3 class="box-title"><?php echo $this->lang->line('header_payment'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <form role="form" id="form" method="post" action="<?php echo base_url('sales/addPayment');?>">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="date"><?php echo $this->lang->line('purchase_date'); ?> <span class="validation-color">*</span></label>
                    <input type="text" class="form-control datepicker" id="date" name="date" value="<?php echo date("Y-m-d");  ?>">
                    <input type="hidden" name="id" value="<?php echo $data[0]->sales_id; ?>">
                    <input type="hidden" name="currency_id" value="<?php echo $data[0]->currency_id; ?>">
                    <span class="validation-color pull-right" id="err_date"><?php echo form_error('date'); ?></span>
                  </div>

                  <?php
                    if($p_reference_no==null){
                        $no = sprintf('%06d',intval(1));
                    }
                    else{
                      foreach ($p_reference_no as $value) {
                        $no = sprintf('%06d',intval($value->id)+1); 
                      }
                    }
                  ?>
                  <div class="form-group">
                    <label for="reference_no"><?php echo $this->lang->line('purchase_reference_no'); ?></label>
                    <input type="text" class="form-control" id="reference_no" name="reference_no" value="WPMNT-<?php echo $no;?>" readonly>
                    <span class="validation-color" id="err_reference_no"><?php echo form_error('reference_no'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="amount">
                      <?php 
                        echo $this->lang->line('sales_amount');
                        if($data[0]->currency_id == 2){
                          echo ' (৳)'; 
                        }
                        else{
                          echo ' ($)'; 
                        }
                      ?>
                    </label>
                    <input type="text" class="form-control" id="amount" name="amount" value="<?php echo $data[0]->total+$data[0]->shipping_charge;?>" readonly>
                    <span class="validation-color" id="err_amount"><?php echo form_error('amount'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="paying_by">Payment Method <span class="validation-color">*</span></label>
                    <select class="form-control select2" id="paying_by" name="paying_by" style="width: 100%;">
                      <option value="">Select Payment Method</option>
                      <option>Cash</option>
                      <option>Cheque</option>
                    </select>
                    <span class="validation-color" id="err_paying_by"><?php echo form_error('paying_by'); ?></span>
                  </div>

                  <div id = "hide">
                  <div class="form-group">
                    <label for="bank_name"><?php echo $this->lang->line('payment_bank_name'); ?> <span class="validation-color">*</span></label>
                    <input type="text" class="form-control" id="bank_name" name="bank_name" value="<?php echo set_value('bank_name'); ?>">
                    <span class="validation-color" id="err_bank_name"><?php echo form_error('bank_name'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="cheque_no"><?php echo $this->lang->line('payment_cheque_no'); ?> <span class="validation-color">*</span></label>
                    <input type="text" class="form-control" id="cheque_no" name="cheque_no" value="<?php echo set_value('cheque_no'); ?>">
                    <span class="validation-color" id="err_cheque_no"><?php echo form_error('cheque_no'); ?></span>
                  </div>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <div class="box-header with-border">
                      <div class="col-md-5"></div>
                      <div class="col-md-2">
                        <h4 style="margin-top: 0; margin-bottom: 12px;">Taken By</h4>
                      </div>
                      <div class="col-md-5"></div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="name">Name <span class="validation-color">*</span></label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo set_value('name'); ?>">
                    <span class="validation-color" id="err_name"><?php echo form_error('name'); ?></span>
                  </div>
                  <div class="form-group">
                    <label for="contact">Contact <span class="validation-color">*</span></label>
                    <input type="text" class="form-control" id="contacts" name="contact" value="<?php echo set_value('contact'); ?>">
                    <span class="validation-color" id="err_contact"><?php echo form_error('contact'); ?></span>
                  </div>
                  <div class="form-group">
                    <label for="designation">Designation </label>
                    <input type="text" class="form-control" id="designation" name="designation">
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                      <label for="note"><?php echo $this->lang->line('purchase_note'); ?></label>
                      <textarea class="form-control" id="note" name="note"><?php echo set_value('details'); ?></textarea>
                    </div>
                  </div>
                </div>
                 <div class="col-sm-12">
                  <div class="box-footer">
                    <button type="submit" id="submit" class="button btn bg-gray">
                      <span class="submit" style="left: 32%">Pay</span>
                      <span class="loading" style="left: 32%"><i class="fa fa-circle-o-notch"></i></span>
                    </button>
                    <span class="btn btn-danger" id="cancel" style="margin-left: 2%" onclick="cancel('sales/view/<?php echo $data[0]->sales_id; ?>')"><?php echo $this->lang->line('product_cancel'); ?></span>
                  </div>
                </div>
              </form>
          </div>
          <!-- /.box-body -->
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
    $('#hide').hide();
    var date_empty = "Please Enter Date.";
    var date_invalid = "Please Enter Valid Date.";
    var paying_by_empty = "Please Enter Paying Mode.";
    var bank_name_empty = "Please Enter Bank Name.";
    var bank_name_invalid = "Please Enter Valid Bank Name.";
    var bank_name_length = "Please Enter Bank Name Minimun 3 Character.";
    var cheque_no_empty = "Please Enter Cheque No.";
    var cheque_no_invalid = "Please Enter Valid Cheque No.";
    var name_empty = "Please Enter Name.";
    var name_invalid = "Please Enter Valid Name.";
    var contact_empty = "Please Enter Contact Number.";
    var contact_invalid = "Please Enter Valid Contact Number.";
    
    $('#form').submit(function(){
      var name_regex = /^[a-z0-9\040\.\-\,\/]+$/i;
      var num_regex = /^[0-9]+$/;
      var date_regex = /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
      var date = $('#date').val().trim();
      var paying_by = $('#paying_by').val();
      var bank_name = $('#bank_name').val().trim();
      var cheque_no = $('#cheque_no').val().trim();
      var name = $('#name').val();
      var contact = $('#contacts').val();
      
      if(date==null || date==""){
        $("#err_date").text(date_empty);
        return false;
      }
      else{
        $("#err_date").text("");
      }
      if (!date.match(date_regex) ) {
        $('#err_date').text(date_invalid);   
        return false;
      }
      else{
        $("#err_date").text("");
      }
      //date validation complite.

      if(paying_by==null || paying_by==""){
        $("#err_paying_by").text(paying_by_empty);
        return false;
      }
      else{
        $("#err_paying_by").text("");
      }

      if(paying_by=="Cheque"){
        if(bank_name == null || bank_name == ""){
          $('#err_bank_name').text(bank_name_empty);
          return false;
        }
        else{
          $('#err_bank_name').text('');
        }
        if (!bank_name.match(name_regex) ) {
          $('#err_bank_name').text(bank_name_invalid);   
          return false;
        }
        else{
          $("#err_bank_name").text("");
        }
        if (bank_name.length < 3) {
          $('#err_bank_name').text(bank_name_length);  
          return false;
        }
        else{
          $("#err_bank_name").text("");
        }

        if(cheque_no == null || cheque_no == ""){
          $('#err_cheque_no').text(cheque_no_empty);
          return false;
        }
        else{
          $('#err_cheque_no').text('');
        }
        if (!cheque_no.match(num_regex) ) {
          $('#err_cheque_no').text(cheque_no_invalid);   
          return false;
        }
        else{
          $("#err_cheque_no").text("");
        }
      }
      //payment validation complite.

      if(name==null || name==""){
        $("#err_name").text(name_empty);
        return false;
      }
      else{
        $("#err_name").text("");
      }
      if (!name.match(name_regex) ) {
        $('#err_name').text(name_invalid);   
        return false;
      }
      else{
        $("#err_name").text("");
      }
      //name validation complite.

      if(contact==null || contact==""){
        $("#err_contact").text(contact_empty);
        return false;
      }
      else{
        $("#err_contact").text("");
      }
      if (!contact.match(num_regex) ) {
        $('#err_contact').text(contact_invalid);   
        return false;
      }
      else{
        $("#err_contact").text("");
      }
      //contact validation complite.

      $(this).find(':button[type=submit]').prop('disabled', true);
      $('.button').css('cursor', 'default');
      $('.button').toggleClass('active');
    });

    $("#date").on("blur keyup",  function (event){
      var date_regex = /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
      var date = $('#date').val().trim();
      if(date==null || date==""){
        $("#err_date").text(date_empty);
        return false;
      }
      else{
        $("#err_date").text("");
      }
      if (!date.match(date_regex) ) {
        $('#err_date').text(date_invalid);   
        return false;
      }
      else{
        $("#err_date").text("");
      }
    });
    $("#paying_by").on("change",  function (event){
      $('#hide').hide();
      var paying_by = $('#paying_by').val();
      if(paying_by==null || paying_by==""){
        $("#err_paying_by").text(paying_by_empty);
        return false;
      }
      else{
        if(paying_by == "Cheque"){
          $('#hide').show();
        }
        $("#err_paying_by").text("");
      }
    });
   $("#bank_name").on("blur keyup",  function (event){
      var name_regex = /^[-a-zA-Z\s]+$/;
      var bank_name = $('#bank_name').val().trim();
      if(bank_name == null || bank_name == ""){
        $('#err_bank_name').text(bank_name_empty);
        return false;
      }
      else{
        $('#err_bank_name').text('');
      }
      if (!bank_name.match(name_regex) ) {
        $('#err_bank_name').text(bank_name_invalid);   
        return false;
      }
      else{
        $("#err_bank_name").text("");
      }
      if (bank_name.length < 3) {
        $('#err_bank_name').text(bank_name_length);  
        return false;
      }
      else{
        $("#err_bank_name").text("");
      }
    });
   $("#cheque_no").on("blur keyup",  function (event){
      var num_regex = /^[0-9]+$/;
      var cheque_no = $('#cheque_no').val().trim();
      if(cheque_no == null || cheque_no == ""){
        $('#err_cheque_no').text(cheque_no_empty);
        return false;
      }
      else{
        $('#err_cheque_no').text('');
      }
      if (!cheque_no.match(num_regex) ) {
        $('#err_cheque_no').text(cheque_no_invalid);   
        return false;
      }
      else{
        $("#err_cheque_no").text("");
      }
    });
    $("#name").on("blur keyup",  function (event){
      var name_regex = /^[a-z0-9\040\.\-\,\/]+$/i;
      var name = $('#name').val().trim();
      if(name==null || name==""){
        $("#err_name").text(name_empty);
        return false;
      }
      else{
        $("#err_name").text("");
      }
      if (!name.match(name_regex) ) {
        $('#err_name').text(name_invalid);   
        return false;
      }
      else{
        $("#err_name").text("");
      }
    });
    $("#contacts").on("blur keyup",  function (event){
      var num_regex = /^[0-9]+$/;
      var contact = $('#contact').val().trim();
      if(contact==null || contact==""){
        $("#err_contact").text(contact_empty);
        return false;
      }
      else{
        $("#err_contact").text("");
      }
      if (!contact.match(num_regex) ) {
        $('#err_contact').text(contact_invalid);   
        return false;
      }
      else{
        $("#err_contact").text("");
      }
    });
}); 
</script>