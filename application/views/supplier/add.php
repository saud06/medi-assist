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
          <li><a href="<?php echo base_url('supplier'); ?>">
              <!-- Supplier -->
              <?php echo $this->lang->line('supplier_header'); ?>
          </a></li>
          <li class="active"><!-- Add Supplier -->
            <?php echo $this->lang->line('supplier_add'); ?>
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
              <h3 class="box-title"><!-- Add New Supplier -->
                <?php echo $this->lang->line('supplier_btn_add'); ?>

              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <form role="form" id="form" method="post" action="<?php echo base_url('supplier/addSupplier');?>">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="supplier_name"><!-- Supplier Name -->
                         <?php echo $this->lang->line('add_supplier_name'); ?>
                       <span class="validation-color">*</span>
                      </label>
                    <input type="text" class="form-control" id="supplier_name" name="supplier_name" value="<?php echo set_value('supplier_name'); ?>">
                    <span class="validation-color" id="err_supplier_name"><?php echo form_error('supplier_name'); ?></span>
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
                    <label for="vat_no">VAT No 
                        
                        <!-- <?php echo $this->lang->line('add_client_compname'); ?> -->
                        <span class="validation-color"></span>
                    </label>
                    <input type="text" class="form-control" id="vatno" name="vatno" value="<?php echo set_value('vatno'); ?>">
                    <span class="validation-color" id="err_vatno"><?php echo form_error('vatno'); ?></span>
                </div>

                <div class="form-group">
                    <label for="pan_no">PAN No 
                        
                        <!-- <?php echo $this->lang->line('add_client_compname'); ?> -->
                        <span class="validation-color"></span>
                    </label>
                    <input type="text" class="form-control" id="panno" name="panno" value="<?php echo set_value('panno'); ?>">
                    <span class="validation-color" id="err_panno"><?php echo form_error('panno'); ?></span>
                </div>

                <div class="form-group">
                    <label for="tan">Tan 
                        
                        <!-- <?php echo $this->lang->line('add_client_compname'); ?> -->
                        <span class="validation-color"></span>
                    </label>
                    <input type="text" class="form-control" id="tan" name="tan" value="<?php echo set_value('tan'); ?>">
                    <span class="validation-color" id="err_tan"><?php echo form_error('tan'); ?></span>
                </div>

                <div class="form-group">
                    <label for="cstregno">Cst reg no
                        
                        <!-- <?php echo $this->lang->line('add_client_compname'); ?> -->
                        <span class="validation-color"></span>
                    </label>
                    <input type="text" class="form-control" id="cstregno" name="cstregno" value="<?php echo set_value('cstregno'); ?>">
                    <span class="validation-color" id="err_cstregno"><?php echo form_error('cstregno'); ?></span>
                </div>

                <div class="form-group">
                    <label for="exciseregno">Excise reg no
                        
                        <!-- <?php echo $this->lang->line('add_client_compname'); ?> -->
                        <span class="validation-color"></span>
                    </label>
                    <input type="text" class="form-control" id="exciseregno" name="exciseregno" value="<?php echo set_value('exciseregno'); ?>">
                    <span class="validation-color" id="err_panno"><?php echo form_error('exciseregno'); ?></span>
                </div>

                <div class="form-group">
                    <label for="lbtregno">Lbt reg no
                        
                        <!-- <?php echo $this->lang->line('add_client_compname'); ?> -->
                        <span class="validation-color"></span>
                    </label>
                    <input type="text" class="form-control" id="lbtregno" name="lbtregno" value="<?php echo set_value('lbtregno'); ?>">
                    <span class="validation-color" id="err_lbtregno"><?php echo form_error('lbtregno'); ?></span>
                </div>

                <div class="form-group">
                    <label for="servicetaxno">Service tax reg no
                        
                        <!-- <?php echo $this->lang->line('add_client_compname'); ?> -->
                        <span class="validation-color"></span>
                    </label>
                    <input type="text" class="form-control" id="servicetaxno" name="servicetaxno" value="<?php echo set_value('servicetaxno'); ?>">
                    <span class="validation-color" id="err_servicetaxno"><?php echo form_error('servicetaxno'); ?></span>
                </div>
                <div class="form-group">
                      <label for="gstregtype">Gst Registration Type
                          <!-- <?php echo $this->lang->line('biller_lable_country'); ?> --> <span class="validation-color">*</span>
                        </label>
                      <select class="form-control select2" id="gstregtype" name="gstregtype" style="width: 100%;">
                        <option value="">
                          <!-- Select -->
                          <?php echo $this->lang->line('add_biller_select'); ?>    
                        </option>
                          <option>Registered</option>
                          <option>Unregistered</option>
                          <option>Composition Scheme</option>
                          <option>Input Service Distributor</option>
                          <option>E-Commerece Operator</option>
                      </select>
                  </div>
                
                </div>
                <div class="col-md-6">
                
                  <div class="form-group">
                    <label for="company_name"><!-- Company Name --> 
                        
                        <?php echo $this->lang->line('add_client_compname'); ?> 
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
                          <?php echo $this->lang->line('biller_lable_country'); ?> <span class="validation-color">*</span>
                      </label>
                      <select class="form-control select2" id="country" name="country" style="width: 100%;">
                        <option value="">
                            <!-- Select -->
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
                    <label for="postal_code"><!-- Postal Code -->
                        <?php echo $this->lang->line('add_client_code'); ?> 
                          <span class="validation-color">*</span>
                    </label>
                    <input type="text" class="form-control" id="postal_code" name="postal_code" value="<?php echo set_value('postal_code'); ?>">
                    <span class="validation-color" id="err_postal_code"><?php echo form_error('postal_code'); ?></span>
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
                    <button type="submit" id="submit" class="btn btn-info">&nbsp;&nbsp;&nbsp;
                      <!-- Add -->
                        <?php echo $this->lang->line('add_user_btn'); ?>&nbsp;&nbsp;&nbsp;</button>
                    <span class="btn btn-default" id="cancel" style="margin-left: 2%" onclick="cancel('supplier')"><!-- Cancel -->
                      <?php echo $this->lang->line('add_user_btn_cancel'); ?></span>
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
          url: "<?php echo base_url('supplier/getState') ?>/"+id,
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
          url: "<?php echo base_url('supplier/getCity') ?>/"+id,
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
      var sname_regex = /^[-a-zA-Z\s]+$/;
      var mobile_regex = /^[6-9][0-9]{9}$/; 
      var postal_regex = /^[1-9][0-9]{5}$/
      //indian mobile number  /^((\+){0,1}91(\s){0,1}(\-){0,1}(\s){0,1}){0,1}98(\s){0,1}(\-){0,1}(\s){0,1}[1-9]{1}[0-9]{7}$/
      var email_regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      var supplier_name = $('#supplier_name').val();
      var company_name = $('#company_name').val();
      var address = $('#address').val();
      var city = $('#city').val();
      var state = $('#state').val();
      var postal_code = $('#postal_code').val();
      var country = $('#country').val();
      var mobile = $('#mobile').val();
      var email = $('#email').val();



        if(supplier_name==null || supplier_name==""){
          $("#err_supplier_name").text("Please Enter Supplier Name");
          return false;
        }
        else{
          $("#err_supplier_name").text("");
        }
        if (!supplier_name.match(name_regex) ) {
          $('#err_supplier_name').text(" Please Enter Valid Supplier Name ");   
          return false;
        }
        else{
          $("#err_supplier_name").text("");
        }
