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
          <li class="active"><!-- Salary Sheet -->
            Salary Sheet
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
                <!-- Salary Sheet -->
                Salary Sheet
              </h3>

              <?php if(isset($required_month_number)){ ?>
                <a class="btn btn-social bg-gray" style="margin: 10px" href="<?php echo base_url('employee/salary_sheet');?>">
                  <i class="fa fa-arrow-circle-o-left"></i> Current Month's Salary Sheet
                </a>
              <?php } ?>
            </div>
                
            <div class="box-body outer-scroll">
              <div class="inner-scroll">
                <div class="row">
                  <div class="col-sm-12">
                    <form role="form" method="post" enctype="multipart/form-data" action="<?php echo base_url('employee/salary_sheet');?>">
                      <strong>Salary Sheet Filter:</strong> &emsp;

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

                      <button title="Filter Salary Sheet" type="submit" id="" class="btn bg-gray"><i class="fa fa-search" aria-hidden="true"></i></button> &emsp;

                      <?php 
                        if(isset($required_month_number) && isset($required_year_number)){ 
                          $curr_month_year = date('F', strtotime(date('Y') . '-' . $required_month_number . '-01')) . ', ' . date('Y', strtotime($required_year_number . '-' . date('m') . '-01'));
                        }
                        else{ 
                          $curr_month_year = date('F') . ', ' . date('Y');
                        }

                        $counter = 0;
                        $fine = array(); $grace = array(); $tds = array(); $others = array();

                        foreach ($salary as $value) {
                          if($value->month_and_year == $curr_month_year){
                            array_push($fine, $value->fine);
                            array_push($grace, $value->grace);
                            array_push($tds, $value->tds);
                            array_push($others, $value->others);

                            $counter++;
                          }
                        }
                      ?>

                      <button title="Finalize Salary Sheet" type="button" id="" onclick="finalize()" class="btn bg-gray" <?php if($counter > 0){ ?> disabled <?php }?>><i class="fa fa-check" aria-hidden="true"></i></button>

                      <?php 
                        if($counter > 0){
                      ?>
                        &emsp;<button title="Print Salary Sheet" type="button" class="btn bg-gray" onclick="printContent('print')"><i class="fa fa-print" aria-hidden="true"></i></button>
                      <?php
                        }
                      ?>
                    </form>
                  </div>
                </div>
                <br>

                <div id="print">
                  <div id="header" class="box-header with-border" style="text-align: center; display: none">
                    <img width="300" height="100" src="<?php echo base_url().'assets/images/winmarkFinal.png'; ?>"><br>
                    <hr>

                    <h3 class="box-title">
                      Monthly Report
                    </h3>
                    <br><br>
                  </div>

                  <table id="" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th rowspan="3" style="min-width: 115px; vertical-align: middle; text-align: center;">Employee ID</th>
                        <th rowspan="3" style="min-width: 130px; vertical-align: middle; text-align: center;">Name</th>
                        <th rowspan="3" style="min-width: 100px; vertical-align: middle; text-align: center;">Designation</th>
                        <th rowspan="3" style="min-width: 90px; vertical-align: middle; text-align: center;">Joining Date</th>
                        <th colspan="20" style="vertical-align: middle; text-align: center;">
                          <?php 
                            echo '<span id="month_year">' . $curr_month_year . '</span>'; 

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

                            $holidays = 0;
                            $fridays = array();
                            for($i=1; $i<=$month_no; $i++){
                              if($i >= 1 && $i <= 9){
                                $this_date = date('0' . $i . '-' . $month_number . '-' . $year_number);

                                if(in_array(date('m-d-Y', strtotime($this_date)), $holiday_dates)){
                                  $holidays++;
                                }

                                if(date('l', strtotime($this_date)) == 'Friday'){
                                  array_push($fridays, date('m-d-Y', strtotime($this_date)));
                                }
                              }
                              else{
                                $this_date = date($i . '-' . $month_number . '-' . $year_number);

                                if(in_array(date('m-d-Y', strtotime($this_date)), $holiday_dates)){
                                  $holidays++;
                                }

                                if(date('l', strtotime($this_date)) == 'Friday'){
                                  array_push($fridays, date('m-d-Y', strtotime($this_date)));
                                }
                              }
                            }
                          ?>
                        </th>
                      </tr>
                      <tr>
                        <th colspan="6" style="vertical-align: middle; text-align: center;">Monthly Attendance</th>
                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Salary</th>
                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Basic (50%)</th>
                        <th colspan="5" style="vertical-align: middle; text-align: center;">Allowances</th>
                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Gross Salary</th>
                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Per Day Salary</th>
                        <th colspan="3" style="vertical-align: middle; text-align: center;">Deductions</th>
                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Total Deduction</th>
                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Net Salary</th>
                      </tr>
                      <tr>
                        <th style="vertical-align: middle; text-align: center;">Present</th>
                        <th style="vertical-align: middle; text-align: center;">Leave</th>
                        <th style="vertical-align: middle; text-align: center;">Absent</th>
                        <th style="min-width: 75px; vertical-align: middle; text-align: center;">Fine</th>
                        <th style="min-width: 75px; vertical-align: middle; text-align: center;">Grace</th>
                        <th style="vertical-align: middle; text-align: center;">Salary Mode</th>
                        <th style="vertical-align: middle; text-align: center;">House Rent (25%)</th>
                        <th style="vertical-align: middle; text-align: center;">Medical (5%)</th>
                        <th style="vertical-align: middle; text-align: center;">LFA (10%)</th>
                        <th style="vertical-align: middle; text-align: center;">Conveyance (5%)</th>
                        <th style="vertical-align: middle; text-align: center;">Special Allowance (5%)</th>
                        <th style="vertical-align: middle; text-align: center;">Absent Deduction</th>
                        <th style="min-width: 90px; vertical-align: middle; text-align: center;">TDS</th>
                        <th style="min-width: 90px; vertical-align: middle; text-align: center;">Others</th>
                      </tr>
                    </thead>

                    <tbody id="records">
                      <?php
                        foreach ($data as $key => $row) {
                          $id = $row->id;
                          $emp_id = $row->employee_id;
                          $emp_name = $row->first_name . ' ' . $row->last_name;

                          // echo $fridays;
                          $sql = "SELECT COUNT(DISTINCT CASE WHEN (date = '$fridays[0]' OR date = '$fridays[1]' OR date = '$fridays[2]' OR date = '$fridays[3]') THEN date END) AS fridays, COUNT(DISTINCT CASE WHEN (absent = '' AND leave_status = '') THEN date END) AS presents, COUNT(DISTINCT CASE WHEN leave_status = 'y' THEN date END) AS leaves, COUNT(DISTINCT CASE WHEN (absent = 'temp') THEN date END) AS absents FROM attendance WHERE ac_no = '$emp_id' AND (SUBSTRING(date, 1, 2) = '$month_number' AND SUBSTRING(date, 7, 4) = '$year_number')";

                          if(isset($fridays[4])){
                            $sql = "SELECT COUNT(DISTINCT CASE WHEN (date = '$fridays[0]' OR date = '$fridays[1]' OR date = '$fridays[2]' OR date = '$fridays[3]' OR date = '$fridays[4]') THEN date END) AS fridays, COUNT(DISTINCT CASE WHEN (absent = '' AND leave_status = '') THEN date END) AS presents, COUNT(DISTINCT CASE WHEN leave_status = 'y' THEN date END) AS leaves, COUNT(DISTINCT CASE WHEN (absent = 'temp') THEN date END) AS absents FROM attendance WHERE ac_no = '$emp_id' AND (SUBSTRING(date, 1, 2) = '$month_number' AND SUBSTRING(date, 7, 4) = '$year_number')";
                          }

                          if(isset($fridays[5])){
                            $sql = "SELECT COUNT(DISTINCT CASE WHEN (date = '$fridays[0]' OR date = '$fridays[1]' OR date = '$fridays[2]' OR date = '$fridays[3]' OR date = '$fridays[4]' OR date = '$fridays[5]') THEN date END) AS fridays, COUNT(DISTINCT CASE WHEN (absent = '' AND leave_status = '') THEN date END) AS presents, COUNT(DISTINCT CASE WHEN leave_status = 'y' THEN date END) AS leaves, COUNT(DISTINCT CASE WHEN (absent = 'temp') THEN date END) AS absents FROM attendance WHERE ac_no = '$emp_id' AND (SUBSTRING(date, 1, 2) = '$month_number' AND SUBSTRING(date, 7, 4) = '$year_number')";
                          }

                          $salary_data = $this->db->query($sql,array($emp_id));
                      ?>
                          <tr>
                            <td style="vertical-align: middle; text-align: center;">
                              <?php echo $emp_id; ?>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                              <?php echo $emp_name; ?>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                              <?php echo $row->join_desg; ?>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                              <?php echo $row->join_date; ?>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                              <?php 
                                if($salary_data->num_rows() > 0){
                                  echo $presents = $salary_data->row()->presents + $salary_data->row()->leaves + $salary_data->row()->fridays + $holidays;
                                }
                              ?>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                              <?php 
                                if($salary_data->num_rows() > 0){
                                  echo $leaves = $salary_data->row()->leaves;
                                }
                              ?>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                              <?php 
                                if($salary_data->num_rows() > 0){
                                  echo $absents = $month_no + $salary_data->row()->absents - ($holidays + $salary_data->row()->fridays +$salary_data->row()->presents + $salary_data->row()->leaves);
                                }
                              ?>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                              <input type="number" name="fine" class="form-control fine" value="<?php if(isset($fine[$key])){ echo $fine[$key]; } else{ echo 0; } ?>" <?php if(isset($fine[$key])){ ?> readonly <?php }?>>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                              <input type="number" name="grace" class="form-control grace" value="<?php if(isset($grace[$key])){ echo $grace[$key]; } else{ echo 0; } ?>" <?php if(isset($grace[$key])){ ?> readonly <?php }?>>
                            </td>
                            <td style="vertical-align: middle; text-align: center;"></td>
                            <td style="vertical-align: middle; text-align: center;">
                              <?php echo $salary = $row->starting_salary; ?>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                              <?php echo $basic = $row->starting_salary * 0.5; ?>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                              <?php echo $house_rent = $row->starting_salary * 0.25; ?>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                              <?php echo $medical = $row->starting_salary * 0.05; ?>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                              <?php echo $lfa = $row->starting_salary * 0.1; ?>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                              <?php echo $conveyance = $row->starting_salary * 0.05; ?>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                              <?php echo $special_allowances = $row->starting_salary * 0.05; ?>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                              <?php echo $basic + $house_rent + $medical + $lfa + $conveyance + $special_allowances; ?>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                              <?php echo $salary_per_day = number_format((float)($row->starting_salary / $month_no), 2, '.', ''); ?>
                            </td>
                            <td style="vertical-align: middle; text-align: center;"></td>
                            <td style="vertical-align: middle; text-align: center;">
                              <input type="number" name="tds" class="form-control tds" value="<?php if(isset($tds[$key])){ echo $tds[$key]; } else{ echo 0; } ?>" <?php if(isset($tds[$key])){ ?> readonly <?php }?>>
                            </td>
                            <td style="vertical-align: middle; text-align: center;">
                              <input type="number" name="others" class="form-control others" value="<?php if(isset($others[$key])){ echo $others[$key]; } else{ echo 0; } ?>" <?php if(isset($others[$key])){ ?> readonly <?php }?>>
                            </td>
                            <td style="vertical-align: middle; text-align: center;"></td>
                            <td style="vertical-align: middle; text-align: center;"></td>
                          </tr>
                      <?php 
                        }
                      ?>
                    </tbody>

                    <tfoot>
                      <tr>
                        <th width="5%" rowspan="2" style="vertical-align: middle; text-align: center;">Employee ID</th>
                        <th width="10%" rowspan="2" style="vertical-align: middle; text-align: center;">Name</th>
                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Designation</th>
                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Joining Date</th>
                        <th colspan="6" style="vertical-align: middle; text-align: center;">Monthly Attendance</th>
                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Salary</th>
                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Basic</th>
                        <th colspan="5" style="vertical-align: middle; text-align: center;">Allowances</th>
                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Gross Salary</th>
                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Per Day Salary</th>
                        <th colspan="3" style="vertical-align: middle; text-align: center;">Deductions</th>
                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Total Deduction</th>
                        <th rowspan="2" style="vertical-align: middle; text-align: center;">Net Salary</th>
                      </tr>
                    </tfoot>
                  </table>
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
  $('#records tr').each(function() {
    var present = $(this).find("td").eq(4).html();
    var leave = $(this).find("td").eq(5).html();
    var grace = $(this).find('input[name="grace"]').val();
    var mode = +present + +grace;
    
    $(this).find("td").eq(9).html(mode);

    var absent = $(this).find("td").eq(6).html();
    var fine = $(this).find('input[name="fine"]').val();
    var salary_per_day = $(this).find("td").eq(18).html();
    var absent_deduction = +(salary_per_day * absent) + +(salary_per_day * fine);

    $(this).find("td").eq(19).html(absent_deduction.toFixed(2));

    var tds = $(this).find('input[name="tds"]').val();
    var others = $(this).find('input[name="others"]').val();
    var total_deduction = +absent_deduction + +tds + +others;

    $(this).find("td").eq(22).html(total_deduction.toFixed(2));

    var gross_salary = $(this).find("td").eq(17).html();
    var net_salary = gross_salary - total_deduction;

    $(this).find("td").eq(23).html(net_salary.toFixed(2));
  });

  $(".grace").on("input", function() {
    var present = $(this).parent().parent().find("td").eq(4).html();
    var leave = $(this).parent().parent().find("td").eq(5).html();
    var grace = $(this).parent().find('input[name="grace"]').val();
    var mode = +present + +grace;
    
    $(this).parent().parent().find("td").eq(9).html(mode);
  });

  $(".fine").on("input", function() {
    var absent = $(this).parent().parent().find("td").eq(6).html();
    var fine = $(this).parent().find('input[name="fine"]').val();
    var salary_per_day = $(this).parent().parent().find("td").eq(18).html();
    var absent_deduction = +(salary_per_day * absent) + +(salary_per_day * fine);
    
    $(this).parent().parent().find("td").eq(19).html(absent_deduction.toFixed(2));

    var tds = $(this).parent().parent().find('.tds').val();
    var others = $(this).parent().parent().find('.others').val();
    var total_deduction = +absent_deduction + +tds + +others;
    
    $(this).parent().parent().find("td").eq(22).html(total_deduction.toFixed(2));

    var gross_salary = $(this).parent().parent().find("td").eq(17).html();
    var net_salary = +gross_salary - +total_deduction;

    $(this).parent().parent().find("td").eq(23).html(net_salary.toFixed(2));
  });

  $(".tds").on("input", function() {
    var absent_deduction = $(this).parent().parent().find("td").eq(19).html();
    var tds = $(this).parent().find('input[name="tds"]').val();
    var others = $(this).parent().parent().find('.others').val();
    var total_deduction = +absent_deduction + +tds + +others;
    
    $(this).parent().parent().find("td").eq(22).html(total_deduction.toFixed(2));

    var gross_salary = $(this).parent().parent().find("td").eq(17).html();
    var net_salary = +gross_salary - +total_deduction;

    $(this).parent().parent().find("td").eq(23).html(net_salary.toFixed(2));
  });

  $(".others").on("input", function() {
    var absent_deduction = $(this).parent().parent().find("td").eq(19).html();
    var tds = $(this).parent().parent().find('.tds').val();
    var others = $(this).parent().find('input[name="others"]').val();
    var total_deduction = +absent_deduction + +tds + +others;
    
    $(this).parent().parent().find("td").eq(22).html(total_deduction.toFixed(2));

    var gross_salary = $(this).parent().parent().find("td").eq(17).html();
    var net_salary = +gross_salary - +total_deduction;

    $(this).parent().parent().find("td").eq(23).html(net_salary.toFixed(2));
  });

  function finalize(){
    var month_and_year = $('#month_year').html();

    if(confirm('Sure to Finalize This Salary Steet? Please Double Check Before Finalize. You Cannot Re-finalize Salary Sheet of ' + month_and_year + '.')){
      var table_data = new Array();

      $('#records tr').each(function(i){
        table_data[i] = new Array();

        $(this).closest('tr').find('td').each(function(j){
          if(j == 7){
            table_data[i][j] = $(this).find('input[name="fine"]').val();
          }
          else if(j == 8){
            table_data[i][j] = $(this).find('input[name="grace"]').val();
          }
          else if(j == 20){
            table_data[i][j] = $(this).find('input[name="tds"]').val();
          }
          else if(j == 21){
            table_data[i][j] = $(this).find('input[name="others"]').val();
          }
          else{
            table_data[i][j] = $(this).html().trim();
          }
        });
      });

      $.ajax({
        url: "<?php echo base_url('employee/finalize') ?>/",
        type: "POST",
        dataType: "JSON",
        data : {
          month_and_year: month_and_year,
          salary_data: table_data
        },
        success: function (response){
          // console.log(response);
          location.reload();
        }
      });
    }
  }

  function printContent(el){
    $('#header').show();
    $('.table-bordered th').eq(0).css("min-width", "");
    $('.table-bordered').css("font-size", "10px");
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