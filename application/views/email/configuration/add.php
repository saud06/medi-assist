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
          <li class="active">SMTP Setting</li>
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
              <h3 class="box-title">SMTP Setting</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <form role="form" id="form" method="post" action="<?php echo base_url('email_setup/add');?>">
                  <div class="col-md-6">

                  	<div class="form-group">
                      <label for="name">Email Protocol<span class="validation-color">*</span></label>
                      &nbsp;&nbsp;<input type="radio" name="email_protocol" id="email_protocol" value="SMTP" checked>
                    </div>

                    <div class="form-group">
                      <label for="email_encription">Email Encription<span class="validation-color">*</span></label>
                      <input type="text" class="form-control" id="email_encription" name="email_encription" value="<?php if(isset($data[0]->email_encription)){ echo $data[0]->email_encription; }?>">
                      <span class="validation-color" id="err_email_encription"><?php echo form_error('email_encription'); ?></span>
                    </div>

                    <div class="form-group">
                      <label for="smtp_host">SMTP Host<span class="validation-color">*</span></label>
                      <input type="text" class="form-control" id="smtp_host" name="smtp_host" value="<?php if(isset($data[0]->smtp_host)){ echo $data[0]->smtp_host; }?>">
                      <span class="validation-color" id="err_smtp_host"><?php echo form_error('smtp_host'); ?></span>
                    </div>

                    <div class="form-group">
                        <label for="smtp_port">SMTP Port<span class="validation-color">*</span></label>
                        <input type="text" class="form-control" id="smtp_port" name="smtp_port" value="<?php if(isset($data[0]->smtp_port)){ echo $data[0]->smtp_port; }?>">
                        <span class="validation-color" id="err_smtp_port"><?php echo form_error('smtp_port'); ?></span>
                    </div>

                    <div class="form-group">
                        <label for="smtp_email">SMTP Email<span class="validation-color">*</span></label>
                        <input type="text" class="form-control" id="smtp_email" name="smtp_email" value="<?php if(isset($data[0]->smtp_email)){ echo $data[0]->smtp_email; }?>">
                        <span class="validation-color" id="err_smtp_email"><?php echo form_error('smtp_email'); ?></span>
                    </div>

                    <div class="form-group">
                        <label for="from_address">From Address<span class="validation-color">*</span></label>
                        <input type="text" class="form-control" id="from_address" name="from_address" value="<?php if(isset($data[0]->from_address)){ echo $data[0]->from_address; }?>">
                        <span class="validation-color" id="err_from_address"><?php echo form_error('from_address'); ?></span>
                    </div>

                    <div class="form-group">
                        <label for="from_name">From Name<span class="validation-color">*</span></label>
                        <input type="text" class="form-control" id="from_name" name="from_name" value="<?php if(isset($data[0]->from_name)){ echo $data[0]->from_name; }?>">
                        <span class="validation-color" id="err_from_name"><?php echo form_error('from_name'); ?></span>
                    </div>

                    <div class="form-group">
                        <label for="smtp_username">SMTP Username<span class="validation-color">*</span></label>
                        <input type="text" class="form-control" id="smtp_username" name="smtp_username" value="<?php if(isset($data[0]->smtp_username)){ echo $data[0]->smtp_username; }?>">
                        <span class="validation-color" id="err_smtp_username"><?php echo form_error('smtp_username'); ?></span>
                    </div>

                    <div class="form-group">
                      <label for="smtp_password">SMTP Password<span class="validation-color">*</span></label>
                      <input type="password" class="form-control" id="smtp_password" name="smtp_password" value="<?php if(isset($data[0]->smtp_password)){ echo $data[0]->smtp_password; }?>">
                      <span class="validation-color" id="err_smtp_password"><?php echo form_error('smtp_password'); ?></span>
                    </div>

                  </div>
                  <div class="col-sm-12">
                    <div class="box-footer">
                      <button type="submit" id="submit" class="button btn bg-gray">
                        <span class="submit" style="left: 32%">Add</span>
                        <span class="loading" style="left: 32%"><i class="fa fa-circle-o-notch"></i></span>
                      </button>

                      <span class="btn btn-danger" id="cancel" style="margin-left: 2%" onclick="cancel('auth/dashboard')"><!-- Cancel --><?php echo $this->lang->line('category_cancel'); ?></span>
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
  $(document).ready(function(){
    var email_encription_empty = "Please Enter Email Encription.";
    var smtp_host_empty = "Please Enter SMTP Host.";
    var email_empty = "Please Enter Email.";
    var email_invalid = "Please Enter Valid Email";
    var smtp_port_empty = "Please Enter SMTP Port.";
    var smtp_port_invalid = "Please Enter Valid SMTP Port";
    var from_address_empty = "Please Enter From address.";
    var from_name_empty = "Please Enter From Name.";
    var smtp_username_empty = "Please SMTP Username.";
    var smtp_password_empty = "Please SMTP Password.";
    $("#submit").click(function(event){
      var name_regex = /^[-a-zA-Z\s]+$/;
      var email_regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      var smtp_port_regex = /^[0-9]+$/; 
      var email_encription = $('#email_encription').val().trim();
      var smtp_host = $('#smtp_host').val().trim();
      var smtp_port = $('#smtp_port').val().trim();
      var email = $('#smtp_email').val().trim();
      var from_address = $('#from_address').val().trim();
      var from_name = $('#from_name').val().trim();
      var smtp_username = $('#smtp_username').val().trim();
      var smtp_password = $('#smtp_password').val();

      if(email_encription==null || email_encription==""){
        $("#err_email_encription").text(email_encription_empty);
        return false;
      }
      else{
        $("#err_email_encription").text("");
      }
      
      if(smtp_host==null || smtp_host==""){
        $("#err_smtp_host").text(smtp_host_empty);
        return false;
      }
      else{
        $("#err_smtp_host").text("");
      }

      var smtp_port = $('#smtp_port').val();
      if(smtp_port==null || smtp_port==""){
        $("#err_smtp_port").text(smtp_port_empty);
        return false;
      }
      else{
        $("#err_smtp_port").text("");
      }
      if (!smtp_port.match(smtp_port_regex) ) {
        $('#err_smtp_port').text(smtp_port_invalid);   
        return false;
      }
      else{
        $("#err_smtp_port").text("");
      }

      if(email==null || email==""){
        $("#err_smtp_email").text(email_empty);
        return false;
      }
      else{
        $("#err_smtp_email").text("");
      }
      if (!email.match(email_regex) ) {
        $('#err_smtp_email').text(email_invalid);   
        return false;
      }
      else{
        $("#err_smtp_email").text("");
      }
      
      if(from_address==null || from_address==""){
        $("#err_from_address").text(from_address_empty);
        return false;
      }
      else{
        $("#err_from_address").text("");
      }

      if(from_name == "" || from_name == null){
        $('#err_from_name').text(from_name_empty);
        return false;
      }
      else{
        $('#err_from_name').text("");
      }

      if(smtp_username == "" || smtp_username == null){
        $('#err_smtp_username').text(smtp_username_empty);
        return false;
      }
      else{
        $('#err_smtp_username').text("");
      }

      if(smtp_password == "" || smtp_password == null){
        $('#err_smtp_password').text(smtp_password_empty);
        return false;
      }
      else{
        $('#err_smtp_password').text("");
      }
    });

    $("#email_encription").on("blur keyup",  function (event){
      var email_encription = $('#email_encription').val();
      if(email_encription==null || email_encription==""){
        $("#err_email_encription").text(email_encription_empty);
        return false;
      }
      else{
        $("#err_email_encription").text("");
      }
    });
    $("#smtp_host").on("blur keyup",  function (event){
      var name_smtp_hostregex = /^[-a-zA-Z\s]+$/;
      var smtp_host = $('#smtp_host').val();
      if(smtp_host==null || smtp_host==""){
        $("#err_smtp_host").text(smtp_host_empty);
        return false;
      }
      else{
        $("#err_smtp_host").text("");
      }
    });
    $("#smtp_email").on("blur keyup",  function (event){
      var email_regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      var email = $('#smtp_email').val();
      if(email==null || email==""){
        $("#err_smtp_email").text(email_empty);
        return false;
      }
      else{
        $("#err_smtp_email").text("");
      }
      if (!email.match(email_regex) ) {
        $('#err_smtp_email').text(email_invalid);   
        return false;
      }
      else{
        $("#err_smtp_email").text("");
      }
    });
    $("#smtp_port").on("blur keyup",  function (event){
      var smtp_port_regex = /^[0-9]+$/; 
      var smtp_port = $('#smtp_port').val();
      if(smtp_port==null || smtp_port==""){
        $("#err_smtp_port").text(smtp_port_empty);
        return false;
      }
      else{
        $("#err_smtp_port").text("");
      }
      if (!smtp_port.match(smtp_port_regex) ) {
        $('#err_smtp_port').text(smtp_port_invalid);   
        return false;
      }
      else{
        $("#err_smtp_port").text("");
      }
    });
    $("#from_address").on("blur keyup",  function (event){
      var name_regex = /^[-a-zA-Z\s]+$/;
      var from_address = $('#from_address').val();
      if(from_address==null || from_address==""){
        $("#err_from_address").text(from_address_empty);
        return false;
      }
      else{
        $("#err_from_address").text("");
      }
    });
    $("#from_name").change(function(){
      var from_name = $('#from_name').val();
      if(from_name == "" || from_name == null){
        $('#err_from_name').text(from_name_empty);
        return false;
      }
      else{
        $('#err_from_name').text("");
      }
    });
    $("#smtp_username").change(function(){
      var smtp_username = $('#smtp_username').val();
      if(smtp_username == "" || smtp_username == null){
        $('#err_smtp_username').text(smtp_username_empty);
        return false;
      }
      else{
        $('#err_smtp_username').text("");
      }
    });
    $('#smtp_password').change(function(){
      var smtp_password = $('#smtp_password').val();
      if(smtp_password == "" || smtp_password == null){
        $('#err_smtp_password').text(smtp_password_empty);
        return false;
      }
      else{
        $('#err_smtp_password').text("");
      }
    });
}); 
</script>
