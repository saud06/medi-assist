<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','manager');
if(!(in_array($this->session->userdata('type'),$p))){
  redirect('auth');
}
?>

<?php
$this->load->view('layout/header');
?>

<script type="text/javascript">
  function delete_id(id){
    if(confirm('Sure to remove this product?\nCaution: All records in the system related to this product will be deleted.')){
      window.location.href='<?php  echo base_url('product/delete/2/'); ?>'+id;
    }
  }

  window.toggleColumn = function(){
    $('.yclass').toggleClass('show');
  };
</script>

<style type="text/css">
  .show {
    display: block;
  }

  .yclass {
    display: none;
  }

  .custom-link:hover{
    text-decoration: underline;
  }
</style>

<link href="https://cdn.jsdelivr.net/css-toggle-switch/latest/toggle-switch.css" rel="stylesheet" />
<style type="text/css">
  .switch-toggle {
    width: 30em;
  }

  .switch-toggle label:not(.disabled) {
    cursor: pointer;
  }
</style>

<div class="content-wrapper">
  <?php 
    // $this->load->view('layout/sticky_note');
  ?>

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h5>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url('auth/dashboard'); ?>" class="text-black"><i class="fa fa-dashboard">&nbsp;</i><strong><?php echo $this->lang->line('header_dashboard'); ?></strong></a></li>
        <li class="active"><?php echo $this->lang->line('header_product'); ?></li>
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
            <h3 class="box-title">Product List</h3>&emsp;
            <style type="text/css">
              .bg-gray-hover:hover{
                background-color: #eff5ff !important;
              }
              .bg-green-hover:hover{
                background-color: #008749 !important;
              }
            </style>
            <a href="<?php echo base_url('product/local_list'); ?>" class="btn btn-social bg-gray bg-gray-hover"><i class="fa fa-align-center"></i><span class="bg-green bg-green-hover" style="padding: 12px; margin-left: -12px;">Winmark</span><span style="padding: 0px; margin-left: 12px;">Customer</span></a>
            <a title="Add New Product" class="btn bg-gray" style="margin: 10px" href="<?php echo base_url('product/add');?>"><i class="fa fa-plus"></i></a>
          </div>

          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <?php 
                $query = $this->db->select('*')->from('category')->get()->result();
                $category_id = explode(',', $this->session->userdata('category_id'));

                foreach($query as $mkey => $category){
                  if(isset($category_id[$mkey])){
                    if($category->category_id == $category_id[$mkey]){
                      break;
                    }
                  }
                }
                
                foreach($query as $key => $category){
                  if($this->session->userdata('type') == 'admin'){
              ?>
                    <li <?php if($key == 0){?> class="active" <?php }?>><a href="#<?php echo $category->category_name; ?>" data-toggle="tab"><?php echo $category->category_name; ?></a></li>
              <?php
                  }
                  else if($this->session->userdata('type') == 'manager'){
                    if((in_array($category->category_id, $category_id))){
              ?>
                      <li <?php if($key == $mkey){?> class="active" <?php }?>><a href="#<?php echo $category->category_name; ?>" data-toggle="tab"><?php echo $category->category_name; ?></a></li>
              <?php
                    }
                  }
                }
              ?>
            </ul>

            <style type="text/css">
              .btn-text{
                background-color: #1DA1F2;
                font-weight: bold;
                margin: 4px;
                padding: 4px 8px;
              }
              .btn-text:hover{
                background-color: #1a618c;
                border-color: #1a618c;
              }
              .btn-text.active{
                background-color: #1a618c;
                border-color: #1a618c;
              }
              hr.style14 { 
                width: 50%;
                border: 0; 
                height: 1px; 
                margin-top: 0;
                background-image: -webkit-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
                background-image: -moz-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
                background-image: -ms-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0);
                background-image: -o-linear-gradient(left, #f0f0f0, #8c8b8b, #f0f0f0); 
              }
            </style>
            
            <div class="tab-content">
              <?php 
                $num = $this->db->count_all_results('category');
                for($i=0; $i<$num; $i++){
              ?>
                  <div class="tab-pane <?php if($this->session->userdata('type') == 'admin'){ if($i == 0){?> active <?php }} else{ if($i == $mkey){?> active <?php }}?>" id="<?php echo $query[$i]->category_name; ?>">
                    <!-- /.box-header -->
                    <div class="box-body outer-scroll">
                      <div class="inner-scroll">
                        <div class="row">
                          <div class="col-sm-4"></div>

                          <div class="col-sm-4" style="text-align: center;">
                            <h2 style="margin-top: 0; margin-bottom: 5px;"><strong>Product Index</strong></h2>
                          </div>

                          <div class="col-sm-4"></div>
                        </div>

                        <hr class="style14">

                        <div class="row">
                          <div class="col-sm-3"></div>

                          <div class="col-sm-6" style="text-align: center;">
                            <div class="btn-group">
                              <?php
                                echo anchor('product/other_list/-', '-', array('class' => ($this->uri->segment('3') == "-" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/0', '0', array('class' => ($this->uri->segment('3') == "0" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/1', '1', array('class' => ($this->uri->segment('3') == "1" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/2', '2', array('class' => ($this->uri->segment('3') == "2" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/3', '3', array('class' => ($this->uri->segment('3') == "3" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/4', '4', array('class' => ($this->uri->segment('3') == "4" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/5', '5', array('class' => ($this->uri->segment('3') == "5" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/6', '6', array('class' => ($this->uri->segment('3') == "6" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/7', '7', array('class' => ($this->uri->segment('3') == "7" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/8', '8', array('class' => ($this->uri->segment('3') == "8" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/9', '9', array('class' => ($this->uri->segment('3') == "9" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                              ?>
                            </div>
                          </div>

                          <div class="col-sm-3"></div>
                        </div>

                        <div class="row">
                          <div class="col-sm-12" style="text-align: center;">
                            <div class="btn-group">
                              <?php 
                                echo anchor('product/other_list/a', 'A', array('class' => ($this->uri->segment('3') == "a" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/b', 'B', array('class' => ($this->uri->segment('3') == "b" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/c', 'C', array('class' => ($this->uri->segment('3') == "c" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/d', 'D', array('class' => ($this->uri->segment('3') == "d" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/e', 'E', array('class' => ($this->uri->segment('3') == "e" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/f', 'F', array('class' => ($this->uri->segment('3') == "f" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/g', 'G', array('class' => ($this->uri->segment('3') == "g" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/h', 'H', array('class' => ($this->uri->segment('3') == "h" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/i', 'I', array('class' => ($this->uri->segment('3') == "i" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/j', 'J', array('class' => ($this->uri->segment('3') == "j" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/k', 'K', array('class' => ($this->uri->segment('3') == "k" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/l', 'L', array('class' => ($this->uri->segment('3') == "l" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/m', 'M', array('class' => ($this->uri->segment('3') == "m" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/n', 'N', array('class' => ($this->uri->segment('3') == "n" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/o', 'O', array('class' => ($this->uri->segment('3') == "o" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/p', 'P', array('class' => ($this->uri->segment('3') == "p" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/q', 'Q', array('class' => ($this->uri->segment('3') == "q" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/r', 'R', array('class' => ($this->uri->segment('3') == "r" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/s', 'S', array('class' => ($this->uri->segment('3') == "s" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/t', 'T', array('class' => ($this->uri->segment('3') == "t" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/u', 'U', array('class' => ($this->uri->segment('3') == "u" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/v', 'V', array('class' => ($this->uri->segment('3') == "v" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/w', 'W', array('class' => ($this->uri->segment('3') == "w" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/x', 'X', array('class' => ($this->uri->segment('3') == "x" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/y', 'Y', array('class' => ($this->uri->segment('3') == "y" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                                echo anchor('product/other_list/z', 'Z', array('class' => ($this->uri->segment('3') == "z" ? 'btn btn-info btn-text active': 'btn btn-info btn-text'))); 
                              ?>
                            </div>
                          </div>
                        </div><br>

                        <?php if(isset($data)){ ?>
                          <div class="row">
                            <div class="col-sm-12">
                              <strong>Product List Filter:</strong> &emsp;

                              <select onchange="sub_category_idd(this.value)" class="form-control select2" name="sub_category_id" id="sub_category_id" style="width: 15%;">
                                <option value="">All Subcategories</option>
                                <?php
                                  $subcategory = $this->db->get('sub_category')->result();
                                  foreach ($subcategory as $subcat){
                                    if($subcat->category_id == $query[$i]->category_id){
                                ?>
                                      <option value="<?php echo $subcat->sub_category_id; ?>"><?php echo $subcat->sub_category_name; ?></option>
                                <?php
                                    }
                                  }
                                ?>
                                <option value="1">N/A</option>
                              </select> &emsp;

                              <select onchange="user_idd(this.value)" class="form-control select2" name="user_id" id="user_id" style="width: 15%;">
                                <option value="">All Responsibles</option>
                                <?php
                                  foreach ($user as $value){
                                ?>
                                    <option value="<?php echo $value->id; ?>"><?php echo $value->first_name . ' ' . $value->last_name; ?></option>
                                <?php
                                  }
                                ?>
                              </select> &emsp;

                              <select onchange="statuss(this.value)" class="form-control select2" name="status" id="status" style="width: 15%;">
                                <option value="">All Status</option>
                                <option value="active" selected>Active</option>
                                <option value="inactive">Inactive</option>
                              </select> &emsp;

                              <button title="Filter Product List" type="button" class="btn bg-gray btn_ajax" onclick="category_idd('<?php echo $i; ?>', '<?php echo $query[$i]->category_id; ?>')"><i class="fa fa-search"></i></button> &emsp;

                              <div class="btn-group">
                                <button title="Print Product List" type="button" class="btn bg-gray gropdown-toggle" data-toggle="dropdown">
                                  <i class="fa fa-print" aria-hidden="true"></i>&nbsp;
                                  <span class="fa fa-angle-double-down"></span>
                                </button>
                                <ul class="dropdown-menu">
                                  <li>
                                    <a href="#" onclick="printContent('print' + '<?php echo $i ?>', '<?php echo $i ?>')">Print (Default)</a>
                                  </li>
                                  <li id="pdf">
                                    <a href="<?php echo base_url('product/list_pdf/other/') . $this->uri->segment('3') . '/' . $query[$i]->category_name;?>" target="_blank">PDF (On Letter Head)</a>
                                  </li>
                                </ul>
                              </div> &emsp;
                            
                              <?php if($this->session->userdata('type') == 'admin'){ ?>
                                <button title="Toggle Column: Delete Multiple" type="button" class="btn bg-gray" onclick="window.toggleColumn()"><i class="fa fa-retweet" aria-hidden="true"></i></button>
                              <?php }?>
                            </div>
                          </div>
                        <?php }?>
                        <br>

                        <form name="actionForm" action="<?php echo base_url('product/DeleteMul'); ?>" method="post" onsubmit="return deleteConfirm();"/>
                          <table id="index<?php if($i != 0){ echo $i; }?>" class="table table-bordered table-striped">
                            <thead>
                              <tr>
                                <th><?php echo $this->lang->line('product_no'); ?>.</th>
                                <th><?php echo $this->lang->line('product_name'); ?></th>
                                <th>Manufacturer & Supplier</th>
                                <!-- <th>Approvals</th> -->
                                <th>Contact Person</th>
                                <th>Responsible Person</th>
                                <th>Inventory</th>
                                <!-- <th>Check-Out Status</th> -->
                                <?php if($this->session->userdata('type') == 'admin'){ ?>
                                  <th><?php echo $this->lang->line('product_action'); ?></th>
                                  <th class="yclass">Delete<br> Multiple</th>
                                <?php }?>
                              </tr>
                            </thead>
                            <tbody id="records<?php echo $i; ?>">
                              <?php 
                              if(isset($data)){
                                foreach ($data as $row){
                                  if($row->category_name == $query[$i]->category_name){
                                    $id = $row->product_id;
                                    $this->db->where('product_id', $id);
                                    $products = $this->db->get('products')->result_array();
                                    $client_ids = $products[0]['client_id'];
                                    $client_id = explode(",", $client_ids);

                                    $client_data = array();
                                    $contact_person_data = array();
                                    $responsible_person_data = array();
                                    foreach ($client_id as $key => $value) {
                                      $this->db->where('client_id', $value);
                                      $clients = $this->db->get('client')->result_array();

                                      if(isset($clients[0])){  
                                        if($clients[0]['client_type_id'] == 2 || $clients[0]['client_type_id'] == 3 || $clients[0]['client_type_id'] == 4){
                                          $client_idd[$key] = $clients[0]['client_id'];
                                          array_push($client_data, $clients[0]['company_name']);
                                          array_push($contact_person_data, ['name' => $clients[0]['contact_person'], 'phone' => $clients[0]['contact_person_phone'], 'email' => $clients[0]['email']]);
                                          array_push($responsible_person_data, $clients[0]['responsible_person_id']);
                                        }
                                      }
                                    }

                                    $this->db->select('ch.client_id, cl.company_name, SUM(ch.out_quantity) AS out_quantity')
                                             ->where('ch.product_id', $id)
                                             ->join('client cl', 'ch.client_id = cl.client_id')
                                             ->group_by('ch.client_id');
                                    $check_outs = $this->db->get('check_out_history ch')->result_array();

                                    if(count($client_data) > 0){
                                  ?>
                                      <tr>
                                        <td></td>
                                        <td><a class="custom-link" title="<?php if($row->image === ''){ echo 'No Image Available'; } else{ echo $row->image; } ?>" target="_blank" href="<?php if($row->image === ''){ echo '#'; } else{ echo $row->image; } ?>"><?php echo $row->name; ?></a></td>
                                        <td>
                                          <?php
                                            foreach ($client_data as $key => $value) {
                                              echo ($key+1) . '. ' . $value . '&nbsp;&nbsp;';
                                          ?>
                                              <a style="margin: 2px; color: #1DA1F2; padding: 3px" href="<?php echo base_url('email/inquiry_mail/'); ?><?php if(isset($client_idd[$key])){ echo $client_idd[$key] . '/' . $id; } ?>" title="Email" class="btn btn-xs bg-gray fa fa-paper-plane fa-sm"></a><br>
                                          <?php
                                            }
                                          ?>
                                        </td>
                                        <!-- <td>
                                          <?php 
                                            foreach ($client_data as $key2 => $value2) {
                                          ?>
                                              <button style="<?php if($key2 != (count($client_data) - 1)){ ?> margin-bottom: 5px; <?php } ?> color: #1DA1F2;" title="Product Approval List of <?php echo $value2; ?>" type="button" onclick="approve_btn('<?php echo $client_idd[$key2]; ?>', '<?php echo $value2; ?>', '<?php echo $id; ?>', '<?php echo $row->name; ?>')" class="btn btn-xs bg-gray"><span class="glyphicon glyphicon-ok"></span></button><br>
                                          <?php 
                                            }
                                          ?>
                                        </td> -->
                                        <td>
                                          <?php
                                            foreach ($contact_person_data as $key => $value) {
                                              if($value['name']){
                                                echo '<p style="margin:0; cursor: help;" data-html="true" data-toggle="tooltip" title="<u>Contact Details</u><br><br>Phone: '. $value['phone'] .'<br>Email: '. $value['email'] .'<br><br>">' . ($key+1) . '. ' . $value['name'] . '</p>';
                                              }
                                            }
                                          ?>
                                        </td>
                                        <td>
                                          <?php
                                            foreach ($responsible_person_data as $key => $value) {
                                              foreach ($user as $key2 => $value2) {
                                                if(in_array($value2->id, explode(",", $value))){
                                                  echo ($key+1) . '. ' . $value2->first_name . ' ' . $value2->last_name;

                                                  if(sizeof(explode(",", $value)) > 1){
                                                    if($key2 != sizeof(explode(",", $value))-1){
                                                      echo ', ';
                                                    }
                                                  }
                                                }
                                              }

                                              echo '<br>'; 
                                            }
                                          ?>
                                        </td>
                                        <td>
                                          <?php 
                                            if($row->is_inventory == 1){
                                          ?>
                                              <button title="View Product in Inventory" type="button" onclick="btn_inv(<?php echo $id; ?>)" class="btn btn-sm bg-gray"><span class="glyphicon glyphicon-eye-open"></span></button>
                                          <?php
                                            } 
                                            else{ 
                                              echo 'N/A'; 
                                            } 
                                          ?>
                                        </td>
                                        <!-- <td>
                                          <span class="pull-left">
                                            <?php 
                                              foreach ($check_outs as $key => $value) {
                                                if(isset($check_outs[$key])){
                                                  echo ($key+1) . '. ' . '<strong>Name:</strong> ' . $check_outs[$key]['company_name'] . ';&emsp;<strong>Quantity:</strong> ' . $check_outs[$key]['out_quantity'] . '<br>';
                                                }
                                              }
                                            ?>
                                          </span>
                                        
                                          <?php 
                                            if(sizeof($check_outs) > 0){
                                          ?>
                                              <span class="pull-right">
                                                <a href="<?php echo base_url('inventory/check_out_history'); ?>" title="View Product in Check-Out History" type="button" class="btn btn-xs bg-gray"><span class="glyphicon glyphicon-eye-open"></span></a>
                                              </span>
                                          <?php
                                            }
                                          ?>
                                        </td> -->
                                        <?php if($this->session->userdata('type') == 'admin'){ ?>
                                          <td>
                                            <div class="dropdown">
                                              <button title="Action" type="button" class="btn btn-sm bg-gray gropdown-toggle" data-toggle="dropdown">
                                                <span class="fa fa-cog"></span>&nbsp;
                                                <span class="fa fa-angle-double-down"></span>
                                              </button>
                                              <ul class="dropdown-menu">
                                                <li>
                                                  <a href="<?php echo base_url('product/edit/2/'); ?><?php echo $id; ?>"><i class="fa fa-edit"></i>Edit</a>
                                                </li>
                                                <li>
                                                  <a href="javascript:delete_id(<?php echo $id;?>)"><i class="fa fa-trash-o"></i>Delete</a>
                                                </li>
                                              </ul>
                                            </div>
                                          </td>
                                          <td class="yclass"><input type="checkbox" name="selected_id[]" class="checkbox checkbox1" value="<?php echo $row->product_id; ?>"/></td>
                                        <?php }?>
                                      </tr>
                                  <?php
                                    }
                                  }
                                }
                              }
                              ?>
                            </tbody>
                            <tfoot>
                              <tr>
                                <th><?php echo $this->lang->line('product_no'); ?>.</th>
                                <th><?php echo $this->lang->line('product_name'); ?></th>
                                <th>Manufacturer & Supplier</th>
                                <!-- <th>Approvals</th> -->
                                <th>Contact Person</th>
                                <th>Responsible Person</th>
                                <th>Inventory</th>
                                <!-- <th>Check-Out Status</th> -->
                                <?php if($this->session->userdata('type') == 'admin'){ ?>
                                  <th><?php echo $this->lang->line('product_action'); ?></th>
                                  <th class="yclass">Select All &nbsp;&nbsp;<input type="checkbox" name="check_all" class="check_all" align="center"/><br><input type="submit" class="btn btn-xs btn-danger" name="btn_delete" value="Delete" /></th>
                                <?php }?>
                              </tr>
                            </tfoot>
                          </table>

                          <div style="display: none;" id="print<?php echo $i ?>">
                            <div id="header<?php echo $i ?>" class="box-header with-border" style="text-align: center; display: none">
                              <!-- <img width="300" height="100" src="<?php echo base_url().'assets/images/winmarkFinal.png'; ?>"><br>
                              <hr> -->

                              <h3 class="box-title">
                                <?php echo $query[$i]->category_name . ' Product List'; ?>
                              </h3>
                              <br><br>

                              <table id="pindex" class="table table-bordered table-striped">
                                <thead>
                                  <tr>
                                    <th><?php echo $this->lang->line('product_no'); ?>.</th>
                                    <th><?php echo $this->lang->line('product_name'); ?></th>
                                    <th>Manufacturer & Supplier</th>
                                    <th>Contact Person</th>
                                    <th>Responsible Person</th>
                                    <th>Inventory</th>
                                    <!-- <th>Check-Out Status</th> -->
                                  </tr>
                                </thead>
                                <tbody id="precords<?php echo $i; ?>">
                                  <?php 
                                  $row_counter = 0;
                                  foreach ($data as $row){
                                    if($row->category_name == $query[$i]->category_name){
                                      $id = $row->product_id;
                                      $this->db->where('product_id', $id);
                                      $products = $this->db->get('products')->result_array();
                                      $client_ids = $products[0]['client_id'];
                                      $client_id = explode(",", $client_ids);

                                      $client_data = array();
                                      $contact_person_data = array();
                                      $responsible_person_data = array();
                                      foreach ($client_id as $key => $value) {
                                        $this->db->where('client_id', $value);
                                        $clients = $this->db->get('client')->result_array();

                                        if(isset($clients[0])){  
                                          if($clients[0]['client_type_id'] == 2 || $clients[0]['client_type_id'] == 3 || $clients[0]['client_type_id'] == 4){
                                            $client_idd[$key] = $clients[0]['client_id'];
                                            array_push($client_data, $clients[0]['company_name']);
                                            array_push($contact_person_data, ['name' => $clients[0]['contact_person'], 'phone' => $clients[0]['contact_person_phone'], 'email' => $clients[0]['email']]);
                                            array_push($responsible_person_data, $clients[0]['responsible_person_id']);
                                          }
                                        }
                                      }

                                      $this->db->select('ch.client_id, cl.company_name, SUM(ch.out_quantity) AS out_quantity')
                                               ->where('ch.product_id', $id)
                                               ->join('client cl', 'ch.client_id = cl.client_id')
                                               ->group_by('ch.client_id');
                                      $check_outs = $this->db->get('check_out_history ch')->result_array();

                                      if(count($client_data) > 0){
                                  ?>
                                        <tr>
                                          <td><?php echo ++$row_counter; ?></td>
                                          <td><a class="custom-link" title="<?php if($row->image === ''){ echo 'No Image Available'; } else{ echo $row->image; } ?>" target="_blank" href="<?php if($row->image === ''){ echo '#'; } else{ echo $row->image; } ?>"><?php echo $row->name; ?></a></td>
                                          <td>
                                            <?php
                                              foreach ($client_data as $key => $value) {
                                                echo ($key+1) . '. ' . $value . '<br>';
                                              }
                                            ?>
                                          </td>
                                          <td>
                                            <?php
                                              foreach ($contact_person_data as $key => $value) {
                                                if($value['name']){
                                                  echo ($key+1) . '. ' . $value['name'] . '<br>';
                                                }
                                              }
                                            ?>
                                          </td>
                                          <td>
                                            <?php
                                              foreach ($responsible_person_data as $key => $value) {
                                                foreach ($user as $key2 => $value2) {
                                                  if(in_array($value2->id, explode(",", $value))){
                                                    echo ($key+1) . '. ' . $value2->first_name . ' ' . $value2->last_name;

                                                    if(sizeof(explode(",", $value)) > 1){
                                                      if($key2 != sizeof(explode(",", $value))-1){
                                                        echo ', ';
                                                      }
                                                    }
                                                  }
                                                }

                                                echo '<br>'; 
                                              }
                                            ?>
                                          </td>
                                          <td>
                                            <?php 
                                              if($row->is_inventory == 1){
                                                echo 'Available'; 
                                              } 
                                              else{ 
                                                echo 'N/A'; 
                                              } 
                                            ?>
                                          </td>
                                          <!-- <td>
                                            <span class="pull-left">
                                              <?php 
                                                foreach ($check_outs as $key => $value) {
                                                  if(isset($check_outs[$key])){
                                                    echo ($key+1) . '. ' . '<strong>Name:</strong> ' . $check_outs[$key]['company_name'] . ';&emsp;<strong>Quantity:</strong> ' . $check_outs[$key]['out_quantity'] . '<br>';
                                                  }
                                                }
                                              ?>
                                            </span>
                                          
                                            <?php 
                                              if(sizeof($check_outs) > 0){
                                            ?>
                                                <span class="pull-right">
                                                  <a href="<?php echo base_url('inventory/check_out_history'); ?>" title="View Product in Check-Out History" type="button" class="btn btn-xs bg-gray"><span class="glyphicon glyphicon-eye-open"></span></a>
                                                </span>
                                            <?php
                                              }
                                            ?>
                                          </td> -->
                                        </tr>
                                  <?php
                                      }
                                    }
                                  }
                                  ?>
                                </tbody>
                                <tfoot>
                                  <tr>
                                    <th><?php echo $this->lang->line('product_no'); ?>.</th>
                                    <th><?php echo $this->lang->line('product_name'); ?></th>
                                    <th>Manufacturer & Supplier</th>
                                    <th>Contact Person</th>
                                    <th>Responsible Person</th>
                                    <th>Inventory</th>
                                    <!-- <th>Check-Out Status</th> -->
                                  </tr>
                                </tfoot>
                              </table>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <!-- /.box-body -->
                  </div>
              <?php 
                }
              ?>
            </div>
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
  function deleteConfirm(){
    var result = confirm("Sure to remove selected products?\nCaution: All records in the system related these products will be deleted.");
    if(result){
        return true;
    }else{
        return false;
    }
  }
  
  $(document).ready(function(){
    $('.check_all').on('click',function(){
      if(this.checked){
        $(this).parent().parent().parent().parent().find('.checkbox1').each(function(){
          this.checked = true;
        });
      }
      else{
        $(this).parent().parent().parent().parent().find('.checkbox1').each(function(){
          this.checked = false;
        });
      }
    });
    
    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
          $('.check_all').prop('checked',true);
        }
        else{
          $('.check_all').prop('checked',false);
        }
    });
  });

  var j, category_id; var sub_category_id; var user_id; var status;
  function category_idd(counter, id){
    j = counter;
    category_id = id;
  }
  function sub_category_idd(id){
    sub_category_id = id;
  }
  function user_idd(id){
    user_id = id;
  }
  function statuss(ele){
    status = ele;
  }

  $('.btn_ajax').click(function(){
    var char = "<?php echo $this->uri->segment('3'); ?>";
    var client_type = "other";
    if(!sub_category_id) sub_category_id = 0;
    var client_id = 0;
    if(!user_id) user_id = 0;
    if(!status) status = 0;

    $.ajax({
      url: "<?php echo base_url('product/filter_product') ?>/" + char,
      type: "POST",
      dataType: "JSON",
      data : {
        client_type: client_type,
        category_id: category_id,
        sub_category_id: sub_category_id,
        client_id: client_id,
        user_id: user_id,
        status: status
      },
      success: function (response) {
        if(j == 0){
          var table = $('#index').DataTable();
          table.destroy();
          $('#records' + j).empty();
        }
        else{
          var table = $('#index' + j).DataTable();
          table.destroy();
          $('#records' + j).empty();
        }

        var trHTML = '';
        var row_counter = 1;
        $.each(response.data, function (i, item) {
          var clients = item.clients;
          var check_outs = item.check_outs;
          var users = item.users;
          var responsible_person_data = [];
          if(clients.length > 0){
            trHTML += '<tr>';
            trHTML += '<td>' + row_counter + '</td>';
            
            // trHTML += '<td width="5%"><a title="Click to View" target="_blank" href="'+ item.image +'"><img src="'+ item.image +'" width="100%" height="60px"></a></td>';

            var title = '';
            if(item.image === '') title = 'No Image Available';
            else title = 'Click to View';

            var href = '';
            if(item.image === '') href = '#';
            else href = item.image;

            trHTML += '<td><a class="custom-link" title="'+ title +'" target="_blank" href="'+ href +'">'+ item.name +'</a></td>';
            
            trHTML += '<td>';
              var url = '<?php echo base_url('email/inquiry_mail/'); ?>';
              for(i=0; i<clients.length; i++){
                trHTML += (i+1) + '. ' + clients[i].company_name + '&nbsp;&nbsp;';
                trHTML += '<a style="margin: 2px; color: #1DA1F2; padding: 3px" href="'+ url + clients[i].client_id + "/" + item.product_id +'" title="Email" class="btn btn-xs bg-gray fa fa-envelope fa-sm"></a><br>';
              }
            trHTML += '</td>';

            trHTML += '<td>';
              for(i=0; i<clients.length; i++){
                var style = '';
                if(i != (clients.length - 1)){
                  style = 'margin-bottom: 5px; ';
                }
                style += 'color: #1DA1F2';

                var title = 'Product Approval List of ' + clients[i].company_name;

                var arguments = "'" + clients[i].client_id + "', '" + clients[i].company_name + "', '" + item.product_id + "', '" + item.name + "'";

                trHTML += '<button style="'+ style +'" title="'+ title +'" type="button" onclick="approve_btn('+ arguments +')" class="btn btn-xs bg-gray"><span class="glyphicon glyphicon-ok"></span></button><br>';
              }
            trHTML += '</td>';

            trHTML += '<td>';
              for(i=0; i<clients.length; i++){
                if(clients[i].contact_person){
                  trHTML += '<p style="margin: 0; cursor: help;" data-html="true" data-toggle="tooltip" title="<u>Contact Details</u><br><br>Phone: ' + clients[i].contact_person_phone + '<br>Email: ' + clients[i].email + '<br><br>">' + (i+1) + '. ' + clients[i].contact_person + '</p>';
                }
              }
            trHTML += '</td>';
            trHTML += '<td>';
              for(i=0; i<clients.length; i++){
                responsible_person_data.push(clients[i].responsible_person_id);
              }

              var counter = 1;
              for(i=0; i<responsible_person_data.length; i++){
                trHTML += counter + '. ';

                var counter2 = 0;
                for(k=0; k<users.length; k++){
                  if(responsible_person_data[i]){
                    if(jQuery.inArray(users[k].id, responsible_person_data[i].split(',')) != -1){
                      trHTML += users[k].first_name + ' ' + users[k].last_name;

                      if(responsible_person_data[i].split(',').length > 1){
                        if(counter2 != responsible_person_data[i].split(',').length-1){
                          trHTML += ', ';
                        }
                      }
                    }
                  }
                  counter2++;
                }

                counter++;
                trHTML += '<br>'; 
              }
            trHTML += '</td>';
            var inv_status = '';
            if(item.is_inventory == 1){
              inv_status = '<button title="View Product in Inventory" type="button" onclick="btn_inv('+ item.product_id +')" class="btn btn-sm bg-gray"><span class="glyphicon glyphicon-eye-open"></span></button>';
            }
            else{
              inv_status = 'N/A';
            }
            trHTML += '<td>' + inv_status + '</td>';
            /*trHTML += '<td>';
              trHTML += '<span class="pull-left">';
                for(i=0; i<check_outs.length; i++){
                  trHTML += (i+1) + '. <strong>Name:</strong> ' + check_outs[i].company_name + '&emsp;<strong>Quantity:</strong> ' + check_outs[i].out_quantity + '<br>';
                }
              trHTML += '</span>';

              trHTML += '<span class="pull-right">';
                if(check_outs.length > 0){
                  trHTML += '<a href="<?php echo base_url('inventory/check_out_history'); ?>" title="View Product in Check-Out History" type="button" class="btn btn-xs bg-gray"><span class="glyphicon glyphicon-eye-open"></span></a>';
                }
              trHTML += '</span>';
            trHTML += '</td>';*/
            var type = '<?php echo $this->session->userdata("type") ?>';
            if(type == 'admin'){
              trHTML += '<td>';
                trHTML += '<div class="dropdown"><button type="button" class="btn btn-sm bg-gray gropdown-toggle" data-toggle="dropdown"><span class="fa fa-cog"> &nbsp;<span class="fa fa-angle-double-down"></span></button><ul class="dropdown-menu"><li><a href="<?php echo base_url('product/edit/2/'); ?>' + item.product_id + '"><i class="fa fa-edit"></i>Edit</a></li><li><a href="javascript:delete_id(' + item.product_id + ')"><i class="fa fa-trash-o"></i>Delete</a></li></ul></div>';
              trHTML += '</td>';
              trHTML += '<td class="yclass"><input type="checkbox" name="selected_id[]" class="checkbox checkbox1" value="'+ item.product_id +'"/></td>';
            }
            trHTML += '</tr>';
            row_counter++;
          }
        });
        
        if(j == 0){
          $('#records' + j).append(trHTML);
          $('#index').DataTable({
            "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": 0
            } ],
            "order": [[ 1, 'asc' ]],
            "pageLength": 100
          });
        }
        else{
          $('#records' + j).append(trHTML);
          $('#index' + j).DataTable({
            "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": 0
            } ],
            "order": [[ 1, 'asc' ]],
            "pageLength": 100
          });
        }

        $('#precords' + j).empty();

        var trHTML = '';
        var row_counter = 1;
        $.each(response.data, function (i, item) {
          var clients = item.clients;
          var check_outs = item.check_outs;
          var users = item.users;
          var responsible_person_data = [];
          if(clients.length > 0){
            trHTML += '<tr>';
            trHTML += '<td>' + row_counter + '</td>';
            // trHTML += '<td width="5%"><a title="Click to View" target="_blank" href="'+ item.image +'"><img src="'+ item.image +'" width="100%" height="60px"></a></td>';
            trHTML += '<td>' + item.name + '</td>';
            trHTML += '<td>';
              var url = '<?php echo base_url('email/inquiry_mail/'); ?>';
              for(i=0; i<clients.length; i++){
                trHTML += (i+1) + '. ' + clients[i].company_name + '<br>';
              }
            trHTML += '</td>';
            trHTML += '<td>';
              for(i=0; i<clients.length; i++){
                if(clients[i].contact_person){
                  trHTML += '<p style="cursor: help;" data-html="true" data-toggle="tooltip" title="<u>Contact Details</u><br><br>Phone: ' + clients[i].contact_person_phone + '<br>Email: ' + clients[i].email + '<br><br>">' + (i+1) + '. ' + clients[i].contact_person + '</p>';
                }
              }
            trHTML += '</td>';
            trHTML += '<td>';
              for(i=0; i<clients.length; i++){
                responsible_person_data.push(clients[i].responsible_person_id);
              }

              var counter = 1;
              for(i=0; i<responsible_person_data.length; i++){
                trHTML += counter + '. ';

                var counter2 = 0;
                for(k=0; k<users.length; k++){
                  if(responsible_person_data[i]){
                    if(jQuery.inArray(users[k].id, responsible_person_data[i].split(',')) != -1){
                      trHTML += users[k].first_name + ' ' + users[k].last_name;

                      if(responsible_person_data[i].split(',').length > 1){
                        if(counter2 != responsible_person_data[i].split(',').length-1){
                          trHTML += ', ';
                        }
                      }
                    }
                  }
                  counter2++;
                }

                counter++;
                trHTML += '<br>'; 
              }
            trHTML += '</td>';
            var inv_status = '';
            if(item.is_inventory == 1){
              inv_status = 'Available';
            }
            else{
              inv_status = 'N/A';
            }
            trHTML += '<td>' + inv_status + '</td>';
            /*trHTML += '<td>';
              trHTML += '<span class="pull-left">';
                for(i=0; i<check_outs.length; i++){
                  trHTML += (i+1) + '. <strong>Name:</strong> ' + check_outs[i].company_name + '&emsp;<strong>Quantity:</strong> ' + check_outs[i].out_quantity + '<br>';
                }
              trHTML += '</span>';

              trHTML += '<span class="pull-right">';
                if(check_outs.length > 0){
                  trHTML += '<a href="<?php echo base_url('inventory/check_out_history'); ?>" title="View Product in Check-Out History" type="button" class="btn btn-xs bg-gray"><span class="glyphicon glyphicon-eye-open"></span></a>';
                }
              trHTML += '</span>';
            trHTML += '</td>';*/
            trHTML += '</tr>';
            row_counter++;
          }
        });

        $('#precords' + j).append(trHTML);
      }
    });

    $("#pdf").html('<a href="<?php echo base_url('product/filterProductPDF/');?>' + char + '/' + client_type + '/' + category_id + '/' + sub_category_id + '/' + client_id + '/' + user_id + '/' + status + '" target="_blank">PDF (On Letter Heads)</a>');
  });

  function btn_inv(product_id){
    $.ajax({
      url: "<?php echo base_url('product/find_in_inventory') ?>/",
      type: "POST",
      dataType: "JSON",
      data : {
        product_id: product_id,
      },
      success: function (response) {
        if(response.data == 0){
          alert('Product is Unavailable in Inventory. Please Purchase First.');
        }
        else{
          window.location.href = '<?php echo base_url('inventory/index'); ?>/'+product_id;
        }
      }
    });
  }

  function approve_btn(client_id, company_name, product_id, product_name){
    $.ajax({
      url : "<?php echo base_url('product/product_approval_list/')?>" + client_id + "/" + product_id,
      type: "GET",
      dataType: "JSON",
      success: function(data)
      {
        var table = $('#index10').DataTable();
        table.destroy();
        $('#records10').empty();

        var trHTML = '';
        var approved_checked = ''; var not_approved_checked = ''; var pending_checked = '';
        $.each(data, function (i, item) {
            trHTML += '<tr>';
            trHTML += '<td></td>';
            trHTML += '<td>' + item.company_name + '</td>';
            trHTML += '<td>';
               if(item.approval_status == 'Approved'){ approved_checked = 'checked'; }
               else if(item.approval_status == 'Not Approved'){ not_approved_checked = 'checked'; }
               else{ pending_checked = 'checked'; }
               trHTML += '<div class="switch-toggle switch-3 switch-candy">\
                            <input id="approved" name="approval_status" type="radio" '+ approved_checked +'>\
                            <label for="approved" onclick="update_status('+ item.product_approval_id +', 1)">Approved</label>\
                            <input id="not_approved" name="approval_status" type="radio" '+ not_approved_checked +'>\
                            <label for="not_approved" onclick="update_status('+ item.product_approval_id +', 2)">Not Approved</label>\
                            <input id="pending" name="approval_status" type="radio" '+ pending_checked +' disabled>\
                            <label for="pending">Pending</label>\
                            <a></a>\
                          </div>';
            trHTML += '</td>';
            trHTML += '</tr>';
        });

        $('#records10').append(trHTML);

        $(document).ready(function() {
          var t = $('#index10').DataTable( {
            "columnDefs": [ {
              "searchable": false,
              "orderable": false,
              "targets": 0
            } ],
            "order": [[ 1, 'asc' ]]
          });

          t.on( 'order.dt search.dt', function () {
            t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
              cell.innerHTML = i+1;
            });
          }).draw();
        });

        $('#modal_approval').modal('show'); 
        $('.modal-title').text('Approved Client List');
        
        if(data.length > 0){
          $('#sub_title_product').text(data[0].product_name);
          $('#sub_title_client').text(data[0].company_name2);
        }
        else{
          $('#sub_title_product').text(product_name);
          $('#sub_title_client').text(company_name);
        }
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        alert('Error get data from ajax');
      }
    });
  }

  function update_status(id, status){
    if(status == 1){
      status = 'Approved';
    }
    else{
      status = 'Not Approved';
    }

    $.ajax({
      url : "<?php echo base_url('product/edit_approval_status')?>",
      type: "POST",
      dataType: "JSON",
      data:{
        product_approval_id: id,
        approval_status: status
      },
      success: function(data)
      {
        
      },
      error: function (jqXHR, textStatus, errorThrown)
      {
        alert('Error post data from ajax');
      }
    });
  }

  function printContent(el, counter){
    $('#header' + counter).show();
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

<!-- modal -->
<div class="modal fade" id="modal_approval" role="dialog">
  <div class="modal-dialog" style="width: 60%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title"></h3>
        <h4>
          <b>Product: </b><span id="sub_title_product"></span>&emsp;&emsp;
          <b>Manufacturer & Supplier: </b><span id="sub_title_client"></span>
        </h4>
      </div>
      <div class="modal-body">
        <table id="index10" class="table table-bordered table-striped product_table1">
          <thead>
            <th>No.</th>
            <th>Local Client</th>
            <th>Approval Status</th>
          <thead>
          <tbody id="records10">
          </tbody>
          <tfoot>
            <th>No.</th>
            <th>Local Client</th>
            <th>Approval Status</th>
          <tfoot>
        </table>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->