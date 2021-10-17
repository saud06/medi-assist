<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin');
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
          <li><a href="<?php echo base_url('auth'); ?>" class="text-black">
              <!-- User -->
              <strong><?php echo $this->lang->line('user_lable');?></strong>
            </a>
          </li>
          <li class="active">
              <!-- Add User -->
              <?php
                if(isset($data['first_name'])){
                  echo 'Promote User';
                }
                else{
                  echo $this->lang->line('add_user_header');
                }
              ?>
          </li>
        </ol>
      </h5>    
    </section>
<!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- right column -->
        <div class="col-sm-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">
                <!-- Add New User -->
                <?php
                  if(isset($data['first_name'])){
                    echo 'Promote ' . $data['first_name'] . ' ' . $data['last_name'] . ' As User';
                  }
                  else{
                    echo $this->lang->line('add_user_label');
                  }
                ?>
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <form role="form" id="form" method="post" action="<?php echo base_url('auth/create_user');?>">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="user_id">
                        <!-- User ID --> 
                        User ID
                      </label>
                      <?php 
                        if(isset($emp_id)){
                          echo form_input($emp_id,'','class="form-control" readonly');
                        }
                        else{
                          echo form_input(array('name' => 'emp_id', 'id' => 'emp_id', 'class' => 'form-control', 'type' => 'text', 'readonly' => 'true', 'value' => $data['emp_id']));
                        }
                      ?>
                    </div>

                    <div class="form-group">
                      <label for="firstname">
                        <!-- First Name --> 
                           <?php echo $this->lang->line('user_lable_fname');?>
                          <span class="validation-color">*</span>
                      </label>
                      <?php 
                        if(isset($first_name)){
                          echo form_input($first_name,'','class="form-control"');
                        }
                        else{
                          echo form_input(array('name' => 'first_name', 'id' => 'first_name', 'class' => 'form-control', 'type' => 'text', 'value' => $data['first_name']));
                        }
                      ?>
                      <span class="validation-color" id="err_firstname"><?php echo form_error('firstname'); ?></span>
                    </div>

                    <div class="form-group">
                      <label for="lastname">
                          <!-- Last Name --> 
                           <?php echo $this->lang->line('user_lable_lname');?>
                          <span class="validation-color">*</span>
                      </label>
                      <?php 
                        if(isset($last_name)){
                          echo form_input($last_name,'','class="form-control"');
                        }
                        else{
                          echo form_input(array('name' => 'last_name', 'id' => 'last_name', 'class' => 'form-control', 'type' => 'text', 'value' => $data['last_name']));
                        }
                      ?>
                      <span class="validation-color" id="err_lastname"><?php echo form_error('lastname'); ?></span>
                    </div>

                    <div class="form-group">
                      <label for="email">
                            <!-- Email --> 
                           <?php echo $this->lang->line('user_lable_email');?>
                          <span class="validation-color">*</span>
                      </label>
                      <?php 
                        if(isset($email)){
                          echo form_input($email,'','class="form-control"');
                        }
                        else{
                          echo form_input(array('name' => 'email', 'id' => 'email', 'class' => 'form-control', 'type' => 'text', 'value' => $data['email']));
                        }
                      ?>
                      <span class="validation-color" id="err_email"><?php echo form_error('email'); ?></span>
                    </div>

                    <div class="form-group">
                      <label for="address">
                            <!-- Address --> 
                           Address
                      </label>
                      <?php 
                        if(isset($address)){
                          echo form_input($address,'','class="form-control"');
                        }
                        else{
                          echo form_input(array('name' => 'address', 'id' => 'address', 'class' => 'form-control', 'type' => 'text', 'value' => $data['address']));
                        }
                      ?>
                    </div>
                  </div>

                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="phone">
                            <!-- Phone -->
                           Phone
                           <span class="validation-color">*</span>
                      </label>
                      <?php 
                        if(isset($phone)){
                          echo form_input($phone,'','class="form-control"');
                        }
                        else{
                          echo form_input(array('name' => 'phone', 'id' => 'phone', 'class' => 'form-control', 'type' => 'text', 'value' => $data['phone']));
                        }
                      ?>
                      <span class="validation-color" id="err_phone"><?php echo form_error('phone'); ?></span>
                    </div>
                    
                    <div class="form-group">
                      <label for="join_desg">
                              <!-- Designation -->
                             Designation
                             <span class="validation-color">*</span>
                      </label>
                      <?php 
                        if(isset($join_desg)){
                          echo form_input($join_desg,'','class="form-control"');
                        }
                        else{
                          echo form_input(array('name' => 'join_desg', 'id' => 'join_desg', 'class' => 'form-control', 'type' => 'text', 'value' => $data['join_desg']));
                        }
                      ?>
                      <span class="validation-color" id="err_phone"><?php echo form_error('join_desg'); ?></span>
                    </div>

                    <div class="form-group">
                      <label for="password">
                            <!-- Password -->
                           <?php echo $this->lang->line('add_user_password');?>
                           <span class="validation-color">*</span>
                      </label>
                      <?php 
                        if(isset($password)){
                          echo form_input($password,'','class="form-control"');
                        }
                        else{
                          echo form_input(array('name' => 'password', 'id' => 'password', 'class' => 'form-control', 'type' => 'password', 'value' => $this->form_validation->set_value('password')));
                        }
                      ?>
                      <span class="validation-color" id="err_password"><?php echo form_error('password'); ?></span>
                    </div>

                    <div class="form-group">
                      <label for="password_confirm">
                          <!-- Confirm Password -->
                         <?php echo $this->lang->line('add_user_confpassword');?>
                          <span class="validation-color">*</span>
                      </label>
                      <?php 
                        if(isset($password_confirm)){
                          echo form_input($password_confirm,'','class="form-control"');
                        }
                        else{
                          echo form_input(array('name' => 'password_confirm', 'id' => 'password_confirm', 'class' => 'form-control', 'type' => 'password', 'value' => $this->form_validation->set_value('password_confirm')));
                        }
                      ?>
                      <span class="validation-color" id="err_c_password"><?php echo form_error('password_confirm'); ?></span>
                    </div>
                    
                    <div class="form-group">
                      <label for="user_cat">
                        User Category <span class="validation-color">*</span>
                      </label>
                      
                      <select class="form-control select2" id="user_cat" name="user_cat[]" style="width: 100%" multiple>
                        <?php
                          foreach ($user_cat as  $key) {
                        ?>
                            <option value='<?php echo $key->category_id ?>'>
                              <?php echo $key->category_name; ?>
                            </option>
                        <?php
                          }
                        ?>
                      </select>
                      <span class="validation-color" id="err_user_cat"><?php echo form_error('user_cat'); ?></span>
                    </div>

                    <div class="form-group">
                      <label for="user_status"> User Status <span class="validation-color">*</span></label><br>
                      <?php echo lang('category_status_y_label', 'confirm');?>
                      <input type="radio" name="confirm" value="1" checked="checked" class="minimal"/>&nbsp;&nbsp;
                      <?php echo lang('category_status_n_label', 'confirm');?>
                      <input type="radio" name="confirm" value="0" class="minimal"/>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <div class="box-footer">
                      <button type="submit" id="submit" class="btn bg-gray">&nbsp;&nbsp;&nbsp;<!-- Add -->
                          <?php 
                            if(isset($data['first_name'])){
                              echo 'Promote';
                            }
                            else{
                              echo $this->lang->line('add_user_btn');
                            }
                          ?>
                      &nbsp;&nbsp;&nbsp;</button>
                      <span class="btn btn-danger" id="cancel" style="margin-left: 2%" onclick="<?php if(isset($data['first_name'])){ ?> cancel('employee') <?php } else{?> cancel('auth') <?php }?>"><!-- Cancel -->
                        <?php echo $this->lang->line('add_user_btn_cancel');?>
                      </span>
                    </div>
                  </div>
                </form>
              </div>
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
  $(document).ready(function(){
    $("#submit").click(function(event){
      var name_regex = /^[a-z0-9\040\.\-\,\/]+$/i;
      var mobile_regex = /^[0-9]+$/;
      var email_regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      var firstname = $('#first_name').val();
      var lastname = $('#last_name').val();
      var phone = $('#phone').val();
      var email = $('#email').val();
      var password = $('#password').val();
      var c_password = $('#password_confirm').val();
      var user_cat = $('#user_cat').val();

        if(firstname==null || firstname==""){
          $("#err_firstname").text("Please Enter First Name.");
          return false;
        }
        else{
          $("#err_firstname").text("");
        }
//first name validation complite.

        if(lastname==null || lastname==""){
          $("#err_lastname").text("Please Enter Last Name.");
          return false;
        }
        else{
          $("#err_lastname").text("");
        }
//last name validation complite.

        if(email==null || email==""){
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
        }
//email validation complite

        if(phone==null || phone==""){
          $("#err_phone").text("Please Enter the Phone Number.");
          return false;
        }
        else{
          $("#err_phone").text("");
        }
        if (!phone.match(mobile_regex) ) {
          $('#err_phone').text(" Please Enter Valid Phone Number.");   
          return false;
        }
        else{
          $("#err_phone").text("");
        }
//phone validation complite

        if(password==null || password==""){
          $("#err_password").text("Please Enter Password.");
          return false;
        }
        else{
          $("#err_password").text("");
        }
        if(password.length < 8 || password.length > 20){
          $("#err_password").text("Please Enter Password 8 to 20 character long.");
          return false;
        }
        else{
          $("#err_password").text("");
        }

//password validation complite
        
        if(c_password==null || c_password==""){
          $("#err_c_password").text("Please Enter Confirm Password.");
          return false;
        }
        else{
          $("#err_c_password").text("");
        }
        if(password != c_password){
          $("#err_c_password").text("Password and Confirm Password does not match.");
           return false;
        }
        else{
          $("#err_c_password").text("");
        }
        
//confirm passowrd complite

        if(user_cat==null || user_cat==""){
          $("#err_user_cat").text("Please Enter user Category.");
          return false;
        }
        else{
          $("#err_user_cat").text("");
        }
//user category validation complite.
    });

    $("#first_name").on("blur keyup",  function (event){
        var name_regex = /^[a-z0-9\040\.\-\,\/]+$/i;
        var firstname = $('#first_name').val();
        if(firstname==null || firstname==""){
          $("#err_firstname").text(" Please Enter First Name.");
          $("#first_name").focus();
          return false;
        }
        else{
          $("#err_firstname").text("");
        }
        //event.preventDefault();
    });
    $("#last_name").on("blur keyup",  function (event){
        var name_regex = /^[a-z0-9\040\.\-\,\/]+$/i;
        var lastname = $('#last_name').val();
        if(lastname==null || lastname==""){
          $("#err_lastname").text(" Please Enter Last Name.");
          $("#last_name").focus();
          return false;
        }
        else{
          $("#err_lastname").text("");
        }
        //event.preventDefault();
    });

    $("#phone").on("blur keyup",  function (event){
        var mobile_regex = /^[0-9]+$/;
        var phone = $('#phone').val();
        if(phone==null || phone==""){
          $("#err_phone").text("Please Enter the Phone Number.");
          return false;
        }
        else{
          $("#err_phone").text("");
        }
        if (!phone.match(mobile_regex)) {
          $('#err_phone').text(" Please Enter Valid Phone Number.");   
          return false;
        }
        else{
          $("#err_phone").text("");
        }
    });
    
    $("#email").on("blur keyup",  function (event){
        var email_regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        var email = $('#email').val();
        if(email==null || email==""){
          $("#err_email").text("Please Enter Email.");
          $("#email").focus();
          return false;
        }
        else{
          $("#err_email").text("");
        }
        if (!email.match(email_regex) ) {
          $('#err_email').text(" Please Enter Valid Email Address.");  
          $("#email").focus();
          return false;
        }
        else{
          $("#err_email").text("");
        }
        //event.preventDefault();
    });
    $("#password").on("blur keyup",  function (event){
        var password = $('#password').val();
        if(password==null || password==""){
          $("#err_password").text(" Please Enter Password.");
          $("#password").focus();
          return false;
        }
        else{
          $("#err_password").text("");
        }
        if(password.length < 8 || password.length > 20){
          $("#err_password").text("Please Enter Password 8 to 20 character long.");
          $("#password").focus();
          return false;
        }
        else{
          $("#err_password").text("");
        }
    });
    $("#password_confirm").on("blur keyup",  function (event){
        var c_password = $('#password_confirm').val();
        var password = $('#password').val();
        if(c_password==null || c_password==""){
          $("#err_c_password").text("Please Enter Confirm Password.");
          $("#password_confirm").focus();
          return false;
        }
        else{
          $("#err_c_password").text("");
        }
        if(password != c_password){
          $("#err_c_password").text("Password and Confirm Password does not match.");
          $("#password_confirm").focus();
          return false;
        }
        else{
          $("#err_c_password").text("");
        }
    });
    $("#user_cat").on("blur keyup",  function (event){
        var user_cat = $('#user_cat').val();
        if(user_cat==null || user_cat==""){
          $("#err_user_cat").text(" Please Enter User Category.");
          $("#user_cat").focus();
          return false;
        }
        else{
          $("#err_user_cat").text("");
        }
        //event.preventDefault();
    });
}); 
</script>