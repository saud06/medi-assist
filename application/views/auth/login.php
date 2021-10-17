<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>WinMark | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- <style>
    .login-btn-group{
      text-align: center;
    }
  </style> -->

</head>
<body class="hold-transition login-page" style="background: #394354; color: #A4B1C7">
<!--<div id="particles-js"></div>-->
<div class="login-box">
  <div class="login-logo" style="background-color: #ffffff; padding: 0; margin-left: 18px; margin-right: 18px;">
    <?php
      $data = $this->db->get('company_settings')->row();
      //print_r($data);
      if($data!=""){
        if($data->logo){
    ?>
      <b> <img src="<?php echo base_url($data->logo); ?>" width="100%"/></b><?php } else{?><img src="<?php echo base_url(); ?>/assets/images/logo.png" width="100%"/><?php }?>
    <?php }else{
    ?>
      <b>Win</b><b style="color: red;">Mark</b>
    <?php
      }
    ?>
  </div>
  <!-- /.login-logo -->

  <div class="login-box-body" style="background: #394354;">
    <h5 class="login-box-msg" style="color: #A4B1C7;">Sign in to start your session</h5>
    <div id="infoMessage" style="text-align: center; color: red;"><?php echo $message;?></div>
    <!-- <form action="../../index2.html" method="post"> -->
    <?php echo form_open("auth/login");?>
      <div class="form-group has-feedback">
        <!-- <input type="email" class="form-control" placeholder="Email"> -->
        <?php echo form_input($identity,'','class="form-control" placeholder="User ID" style="color: #A4B1C7; background-color: #394354;"');?>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <!-- <input type="password" class="form-control" placeholder="Password"> -->
        <?php echo form_input($password,'','class="form-control" placeholder="Password" style="color: #A4B1C7; background-color: #394354;"');?>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <!-- <div class="col-xs-12">
          <div class="checkbox icheck" style="text-align: center;">
            <label style="color: #A4B1C7;">
              Remember Me &nbsp;
              <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
            </label>
          </div>
        </div> -->

        <style type="text/css">
          .myLinkClass:hover {
            -webkit-transition: all 250ms;
            -moz-transition: all 250ms;
            transition: all 250ms;
            background-color: #70DB9A;
            box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
          }
        </style>

        <div class="col-xs-12">
          <!-- <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button> -->
          <?php echo form_submit('submit', lang('login_submit_btn'),'class="btn btn-primary btn-block btn-flat myLinkClass"');?>
        </div>
        <!-- /.col -->
      </div>
    <?php echo form_close();?>
    <!-- </form> -->

    <br>
    <!-- <a href="#">I forgot my password</a><br> -->
    <div style="text-align: center;">
      <!-- <a href="forgot_password"><?php echo lang('login_forgot_password');?></a><br><br> -->
      <p style="color: #fff;">Copyright &copy; <?php echo date('Y') ?> Winmark BD Ltd. - All rights reserved.</p>
    </div>
   <!--  <a href="register.html" class="text-center">Register a new membership</a> -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- <div class="login-btn-group">
  <h3>Click a button below to login as</h3><br><br>
  <div class="col-md-1"></div>

  <div class="col-md-2">
    <button type="button" class="btn btn-lg btn-primary" onclick="setCredentials('admin')">Admin</button>
  </div>

  <div class="col-md-2">
    <button type="button" class="btn btn-lg btn-primary" onclick="setCredentials('manager')">Manager</button>
  </div>

  <div class="col-md-2">
    <button type="button" class="btn btn-lg btn-primary" onclick="setCredentials('accountant')">Accountant</button>
  </div>

  <div class="col-md-2">
    <button type="button" class="btn btn-lg btn-primary" onclick="setCredentials('purchaser')">Purchaser</button>
  </div>

  <div class="col-md-2">
    <button type="button" class="btn btn-lg btn-primary" onclick="setCredentials('sales')">Sales</button>
  </div>

  <div class="col-md-1"></div>
</div> -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url();?>assets/plugins/iCheck/icheck.min.js"></script>

<!-- <script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });

  function setCredentials(role = null){
      if(role !== null){
        $("#identity").val(role+"@admin.com");
        $("#password").val("password");
      }
  }
</script> -->
</body>
</html>
