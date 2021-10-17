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
          <li><a href="<?php echo base_url('shelf'); ?>" class="text-black"><!-- shelf --><strong>Shelf</strong></a></li>
          <li class="active"><!-- Edit shelf -->Edit Shelf</li>
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
              <h3 class="box-title">Edit shelf</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-sm-6">
                <form role="form" id="form" method="post" action="<?php echo base_url('shelf/editshelf');?>">
                  <?php foreach($data as $row){?>
                    <div class="form-group">
                      <label for="shelf_name"><!-- shelf Name --> Shelf Name<!-- <?php echo $this->lang->line('shelf_label_name'); ?> --> <span class="validation-color">*</span></label>
                      <input type="text" class="form-control" id="shelf_name" name="shelf_name" value="<?php echo $row->shelf_name; ?>">
                      <input type="hidden" name="id" value="<?php echo $row->shelf_id;?>">
                      <span class="validation-color" id="err_shelf_name"><?php echo form_error('shelf_name'); ?></span>
                    </div>
                    <div class="form-group">
                      <label for="shelf_location"><!-- shelf_location --> Location<!--  <?php echo $this->lang->line('shelf_label_shelf_location'); ?> --></label>
                      <input type="text" class="form-control" id="shelf_location" name="shelf_location" value="<?php echo $row->shelf_location; ?>">
                    </div>
                    <div class="form-group">
                      <label for="category_name"><!-- Category Description --> Status </label><br>
                      <?php echo lang('category_status_y_label', 'confirm');?>
                      <input type="radio" name="confirm" value="active" <?php if($row->shelf_status == 'active') {?> checked="checked" <?php }?> class="minimal"/>&nbsp;&nbsp;
                      <?php echo lang('category_status_n_label', 'confirm');?>
                      <input type="radio" name="confirm" value="inactive" <?php if($row->shelf_status != 'active') {?> checked="checked" <?php }?> class="minimal"/>
                    </div>
                    <div class="col-sm-12">
                      <div class="box-footer">
                        <button type="submit" id="submit" class="button btn bg-gray">
                          <span class="submit" style="left: 16%">Update</span>
                          <span class="loading" style="left: 32%"><i class="fa fa-circle-o-notch"></i></span>
                        </button>
                        <span class="btn btn-danger" id="cancel" style="margin-left: 2%" onclick="cancel('shelf')"><!-- Cancel --><!--  <?php echo $this->lang->line('shelf_label_cancel'); ?> -->Cancel</span>
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
    var shelf_name_empty = "Please Enter the shelf Name.";
    var shelf_name_invalid = "Please Enter Valid shelf Name";
    var shelf_name_length = "Please Enter shelf Name Minimun 3 Character";

    $('#form').submit(function(){
      var name_regex = /^[a-z0-9\040\.\-\,\/]+$/i;
      var shelf_name = $('#shelf_name').val().trim();
      $('#shelf_name').val(shelf_name);
      if(shelf_name==null || shelf_name==""){
        $("#err_shelf_name").text(shelf_name_empty);
        return false;
      }
      else{
        $("#err_shelf_name").text("");
      }
      if (!shelf_name.match(name_regex) ) {
        $('#err_shelf_name').text(shelf_name_invalid);   
        return false;
      }
      else{
        $("#err_shelf_name").text("");
      }
      if (shelf_name.length < 3) {
        $('#err_shelf_name').text(shelf_name_length);  
        return false;
      }
      else{
        $("#err_shelf_name").text("");
      }

      $(this).find(':button[type=submit]').prop('disabled', true);
      $('.button').css('cursor', 'default');
      $('.button').toggleClass('active');
    });

    $("#shelf_name").on("blur keyup",  function (event){
      var name_regex = /^[a-z0-9\040\.\-\,\/]+$/i;
      var shelf_name = $('#shelf_name').val();
      if(shelf_name==null || shelf_name==""){
        $("#err_shelf_name").text(shelf_name_empty);
        return false;
      }
      else{
        $("#err_shelf_name").text("");
      }
      if (!shelf_name.match(name_regex) ) {
        $('#err_shelf_name').text(shelf_name_invalid);   
        return false;
      }
      else{
        $("#err_shelf_name").text("");
      }
      if (shelf_name.length < 3) {
        $('#err_shelf_name').text(shelf_name_length);  
        return false;
      }
      else{
        $("#err_shelf_name").text("");
      }
    });
  }); 
</script>