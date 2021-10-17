<?php 
  $this->load->view('layout/header');
?>
<!-- <script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script> -->

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Create Group 
        <small></small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>    
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-md-6">
          <!-- Horizontal Form -->
          <div class="box box-info">
            <div class="box-header with-border">
              <center><h3 class="box-title">Create Group</h3></center>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <div id="infoMessage"><?php echo $message;?></div>
            <?php echo form_open("auth/create_group",'class="form-horizontal row-border"');?>
              <div class="box-body" style="padding: 20px">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Group Name</label>
                  <div class="col-sm-9">
                    <!-- <input type="text" class="form-control" id="firstname" placeholder="First Name"> -->
                    <?php echo form_input($group_name,'','class="form-control" id="firstname" placeholder="Group Name"');?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">Description</label>
                  <div class="col-sm-9">
                    <!-- <input type="text" class="form-control" id="firstname" placeholder="First Name"> -->
                    <?php echo form_input($description,'','class="form-control" id="lastname" placeholder="Description"');?>
                  </div>
                </div>  
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="button" class="btn btn-default pull-right">Cancel</button>
                &nbsp;&nbsp;
                <?php echo form_submit('submit', lang('create_group_submit_btn'),'class="btn btn-info pull-right"');?>
              </div>
              <!-- /.box-footer -->
            <?php echo form_close();?>
          </div>
        </div>
      </div>
      <!-- /.row -->
      
    </section>
    <!-- /.content -->

  </div>

<?php 
  $this->load->view('layout/footer');
?>












<!-- <h1><?php echo lang('create_group_heading');?></h1>
<p><?php echo lang('create_group_subheading');?></p>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("auth/create_group");?>

      <p>
            <?php echo lang('create_group_name_label', 'group_name');?> <br />
            <?php echo form_input($group_name);?>
      </p>

      <p>
            <?php echo lang('create_group_desc_label', 'description');?> <br />
            <?php echo form_input($description);?>
      </p>

      <p><?php echo form_submit('submit', lang('create_group_submit_btn'));?></p>

<?php echo form_close();?> -->