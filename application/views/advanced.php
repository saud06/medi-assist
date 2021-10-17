<?php
  $this->load->view('layout/header');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('auth'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
          <li><a href="<?php echo base_url('subcategory'); ?>">List Subcategory</a></li>
          <li class="active">Add Subcategory</li>
        </ol>
      </h5>    
    </section>
<!-- Main content -->
    <section class="content">
      <div class="row">
      <!-- right column -->
        <div class="col-md-12">
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Add New Subcategory</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-6">
                <form role="form" id="form" method="post" action="<?php echo base_url('category/addCategory');?>">
                  <div class="form-group">
                    <label for="category">Select Category <span class="validation-color">*</span></label>
                    <select class="form-control select2" id="category" name="category" style="width: 100%;">
                      <?php
                        foreach ($data as $row) {
                          echo "<option value='$row->category_id'>$row->category_name</option>";
                        }
                      ?>
                    </select>
                    <span class="validation-color" id="err_category"></span>
                  </div>
                  <!-- /.form-group -->
                  <div class="form-group">
                    <label for="subcategory_name">Subcategory Name <span class="validation-color">*</span></label>
                    <input type="text" class="form-control" id="subcategory_name" name="subcategory_name" value="">
                    <span class="validation-color" id="err_subcategory_name"></span>
                  </div>
                  <div class="box-footer">
                    <button type="submit" id="submit" class="btn btn-primary">Add</button>
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
    var subcategory_name_empty = "Please Select Category.";
    var subcategory_name_invalid = "Please Enter Valid Subategory Name";
    var subcategory_name_length = "Please Enter Subcategory Name Minimun 3 Character";
    var category_select = "Please Select Category."
    $("#submit").click(function(event){
      var name_regex = /^[-a-zA-Z\s]+$/;
      var subcategory_name = $('#subcategory_name').val().trim();
      var category = $('#category').val();

      if(category == "" || category == null){
        $('#err_category').text(category_select);
      }
      else{
        $('#err_category').text("");
      }
//select category validation copmlite.

      $('#subcategory_name').val(subcategory_name);
      if(subcategory_name==null || subcategory_name==""){
        $("#err_subcategory_name").text(subcategory_name_empty);
        return false;
      }
      else{
        $("#err_subcategory_name").text("");
      }
      if (!subcategory_name.match(name_regex) ) {
        $('#err_subcategory_name').text(subcategory_name_invalid);   
        return false;
      }
      else{
        $("#err_subcategory_name").text("");
      }
      if (subcategory_name.length < 3) {
        $('#err_subcategory_name').text(subcategory_name_length);  
        return false;
      }
      else{
        $("#err_subcategory_name").text("");
      }
//subcategory name validation complite.
    });

    $("#subcategory_name").on("blur keyup",  function (event){
      var name_regex = /^[-a-zA-Z\s]+$/;
      var subcategory_name = $('#subcategory_name').val();
      if(subcategory_name==null || subcategory_name==""){
        $("#err_subcategory_name").text(subcategory_name_empty);
        return false;
      }
      else{
        $("#err_subcategory_name").text("");
      }
      if (!subcategory_name.match(name_regex) ) {
        $('#err_subcategory_name').text(subcategory_name_invalid);   
        return false;
      }
      else{
        $("#err_subcategory_name").text("");
      }
      if (subcategory_name.length < 3) {
        $('#err_subcategory_name').text(subcategory_name_length);  
        return false;
      }
      else{
        $("#err_subcategory_name").text("");
      }
    });
    $('#category').change(function(){
      var category = $('#category').val();
      if(category == "" || category == null){
        $('#err_category').text(category_select);
      }
      else{
        $('#err_category').text("");
      }
    });
}); 
</script>
