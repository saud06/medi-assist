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
    <?php 
      // $this->load->view('layout/sticky_note');
    ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('auth/dashboard'); ?>" class="text-black"><i class="fa fa-dashboard">&nbsp;</i><strong><?php echo $this->lang->line('header_dashboard'); ?></strong></a></li>
          <li><a href="<?php echo base_url('client'); ?>" class="text-black">
              <!-- Client -->
              <strong><?php echo $this->lang->line('client_header'); ?></strong></a>
          </li>
          <li class="active"><!-- Add Client -->
              <?php echo $this->lang->line('add_client_label'); ?>
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
                <!-- Add New Client -->
                <?php echo $this->lang->line('add_client_header'); ?>
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <form role="form" id="form" method="post" action="<?php echo base_url('client/addClient');?>">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="client_name">
                          <!-- Company Name --> 
                          Company Name
                          <span class="validation-color">*</span>
                      </label>
                      <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo set_value('company_name'); ?>">
                      <span class="validation-color" id="err_company_name"><?php echo form_error('company_name'); ?></span>
                    </div>

                    <div class="form-group">
                      <label for="company_phone"><!-- Company Phone --> 
                          Phone
                      </label>
                      <input type="text" class="form-control" id="company_phone" name="company_phone">
                    </div>

                    <div class="form-group">
                      <label for="contact_person">
                          <!-- Contact Person --> 
                          Contact Person
                          <!-- <span class="validation-color">*</span> -->
                      </label>
                      <input type="text" class="form-control" id="contact_person" name="contact_person" value="">
                      <!-- <span class="validation-color" id="err_contact_person"><?php echo form_error('contact_person'); ?></span> -->
                    </div>

                    <div class="form-group">
                      <label for="contact_person_phone"><!-- Contact Person Phone --> 
                          Phone
                          <!-- <span class="validation-color">*</span> -->
                      </label>
                      <input type="text" class="form-control" id="contact_person_phone" name="contact_person_phone" value="">
                      <!-- <span class="validation-color" id="err_contact_person_phone"><?php echo form_error('contact_person_phone'); ?></span> -->
                    </div>

                    <div class="form-group">
                      <label for="email"><!-- email --> 
                        <?php echo $this->lang->line('biller_lable_email'); ?> 
                            <!-- <span class="validation-color">*</span> -->
                      </label>
                      <input type="text" class="form-control" id="email" name="email" value="">
                      <!-- <span class="validation-color" id="err_email"><?php echo form_error('email'); ?></span> -->
                    </div>

                    <div class="form-group">
                      <label for="cc"><!-- cc --> 
                        Cc
                      </label>
                      <input type="text" class="form-control" id="cc" name="cc" data-toggle="tooltip" title="For multiple Cc, separate them by comma (,)">
                    </div>

                    <div class="form-group">
                      <label for="bcc"><!-- bcc --> 
                        Bcc
                      </label>
                      <input type="text" class="form-control" id="bcc" name="bcc" data-toggle="tooltip" title="For multiple Bcc, separate them by comma (,)">
                    </div>

                    <div class="form-group">
                      <label for="client_type"><!-- Client Type --> 
                        Client Type <span class="validation-color">*</span>
                      </label>
                      <select class="form-control select2" id="client_type" name="client_type" style="width: 100%;">
                        <option value="">Select Client Type</option>
                        <?php
                          foreach ($client_type as  $key) {
                        ?>
                            <option value='<?php echo $key->client_type_id ?>'><?php echo $key->name; ?></option>
                        <?php
                          }
                        ?>
                      </select>
                      <span class="validation-color" id="err_client_type"><?php echo form_error('client_type'); ?></span>
                    </div>

                    <div class="form-group">
                      <label for="client_cat"><!-- Client Category --> 
                        Client Category <span class="validation-color">*</span>
                      </label>
                      <select class="form-control select2" id="client_cat" name="client_cat[]" style="width: 100%" multiple>
                        <?php
                          foreach ($client_cat as  $key) {
                        ?>
                            <option value='<?php echo $key->category_id ?>'>
                              <?php echo $key->category_name; ?>
                            </option>
                        <?php
                          }
                        ?>
                      </select>
                      <span class="validation-color" id="err_client_cat"><?php echo form_error('client_cat'); ?></span>
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="country"><!-- Country --> 
                          Country <span class="validation-color">*</span>
                        </label>
                      <select class="form-control select2" id="country" name="country" style="width: 100%;">
                        <option value="">Select Country</option>
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

                    <div class="form-group state">
                      <label for="state"><!-- State --> 
                          State
                          <!-- <span class="validation-color">*</span> -->
                      </label>
                      <select class="form-control select2" id="state" name="state" style="width: 100%;">
                        <option value="">Select State</option>
                      </select>
                      <!-- <span class="validation-color" id="err_state"><?php echo form_error('state'); ?></span> -->
                    </div>

                    <div class="form-group city">
                      <label for="city"><!-- City --> 
                          City 
                          <!-- <span class="validation-color">*</span> -->
                      </label>
                      <select class="form-control select2" id="city" name="city" style="width: 100%;">
                        <option value="">Select City</option>
                      </select>
                      <!-- <span class="validation-color" id="err_city"><?php echo form_error('city'); ?></span> -->
                    </div>

                    <div class="form-group city-area" style="display: none;">
                      <div class="row">
                        <div class="col-md-6">
                          <label for="loc_city"><!-- Local City --> 
                              <?php echo $this->lang->line('biller_lable_city'); ?> 
                              <!-- <span class="validation-color">*</span> -->
                          </label>
                          <input class="form-control" id="loc_city" name="loc_city" value="">
                          <!-- <span class="validation-color" id="err_loc_city"><?php echo form_error('loc_city'); ?></span> -->
                        </div>

                        <div class="col-md-6">
                          <label for="loc_area"><!-- Local Area --> 
                              Area
                          </label>
                          <input class="form-control" id="loc_area" name="loc_area" value="">
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-4">
                          <label for="road_no"><!-- Road No --> 
                              Road
                          </label>
                          <input class="form-control" id="road_no" name="road_no">
                        </div>
                        <div class="col-md-4">
                          <label for="house_no"><!-- House No --> 
                              House
                          </label>
                          <input class="form-control" id="house_no" name="house_no">
                        </div>
                        <div class="col-md-4">
                          <label for="zip_code">
                              Zip Code
                          </label>
                          <input type="text" class="form-control" id="zip_code" name="zip_code">
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="factory_address"><!-- Factory Address --> 
                          Factory Address
                      </label>
                      <input class="form-control" id="factory_address" name="factory_address">
                    </div>

                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-6">
                          <label for="skype"><!-- Skype --> 
                              Skype
                          </label>
                          <input class="form-control" id="skype" name="skype">
                        </div>
                        <div class="col-md-6">
                          <label for="qq"><!-- QQ --> 
                              QQ
                          </label>
                          <input class="form-control" id="qq" name="qq">
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-6">
                          <label for="whatsapp"><!-- Whats App --> 
                              Whats App
                          </label>
                          <input class="form-control" id="whatsapp" name="whatsapp">
                        </div>
                        <div class="col-md-6">
                          <label for="wechat"><!-- We Chat --> 
                              We Chat
                          </label>
                          <input class="form-control" id="wechat" name="wechat">
                        </div>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="responsible_person"><!-- Responsible Person --> 
                        Responsible Person <span class="validation-color">*</span>
                      </label>
                      <select class="form-control select2" id="responsible_person" name="responsible_person[]" style="width: 100%" multiple>
                        <?php
                          foreach ($user as  $key) {
                        ?>
                            <option value='<?php echo $key->id ?>'>
                              <?php echo $key->first_name . ' ' . $key->last_name; ?>
                            </option>
                        <?php
                          }
                        ?>
                      </select>
                      <span class="validation-color" id="err_responsible_person"><?php echo form_error('responsible_person'); ?></span>
                    </div>

                    <div class="form-group">
                      <label for="client_status"><!-- Client Status -->Client Status <span class="validation-color">*</span></label><br>
                      <?php echo lang('category_status_y_label', 'confirm');?>
                      <input type="radio" name="confirm" value="Active" checked="checked" class="minimal"/>&nbsp;&nbsp;
                      <?php echo lang('category_status_n_label', 'confirm');?>
                      <input type="radio" name="confirm" value="Inactive" class="minimal"/>
                    </div>
                  </div>

                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Kind Attention(s)</label>&nbsp;&nbsp; 
                      <button style="float: right;" id="add-kind-attention" type="button" title="Add More" class="btn bg-gray"><i class="fa fa-plus" aria-hidden="true"></i></button><br><br>
                      <div style="overflow-y: auto;">
                        <table class="table items table-striped table-bordered table-condensed table-hover kind_attention_table">
                          <thead>
                            <tr>
                              <th width="5%"><img src="<?php  echo base_url(); ?>assets/images/bin1.png" /></th>
                              <th class="span2">Name</th>
                              <th class="span2">Designation</th>
                            </tr>
                          </thead>
                          <tbody class="kind_attention_body">
                            <tr class="kind_attention">
                              <td><a class='deleteRow'></a></td>
                              <td><input type="text" class="form-control" name="kind_name[]" id="kind_name"></td>
                              <td><input type="text" class="form-control" name="kind_designation[]" id="kind_designation"></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>

                  <div class="col-sm-12">
                    <div class="box-footer">
                      <button type="submit" id="submit" class="button btn bg-gray">
                        <span class="submit" style="left: 32%">Add</span>
                        <span class="loading" style="left: 32%"><i class="fa fa-circle-o-notch"></i></span>
                      </button>
                      <span class="btn btn-danger" id="cancel" style="margin-left: 2%" onclick="cancel('client')"><!-- Cancel -->
                        <?php echo $this->lang->line('add_user_btn_cancel'); ?></span>
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
      if(id == 18){
        $('.state').hide();
        $('.city').hide();
        $('.city-area').show();
        $('#zip_code').val('');
      }
      else{
        $('.state').show();
        $('.city').show();
        $('.city-area').hide();
        $('#state').html('<option value="">Select State</option>');
        $('#zip_code').val('');
        $('#city').html('<option value="">Select City</option>');
        $.ajax({
          url: "<?php echo base_url('client/getState') ?>/"+id,
          type: "GET",
          dataType: "JSON",
          success: function(data){
            for(i=0;i<data.length;i++){
              $('#state').append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
            }
          }
        });
      }
    });
