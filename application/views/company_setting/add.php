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
          <li><a href="<?php echo base_url('auth/dashboard'); ?>" class="text-black"><i class="fa fa-dashboard">&nbsp;</i><strong><?php echo $this->lang->line('header_dashboard'); ?></strong></a></li>
          <li class="active"><?php echo $this->lang->line('header_company_setting'); ?></li>
        </ol>
      </h5>    
    </section>
<!-- Main content -->
    <section class="content">
      <div class="row">
      <!-- right column -->
        <?php
          if($fail = $this->session->flashdata('fail')){
        ?>
          <div class="col-sm-12">
            <div class="alert alert-success">
              <button class="close" data-dismiss="alert" type="button">×</button>
                <?php echo $fail; ?>
              <div class="alerts-con"></div>
            </div>
          </div>
        <?php
          }
        ?>
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $this->lang->line('header_company_setting'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <form role="form" id="form" method="post" action="<?php echo base_url('company_setting/add');?>" encType="multipart/form-data">
                  <div class="col-md-6">
                  	<div class="form-group">
                      <label for="name"><?php echo $this->lang->line('company_setting_name'); ?> <span class="validation-color">*</span></label>
                      <input type="text" class="form-control" id="name" name="name" value="<?php if(isset($data[0]->name)){ echo $data[0]->name; }?>">
                      <span class="validation-color" id="err_name"><?php echo form_error('name'); ?></span>
                    </div>
                    <div class="form-group">
                      <label for="short_name"><?php echo $this->lang->line('company_setting_site_short_name'); ?><span class="validation-color">*</span></label>
                      <input type="text" class="form-control" id="short_name" name="short_name" value="<?php if(isset($data[0]->site_short_name)){ echo $data[0]->site_short_name; }?>">
                      <span class="validation-color" id="err_short_name"><?php echo form_error('short_name'); ?></span>
                    </div>
                    <div class="form-group">
                    <label for="tan">Tan 
                        
                        <!-- <?php echo $this->lang->line('add_client_compname'); ?> -->
                        <span class="validation-color"></span>
                    </label>
                    <input type="text" class="form-control" id="tan" name="tan" value="<?php if(isset($data[0]->tan_no)){ echo $data[0]->tan_no; }?>">
                    <span class="validation-color" id="err_tan"><?php echo form_error('tan'); ?></span>
                </div>

                <div class="form-group">
                    <label for="cstregno">Cst Reg No
                        
                        <!-- <?php echo $this->lang->line('add_client_compname'); ?> -->
                        <span class="validation-color"></span>
                    </label>
                    <input type="text" class="form-control" id="cstregno" name="cstregno" value="<?php if(isset($data[0]->cst_reg_no)){ echo $data[0]->cst_reg_no; }?>">
                    <span class="validation-color" id="err_cstregno"><?php echo form_error('cstregno'); ?></span>
                </div>

                <div class="form-group">
                    <label for="exciseregno">Excise Reg No
                        
                        <!-- <?php echo $this->lang->line('add_client_compname'); ?> -->
                        <span class="validation-color"></span>
                    </label>
                    <input type="text" class="form-control" id="exciseregno" name="exciseregno" value="<?php if(isset($data[0]->excise_reg_no)){ echo $data[0]->excise_reg_no; }?>">
                    <span class="validation-color" id="err_panno"><?php echo form_error('exciseregno'); ?></span>
                </div>

                <div class="form-group">
                    <label for="lbtregno">Lbt Reg No
                        
                        <!-- <?php echo $this->lang->line('add_client_compname'); ?> -->
                        <span class="validation-color"></span>
                    </label>
                    <input type="text" class="form-control" id="lbtregno" name="lbtregno" value="<?php if(isset($data[0]->lbt_reg_no)){ echo $data[0]->lbt_reg_no; }?>">
                    <span class="validation-color" id="err_lbtregno"><?php echo form_error('lbtregno'); ?></span>
                </div>

                <div class="form-group">
                    <label for="servicetaxno">Service Tax Reg No
                        
                        <!-- <?php echo $this->lang->line('add_client_compname'); ?> -->
                        <span class="validation-color"></span>
                    </label>
                    <input type="text" class="form-control" id="servicetaxno" name="servicetaxno" value="<?php if(isset($data[0]->servicetax_reg_no)){ echo $data[0]->servicetax_reg_no; }?>">
                    <span class="validation-color" id="err_servicetaxno"><?php echo form_error('servicetaxno'); ?></span>
                </div>

                <div class="form-group">
                    <label for="cin">Cin
                        
                        <!-- <?php echo $this->lang->line('add_client_compname'); ?> -->
                        <span class="validation-color"></span>
                    </label>
                    <input type="text" class="form-control" id="cin" name="cin" value="<?php if(isset($data[0]->cin)){ echo $data[0]->cin; }?>">
                    <span class="validation-color" id="err_cin"><?php echo form_error('cin'); ?></span>
                </div>


                <div class="form-group">
                      <label for="gstregtype">Select Gst Registration Type
                          <!-- <?php echo $this->lang->line('biller_lable_country'); ?> --> <span class="validation-color">*</span>
                        </label>
                      <select class="form-control select2" id="gstregtype" name="gstregtype" style="width: 100%;">
                          <option <?php 
                                  if(isset($data[0]->gst_registration_type)){
                                    if($data[0]->gst_registration_type == "Registered"){
                                      echo "selected";
                                    }
                                  } 
                                ?>>Registered
                        </option>
                        <option <?php 
                                  if(isset($data[0]->gst_registration_type)){
                                    if($data[0]->gst_registration_type == "Unregistered"){
                                      echo "selected";
                                    }
                                  } 
                                ?>>Unregistered
                        </option>
                        <option <?php 
                                  if(isset($data[0]->gst_registration_type)){
                                    if($data[0]->gst_registration_type == "Composition Scheme"){
                                      echo "selected";
                                    }
                                  } 
                                ?>>Composition Scheme
                        </option>
                        <option <?php 
                                  if(isset($data[0]->gst_registration_type)){
                                    if($data[0]->gst_registration_type == "Input Service Distributor"){
                                      echo "selected";
                                    }
                                  } 
                                ?>>Input Service Distributor
                        </option>
                        <option <?php 
                                  if(isset($data[0]->gst_registration_type)){
                                    if($data[0]->gst_registration_type == "E-Commerece Operator"){
                                      echo "selected";
                                    }
                                  } 
                                ?>>E-Commerece Operator
                        </option>
                          <!-- <option>Registered</option>
                          <option>Unregistered</option>
                          <option>Composition Scheme</option>
                          <option>Input Service Distributor</option>
                          <option>E-Commerece Operator</option> -->
                      </select>
                  </div>
                  <div class="form-group">
                    <label for="country">Logo</span></label>
                    <input type="file" id="logo" name="logo">
                      <?php if(isset($data[0]->logo)){?>
                      <img src="<?php echo base_url().$data[0]->logo;?>" width="20%">
                      <?php }?>
                      <input type="hidden" name="hidden_logo_name" value="<?php if(isset($data[0]->logo)){echo $data[0]->logo;}?>">
                      <span class="validation-color" id="err_logo"><?php echo form_error('logo'); ?></span>
                  </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                      <label for="country">Select Country <span class="validation-color">*</span></label>
                      <select class="form-control select2" id="country" name="country" style="width: 100%;">
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

                    <div class="form-group">
                      <label for="state">Select State <span class="validation-color">*</span></label>
                      <select class="form-control select2" id="state" name="state" style="width: 100%;">
                        <?php
                          foreach ($state as  $key) {
                        ?>
                        <option 
                          value='<?php echo $key->id ?>' 
                          <?php 
                            if(isset($data[0]->state_id)){
                              if($key->id == $data[0]->state_id){
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
                      <span class="validation-color" id="err_state"><?php echo form_error('state'); ?></span>
                    </div>

                      <!-- <div class="form-group">
                        <label for="state">State <span class="validation-color">*</span></label>
                        <input type="text" class="form-control" id="state" name="state" value="<?php if(isset($data[0]->state)){ echo $data[0]->state; }?>">
                        <span class="validation-color" id="err_state"><?php echo form_error('state'); ?></span>
                      </div> -->

                    <div class="form-group">
                      <label for="city">Select City <span class="validation-color">*</span></label>
                      <select class="form-control select2" id="city" name="city" style="width: 100%;">
                        <?php
                          foreach ($city as  $key) {
                        ?>
                        <option 
                          value='<?php echo $key->id ?>' 
                          <?php 
                            if(isset($data[0]->city_id)){
                              if($key->id == $data[0]->city_id){
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
                      <span class="validation-color" id="err_city"><?php echo form_error('city'); ?></span>
                    </div>

                      <!-- <div class="form-group">
                        <label for="city">City <span class="validation-color">*</span></label>
                        <input type="text" class="form-control" id="city" name="city" value="<?php if(isset($data[0]->city)){ echo $data[0]->city; }?>">
                        <span class="validation-color" id="err_city"><?php echo form_error('city'); ?></span>
                      </div> -->

                    <div class="form-group">
                      <label for="street"><?php echo $this->lang->line('company_setting_street'); ?> <span class="validation-color">*</span></label>
                      <input type="text" class="form-control" id="street" name="street" value="<?php if(isset($data[0]->street)){ echo $data[0]->street; }?>">
                      <span class="validation-color" id="err_street"><?php echo form_error('street'); ?></span>
                    </div>

                    <div class="form-group">
                      <label for="zip_code"><?php echo $this->lang->line('company_setting_zip_code'); ?> </label>
                      <input type="text" class="form-control" id="zip_code" name="zip_code" value="<?php if(isset($data[0]->zip_code)){ echo $data[0]->zip_code; }?>">
                      <span class="validation-color" id="err_zip_code"><?php echo form_error('zip_code'); ?></span>
                    </div>

                    <div class="form-group">
                      <label for="email"><?php echo $this->lang->line('company_setting_email'); ?> <span class="validation-color">*</span></label>
                      <input type="text" class="form-control" id="email" name="email" value="<?php if(isset($data[0]->email)){ echo $data[0]->email; }?>">
                      <span class="validation-color" id="err_email"><?php echo form_error('email'); ?></span>
                    </div>

                  	<div class="form-group">
                    	<label for="phone"><?php echo $this->lang->line('company_setting_mobile'); ?> <span class="validation-color">*</span></label>
                    	<input type="text" class="form-control" id="mobile" name="mobile" value="<?php if(isset($data[0]->phone)){ echo $data[0]->phone; }?>">
                    	<span class="validation-color" id="err_mobile"><?php echo form_error('mobile'); ?></span>
                  	</div>
                    	
                    	<!-- /.form-group -->
                  	<div class="form-group">
                    	<label for="language">Select Default Language </label>
                    	<select class="form-control select2" id="language" name="language" style="width: 100%;">
                      	<option <?php 
	                          			if(isset($data[0]->default_language)){
	                          				if($data[0]->default_language == "English(US)"){
	                          					echo "selected";
	                          				}
	                          			} 
	                          		?>>English(US)
                        </option>
                      	<option <?php 
	                          			if(isset($data[0]->default_language)){
	                          				if($data[0]->default_language == "English(UK)"){
	                          					echo "selected";
	                          				}
	                          			} 
	                          		?>>English(UK)
                        </option>
                      	<option <?php 
	                          			if(isset($data[0]->default_language)){
	                          				if($data[0]->default_language == "Spanish"){
	                          					echo "selected";
	                          				}
	                          			} 
	                          		?>>Spanish
                        </option>
                      	<option <?php 
	                          			if(isset($data[0]->default_language)){
	                          				if($data[0]->default_language == "Hindi"){
	                          					echo "selected";
	                          				}
	                          			} 
	                          		?>>Hindi
                        </option>
                    	</select>
                  	</div>
                  	<!-- /.form-group -->
                  	<div class="form-group">
                    	<label for="currency">Select Currency </label>
                    	<select class="form-control select2" id="currency" name="currency" style="width: 100%;">
                      	<?php
	                        foreach ($currency as  $key) {
	                      ?>
	                      <option 
	                        value='<?php echo $key->id ?>' 
	                        <?php 
	                          if(isset($data[0]->default_currency)){
	                          	if($key->id == $data[0]->default_currency){
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
                  	</div>
                    <div class="form-group">
                      <label for="terms"><!-- <?php echo $this->lang->line('company_setting_mobile'); ?> --> 
                        Terms & Condidtion
                          <span class="validation-color"></span>
                      </label>
                      <!-- <input type="text" class="form-control" id="mobile" name="mobile" value=""> -->
                      <!-- <textarea class="textarea" name="terms" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                       <?php if(isset($data[0]->terms)){ echo $data[0]->terms; }?>
                      </textarea> -->
                      <textarea  class="ckeditor" id="details" name="details" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"> 
                          <?php if(isset($data[0]->terms_condition)){ echo $data[0]->terms_condition;}?>    
                      </textarea>
                      <span class="validation-color" id="err_details"><?php echo form_error('details'); ?></span>
                    </div>

                    <div class="form-group">
                      <label for="phone"><!-- <?php echo $this->lang->line('company_setting_mobile'); ?> --> 
                      Bank Name
                        <span class="validation-color"></span>
                      </label>
                      <input type="text" class="form-control" id="bank" name="bank" value="<?php if(isset($data[0]->bank_name)){ echo $data[0]->bank_name; }?>">
                      <span class="validation-color" id="err_bank"><?php echo form_error('bank'); ?></span>
                    </div>

                    <div class="form-group">
                      <label for="phone"><!-- <?php echo $this->lang->line('company_setting_mobile'); ?> --> 
                        Account No
                        <span class="validation-color"></span>
                      </label>
                      <input type="text" class="form-control" id="account" name="account" value="<?php if(isset($data[0]->account_no)){ echo $data[0]->account_no; }?>">
                      <span class="validation-color" id="err_account"><?php echo form_error('account'); ?></span>
                    </div>

                    <div class="form-group">
                      <label for="phone"><!-- <?php echo $this->lang->line('company_setting_mobile'); ?> --> 
                        Branch & IFSC Code
                        <span class="validation-color"></span>
                      </label>
                      <input type="text" class="form-control" id="branch" name="branch" value="<?php if(isset($data[0]->branch_ifsccode)){ echo $data[0]->branch_ifsccode; }?>">
                      <span class="validation-color" id="err_branch"><?php echo form_error('branch'); ?></span>
                    </div>
                  </div>
                  <div class="col-sm-12">
                  	<div class="box-footer">
                      <button type="submit" id="submit" name="submit" class="btn btn-info btn-flat"><?php echo $this->lang->line('company_setting_submit'); ?></button>
                      <span class="btn btn-default btn-flat" id="cancel" style="margin-left: 2%" onclick="cancel('auth/dashboard')"><?php echo $this->lang->line('company_setting_cancel'); ?></span>
                    </div>
                  </div>
                </form>
            </div>
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
      $.ajax({
          url: "<?php echo base_url('company_setting/getState') ?>/"+id,
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
      $.ajax({
          url: "<?php echo base_url('company_setting/getCity') ?>/"+id,
          type: "GET",
          dataType: "JSON",
          success: function(data){
            for(i=0;i<data.length;i++){
              $('#city').append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
            }
          }
        });
    });
</script>
<script>
  $(document).ready(function(){
    var name_empty = "Please Enter Name.";
    var name_invalid = "Please Enter Valid Name";
    var name_length = "Please Enter Name Minimun 3 Character";
    var short_name_empty = "Please Enter Site Short Name.";
    var short_name_invalid = "Please Enter Valid Site Short Name";
    var short_name_length = "Please Enter Site Short Name Minimun 2 Character";
    var email_empty = "Please Enter Email.";
    var email_invalid = "Please Enter Valid Email";
    var mobile_empty = "Please Enter Mobile No.";
    var mobile_invalid = "Please Enter Valid Mobile No";
    var mobile_length = "Please Enter 10 digit Mobile No";
    var street_empty = "Please Enter Street.";
    var street_invalid = "Please Enter Valid Street";
    var street_length = "Please Enter Street Minimun 3 Character";
    var city_select = "Please Select City.";
    var state_select = "Please Select State.";
    var country_select = "Please Select Country.";
    $("#submit").click(function(event){
      var name_regex = /^[-a-zA-Z\s]+$/;
      var email_regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      var mobile_regex = /^[6-9][0-9]{9}$/; 
      var city_regex = /^[a-zA-Z\s]+$/;
      var name = $('#name').val().trim();
      var short_name = $('#short_name').val().trim();
      var email = $('#email').val().trim();
      var mobile = $('#mobile').val().trim();
      var street = $('#street').val().trim();
      var city = $('#city').val().trim();
      var state = $('#state').val().trim();
      var country = $('#country').val();

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
      if (name.length < 3) {
        $('#err_name').text(name_length);  
        return false;
      }
      else{
        $("#err_name").text("");
      }
//name validation complite.
      if(short_name==null || short_name==""){
        $("#err_short_name").text(short_name_empty);
        return false;
      }
      else{
        $("#err_short_name").text("");
      }
      if (!short_name.match(name_regex) ) {
        $('#err_short_name').text(short_name_invalid);   
        return false;
      }
      else{
        $("#err_short_name").text("");
      }
      if (short_name.length < 2) {
        $('#err_short_name').text(short_name_length);  
        return false;
      }
      else{
        $("#err_short_name").text("");
      }
//site short name validation complite.
       if(country == "" || country == null){
        $('#err_country').text(country_select);
        return false;
      }
      else{
        $('#err_country').text("");
      }
//country validation copmlite.
 if(state == "" || state == null){
        $('#err_state').text(state_select);
        return false;
      }
      else{
        $('#err_state').text("");
      }
//state validation copmlite.
 if(city == "" || city == null){
        $('#err_city').text(city_select);
        return false;
      }
      else{
        $('#err_city').text("");
      }
//city validation copmlite.
if(street==null || street==""){
        $("#err_street").text(street_empty);
        return false;
      }
      else{
        $("#err_street").text("");
      }
      if (!street.match(name_regex) ) {
        $('#err_street').text(street_invalid);   
        return false;
      }
      else{
        $("#err_street").text("");
      }
      if (street.length < 3) {
        $('#err_street').text(street_length);  
        return false;
      }
      else{
        $("#err_street").text("");
      }
//stret validation complite.     
      if(email==null || email==""){
        $("#err_email").text(email_empty);
        return false;
      }
      else{
        $("#err_email").text("");
      }
      if (!email.match(email_regex) ) {
        $('#err_email').text(email_invalid);   
        return false;
      }
      else{
        $("#err_email").text("");
      }
      if (email.length < 2) {
        $('#err_email').text(email_length);  
        return false;
      }
      else{
        $("#err_email").text("");
      }
//email validation complite.
      if(mobile==null || mobile==""){
        $("#err_mobile").text(mobile_empty);
        return false;
      }
      else{
        $("#err_mobile").text("");
      }
      if (!mobile.match(mobile_regex) ) {
        $('#err_mobile').text(mobile_invalid);   
        return false;
      }
      else{
        $("#err_mobile").text("");
      }
      if (mobile.length != 10) {
        $('#err_mobile').text(mobile_length);  
        return false;
      }
      else{
        $("#err_mobile").text("");
      }
//mobile validation complite.
      
    });

    $("#name").on("blur keyup",  function (event){
      var name_regex = /^[-a-zA-Z\s]+$/;
      var name = $('#name').val();
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
      if (name.length < 3) {
        $('#err_name').text(name_length);  
        return false;
      }
      else{
        $("#err_name").text("");
      }
    });
    $("#short_name").on("blur keyup",  function (event){
      var name_regex = /^[-a-zA-Z\s]+$/;
      var short_name = $('#short_name').val();
      if(short_name==null || short_name==""){
        $("#err_short_name").text(short_name_empty);
        return false;
      }
      else{
        $("#err_short_name").text("");
      }
      if (!short_name.match(name_regex) ) {
        $('#err_short_name').text(short_name_invalid);   
        return false;
      }
      else{
        $("#err_short_name").text("");
      }
      if (short_name.length < 2) {
        $('#err_short_name').text(short_name_length);  
        return false;
      }
      else{
        $("#err_short_name").text("");
      }
    });
    $("#email").on("blur keyup",  function (event){
      var email_regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      var email = $('#email').val();
      if(email==null || email==""){
        $("#err_email").text(email_empty);
        return false;
      }
      else{
        $("#err_email").text("");
      }
      if (!email.match(email_regex) ) {
        $('#err_email').text(email_invalid);   
        return false;
      }
      else{
        $("#err_email").text("");
      }
    });
    $("#mobile").on("blur keyup",  function (event){
      var mobile_regex = /^[6-9][0-9]{9}$/; 
      var mobile = $('#mobile').val();
      if(mobile==null || mobile==""){
        $("#err_mobile").text(mobile_empty);
        return false;
      }
      else{
        $("#err_mobile").text("");
      }
      if (!mobile.match(mobile_regex) ) {
        $('#err_mobile').text(mobile_invalid);   
        return false;
      }
      else{
        $("#err_mobile").text("");
      }
      if (mobile.length != 10) {
        $('#err_mobile').text(mobile_length);  
        return false;
      }
      else{
        $("#err_mobile").text("");
      }
    });
    $("#street").on("blur keyup",  function (event){
       var name_regex = /^[-a-zA-Z\s]+$/;
      var street = $('#street').val();
      if(street==null || street==""){
        $("#err_street").text(street_empty);
        return false;
      }
      else{
        $("#err_street").text("");
      }
      if (!street.match(name_regex) ) {
        $('#err_street').text(street_invalid);   
        return false;
      }
      else{
        $("#err_street").text("");
      }
      if (street.length < 3) {
        $('#err_street').text(street_length);  
        return false;
      }
      else{
        $("#err_street").text("");
      }
    });
    $("#city").change(function(){
      var city = $('#city').val();
      if(city == "" || city == null){
        $('#err_city').text(city_select);
        return false;
      }
      else{
        $('#err_city').text("");
      }
    });
    $("#state").change(function(){
      var state = $('#state').val();
      if(state == "" || state == null){
        $('#err_state').text(state_select);
        return false;
      }
      else{
        $('#err_state').text("");
      }
    });
    $('#country').change(function(){
      var country = $('#country').val();
      if(country == "" || country == null){
        $('#err_country').text(country_select);
        return false;
      }
      else{
        $('#err_country').text("");
      }
    });
}); 
</script>
