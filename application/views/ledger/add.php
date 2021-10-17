 <?php
/*defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','manager');
if(!(in_array($this->session->userdata('type'),$p))){
  redirect('auth');
}*/
  $this->load->view('layout/header');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('auth/dashboard'); ?>"><i class="fa fa-dashboard"></i> 
                <!-- Dashboard -->
                <?php echo $this->lang->line('header_dashboard'); ?></a></li>
          <li><a href="<?php echo base_url('ledger'); ?>">
              Ledger
              <?php echo $this->lang->line('client_header'); ?></a>
          </li>
          <li class="active">Add Ledger
              <!-- <?php echo $this->lang->line('add_client_label'); ?> -->
          </li>
        </ol>
      </h5>    
    </section>
      <section class="content">
      <div class="row">
      <!-- right column -->
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">
                Add New Ledger
                <!-- <?php echo $this->lang->line('add_client_header'); ?> -->
              </h3>
            </div>
            <!-- /.box-header -->
            <?php echo $this->session->flashdata('success');?>
            <!-- <?php echo validation_errors();?> -->
            <?php if(isset($error)) { echo $error; }?>
            <div class="box-body">
            <div class="col-sm-6">
              <div class="row">
                <form role="form" id="form" method="post" action="<?php echo base_url('ledger/add_ledger');?>">
                  <div class="panel-body">
                    <div class="form-group">
                      <label  for="branch">Branch <span style="color:red;">*</span></label>
                      <select class="form-control select2" id="branch" name="branch">
                        <option value="0">Select</option>
                        <?php
                            foreach($branch as $name)
                            {
                                echo "<option value='$name[branch_id]' " . set_select('branch', $name['branch_id']) . " >". $name['branch_name']."</option>";
                            }
                        ?>
                      </select>
                      <span class="validation-color" id="err_branch_name"><?php echo form_error('branch'); ?></span>
                    </div>
                    <div class="form-group">
                      <label  for="type">Type <span style="color:red;">*</span></label>
                      <select class="form-control select2" id="type" name="type">
                        <option value="0">Select</option>
                        <option value="Income">Income</option>
                        <option value="Expenditure">Expenditure</option>
                      </select>
                      <span class="validation-color" id="err_branch_name"><?php echo form_error('type'); ?></span>
                    </div>
                    <div class="form-group">
                      <label   for="title">Title <span style="color:red;">*</span></label>
                      <input type="text" class="form-control" placeholder="Title" id="title" name="title" value="<?php echo set_value('title'); ?>">
                      <span class="validation-color" id="err_branch_name"><?php echo form_error('title'); ?></span>
                    </div>
                    <div class="form-group">
                      <label  for="group">Group <span style="color:red;">*</span></label>
                      <select class="form-control select2" id="accountgroup" name="accountgroup">
                          <option value="0">Select</option>
                          <?php
                            foreach($accountgroup as $name1)
                            {
                              echo "<option value='$name1[id]' " . set_select('accountgroup', $name1['id']) . " >". $name1['group_title']."</option>";
                            }
                          ?>
                      </select>
                      <span class="validation-color" id="err_branch_name"><?php echo form_error('accountgroup'); ?></span>
                    </div>
                    <div class="form-group">
                      <label   for="opening_balance">Opening Balance</label>
                      <input type="text" class="form-control" placeholder="Opening Balance" id="opening_balance" name="opening_balance" value="<?php echo set_value('opening_balance'); ?>">
                      <span class="validation-color" id="err_branch_name"><?php echo form_error('opening_balance'); ?></span>
                    </div>
                    <div class="form-group">
                      <label  for="closing_balance">Closing Balance</label>
                      <input type="text" class="form-control" placeholder="Closing Balance" id="closing_balance" name="closing_balance" value="<?php echo set_value('closing_balance'); ?>">
                      <span class="validation-color" id="err_branch_name"><?php echo form_error('closing_balance'); ?></span>
                    </div>
                    <div class="panel-body">
                      <p>
                        <button class="btn btn-info btn-flat" type="submit">Submit</button>
                        <a href="<?php echo base_url(); ?>index.php/ledger" class="btn btn-default btn-flat" type="button">Cancel</a>
                      </p>
                    </div>
                  </div>
                </form>
                </div>
              </div>
        <!-- page end-->
            </div>
          </div>
        </div>
      </div>
        </section>
        <!--body wrapper end-->
  </div>
<?php
  $this->load->view('layout/footer');
?>