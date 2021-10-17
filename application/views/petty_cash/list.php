<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin', 'accountant');
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
        window.location.href='<?php  echo base_url('petty_cash/delete/'); ?>'+id;
     }
  }

  function delete_history_id(id)
  {
     if(confirm('Sure To Remove This Record ?'))
     {
        window.location.href='<?php  echo base_url('petty_cash/delete_history/'); ?>'+id;
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
        <li class="active"><!-- Petty Cash -->
          Petty Cash
        </li>
      </ol>
    </h5> 
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <?php 
        $assigned_total = $this->db->select('SUM(amount) as tot')
                                   ->from('petty_cash')
                                   ->get()
                                   ->result();
        $costed_total = $this->db->select('SUM(amount) as tot')
                                 ->from('petty_cash_assign_history')
                                 ->get()
                                 ->result();

        if($this->session->userdata('type') == 'admin'){
      ?>
          <!-- right column -->
          <div class="col-md-12">
            <div class="box">
                <div class="box-header with-border">
                  <h3 class="box-title">
                    <!-- List Petty Cash -->
                    Petty Cash
                  </h3>

                  <a title="Add New Petty Cash" class="btn bg-gray" style="margin: 10px" href="<?php echo base_url('petty_cash/add');?>"><i class="fa fa-plus"></i></a>
                  <div class="btn-group">
                    <button title="Print Petty Cash List" type="button" class="btn bg-gray gropdown-toggle" data-toggle="dropdown">
                      <i class="fa fa-print" aria-hidden="true"></i>&nbsp;
                      <span class="fa fa-angle-double-down"></span>
                    </button>
                    <ul class="dropdown-menu">
                      <li>
                        <a href="#" target="_blank" onclick="printContent('print')">Print (Default)</a>
                      </li>
                      <li id="pdf">
                        <a href="<?php echo base_url('petty_cash/petty_cash_list_pdf');?>" target="_blank">PDF (On Letter Head)</a>
                      </li>
                    </ul>
                  </div>

                  <div class="col-md-4 callout pull-right" style="background-color: #dd9e96; border-color: #000000; padding: 6px; margin: 10px">
                    <h4 class="pull-left" style="font-style: italic; margin-bottom: 0">
                      <?php 
                        echo 'Assigned Total: ' . $assigned_total[0]->tot;
                      ?>
                    </h4>&emsp;
                    <h4 class="pull-right" style="font-style: italic; margin-bottom: 0">
                      <?php 
                        echo 'Costed Total: ' . $costed_total[0]->tot;
                      ?>
                    </h4>
                  </div>
                </div>

                <div class="box-body outer-scroll">
                  <div class="inner-scroll">
                    <table id="index" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th><!-- No -->
                            <?php echo $this->lang->line('biller_lable_no'); ?>.
                        </th>
                        <th><!-- Date -->
                            Date
                        </th>
                        <th><!-- Amount -->
                            Amount
                        </th>
                        <th><!-- Remarks -->
                            Remarks
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
                            $id = $row->petty_cash_id;
                        ?>
                            <tr>
                              <td></td>
                              <td><?php echo $row->cash_date ?></td>
                              <td><?php echo $row->amount; ?></td>
                              <td><?php echo $row->remarks; ?></td>
                              <?php if($this->session->userdata('type') == 'admin'){ ?>
                                <td>
                                  <div class="dropdown">
                                    <button title="Action" type="button" class="btn btn-sm bg-gray gropdown-toggle" data-toggle="dropdown">
                                      <i class="fa fa-cog"></i>&nbsp;
                                      <span class="fa fa-angle-double-down"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                      <li>
                                        <a href="<?php echo base_url('petty_cash/edit/'); ?><?php echo $id; ?>"><i class="fa fa-edit"></i>Edit</a>
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
                        <th><!-- Date -->
                            Date
                        </th>
                        <th><!-- Amount -->
                            Amount
                        </th>
                        <th><!-- Remarks -->
                            Remarks
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
                          Petty Cash
                        </h3>
                        <br><br>

                        <table id="pindex" class="table table-bordered table-striped">
                          <thead>
                          <tr>
                            <th><!-- No -->
                                <?php echo $this->lang->line('biller_lable_no'); ?>.
                            </th>
                            <th><!-- Date -->
                                Date
                            </th>
                            <th><!-- Amount -->
                                Amount
                            </th>
                            <th><!-- Remarks -->
                                Remarks
                            </th>
                          </tr>
                          </thead>
                          <tbody id="precords">
                            <?php
                              foreach ($data as $key => $row) {
                            ?>
                                <tr>
                                  <td><?php echo ++$key ?></td>
                                  <td><?php echo $row->cash_date ?></td>
                                  <td><?php echo $row->amount; ?></td>
                                  <td><?php echo $row->remarks; ?></td>
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
                              <th><!-- Date -->
                                  Date
                              </th>
                              <th><!-- Amount -->
                                  Amount
                              </th>
                              <th><!-- Remarks -->
                                  Remarks
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
      <?php
        }
      ?>

      <!-- right column -->
      <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">
                <!-- List Petty Cash -->
                History
              </h3>&emsp;

              <div class="btn-group">
                <button title="Print Petty Cash History" type="button" class="btn bg-gray gropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-print" aria-hidden="true"></i>&nbsp;
                  <span class="fa fa-angle-double-down"></span>
                </button>
                <ul class="dropdown-menu">
                  <li>
                    <a href="#" target="_blank" onclick="printContent('print2')">Print (Default)</a>
                  </li>
                  <li id="pdf2">
                    <a href="<?php echo base_url('petty_cash/petty_cash_assign_history_pdf');?>" target="_blank">PDF (On Letter Head)</a>
                  </li>
                </ul>
              </div>
              
              <div class="col-md-2 callout pull-right" style="background-color: #dd9e96; border-color: #000000; padding: 6px; margin: 10px">
                <h4 class="pull-left" style="font-style: italic; margin-bottom: 0">
                  <?php echo 'Cash Remains: ' . number_format((float)($assigned_total[0]->tot - $costed_total[0]->tot), 2, '.', ''); ?>
                </h4>
              </div>
            </div>

            <div class="box-body outer-scroll">
              <div class="inner-scroll">
                <table id="index1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th><!-- No -->
                        <?php echo $this->lang->line('biller_lable_no'); ?>.
                    </th>
                    <th><!-- Employee ID -->
                        Employee ID
                    </th>
                    <th><!-- Name -->
                        Name
                    </th>
                    <th><!-- Assign Total -->
                        Assigned Total
                    </th>
                    <?php if($this->session->userdata('type') == 'admin' || $this->session->userdata('type') == 'accountant'){ ?>
                      <th width="10%"><!-- Actions -->
                          <?php echo $this->lang->line('biller_lable_action'); ?>
                      </th>
                    <?php }?>
                  </tr>
                  </thead>
                  <tbody id="records1">
                    <?php
                      foreach ($data2 as $row) {
                        $id = $row->id;
                        $emp_id = $row->employee_id;
                        $name = $row->first_name . ' ' . $row->last_name;
                    ?>
                        <tr>
                          <td></td>
                          <td><?php echo $row->employee_id ?></td>
                          <td><?php echo $row->first_name . ' ' . $row->last_name; ?></td>
                          <td>
                            <?php 
                              $this->db->select('SUM( amount ) AS total_amount')
                                   ->from('petty_cash_assign_history')
                                   ->where('emp_id', $emp_id);

                              $query = $this->db->get();
                              $result = $query->result();

                              echo $result[0]->total_amount . '&emsp;';
                            ?>

                            <button title="Assign Cash" type="button" onclick="btn_assign('<?php echo $emp_id; ?>', '<?php echo $name; ?>')" class="btn btn-sm bg-gray"><span class="glyphicon glyphicon-plus"></span></button>
                          </td>
                          <?php if($this->session->userdata('type') == 'admin' || $this->session->userdata('type') == 'accountant'){ ?>
                            <td>
                              <div class="dropdown">
                                <button title="Action" type="button" class="btn btn-sm bg-gray gropdown-toggle" data-toggle="dropdown">
                                  <i class="fa fa-cog"></i>&nbsp;
                                  <span class="fa fa-angle-double-down"></span>
                                </button>
                                <ul class="dropdown-menu">
                                  <li>
                                    <a onclick="assign_history('<?php echo $emp_id; ?>')" href="javascript:void(0);"><i class="fa fa-file-text-o"></i>Assign History</a>
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
                    <th><!-- Employee ID -->
                        Employee ID
                    </th>
                    <th><!-- Name -->
                        Name
                    </th>
                    <th><!-- Assign Total -->
                        Assigned Total
                    </th>
                    <?php if($this->session->userdata('type') == 'admin' || $this->session->userdata('type') == 'accountant'){ ?>
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
                      History
                    </h3>
                    <br><br>

                    <table id="pindex1" class="table table-bordered table-striped">
                      <thead>
                      <tr>
                        <th><!-- No -->
                            <?php echo $this->lang->line('biller_lable_no'); ?>.
                        </th>
                        <th><!-- Employee ID -->
                            Employee ID
                        </th>
                        <th><!-- Name -->
                            Name
                        </th>
                        <th><!-- Assign Total -->
                            Assigned Total
                        </th>
                      </tr>
                      </thead>
                      <tbody id="precords1">
                        <?php
                          foreach ($data2 as $key => $row) {
                            $id = $row->id;
                            $emp_id = $row->employee_id;
                            $name = $row->first_name . ' ' . $row->last_name;
                        ?>
                            <tr>
                              <td><?php echo ++$key ?></td>
                              <td><?php echo $row->employee_id ?></td>
                              <td><?php echo $row->first_name . ' ' . $row->last_name; ?></td>
                              <td>
                                <?php 
                                  $this->db->select('SUM( amount ) AS total_amount')
                                       ->from('petty_cash_assign_history')
                                       ->where('emp_id', $emp_id);

                                  $query = $this->db->get();
                                  $result = $query->result();

                                  echo $result[0]->total_amount;
                                ?>
                              </td>
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
                          <th><!-- Employee ID -->
                              Employee ID
                          </th>
                          <th><!-- Name -->
                              Name
                          </th>
                          <th><!-- Assign Total -->
                              Assigned Total
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

<!-- /.modal -->
<div class="modal fade" id="modal_assign" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Assign Cash</h3>
        <h4 class="pull-left"><strong>Employee ID:</strong> <span id="emp_id"></span></h4>
        <h4 class="pull-right"><strong>Employee Name:</strong> <span id="emp_name"></span></h4>
      </div>
      <div class="modal-body form">
        <form action="#" id="form" class="form-horizontal">
          <input type="hidden" name="emp_id">
          <input type="hidden" name="emp_name">

          <div class="form-body">
            <!-- Date range -->
            <div class="form-group">
              <label class="control-label col-md-3">Date <span class="validation-color">*</span></label>

              <div class="col-md-9">
                <input type="text" name="date" id="date" placeholder="Insert Date" class="form-control datepicker" value="<?php echo date("Y-m-d"); ?>">
                <span class="validation-color" id="err_date"></span>
              </div>
            </div>
            <!-- /.form group -->

            <!-- Amount -->
            <div class="form-group">
              <label class="control-label col-md-3">Amount <span class="validation-color">*</span></label>

              <div class="col-md-9">
                <input type="number" name="amount" id="amount" placeholder="Insert Amount" class="form-control">
                <span class="validation-color" id="err_amount"></span>
              </div>
            </div>
            <!-- /.form group -->
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" onclick="submit_assign()" class="btn bg-gray">Submit</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- modal -->
<div class="modal fade" id="modal_history" role="dialog">
  <div class="modal-dialog" style="width: 80%">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Assign History</h3>
      </div>
      <div class="modal-body">
        <table id="index2" class="table table-bordered table-striped product_table1">
          <thead>
            <th>No.</th>
            <th>Assign Date</th>
            <th>Assigned Amount</th>
            <?php if($this->session->userdata('type') == 'admin'){ ?>
              <th>Action</th>
            <?php }?>
          <thead>
          <tbody id="records2">
          </tbody>
          <tfoot>
            <th>No.</th>
            <th>Assign Date</th>
            <th>Assigned Amount</th>
            <?php if($this->session->userdata('type') == 'admin'){ ?>
              <th>Action</th>
            <?php }?>
          <tfoot>
        </table>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script type="text/javascript">
  function btn_assign(emp_id, emp_name){
    $('#form')[0].reset(); // reset form on modals

    $('#emp_id').html(emp_id);
    $('#emp_name').html(emp_name);

    $('input[name="emp_id"]').val(emp_id);
    $('input[name="emp_name"]').val(emp_name);

    $('#modal_assign').modal('show'); 
    $('.modal-title').text('Assign Cash');
  }

  function submit_assign(){
    var url = "<?php echo base_url('petty_cash/assign_cash/')?>";
    var date_regex = /^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/;
    var date = $('[name="date"]').val();
    var amount = $('[name="amount"]').val();

    if(date == null || date == ""){
      $("#err_date").text("Insert Date.");
      return false;
    }
    else{
      $("#err_date").text("");
    }
    if (!date.match(date_regex) ) {
      $('#err_date').text(" Please Enter Valid Date.");   
      $('#date').focus();
      return false;
    }
    else{
      $("#err_date").text("");
    }

    if(amount == null || amount == ""){
      $("#err_amount").text("Insert Amount.");
      return false;
    }
    else{
      $("#err_amount").text("");
    }

    $.ajax({
      url : url,
      type: "POST",
      data: $('#form').serialize(),
      dataType: "JSON",
      success: function(data){
        // console.log(data);
        location.reload();
      },
      error: function (jqXHR, textStatus, errorThrown){
        alert('Error check out adding data'+errorThrown);
      }
    });
  }

  function assign_history(emp_id){
    $.ajax({
      url: "<?php echo base_url('petty_cash/assign_history') ?>/"+emp_id,
      type: "GET",
      dataType: "JSON",
      success: function (response) {
        var table = $('#index2').DataTable();
        table.destroy();
        $('#records2').empty();

        var trHTML = '';
        $.each(response.data, function (i, item) {
            trHTML += '<tr>';
            trHTML += '<td></td>';
            trHTML += '<td>' + item.assign_date + '</td>';
            trHTML += '<td>' + item.amount + '</td>';

            var type = '<?php echo $this->session->userdata("type") ?>';
            if(type == 'admin'){
              trHTML += '<td>';
                trHTML += '<div class="dropdown"><button title="Action" type="button" class="btn btn-sm bg-gray gropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> &nbsp;<span class="fa fa-angle-double-down"></span></button><ul class="dropdown-menu"><li><a href="javascript:delete_history_id(' + item.petty_cash_id + ')"><i class="fa fa-trash-o"></i>Delete</a></li></ul></div></td>';
              trHTML += '</td>'; 
            }
            trHTML += '</tr>';
        });

        $('#records2').append(trHTML);

        $(document).ready(function() {
          var t = $('#index2').DataTable({
            "columnDefs": [ {
                "searchable": false,
                "orderable": false,
                "targets": 0
            } ],
            "order": [[ 1, 'asc' ]],
            "pageLength": 100
          });

          t.on( 'order.dt search.dt', function () {
            t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
              cell.innerHTML = i+1;
            });
          }).draw();
        });
      }
    });

    $('#modal_history').modal('show');
  }

  function printContent(el){
    if(el == 'print'){
      $('#header').show();
    }
    else{
      $('#header2').show();
    }
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