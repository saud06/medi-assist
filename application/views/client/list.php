<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','manager');
if(!(in_array($this->session->userdata('type'),$p))){
  redirect('auth');
}

$this->load->view('layout/header');
?>
<script type="text/javascript">
  function delete_id(id)
  {
     if(confirm('Sure To Remove This Record ?'))
     {
        window.location.href='<?php  echo base_url('client/delete/'); ?>'+id;
     }
  }
</script>
<div class="content-wrapper">
  <?php 
    // $this->load->view('layout/sticky_note');
  ?>

  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
         <ol class="breadcrumb">
          <li><a href="<?php echo base_url('auth/dashboard'); ?>" class="text-black"><i class="fa fa-dashboard">&nbsp;</i><strong><?php echo $this->lang->line('header_dashboard'); ?></strong></a></li>
          <li class="active"><!-- Client -->
              <?php echo $this->lang->line('client_header'); ?>
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
              <h3 class="box-title">
                <!-- List Client -->
                Client List
              </h3>
              <a title="Add New Client" class="btn bg-gray" style="margin: 10px" href="<?php echo base_url('client/add');?>"> 
                <!-- Add New Client -->
                <i class="fa fa-plus" aria-hidden="true"></i>
              </a>
            </div>

            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab">Manufacturer & Supplier List</a></li>
                <li><a href="#tab_2" data-toggle="tab">BD Customer List</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <div class="box-body outer-scroll">
                    <div class="inner-scroll">
                      <div class="row">
                        <div class="col-sm-12">
                          <strong>Client List Filter:</strong> &emsp;

                          <select class="form-control select2" name="country_id" id="country_id" style="width: 15%;">
                            <option value="">All Countries</option>
                            <?php
                              $country = $this->db->get('countries')->result();
                              foreach ($country as $cn){
                            ?>
                                <option value="<?php echo $cn->id; ?>"><?php echo $cn->name; ?></option>
                            <?php
                              }
                            ?>
                          </select> &emsp;

                          <select class="form-control select2" name="category_id1" id="category_id1" style="width: 15%;">
                            <option value="">All Categories</option>
                            <?php
                              $category = $this->db->get('category')->result();
                              foreach ($category as $cat){
                            ?>
                                <option value="<?php echo $cat->category_id; ?>"><?php echo $cat->category_name; ?></option>
                            <?php
                              }
                            ?>
                          </select> &emsp;

                          <select class="form-control select2" name="user_id1" id="user_id1" style="width: 15%;">
                            <option value="">All Responsibles</option>
                            <?php
                              $users = $this->db->get('users')->result();
                              foreach ($users as $user){
                            ?>
                                <option value="<?php echo $user->id; ?>"><?php echo $user->first_name . ' ' . $user->last_name; ?></option>
                            <?php
                              }
                            ?>
                          </select> &emsp;

                          <select class="form-control select2" name="status1" id="status1" style="width: 15%;">
                            <option value="">All Status</option>
                            <option value="Active" selected>Active</option>
                            <option value="Inactive">Inactive</option>
                          </select> &emsp;

                          <button title="Filter Manufacturer & Suppllier List" type="button" id="btn_ajax1" class="btn bg-gray"><i class="fa fa-search" aria-hidden="true"></i></button>&emsp;

                          <div class="btn-group">
                            <button title="Print manufacturer & Supplier List" type="button" class="btn bg-gray gropdown-toggle" data-toggle="dropdown">
                              <i class="fa fa-print" aria-hidden="true"></i>&nbsp;
                              <span class="fa fa-angle-double-down"></span>
                            </button>
                            <ul class="dropdown-menu">
                              <li>
                                <a href="#" target="_blank" onclick="printContent('print')">Print (Default)</a>
                              </li>
                              <li id="pdf">
                                <a href="<?php echo base_url('client/list_pdf/1');?>" target="_blank">PDF (On Letter Head)</a>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <br>

                      <table id="index1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th><!-- No -->
                              <?php echo $this->lang->line('biller_lable_no'); ?>.
                          </th>
                          <th><!-- Company Name -->
                              Company Name
                          </th>
                          <th><!-- Company Phone -->
                              Company Phone
                          </th>
                          <th><!-- Name -->
                              Contact Person
                          </th>
                          <th><!-- Phone -->
                              Phone
                          </th>
                          <th><!-- Email Address -->
                              <?php echo $this->lang->line('biller_lable_email'); ?>
                          </th>
                          <th><!-- Client Address -->
                              Client Address
                          </th>
                          <th><!-- Type -->
                              Type
                          </th>
                          <th><!-- Category -->
                              Category
                          </th>
                          <th><!-- Responsible Person -->
                              Responsible Person
                          </th>
                          <?php if($this->session->userdata('type') == 'admin'){ ?>
                            <th><!-- Actions -->
                                <?php echo $this->lang->line('biller_lable_action'); ?>
                            </th>
                          <?php }?>
                        </tr>
                        </thead>
                        <tbody id="records1">
                          <?php
                            foreach ($data as $row) {
                              if($row->ctypname != 'Customer'){
                                $id= $row->client_id;
                          ?>
                                <tr>
                                  <td></td>
                                  <td><?php echo $row->company_name; ?></td>
                                  <td><?php echo $row->company_phone ?></td>
                                  <td><?php echo $row->contact_person ?></td>
                                  <td><?php echo $row->contact_person_phone ?></td>
                                  <td><?php echo $row->email ?></td>
                                  <td>
                                    <?php
                                      if(!empty($row->house_no)) echo $row->house_no . ', ';
                                      if(!empty($row->road_no)) echo $row->road_no . ',<br>';
                                      if(!empty($row->loc_city)){ 
                                        if(!empty($row->loc_area)){
                                          echo $row->loc_area . ', ';
                                        }
                                        echo $row->loc_city . ', ';
                                      }
                                      else{
                                        if(!empty($row->ctname)){
                                          echo $row->ctname . ', ';
                                        }
                                        if(!empty($row->stname)){
                                          echo $row->stname;
                                        }
                                      }
                                      if(!empty($row->zip_code)){
                                        echo ' ' . $row->zip_code;
                                      }
                                      if(empty($row->house_no) && empty($row->road_no) && empty($row->loc_city) && empty($row->loc_area) && empty($row->ctname) && empty($row->stname) && empty($row->zip_code)){
                                        echo $row->cname;
                                      }
                                      else{
                                        echo ', ' . $row->cname;
                                      }
                                    ?>
                                  </td>
                                  <td><?php echo $row->ctypname ?></td>
                                  <td>
                                    <?php 
                                      $this->db->where('client_id', $id);
                                      $cat_id = $this->db->get('client')->result_array();
                                      $var = $cat_id[0]['category_id'];
                                      $cat_idd = explode(",", $var);

                                      $cat_data = array();
                                      foreach ($cat_idd as $key => $value) {
                                        $this->db->where('category_id', $value);
                                        $categories = $this->db->get('category')->result_array();
                                        
                                        array_push($cat_data, $categories[0]['category_name']);
                                      }

                                      foreach ($cat_data as $key => $value) {
                                        echo ($key+1) . '. ' . $value . '<br>';
                                      }
                                    ?>
                                  </td>
                                  <td>
                                    <?php 
                                      $this->db->where('client_id', $id);
                                      $res_id = $this->db->get('client')->result_array();
                                      $var = $res_id[0]['responsible_person_id'];
                                      $res_idd = explode(",", $var);

                                      $res_data = array();
                                      foreach ($res_idd as $key => $value) {
                                        $this->db->where('id', $value);
                                        $responsible_persons = $this->db->get('users')->result_array();
                                        
                                        if($responsible_persons){
                                          array_push($res_data, $responsible_persons[0]['first_name'] . ' ' . $responsible_persons[0]['last_name']);
                                        }
                                      }

                                      foreach ($res_data as $key => $value) {
                                        echo ($key+1) . '. ' . $value . '<br>';
                                      }
                                    ?>
                                  </td>
                                  <?php if($this->session->userdata('type') == 'admin'){ ?>
                                    <td>
                                      <div class="dropdown">
                                        <button title="Action" type="button" class="btn btn-sm bg-gray gropdown-toggle" data-toggle="dropdown">
                                          <i class="fa fa-cog" aria-hidden="true"></i>&nbsp;
                                          <span class="fa fa-angle-double-down"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                          <li>
                                            <a href="<?php echo base_url('client/edit/'); ?><?php echo $id; ?>"><i class="fa fa-edit"></i>Edit</a>
                                          </li>
                                          <li>
                                            <a href="javascript:delete_id(<?php echo $id;?>)"><i class="fa fa-trash-o"></i>Delete</a>
                                          </li>
                                        </ul>
                                      </div>
                                    </td>
                                  <?php }?>
                                </tr>
                          <?php
                              }
                            }
                          ?>
                        </tbody>
                        <tfoot>
                        <tr>
                          <th><!-- No -->
                              <?php echo $this->lang->line('biller_lable_no'); ?>.
                          </th>
                          <th><!-- Company Name -->
                              Company Name
                          </th>
                          <th><!-- Company Phone -->
                              Company Phone
                          </th>
                          <th><!-- Name -->
                              Contact Person
                          </th>
                          <th><!-- Phone -->
                              Phone
                          </th>
                          <th><!-- Email Address -->
                              <?php echo $this->lang->line('biller_lable_email'); ?>
                          </th>
                          <th><!-- Client Address -->
                              Client Address
                          </th>
                          <th><!-- Type -->
                              Type
                          </th>
                          <th><!-- Category -->
                              Category
                          </th>
                          <th><!-- Responsible Person -->
                              Responsible Person
                          </th>
                          <?php if($this->session->userdata('type') == 'admin'){ ?>
                            <th><!-- Actions -->
                                <?php echo $this->lang->line('biller_lable_action'); ?>
                            </th>
                          <?php }?>
                        </tr>
                        </tfoot>
                      </table>

                      <div style="display: none;" id="print">
                        <div id="header" class="box-header with-border" style="text-align: center; display: none">
                          <!-- <img width="300" height="100" src="<?php echo base_url().'assets/images/winmarkFinal.png'; ?>"><br>
                          <hr> -->

                          <h3 class="box-title">
                            Manufacturer & Supplier List
                          </h3>
                          <br><br>

                          <table id="pindex1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                              <th><!-- No -->
                                  <?php echo $this->lang->line('biller_lable_no'); ?>.
                              </th>
                              <th><!-- Company Name -->
                                  Company Name
                              </th>
                              <th><!-- Company Phone -->
                                  Company Phone
                              </th>
                              <th><!-- Name -->
                                  Contact Person
                              </th>
                              <th><!-- Phone -->
                                  Phone
                              </th>
                              <th><!-- Email Address -->
                                  <?php echo $this->lang->line('biller_lable_email'); ?>
                              </th>
                              <th><!-- Client Address -->
                                  Client Address
                              </th>
                              <th><!-- Type -->
                                  Type
                              </th>
                              <th><!-- Category -->
                                  Category
                              </th>
                              <th><!-- Responsible Person -->
                                  Responsible Person
                              </th>
                            </tr>
                            </thead>
                            <tbody id="precords1">
                              <?php
                                $counter = 0;
                                foreach ($data as $row) {
                                  if($row->ctypname != 'Customer'){
                                    $id= $row->client_id;
                              ?>
                                    <tr>
                                      <td><?php echo $counter+1; ?></td>
                                      <td><?php echo $row->company_name; ?></td>
                                      <td><?php echo $row->company_phone ?></td>
                                      <td><?php echo $row->contact_person ?></td>
                                      <td><?php echo $row->contact_person_phone ?></td>
                                      <td><?php echo $row->email ?></td>
                                      <td>
                                        <?php
                                          if(!empty($row->house_no)) echo $row->house_no . ', ';
                                          if(!empty($row->road_no)) echo $row->road_no . ',<br>';
                                          if(!empty($row->loc_city)){ 
                                            if(!empty($row->loc_area)){
                                              echo $row->loc_area . ', ';
                                            }
                                            echo $row->loc_city . ', ';
                                          }
                                          else{
                                            if(!empty($row->ctname)){
                                              echo $row->ctname . ', ';
                                            }
                                            if(!empty($row->stname)){
                                              echo $row->stname;
                                            }
                                          }
                                          if(!empty($row->zip_code)){
                                            echo ' ' . $row->zip_code;
                                          }
                                          if(empty($row->house_no) && empty($row->road_no) && empty($row->loc_city) && empty($row->loc_area) && empty($row->ctname) && empty($row->stname) && empty($row->zip_code)){
                                            echo $row->cname;
                                          }
                                          else{
                                            echo ', ' . $row->cname;
                                          }
                                        ?>
                                      </td>
                                      <td><?php echo $row->ctypname ?></td>
                                      <td>
                                        <?php 
                                          $this->db->where('client_id', $id);
                                          $cat_id = $this->db->get('client')->result_array();
                                          $var = $cat_id[0]['category_id'];
                                          $cat_idd = explode(",", $var);

                                          $cat_data = array();
                                          foreach ($cat_idd as $key => $value) {
                                            $this->db->where('category_id', $value);
                                            $categories = $this->db->get('category')->result_array();
                                            
                                            array_push($cat_data, $categories[0]['category_name']);
                                          }

                                          foreach ($cat_data as $key => $value) {
                                            echo ($key+1) . '. ' . $value . '<br>';
                                          }
                                        ?>
                                      </td>
                                      <td>
                                        <?php 
                                          $this->db->where('client_id', $id);
                                          $res_id = $this->db->get('client')->result_array();
                                          $var = $res_id[0]['responsible_person_id'];
                                          $res_idd = explode(",", $var);

                                          $res_data = array();
                                          foreach ($res_idd as $key => $value) {
                                            $this->db->where('id', $value);
                                            $responsible_persons = $this->db->get('users')->result_array();
                                            
                                            if($responsible_persons){
                                              array_push($res_data, $responsible_persons[0]['first_name'] . ' ' . $responsible_persons[0]['last_name']);
                                            }
                                          }

                                          foreach ($res_data as $key => $value) {
                                            echo ($key+1) . '. ' . $value . '<br>';
                                          }
                                        ?>
                                      </td>
                                    </tr>
                              <?php
                                    $counter++;
                                  }
                                }
                              ?>
                            </tbody>
                            <tfoot>
                            <tr>
                              <th><!-- No -->
                                  <?php echo $this->lang->line('biller_lable_no'); ?>.
                              </th>
                              <th><!-- Company Name -->
                                  Company Name
                              </th>
                              <th><!-- Company Phone -->
                                  Company Phone
                              </th>
                              <th><!-- Name -->
                                  Contact Person
                              </th>
                              <th><!-- Phone -->
                                  Phone
                              </th>
                              <th><!-- Email Address -->
                                  <?php echo $this->lang->line('biller_lable_email'); ?>
                              </th>
                              <th><!-- Client Address -->
                                  Client Address
                              </th>
                              <th><!-- Type -->
                                  Type
                              </th>
                              <th><!-- Category -->
                                  Category
                              </th>
                              <th><!-- Responsible Person -->
                                  Responsible Person
                              </th>
                            </tr>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                  <!-- /.box-header -->
                  <div class="box-body outer-scroll">
                    <div class="inner-scroll">
                      <div class="row">
                        <div class="col-sm-12">
                          <strong>Client List Filter:</strong> &emsp;

                          <select class="form-control select2" name="client_id" id="client_id" style="width: 15%;">
                            <option value="">All Clients</option>
                            <?php
                              foreach ($data as $cl){
                                if($cl->ctypname == 'Customer'){
                            ?>
                                  <option value="<?php echo $cl->client_id; ?>"><?php echo $cl->company_name; ?></option>
                            <?php
                                }
                              }
                            ?>
                          </select> &emsp;

                          <select class="form-control select2" name="category_id" id="category_id" style="width: 15%;">
                            <option value="">All Categories</option>
                            <?php
                              $category = $this->db->get('category')->result();
                              foreach ($category as $cat){
                            ?>
                                <option value="<?php echo $cat->category_id; ?>"><?php echo $cat->category_name; ?></option>
                            <?php
                              }
                            ?>
                          </select> &emsp;

                          <select class="form-control select2" name="user_id" id="user_id" style="width: 15%;">
                            <option value="">All Responsibles</option>
                            <?php
                              $users = $this->db->get('users')->result();
                              foreach ($users as $user){
                            ?>
                                <option value="<?php echo $user->id; ?>"><?php echo $user->first_name . ' ' . $user->last_name; ?></option>
                            <?php
                              }
                            ?>
                          </select> &emsp;

                          <select class="form-control select2" name="status" id="status" style="width: 15%;">
                            <option value="">All Status</option>
                            <option value="Active" selected>Active</option>
                            <option value="Inactive">Inactive</option>
                          </select> &emsp;

                          <button title="Filter BD Customer List" type="button" id="btn_ajax" class="btn bg-gray"><i class="fa fa-search" aria-hidden="true"></i></button>&emsp;

                          <div class="btn-group">
                            <button title="Print BD Customer List" type="button" class="btn bg-gray gropdown-toggle" data-toggle="dropdown">
                              <i class="fa fa-print" aria-hidden="true"></i>&nbsp;
                              <span class="fa fa-angle-double-down"></span>
                            </button>
                            <ul class="dropdown-menu">
                              <li>
                                <a href="#" target="_blank" onclick="printContent2('print2')">Print (Default)</a>
                              </li>
                              <li id="pdf2">
                                <a href="<?php echo base_url('client/list_pdf/2');?>" target="_blank">PDF (On Letter Head)</a>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                      <br>

                      <table id="index" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                          <th><!-- No -->
                              <?php echo $this->lang->line('biller_lable_no'); ?>.
                          </th>
                          <th><!-- Company Name -->
                              Company Name
                          </th>
                          <th><!-- Company Phone -->
                              Company Phone
                          </th>
                          <th><!-- Name -->
                              Contact Person
                          </th>
                          <th><!-- Phone -->
                              Phone
                          </th>
                          <th><!-- Email Address -->
                              <?php echo $this->lang->line('biller_lable_email'); ?>
                          </th>
                          <th><!-- Client Address -->
                              Client Address
                          </th>
                          <th><!-- Type -->
                              Type
                          </th>
                          <th><!-- Category -->
                              Category
                          </th>
                          <th><!-- Responsible Person -->
                              Responsible Person
                          </th>
                          <?php if($this->session->userdata('type') == 'admin'){ ?>
                            <th><!-- Actions -->
                                <?php echo $this->lang->line('biller_lable_action'); ?>
                            </th>
                          <?php }?>
                        </tr>
                        </thead>
                        <tbody id="records">
                          <?php
                            foreach ($data as $row) {
                              if($row->ctypname == 'Customer'){
                                $id= $row->client_id;
                          ?>
                                <tr>
                                  <td></td>
                                  <td><?php echo $row->company_name; ?></td>
                                  <td><?php echo $row->company_phone ?></td>
                                  <td><?php echo $row->contact_person ?></td>
                                  <td><?php echo $row->contact_person_phone ?></td>
                                  <td><?php echo $row->email ?></td>
                                  <td>
                                    <?php
                                      if(!empty($row->house_no)) echo $row->house_no . ', ';
                                      if(!empty($row->road_no)) echo $row->road_no . ',<br>';
                                      if(!empty($row->loc_city)){ 
                                        if(!empty($row->loc_area)){
                                          echo $row->loc_area . ', ';
                                        }
                                        echo $row->loc_city . ', ';
                                      }
                                      else{
                                        if(!empty($row->ctname)){
                                          echo $row->ctname . ', ';
                                        }
                                        if(!empty($row->stname)){
                                          echo $row->stname;
                                        }
                                      }
                                      if(!empty($row->zip_code)){
                                        echo ' ' . $row->zip_code;
                                      }
                                      if(empty($row->house_no) && empty($row->road_no) && empty($row->loc_city) && empty($row->loc_area) && empty($row->ctname) && empty($row->stname) && empty($row->zip_code)){
                                        echo $row->cname;
                                      }
                                      else{
                                        echo ', ' . $row->cname;
                                      }
                                    ?>
                                  </td>
                                  <td><?php echo $row->ctypname ?></td>
                                  <td>
                                    <?php 
                                      $this->db->where('client_id', $id);
                                      $cat_id = $this->db->get('client')->result_array();
                                      $var = $cat_id[0]['category_id'];
                                      $cat_idd = explode(",", $var);

                                      $cat_data = array();
                                      foreach ($cat_idd as $key => $value) {
                                        $this->db->where('category_id', $value);
                                        $categories = $this->db->get('category')->result_array();
                                        
                                        array_push($cat_data, $categories[0]['category_name']);
                                      }

                                      foreach ($cat_data as $key => $value) {
                                        echo ($key+1) . '. ' . $value . '<br>';
                                      }
                                    ?>
                                  </td>
                                  <td>
                                    <?php 
                                      $this->db->where('client_id', $id);
                                      $res_id = $this->db->get('client')->result_array();
                                      $var = $res_id[0]['responsible_person_id'];
                                      $res_idd = explode(",", $var);

                                      $res_data = array();
                                      foreach ($res_idd as $key => $value) {
                                        $this->db->where('id', $value);
                                        $responsible_persons = $this->db->get('users')->result_array();
                                        
                                        if($responsible_persons){
                                          array_push($res_data, $responsible_persons[0]['first_name'] . ' ' . $responsible_persons[0]['last_name']);
                                        }
                                      }

                                      foreach ($res_data as $key => $value) {
                                        echo ($key+1) . '. ' . $value . '<br>';
                                      }
                                    ?>
                                  </td>
                                  <?php if($this->session->userdata('type') == 'admin'){ ?>
                                    <td>
                                      <div class="dropdown">
                                        <button title="Action" type="button" class="btn btn-sm bg-gray gropdown-toggle" data-toggle="dropdown">
                                          <i class="fa fa-cog" aria-hidden="true"></i>&nbsp;
                                          <span class="fa fa-angle-double-down"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                          <li>
                                            <a href="<?php echo base_url('client/edit/'); ?><?php echo $id; ?>"><i class="fa fa-edit"></i>Edit</a>
                                          </li>
                                          <li>
                                            <a href="javascript:delete_id(<?php echo $id;?>)"><i class="fa fa-trash-o"></i>Delete</a>
                                          </li>
                                        </ul>
                                      </div>
                                    </td>
                                  <?php }?>
                                </tr>
                          <?php
                              }
                            }
                          ?>
                        </tbody>
                        <tfoot>
                        <tr>
                          <th><!-- No -->
                              <?php echo $this->lang->line('biller_lable_no'); ?>.
                          </th>
                          <th><!-- Company Name -->
                              Company Name
                          </th>
                          <th><!-- Company Phone -->
                              Company Phone
                          </th>
                          <th><!-- Name -->
                              Contact Person
                          </th>
                          <th><!-- Phone -->
                              Phone
                          </th>
                          <th><!-- Email Address -->
                              <?php echo $this->lang->line('biller_lable_email'); ?>
                          </th>
                          <th><!-- Client Address -->
                              Client Address
                          </th>
                          <th><!-- Type -->
                              Type
                          </th>
                          <th><!-- Category -->
                              Category
                          </th>
                          <th><!-- Responsible Person -->
                              Responsible Person
                          </th>
                          <?php if($this->session->userdata('type') == 'admin'){ ?>
                            <th><!-- Actions -->
                                <?php echo $this->lang->line('biller_lable_action'); ?>
                            </th>
                          <?php }?>
                        </tr>
                        </tfoot>
                      </table>

                      <div style="display: none;" id="print2">
                        <div id="header2" class="box-header with-border" style="text-align: center; display: none">
                          <!-- <img width="300" height="100" src="<?php echo base_url().'assets/images/winmarkFinal.png'; ?>"><br>
                          <hr> -->

                          <h3 class="box-title">
                            BD Customer List
                          </h3>
                          <br><br>

                          <table id="pindex" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                              <th><!-- No -->
                                  <?php echo $this->lang->line('biller_lable_no'); ?>.
                              </th>
                              <th><!-- Company Name -->
                                  Company Name
                              </th>
                              <th><!-- Company Phone -->
                                  Company Phone
                              </th>
                              <th><!-- Name -->
                                  Contact Person
                              </th>
                              <th><!-- Phone -->
                                  Phone
                              </th>
                              <th><!-- Email Address -->
                                  <?php echo $this->lang->line('biller_lable_email'); ?>
                              </th>
                              <th><!-- Client Address -->
                                  Client Address
                              </th>
                              <th><!-- Type -->
                                  Type
                              </th>
                              <th><!-- Category -->
                                  Category
                              </th>
                              <th><!-- Responsible Person -->
                                  Responsible Person
                              </th>
                            </tr>
                            </thead>
                            <tbody id="precords">
                              <?php
                                $counter2 = 0;
                                foreach ($data as $row) {
                                  if($row->ctypname == 'Customer'){
                                    $id= $row->client_id;
                              ?>
                                    <tr>
                                      <td><?php echo $counter2+1; ?></td>
                                      <td><?php echo $row->company_name; ?></td>
                                      <td><?php echo $row->company_phone ?></td>
                                      <td><?php echo $row->contact_person ?></td>
                                      <td><?php echo $row->contact_person_phone ?></td>
                                      <td><?php echo $row->email ?></td>
                                      <td>
                                        <?php
                                          if(!empty($row->house_no)) echo $row->house_no . ', ';
                                          if(!empty($row->road_no)) echo $row->road_no . ',<br>';
                                          if(!empty($row->loc_city)){ 
                                            if(!empty($row->loc_area)){
                                              echo $row->loc_area . ', ';
                                            }
                                            echo $row->loc_city . ', ';
                                          }
                                          else{
                                            if(!empty($row->ctname)){
                                              echo $row->ctname . ', ';
                                            }
                                            if(!empty($row->stname)){
                                              echo $row->stname;
                                            }
                                          }
                                          if(!empty($row->zip_code)){
                                            echo ' ' . $row->zip_code;
                                          }
                                          if(empty($row->house_no) && empty($row->road_no) && empty($row->loc_city) && empty($row->loc_area) && empty($row->ctname) && empty($row->stname) && empty($row->zip_code)){
                                            echo $row->cname;
                                          }
                                          else{
                                            echo ', ' . $row->cname;
                                          }
                                        ?>
                                      </td>
                                      <td><?php echo $row->ctypname ?></td>
                                      <td>
                                        <?php 
                                          $this->db->where('client_id', $id);
                                          $cat_id = $this->db->get('client')->result_array();
                                          $var = $cat_id[0]['category_id'];
                                          $cat_idd = explode(",", $var);

                                          $cat_data = array();
                                          foreach ($cat_idd as $key => $value) {
                                            $this->db->where('category_id', $value);
                                            $categories = $this->db->get('category')->result_array();
                                            
                                            array_push($cat_data, $categories[0]['category_name']);
                                          }

                                          foreach ($cat_data as $key => $value) {
                                            echo ($key+1) . '. ' . $value . '<br>';
                                          }
                                        ?>
                                      </td>
                                      <td>
                                        <?php 
                                          $this->db->where('client_id', $id);
                                          $res_id = $this->db->get('client')->result_array();
                                          $var = $res_id[0]['responsible_person_id'];
                                          $res_idd = explode(",", $var);

                                          $res_data = array();
                                          foreach ($res_idd as $key => $value) {
                                            $this->db->where('id', $value);
                                            $responsible_persons = $this->db->get('users')->result_array();
                                            
                                            if($responsible_persons){
                                              array_push($res_data, $responsible_persons[0]['first_name'] . ' ' . $responsible_persons[0]['last_name']);
                                            }
                                          }

                                          foreach ($res_data as $key => $value) {
                                            echo ($key+1) . '. ' . $value . '<br>';
                                          }
                                        ?>
                                      </td>
                                    </tr>
                              <?php
                                    $counter2++;
                                  }
                                }
                              ?>
                            </tbody>
                            <tfoot>
                            <tr>
                              <th><!-- No -->
                                  <?php echo $this->lang->line('biller_lable_no'); ?>.
                              </th>
                              <th><!-- Company Name -->
                                  Company Name
                              </th>
                              <th><!-- Company Phone -->
                                  Company Phone
                              </th>
                              <th><!-- Name -->
                                  Contact Person
                              </th>
                              <th><!-- Phone -->
                                  Phone
                              </th>
                              <th><!-- Email Address -->
                                  <?php echo $this->lang->line('biller_lable_email'); ?>
                              </th>
                              <th><!-- Client Address -->
                                  Client Address
                              </th>
                              <th><!-- Type -->
                                  Type
                              </th>
                              <th><!-- Category -->
                                  Category
                              </th>
                              <th><!-- Responsible Person -->
                                  Responsible Person
                              </th>
                            </tr>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.tab-pane -->
              </div>
              <!-- /.tab-content -->
            </div>
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

