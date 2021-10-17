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
          <li><a href="<?php echo base_url('product'); ?>" class="text-black"><strong><?php echo $this->lang->line('header_product'); ?></strong></a></li>
          <li class="active">Add products by CSV</li>
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
              <h3 class="box-title">Add products by CSV</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-lg-12">
                  <form action="<?php echo base_url('product/import_csv'); ?>" class="form-horizontal" data-toggle="validator" role="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <input type="hidden" name="token" value="b83dfa00669b155a37f921dd34e01d69" />  
                      <div class="row">
                        <div class="col-md-12">
                          <div class="well well-small">
                            <a href="<?php echo base_url('assets/csv/sample_products.csv') ?>" class="btn btn-primary btn-flat pull-right"><i class="fa fa-download"></i> Download Sample File</a>
                            <span class="text-warning">The first line in downloaded csv file should remain as it is. Please do not change the order of columns.</span>
                            <br/>The correct column order is <span class="text-info">(Code,Name,Hsn Sac Code,Unit,Size,Cost, Price, Alert Quantity,Details)</span> &amp; you must follow this.<br>Please make sure the csv file is UTF-8 encoded and not saved with byte order mark (BOM).<p>The images should be uploaded in <strong>uploads</strong> folder.</p>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="category"><?php echo $this->lang->line('product_select_category'); ?> <span class="validation-color">*</span></label>
                            <select class="form-control select2" id="category" name="category" style="width: 100%;">
                              <?php
                                foreach ($category as $row) {
                                  echo "<option value='$row->category_id'".set_select('category',$row->category_id).">$row->category_name</option>";
                                }
                              ?>
                            </select>
                            <span class="validation-color" id="err_category"><?php echo form_error('category'); ?></span>
                          </div>
                          <div class="form-group">
                            <label for="subcategory"><?php echo $this->lang->line('product_select_subcategory'); ?> <span class="validation-color">*</span></label>
                            <select class="form-control select2" id="subcategory" name="subcategory" style="width: 100%;">
                              <option value=""><?php echo $this->lang->line('product_select'); ?></option>
                            </select>
                            <span class="validation-color" id="err_subcategory"><?php echo form_error('subcategory'); ?></span>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group">
                            <label for="csv_file">Upload File</label>
                            <input type="file" data-browse-label="Browse ..." name="csv" class="form-control file" data-show-upload="false" data-show-preview="false" id="csv" required="required" accept=".csv"/>
                          </div>
                          <div class="form-group">
                            <input type="submit" name="import" value="Import"  class="btn btn-primary" />
                          </div>
                        </div>
                      </div>
                    </div>
                  </form>        
                </div>
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
  $('#category').change(function(){
      var id = $(this).val();
      $('#subcategory').html('');
      $.ajax({
          url: "<?php echo base_url('product/getSubcategory') ?>/"+id,
          type: "GET",
          dataType: "JSON",
          success: function(data){
            for(i=0;i<data.length;i++){
              //alert(data[i].sub_category_name);
                $('#subcategory').append('<option value="' + data[i].sub_category_id + '">' + data[i].sub_category_name + '</option>');
             
            }
            //console.log(data);
          } 
        });
    });
</script>
