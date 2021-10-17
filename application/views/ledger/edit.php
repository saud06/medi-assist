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
          <li class="active">Edit Ledger
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
                Edit Ledger
                <!-- <?php echo $this->lang->line('add_client_header'); ?> -->
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="col-sm-6">
              <div class="row">
                <form role="form" id="form" method="post" action="../edit/<?php echo $id ?>">
                  <div class="panel-body">
                    <div class="form-group">
                      <label  for="branch">Branch <span style="color:red;">*</span></label>
                        <select class="form-control" id="branch" name="branch">
                          <option value="0">--Select--</option>
                          <?php
                            foreach($branch as $name)
                            {
                          ?>
                              <option <?php if($ledger->branch_id == $name['branch_id']) { ?>selected <?php } ?> value=<?php echo $name['branch_id']; ?>><?php echo $name['branch_name']; ?></option>
                          <?php
                            }
                          ?>
                        </select>
                    </div>
                    <div class="form-group">
                      <label  for="type">Type <span style="color:red;">*</span></label>
                        <select class="form-control" id="type" name="type">
                          <option value="0">-- Select --</option>
                          <option <?php if($ledger->type == "Income") { ?> selected <?php } ?>value="Income">Income</option>
                          <option <?php if($ledger->type == "Expenditure") { ?> selected <?php } ?>value="Expenditure">Expenditure</option>
                        </select>
                    </div>
                    <div class="form-group">
                      <label   for="title">Title <span style="color:red;">*</span></label>
                      <input type="text" class="form-control" placeholder="Title" id="title" name="title" value="<?php echo $ledger->title; ?>">
                    </div>
                    <div class="form-group">
                      <label  for="group">Group <span style="color:red;">*</span></label>
                      <select class="form-control" id="accountgroup" name="accountgroup">
                        <option value="0">--Select--</option>
                        <?php
                          foreach($accountgroup as $name1)
                          {
                        ?>
                            <option <?php if($ledger->accountgroup_id == $name1['id']) { ?>selected <?php } ?> value=<?php echo $name1['id']; ?>><?php echo $name1['group_title']; ?></option>
                        <?php
                          }
                        ?>
                      </select>
                        
                    </div>
                    <div class="form-group">
                      <label   for="opening_balance">Opening Balance</label>
                      <input type="text" class="form-control" placeholder="Opening Balance" id="opening_balance" name="opening_balance" value="<?php echo $ledger->opening_balance; ?>"> 
                    </div>
                    <div class="form-group">
                      <label   for="closing_balance">Closing Balance</label>
                      <input type="text" class="form-control" placeholder="Closing Balance" id="closing_balance" name="closing_balance" value="<?php echo $ledger->closing_balance; ?>"> 
                    </div>
                    <div class="panel-body">
                      <p>
                        <button class="btn btn-primary" type="submit">Submit</button>
                        <a href="<?php echo base_url(); ?>index.php/ledger" class="btn btn-default" type="button">Cancel</a>
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