<script type="text/javascript">
  $('#btn_ajax').click(function(){
    var client_id = $('#client_id').val();
    var category_id = $('#category_id').val();
    var user_id = $('#user_id').val();
    var status = $('#status').val();
    if(!client_id) client_id = 0;
    if(!category_id) category_id = 0;
    if(!user_id) user_id = 0;
    if(!status) status = 0;

    $.ajax({
      url: "<?php echo base_url('client/filter_client') ?>/",
      type: "POST",
      dataType: "JSON",
      data : {
        client_id: client_id,
        category_id: category_id,
        user_id: user_id,
        status: status
      },
      success: function (response) {
        var table = $('#index').DataTable();
        table.destroy();
        $('#records').empty();

        var trHTML = '';
        $.each(response.data, function (i, item) {
            trHTML += '<tr>';
            trHTML += '<td>'+(i+1)+'</td>';
            trHTML += '<td>' + item.company_name + '</td>';
            trHTML += '<td>' + item.company_phone + '</td>';
            trHTML += '<td>' + item.contact_person + '</td>';
            trHTML += '<td>' + item.contact_person_phone + '</td>';
            trHTML += '<td>' + item.email + '</td>';

            trHTML += '<td>';
              if(item.house_no) trHTML += item.house_no + ', ';
              if(item.road_no) trHTML += item.road_no + ',<br>';
              if(item.loc_city){ 
                if(item.loc_area){
                  trHTML += item.loc_area + ', ';
                }
                trHTML += item.loc_city + ', ';
              }
              else{
                if(item.ctname){
                  trHTML += item.ctname + ', ';
                }
                if(item.stname){
                  trHTML += item.stname;
                }
              }
              if(item.zip_code){
                trHTML += ' ' + item.zip_code;
              }
              if(!item.house_no && !item.road_no && !item.loc_city && !item.loc_area && !item.ctname && !item.stname && !item.zip_code){
                trHTML += item.cname;
              }
              else{
                trHTML += ', ' + item.cname;
              }
            trHTML += '</td>';

            trHTML += '<td>' + item.ctypname + '</td>';
            trHTML += '<td>';
              var categories = item.categories;
              for(i=0; i<categories.length; i++){
                trHTML += (i+1) + '. ' + categories[i].category_name + '<br>';
              }
            trHTML += '</td>';
            trHTML += '<td>';
              var responsible_persons = item.responsible_persons;
              for(i=0; i<responsible_persons.length; i++){
                trHTML += (i+1) + '. ' + responsible_persons[i].first_name + ' ' + responsible_persons[i].last_name + '<br>';
              }
            trHTML += '</td>';
            var type = '<?php echo $this->session->userdata("type") ?>';
            if(type == 'admin'){
              trHTML += '<td>';
                trHTML += '<div class="dropdown"><button title="Action" type="button" class="btn btn-sm bg-gray gropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog" aria-hidden="true"></i> &nbsp;<span class="fa fa-angle-double-down"></span></button><ul class="dropdown-menu"><li><a href="<?php echo base_url('client/edit/'); ?>' + item.client_id + '"><i class="fa fa-edit"></i>Edit</a></li><li><a href="javascript:delete_id(' + item.client_id + ')"><i class="fa fa-trash-o"></i>Delete</a></li></ul></div></td>';
              trHTML += '</td>'; 
            }
            trHTML += '</tr>';
        });
        
        $('#records').append(trHTML);
        $('#index').DataTable({
          "columnDefs": [ {
              "searchable": false,
              "orderable": false,
              "targets": 0
          } ],
          "order": [[ 1, 'asc' ]],
          "pageLength": 100
        });

        $('#precords').empty();

        var trHTML = '';
        $.each(response.data, function (i, item) {
            trHTML += '<tr>';
            trHTML += '<td>'+(i+1)+'</td>';
            trHTML += '<td>' + item.company_name + '</td>';
            trHTML += '<td>' + item.company_phone + '</td>';
            trHTML += '<td>' + item.contact_person + '</td>';
            trHTML += '<td>' + item.contact_person_phone + '</td>';
            trHTML += '<td>' + item.email + '</td>';

            trHTML += '<td>';
              if(item.house_no) trHTML += item.house_no + ', ';
              if(item.road_no) trHTML += item.road_no + ',<br>';
              if(item.loc_city){ 
                if(item.loc_area){
                  trHTML += item.loc_area + ', ';
                }
                trHTML += item.loc_city + ', ';
              }
              else{
                if(item.ctname){
                  trHTML += item.ctname + ', ';
                }
                if(item.stname){
                  trHTML += item.stname;
                }
              }
              if(item.zip_code){
                trHTML += ' ' + item.zip_code;
              }
              if(!item.house_no && !item.road_no && !item.loc_city && !item.loc_area && !item.ctname && !item.stname && !item.zip_code){
                trHTML += item.cname;
              }
              else{
                trHTML += ', ' + item.cname;
              }
            trHTML += '</td>';

            trHTML += '<td>' + item.ctypname + '</td>';
            trHTML += '<td>';
              var categories = item.categories;
              for(i=0; i<categories.length; i++){
                trHTML += (i+1) + '. ' + categories[i].category_name + '<br>';
              }
            trHTML += '</td>';
            trHTML += '<td>';
              var responsible_persons = item.responsible_persons;
              for(i=0; i<responsible_persons.length; i++){
                trHTML += (i+1) + '. ' + responsible_persons[i].first_name + ' ' + responsible_persons[i].last_name + '<br>';
              }
            trHTML += '</td>';
            trHTML += '</tr>';
        });
        
        $('#precords').append(trHTML);
      }
    });

    $("#pdf2").html('<a href="<?php echo base_url('client/filterClientPDF2/');?>' + client_id + '/' + category_id + '/' + user_id + '/' + status + '" target="_blank">PDF (On Letter Heads)</a>');
  });

  $('#btn_ajax1').click(function(){
    var country_id = $('#country_id').val();
    var category_id = $('#category_id1').val();
    var user_id = $('#user_id1').val();
    var status = $('#status1').val();
    if(!country_id) country_id = 0;
    if(!category_id) category_id = 0;
    if(!user_id) user_id = 0;
    if(!status) status = 0;

    $.ajax({
      url: "<?php echo base_url('client/filter_client2') ?>/",
      type: "POST",
      dataType: "JSON",
      data : {
        country_id: country_id,
        category_id: category_id,
        user_id: user_id,
        status: status
      },
      success: function (response) {
        var table = $('#index1').DataTable();
        table.destroy();
        $('#records1').empty();

        var trHTML = '';
        $.each(response.data, function (i, item) {
            trHTML += '<tr>';
            trHTML += '<td>'+(i+1)+'</td>';
            trHTML += '<td>' + item.company_name + '</td>';
            trHTML += '<td>' + item.company_phone + '</td>';
            trHTML += '<td>' + item.contact_person + '</td>';
            trHTML += '<td>' + item.contact_person_phone + '</td>';
            trHTML += '<td>' + item.email + '</td>';

            trHTML += '<td>';
              if(item.house_no) trHTML += item.house_no + ', ';
              if(item.road_no) trHTML += item.road_no + ',<br>';
              if(item.loc_city){ 
                if(item.loc_area){
                  trHTML += item.loc_area + ', ';
                }
                trHTML += item.loc_city + ', ';
              }
              else{
                if(item.ctname){
                  trHTML += item.ctname + ', ';
                }
                if(item.stname){
                  trHTML += item.stname;
                }
              }
              if(item.zip_code){
                trHTML += ' ' + item.zip_code;
              }
              if(!item.house_no && !item.road_no && !item.loc_city && !item.loc_area && !item.ctname && !item.stname && !item.zip_code){
                trHTML += item.cname;
              }
              else{
                trHTML += ', ' + item.cname;
              }
            trHTML += '</td>';

            trHTML += '<td>' + item.ctypname + '</td>';
            trHTML += '<td>';
              var categories = item.categories;
              for(i=0; i<categories.length; i++){
                trHTML += (i+1) + '. ' + categories[i].category_name + '<br>';
              }
            trHTML += '</td>';
            trHTML += '<td>';
              var responsible_persons = item.responsible_persons;
              for(i=0; i<responsible_persons.length; i++){
                trHTML += (i+1) + '. ' + responsible_persons[i].first_name + ' ' + responsible_persons[i].last_name + '<br>';
              }
            trHTML += '</td>';
            var type = '<?php echo $this->session->userdata("type") ?>';
            if(type == 'admin'){
              trHTML += '<td>';
                trHTML += '<div class="dropdown"><button title="Action" type="button" class="btn btn-sm bg-gray gropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog" aria-hidden="true"></i> &nbsp;<span class="fa fa-angle-double-down"></span></button><ul class="dropdown-menu"><li><a href="<?php echo base_url('client/edit/'); ?>' + item.client_id + '"><i class="fa fa-edit"></i>Edit</a></li><li><a href="javascript:delete_id(' + item.client_id + ')"><i class="fa fa-trash-o"></i>Delete</a></li></ul></div></td>';
              trHTML += '</td>'; 
            }
            trHTML += '</tr>';
        });
        
        $('#records1').append(trHTML);
        $('#index1').DataTable({
          "columnDefs": [ {
              "searchable": false,
              "orderable": false,
              "targets": 0
          } ],
          "order": [[ 1, 'asc' ]],
          "pageLength": 100
        });

        $('#precords1').empty();

        var trHTML = '';
        $.each(response.data, function (i, item) {
            trHTML += '<tr>';
            trHTML += '<td>'+(i+1)+'</td>';
            trHTML += '<td>' + item.company_name + '</td>';
            trHTML += '<td>' + item.company_phone + '</td>';
            trHTML += '<td>' + item.contact_person + '</td>';
            trHTML += '<td>' + item.contact_person_phone + '</td>';
            trHTML += '<td>' + item.email + '</td>';

            trHTML += '<td>';
              if(item.house_no) trHTML += item.house_no + ', ';
              if(item.road_no) trHTML += item.road_no + ',<br>';
              if(item.loc_city){ 
                if(item.loc_area){
                  trHTML += item.loc_area + ', ';
                }
                trHTML += item.loc_city + ', ';
              }
              else{
                if(item.ctname){
                  trHTML += item.ctname + ', ';
                }
                if(item.stname){
                  trHTML += item.stname;
                }
              }
              if(item.zip_code){
                trHTML += ' ' + item.zip_code;
              }
              if(!item.house_no && !item.road_no && !item.loc_city && !item.loc_area && !item.ctname && !item.stname && !item.zip_code){
                trHTML += item.cname;
              }
              else{
                trHTML += ', ' + item.cname;
              }
            trHTML += '</td>';

            trHTML += '<td>' + item.ctypname + '</td>';
            trHTML += '<td>';
              var categories = item.categories;
              for(i=0; i<categories.length; i++){
                trHTML += (i+1) + '. ' + categories[i].category_name + '<br>';
              }
            trHTML += '</td>';
            trHTML += '<td>';
              var responsible_persons = item.responsible_persons;
              for(i=0; i<responsible_persons.length; i++){
                trHTML += (i+1) + '. ' + responsible_persons[i].first_name + ' ' + responsible_persons[i].last_name + '<br>';
              }
            trHTML += '</td>';
            trHTML += '</tr>';
        });
        
        $('#precords1').append(trHTML);
      }
    });

    $("#pdf").html('<a href="<?php echo base_url('client/filterClientPDF/');?>' + country_id + '/' + category_id + '/' + user_id + '/' + status + '" target="_blank">PDF (On Letter Heads)</a>');
  });

   function printContent(el){ 
    $('#header').show();
    
    // $('.table-bordered th').eq(0).css("min-width", "");
    $('.table-bordered').css("font-size", "12px");
    $('.table-bordered tfoot').css( "display", "table-row-group");
    $(".table-bordered td, .table-bordered th").each(function(){ $(this).css("text-align", "center") });
    $(".table-bordered td, .table-bordered th").each(function(){ $(this).css("vertical-align", "middle") });
    //var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    //document.body.innerHTML = restorepage;
  }

  function printContent2(el){
    $('#header2').show();
    
    // $('.table-bordered th').eq(0).css("min-width", "");
    $('.table-bordered').css("font-size", "12px");
    $('.table-bordered tfoot').css( "display", "table-row-group");
    $(".table-bordered td, .table-bordered th").each(function(){ $(this).css("text-align", "center") });
    $(".table-bordered td, .table-bordered th").each(function(){ $(this).css("vertical-align", "middle") });
    //var restorepage = document.body.innerHTML;
    var printcontent = document.getElementById(el).innerHTML;
    document.body.innerHTML = printcontent;
    window.print();
    //document.body.innerHTML = restorepage;
  }

  window.onafterprint = function(){
    window.location.reload(true);
  }
</script>