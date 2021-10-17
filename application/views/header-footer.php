<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Advanced form elements</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
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
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url('assets/'); ?>dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b> <img src="<?php  echo base_url(); ?>assets/images/logo2.png"/></b><br><h5>Perfect mobile inventory system</h5></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success">4</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 4 messages</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- start message -->
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Support Team
                        <small><i class="fa fa-clock-o"></i> 5 mins</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <!-- end message -->
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url();?>assets/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        AdminLTE Design Team
                        <small><i class="fa fa-clock-o"></i> 2 hours</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url();?>assets/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Developers
                        <small><i class="fa fa-clock-o"></i> Today</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url();?>assets/dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Sales Department
                        <small><i class="fa fa-clock-o"></i> Yesterday</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <div class="pull-left">
                        <img src="<?php echo base_url();?>assets/dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
                      </div>
                      <h4>
                        Reviewers
                        <small><i class="fa fa-clock-o"></i> 2 days</small>
                      </h4>
                      <p>Why not buy a new awesome theme?</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">See All Messages</a></li>
            </ul>
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-warning">10</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 10 notifications</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-aqua"></i> 5 new members joined today
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                      page and may cause design problems
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-users text-red"></i> 5 new members joined
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                    </a>
                  </li>
                  <li>
                    <a href="#">
                      <i class="fa fa-user text-red"></i> You changed your username
                    </a>
                  </li>
                </ul>
              </li>
              <li class="footer"><a href="#">View all</a></li>
            </ul>
          </li>
          <!-- Tasks: style can be found in dropdown.less -->
          <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>
              <span class="label label-danger">9</span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have 9 tasks</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Design some buttons
                        <small class="pull-right">20%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">20% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Create a nice theme
                        <small class="pull-right">40%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">40% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Some task I need to do
                        <small class="pull-right">60%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">60% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                  <li><!-- Task item -->
                    <a href="#">
                      <h3>
                        Make beautiful transitions
                        <small class="pull-right">80%</small>
                      </h3>
                      <div class="progress xs">
                        <div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                          <span class="sr-only">80% Complete</span>
                        </div>
                      </div>
                    </a>
                  </li>
                  <!-- end task item -->
                </ul>
              </li>
              <li class="footer">
                <a href="#">View all tasks</a>
              </li>
            </ul>
          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Alexander Pierce</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  Alexander Pierce - Web Developer
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-4 text-center">
                    <a href="#">Followers</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Sales</a>
                  </div>
                  <div class="col-xs-4 text-center">
                    <a href="#">Friends</a>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo base_url()?>auth/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
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
          <img src="<?php echo base_url();?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="<?php echo base_url();?>auth">
            <i class="fa fa-dashboard"></i> 
            <span>Dashboard</span>
            <span class="pull-right-container">
              <!-- <i class="fa fa-angle-left pull-right"></i> -->
            </span>
          </a>
        </li>
        <?php
          if($this->session->userdata('type')=="admin" || $this->session->userdata('type')=="purchaser" || $this->session->userdata('type')=="manager"){
        ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cube text-blue"></i>
            <span>Product</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right text-blue"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-green"></i>List</a></li>
            <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-yellow"></i>Add</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa  fa-warning text-suffron"></i>
            <span>Product Alert</span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-green"></i>List</a></li>
            <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-yellow"></i>Add</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-square text-maroon"></i>
            <span>Purchase</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right text-maroon"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#">
                <i class="fa fa-bullseye text-blue"></i>
                <span>Purchase</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-blue"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-green"></i>List</a></li>
                <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-yellow"></i>Add</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-soccer-ball-o text-red"></i>
                <span>Purchase Return</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-red"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-green"></i>List</a></li>
                <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-yellow"></i>Add</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <?php
          }
          if($this->session->userdata('type')=="admin" || $this->session->userdata('type')=="sales_person" || $this->session->userdata('type')=="manager"){
        ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-shopping-cart text-aqua"></i>
            <span>Sales</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right text-aqua"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#">
                <i class="fa fa-spinner text-yellow"></i>
                <span>Sales</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-yellow"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-green"></i>List</a></li>
                <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-yellow"></i>Add</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-star text-green"></i>
                <span>Sales Return</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-green"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-green"></i>List</a></li>
                <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-yellow"></i>Add</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <?php
          }
          if($this->session->userdata('type')=="admin" || $this->session->userdata('type')=="accountant" || $this->session->userdata('type')=="manager"){
        ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-file text-yellow"></i>
            <span>Reports</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right text-yellow"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#">
                <i class="fa fa-circle-thin text-maroon"></i>
                <span>Daily</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-maroon"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-green"></i>List</a></li>
                <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-yellow"></i>Add</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-cube text-red"></i>
                <span>Product</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-red"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-green"></i>List</a></li>
                <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-yellow"></i>Add</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-square text-green"></i>
                <span>Purchase</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-green"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-green"></i>List</a></li>
                <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-yellow"></i>Add</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-soccer-ball-o text-aqua"></i>
                <span>Purchase Return</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-aqua"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-green"></i>List</a></li>
                <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-yellow"></i>Add</a></li>
              </ul>
            </li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-shopping-cart text-gray"></i>
                <span>Sales</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-gray"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-green"></i>List</a></li>
                <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-yellow"></i>Add</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-star text-suffron"></i>
                <span>Sales Return</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-suffron"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-green"></i>List</a></li>
                <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-yellow"></i>Add</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <?php 
          }
          if($this->session->userdata('type')=="admin" || $this->session->userdata('type')=="manager" || $this->session->userdata('type')=="sales_person"){
        ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users text-green"></i>
            <span>People</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right text-green"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#">
                <i class="fa  fa-user text-blue"></i>
                <span>Users</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-blue"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-green"></i>List</a></li>
                <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-yellow"></i>Add</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa  fa-user text-red"></i>
                <span>Billers</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-red"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-green"></i>List</a></li>
                <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-yellow"></i>Add</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa  fa-user text-maroon"></i>
                <span>Clients</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-maroon"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-green"></i>List</a></li>
                <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-yellow"></i>Add</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa  fa-user text-yellow"></i>
                <span>Suppliers</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-yellow"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-green"></i>List</a></li>
                <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-yellow"></i>Add</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <?php 
          }
          if($this->session->userdata('type')=="admin" || $this->session->userdata('type')=="manager"){
        ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cog text-red"></i>
            <span>Setting</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right text-red"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="treeview">
              <a href="#">
                <i class="fa fa-tags text-green"></i>
                <span>category</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-green"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url("category");?>"><i class="fa fa-circle-o text-green"></i>List</a></li>
                <li><a href="<?php echo base_url("category/add");?>"><i class="fa fa-circle-o text-yellow"></i>Add</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-qrcode text-blue"></i>
                <span>Subcategory</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-blue"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url("subcategory");?>"><i class="fa fa-circle-o text-green"></i>List</a></li>
                <li><a href="<?php echo base_url("subcategory/add");?>"><i class="fa fa-circle-o text-yellow"></i>Add</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-suitcase text-yellow"></i>
                <span>Branch</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-yellow"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url("branch");?>"><i class="fa fa-circle-o text-green"></i>List</a></li>
                <li><a href="<?php echo base_url("branch/add");?>"><i class="fa fa-circle-o text-yellow"></i>Add</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-hourglass text-gray"></i>
                <span>Discount</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-gray"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url("discount");?>"><i class="fa fa-circle-o text-green"></i>List</a></li>
                <li><a href="<?php echo base_url("discount/add");?>"><i class="fa fa-circle-o text-yellow"></i>Add</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-legal text-aqua"></i>
                <span>Tax</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-aqua"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url("tax");?>"><i class="fa fa-circle-o text-green"></i>List</a></li>
                <li><a href="<?php echo base_url("tax/add");?>"><i class="fa fa-circle-o text-yellow"></i>Add</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-university text-suffron"></i>
                <span>Warehouse</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-suffron"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url("warehouse");?>"><i class="fa fa-circle-o text-green"></i>List</a></li>
                <li><a href="<?php echo base_url("warehouse/add");?>"><i class="fa fa-circle-o text-yellow"></i>Add</a></li>
              </ul>
            </li>
            <li class="treeview">
              <a href="#">
                <i class="fa fa-dot-circle-o text-maroon"></i>
                <span>Assign Warehouse</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right text-maroon"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-green"></i>List</a></li>
                <li><a href="<?php echo base_url();?>"><i class="fa fa-circle-o text-yellow"></i>Add</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <?php
          }
        ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
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
                <form role="form" id="form" method="post" action="<?php echo base_url('subcategory/addSubcategory');?>">
                  <div class="form-group">
                    <label for="category">Select Category <span class="validation-color">*</span></label>
                    <select class="form-control select2" id="category" name="category" style="width: 100%;">
                      <?php
                        foreach ($data as $row) {
                          echo "<option value='$row->category_id'".set_select('category',$row->category_id).">$row->category_name</option>";
                        }
                      ?>
                    </select>
                    <span class="validation-color" id="err_category"><?php echo form_error('category'); ?></span>
                  </div>
                  <!-- /.form-group -->
                  <div class="form-group">
                    <label for="subcategory_name">Subcategory Name <span class="validation-color">*</span></label>
                    <input type="text" class="form-control" id="subcategory_name" name="subcategory_name" value="<?php echo set_value('subcategory_name'); ?>">
                    <span class="validation-color" id="err_subcategory_name"><?php echo form_error('subcategory_name'); ?></span>
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
<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="http://rrmsense.com/" target="_blank">RRMSENSE</a>.</strong> All rights
    reserved.
  </footer>
<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url('assets/'); ?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('assets/'); ?>bootstrap/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url('assets/'); ?>plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url('assets/'); ?>plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url('assets/'); ?>plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?php echo base_url('assets/'); ?>plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src=".<?php echo base_url('assets/'); ?>plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo base_url('assets/'); ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url('assets/'); ?>plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/'); ?>plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/'); ?>dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/'); ?>dist/js/demo.js"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
    $('#reservation2').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

    //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
  });
</script>
</body>
</html>