//client name validation complite.

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
          $("#err_country").text("Please Select Country ");
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
          $("#err_city").text("Please Select City ");
          return false;
        }
        else{
          $("#err_city").text("");
        }
//city validation complite.

        if(postal_code==null || postal_code==""){
          $("#err_postal_code").text("Please Enter Postal Code.");
          return false;
        }
        else{
          $("#err_postal_code").text("");
        }
        if (!postal_code.match(postal_regex) ) {
          $('#err_postal_code').text(" Please Enter Valid Postal Code ");   
          return false;
        }
        else{
          $("#err_postal_code").text("");
        }
//postal code validation complite.
        
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

    $("#supplier_name").on("blur keyup",  function (event){
        var name_regex = /^[a-zA-Z\s]+$/;
        var supplier_name = $('#supplier_name').val();
        $('#supplier_name').val(supplier_name);
        if(supplier_name==null || supplier_name==""){
          $("#err_supplier_name").text("Please Enter Supplier Name");
          return false;
        }
        else{
          $("#err_supplier_name").text("");
        }
        if (!supplier_name.match(name_regex) ) {
          $('#err_supplier_name').text(" Please Enter Valid Supplier Name ");   
          return false;
        }
        else{
          $("#err_supplier_name").text("");
        }
    });
    $("#company_name").on("blur keyup",  function (event){
        var sname_regex = /^[-a-zA-Z\s]+$/;
        var company_name = $('#company_name').val();
        $('#company_name').val(company_name);
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
        $('#city').val(city);
        if(city==null || city==""){
          $("#err_city").text("Please Select City ");
          return false;
        }
        else{
          $("#err_city").text("");
        }
    });
    $("#state").change(function(event){
        var state = $('#state').val();
        $('#state').val(state);
        if(state==null || state==""){
          $("#err_state").text("Please Select State ");
          return false;
        }
        else{
          $("#err_state").text("");
        }
    });
    $("#postal_code").on("blur keyup",  function (event){
        var postal_regex = /^[1-9][0-9]{5}$/
        var postal_code = $('#postal_code').val();
        $('#postal_code').val(postal_code);
        if(postal_code==null || postal_code==""){
          $("#err_postal_code").text("Please Enter Postal Code.");
          return false;
        }
        else{
          $("#err_postal_code").text("");
        }
        if (!postal_code.match(postal_regex) ) {
          $('#err_postal_code').text(" Please Enter Valid Postal Code ");   
          return false;
        }
        else{
          $("#err_postal_code").text("");
        }
    });
    $("#country").change(function(event){
        var country = $('#country').val();
        $('#country').val(country);
        if(country==null || country==""){
          $("#err_country").text("Please Select Country");
          return false;
        }
        else{
          $("#err_country").text("");
        }
    });
    $("#mobile").on("blur keyup",  function (event){
        var mobile_regex = /^[6-9][0-9]{9}$/;
        var mobile = $('#mobile').val();
        $('#mobile').val(mobile);
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
        $('#email').val(email);
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