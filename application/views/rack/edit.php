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
          <li><a href="<?php echo base_url('rack'); ?>" class="text-black"><!-- rack -->
                  <strong>Rack</strong></a></li>
          <li class="active"><!-- Edit rack -->
           <!--  <?php echo $this->lang->line('edit_rack_header'); ?> -->Edit Rack
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
              <h3 class="box-title"><!-- Edit rack -->Edit Rack
            <!-- <?php echo $this->lang->line('edit_rack_header'); ?> --></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-sm-6">
                <form role="form" id="form" method="post" action="<?php echo base_url('rack/editrack');?>">
                  <?php foreach($data as $row){?>
                    <div class="form-group">
                      <label for="shelf">Shelf
                        <!-- <?php echo $this->lang->line('add_biller_select_shelf'); ?> --> <span class="validation-color">*</span>
                      </label>
                      <select class="form-control select2" id="shelf" name="shelf" style="width: 100%;">
                        <option value="">Select Shelf</option>
                        <?php
                          foreach ($shelf as $key) {
                        ?>
                            <option value='<?php echo $key->shelf_id ?>' <?php if($key->shelf_id == $row->shelf_id){echo "selected";} ?>><?php echo $key->shelf_name ?></option>
                        <?php
                          }
                        ?>
                      </select>
                      <span class="validation-color" id="err_shelf_id"><?php echo form_error('shelf'); ?></span>
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                      <label for="rack_name"><!-- rack Name --> Rack Name
                        <!-- <?php echo $this->lang->line('add_rack_name'); ?> --> <span class="validation-color">*</span></label>
                      <input type="text" class="form-control" id="rack_name" name="rack_name" value="<?php echo $row->rack_name; ?>">
                      <input type="hidden" name="id" value="<?php echo $row->rack_id;?>">
                      <span class="validation-color" id="err_rack_name"><?php echo form_error('rack_name'); ?></span>
                    </div>
                    <div class="form-group">
                      <label for="rack_location">Location </label>
                      <input type="text" class="form-control" id="rack_location" name="rack_location" value="<?php echo $row->rack_location; ?>">
                    </div>
                    <div class="form-group">
                      <label for="category_name"> Status </label><br>
                      <?php echo lang('category_status_y_label', 'confirm');?>
                      <input type="radio" name="confirm" value="active" <?php if($row->rack_status == 'active') {?> checked="checked" <?php }?> class="minimal"/>&nbsp;&nbsp;
                      <?php echo lang('category_status_n_label', 'confirm');?>
                      <input type="radio" name="confirm" value="inactive" <?php if($row->rack_status != 'active') {?> checked="checked" <?php }?> class="minimal"/>
                    </div>
                    <div class="col-sm-12">
                      <div class="box-footer">
                        <button type="submit" id="submit" class="button btn bg-gray">
                          <span class="submit" style="left: 16%">Update</span>
                          <span class="loading" style="left: 32%"><i class="fa fa-circle-o-notch"></i></span>
                        </button>
                        <span class="btn btn-danger" id="cancel" style="margin-left: 2%" onclick="cancel('rack')"><!-- Cancel -->
                          <?php echo $this->lang->line('add_user_btn_cancel'); ?></span>
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
    $('#form').submit(function(){
      var name_regex = /^[-\sa-zA-Z]+$/;
      var shelf_id = $('#shelf').val();
      var rack_name = $('#rack_name').val();


        if(shelf_id==""){
          $("#err_shelf_id").text("Please Select shelf.");
          return false;
        }
        else{
          $("#err_shelf_id").text("");
        }
//shelf id validation complite.

        if(rack_name==null || rack_name==""){
          $("#err_rack_name").text("Please Enter rack Name.");
          return false;
        }
        else{
          $("#err_rack_name").text("");
        }
        if (!rack_name.match(name_regex) ) {
          $('#err_rack_name').text(" Please Enter Valid rack Name  ");   
          return false;
        }
        else{
          $("#err_rack_name").text("");
        }
//rack name validation complite.

      $(this).find(':button[type=submit]').prop('disabled', true);
      $('.button').css('cursor', 'default');
      $('.button').toggleClass('active');
    });

    $("#shelf").change(function(event){
        var shelf_id = $('#shelf').val();
        if(shelf_id==""){
          $("#err_shelf_id").text(" Please Select shelf.");
          return false;
        }
        else{
          $("#err_shelf_id").text("");
        }
    });

    $("#rack_name").on("blur keyup", function(){
        var name_regex = /^[-\sa-zA-Z]+$/;
        var rack_name = $('#rack_name').val();
        if(rack_name==null || rack_name==""){
          $("#err_rack_name").text("Please Enter rack Name.");
          return false;
        }
        else{
          $("#err_rack_name").text("");
        }
        if (!rack_name.match(name_regex) ) {
          $('#err_rack_name').text(" Please Enter Valid rack Name  ");   
          return false;
        }
        else{
          $("#err_rack_name").text("");
        }
    });
   
}); 
</script>
