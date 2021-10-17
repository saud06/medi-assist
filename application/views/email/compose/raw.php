<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','manager');
if(!(in_array($this->session->userdata('type'),$p))){
  redirect('auth');
}
  $this->load->view('layout/header');
?>

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
          <li class="active">New Email</li>
        </ol>
      </h5>    
    </section>
    <!-- Main content -->
    <section class="content">
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
                <li><a href="raw"><i class="fa fa-inbox"></i> New Email</a></li>

                <li style="width: 70%; float: left;"><a href="inquiry_mail"><i class="fa fa-envelope-o"></i> Inquiry Mail</a></li>
                <li style="width: 30%; float: right;"><a title="Inquiry Mail History" class="text-center" href="<?php echo base_url('email/email_history/inquiry_query');?>"><i class="fa fa-history"></i></a></li>

                <li style="width: 70%; float: left;"><a href="quotation"><i class="fa fa-file-text-o"></i> Quotation</a></li>
                <li style="width: 30%; float: right;"><a title="Quotation History" class="text-center" href="<?php echo base_url('email/email_history/quotation_query');?>"><i class="fa fa-history"></i></a></li>

                <li style="width: 70%; float: left;"><a href="proforma_invoice"><i class="fa fa-filter"></i> Proforma Invoice / Indent</a></li>
                <li style="width: 30%; float: right;"><a style="padding: 20px 15px" title="Indent History" class="text-center" href="<?php echo base_url('email/email_history/indent_query');?>"><i class="fa fa-history"></i></a></li>

                <li style="width: 70%; float: left;"><a href="sample_draft"><i class="fa fa-check-square"></i> Forwarding / O.C</a></li>
                <li style="width: 30%; float: right;"><a title="Forwarding / O.C History" class="text-center" href="<?php echo base_url('email/email_history/sample_draft_query');?>"><i class="fa fa-history"></i></a></li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->

          <a href="<?php echo base_url('Email');?>" class="btn bg-gray btn-block margin-bottom">Work Status</a>
          <a onclick="view_bill_challan()" href="javascript:void(0);" class="btn bg-gray btn-block margin-bottom">Bills & Challans</a>
        </div>
        <!-- /.col -->
        <div class="col-md-10">
          <div class="box box-default">
            <div class="box-header with-border">
              <div class="col-sm-9" style="padding-left: 0;">
                <h3 class="box-title">Work Details</h3>
              </div>
            </div>

            <form role="form" id="form" method="post" action="<?php echo base_url('email/send_email');?>" encType="multipart/form-data">
              <!-- /.box-header -->
              <input type="hidden" name="mail_type" value="raw">
              <div class="box-body">
                <div class="form-group">
                  <label for="from">From <span class="validation-color">*</span></label>

                  <input class="form-control" name="from" id="from" placeholder="From:" value="<?php echo $this->session->userdata('username') ?>">
                  <span class="validation-color" id="err_from"><?php echo form_error('from'); ?></span>
                </div>
                <div class="form-group">
                  <label for="to">To <span class="validation-color">*</span></label>

                  <input class="form-control" name="to" id="to" placeholder="To:">
                  <span class="validation-color" id="err_to"><?php echo form_error('to'); ?></span>
                </div>
                <div class="form-group">
                  <label for="cc">Cc </label>

                  <input class="form-control" name="cc" id="cc" placeholder="Cc:" data-toggle="tooltip" title="For multiple Cc, separate them by comma (,)">
                </div>
                <div class="form-group">
                  <label for="bcc">Bcc </label>

                  <input class="form-control" name="bcc" id="bcc" placeholder="Bcc:" data-toggle="tooltip" title="For multiple Bcc, separate them by comma (,)">
                </div>
                <div class="form-group">
                  <label for="subject">Subject </label>

                  <input class="form-control" name="subject" id="subject" placeholder="Subject:">
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="mail_body" id="mail_body">
                    <div class="fr-view">
                    </div>
                  </textarea>
                </div>
                
                <!-- <div class="form-group">
                  <div class="btn btn-default btn-file">
                    <i class="fa fa-paperclip"></i> Attachment
                    <input type="file" name="attachment" id="attachment">
                  </div>
                  <p class="help-block">Max. 2MB</p>
                </div> -->
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <div class="pull-right">
                  <input type="hidden" name="type" id="type">
                  <button type="submit" id="draft" class="btn bg-gray"><i class="fa fa-eye"></i>&nbsp;&nbsp;Preview</button>
                  <!-- <button type="submit" id="submit" class="btn bg-gray"><i class="fa fa-paper-plane"></i>&nbsp;&nbsp;Send</button> -->
                </div>
              </div>
              <!-- /.box-footer -->
            </form>
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
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

<!-- Froala Editor -->
<script src="<?php echo base_url();?>assets/plugins/froala/js/froala_editor.pkgd.min.js"></script>

<script>
  $(function(){ 
    $('textarea').froalaEditor({
      height: 300
    }) 
  });

  /*$(function(){ 
    $('div.fr-view').froalaEditor({
      height: 750
    });
  });*/

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
    var from_empty = "Please Enter Email.";
    var to_empty = "Please Enter Email(s).";
    
    $("#submit").click(function(event){
      var from = $('#from').val().trim();
      var to = $('#to').val().trim();
      var type = $('#type').val('send');

      if(from==null || from==""){
        $("#err_from").text(from_empty);
        return false;
      }
      else{
        $("#err_from").text("");
      }
      
      if(to==null || to==""){
        $("#err_to").text(to_empty);
        return false;
      }
      else{
        $("#err_to").text("");
      }
    });

    $("#draft").click(function(event){
      var from = $('#from').val().trim();
      var to = $('#to').val().trim();
      var type = $('#type').val('save');

      if(from==null || from==""){
        $("#err_from").text(from_empty);
        return false;
      }
      else{
        $("#err_from").text("");
      }
      
      if(to==null || to==""){
        $("#err_to").text(to_empty);
        return false;
      }
      else{
        $("#err_to").text("");
      }
    });

    $("#from").on("blur keyup",  function (event){
      var from = $('#from').val();
      if(from==null || from==""){
        $("#err_from").text(from_empty);
        return false;
      }
      else{
        $("#err_from").text("");
      }
    });
    $("#to").on("blur keyup",  function (event){
      var to = $('#to').val();
      if(to==null || to==""){
        $("#err_to").text(to_empty);
        return false;
      }
      else{
        $("#err_to").text("");
      }
    });
  }); 
</script>