<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','manager');
if(!(in_array($this->session->userdata('type'),$p))){
  redirect('auth');
}
$this->load->view('layout/header');
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('auth/dashboard'); ?>" class="text-black"><i class="fa fa-dashboard">&nbsp;</i><strong><?php echo $this->lang->line('header_dashboard'); ?></strong></a></li>
          <li><a href="<?php echo base_url('branch'); ?>" class="text-black"><!-- Branch --> <strong><?php echo $this->lang->line('branch_label'); ?></strong></a></li>
          <li class="active"><!-- Edit Branch --> <?php echo $this->lang->line('branch_label_edit'); ?></li>
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
              <h3 class="box-title"><!-- Edit Branch --> <?php echo $this->lang->line('branch_label_edit'); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-sm-6">
                <form role="form" id="form" method="post" action="<?php echo base_url('branch/editBranch');?>">
                  <?php foreach($data as $row){?>
                    <div class="form-group">
                      <label for="branch_name"><!-- Branch Name --> <?php echo $this->lang->line('branch_label_name'); ?> <span class="validation-color">*</span></label>
                      <input type="text" class="form-control" id="branch_name" name="branch_name" value="<?php echo $row->branch_name; ?>">
                      <input type="hidden" name="id" value="<?php echo $row->branch_id;?>">
                      <span class="validation-color" id="err_branch_name"><?php echo form_error('branch_name'); ?></span>
                    </div>
                    <div class="form-group">
                      <label for="city"><!-- City -->  <?php echo $this->lang->line('branch_label_city'); ?><span class="validation-color">*</span></label>
                      <input type="text" class="form-control" id="city" name="city" value="<?php echo $row->city; ?>">
                      <span class="validation-color" id="err_city"><?php echo form_error('city'); ?></span>
                    </div>
                    <div class="form-group">
                      <label for="address"><!-- Address -->  <?php echo $this->lang->line('branch_label_address'); ?><span class="validation-color">*</span></label>
                       <textarea class="form-control" id="address" name="address" value=""><?php echo $row->address ?></textarea>
                      <span class="validation-color" id="err_address"><?php echo form_error('address'); ?></span>
                    </div>
                  </div>
                  <div class="col-sm-12">
                  <div class="box-footer">
                    <button type="submit" id="submit" class="btn btn-info"><!-- Update --> <?php echo $this->lang->line('subcategory_update'); ?></button>
                    <span class="btn btn-default" id="cancel" style="margin-left: 2%" onclick="cancel('branch')"><!-- Cancel --> <?php echo $this->lang->line('branch_label_cancel'); ?></span>
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
    var branch_name_empty = "Please Enter the Branch Name.";
    var branch_name_invalid = "Please Enter Valid Branch Name";
    var branch_name_length = "Please Enter Branch Name Minimun 3 Character";
    var city_empty = "Please Enter the City Name.";
    var city_invalid = "Please Enter Valid City Name";
    var city_length = "Please Enter City Name Minimun 3 Character";
    var address_empty = "Please Enter Branch Address";
    $("#submit").click(function(event){
      var name_regex = /^[-a-zA-Z\s]+$/;
      var city_regex = /^[a-zA-Z\s]+$/;
      var branch_name = $('#branch_name').val().trim();
      var city = $('#city').val().trim();
      var address = $('#address').val().trim();
      $('#branch_name').val(branch_name);
      if(branch_name==null || branch_name==""){
        $("#err_branch_name").text(branch_name_empty);
        return false;
      }
      else{
        $("#err_branch_name").text("");
      }
      if (!branch_name.match(name_regex) ) {
        $('#err_branch_name').text(branch_name_invalid);   
        return false;
      }
      else{
        $("#err_branch_name").text("");
      }
      if (branch_name.length < 3) {
        $('#err_branch_name').text(branch_name_length);  
        return false;
      }
      else{
        $("#err_branch_name").text("");
      }
//branch name validation complite.
      if(city==null || city==""){
        $("#err_city").text(city_empty);
        return false;
      }
      else{
        $("#err_city").text("");
      }
      if (!city.match(city_regex) ) {
        $('#err_city').text(city_invalid);   
        return false;
      }
      else{
        $("#err_city").text("");
      }
      if (city.length < 3) {
        $('#err_city').text(city_length);  
        return false;
      }
      else{
        $("#err_city").text("");
      }
//city name validation complite.
      if(address == "" || address == null){
        $('err_address').text(address_empty);
      }
      else{
        $('err_address').text("");
      }
//address name validation complite. 
    });

    $("#branch_name").on("blur keyup",  function (event){
      var name_regex = /^[-a-zA-Z\s]+$/;
      var branch_name = $('#branch_name').val();
      if(branch_name==null || branch_name==""){
        $("#err_branch_name").text(branch_name_empty);
        return false;
      }
      else{
        $("#err_branch_name").text("");
      }
      if (!branch_name.match(name_regex) ) {
        $('#err_branch_name').text(branch_name_invalid);   
        return false;
      }
      else{
        $("#err_branch_name").text("");
      }
      if (branch_name.length < 3) {
        $('#err_branch_name').text(branch_name_length);  
        return false;
      }
      else{
        $("#err_branch_name").text("");
      }
    });

    $("#city").on("blur keyup",  function (event){
      var city_regex = /^[a-zA-Z\s]+$/;
      var city = $('#city').val();
      $('#city').val(city);
      if(city==null || city==""){
        $("#err_city").text(city_empty);
        return false;
      }
      else{
        $("#err_city").text("");
      }
      if (!city.match(city_regex) ) {
        $('#err_city').text(city_invalid);   
        return false;
      }
      else{
        $("#err_city").text("");
      }
      if (city.length < 3) {
        $('#err_city').text(city_length);  
        return false;
      }
      else{
        $("#err_city").text("");
      }
    });

    $("#address").on("blur keyup",  function (event){
      var address = $('#address').val();
      if(address == "" || address == null){
        $('#err_address').text(address_empty);
      }
      else{
        $('#err_address').text("");
      }
    });
   
}); 
</script>