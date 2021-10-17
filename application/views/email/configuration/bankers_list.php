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
   if(confirm('Sure To Remove This Payment mode ?'))
   {
    window.location.href='<?php  echo base_url('email/bankers_delete/'); ?>'+id;
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
      <li class="active">Banker</li>
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
          <h3 class="box-title">Banker List</h3>
          <a title="Add New Banker" class="btn bg-gray" style="margin: 10px" href="<?php echo base_url('email/bankers_add');?>"><i class="fa fa-plus"></i></a>
        </div>
        <!-- /.box-header -->
        <div class="box-body outer-scroll">
          <div class="inner-scroll">
            <div class="row">
              <div class="col-sm-12">
                <strong>Banker List Filter:</strong> &emsp;

                <select class="form-control select2" name="status" id="status" style="width: 15%;">
                  <option value="">All Status</option>
                  <option value="active" selected>Active</option>
                  <option value="inactive">Inactive</option>
                </select> &emsp;

                <button title="Filter Banker List" type="button" id="btn_ajax" class="btn bg-gray"><i class="fa fa-search"></i></button>&emsp;

                <div class="btn-group">
                  <button title="Print Unit List" type="button" class="btn bg-gray gropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-print" aria-hidden="true"></i>&nbsp;
                    <span class="fa fa-angle-double-down"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <li>
                      <a href="#" target="_blank" onclick="printContent('print')">Print (Default)</a>
                    </li>
                    <li id="pdf">
                      <a href="<?php echo base_url('email/bankers_list_pdf');?>" target="_blank">PDF (On Letter Head)</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <br>

            <table id="index" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>No.</th>
                  <th>Name</th>
                  <th>Details</th>
                  <th>Address</th>
                  <?php if($this->session->userdata('type') == 'admin'){ ?>
                    <th>Action</th>
                  <?php }?>
                </tr>
              </thead>
              <tbody id="records">
                <?php 
                foreach ($data as $row) {
                 $id= $row->bankers_ec_id;
                 ?>
                 <tr>
                  <td></td>
                  <td><?php echo $row->bankers_ec_name; ?></td>
                  <td><?php echo $row->bankers_ec_details; ?></td>
                  <td><?php echo $row->bankers_ec_address; ?></td>
                  <?php if($this->session->userdata('type') == 'admin'){ ?>
                    <td>
                      <div class="dropdown">
                        <button title="Action" type="button" class="btn btn-sm bg-gray gropdown-toggle" data-toggle="dropdown">
                          <i class="fa fa-cog"></i>&nbsp;
                          <span class="fa fa-angle-double-down"></span>
                        </button>
                        <ul class="dropdown-menu">
                          <li>
                            <a href="<?php echo base_url('email/bankers_edit/'); ?><?php echo $id; ?>"><i class="fa fa-edit"></i>Edit</a>
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
                ?>
              </tbody>
              <tfoot>
                <tr>
                 <th>No.</th>
                 <th>Name</th>
                 <th>Details</th>
                 <th>Address</th>
                 <?php if($this->session->userdata('type') == 'admin'){ ?>
                  <th>Action</th>
                 <?php }?>
               </tr>
             </tfoot>
            </table>

            <div style="display: none;" id="print">
              <div id="header" class="box-header with-border" style="text-align: center; display: none">
                <img width="300" height="100" src="<?php echo base_url().'assets/images/winmarkFinal.png'; ?>"><br>
                <hr>

                <h3 class="box-title">
                  Banker List
                </h3>
                <br><br>

                <table id="pindex" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Name</th>
                      <th>Details</th>
                      <th>Address</th>
                    </tr>
                  </thead>
                  <tbody id="precords">
                    <?php 
                    foreach ($data as $key => $row) {
                     $id= $row->bankers_ec_id;
                     ?>
                     <tr>
                      <td><?php echo ++$key; ?></td>
                      <td><?php echo $row->bankers_ec_name; ?></td>
                      <td><?php echo $row->bankers_ec_details; ?></td>
                      <td><?php echo $row->bankers_ec_address; ?></td>
                     </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                  <tfoot>
                    <tr>
                     <th>No.</th>
                     <th>Name</th>
                     <th>Details</th>
                     <th>Address</th>
                   </tr>
                 </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.box-body -->
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

<script>
  $('#btn_ajax').click(function(){
    var status = $('#status').val();
    if(!status) status = 0;

    $.ajax({
      url: "<?php echo base_url('email/filter_banker') ?>/",
      type: "POST",
      dataType: "JSON",
      data : {
        status: status
      },
      success: function (response) {
        //console.log(response.data)
        var table = $('#index').DataTable();
        table.destroy();
        $('#records').empty();

        var trHTML = '';
        $.each(response.data, function (i, item) {
          trHTML += '<tr>';
          trHTML += '<td>'+(i+1)+'</td>';
          trHTML += '<td>' + item.bankers_ec_name + '</td>';
          trHTML += '<td>' + item.bankers_ec_details + '</td>';
          trHTML += '<td>' + item.bankers_ec_address + '</td>';
          var type = '<?php echo $this->session->userdata("type") ?>';
          if(type == 'admin'){
            trHTML += '<td>';
              trHTML += '<div class="dropdown"><button title="Action" type="button" class="btn btn-sm bg-gray gropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> &nbsp;<span class="fa fa-angle-double-down"></span></button><ul class="dropdown-menu"><li><a href="<?php echo base_url('email/bankers_edit/'); ?>' + item.bankers_ec_id + '"><i class="fa fa-edit"></i>Edit</a></li><li><a href="javascript:delete_id(' + item.bankers_ec_id + ')"><i class="fa fa-trash-o"></i>Delete</a></li></ul></div></td>';
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
          trHTML += '<td>' + item.bankers_ec_name + '</td>';
          trHTML += '<td>' + item.bankers_ec_details + '</td>';
          trHTML += '<td>' + item.bankers_ec_address + '</td>';
          trHTML += '</tr>';
        });
        
        $('#precords').append(trHTML);
      }
    });

    $("#pdf").html('<a href="<?php echo base_url('email/filterBankersPDF/');?>' + status + '" target="_blank">PDF (On Letter Heads)</a>');
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
  
  window.onafterprint = function(){
    window.location.reload(true);
  }
</script>