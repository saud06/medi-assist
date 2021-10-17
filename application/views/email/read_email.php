<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','manager');
if(!(in_array($this->session->userdata('type'),$p))){
  redirect('auth');
}
  $this->load->view('layout/header');
?>

  <script type="text/javascript">
    function delete_id(type, email_id){
      if(confirm('<?php echo $this->lang->line('product_delete_conform'); ?>')){
        window.location.href='<?php  echo base_url('email/delete/'); ?>' + type + '/' + email_id;
      }
    }
  </script>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <?php 
      // $this->load->view('layout/sticky_note');
    ?>
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
        <ol class="breadcrumb">
          <li><a href="<?php echo base_url('auth/dashboard'); ?>" class="text-black"><i class="fa fa-dashboard">&nbsp;</i><strong><?php echo $this->lang->line('header_dashboard'); ?></strong></a></li>
          <li class="active">Read Work Details</li>
        </ol>
      </h5>    
    </section>
<!-- Main content -->
    <section class="content">
      <!-- right column -->
        <?php
          if($fail = $this->session->flashdata('fail')){
        ?>
          <div class="col-sm-12">
            <div class="alert alert-success">
              <button class="close" data-dismiss="alert" type="button">×</button>
                <?php echo $fail; ?>
              <div class="alerts-con"></div>
            </div>
          </div>
        <?php
          }
        ?>
        
        <div class="row">
          <div class="col-md-2">
            <div class="box box-solid">
              <div class="box-header with-border">
                <h3 class="box-title">Work Templates</h3>
              </div>
              <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                  <li><a href="../../raw"><i class="fa fa-inbox"></i> New Email</a></li>

                  <li style="width: 70%; float: left;"><a href="../../inquiry_mail"><i class="fa fa-envelope-o"></i> Inquiry Mail</a></li>
                  <li style="width: 30%; float: right;"><a title="Inquiry Mail History" class="text-center" href="<?php echo base_url('email/email_history/inquiry_query');?>"><i class="fa fa-history"></i></a></li>

                  <li style="width: 70%; float: left;"><a href="../../quotation"><i class="fa fa-file-text-o"></i> Quotation</a></li>
                  <li style="width: 30%; float: right;"><a title="Quotation History" class="text-center" href="<?php echo base_url('email/email_history/quotation_query');?>"><i class="fa fa-history"></i></a></li>

                  <li style="width: 70%; float: left;"><a href="../../proforma_invoice"><i class="fa fa-filter"></i> Proforma Invoice / Indent</a></li>
                  <li style="width: 30%; float: right;"><a style="padding: 20px 15px" title="Indent History" class="text-center" href="<?php echo base_url('email/email_history/indent_query');?>"><i class="fa fa-history"></i></a></li>

                  <li style="width: 70%; float: left;"><a href="../../sample_draft"><i class="fa fa-check-square"></i> Forwarding / O.C</a></li>
                  <li style="width: 30%; float: right;"><a title="Forwarding / O.C History" class="text-center" href="<?php echo base_url('email/email_history/sample_draft_query');?>"><i class="fa fa-history"></i></a></li>
                </ul>
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /. box -->

            <a href="<?php echo base_url('Email');?>" class="btn bg-gray btn-block margin-bottom">Work Status</a>
            <a onclick="view_bill_challan()" href="javascript:void(0);" class="btn bg-gray btn-block margin-bottom">Bills & Challans</a>
          </div>

          <div class="col-md-10">
            <?php 
              foreach ($data as $row){
            ?>
                <div class="box box-default">
                  <div class="box-header with-border">
                    <h3 class="box-title">Work Details</h3>

                    <!-- <?php 
                      if(!$prev_record){
                    ?>
                        <style type="text/css">
                          .not-active-prev{
                            pointer-events: none;
                          }
                        </style>
                    <?php
                      }
                      if(!$nxt_record){
                    ?>
                        <style type="text/css">
                          .not-active-nxt{
                            pointer-events: none;
                          }
                        </style>
                    <?php
                      }
                    ?>
                    
                    <div class="box-tools pull-right">
                      <a href="../read_email/<?php echo $row->id-1; ?>" class="btn btn-box-tool not-active-prev" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                      <a href="../read_email/<?php echo $row->id+1; ?>" class="btn btn-box-tool not-active-nxt" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
                    </div> -->
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body no-padding">
                    <div class="mailbox-read-info">
                      <h3><?php echo $row->subject; ?></h3>
                      <h5>To: <?php echo $row->too; ?>
                        <span class="mailbox-read-time pull-right"><?php echo $row->datetime; ?></span></h5>
                    </div>
                    <!-- /.mailbox-read-info -->
                    <?php if($this->session->userdata('type') == 'admin'){ ?>
                      <div class="mailbox-controls with-border pull-right" style="margin-right: 5px">
                        <div class="dropdown">
                          <button title="Action" type="button" class="btn btn-sm bg-gray gropdown-toggle" data-toggle="dropdown">
                            Action&nbsp;
                            <span class="fa fa-angle-double-down"></span>
                          </button>
                          <ul class="dropdown-menu" style="left: -93px">
                            <li>
                              <a href="javascript:delete_id('<?php echo $this->uri->segment(3); ?>', '<?php echo $row->id; ?>')"><i class="fa fa-trash-o"></i>Delete</a>
                            </li>
                          </ul>
                        </div>
                      </div>
                    <?php }?>
                    <!-- /.mailbox-controls -->
                    <div class="mailbox-read-message">
                      <?php echo $row->body; ?>
                    </div>
                  </div>
                </div>
                <!-- /. box -->
            <?php
              }
            ?>
          </div>
        </div>
      </div>
      <!-- /.row -->

      <!-- modal -->
      <div class="modal fade" id="modal_form" role="dialog">
        <div class="modal-dialog" style="width: 80%">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h3 class="modal-title">Bills & Challans</h3>
            </div>
            <div class="modal-body">
              <table id="index" class="table table-bordered table-striped product_table1">
                <thead>
                  <th>No.</th>
                  <th>Date</th>
                  <th>Reference No.</th>
                  <th>Company Name</th>
                  <th>Shipping Mode</th>
                  <th>Status</th>
                  <th>Grand Total</th>
                  <th>Paid</th>
                  <th>Payment Status</th>
                  <th>Bill & Challan</th>
                <thead>
                <tbody id="records">
                </tbody>
              </table>
            </div>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
    $this->load->view('layout/footer');
  ?>
