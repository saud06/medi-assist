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
        window.location.href='<?php  echo base_url('employee/delete/'); ?>'+id;
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
          <li class="active"><!-- Employee -->
            Employee
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
                <!-- List Employee -->
                Employee List
              </h3>
              <a title="Add New Employee" class="btn bg-gray" style="margin: 10px" href="<?php echo base_url('employee/add');?>"> 
                  <!-- Add New Employee -->
                  <i class="fa fa-plus"></i>
               </a>
            </div>
            <div class="box-body outer-scroll">
              <div class="inner-scroll">
                <div class="row">
                  <div class="col-sm-12">
                    <strong>Employee List Filter:</strong> &emsp;

                    <select class="form-control select2" name="status" id="status" style="width: 20%;">
                      <option value="" selected>All Status</option>
                      <option value="Contractual">Contractual</option>
                      <option value="Probation">Probation</option>
                      <option value="Permanent">Permanent</option>
                      <option value="Suspended">Suspended</option>
                    </select> &emsp;

                    <button title="Filter Employee List" type="button" id="btn_ajax" class="btn bg-gray"><i class="fa fa-search"></i></button>&emsp;

                    <div class="btn-group">
                      <button title="Print Employee List" type="button" class="btn bg-gray gropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-print" aria-hidden="true"></i>&nbsp;
                        <span class="fa fa-angle-double-down"></span>
                      </button>
                      <ul class="dropdown-menu">
                        <li>
                          <a href="#" target="_blank" onclick="printContent('print')">Print (Default)</a>
                        </li>
                        <li id="pdf">
                          <a href="<?php echo base_url('employee/list_pdf');?>" target="_blank">PDF (On Letter Head)</a>
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
                    <th><!-- Employee Photo -->
                        Employee Photo
                    </th>
                    <th><!-- Employee ID -->
                        Employee ID
                    </th>
                    <th><!-- Name -->
                        Name
                    </th>
                    <th><!-- Phone -->
                        Phone
                    </th>
                    <th><!-- Email -->
                        Email
                    </th>
                    <th><!-- Address -->
                        Address
                    </th>
                    <th><!-- Designation -->
                        Designation
                    </th>
                    <th><!-- Start & End Time -->
                        Start &<br>End Time
                    </th>
                    <th><!-- Weekly Holiday -->
                        Weekly Holiday 
                    </th>
                    <?php if($this->session->userdata('type') == 'admin'){ ?>
                      <th width="10%"><!-- Actions -->
                          <?php echo $this->lang->line('biller_lable_action'); ?>
                      </th>
                    <?php }?>
                  </tr>
                  </thead>
                  <tbody id="records">
                    <?php
                      foreach ($data as $row) {
                        $id = $row->id;
                        $emp_id = $row->employee_id;
                    ?>
                        <tr>
                          <td></td>
                          <td><img class="img-circle" width="50" height="50" src="<?php echo $row->emp_photo; ?>"></td>
                          <td><?php echo $row->employee_id ?></td>
                          <td><?php echo $row->first_name . ' ' . $row->last_name; ?></td>
                          <td><?php echo $row->cphone ?></td>
                          <td><?php echo $row->cemail ?></td>
                          <td><?php echo $row->pre_address ?></td>
                          <td><?php echo $row->join_desg ?></td>
                          <td><?php echo $row->start_time . ' -<br>' . $row->end_time; ?></td>
                          <td><?php echo $row->wk_holiday ?></td>
                          <?php if($this->session->userdata('type') == 'admin'){ ?>
                            <td>
                              <div class="dropdown">
                                <button title="Action" type="button" class="btn btn-sm bg-gray gropdown-toggle" data-toggle="dropdown">
                                  <i class="fa fa-cog"></i>&nbsp;
                                  <span class="fa fa-angle-double-down"></span>
                                </button>
                                <ul class="dropdown-menu">
                                  <?php 
                                    $sql = "SELECT * FROM users WHERE emp_id = '$emp_id'";
                                    $result = $this->db->query($sql,array($id));
                                    
                                    if($result->num_rows() == 0){
                                  ?>
                                      <li>
                                        <a href="<?php echo base_url('employee/promoteAsUser/'); ?><?php echo $id; ?>"><i class="fa fa-user-plus"></i>Promote As User</a>
                                      </li>
                                  <?php
                                    }
                                  ?>
                                  <li>
                                    <a href="<?php echo base_url('employee/edit/'); ?><?php echo $id; ?>"><i class="fa fa-edit"></i>Edit</a>
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
                    <th><!-- No -->
                        <?php echo $this->lang->line('biller_lable_no'); ?>.
                    </th>
                    <th><!-- Employee Photo -->
                        Employee Photo
                    </th>
                    <th><!-- Employee ID -->
                        Employee ID
                    </th>
                    <th><!-- Name -->
                        Name
                    </th>
                    <th><!-- Phone -->
                        Phone
                    </th>
                    <th><!-- Email -->
                        Email
                    </th>
                    <th><!-- Address -->
                        Address
                    </th>
                    <th><!-- Designation -->
                        Designation
                    </th>
                    <th><!-- Start & End Time -->
                        Start &<br>End Time
                    </th>
                    <th><!-- Weekly Holiday -->
                        Weekly Holiday 
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
                      Employee List
                    </h3>
                    <br><br>

                    <table id="pindex" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th><!-- No -->
                            <?php echo $this->lang->line('biller_lable_no'); ?>.
                        </th>
                        <th><!-- Employee Photo -->
                            Employee Photo
                        </th>
                        <th><!-- Employee ID -->
                            Employee ID
                        </th>
                        <th><!-- Name -->
                            Name
                        </th>
                        <th><!-- Phone -->
                            Phone
                        </th>
                        <th><!-- Email -->
                            Email
                        </th>
                        <th><!-- Address -->
                            Address
                        </th>
                        <th><!-- Designation -->
                            Designation
                        </th>
                        <th><!-- Start & End Time -->
                            Start &<br>End Time
                        </th>
                        <th><!-- Weekly Holiday -->
                            Weekly Holiday 
                        </th>
                      </tr>
                      </thead>
                      <tbody id="precords">
                        <?php
                          foreach ($data as $key => $row) {
                            $id = $row->id;
                        ?>
                            <tr>
                              <td><?php echo ++$key ?></td>
                              <td><img class="img-circle" width="50" height="50" src="<?php echo $row->emp_photo; ?>"></td>
                              <td><?php echo $row->employee_id ?></td>
                              <td><?php echo $row->first_name . ' ' . $row->last_name; ?></td>
                              <td><?php echo $row->cphone ?></td>
                              <td><?php echo $row->cemail ?></td>
                              <td><?php echo $row->pre_address ?></td>
                              <td><?php echo $row->join_desg ?></td>
                              <td><?php echo $row->start_time . ' -<br>' . $row->end_time; ?></td>
                              <td><?php echo $row->wk_holiday ?></td>
                            </tr>
                        <?php
                          }
                        ?>
                      </tbody>
                      <tfoot>
                      <tr>
                        <th><!-- No -->
                            <?php echo $this->lang->line('biller_lable_no'); ?>.
                        </th>
                        <th><!-- Employee Photo -->
                            Employee Photo
                        </th>
                        <th><!-- Employee ID -->
                            Employee ID
                        </th>
                        <th><!-- Name -->
                            Name
                        </th>
                        <th><!-- Phone -->
                            Phone
                        </th>
                        <th><!-- Email -->
                            Email
                        </th>
                        <th><!-- Address -->
                            Address
                        </th>
                        <th><!-- Designation -->
                            Designation
                        </th>
                        <th><!-- Start & End Time -->
                            Start &<br>End Time
                        </th>
                        <th><!-- Weekly Holiday -->
                            Weekly Holiday 
                        </th>
                      </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>
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
  $('#btn_ajax').click(function(){
    var status = $('#status').val();
    if(!status) status = 0;

    $.ajax({
      url: "<?php echo base_url('employee/filter_employee') ?>/",
      type: "POST",
      dataType: "JSON",
      data : {
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
            trHTML += '<td> <img class="img-circle" width="50" height="50" src="' + item.emp_photo + '"></td>';
            trHTML += '<td>' + item.employee_id + '</td>';
            trHTML += '<td>' + item.first_name + ' ' + item.last_name + '</td>';
            trHTML += '<td>' + item.cphone + '</td>';
            trHTML += '<td>' + item.cemail + '</td>';
            trHTML += '<td>' + item.pre_address + '</td>';
            trHTML += '<td>' + item.join_desg + '</td>';
            trHTML += '<td>' + item.start_time + ' -<br>' + item.end_time + '</td>';
            trHTML += '<td>' + item.wk_holiday + '</td>';
            var type = '<?php echo $this->session->userdata("type") ?>';
            if(type == 'admin'){
              trHTML += '<td>';
                trHTML += '<div class="dropdown"><button title="Action" type="button" class="btn btn-sm bg-gray gropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> &nbsp;<span class="fa fa-angle-double-down"></span></button><ul class="dropdown-menu"><li><a href="<?php echo base_url('employee/edit/'); ?>' + item.id + '"><i class="fa fa-edit"></i>Edit</a></li><li><a href="javascript:delete_id(' + item.id + ')"><i class="fa fa-trash-o"></i>Delete</a></li></ul></div></td>';
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
            trHTML += '<td> <img class="img-circle" width="50" height="50" src="' + item.emp_photo + '"></td>';
            trHTML += '<td>' + item.employee_id + '</td>';
            trHTML += '<td>' + item.first_name + ' ' + item.last_name + '</td>';
            trHTML += '<td>' + item.cphone + '</td>';
            trHTML += '<td>' + item.cemail + '</td>';
            trHTML += '<td>' + item.pre_address + '</td>';
            trHTML += '<td>' + item.join_desg + '</td>';
            trHTML += '<td>' + item.start_time + ' -<br>' + item.end_time + '</td>';
            trHTML += '<td>' + item.wk_holiday + '</td>';
            trHTML += '</tr>';
        });
        
        $('#precords').append(trHTML);
      }
    });

    $("#pdf").html('<a href="<?php echo base_url('employee/filterEmployeePDF/');?>' + status + '" target="_blank">PDF (On Letter Heads)</a>');
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