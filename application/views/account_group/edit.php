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
          <li><a href="<?php echo base_url('accountgroup'); ?>">
               Account Group
              <!-- <?php echo $this->lang->line('client_header'); ?> --></a>
          </li>
          <li class="active">Edit Account Group 
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
                Edit Account Group 
                <!-- <?php echo $this->lang->line('add_client_header'); ?> -->
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-sm-6">
                <div class="row">
                  <form class="form-horizontal" role="form" method="post" action="../edit/<?php echo $id ?>">
                    <div class="panel-body">
                      <div class="form-group">
                        <label  for="branch">Branch <span style="color:red;">*</span></label>
                          <select class="form-control" id="branch" name="branch">
                            <option value="0">--Select--</option>
                            <?php
                              foreach($branch as $name)
                              {
                            ?>
                                <option <?php if($accountgroup->branch_id == $name['branch_id']) { ?>selected <?php } ?> value=<?php echo $name['branch_id']; ?>><?php echo $name['branch_name']; ?></option>
                            <?php
                              }
                            ?>
                          </select>
                      </div>
                        <div class="form-group">
                          <label   for="group_title">Group Title <span style="color:red;">*</span></label>
                            <input type="text" class="form-control" placeholder="Group Title" id="group_title" name="group_title" value="<?php echo $accountgroup->group_title; ?>">
                        </div>
                        <div class="form-group">
                          <label  for="category">Category</label>
                            <select class="form-control" id="category" name="category">
                              <option <?php if($accountgroup->category == "Assets") { ?> selected <?php } ?>value="Assets">Assets</option>
                              <option <?php if($accountgroup->category == "Liabilities") { ?> selected <?php } ?>value="Liabilities">Liabilities</option>
                              <option <?php if($accountgroup->category == "Income") { ?> selected <?php } ?>value="Income">Income</option>
                              <option <?php if($accountgroup->category == "Expense") { ?> selected <?php } ?>value="Expense">Expense</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label   for="opening_balance">Opening Balance Amount</label>
                            <input type="text" class="form-control" placeholder="Opening Balance Amount" id="opening_balance" name="opening_balance" value="<?php echo $accountgroup->opening_balance; ?>">
                        </div>
                        <div class="panel-body">
                          <p>
                            <button class="btn btn-primary" type="submit">Submit</button>
                            <a href="<?php echo base_url(); ?>index.php/accountgroup" class="btn btn-default" type="button">Cancel</a>
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