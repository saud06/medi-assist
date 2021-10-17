<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <title>Billing & accounting</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-3.1.1.js"></script>
        

        <link rel="stylesheet" href="<?php echo base_url();?>assets/bootstrap/css/bootstrap.min.css">
          <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
          <!-- Ionicons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
          <!-- Theme style -->
          
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
          <!-- AdminLTE Skins. Choose a skin from the css/skins
               folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/skins/_all-skins.min.css">
          <!-- Pace style -->
        <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/pace/pace.min.css">



        <script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <!-- Bootstrap 3.3.6 -->
        <script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
        <!-- PACE -->
        <script src="<?php echo base_url();?>assets/plugins/pace/pace.min.js"></script>
        <!-- SlimScroll -->
        <script src="<?php echo base_url();?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
        <!-- FastClick -->
        <script src="plugins/fastclick/fastclick.js"></script>
        <!-- AdminLTE App -->
        <script src="<?php echo base_url();?>assets/dist/js/app.min.js"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="<?php echo base_url();?>assets/dist/js/demo.js"></script>



    <style type="text/css">
        
          
          .error {
            background: #ffd1d1;
            border: 1px solid #ff5858;
        padding: 4px;
          }
        </style>

    </head>
    <body style="background:#2C3E50">
    


<div class="container" style="margin-top:50px ">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading"> <strong class="">HellowTrade Accounting, Billing & Inventory Management System</strong>

                </div>
                <div class="panel-body">

                    <div class="alert alert-success" role="alert">
                    Well done! You have Successfully install HellowTrade Accounting, Billing & Inventory Management System. 
                    </div>

                    <div class="well well-lg">

                    <h4><strong>Admin panel Login Details</strong></h4>
                    <hr/>
                    <p>Please keep bellow login details to login into HellowTrade Accounting, Billing & Inventory Management System.</p>
                    <p><strong>Email:</strong>admin@admin.com</p>
                    <p><strong>Password:</strong> password</p>
                    
                    <p><strong>Wait 30 seconds......</strong></p>
                    
                    <a href="<?php echo base_url('auth') ?>" class="btn btn-success hide-btn">Goto Login Page</a>
                    <span class="btn btn-success btn-lrg ajaxStart hide-btn1"><i class="fa fa-spin fa-refresh"></i> Installing.....</span>
                    </div>

                    <!-- <button type="button" class="btn btn-default btn-lrg ajax" title="Ajax Request">
                        <i class="fa fa-spin fa-refresh"></i>&nbsp; Get External Content
                    </button> -->

                    <p class="error"> 
                    For your own security. Please <strong>Delete</strong> or rename <strong>Install</strong> folder 
                    </p>
        

                </div>
                <div class="panel-footer">&copy www.rrmsense.com
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

    $(document).ajaxStart(function() { Pace.restart(); });
    $('.ajax').click(function(){
        $.ajax({url: '#', success: function(result){
            $('.ajax-content').html('<hr>Ajax Request Completed !');
        }});
    });


    $('.hide-btn').hide();
    $('.hide-btn1').show();
    window.onload = function() {
        window.setTimeout(setDisabled, 30000);
    }
    function setDisabled() {
        $('.hide-btn1').hide();
        $('.hide-btn').show();
    }
</script>

    </body>
</html>