</script>
<script>
    $('#state').change(function(){
      var id = $(this).val();
      var country = $('#country').val();
      $('#city').html('<option value="">Select City</option>');
      $('#zip_code').val('');
      $.ajax({
          url: "<?php echo base_url('client/getCity') ?>/"+id,
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
            $('#zip_code').val(data);
          }
        });
    });
</script>
<script>
  $(function () {
    $("#add-kind-attention").click(function () {
      $(".kind_attention_body").append('<tr class="kind_attention"><td><a class="ibtnDel"> <img src="<?php echo base_url(); ?>assets/images/bin3.png"/></a></td><td><input type="text" class="form-control" name="kind_name[]" id="kind_name"></td><td><input type="text" class="form-control" name="kind_designation[]" id="kind_designation"></td></tr>')
    });

    $("table.kind_attention_table").on("click", ".ibtnDel", function (event) {
        $(this).closest("tr").remove();
    });
  });
</script>
<script type="text/javascript">
    $(document).ready(function() {
      $('.deleteRow').click(DeleteRow);
    });

    function DeleteRow()
    {
      $('tr').click(function()
      {
        $(this).remove();
      });
    }
</script>
<script>
  $(document).ready(function(){
    $('#form').submit(function(){
      var name_regex = /^[a-z0-9\040\.\-\,\/]+$/i;
      var phone_regex = /^[0-9]+$/;
      var email_regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      var company_name = $('#company_name').val();
      var contact_person = $('#contact_person').val();
      var city = $('#city').val();
      var loc_city = $('#loc_city').val();
      var state = $('#state').val();
      var zip_code = $('#zip_code').val();
      var country = $('#country').val();
      var company_phone = $('#company_phone').val();
      var contact_person_phone = $('#contact_person_phone').val();
      var email = $('#email').val();
      var client_type = $('#client_type').val();
      var client_cat = $('#client_cat').val();
      var responsible_person = $('#responsible_person').val();

      if(company_name==null || company_name==""){
        $("#err_company_name").text("Please Enter Company Name.");
        return false;
      }
      else{
        $("#err_company_name").text("");
      }
      if (!company_name.match(name_regex) ) {
        $('#err_company_name').text(" Please Enter Valid Company Name ");   
        return false;
      }
      else{
        $("#err_company_name").text("");
      }
      //company name validation complite.
      
      /*if (company_phone && !company_phone.match(phone_regex) ) {
        $('#err_company_phone').text(" Please Enter Valid Phone Number.");   
        return false;
      }
      else{
        $("#err_company_phone").text("");
      }*/
      //company phone validation complite.

      /*if(contact_person==null || contact_person==""){
        $("#err_contact_person").text("Please Enter Contact Person.");
        return false;
      }
      else{
        $("#err_contact_person").text("");
      }
      if (!contact_person.match(name_regex) ) {
        $('#err_contact_person').text(" Please Enter Valid Contact Person.");   
        return false;
      }
      else{
        $("#err_contact_person").text("");
      }*/
      //responsible person validation complite.

      /*if(contact_person_phone==null || contact_person_phone==""){
        $("#err_contact_person_phone").text("Please Enter Contact Person Phone.");
        return false;
      }
      else{
        $("#err_contact_person_phone").text("");
      }
      if (!contact_person_phone.match(phone_regex) ) {
        $('#err_contact_person_phone').text(" Please Enter Valid Contact Person Phone.");   
        return false;
      }
      else{
        $("#err_contact_person_phone").text("");
      }*/
      //responsible person phone validation complite.
      
      /*if(email==null || email==""){
        $("#err_email").text("Please Enter Email.");
        return false;
      }
      else{
        $("#err_email").text("");
      }
      if (!email.match(email_regex) ) {
        $('#err_email').text(" Please Enter Valid Email Address.");   
        return false;
      }
      else{
        $("#err_email").text("");
      }*/
      //email validation complite.

      if(client_type==null || client_type==""){
        $("#err_client_type").text("Please Select Client Type.");
        return false;
      }
      else{
        $("#err_client_type").text("");
      }
      //client_type validation complite.

      if(client_cat==null || client_cat==""){
        $("#err_client_cat").text("Please Select Client Category.");
        return false;
      }
      else{
        $("#err_client_cat").text("");
      }
      //client_cat validation complite.
      
      if(country==null || country==""){
        $("#err_country").text("Please Select Country.");
        return false;
      }
      else{
        $("#err_country").text("");
      }
      //country validation complite.
    
      /*if(country == 18){
        if(loc_city==null || loc_city==""){
          $("#err_loc_city").text("Please Enter City.");
          return false;
        }
        else{
          $("#err_loc_city").text("");
        }
        //city validation complite.
      }
      else{
        if(state==null || state==""){
          $("#err_state").text("Please Select State.");
          return false;
        }
        else{
          $("#err_state").text("");
        }
        //state validation complite.
        
        if(city==null || city==""){
          $("#err_city").text("Please Select City.");
          return false;
        }
        else{
          $("#err_city").text("");
        }
        //city validation complite.
      }*/

      if(responsible_person==null || responsible_person==""){
        $("#err_responsible_person").text("Please Select Responsible Person.");
        return false;
      }
      else{
        $("#err_responsible_person").text("");
      }
      //responsible person validation complite.

      $(this).find(':button[type=submit]').prop('disabled', true);
      $('.button').css('cursor', 'default');
      $('.button').toggleClass('active');
    });

    $("#company_name").on("blur keyup",  function (event){
        var name_regex = /^[a-z0-9\040\.\-\,\/]+$/i;
        var company_name = $('#company_name').val();
        if(company_name==null || company_name==""){
          $("#err_company_name").text("Please Enter Company Name.");
          return false;
        }
        else{
          $("#err_company_name").text("");
        }
        if (!company_name.match(name_regex) ) {
          $('#err_company_name').text(" Please Enter Valid Company Name.");   
          return false;
        }
        else{
          $("#err_company_name").text("");
        }
    });
    /*$("#company_phone").on("blur keyup",  function (event){
        var mobile_regex = /^[0-9]+$/;
        var company_phone = $('#company_phone').val();
        $('#company_phone').val(company_phone);
        
        if (company_phone && !company_phone.match(mobile_regex)) {
          $('#err_company_phone').text("Please Enter Valid Phone.");   
          return false;
        }
        else{
          $("#err_company_phone").text("");
        }
    });*/
    /*$("#contact_person").on("blur keyup",  function (event){
        var name_regex = /^[a-z0-9\040\.\-\,\/]+$/i;
        var contact_person = $('#contact_person').val();
        if(contact_person==null || contact_person==""){
          $("#err_contact_person").text("Please Enter Contact Person.");
          return false;
        }
        else{
          $("#err_contact_person").text("");
        }
        if (!contact_person.match(name_regex) ) {
          $('#err_contact_person').text(" Please Enter Valid Contact Person.");   
          return false;
        }
        else{
          $("#err_contact_person").text("");
        }
    });*/
    /*$("#contact_person_phone").on("blur keyup",  function (event){
        var mobile_regex = /^[0-9]+$/;
        var contact_person_phone = $('#contact_person_phone').val();
        $('#contact_person_phone').val(contact_person_phone);
        if(contact_person_phone==null || contact_person_phone==""){
          $("#err_contact_person_phone").text("Please Enter Contact Person Phone.");
          return false;
        }
        else{
          $("#err_contact_person_phone").text("");
        }
        if (!contact_person_phone.match(mobile_regex)) {
          $('#err_contact_person_phone').text("Please Enter Valid Contact Person Phone.");   
          return false;
        }
        else{
          $("#err_contact_person_phone").text("");
        }
    });*/
    /*$("#email").on("blur keyup",  function (event){
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
    });*/
    $("#client_type").change(function(event){
        var client_type = $('#client_type').val();
        $('#client_type').val(client_type);
        if(client_type==null || client_type==""){
          $("#err_client_type").text("Please Select Client Type");
          return false;
        }
        else{
          $("#err_client_type").text("");
        }
    });
    $("#client_cat").change(function(event){
        var client_cat = $('#client_cat').val();
        $('#client_cat').val(client_cat);
        if(client_cat==null || client_cat==""){
          $("#err_client_cat").text("Please Select Client Category");
          return false;
        }
        else{
          $("#err_client_cat").text("");
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
    /*$("#state").change(function(event){
        var state = $('#state').val();
        $('#state').val(state);
        if(state==null || state==""){
          $("#err_state").text("Please Select State ");
          return false;
        }
        else{
          $("#err_state").text("");
        }
    });*/
    /*$("#city").change(function(event){
        var city = $('#city').val();
        $('#city').val(city);
        if(city==null || city==""){
          $("#err_city").text("Please Select City ");
          return false;
        }
        else{
          $("#err_city").text("");
        }
    });*/
    $("#responsible_person").change(function(event){
        var responsible_person = $('#responsible_person').val();
        $('#responsible_person').val(responsible_person);
        if(responsible_person==null || responsible_person==""){
          $("#err_responsible_person").text("Please Select Responsible Person");
          return false;
        }
        else{
          $("#err_responsible_person").text("");
        }
    });
  }); 
</script>