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
        window.location.href='<?php  echo base_url('client/delete/'); ?>'+id;
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
          <li><a href="<?php echo base_url('employee/attendance'); ?>" class="text-black"><strong>Employee</strong></a></li>
          <li class="active"><!-- Attendance -->
            Attendance List
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
                <!-- List Attendance -->
                Attendance List
              </h3>

              <?php if(isset($required_month_number)){ ?>
                <a class="btn btn-social bg-gray" style="margin: 10px" href="<?php echo base_url('employee/attendance');?>">
                  <i class="fa fa-arrow-circle-o-left"></i> Current Month's Attendance
                </a>
              <?php } ?>
            </div>
                
            <div class="box-body outer-scroll">
              <div class="inner-scroll">
                <div class="row">
                  <div class="col-sm-12">
                    <form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('employee/attendance');?>">
                      <strong>Attendance List Filter:</strong> &emsp;

                      <select class="form-control select2" name="month" id="month" style="width: 15%;">
                        <option value="01" 
                          <?php 
                            if(isset($required_month_number)){
                              if(date('F', strtotime(date('Y') . '-' . $required_month_number . '-01')) == 'January'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('F') == 'January'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >January</option>
                        <option value="02" 
                          <?php 
                            if(isset($required_month_number)){
                              if(date('F', strtotime(date('Y') . '-' . $required_month_number . '-01')) == 'February'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('F') == 'February'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >February</option>
                        <option value="03" 
                          <?php 
                            if(isset($required_month_number)){
                              if(date('F', strtotime(date('Y') . '-' . $required_month_number . '-01')) == 'March'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('F') == 'March'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >March</option>
                        <option value="04" 
                          <?php 
                            if(isset($required_month_number)){
                              if(date('F', strtotime(date('Y') . '-' . $required_month_number . '-01')) == 'April'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('F') == 'April'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >April</option>
                        <option value="05" 
                          <?php 
                            if(isset($required_month_number)){
                              if(date('F', strtotime(date('Y') . '-' . $required_month_number . '-01')) == 'May'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('F') == 'May'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >May</option>
                        <option value="06" 
                          <?php 
                            if(isset($required_month_number)){
                              if(date('F', strtotime(date('Y') . '-' . $required_month_number . '-01')) == 'June'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('F') == 'June'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >June</option>
                        <option value="07" 
                          <?php 
                            if(isset($required_month_number)){
                              if(date('F', strtotime(date('Y') . '-' . $required_month_number . '-01')) == 'July'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('F') == 'July'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >July</option>
                        <option value="08" 
                          <?php 
                            if(isset($required_month_number)){
                              if(date('F', strtotime(date('Y') . '-' . $required_month_number . '-01')) == 'August'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('F') == 'August'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >August</option>
                        <option value="09" 
                          <?php 
                            if(isset($required_month_number)){
                              if(date('F', strtotime(date('Y') . '-' . $required_month_number . '-01')) == 'September'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('F') == 'September'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >September</option>
                        <option value="10" 
                          <?php 
                            if(isset($required_month_number)){
                              if(date('F', strtotime(date('Y') . '-' . $required_month_number . '-01')) == 'October'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('F') == 'October'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >October</option>
                        <option value="11" 
                          <?php 
                            if(isset($required_month_number)){
                              if(date('F', strtotime(date('Y') . '-' . $required_month_number . '-01')) == 'November'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('F') == 'November'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >November</option>
                        <option value="12" 
                          <?php 
                            if(isset($required_month_number)){
                              if(date('F', strtotime(date('Y') . '-' . $required_month_number . '-01')) == 'December'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('F') == 'December'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >December</option>
                      </select> &emsp;

                      <select class="form-control select2" name="year" id="year" style="width: 15%;">
                        <option value="2001" 
                          <?php 
                            if(isset($required_year_number)){
                              if(date('Y', strtotime($required_year_number . '-' . $required_year_number . '-01')) == '2001'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('Y') == '2001'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >2001</option>
                        <option value="2002" 
                          <?php 
                            if(isset($required_year_number)){
                              if(date('Y', strtotime($required_year_number . '-' . date('m') . '-01')) == '2002'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('Y') == '2002'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >2002</option>
                        <option value="2003" 
                          <?php 
                            if(isset($required_year_number)){
                              if(date('Y', strtotime($required_year_number . '-' . date('m') . '-01')) == '2003'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('Y') == '2003'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >2003</option>
                        <option value="2004" 
                          <?php 
                            if(isset($required_year_number)){
                              if(date('Y', strtotime($required_year_number . '-' . date('m') . '-01')) == '2004'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('Y') == '2004'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >2004</option>
                        <option value="2005" 
                          <?php 
                            if(isset($required_year_number)){
                              if(date('F', strtotime($required_year_number . '-' . date('m') . '-01')) == '2005'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('Y') == '2005'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >2005</option>
                        <option value="2006" 
                          <?php 
                            if(isset($required_year_number)){
                              if(date('Y', strtotime($required_year_number . '-' . date('m') . '-01')) == '2006'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('Y') == '2006'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >2006</option>
                        <option value="2007" 
                          <?php 
                            if(isset($required_year_number)){
                              if(date('Y', strtotime($required_year_number . '-' . date('m') . '-01')) == '2007'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('Y') == '2007'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >2007</option>
                        <option value="2008" 
                          <?php 
                            if(isset($required_year_number)){
                              if(date('Y', strtotime($required_year_number . '-' . date('m') . '-01')) == '2008'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('Y') == '2008'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >2008</option>
                        <option value="2009" 
                          <?php 
                            if(isset($required_year_number)){
                              if(date('Y', strtotime($required_year_number . '-' . date('m') . '-01')) == '2009'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('Y') == '2009'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >2009</option>
                        <option value="2010" 
                          <?php 
                            if(isset($required_year_number)){
                              if(date('Y', strtotime($required_year_number . '-' . date('m') . '-01')) == '2010'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('Y') == '2010'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >2010</option>
                        <option value="2011" 
                          <?php 
                            if(isset($required_year_number)){
                              if(date('Y', strtotime($required_year_number . '-' . date('m') . '-01')) == '2011'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('Y') == '2011'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >2011</option>
                        <option value="2012" 
                          <?php 
                            if(isset($required_year_number)){
                              if(date('Y', strtotime($required_year_number . '-' . date('m') . '-01')) == '2012'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('Y') == '2012'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >2012</option>

                        <option value="2013" 
                          <?php 
                            if(isset($required_year_number)){
                              if(date('Y', strtotime($required_year_number . '-' . date('m') . '-01')) == '2013'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('Y') == '2013'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >2013</option>
                        <option value="2014" 
                          <?php 
                            if(isset($required_year_number)){
                              if(date('Y', strtotime($required_year_number . '-' . date('m') . '-01')) == '2014'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('Y') == '2014'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >2014</option>
                        <option value="2015" 
                          <?php 
                            if(isset($required_year_number)){
                              if(date('Y', strtotime($required_year_number . '-' . date('m') . '-01')) == '2015'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('Y') == '2015'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >2015</option>
                        <option value="2016" 
                          <?php 
                            if(isset($required_year_number)){
                              if(date('Y', strtotime($required_year_number . '-' . date('m') . '-01')) == '2016'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('Y') == '2016'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >2016</option>
                        <option value="2017" 
                          <?php 
                            if(isset($required_year_number)){
                              if(date('Y', strtotime($required_year_number . '-' . date('m') . '-01')) == '2017'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('Y') == '2017'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >2017</option>
                        <option value="2018" 
                          <?php 
                            if(isset($required_year_number)){
                              if(date('Y', strtotime($required_year_number . '-' . date('m') . '-01')) == '2018'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('Y') == '2018'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >2018</option>
                        <option value="2019" 
                          <?php 
                            if(isset($required_year_number)){
                              if(date('Y', strtotime($required_year_number . '-' . date('m') . '-01')) == '2019'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('Y') == '2019'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >2019</option>
                        <option value="2020" 
                          <?php 
                            if(isset($required_year_number)){
                              if(date('Y', strtotime($required_year_number . '-' . date('m') . '-01')) == '2020'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('Y') == '2020'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >2020</option>
                        <option value="2021" 
                          <?php 
                            if(isset($required_year_number)){
                              if(date('Y', strtotime($required_year_number . '-' . date('m') . '-01')) == '2021'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('Y') == '2021'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >2021</option>
                        <option value="2022" 
                          <?php 
                            if(isset($required_year_number)){
                              if(date('Y', strtotime($required_year_number . '-' . date('m') . '-01')) == '2022'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('Y') == '2022'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >2022</option>
                        <option value="2023" 
                          <?php 
                            if(isset($required_year_number)){
                              if(date('Y', strtotime($required_year_number . '-' . date('m') . '-01')) == '2023'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('Y') == '2023'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >2023</option>
                        <option value="2024" 
                          <?php 
                            if(isset($required_year_number)){
                              if(date('Y', strtotime($required_year_number . '-' . date('m') . '-01')) == '2024'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('Y') == '2024'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >2024</option>
                        <option value="2025" 
                          <?php 
                            if(isset($required_year_number)){
                              if(date('Y', strtotime($required_year_number . '-' . date('m') . '-01')) == '2025'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('Y') == '2025'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >2025</option>
                        <option value="2026" 
                          <?php 
                            if(isset($required_year_number)){
                              if(date('Y', strtotime($required_year_number . '-' . date('m') . '-01')) == '2026'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('Y') == '2026'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >2026</option>
                        <option value="2027" 
                          <?php 
                            if(isset($required_year_number)){
                              if(date('Y', strtotime($required_year_number . '-' . date('m') . '-01')) == '2027'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('Y') == '2027'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >2027</option>
                        <option value="2028" 
                          <?php 
                            if(isset($required_year_number)){
                              if(date('Y', strtotime($required_year_number . '-' . date('m') . '-01')) == '2028'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('Y') == '2028'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >2028</option>
                        <option value="2029" 
                          <?php 
                            if(isset($required_year_number)){
                              if(date('Y', strtotime($required_year_number . '-' . date('m') . '-01')) == '2029'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('Y') == '2029'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >2029</option>
                        <option value="2030" 
                          <?php 
                            if(isset($required_year_number)){
                              if(date('Y', strtotime($required_year_number . '-' . date('m') . '-01')) == '2030'){ ?>
                                selected <?php
                              }
                            }
                            else{ 
                              if(date('Y') == '2030'){ ?> 
                                selected <?php 
                              }
                            }
                          ?>
                        >2030</option>
                      </select> &emsp;

                      <button title="Filter Attendance List" type="submit" id="" class="btn bg-gray"><i class="fa fa-search"></i></button> &emsp;

                      <button title="Print Attendance List" type="button" id="" class="btn bg-gray" onclick="printContent('print')"><i class="fa fa-print" aria-hidden="true"></i></button> &emsp;

                      <button title="Holiday" type="button" id="" onclick="holiday()" class="btn bg-gray"><i class="fa fa-plane" aria-hidden="true"></i></button>
                    </form>
                  </div>
                </div>
                <br>

                <div id="print">
                  <div id="header" class="box-header with-border" style="text-align: center; display: none;">
                    <img width="300" height="100" src="<?php echo base_url().'assets/images/winmarkFinal.png'; ?>"><br>
                    <hr>

                    <h3 class="box-title">
                      Attendance List
                    </h3>
                    <br><br>
                  </div>

                  <table id="" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th width="5%" rowspan="2" style="vertical-align: middle;"><!-- Employee ID -->
                          Employee ID
                        </th>
                        <th width="10%" rowspan="2" style="vertical-align: middle;"><!-- Name -->
                          Name
                        </th>
                        <th class="leave" rowspan="2" style="vertical-align: middle;"><!-- Name -->
                          Manage<br>Leave
                        </th>

                        <?php
                          if(isset($required_month_number) && isset($required_year_number)){
                            $month = date('F', strtotime(date('Y') . '-' . $required_month_number . '-01'));
                            $year = date('Y', strtotime($required_year_number . '-' . date('m') . '-01'));
                          }
                          else{
                            $month = date('F');
                            $year = date('Y');
                          }

                          if($month == 'January' || $month == 'March' || $month == 'May' || $month == 'July' || $month == 'August' || $month == 'October' || $month == 'January' || $month == 'December'){
                            $month_no = 31;
                          }
                          else if($month == 'February'){
                            $month_no = 28;
                          }
                          else{
                            $month_no = 30;
                          } 
                        ?>

                        <th colspan="<?php echo $month_no; ?>" style="text-align: center;"><?php if(isset($required_month_number) && isset($required_year_number)){ echo date('F', strtotime(date('Y') . '-' . $required_month_number . '-01')) . ', ' . date('Y', strtotime($required_year_number . '-' . date('m') . '-01')); } else{ echo date('F') . ', ' . date('Y'); }?></th>
                      </tr>
                      <tr>
                        <?php
                          if(isset($required_month_number) && isset($required_year_number)){
                            $month_number = $required_month_number;
                            $year_number = $required_year_number;
                          }
                          else{
                            $month_number = date('m');
                            $year_number = date('Y');
                          }

                          $holiday_dates = array();
                          foreach ($holiday as $key => $value) {
                            array_push($holiday_dates, $value->date);
                          }

                          for($i=1; $i<=$month_no; $i++){
                            if($i >= 1 && $i <= 9){
                              $this_date = date($month_number . '-0' . $i . '-' . $year_number);
                            }
                            else{
                              $this_date = date($month_number . '-' . $i . '-' . $year_number);
                            }
                        ?>
                            <th <?php if(date('D', strtotime($year_number . '-' . $month_number . '-' . $i)) == 'Fri' || in_array($this_date, $holiday_dates)){ ?> style="background-color: #FFC6C6;" <?php }?>>
                              <?php echo $i; ?>
                            </th>
                        <?php    
                          }
                        ?>
                      </tr>
                    </thead>

                    <tbody id="records">
                      <?php
                        foreach ($employee as $row) {
                          $id = $row->id;
                          $emp_id = $row->employee_id;
                          $emp_name = $row->first_name . ' ' . $row->last_name;
                      ?>
                          <tr>
                            <td>
                              <?php echo $emp_id; ?>
                            </td>
                            <td>
                              <?php echo $emp_name; ?>
                            </td>
                            <td class="leave">
                              <button class="btn btn-sm bg-gray" onclick="leave('<?php echo $emp_id;?>', '<?php echo $emp_name;?>'); "><i class="glyphicon glyphicon-random"></i></button>
                            </td>
                            <?php 
                              for($i=1; $i<=$month_no; $i++){
                                if($i >= 1 && $i <= 9){
                                  $j = '0' . $i;
                                }
                                else{
                                  $j = $i;
                                }

                                $sql = "SELECT * FROM attendance WHERE ac_no = '$emp_id' AND (SUBSTRING(date, 4, 2) = '$j' AND SUBSTRING(date, 1, 2) = '$month_number' AND SUBSTRING(date, 7, 4) = '$year_number')";
                                $attendance_data = $this->db->query($sql,array($emp_id));
                                
                                if($i >= 1 && $i <= 9){
                                  $this_date = date($month_number . '-0' . $i . '-' . $year_number);
                                }
                                else{
                                  $this_date = date($month_number . '-' . $i . '-' . $year_number);
                                }
                            ?>
                                <td <?php if($attendance_data->num_rows() > 0 && $attendance_data->row()->leave_remarks){ ?> data-toggle="tooltip" data-placement="bottom" title="<?php echo 'Remarks / Reason for Leave: ' . $attendance_data->row()->leave_remarks; ?>" <?php }?> <?php if(date('D', strtotime($year_number . '-' . $month_number . '-' . $i)) == 'Fri' || in_array($this_date, $holiday_dates)){ ?> style="background-color: #FFC6C6;" <?php } else if($attendance_data->num_rows() > 0 && $attendance_data->row()->leave_status == 'y'){ ?> style="background-color: #FFD782;" <?php }?>>
                                  <input data-id="<?php echo $emp_id . ',' . $emp_name . ',' . $this_date; ?>" type="checkbox" class="att" <?php if($attendance_data->num_rows() > 0 && $attendance_data->row()->leave_status == '' && $attendance_data->row()->absent == ''){ ?> checked <?php }?>>
                                </td>
                            <?php
                              }
                            ?>
                          </tr>
                      <?php
                        }
                      ?>
                    </tbody>

                    <tfoot>
                      <tr>
                        <th width="10%"><!-- Employee ID -->
                          Employee ID
                        </th>
                        <th width="10%"><!-- Name -->
                          Name
                        </th>
                        <th class="leave">
                          Manage<br>Leave
                        </th>
                        <?php
                          for($i=1; $i<=$month_no; $i++){
                            if($i >= 1 && $i <= 9){
                              $this_date = date($month_number . '-0' . $i . '-' . $year_number);
                            }
                            else{
                              $this_date = date($month_number . '-' . $i . '-' . $year_number);
                            }
                        ?>
                            <th <?php if(date('D', strtotime($year_number . '-' . $month_number . '-' . $i)) == 'Fri' || in_array($this_date, $holiday_dates)){ ?> style="background-color: #FFC6C6;" <?php }?>>
                              <?php echo $i; ?>
                            </th>
                        <?php    
                          }
                        ?>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>

              <div class="callout bg-gray-light">
                <h4>Note</h4>

                <p>You can omit leave(s) of an employee by giving him/her an attendance if you wish. Just check that box and the leave will disappear.</p>
                <p>Double check before applying holiday(s). You cannot revert to normal days once those are set to holiday(s).</p>

                <h4 style="margin-bottom: 18px">Legends</h4>
                <span class="btn-sm" style="background-color: #FFC6C6; color: #000000">Holiday</span>&nbsp;&nbsp;
                <span class="btn-sm" style="background-color: #FFD782; color: #000000">Leave</span>
              </div>
            </div>

            <!-- /.modal -->
            <div class="modal fade" id="modal_leave" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Manage Leave</h3>
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
                          <label class="control-label col-md-3">Date range <span class="validation-color">*</span></label>

                          <div class="col-md-9">
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" name="date_range" class="form-control pull-right" id="reservation">
                            </div>
                            <!-- /.input group -->
                            <span class="validation-color" id="err_date_range"></span>
                          </div>
                        </div>
                        <!-- /.form group -->

                        <div class="form-group">
                          <label class="control-label col-md-3">Reason / Remarks <span class="validation-color">*</span></label>
                          <div class="col-md-9">
                            <textarea rows="3" name="remarks" placeholder="Reason / Remarks for Leave" class="form-control"></textarea>
                            <span class="validation-color" id="err_remarks"></span>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" onclick="submit_leave()" class="btn bg-gray">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->

            <!-- /.modal -->
            <div class="modal fade" id="modal_holiday" role="dialog">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Apply Holiday</h3>
                    <h4 class="pull-left"><strong>Assign Holiday(s) for All Employees.</strong></h4>
                  </div>
                  <div class="modal-body form">
                    <form action="#" id="form2" class="form-horizontal">
                      <div class="form-body">
                        <!-- Date range -->
                        <div class="form-group">
                          <label class="control-label col-md-3">Date range <span class="validation-color">*</span></label>

                          <div class="col-md-9">
                            <div class="input-group">
                              <div class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                              </div>
                              <input type="text" name="date_range2" class="form-control pull-right" id="reservation2">
                            </div>
                            <!-- /.input group -->
                            <span class="validation-color" id="err_date_range2"></span>
                          </div>
                        </div>
                        <!-- /.form group -->

                        <div class="form-group">
                          <label class="control-label col-md-3">Reason / Remarks <span class="validation-color">*</span></label>
                          <div class="col-md-9">
                            <textarea rows="3" name="remarks2" placeholder="Reason / Remarks for Holiday(s)" class="form-control"></textarea>
                            <span class="validation-color" id="err_remarks2"></span>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" onclick="submit_holiday()" class="btn bg-gray">Submit</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                  </div>
                </div><!-- /.modal-content -->
              </div><!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
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
  $('.att').click(function(){
    var status;
    if($(this).is(':checked')){
      status = 'insert';
    }
    else{
      status = 'delete';
    }

    var att_data = $(this).attr('data-id');
    att_data = att_data.split(',');
    var emp_id = att_data[0];
    var emp_name = att_data[1];
    var date = att_data[2];

    $.ajax({
      url : "<?php echo base_url('employee/submit_attendance/')?>",
      type: "POST",
      dataType: "JSON",
      data : {
        emp_id: emp_id,
        emp_name: emp_name,
        date: date,
        status: status
      },
      success: function(data)
      {
        // console.log(data);
        if(data == 'reload_page'){
          location.reload();
        }
      }
    });
  });

  function leave(emp_id, emp_name){
    $('#form')[0].reset(); // reset form on modals

    $('#emp_id').html(emp_id);
    $('#emp_name').html(emp_name);

    $('input[name="emp_id"]').val(emp_id);
    $('input[name="emp_name"]').val(emp_name);

    $('#modal_leave').modal('show'); 
    $('.modal-title').text('Manage Leave');
  }

  function submit_leave(){
    var url = "<?php echo base_url('employee/leave/')?>";
    var date_range = $('[name="date_range"]').val();
    var remarks = $('[name="remarks"]').val();

    if(date_range == null || date_range == ""){
      $("#err_date_range").text("Insert Date Range.");
      return false;
    }
    else{
      $("#err_date_range").text("");
    }

    if(remarks == null || remarks == ""){
      $("#err_remarks").text("Insert Reason / Remarks.");
      return false;
    }
    else{
      $("#err_remarks").text("");
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

  function holiday(){
    $('#form2')[0].reset(); // reset form on modals

    $('#modal_holiday').modal('show'); 
    $('.modal-title').text('Apply Holiday');
  }

  function submit_holiday(){
    var url = "<?php echo base_url('employee/holiday/')?>";
    var date_range = $('[name="date_range2"]').val();
    var remarks = $('[name="remarks2"]').val();

    if(date_range == null || date_range == ""){
      $("#err_date_range2").text("Insert Date Range.");
      return false;
    }
    else{
      $("#err_date_range2").text("");
    }

    if(remarks == null || remarks == ""){
      $("#err_remarks2").text("Insert Reason / Remarks.");
      return false;
    }
    else{
      $("#err_remarks2").text("");
    }

    $.ajax({
      url : url,
      type: "POST",
      data: $('#form2').serialize(),
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

  function printContent(el){
    $('#header').show();
    $('.leave').css("display", "none");
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