<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>WinMark | Dashboard</title>
  <link rel="shortcut icon" type="image/png" href="<?php echo base_url('assets/images/title.png'); ?>" />

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>bootstrap/css/bootstrap.min.css">
  <!-- Bootstrap Toggle -->
  <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- fullCalendar 2.2.5-->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/fullcalendar/fullcalendar.min.css">
  <!-- Graph -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <!-- Close Graph -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/fullcalendar/fullcalendar.print.css" media="print">
  <!-- daterange picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/datepicker/datepicker3.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/iCheck/all.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/colorpicker/bootstrap-colorpicker.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>plugins/select2/select2.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>dist/css/skins/_all-skins.min.css">
   <!-- bootstrap wysihtml5 - text editor -->
   <link rel="stylesheet" href="<?php echo base_url('assets/');?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
   <link rel="stylesheet" href="<?php echo base_url('assets/');?>documentation/style.css">
   <!-- froala - text editor -->
   <link href="<?php echo base_url('assets/');?>plugins/froala/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
   <link href="<?php echo base_url('assets/');?>plugins/froala/css/froala_style.min.css" rel="stylesheet" type="text/css" />

   <script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-3.1.1.js"></script> 
   <!-- Bootstrap 3.3.6 -->
   <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
   <!-- Bootstrap Toggle -->
   <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
   
   <script src="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
   <script src="<?php echo base_url();?>assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
   <!-- jQuery Knob Chart -->
   <script src="<?php echo base_url();?>assets/plugins/knob/jquery.knob.js"></script>
   <!-- daterangepicker -->
   <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
   <script src="<?php echo base_url();?>assets/plugins/daterangepicker/daterangepicker.js"></script>
   <!-- datepicker -->
   <script src="<?php echo base_url();?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
   <!-- Bootstrap WYSIHTML5 -->
   <script src="<?php echo base_url();?>assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
   <!-- Slimscroll -->
   <script src="<?php echo base_url();?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
   <!-- FastClick -->
   <script src="<?php echo base_url();?>assets/plugins/fastclick/fastclick.js"></script>
   <!-- AdminLTE App -->
   <script src="<?php echo base_url();?>assets/dist/js/app.min.js"></script>
   <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
   <script src="<?php echo base_url();?>assets/dist/js/pages/dashboard.js"></script>
   <!-- AdminLTE for demo purposes -->
   <script src="<?php echo base_url();?>assets/dist/js/demo.js"></script>
   <style type="text/css">
     .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
          background-color: #B0B3BA;
          border-color: #B0B3BA;
      }
   </style>
 </head>
 <body class="hold-transition skin-red-light sidebar-mini">
  <div class="wrapper">
    <header class="main-header">
      <!-- Logo -->
      <a href="#" class="logo" style="padding: 0; background-color: #B0B3BA">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b style="color:#fff;">W</b><b style="color: #000;">M</b></span>
        <!-- logo for regular state and mobile devices -->
        <!-- <span class="logo-lg"><b> <img src="<?php  echo base_url(); ?>assets/images/logo2.png"/></b></span> -->
        <span class="logo-lg" style="border: 1px solid gray; background-color: #B0B3BA; padding-top: -5px">
          <?php
            $data = $this->db->get('company_settings')->row();
            //print_r($data);
            if($data!=""){
              if($data->logo){
          ?>
            <b> <img src="<?php echo base_url($data->logo); ?>" width="100%" height="48px;" style="background-color: #ffffff; padding: 0;"/></b><?php } else{?><img src="<?php echo base_url(); ?>/assets/images/logo.png" width="100%"/><?php }?>
          <?php }else{
          ?>
            <b>Win</b><b style="color: red;">Mark</b>
          <?php
            }
          ?>
        </span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top" style="background-color: #B0B3BA">
        <!-- Sidebar toggle button-->
        <a href="#" style="color: #000; background-color: #B0B3BA" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">          
            <li class="dropdown tasks-menu">
              <a href="#" class="dropdown-toggle text-right" data-toggle="dropdown">

                <div style="width:70px;">
                  <table>
                    <tr>
                      <td>
                        <?php
                        if($this->session->userdata('site_lang')!=null){
                          ?>
                          <img src="<?php echo base_url('assets/images/flag/').$this->session->userdata('site_lang').".png";?>" width="110%">
                          <?php
                        }
                        else{
                          ?>
                          <img src="<?php echo base_url('assets/images/flag/');?>english.png" width="110%">
                          <?php
                        }
                        ?>
                      </td>
                      <td>
                        <?php 
                        if($this->session->userdata('site_lang')!=null){
                          echo ucwords($this->session->userdata('site_lang')); 
                        }
                        else{
                          echo " English";
                        }
                        ?>
                      </td>
                    </tr>
                  </table>
                </div>
              </a>
              <ul class="dropdown-menu">
                <li>
                  <ul class="menu">
                    <li>
                      <a href="<?php echo base_url('LanguageSwitcher/switchLang/english'); ?>"><h3><img src="<?php echo base_url('assets/images/flag/english.png');?>" width="9%">English</h3></a>
                    </li>
                    <li>
                      <a href="<?php echo base_url('LanguageSwitcher/switchLang/french'); ?>"><h3><img src="<?php echo base_url('assets/images/flag/french.png');?>" width="9%">French</h3></a>
                    </li>
                    <li>
                      <a href="<?php echo base_url('LanguageSwitcher/switchLang/russian'); ?>"><h3><img src="<?php echo base_url('assets/images/flag/russian.png');?>" width="9%">Russian</h3></a>
                    </li>
                    <li>
                      <a href="<?php echo base_url('LanguageSwitcher/switchLang/hindi'); ?>"><h3><img src="<?php echo base_url('assets/images/flag/hindi.png');?>" width="9%">Hindi</h3></a>
                    </li>
                    <li>
                      <a href="<?php echo base_url('LanguageSwitcher/switchLang/spanish'); ?>"><h3><img src="<?php echo base_url('assets/images/flag/spanish.png');?>" width="9%">Spanish</h3></a>
                    </li>
                    <li>
                      <a href="<?php echo base_url('LanguageSwitcher/switchLang/telugu'); ?>"><h3><img src="<?php echo base_url('assets/images/flag/telugu.png');?>" width="9%">Telugu</h3></a>
                    </li>
                    <li>
                      <a href="<?php echo base_url('LanguageSwitcher/switchLang/arabic'); ?>"><h3><img src="<?php echo base_url('assets/images/flag/arabic.png');?>" width="9%">Arabic</h3></a>
                    </li>
                    <li>
                      <a href="<?php echo base_url('LanguageSwitcher/switchLang/japanese'); ?>"><h3><img src="<?php echo base_url('assets/images/flag/japanese.png');?>" width="9%">Japanese</h3></a>
                    </li>
                    <li>
                      <a href="<?php echo base_url('LanguageSwitcher/switchLang/gujarati'); ?>"><h3><img src="<?php echo base_url('assets/images/flag/gujarati.png');?>" width="9%">Gujarati</h3></a>
                    </li>
                    <li>
                      <a href="<?php echo base_url('LanguageSwitcher/switchLang/portuguese'); ?>"><h3><img src="<?php echo base_url('assets/images/flag/portuguese.png');?>" width="9%">Portuguese</h3></a>
                    </li>
                    <li>
                      <a href="<?php echo base_url('LanguageSwitcher/switchLang/turkish'); ?>"><h3><img src="<?php echo base_url('assets/images/flag/turkish.png');?>" width="9%">Turkish</h3></a>
                    </li>
                  </ul>
                </li>
              </ul>
            </li>
            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="<?php echo base_url()?>auth/logout">
                <img src="<?php echo base_url();?>assets/dist/img/person.png" class="user-image" alt="User Image">
                <span class="hidden-xs" style="color: #000">Log Out</span>
              </a>
            </li>
            <!-- Control Sidebar Toggle Button -->
          </ul>
        </div>
      </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="<?php echo base_url();?>assets/dist/img/person2.jpg" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p><?php echo $this->session->userdata('first_name')." ".$this->session->userdata('last_name'); ?></p>
            <a href="#"><i class="fa fa-circle text-success"></i> <?php echo $this->lang->line('header_online'); ?></a>
          </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
          <li class="header"><?php echo $this->lang->line('header_main_navidation'); ?></li>
          <li class="active treeview">
            <a href="<?php echo base_url();?>auth/dashboard">
              <i class="fa fa-dashboard"></i> 
              <span><?php echo $this->lang->line('header_dashboard'); ?></span>
              <span class="pull-right-container">
                <!-- <i class="fa fa-angle-left pull-right"></i> -->
              </span>
            </a>
          </li>
          <?php
          if($this->session->userdata('type')=="admin" || $this->session->userdata('type')=="purchaser" || $this->session->userdata('type')=="manager"){
            ?>
            <li class="treeview">
              <a href="#" onclick="location.href = '<?php echo base_url("product/local_list");?>';">
                <i class="fa fa-cube text-blue"></i>
                <span><?php echo $this->lang->line('header_product') ?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-blue"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('product/local_list');?>"><i class="fa fa-circle-o text-green"></i>List</a></li>
                <li><a href="<?php echo base_url('product/add');?>"><i class="fa fa-circle-o text-yellow"></i>Add Product</a></li>
                <li><a href="<?php echo base_url('product/import');?>"><i class="fa fa-file-o text-maroon"></i>Import Products</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#" onclick="location.href = '<?php echo base_url("inventory");?>';">
                <i class="fa fa-shopping-basket text-purple"></i>
                <span>Inventory</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-purple"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('inventory');?>"><i class="fa fa-cubes text-green"></i>Inventory Item</a></li>
                <li><a href="<?php echo base_url('inventory/stock_record');?>"><i class="fa fa-bar-chart text-teal"></i>Stock Record</a></li>
                <li><a href="<?php echo base_url("inventory/check_out_history");?>"><i class="fa fa-sign-out text-yellow"></i>Check-Out History</a></li>
                <li><a href="<?php echo base_url("inventory/check_in_history");?>"><i class="fa fa-sign-in text-blue"></i>Check-In History</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="<?php echo base_url('product_alert');?>">
                <i class="fa  fa-warning text-suffron"></i>
                <span><?php echo $this->lang->line('header_product_alert'); ?></span>
                <span class="pull-right-container">
                  <span class="label label-danger pull-right">
                    <?php 
                    echo $data = $this->db->select('count(*) as count')
                    ->from('products p1')
                    ->join('products p2',"p1.product_id = p2.product_id")
                    ->where('p1.alert_quantity > p2.quantity')
                    ->get()
                    ->row()->count;
                    ?>
                  </span>
                </span>
              </a>
            </li>

            <li class="treeview">
              <a href="#" onclick="location.href = '<?php echo base_url("purchase");?>';">
                <i class="fa fa-square text-maroon"></i>
                <span><?php echo $this->lang->line('header_purchase'); ?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-maroon"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <!-- <li class="treeview">
                  <a href="#">
                    <i class="fa fa-bullseye text-blue"></i>
                    <span><?php echo $this->lang->line('header_purchase'); ?></span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right text-blue"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('purchase');?>"><i class="fa fa-circle-o text-green"></i><?php echo $this->lang->line('header_list'); ?></a></li>
                    <li><a href="<?php echo base_url('purchase/add');?>"><i class="fa fa-circle-o text-yellow"></i><?php echo $this->lang->line('header_add'); ?></a></li>
                  </ul>
                </li> -->
                <li><a href="<?php echo base_url('purchase');?>"><i class="fa fa-circle-o text-green"></i><?php echo $this->lang->line('header_list'); ?></a></li>
                <li><a href="<?php echo base_url('purchase/add');?>"><i class="fa fa-circle-o text-yellow"></i><?php echo $this->lang->line('header_add'); ?></a></li>
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-soccer-ball-o text-red"></i>
                    <span><?php echo $this->lang->line('header_purchase_return'); ?></span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right text-red"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('purchase_return');?>"><i class="fa fa-circle-o text-green"></i><?php echo $this->lang->line('header_list'); ?></a></li>
                    <li><a href="<?php echo base_url('purchase_return/add');?>"><i class="fa fa-circle-o text-yellow"></i><?php echo $this->lang->line('header_add'); ?></a></li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="<?php echo base_url('purchase/receipt');?>">
                    <i class="fa fa-square-o text-blue"></i>
                    <span>Receipt</span>
                  </a>
                </li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-cube text-blue"></i>
                <span><?php echo $this->lang->line('header_transfers'); ?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-blue"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('transfer');?>"><i class="fa fa-circle-o text-green"></i><?php echo $this->lang->line('header_list'); ?></a></li>
                <li><a href="<?php echo base_url('transfer/add');?>"><i class="fa fa-circle-o text-yellow"></i><?php echo $this->lang->line('header_add'); ?></a></li>
              </ul>
            </li>
            <?php
          }
          if($this->session->userdata('type')=="admin" || $this->session->userdata('type')=="sales_person" || $this->session->userdata('type')=="manager"){
            ?>
            <li class="treeview">
              <a href="#" onclick="location.href = '<?php echo base_url("sales");?>';">
                <i class="fa fa-shopping-cart text-aqua"></i>
                <span>Sales / Sample Submit</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-aqua"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('sales');?>"><i class="fa fa-circle-o text-green"></i><?php echo $this->lang->line('header_list'); ?></a></li>
                <li><a href="<?php echo base_url('sales/add');?>"><i class="fa fa-circle-o text-yellow"></i><?php echo $this->lang->line('header_add'); ?></a></li>
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-star text-green"></i>
                    <span><?php echo $this->lang->line('header_sales_return'); ?></span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right text-green"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('sales_return');?>"><i class="fa fa-lemon-o text-green"></i><?php echo $this->lang->line('header_list'); ?></a></li>
                    <li><a href="<?php echo base_url('sales_return/add');?>"><i class="fa fa-square-o text-yellow"></i><?php echo $this->lang->line('header_add'); ?></a></li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-star text-green"></i>
                    <span>Quotation</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right text-green"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('quotation');?>"><i class="fa fa-lemon-o text-green"></i><?php echo $this->lang->line('header_list'); ?></a></li>
                    <li><a href="<?php echo base_url('quotation/add');?>"><i class="fa fa-square-o text-yellow"></i><?php echo $this->lang->line('header_add'); ?></a></li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="<?php echo base_url('payment');?>">
                    <i class="fa fa-square-o text-blue"></i>
                    <span><?php echo $this->lang->line('header_payment'); ?></span>
                  </a>
                </li>
                <li class="treeview">
                  <a href="<?php echo base_url('sales/invoice');?>">
                    <i class="fa fa-square-o text-red"></i>
                    <span><?php echo $this->lang->line('header_invoice'); ?></span>
                  </a>
                </li>
              </ul>
            </li>
            <?php
          }
          if($this->session->userdata('type')=="admin" || $this->session->userdata('type')=="manager"){
            ?>
            <li class="treeview">
              <a href="#" onclick="location.href = '<?php echo base_url("email/quotation");?>';">
                <i class="fa fa-sliders text-yellow"></i>
                <span>Work Station</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-yellow"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url("email/raw");?>"><i class="fa fa-language text-red"></i>New Email</a></li>
                <li><a href="<?php echo base_url("email/inquiry_mail");?>"><i class="fa fa-language text-yellow"></i>Inquiry Mail</a></li>
                <li><a href="<?php echo base_url("email/quotation");?>"><i class="fa fa-language text-aqua"></i>Quotation</a></li>
                <li><a href="<?php echo base_url("email/proforma_invoice");?>"><i class="fa fa-language text-black"></i>Proforma Invoice / Indent</a></li>
                <li><a href="<?php echo base_url("email/sample_draft");?>"><i class="fa fa-language text-green"></i>Forwarding / O.C</a><hr style="margin: 5px"></li>
                <!-- <li><a href="<?php echo base_url('Email');?>"><i class="fa fa-edit text-purple"></i>Email Status</a></li> -->
                <li><a href="<?php echo base_url('email/remittance_history');?>"><i class="fa fa-ioxhost text-olive"></i>Remittance History</a></li>
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-wrench text-maroon"></i><span>Configuration</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right text-maroon"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo base_url("email/bankers_list");?>"><i class="fa fa-circle-o text-red"></i>Banker</a></li>

                    <li><a href="<?php echo base_url("email/consignee_list");?>"><i class="fa fa-circle-o text-yellow"></i>Consignee</a></li>

                    <li><a href="<?php echo base_url("email/shipping_mode_list");?>"><i class="fa fa-circle-o text-aqua"></i>Shipping Mode</a></li>

                    <li><a href="<?php echo base_url("email/payment_list");?>"><i class="fa fa-circle-o text-black"></i>Payment Mode</a></li>

                    <li><a href="<?php echo base_url("email/commission_list");?>"><i class="fa fa-circle-o text-green"></i>Commission</a></li>

                    <li><a href="<?php echo base_url("email/port_list");?>"><i class="fa fa-circle-o text-purple"></i>Port of Loading</a></li>

                    <li><a href="<?php echo base_url("email/port_of_discharge_list");?>"><i class="fa fa-circle-o text-teal"></i>Port of Discharge</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <?php
          }
          ?>
          <li class="treeview">
            <a href="<?php echo base_url('documents');?>">
              <i class="fa fa-file-word-o text-gray"></i>
              <span>Documents</span>
            </a>
          </li>
          <?php
          if($this->session->userdata('type')=="admin" || $this->session->userdata('type')=="manager"){
            ?>
             <li class="treeview">
              <a href="#">
                <i class="fa fa-calculator text-green"></i>
                <span>Office Accounts</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-green"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="treeview">
                  <a href="#" onclick="location.href = '<?php echo base_url("asset");?>';">
                    <i class="fa fa-bank text-teal"></i>
                    <span>Asset</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right text-teal"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('asset');?>"><i class="fa fa-circle-o text-green"></i><?php echo $this->lang->line('header_list'); ?></a></li>
                    <li><a href="<?php echo base_url('asset/add');?>"><i class="fa fa-circle-o text-yellow"></i><?php echo $this->lang->line('header_add'); ?></a></li>
                  </ul>
                </li>

                <li class="treeview">
                  <a href="#" onclick="location.href = '<?php echo base_url("ta_da");?>';">
                    <i class="fa fa-paper-plane text-maroon"></i>
                    <span>TA/DA & Tiffin</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right text-maroon"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('ta_da');?>"><i class="fa fa-circle-o text-green"></i><?php echo $this->lang->line('header_list'); ?></a></li>
                    <li><a href="<?php echo base_url('ta_da/add');?>"><i class="fa fa-circle-o text-yellow"></i><?php echo $this->lang->line('header_add'); ?></a></li>
                  </ul>
                </li>
              </ul>
            </li>

            <?php
          }
          if($this->session->userdata('type')=="admin" || $this->session->userdata('type')=="accountant"){
            ?>
            <li class="treeview">
              <a href="<?php echo base_url('petty_cash');?>">
                <i class="fa fa-money text-light-blue"></i>
                <span>Petty Cash</span>
              </a>
            </li>
            <?php
          }
          if($this->session->userdata('type')=="admin"){
            ?>
            <li class="treeview">
              <a href="#" onclick="location.href = '<?php echo base_url("notice");?>';">
                <i class="fa fa-bullhorn text-fuchsia"></i>
                <span>Notice</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-fuchsia"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('notice');?>"><i class="fa fa-circle-o text-green"></i><?php echo $this->lang->line('header_list'); ?></a></li>
                <li><a href="<?php echo base_url('notice/add');?>"><i class="fa fa-circle-o text-yellow"></i><?php echo $this->lang->line('header_add'); ?></a></li>
              </ul>
            </li>
            <?php
          }
          if($this->session->userdata('type')=="admin" || $this->session->userdata('type')=="accountant" || $this->session->userdata('type')=="manager"){
            ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-file text-yellow"></i>
                <span><?php echo $this->lang->line('header_reports'); ?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-yellow"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="treeview">
                  <a href="<?php echo base_url('reports/daily'); ?>">
                    <i class="fa fa-circle-thin text-maroon"></i>
                    <span><?php echo $this->lang->line('header_daily'); ?></span>
                  </a>
                </li>
                <li class="treeview">
                  <a href="<?php echo base_url('reports/products'); ?>">
                    <i class="fa fa-cube text-red"></i>
                    <span><?php echo $this->lang->line('header_product'); ?></span>
                  </a>
                </li>

                <li class="treeview">
                  <a href="<?php echo base_url('reports/purchase'); ?>">
                    <i class="fa fa-square text-green"></i>
                    <span><?php echo $this->lang->line('header_purchase'); ?></span>
                  </a>
                </li>
                <li class="treeview">
                  <a href="<?php echo base_url('reports/purchase_return'); ?>">
                    <i class="fa fa-soccer-ball-o text-aqua"></i>
                    <span><?php echo $this->lang->line('header_purchase_return'); ?></span>
                  </a>
                </li>

                <li class="treeview">
                  <a href="<?php echo base_url('reports/sales'); ?>">
                    <i class="fa fa-shopping-cart text-gray"></i>
                    <span><?php echo $this->lang->line('header_sales'); ?></span>
                  </a>
                </li>
                <li class="treeview">
                  <a href="<?php echo base_url('reports/sales_return'); ?>">
                    <i class="fa fa-star text-suffron"></i>
                    <span><?php echo $this->lang->line('header_sales_return'); ?></span>
                  </a>
                </li>
                <li class="treeview">
                  <a href="<?php echo base_url('reports/tax'); ?>">
                    <i class="fa fa-legal text-maroon"></i>
                    <span>Tax</span>
                  </a>
                </li>
              </ul>
            </li>
            <?php 
          }/*
          if($this->session->userdata('type')=="admin" || $this->session->userdata('type')=="manager" || $this->session->userdata('type')=="sales_person"){
            ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-users text-green"></i>
                <span><?php echo $this->lang->line('header_people'); ?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-green"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <?php
                if($this->session->userdata('type')=="admin"){
                  ?>
                  <li class="treeview">
                    <a href="#">
                      <i class="fa  fa-user text-blue"></i>
                      <span><?php echo $this->lang->line('header_users'); ?></span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right text-blue"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="<?php echo base_url('auth');?>"><i class="fa fa-circle-o text-green"></i><?php echo $this->lang->line('header_list'); ?></a></li>
                      <li><a href="<?php echo base_url('auth/create_user');?>"><i class="fa fa-circle-o text-yellow"></i><?php echo $this->lang->line('header_add'); ?></a></li>
                    </ul>
                  </li>
                  <li class="treeview">
                    <a href="#">
                      <i class="fa  fa-user text-red"></i>
                      <span><?php echo $this->lang->line('header_billers'); ?></span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right text-red"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="<?php echo base_url('biller');?>"><i class="fa fa-circle-o text-green"></i><?php echo $this->lang->line('header_list'); ?></a></li>
                      <li><a href="<?php echo base_url('biller/add');?>"><i class="fa fa-circle-o text-yellow"></i><?php echo $this->lang->line('header_add'); ?></a></li>
                    </ul>
                  </li>
                  <?php
                }
                if($this->session->userdata('type')=="admin" || $this->session->userdata('type')=="sales_person"){
                  ?>
                  <li class="treeview">
                    <a href="#">
                      <i class="fa  fa-user text-maroon"></i>
                      <span><?php echo $this->lang->line('header_clients'); ?></span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right text-maroon"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="<?php echo base_url('client');?>"><i class="fa fa-circle-o text-green"></i><?php echo $this->lang->line('header_list'); ?></a></li>
                      <li><a href="<?php echo base_url('client/add');?>"><i class="fa fa-circle-o text-yellow"></i><?php echo $this->lang->line('header_add'); ?></a></li>
                      <!-- <li><a href="<?php echo base_url('client/type');?>"><i class="fa fa-circle-o text-blue"></i><?php echo $this->lang->line('header_type'); ?></a></li> -->
                    </ul>
                  </li>
                  <?php
                }
                if($this->session->userdata('type')=="admin" || $this->session->userdata('type')=="manager"){
                  ?>
                  <li class="treeview">
                    <a href="#">
                      <i class="fa  fa-user text-yellow"></i>
                      <span><?php echo $this->lang->line('header_suppliers'); ?></span>
                      <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right text-yellow"></i>
                      </span>
                    </a>
                    <ul class="treeview-menu">
                      <li><a href="<?php echo base_url('supplier');?>"><i class="fa fa-circle-o text-green"></i><?php echo $this->lang->line('header_list'); ?></a></li>
                      <li><a href="<?php echo base_url('supplier/add');?>"><i class="fa fa-circle-o text-yellow"></i><?php echo $this->lang->line('header_add'); ?></a></li>
                    </ul>
                  </li>
                  <?php
                }
                ?>
              </ul>
            </li>
            <?php 
          }*/
          if($this->session->userdata('type')=="admin" || $this->session->userdata('type')=="manager"){
            ?>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-cog text-red"></i>
                <span><?php echo $this->lang->line('header_setting'); ?></span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-red"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="treeview">
                  <a href="<?php echo base_url('company_setting') ?>">
                    <i class="fa fa-dot-circle-o text-maroon"></i>
                    <span><?php echo $this->lang->line('header_company_setting'); ?></span>
                  </a>
                </li>
                <?php
                  if($this->session->userdata('type')=="admin"){
                    ?>
                    <li class="treeview">
                      <a href="#" onclick="location.href = '<?php echo base_url("auth");?>';">
                        <i class="fa  fa-user text-blue"></i>
                        <span><?php echo $this->lang->line('header_users'); ?></span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right text-blue"></i>
                        </span>
                      </a>
                      <ul class="treeview-menu">
                        <li><a href="<?php echo base_url('auth');?>"><i class="fa fa-circle-o text-green"></i><?php echo $this->lang->line('header_list'); ?></a></li>
                        <!-- <li><a href="<?php echo base_url('auth/create_user');?>"><i class="fa fa-circle-o text-yellow"></i><?php echo $this->lang->line('header_add'); ?></a></li> -->
                      </ul>
                    </li>
                    <li class="treeview">
                      <a href="#" onclick="location.href = '<?php echo base_url("employee");?>';">
                        <i class="fa fa-user text-yellow"></i>
                        <span>Employee</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right text-yellow"></i>
                        </span>
                      </a>
                      <ul class="treeview-menu">
                        <li><a href="<?php echo base_url('employee');?>"><i class="fa fa-circle-o text-green"></i><?php echo $this->lang->line('header_list'); ?></a></li>
                        <li><a href="<?php echo base_url('employee/add');?>"><i class="fa fa-circle-o text-yellow"></i><?php echo $this->lang->line('header_add'); ?></a></li>
                        <!-- <li><a href="<?php echo base_url('employee/import');?>"><i class="fa fa-circle-o text-red"></i>Import Attendance</a></li>
                        <li><a href="<?php echo base_url('employee/attendance');?>"><i class="fa fa-circle-o text-blue"></i>Attendance List</a></li>
                        <li><a href="<?php echo base_url('employee/salary_sheet');?>"><i class="fa fa-circle-o text-aqua"></i>Salary Sheet</a></li> -->
                      </ul>
                    </li>
                    <li class="treeview">
                      <a href="#">
                        <i class="fa  fa-user text-red"></i>
                        <span><?php echo $this->lang->line('header_billers'); ?></span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right text-red"></i>
                        </span>
                      </a>
                      <ul class="treeview-menu">
                        <li><a href="<?php echo base_url('biller');?>"><i class="fa fa-circle-o text-green"></i><?php echo $this->lang->line('header_list'); ?></a></li>
                        <li><a href="<?php echo base_url('biller/add');?>"><i class="fa fa-circle-o text-yellow"></i><?php echo $this->lang->line('header_add'); ?></a></li>
                      </ul>
                    </li>
                    <?php
                  }
                  if($this->session->userdata('type')=="admin" || $this->session->userdata('type')=="manager"){
                    ?>
                    <li class="treeview">
                      <a href="#" onclick="location.href = '<?php echo base_url("client");?>';">
                        <i class="fa  fa-user text-maroon"></i>
                        <span><?php echo $this->lang->line('header_clients'); ?></span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right text-maroon"></i>
                        </span>
                      </a>
                      <ul class="treeview-menu">
                        <li><a href="<?php echo base_url('client');?>"><i class="fa fa-circle-o text-green"></i><?php echo $this->lang->line('header_list'); ?></a></li>
                        <li><a href="<?php echo base_url('client/add');?>"><i class="fa fa-circle-o text-yellow"></i><?php echo $this->lang->line('header_add'); ?></a></li>
                        <!-- <li><a href="<?php echo base_url('client/type');?>"><i class="fa fa-circle-o text-blue"></i><?php echo $this->lang->line('header_type'); ?></a></li> -->
                      </ul>
                    </li>
                    <?php
                  }
                  if($this->session->userdata('type')=="admin" || $this->session->userdata('type')=="manager"){
                    ?>
                    <li class="treeview">
                      <a href="#">
                        <i class="fa  fa-user text-yellow"></i>
                        <span><?php echo $this->lang->line('header_suppliers'); ?></span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right text-yellow"></i>
                        </span>
                      </a>
                      <ul class="treeview-menu">
                        <li><a href="<?php echo base_url('supplier');?>"><i class="fa fa-circle-o text-green"></i><?php echo $this->lang->line('header_list'); ?></a></li>
                        <li><a href="<?php echo base_url('supplier/add');?>"><i class="fa fa-circle-o text-yellow"></i><?php echo $this->lang->line('header_add'); ?></a></li>
                      </ul>
                    </li>
                    <?php
                  }
                ?>
                <li class="treeview">
                  <a href="#" onclick="location.href = '<?php echo base_url("category");?>';">
                    <i class="fa fa-tags text-green"></i>
                    <span><?php echo $this->lang->line('header_category'); ?></span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right text-green"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo base_url("category");?>"><i class="fa fa-circle-o text-green"></i><?php echo $this->lang->line('header_list'); ?></a></li>
                    <li><a href="<?php echo base_url("category/add");?>"><i class="fa fa-circle-o text-yellow"></i><?php echo $this->lang->line('header_add'); ?></a></li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#" onclick="location.href = '<?php echo base_url("subcategory");?>';">
                    <i class="fa fa-qrcode text-blue"></i>
                    <span><?php echo $this->lang->line('header_sub_category'); ?></span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right text-blue"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo base_url("subcategory");?>"><i class="fa fa-circle-o text-green"></i><?php echo $this->lang->line('header_list'); ?></a></li>
                    <li><a href="<?php echo base_url("subcategory/add");?>"><i class="fa fa-circle-o text-yellow"></i><?php echo $this->lang->line('header_add'); ?></a></li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#" onclick="location.href = '<?php echo base_url("unit");?>';">
                    <i class="fa fa-dropbox text-teal"></i>
                    <span>Unit</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right text-teal"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo base_url("unit");?>"><i class="fa fa-circle-o text-green"></i>List</a></li>
                    <li><a href="<?php echo base_url("unit/add");?>"><i class="fa fa-circle-o text-yellow"></i>Add</a></li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#" onclick="location.href = '<?php echo base_url("shelf");?>';">
                    <i class="fa fa-codepen text-orange"></i>
                    <span>Shelf</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right text-orange"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo base_url("shelf");?>"><i class="fa fa-circle-o text-green"></i>List</a></li>
                    <li><a href="<?php echo base_url("shelf/add");?>"><i class="fa fa-circle-o text-yellow"></i>Add</a></li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#" onclick="location.href = '<?php echo base_url("rack");?>';">
                    <i class="fa fa-align-center text-purple"></i>
                    <span>Rack</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right text-purple"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo base_url("rack");?>"><i class="fa fa-circle-o text-green"></i>List</a></li>
                    <li><a href="<?php echo base_url("rack/add");?>"><i class="fa fa-circle-o text-yellow"></i>Add</a></li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#" onclick="location.href = '<?php echo base_url("courier");?>';">
                    <i class="fa fa-plane text-fuchsia"></i>
                    <span>Courier</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right text-fuchsia"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo base_url("courier");?>"><i class="fa fa-circle-o text-green"></i>List</a></li>
                    <li><a href="<?php echo base_url("courier/add");?>"><i class="fa fa-circle-o text-yellow"></i>Add</a></li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-suitcase text-yellow"></i>
                    <span><?php echo $this->lang->line('header_branch'); ?></span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right text-yellow"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo base_url("branch");?>"><i class="fa fa-circle-o text-green"></i><?php echo $this->lang->line('header_list'); ?></a></li>
                    <li><a href="<?php echo base_url("branch/add");?>"><i class="fa fa-circle-o text-yellow"></i><?php echo $this->lang->line('header_add'); ?></a></li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-bold"></i>
                    <span><?php echo $this->lang->line('header_brand'); ?></span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right text-red"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo base_url("brand");?>"><i class="fa fa-circle-o text-green"></i><?php echo $this->lang->line('header_list'); ?></a></li>
                    <li><a href="<?php echo base_url("brand/add");?>"><i class="fa fa-circle-o text-yellow"></i><?php echo $this->lang->line('header_add'); ?></a></li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-hourglass text-gray"></i>
                    <span><?php echo $this->lang->line('header_discount'); ?></span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right text-gray"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo base_url("discount");?>"><i class="fa fa-circle-o text-green"></i><?php echo $this->lang->line('header_list'); ?></a></li>
                    <li><a href="<?php echo base_url("discount/add");?>"><i class="fa fa-circle-o text-yellow"></i><?php echo $this->lang->line('header_add'); ?></a></li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-legal text-aqua"></i>
                    <span><?php echo $this->lang->line('header_tax'); ?></span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right text-aqua"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo base_url("tax");?>"><i class="fa fa-circle-o text-green"></i><?php echo $this->lang->line('header_list'); ?></a></li>
                    <li><a href="<?php echo base_url("tax/add");?>"><i class="fa fa-circle-o text-yellow"></i><?php echo $this->lang->line('header_add'); ?></a></li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-university text-suffron"></i>
                    <span><?php echo $this->lang->line('header_warehouse'); ?></span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right text-suffron"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo base_url("warehouse");?>"><i class="fa fa-circle-o text-green"></i><?php echo $this->lang->line('header_list'); ?></a></li>
                    <li><a href="<?php echo base_url("warehouse/add");?>"><i class="fa fa-circle-o text-yellow"></i><?php echo $this->lang->line('header_add'); ?></a></li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="#">
                    <i class="fa fa-th-large text-maroon"></i>
                    <span><?php echo $this->lang->line('header_assign_warehouse'); ?></span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right text-maroon"></i>
                    </span>
                  </a>
                  <ul class="treeview-menu">
                    <li><a href="<?php echo base_url('assign_warehouse');?>"><i class="fa fa-circle-o text-green"></i><?php echo $this->lang->line('header_list'); ?></a></li>
                    <li><a href="<?php echo base_url('assign_warehouse/add');?>"><i class="fa fa-circle-o text-yellow"></i><?php echo $this->lang->line('header_add'); ?></a></li>
                  </ul>
                </li>
                <li class="treeview">
                  <a href="<?php echo base_url('email');?>">
                    <i class="fa fa-envelope-o text-yellow"></i>
                    <span>Email Setup</span>
                  </a>
                </li>
              </ul>
            </li>
            <li class="treeview">
              <a href="<?php echo base_url('log');?>">
                <i class="fa fa-history text-maroon"></i>
                <span>Logs</span>
              </a>
            </li>
            <!-- <li class="treeview">
              <a href="#">
                <i class="fa fa-th-large text-maroon"></i>
                <span>Account</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-maroon"></i>
                </span>
              </a>
              <ul class="treeview-menu">
               <li class="treeview">
                <a href="#">
                  <i class="fa fa-th-large text-maroon"></i>
                  <span>Account Group</span>
                  <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right text-maroon"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li><a href="<?php echo base_url('accountgroup');?>"><i class="fa fa-circle-o text-green"></i><?php echo $this->lang->line('header_list'); ?></a></li>
                  <li><a href="<?php echo base_url('accountgroup/add');?>"><i class="fa fa-circle-o text-yellow"></i><?php echo $this->lang->line('header_add'); ?></a></li>
                </ul>
              </li>
              <li class="treeview"><a href="#">
                <i class="fa fa-th-large text-maroon"></i>
                <span>Ledger</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-maroon"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url('ledger');?>"><i class="fa fa-circle-o text-green"></i><?php echo $this->lang->line('header_list'); ?></a></li>
                <li><a href="<?php echo base_url('ledger/add');?>"><i class="fa fa-circle-o text-yellow"></i><?php echo $this->lang->line('header_add'); ?></a></li>
              </ul>
            </li> -->
            <li class="treeview">
              <a href="<?php echo base_url('auth/logout');?>">
                <i class="fa fa-sign-out text-black"></i>
                <span>Log Out</span>
              </a>
            </li>
            <?php
          }
          ?>
        </ul>
      </section>
      <!-- /.sidebar -->
    </aside>

    <!-- submit button loader -->
    <style type="text/css">
      .button {
        position: relative;
        display: inline-block;
        text-align: center;
        padding: 1.6rem 3.125rem;
        border-radius: 0.3125rem;
        color: #000;
        font-weight: 400;
        overflow: hidden;
      }
      .button:before {
        position: absolute;
        content: '';
        bottom: 0;
        left: 0;
        width: 0%;
        height: 100%;
        background-color: #54d98c;
      }
      .button span {
        position: absolute;
        line-height: 0;
      }
      .button span i {
        transform-origin: center center;
      }
      .button span:nth-of-type(1) {
        top: 50%;
        transform: translateY(-50%);
      }
      .button span:nth-of-type(2) {
        top: 100%;
        transform: translateY(0%);
        font-size: 24px;
      }
      .button span:nth-of-type(3) {
        display: none;
      }
      .button.active {
        background-color: #2ecc71;
      }
      .button.active:before {
        width: 100%;
        transition: width 2.5s linear;
      }
      .button.active span:nth-of-type(1) {
        top: -100%;
        transform: translateY(-50%);
      }
      .button.active span:nth-of-type(2) {
        top: 50%;
        transform: translateY(-50%);
      }
      .button.active span:nth-of-type(2) i {
        animation: loading 1000ms linear infinite;
      }
      .button.active span:nth-of-type(3) {
        display: none;
      }
      @keyframes loading {
        100% {
          transform: rotate(360deg);
        }
      }
      @keyframes scale {
        0% {
          transform: scale(10);
        }
        50% {
          transform: scale(0.2);
        }
        70% {
          transform: scale(1.2);
        }
        90% {
          transform: scale(0.7);
        }
        100% {
          transform: scale(1);
        }
      }
    </style>
    <!-- submit button loader -->