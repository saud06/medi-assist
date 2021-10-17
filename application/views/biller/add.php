<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','manager');
if(!(in_array($this->session->userdata('type'),$p))){
  redirect('auth');
}
  $this->load->view('layout/header');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-dashboard"></i> 
                <!-- Dashboard -->
                <?php echo $this->lang->line('header_dashboard'); ?></a>
          </li>
          <li><a href="<?php echo base_url('biller'); ?>">
            <!-- Billers -->
            <?php echo $this->lang->line('biller_lable'); ?></a>
          </li>
          <li class="active"><!-- Add Biller -->
              
            <?php echo $this->lang->line('add_biller_label'); ?>
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
              <h3 class="box-title">
                    <!-- Add New Biller -->
                  <?php echo $this->lang->line('add_biller_header'); ?>
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <form role="form" id="form" method="post" action="<?php echo base_url('biller/addBiller');?>">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="biller_name"><!-- Biller Name --> 
                        <?php echo $this->lang->line('add_biller_billname'); ?>
                        <span class="validation-color">*</span>
                    </label>
                    <input type="text" class="form-control" id="biller_name" name="biller_name" value="<?php echo set_value('biller_name'); ?>">
                    <span class="validation-color" id="err_biller_name"><?php echo form_error('biller_name'); ?></span>
                  </div>
                  <div class="form-group">
                    <label for="gstid"><!-- GSTIN --> 
                        <?php echo $this->lang->line('add_biller_gst'); ?>
                        <span class="validation-color">*</span>
                    </label>
                    <input type="text" class="form-control" id="gstid" name="gstid" value="<?php echo set_value('gstid'); ?>">
                    <span style="font-size: 14px; color:blue">Ex. 24XXXXXXXXXX2Z2</span>
                    <span class="validation-color" id="err_gstid"><?php echo form_error('gstid'); ?></span>
                  </div>
                  <div class="form-group">
                    <label for="branch"><!-- Select Branch  -->
                          <?php echo $this->lang->line('add_biller_select_branch'); ?>
                        <span class="validation-color">*</span>
                    </label>
                    <select class="form-control select2" id="branch" name="branch" style="width: 100%;">
                      <option value=""><!-- Select -->
                        <?php echo $this->lang->line('add_biller_select'); ?>
                      </option>
                      <?php

                        foreach ($branch as $row) {
                          echo "<option value='$row->branch_id'".set_select('branch_id',$row->branch_id).">$row->branch_name</option>";
                        }
                      ?>
                    </select>
                    <span class="validation-color" id="err_branch"><?php echo form_error('branch'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="company_name"><!-- Company Name --> 
                          <?php echo $this->lang->line('biller_lable_company'); ?>
                        <span class="validation-color">*</span>
                    </label>
                    <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo set_value('company_name'); ?>">
                    <span class="validation-color" id="err_company_name"><?php echo form_error('company_name'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="address"><!-- Address --> 
                        <?php echo $this->lang->line('add_biller_address'); ?>
                        <span class="validation-color">*</span>
                    </label>
                    <textarea class="form-control" id="address" rows="4" name="address"><?php echo set_value('address'); ?></textarea>
                    <span class="validation-color" id="err_address"><?php echo form_error('address'); ?></span>
                  </div>

                  <div class="form-group">
                      <label for="country"><!-- Country --> 
                          <?php echo $this->lang->line('biller_lable_country'); ?>
                          <span class="validation-color">*</span>
                    </label>
                      <select class="form-control select2" id="country" name="country" style="width: 100%;">
                        <option value=""><!-- Select -->
                          <?php echo $this->lang->line('add_biller_select'); ?>
                        </option>
                        <?php
                          foreach ($country as  $key) {
                        ?>
                        <option 
                          value='<?php echo $key->id ?>' 
                          <?php 
                            if(isset($data[0]->country_id)){
                              if($key->id == $data[0]->country_id){
                                echo "selected";
                              }
                            } 
                          ?>
                        >
                        <?php echo $key->name; ?>
                        </option>
                        <?php
                          }
                        ?>
                      </select>
                      <span class="validation-color" id="err_country"><?php echo form_error('country'); ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="state"><!-- State --> 
                        <?php echo $this->lang->line('add_biller_state'); ?>
                        <span class="validation-color">*</span>
                    </label>
                    <select class="form-control select2" id="state" name="state" style="width: 100%;">
                      <option value=""><!-- Select -->
                          <?php echo $this->lang->line('add_biller_select'); ?>
                      </option>
                    </select>
                    <span class="validation-color" id="err_state"><?php echo form_error('state'); ?></span>
                  </div>
                  <div class="form-group">
                    <label for="state_code">State Code</label>
                    <input type="text" class="form-control" id="state_code" name="state_code" value="<?php echo set_value('state_code'); ?>">
                    <span class="validation-color" id="err_state_code"><?php echo form_error('state_code'); ?></span>
                  </div>
                  <div class="form-group">
                      <label for="city"><!-- City --> 
                          <?php echo $this->lang->line('biller_lable_city'); ?>
                          <span class="validation-color">*</span>
                      </label>
                      <select class="form-control select2" id="city" name="city" style="width: 100%;">
                        <option value=""><!-- Select -->
                            <?php echo $this->lang->line('add_biller_select'); ?>
                        </option>
                      </select>
                      <span class="validation-color" id="err_city"><?php echo form_error('city'); ?></span>
                    </div>

                  <div class="form-group">
                    <label for="fax"><!-- Fax --> 
                        <?php echo $this->lang->line('add_biller_fax'); ?>
                    </label>
                    <input type="text" class="form-control" id="fax" name="fax" value="<?php echo set_value('fax'); ?>">
                    <span class="validation-color" id="err_fax"><?php echo form_error('fax'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="telephone"><!-- Telephone --> 
                        <?php echo $this->lang->line('add_biller_telephone'); ?>
                        <span class="validation-color">*</span>
                    </label>
                    <input type="text" class="form-control" id="telephone" name="telephone" value="<?php echo set_value('telephone'); ?>">
                    <span class="validation-color" id="err_telephone"><?php echo form_error('telephone'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="mobile"><!-- Mobile --> 
                        <?php echo $this->lang->line('add_biller_mobile'); ?>
                        <span class="validation-color">*</span>
                    </label>
                    <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo set_value('mobile'); ?>">
                    <span class="validation-color" id="err_mobile"><?php echo form_error('mobile'); ?></span>
                  </div>

                  <div class="form-group">
                    <label for="email"><!-- email --> 
                         <?php echo $this->lang->line('biller_lable_email'); ?> 
                        <span class="validation-color">*</span>
                  </label>
                    <input type="text" class="form-control" id="email" name="email" value="<?php echo set_value('email'); ?>">
                    <span class="validation-color" id="err_email"><?php echo form_error('email'); ?></span>
                  </div>
                </div>
                </div>
                <div class="col-sm-12">
                  <div class="box-footer">
                    <button type="submit" id="submit" class="btn btn-info">&nbsp;&nbsp;&nbsp;<!-- Add -->
                        <?php echo $this->lang->line('add_user_btn'); ?>
                    &nbsp;&nbsp;&nbsp;</button>
                    <span class="btn btn-default" id="cancel" style="margin-left: 2%" onclick="cancel('biller')"><!-- Cancel -->
                      <?php echo $this->lang->line('add_user_btn_cancel'); ?>
                    </span>
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
    $('#country').change(function(){
      var id = $(this).val();
      $('#state').html('<option value="">Select</option>');
      $('#state_code').val('');
      $('#city').html('<option value="">Select</option>');
      $.ajax({
          url: "<?php echo base_url('biller/getState') ?>/"+id,
          type: "GET",
          dataType: "JSON",
          success: function(data){
            for(i=0;i<data.length;i++){
              $('#state').append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
            }
          }
        });
    });
</script>
<script>
    $('#state').change(function(){
      var id = $(this).val();
      var country = $('#country').val();
      $('#city').html('<option value="">Select</option>');
      $('#state_code').val('');
      $.ajax({
          url: "<?php echo base_url('biller/getCity') ?>/"+id,
          type: "GET",
          dataType: "JSON",
          success: function(data){
            for(i=0;i<data.length;i++){
              $('#city').append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
            }
          }
        });
      $.ajax({
          url: "<?php echo base_url('biller/getStateCode') ?>/"+id+'/'+country,
          type: "GET",
          dataType: "TEXT",
          success: function(data){
            $('#state_code').val(data);
          }
        });
    });
</script>
<script>
  $(document).ready(function(){
    $("#submit").click(function(event){
      var name_regex = /^[a-zA-Z\s]+$/;
      var sname_regex = /^[a-zA-Z\s]+$/;
      var fax_regex = /^[1-9][0-9]{6}$/; 
      var tel_regex = /^[1-9][0-9]{5}$/; 
      var mobile_regex = /^[6-9][0-9]{9}$/; 
      //var postal_regex = /^[1-9][0-9]{5}$/
      //indian mobile number  /^((\+){0,1}91(\s){0,1}(\-){0,1}(\s){0,1}){0,1}98(\s){0,1}(\-){0,1}(\s){0,1}[1-9]{1}[0-9]{7}$/
      var email_regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      var biller_name = $('#biller_name').val();
      var branch_id = $('#branch_id').val();
      var company_name = $('#company_name').val();
      var address = $('#address').val();
      var city = $('#city').val();
      var state = $('#state').val();
      //var postal_code = $('#postal_code').val();
      var country = $('#country').val();
      var telephone = $('#telephone').val();
      var mobile = $('#mobile').val();
      var email = $('#email').val();



        if(biller_name==null || biller_name==""){
          $("#err_biller_name").text("Please Enter Biller Name.");
          return false;
        }
        else{
          $("#err_biller_name").text("");
        }
        if (!biller_name.match(name_regex) ) {
          $('#err_biller_name').text(" Please Enter Valid Biller Name ");   
          return false;
        }
        else{
          $("#err_biller_name").text("");
        }
//branch name validation complite.
        
        if(branch_id==""){
          $("#err_branch_id").text("Select the Branch.");
          return false;
        }
        else{
          $("#err_branch_id").text("");
        }
//branch id validation complite.

        if(company_name==null || company_name==""){
          $("#err_company_name").text("Please Enter Company Name.");
          return false;
        }
        else{
          $("#err_company_name").text("");
        }
        if (!company_name.match(sname_regex) ) {
          $('#err_company_name').text(" Please Enter Valid Company Name ");   
          return false;
        }
        else{
          $("#err_company_name").text("");
        }
//company name validation complite.

        if(address==null || address==""){
          $("#err_address").text(" Please Enter Address");
          return false;
        }
        else{
          $("#err_address").text("");
        }
//Address validation complite.
        
       if(country==null || country==""){
          $("#err_country").text("Please Select Country");
          return false;
        }
        else{
          $("#err_country").text("");
        }
//country validation complite.

        if(state==null || state==""){
          $("#err_state").text("Please Select State ");
          return false;
        }
        else{
          $("#err_state").text("");
        }
//state validation complite.
        
        if(city==null || city==""){
          $("#err_city").text("Please Select City");
          return false;
        }
        else{
          $("#err_city").text("");
        }
//city validation complite.       

        if(telephone==null || telephone==""){
          $("#err_telephone").text("Please Enter Telephone Number");
          return false;
        }
        else{
          $("#err_telephone").text("");
        }
        if (!telephone.match(tel_regex) ) {
          $('#err_telephone').text(" Please Enter Valid Telephone Number ");   
          return false;
        }
        else{
          $("#err_telephone").text("");
        }
//Telephone validation complite.

        if(mobile==null || mobile==""){
          $("#err_mobile").text("Please Enter Mobile.");
          return false;
        }
        else{
          $("#err_mobile").text("");
        }
        if (!mobile.match(mobile_regex) ) {
          $('#err_mobile').text(" Please Enter Valid Mobile ");   
          return false;
        }
        else{
          $("#err_mobile").text("");
        }
//mobile validation complite.
        
        if(email==null || email==""){
          $("#err_email").text("Please Enter Email.");
          return false;
        }
        else{
          $("#err_email").text("");
        }
        if (!email.match(email_regex) ) {
          $('#err_email').text(" Please Enter Valid Email Address ");   
          return false;
        }
        else{
          $("#err_email").text("");
        }
//email validation complite.

    });

    $("#biller_name").on("blur keyup",  function (event){
        var name_regex = /^[-a-zA-Z\s]+$/;
        var biller_name = $('#biller_name').val();
        if(biller_name==null || biller_name==""){
          $("#err_biller_name").text("Please Enter Biller Name.");
          return false;
        }
        else{
          $("#err_biller_name").text("");
        }
        if (!biller_name.match(name_regex) ) {
          $('#err_biller_name').text(" Please Enter Valid Biller Name ");   
          return false;
        }
        else{
          $("#err_biller_name").text("");
        }
    });
    $("#branch").change(function(event){
        var branch_id = $('#branch').val();
        if(branch_id == ""){
          $("#err_branch").text("Please Select Branch");
          return false;
        }
        else{
          $("#err_branch").text("");
        }
    });
    $("#company_name").on("blur keyup",  function (event){
        var sname_regex = /^[-a-zA-Z\s]+$/;
        var company_name = $('#company_name').val();
        if(company_name==null || company_name==""){
          $("#err_company_name").text("Please Enter Company Name.");
          return false;
        }
        else{
          $("#err_company_name").text("");
        }
        if (!company_name.match(sname_regex) ) {
          $('#err_company_name').text(" Please Enter Valid Company Name ");   
          return false;
        }
        else{
          $("#err_company_name").text("");
        }
    });
    $("#address").on("blur keyup",  function (event){
        var address = $('#address').val();
        if(address==null || address==""){
          $("#err_address").text(" Please Enter Address");
          return false;
        }
        else{
          $("#err_address").text("");
        }
    });
    $("#city").change(function(event){
        var city = $('#city').val();
        if(city==null || city==""){
          $("#err_city").text("Please Select City");
          return false;
        }
        else{
          $("#err_city").text("");
        }
    });
    $("#state").change(function(event){
        var state = $('#state').val();
        if(state==null || state==""){
          $("#err_state").text("Please Select State");
          return false;
        }
        else{
          $("#err_state").text("");
        }
    });
    $("#country").change(function(event){
        var country = $('#country').val();
        if(country==null || country==""){
          $("#err_country").text("Please Select Country");
          return false;
        }
        else{
          $("#err_country").text("");
        }
    });
    
    $("#telephone").on("blur keyup",  function (event){
        var mobile_regex = /^[1-9][0-9]{5}$/;
        var telephone = $('#telephone').val();
        if(telephone==null || telephone==""){
          $("#err_telephone").text("Please Enter Telephone Number");
          return false;
        }
        else{
          $("#err_telephone").text("");
        }
        if (!telephone.match(mobile_regex) ) {
          $('#err_telephone').text(" Please Enter Valid Telephone Number ");   
          return false;
        }
        else{
          $("#err_telephone").text("");
        }
    });
    $("#mobile").on("blur keyup",  function (event){
        var mobile_regex = /^[6-9][0-9]{9}$/;
        var mobile = $('#mobile').val();
        if(mobile==null || mobile==""){
          $("#err_mobile").text("Please Enter Mobile.");
          return false;
        }
        else{
          $("#err_mobile").text("");
        }
        if (!mobile.match(mobile_regex) ) {
          $('#err_mobile').text(" Please Enter Valid Mobile ");   
          return false;
        }
        else{
          $("#err_mobile").text("");
        }
    });
    $("#email").on("blur keyup",  function (event){
        var email_regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        var email = $('#email').val();
        if(email==null || email==""){
          $("#err_email").text("Please Enter Email.");
          return false;
        }
        else{
          $("#err_email").text("");
        }
        if (!email.match(email_regex) ) {
          $('#err_email').text(" Please Enter Valid Email Address ");   
          return false;
        }
        else{
          $("#err_email").text("");
        }
    });
   
}); 
</script>
