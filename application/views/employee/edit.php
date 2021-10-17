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
          <li><a href="<?php echo base_url('employee'); ?>" class="text-black">
              <!-- Employee -->
              <strong>Employee</strong>
            </a>
        </li>
          <li class="active"><!-- Edit Employee -->
            Edit Employee
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
                <!-- Edit Employee -->
                Edit Employee
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <form role="form" id="form" method="post" action="<?php echo base_url('employee/editEmployee');?>" encType="multipart/form-data">
                <?php foreach($data as $row){?>
                <div class="col-md-12">
                  <ul class="timeline timeline-inverse">
                    <li class="time-label">
                      <span class="bg-gray">
                        &emsp;&emsp; Personal Information &emsp;&emsp;
                      </span>
                    </li>

                    <li>
                      <div class="timeline-item">
                        <div class="timeline-body">
                          <div class="row">
                            <div class="col-md-6">
                              <input type="hidden" name="id" id="id" value="<?php echo $row->id; ?>">

                              <div class="form-group">
                                <label for="emp_id">Employee ID</label>
                                <input type="text" class="form-control" id="emp_id" name="emp_id" value="<?php echo $row->employee_id;?>" readonly>
                              </div>

                              <div class="form-group">
                                <label for="nid_number">
                                  <!-- NID Number --> 
                                  NID Number
                                  <span class="validation-color">*</span>
                                </label>
                                <input type="text" class="form-control" id="nid_number" name="nid_number" value="<?php echo $row->nid_number;?>">
                                <span class="validation-color" id="err_nid_number"><?php echo form_error('nid_number'); ?></span>
                              </div>

                              <div class="form-group">
                                <label for="dob">
                                  <!-- Date of Birth --> 
                                  Date of Birth
                                </label>
                                <input type="text" class="form-control datepicker" id="dob" name="dob" value="<?php if($row->dob != '0000-00-00') echo $row->dob;?>">
                              </div>

                              <div class="form-group">
                                <div class="row">
                                  <div class="col-md-6">
                                    <label for="first_name">
                                      <!-- Name --> 
                                      First Name
                                      <span class="validation-color">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $row->first_name;?>">
                                    <span class="validation-color" id="err_first_name"><?php echo form_error('first_name'); ?></span>
                                  </div>

                                  <div class="col-md-6">
                                    <label for="last_name">
                                      <!-- Name --> 
                                      Last Name
                                      <span class="validation-color">*</span>
                                    </label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $row->last_name;?>">
                                    <span class="validation-color" id="err_last_name"><?php echo form_error('last_name'); ?></span>
                                  </div>
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="nick_name">
                                  <!-- Nick Name --> 
                                  Nick Name
                                </label>
                                <input type="text" class="form-control" id="nick_name" name="nick_name" value="<?php echo $row->nick_name;?>">
                              </div>

                              <div class="form-group">
                                <label for="fname">
                                  <!-- Father's Name --> 
                                  Father's Name
                                  <span class="validation-color">*</span>
                                </label>
                                <input type="text" class="form-control" id="fname" name="fname" value="<?php echo $row->fname;?>">
                                <span class="validation-color" id="err_fname"><?php echo form_error('fname'); ?></span>
                              </div>

                              <div class="form-group">
                                <label for="mname">
                                  <!-- Mother's Name --> 
                                  Mother's Name
                                </label>
                                <input type="text" class="form-control" id="mname" name="mname" value="<?php echo $row->mname;?>">
                              </div>

                              <div class="form-group">
                                <div class="row">
                                  <div class="col-md-6">
                                    <label for="religion">
                                      <!-- Religion --> 
                                      Religion
                                      <span class="validation-color">*</span>
                                    </label>
                                    <select class="form-control select2" name="religion" id="religion" style="width: 100%;">
                                      <option value="">Select Religion</option>
                                      <option value="Islam" <?php if($row->religion == 'Islam'){ ?> selected <?php }?>>Islam</option>
                                      <option value="Hinduism" <?php if($row->religion == 'Hinduism'){ ?> selected <?php }?>>Hinduism</option>
                                      <option value="Christianity" <?php if($row->religion == 'Christianity'){ ?> selected <?php }?>>Christianity</option>
                                      <option value="Buddhism" <?php if($row->religion == 'Buddhism'){ ?> selected <?php }?>>Buddhism</option>
                                      <option value="Other" <?php if($row->religion == 'Other'){ ?> selected <?php }?>>Other</option>
                                    </select>
                                    <span class="validation-color" id="err_religion"><?php echo form_error('religion'); ?></span>
                                  </div>

                                  <div class="col-md-6">
                                    <label for="marital_status">
                                      <!-- Marital Status --> 
                                      Marital Status
                                      <span class="validation-color">*</span>
                                    </label>
                                    <select class="form-control select2" name="marital_status" id="marital_status" style="width: 100%;">
                                      <option value="">Select Marital Status</option>
                                      <option value="N/A" <?php if($row->marital_status == 'N/A'){ ?> selected <?php }?>>N/A</option>
                                      <option value="Single" <?php if($row->marital_status == 'Single'){ ?> selected <?php }?>>Single</option>
                                      <option value="Married" <?php if($row->marital_status == 'Married'){ ?> selected <?php }?>>Married</option>
                                      <option value="Divorced" <?php if($row->marital_status == 'Divorced'){ ?> selected <?php }?>>Divorced</option>
                                      <option value="Widowed" <?php if($row->marital_status == 'Widowed'){ ?> selected <?php }?>>Widowed</option>
                                    </select>
                                    <span class="validation-color" id="err_marital_status"><?php echo form_error('marital_status'); ?></span>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="passport_no">
                                  <!-- Passport No --> 
                                  Passport No (If Any)
                                </label>
                                <input type="text" class="form-control" id="passport_no" name="passport_no" value="<?php echo $row->passport_no;?>">
                              </div>

                              <div class="form-group">
                                <div class="row">
                                  <div class="col-md-6">
                                    <label for="gender">
                                      <!-- Gender --> 
                                      Gender
                                      <span class="validation-color">*</span>
                                    </label>
                                    <select class="form-control select2" name="gender" id="gender" style="width: 100%;">
                                      <option value="">Select Gender</option>
                                      <option value="Male" <?php if($row->gender == 'Male'){ ?> selected <?php }?>>Male</option>
                                      <option value="Female" <?php if($row->gender == 'Female'){ ?> selected <?php }?>>Female</option>
                                      <option value="Other" <?php if($row->gender == 'Other'){ ?> selected <?php }?>>Other</option>
                                    </select>
                                    <span class="validation-color" id="err_gender"><?php echo form_error('gender'); ?></span>
                                  </div>

                                  <div class="col-md-6">
                                    <label for="blood_group">
                                      <!-- Blood Group --> 
                                      Blood Group
                                    </label>
                                    <select class="form-control select2" name="blood_group" id="blood_group" style="width: 100%;">
                                      <option value="">Select Blood Group</option>
                                      <option value="A+" <?php if($row->blood_group == 'A+'){ ?> selected <?php }?>>A+</option>
                                      <option value="A-" <?php if($row->blood_group == 'A-'){ ?> selected <?php }?>>A-</option>
                                      <option value="B+" <?php if($row->blood_group == 'B+'){ ?> selected <?php }?>>B+</option>
                                      <option value="B-" <?php if($row->blood_group == 'B-'){ ?> selected <?php }?>>B-</option>
                                      <option value="O+" <?php if($row->blood_group == 'O+'){ ?> selected <?php }?>>O+</option>
                                      <option value="O-" <?php if($row->blood_group == 'O-'){ ?> selected <?php }?>>O-</option>
                                      <option value="AB+" <?php if($row->blood_group == 'AB+'){ ?> selected <?php }?>>AB+</option>
                                      <option value="AB-" <?php if($row->blood_group == 'AB-'){ ?> selected <?php }?>>AB-</option>
                                    </select>
                                  </div>
                                </div>
                              </div>

                              <div class="form-group">
                                <div class="row">
                                  <div class="col-md-6">
                                    <label for="cphone">
                                      <!-- Corporate Phone --> 
                                      Corporate Phone
                                    </label>
                                    <input type="text" class="form-control" id="cphone" name="cphone" value="<?php echo $row->cphone;?>">
                                  </div>

                                  <div class="col-md-6">
                                    <label for="cemail">
                                      <!-- Corporate Email --> 
                                      Corporate Email
                                    </label>
                                    <input type="text" class="form-control" id="cemail" name="cemail" value="<?php echo $row->cemail;?>">
                                  </div>
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="pre_address">
                                  <!-- Present Address --> 
                                  Present Address
                                  <span class="validation-color">*</span>
                                </label>
                                <textarea class="form-control" style="height: 71px" id="pre_address" name="pre_address"><?php echo $row->pre_address;?></textarea>
                                <span class="validation-color" id="err_pre_address"><?php echo form_error('pre_address'); ?></span>
                              </div>

                              <div class="form-group">
                                <label for="per_address">
                                  <!-- Permanent Address --> 
                                  Permanent Address
                                </label>
                                <textarea class="form-control" style="height: 71px" id="per_address" name="per_address"><?php echo $row->per_address;?></textarea>
                              </div>

                              <div class="form-group">
                                <div class="row">
                                  <div class="col-md-6">
                                    <label for="emp_photo">
                                      <!-- Employee's Photograph --> 
                                      Employee's Photograph
                                    </label>
                                    <input type="file" class="form-control" id="emp_photo" name="emp_photo">
                                    <input type="hidden" name="hidden_emp_photo" value="<?php echo $row->emp_photo;?>">
                                  </div>

                                  <div class="col-md-6">
                                    <label for="emp_resume">
                                      <!-- Employee's Resume --> 
                                      Employee's Resume
                                    </label>
                                    <input type="file" class="form-control" id="emp_resume" name="emp_resume">
                                    <input type="hidden" name="hidden_emp_resume" value="<?php echo $row->emp_resume;?>">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>
                    
                    <li class="time-label">
                      <span class="bg-gray">
                        &emsp;&emsp; Official Information &emsp;&emsp;
                      </span>
                    </li>

                    <li>
                      <div class="timeline-item">
                        <div class="timeline-body">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="join_desg">
                                  <!-- Designation --> 
                                  Designation
                                  <span class="validation-color">*</span>
                                </label>
                                <input type="text" class="form-control" id="join_desg" name="join_desg" value="<?php echo $row->join_desg;?>">
                                <span class="validation-color" id="err_join_desg"><?php echo form_error('join_desg'); ?></span>
                              </div>

                              <div class="form-group">
                                <label for="join_date">
                                  <!-- Joining Date --> 
                                  Joining Date
                                  <span class="validation-color">*</span>
                                </label>
                                <input type="text" class="form-control datepicker" id="join_date" name="join_date" value="<?php echo $row->join_date;?>">
                                <span class="validation-color" id="err_join_date"><?php echo form_error('join_date'); ?></span>
                              </div>

                              <div class="form-group">
                                <div class="row">
                                  <div class="col-md-6">
                                    <div class="bootstrap-timepicker">
                                      <label for="start_time">
                                        <!-- Office Start Time --> 
                                        Office Start Time
                                        <span class="validation-color">*</span>
                                      </label>
                                      <input type="text" class="form-control timepicker" id="start_time" name="start_time" value="<?php echo $row->start_time;?>">
                                      <span class="validation-color" id="err_start_time"><?php echo form_error('start_time'); ?></span>
                                    </div>
                                  </div>

                                  <div class="col-md-6">
                                    <div class="bootstrap-timepicker">
                                      <label for="end_time">
                                        <!-- Office End Time --> 
                                        Office End Time
                                        <span class="validation-color">*</span>
                                      </label>
                                      <input type="text" class="form-control timepicker" id="end_time" name="end_time" value="<?php echo $row->end_time;?>">
                                      <span class="validation-color" id="err_end_time"><?php echo form_error('end_time'); ?></span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">
                                <label for="starting_salary">
                                  <!-- Salary --> 
                                  Salary
                                  <span class="validation-color">*</span>
                                </label>
                                <input type="number" class="form-control" id="starting_salary" name="starting_salary" value="<?php echo $row->starting_salary;?>">
                                <span class="validation-color" id="err_starting_salary"><?php echo form_error('starting_salary'); ?></span>
                              </div>

                              <div class="form-group">
                                <label for="wk_holiday">
                                  <!-- Weekly Holidy --> 
                                  Weekly Holidy
                                  <span class="validation-color">*</span>
                                </label>
                                <select class="form-control select2" name="wk_holiday" id="wk_holiday" style="width: 100%;">
                                  <option value="">Select Weekly Holidy</option>
                                  <option value="Saturday" <?php if($row->wk_holiday == 'Saturday'){ ?> selected <?php }?>>Saturday</option>
                                  <option value="Sunday" <?php if($row->wk_holiday == 'Sunday'){ ?> selected <?php }?>>Sunday</option>
                                  <option value="Monday" <?php if($row->wk_holiday == 'Monday'){ ?> selected <?php }?>>Monday</option>
                                  <option value="Tuesday" <?php if($row->wk_holiday == 'Tuesday'){ ?> selected <?php }?>>Tuesday</option>
                                  <option value="Wednesday" <?php if($row->wk_holiday == 'Wednesday'){ ?> selected <?php }?>>Wednesday</option>
                                  <option value="Thursday" <?php if($row->wk_holiday == 'Thursday'){ ?> selected <?php }?>>Thursday</option>
                                  <option value="Friday" <?php if($row->wk_holiday == 'Friday'){ ?> selected <?php }?>>Friday</option>
                                </select>
                                <span class="validation-color" id="err_wk_holiday"><?php echo form_error('wk_holiday'); ?></span>
                              </div>

                              <div class="form-group">
                                <label for="emp_status">
                                  <!-- Employee Status --> 
                                  Employee Status
                                  <span class="validation-color">*</span>
                                </label>
                                <select class="form-control select2" name="emp_status" id="emp_status" style="width: 100%;">
                                  <option value="">Select Employee Status</option>
                                  <option value="Contractual" <?php if($row->emp_status == 'Contractual'){ ?> selected <?php }?>>Contractual</option>
                                  <option value="Probation" <?php if($row->emp_status == 'Probation'){ ?> selected <?php }?>>Probation</option>
                                  <option value="Permanent" <?php if($row->emp_status == 'Permanent'){ ?> selected <?php }?>>Permanent</option>
                                  <option value="Suspended" <?php if($row->emp_status == 'Suspended'){ ?> selected <?php }?>>Suspended</option>
                                  <option value="Resigned" <?php if($row->emp_status == 'Resigned'){ ?> selected <?php }?>>Resigned</option>
                                  <option value="Terminated" <?php if($row->emp_status == 'Terminated'){ ?> selected <?php }?>>Terminated</option>
                                </select>
                                <span class="validation-color" id="err_emp_status"><?php echo form_error('emp_status'); ?></span>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </li>

                    <li>
                      <i class="fa fa-circle bg-gray"></i>
                    </li>
                  </ul>
                  <br>
                </div>

                <div class="col-sm-12">
                  <div class="box-footer">
                    <button type="submit" id="submit" class="button btn bg-gray">
                      <span class="submit" style="left: 16%">Update</span>
                      <span class="loading" style="left: 32%"><i class="fa fa-circle-o-notch"></i></span>
                    </button>
                    <span class="btn btn-danger" id="cancel" style="margin-left: 2%" onclick="cancel('employee')"><!-- Cancel -->
                      <?php echo $this->lang->line('add_user_btn_cancel'); ?></span>
                  </div>
                </div>
              <?php } ?>
              </form>
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
    $('#form').submit(function(){
      var name_regex = /^[a-z0-9\040\.\-\,\/]+$/i;
      var nid_regex = /^[A-Za-z0-9]+$/;
      var date_regex = /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
      var time_regex = /^(0?[1-9]|1[012])(:[0-5]\d) [APap][mM]$/;
      var phone_regex = /^[0-9]+$/;
      var email_regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      var dob = $('#dob').val();
      var first_name = $('#first_name').val();
      var last_name = $('#last_name').val();
      var fname = $('#fname').val();
      var religion = $('#religion').val();
      var marital_status = $('#marital_status').val();
      var gender = $('#gender').val();
      var pre_address = $('#pre_address').val();
      var join_desg = $('#join_desg').val();
      var join_date = $('#join_date').val();
      var start_time = $('#start_time').val();
      var end_time = $('#end_time').val();
      var starting_salary = $('#starting_salary').val();
      var wk_holiday = $('#wk_holiday').val();
      var emp_status = $('#emp_status').val();

      if(nid_number==null || nid_number==""){
        $("#err_nid_number").text("Please Enter NID Number.");
        return false;
      }
      else{
        $("#err_nid_number").text("");
      }
      if (!nid_number.match(nid_regex) ) {
        $('#err_nid_number').text("Please Enter Valid NID Number.");   
        return false;
      }
      else{
        $("#err_nid_number").text("");
      }
      //NID number validation complite.

      if(first_name==null || first_name==""){
        $("#err_first_name").text("Please Enter First Name.");
        $('#first_name').focus();
        return false;
      }
      else{
        $("#err_first_name").text("");
      }
      if (!first_name.match(name_regex) ) {
        $('#err_first_name').text("Please Enter Valid Name.");   
        $('#first_name').focus();
        return false;
      }
      else{
        $("#err_first_name").text("");
      }
      //First name validation complite.

      if(last_name==null || last_name==""){
        $("#err_last_name").text("Please Enter Last Name.");
        $('#last_name').focus();
        return false;
      }
      else{
        $("#err_last_name").text("");
      }
      if (!last_name.match(name_regex) ) {
        $('#err_last_name').text("Please Enter Valid Name.");   
        $('#last_name').focus();
        return false;
      }
      else{
        $("#err_last_name").text("");
      }
      //First name validation complite.

      if(fname==null || fname==""){
        $("#err_fname").text("Please Enter Father's Name.");
        $('#fname').focus();
        return false;
      }
      else{
        $("#err_fname").text("");
      }
      if (!fname.match(name_regex) ) {
        $('#err_fname').text("Please Enter Valid Name.");   
        $('#fname').focus();
        return false;
      }
      else{
        $("#err_fname").text("");
      }
      //Fname validation complite.

      if(religion==null || religion==""){
        $("#err_religion").text("Please Select Religion.");
        return false;
      }
      else{
        $("#err_religion").text("");
      }
      //religion validation complite.

      if(marital_status==null || marital_status==""){
        $("#err_marital_status").text("Please Select Marital Status.");
        return false;
      }
      else{
        $("#err_marital_status").text("");
      }
      //marital status validation complite.

      if(gender==null || gender==""){
        $("#err_gender").text("Please Select Gender.");
        return false;
      }
      else{
        $("#err_gender").text("");
      }
      //gender validation complite.

      if (!phone.match(phone_regex) ) {
        $('#err_cphone').text(" Please Enter Valid Phone Number.");   
        return false;
      }
      else{
        $("#err_cphone").text("");
      }
      //phone validation complite.

      if (!email.match(email_regex) ) {
        $('#err_cemail').text(" Please Enter Valid Email Address.");   
        return false;
      }
      else{
        $("#err_cemail").text("");
      }
      //email validation complite.

      if(pre_address==null || pre_address==""){
        $("#err_pre_address").text("Please Enter Present Address.");
        return false;
      }
      else{
        $("#err_pre_address").text("");
      }
      //pre address validation complite.

      if(join_desg==null || join_desg==""){
        $("#err_join_desg").text("Please Enter Designation.");
        return false;
      }
      else{
        $("#err_join_desg").text("");
      }
      if (!join_desg.match(name_regex) ) {
        $('#err_join_desg').text("Please Enter Valid Designation.");   
        $('#join_desg').focus();
        return false;
      }
      else{
        $("#err_join_desg").text("");
      }
      //join desg validation complite.

      if(join_date==null || join_date==""){
        $("#err_join_date").text("Please Enter Joining Date.");
        return false;
      }
      else{
        $("#err_join_date").text("");
      }
      if (!join_date.match(date_regex) ) {
        $('#err_join_date').text("Please Enter Valid Date.");   
        $('#join_date').focus();
        return false;
      }
      else{
        $("#err_join_date").text("");
      }
      //join date validation complite.
      
      if(start_time==null || start_time==""){
        $("#err_start_time").text("Please Enter Office Start Time.");
        return false;
      }
      else{
        $("#err_start_time").text("");
      }
      if (!start_time.match(time_regex) ) {
        $('#err_start_time').text("Please Enter Valid Time.");   
        $('#start_time').focus();
        return false;
      }
      else{
        $("#err_start_time").text("");
      }
      //start time validation complite.

      if(end_time==null || end_time==""){
        $("#err_end_time").text("Please Enter Office End Time.");
        return false;
      }
      else{
        $("#err_end_time").text("");
      }
      if (!end_time.match(time_regex) ) {
        $('#err_end_time').text("Please Enter Valid Time.");   
        $('#end_time').focus();
        return false;
      }
      else{
        $("#err_end_time").text("");
      }
      //end time validation complite.

      if(starting_salary==null || starting_salary==""){
        $("#err_starting_salary").text("Please Enter Salary.");
        return false;
      }
      else{
        $("#err_starting_salary").text("");
      }
      //starting salary validation complite.
      
      if(wk_holiday==null || wk_holiday==""){
        $("#err_wk_holiday").text("Please Select Weekly Holiday.");
        return false;
      }
      else{
        $("#err_wk_holiday").text("");
      }
      //weekly holiday validation complite.
    
      if(emp_status==null || emp_status==""){
        $("#err_emp_status").text("Please Select Status.");
        return false;
      }
      else{
        $("#err_emp_status").text("");
      }
      //emp status validation complite.

      $(this).find(':button[type=submit]').prop('disabled', true);
      $('.button').css('cursor', 'default');
      $('.button').toggleClass('active');
    });

    $("#nid_number").on("blur keyup",  function (event){
        var nid_regex = /^[A-Za-z0-9]+$/;
        var nid_number = $('#nid_number').val();
        if(nid_number==null || nid_number==""){
          $("#err_nid_number").text("Please Enter NID Number.");
          return false;
        }
        else{
          $("#err_nid_number").text("");
        }
        if (!nid_number.match(nid_regex) ) {
          $('#err_nid_number').text(" Please Enter Valid NID Number.");   
          return false;
        }
        else{
          $("#err_nid_number").text("");
        }
    });
    $("#first_name").on("blur keyup",  function (event){
        var name_regex = /^[a-z0-9\040\.\-\,\/]+$/i;
        var first_name = $('#first_name').val();
        if(first_name==null || first_name==""){
          $("#err_first_name").text("Please Enter First Name.");
          return false;
        }
        else{
          $("#err_first_name").text("");
        }
        if (!first_name.match(name_regex) ) {
          $('#err_first_name').text(" Please Enter Valid Name.");   
          return false;
        }
        else{
          $("#err_first_name").text("");
        }
    });
    $("#last_name").on("blur keyup",  function (event){
        var name_regex = /^[a-z0-9\040\.\-\,\/]+$/i;
        var last_name = $('#last_name').val();
        if(last_name==null || last_name==""){
          $("#err_last_name").text("Please Enter Last Name.");
          return false;
        }
        else{
          $("#err_last_name").text("");
        }
        if (!last_name.match(name_regex) ) {
          $('#err_last_name').text(" Please Enter Valid Name.");   
          return false;
        }
        else{
          $("#err_last_name").text("");
        }
    });
    $("#fname").on("blur keyup",  function (event){
        var name_regex = /^[a-z0-9\040\.\-\,\/]+$/i;
        var fname = $('#fname').val();
        if(fname==null || fname==""){
          $("#err_fname").text("Please Enter Father's Name.");
          return false;
        }
        else{
          $("#err_fname").text("");
        }
        if (!fname.match(name_regex) ) {
          $('#err_fname').text(" Please Enter Valid Name.");   
          return false;
        }
        else{
          $("#err_fname").text("");
        }
    });
    $("#religion").on("blur keyup",  function (event){
        var religion = $('#religion').val();
        if(religion==null || religion==""){
          $("#err_religion").text("Please Select Religion.");
          return false;
        }
        else{
          $("#err_religion").text("");
        }
    });
    $("#marital_status").on("blur keyup",  function (event){
        var marital_status = $('#marital_status').val();
        if(marital_status==null || marital_status==""){
          $("#err_marital_status").text("Please Select Marital Status.");
          return false;
        }
        else{
          $("#err_marital_status").text("");
        }
    });
    $("#gender").on("blur keyup",  function (event){
        var gender = $('#gender').val();
        if(gender==null || gender==""){
          $("#err_gender").text("Please Select Gender.");
          return false;
        }
        else{
          $("#err_gender").text("");
        }
    });
    $("#pre_address").on("blur keyup",  function (event){
        var pre_address = $('#pre_address').val();
        if(pre_address==null || pre_address==""){
          $("#err_pre_address").text("Please Enter Present Address.");
          return false;
        }
        else{
          $("#err_pre_address").text("");
        }
    });
    $("#join_desg").on("blur keyup",  function (event){
        var name_regex = /^[a-z0-9\040\.\-\,\/]+$/i;
        var join_desg = $('#join_desg').val();
        if(join_desg==null || join_desg==""){
          $("#err_join_desg").text("Please Enter Designation.");
          return false;
        }
        else{
          $("#err_join_desg").text("");
        }
        if (!join_desg.match(name_regex) ) {
          $('#err_join_desg').text(" Please Enter Valid Designaiton.");   
          return false;
        }
        else{
          $("#err_join_desg").text("");
        }
    });
    $("#join_date").on("blur keyup",  function (event){
        var date_regex = /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
        var join_date = $('#join_date').val();
        if(join_date==null){
          $("#err_join_date").text("Please Enter Joining Date.");
          return false;
        }
        else{
          $("#err_join_date").text("");
        }
        if (!join_date.match(nid_regex) ) {
          $('#err_join_date').text(" Please Enter Valid Date.");   
          return false;
        }
        else{
          $("#err_join_date").text("");
        }
    });
    $("#start_time").on("blur keyup",  function (event){
        var time_regex = /^(0?[1-9]|1[012])(:[0-5]\d) [APap][mM]$/;
        var start_time = $('#start_time').val();
        if(start_time==null || start_time==""){
          $("#err_start_time").text("Please Enter Office Start Time.");
          return false;
        }
        else{
          $("#err_start_time").text("");
        }
        if (!start_time.match(nid_regex) ) {
          $('#err_start_time').text(" Please Enter Valid Time.");   
          return false;
        }
        else{
          $("#err_start_time").text("");
        }
    });
    $("#end_time").on("blur keyup",  function (event){
        var time_regex = /^(0?[1-9]|1[012])(:[0-5]\d) [APap][mM]$/;
        var end_time = $('#end_time').val();
        if(end_time==null || end_time==""){
          $("#err_end_time").text("Please Enter Office End Time.");
          return false;
        }
        else{
          $("#err_end_time").text("");
        }
        if (!end_time.match(nid_regex) ) {
          $('#err_end_time').text(" Please Enter Valid Time.");   
          return false;
        }
        else{
          $("#err_end_time").text("");
        }
    });
    $("#starting_salary").on("blur keyup",  function (event){
        var starting_salary = $('#starting_salary').val();
        if(starting_salary==null || starting_salary==""){
          $("#err_starting_salary").text("Please Enter Salary.");
          return false;
        }
        else{
          $("#err_starting_salary").text("");
        }
    });
    $("#wk_holiday").on("blur keyup",  function (event){
        var wk_holiday = $('#wk_holiday').val();
        if(wk_holiday==null || wk_holiday==""){
          $("#err_wk_holiday").text("Please Select Weekly Holiday.");
          return false;
        }
        else{
          $("#err_wk_holiday").text("");
        }
    });
    $("#emp_status").on("blur keyup",  function (event){
        var emp_status = $('#emp_status').val();
        if(emp_status==null || emp_status==""){
          $("#err_emp_status").text("Please Select Employee Status.");
          return false;
        }
        else{
          $("#err_emp_status").text("");
        }
    });
  }); 
</script>