<script>
  function view_bill_challan(){
    $.ajax({
      url: "<?php echo base_url('email/get_bill_challan') ?>/",
      type: "POST",
      dataType: "JSON",
      success: function (response) {
        var table = $('#index').DataTable();
        table.destroy();
        $('#records').empty();

        var trHTML = '';
        $.each(response.data, function (i, item) {
          trHTML += '<tr>';
          trHTML += '<td>'+(i+1)+'</td>';
          trHTML += '<td>' + item.date + '</td>';
          trHTML += '<td>' + item.reference_no + '</td>';
          trHTML += '<td>' + item.company_name + '</td>';
          
          trHTML += '<td>';
            if(item.ship_mode != null){
              trHTML += item.ship_mode;
            }
          trHTML += '</td>';

          trHTML += '<td align="center">' + 'Completed' + '</td>';
          trHTML += '<td align="right">';
            if(item.currency_id == 1){
              trHTML += '$';
            } 
            else{ 
              trHTML += '৳'; 
            } 

            trHTML += item.total;
          trHTML += '</td>';

          trHTML += '<td align="right">';
            if(item.paid_amount != null){
              if(item.currency_id == 1){
                trHTML += '$';
              } 
              else{ 
                trHTML += '৳'; 
              } 

              trHTML += item.paid_amount;
            }
          trHTML += '</td>';

          trHTML += '<td align="center">';
            if(item.paid_amount == null){ 
              trHTML += 'Pending';
            }
            else{ 
              trHTML += 'Completed';
            }
          trHTML += '</td>';
          trHTML += '<td>';
            trHTML += '<div class="dropdown"><button title="Bill & Challan" type="button" class="btn btn-sm bg-gray gropdown-toggle" data-toggle="dropdown"><i class="fa fa-file-pdf-o"></i> &nbsp;<span class="fa fa-angle-double-down"></span></button><ul class="dropdown-menu"><li><a href="<?php echo base_url('email/bl_pdf/');?>' + item.sales_id + '" target="_blank"><i class="fa fa-file-pdf-o"></i>Bill (PDF)</a></li><li><a href="<?php echo base_url('email/ch_pdf/');?>' + item.sales_id + '" target="_blank"><i class="fa fa-file-pdf-o"></i>Challan (PDF)</a></li></ul></div></td>';
          trHTML += '</td>'; 
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
      }
    });

    $('#modal_form').modal('show');
  }

  $(document).ready(function(){
    var email_encription_empty = "Please Enter Email Encription.";
    var smtp_host_empty = "Please Enter SMTP Host.";
    var email_empty = "Please Enter Email.";
    var email_invalid = "Please Enter Valid Email";
    var smtp_port_empty = "Please Enter SMTP Port.";
    var smtp_port_invalid = "Please Enter Valid SMTP Port";
    var from_address_empty = "Please Enter From address.";
    var from_name_empty = "Please Enter From Name.";
    var smtp_username_empty = "Please SMTP Username.";
    var smtp_password_empty = "Please SMTP Password.";
    $("#submit").click(function(event){
      var name_regex = /^[-a-zA-Z\s]+$/;
      var email_regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      var smtp_port_regex = /^[0-9]+$/; 
      var email_encription = $('#email_encription').val().trim();
      var smtp_host = $('#smtp_host').val().trim();
      var smtp_port = $('#smtp_port').val().trim();
      var email = $('#smtp_email').val().trim();
      var from_address = $('#from_address').val().trim();
      var from_name = $('#from_name').val().trim();
      var smtp_username = $('#smtp_username').val().trim();
      var smtp_password = $('#smtp_password').val();

      if(email_encription==null || email_encription==""){
        $("#err_email_encription").text(email_encription_empty);
        return false;
      }
      else{
        $("#err_email_encription").text("");
      }
      
      if(smtp_host==null || smtp_host==""){
        $("#err_smtp_host").text(smtp_host_empty);
        return false;
      }
      else{
        $("#err_smtp_host").text("");
      }

      var smtp_port = $('#smtp_port').val();
      if(smtp_port==null || smtp_port==""){
        $("#err_smtp_port").text(smtp_port_empty);
        return false;
      }
      else{
        $("#err_smtp_port").text("");
      }
      if (!smtp_port.match(smtp_port_regex) ) {
        $('#err_smtp_port').text(smtp_port_invalid);   
        return false;
      }
      else{
        $("#err_smtp_port").text("");
      }

      if(email==null || email==""){
        $("#err_smtp_email").text(email_empty);
        return false;
      }
      else{
        $("#err_smtp_email").text("");
      }
      if (!email.match(email_regex) ) {
        $('#err_smtp_email').text(email_invalid);   
        return false;
      }
      else{
        $("#err_smtp_email").text("");
      }
      
      if(from_address==null || from_address==""){
        $("#err_from_address").text(from_address_empty);
        return false;
      }
      else{
        $("#err_from_address").text("");
      }

      if(from_name == "" || from_name == null){
        $('#err_from_name').text(from_name_empty);
        return false;
      }
      else{
        $('#err_from_name').text("");
      }

      if(smtp_username == "" || smtp_username == null){
        $('#err_smtp_username').text(smtp_username_empty);
        return false;
      }
      else{
        $('#err_smtp_username').text("");
      }

      if(smtp_password == "" || smtp_password == null){
        $('#err_smtp_password').text(smtp_password_empty);
        return false;
      }
      else{
        $('#err_smtp_password').text("");
      }
    });

    $("#email_encription").on("blur keyup",  function (event){
      var email_encription = $('#email_encription').val();
      if(email_encription==null || email_encription==""){
        $("#err_email_encription").text(email_encription_empty);
        return false;
      }
      else{
        $("#err_email_encription").text("");
      }
    });
    $("#smtp_host").on("blur keyup",  function (event){
      var name_smtp_hostregex = /^[-a-zA-Z\s]+$/;
      var smtp_host = $('#smtp_host').val();
      if(smtp_host==null || smtp_host==""){
        $("#err_smtp_host").text(smtp_host_empty);
        return false;
      }
      else{
        $("#err_smtp_host").text("");
      }
    });
    $("#smtp_email").on("blur keyup",  function (event){
      var email_regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      var email = $('#smtp_email').val();
      if(email==null || email==""){
        $("#err_smtp_email").text(email_empty);
        return false;
      }
      else{
        $("#err_smtp_email").text("");
      }
      if (!email.match(email_regex) ) {
        $('#err_smtp_email').text(email_invalid);   
        return false;
      }
      else{
        $("#err_smtp_email").text("");
      }
    });
    $("#smtp_port").on("blur keyup",  function (event){
      var smtp_port_regex = /^[0-9]+$/; 
      var smtp_port = $('#smtp_port').val();
      if(smtp_port==null || smtp_port==""){
        $("#err_smtp_port").text(smtp_port_empty);
        return false;
      }
      else{
        $("#err_smtp_port").text("");
      }
      if (!smtp_port.match(smtp_port_regex) ) {
        $('#err_smtp_port').text(smtp_port_invalid);   
        return false;
      }
      else{
        $("#err_smtp_port").text("");
      }
    });
    $("#from_address").on("blur keyup",  function (event){
      var name_regex = /^[-a-zA-Z\s]+$/;
      var from_address = $('#from_address').val();
      if(from_address==null || from_address==""){
        $("#err_from_address").text(from_address_empty);
        return false;
      }
      else{
        $("#err_from_address").text("");
      }
    });
    $("#from_name").change(function(){
      var from_name = $('#from_name').val();
      if(from_name == "" || from_name == null){
        $('#err_from_name').text(from_name_empty);
        return false;
      }
      else{
        $('#err_from_name').text("");
      }
    });
    $("#smtp_username").change(function(){
      var smtp_username = $('#smtp_username').val();
      if(smtp_username == "" || smtp_username == null){
        $('#err_smtp_username').text(smtp_username_empty);
        return false;
      }
      else{
        $('#err_smtp_username').text("");
      }
    });
    $('#smtp_password').change(function(){
      var smtp_password = $('#smtp_password').val();
      if(smtp_password == "" || smtp_password == null){
        $('#err_smtp_password').text(smtp_password_empty);
        return false;
      }
      else{
        $('#err_smtp_password').text("");
      }
    });
}); 
</script>

<script>
  $(function () {
    //Enable iCheck plugin for checkboxes
    //iCheck for checkbox and radio inputs
    $('.mailbox-messages input[type="checkbox"]').iCheck({
      checkboxClass: 'icheckbox_flat-blue',
      radioClass: 'iradio_flat-blue'
    });

    //Enable check and uncheck all functionality
    $(".checkbox-toggle").click(function () {
      var clicks = $(this).data('clicks');
      if (clicks) {
        //Uncheck all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
        $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
      } else {
        //Check all checkboxes
        $(".mailbox-messages input[type='checkbox']").iCheck("check");
        $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
      }
      $(this).data("clicks", !clicks);
    });
  });

  function deleteConfirm(){
    var result = confirm("Do you really want to delete selected records?");
    if(result){
        return true;
    }else{
        return false;
    }
  }
</script>