<style type="text/css">
  .content-all {
    display:none;
  }

  .preload { 
      background-image: url("../assets/images/default-loader.gif");
      height: 100%;
      background-position: center;
      background-repeat: no-repeat;
      transform: rotate(180deg);
  }
</style>

<div class="preload"></div>

<div class="content-all">
<?php 
if(!$this->session->userdata('email')){
  redirect('auth/login');
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
      <h1>
        <?php 
          echo $this->lang->line('header_dashboard'); 
        ?>
      </h1>
    </section>

    <style type="text/css">
      .small-box-mod{
        font-family: 'Montserrat', sans-serif;
        flex: 1 1 auto;
        margin: 2px;
        padding: 30px;
        text-align: center;
        text-transform: uppercase;
        transition: 0.5s;
        background-size: 200% auto;
        background-image: linear-gradient(to right, #a1c4fd 0%, #c2e9fb 51%, #a1c4fd 100%);
        color: black;
        text-shadow: 0px 0px 10px rgba(0,0,0,0.3);
        box-shadow: 0 0 20px #eee;
        border-radius: 6px;
      }
      .small-box-mod:hover {
        background-position: right center;
      }

      .small-box-mod2{
        font-family: 'Montserrat', sans-serif;
        flex: 1 1 auto;
        margin: 2px;
        padding: 30px;
        text-align: center;
        text-transform: uppercase;
        transition: 0.5s;
        background-size: 200% auto;
        background-image: linear-gradient(to right, #f78383 0%, #fac1c1 51%, #fda1a1 100%);
        color: black;
        text-shadow: 0px 0px 10px rgba(0,0,0,0.3);
        box-shadow: 0 0 20px #eee;
        border-radius: 6px;
      }
      .small-box-mod2:hover {
        background-position: right center;
      }

      .target-span{
        background: transparent !important;
        border-color: #00acd6 !important;
      }

      .target-amount{
        background: transparent !important;
        border-color: #00acd6 !important;
      }
      .target-amount:focus{
        background-color: #fff !important;
      }
    </style>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <!-- /.box -->
          <div class="box">
            <div class="box-header">
              <i class="ion ion-stats-bars"></i>

              <h3 class="box-title">Order Summary</h3>
            </div>

            <div class="box-header with-border">
              <span class="box-title external-event bg-gray" id="week2" style="font-size: 14px;"><?php echo $this->lang->line('dashboard_this_week'); ?></span>
              <span class="box-title external-event" id="month2" style="font-size: 14px;"><?php echo $this->lang->line('dashboard_this_month'); ?></span>
              <span class="box-title external-event" id="year2" style="font-size: 14px;"><?php echo $this->lang->line('dashboard_this_year'); ?></span>
              <span class="box-title external-event" id="all2" style="font-size: 14px;"><?php echo $this->lang->line('dashboard_all_time'); ?></span>
            </div>

            <div class="box-body">
              <div class="row">
                <div class="col-md-12 week2">
                  <div style="padding-left: 0;" class="col-md-3 col-xs-5">
                    <div class="small-box-mod2">
                      <div class="inner">
                        <?php 
                          if(isset($weekTotOrdErn[0]->tot_order)){
                            echo "<span class='h-font2'>".$weekTotOrdErn[0]->tot_order."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>0</span>";
                          }
                        ?>
                      </div>
                      <span class="small-box-footer">Order <?php if(isset($weekTotOrdErn[0]->tot_order)) if($weekTotOrdErn[0]->tot_order > 1) echo 's'; ?></span>
                    </div>
                  </div><!-- /.col -->
                  <div class="col-md-3 col-xs-5">
                    <div class="small-box-mod2">
                      <div class="inner">
                        <?php 
                          if(isset($weekTotCust[0]->tot_customer)){
                            echo "<span class='h-font2'>".$weekTotCust[0]->tot_customer."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>0</span>";
                          }
                        ?>
                      </div>
                      <span class="small-box-footer">Customer <?php if(isset($weekTotCust[0]->tot_customer)) if($weekTotCust[0]->tot_customer > 1) echo 's'; ?></span>
                    </div>
                  </div><!-- /.col -->
                  <div class="col-md-3 col-xs-5">
                    <div class="small-box-mod2">
                      <div class="inner">
                        <?php 
                          if(isset($weekTotOrdErn[0]->tot_earning)){
                            echo "<span class='h-font2'>". '৳' . $weekTotOrdErn[0]->tot_earning."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>"."৳0.00</span>";
                          }
                        ?>
                      </div>
                      <span class="small-box-footer">Earning Value</span>
                    </div>
                  </div><!-- /.col -->
                  <div style="padding-right: 0" class="col-md-3 col-xs-5">
                    <div style="padding: 27px 30px" class="small-box-mod2">
                      <div class="inner">
                        <div style="margin-bottom: 10px" class="input-group">
                          <span class="input-group-addon target-span"><strong>৳</strong></span>
                          <input type="number" class="form-control target-amount" name="week_target_amount" id="week_target_amount" value="<?php if($remittanceTarget[0]->week_amount > 0) echo $remittanceTarget[0]->week_amount; ?>">
                          <span class="input-group-btn">
                            <button type="button" id="add_week_amount" class="btn btn-info btn-flat" disabled>Add</button>
                          </span>
                        </div>
                      </div>
                      <span class="small-box-footer">Target Value</span>
                    </div>
                  </div><!-- /.col -->
                </div><!-- /.col 12 -->

                <div class="col-md-12 month2">
                  <div style="padding-left: 0" class="col-md-3 col-xs-5">
                    <div class="small-box-mod2">
                      <div class="inner">
                        <?php 
                          if(isset($monthTotOrdErn[0]->tot_order)){
                            echo "<span class='h-font2'>".$monthTotOrdErn[0]->tot_order."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>0</span>";
                          }
                        ?>
                      </div>
                      <span class="small-box-footer">Order <?php if(isset($monthTotOrdErn[0]->tot_order)) if($monthTotOrdErn[0]->tot_order > 1) echo 's'; ?></span>
                    </div>
                  </div><!-- /.col -->
                  <div class="col-md-3 col-xs-5">
                    <div class="small-box-mod2">
                      <div class="inner">
                        <?php 
                          if(isset($monthTotCust[0]->tot_customer)){
                            echo "<span class='h-font2'>".$monthTotCust[0]->tot_customer."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>0</span>";
                          }
                        ?>
                      </div>
                      <span class="small-box-footer">Customer <?php if(isset($monthTotCust[0]->tot_customer)) if($monthTotCust[0]->tot_customer > 1) echo 's'; ?></span>
                    </div>
                  </div><!-- /.col -->
                  <div class="col-md-3 col-xs-5">
                    <div class="small-box-mod2">
                      <div class="inner">
                        <?php 
                          if(isset($monthTotOrdErn[0]->tot_earning)){
                            echo "<span class='h-font2'>". '৳' . $monthTotOrdErn[0]->tot_earning."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>"."৳0.00</span>";
                          }
                        ?>
                      </div>
                      <span class="small-box-footer">Earning Value</span>
                    </div>
                  </div><!-- /.col -->
                  <div style="padding-right: 0" class="col-md-3 col-xs-5">
                    <div style="padding: 27px 30px" class="small-box-mod2">
                      <div class="inner">
                        <div style="margin-bottom: 10px" class="input-group">
                          <span class="input-group-addon target-span"><strong>৳</strong></span>
                          <input type="number" class="form-control target-amount" name="month_target_amount" id="month_target_amount" value="<?php if($remittanceTarget[0]->month_amount > 0) echo $remittanceTarget[0]->month_amount; ?>">
                          <span class="input-group-btn">
                            <button type="button" id="add_month_amount" class="btn btn-info btn-flat" disabled>Add</button>
                          </span>
                        </div>
                      </div>
                      <span class="small-box-footer">Target Value</span>
                    </div>
                  </div><!-- /.col -->
                </div><!-- /.col 12 -->

                <div class="col-md-12 year2">
                  <div style="padding-left: 0" class="col-md-3 col-xs-5">
                    <div class="small-box-mod2">
                      <div class="inner">
                        <?php 
                          if(isset($yearTotOrdErn[0]->tot_order)){
                            echo "<span class='h-font2'>".$yearTotOrdErn[0]->tot_order."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>0</span>";
                          }
                        ?>
                      </div>
                      <span class="small-box-footer">Order <?php if(isset($yearTotOrdErn[0]->tot_order)) if($yearTotOrdErn[0]->tot_order > 1) echo 's'; ?></span>
                    </div>
                  </div><!-- /.col -->
                  <div class="col-md-3 col-xs-5">
                    <div class="small-box-mod2">
                      <div class="inner">
                        <?php 
                          if(isset($yearTotCust[0]->tot_customer)){
                            echo "<span class='h-font2'>".$yearTotCust[0]->tot_customer."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>0</span>";
                          }
                        ?>
                      </div>
                      <span class="small-box-footer">Customer <?php if(isset($yearTotCust[0]->tot_customer)) if($yearTotCust[0]->tot_customer > 1) echo 's'; ?></span>
                    </div>
                  </div><!-- /.col -->
                  <div class="col-md-3 col-xs-5">
                    <div class="small-box-mod2">
                      <div class="inner">
                        <?php 
                          if(isset($yearTotOrdErn[0]->tot_earning)){
                            echo "<span class='h-font2'>". '৳' . $yearTotOrdErn[0]->tot_earning."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>"."৳0.00</span>";
                          }
                        ?>
                      </div>
                      <span class="small-box-footer">Earning Value</span>
                    </div>
                  </div><!-- /.col -->
                  <div style="padding-right: 0" class="col-md-3 col-xs-5">
                    <div style="padding: 27px 30px" class="small-box-mod2">
                      <div class="inner">
                        <div style="margin-bottom: 10px" class="input-group">
                          <span class="input-group-addon target-span"><strong>৳</strong></span>
                          <input type="number" class="form-control target-amount" name="year_target_amount" id="year_target_amount" value="<?php if($remittanceTarget[0]->year_amount > 0) echo $remittanceTarget[0]->year_amount; ?>">
                          <span class="input-group-btn">
                            <button type="button" id="add_year_amount" class="btn btn-info btn-flat" disabled>Add</button>
                          </span>
                        </div>
                      </div>
                      <span class="small-box-footer">Target Value</span>
                    </div>
                  </div><!-- /.col -->
                </div><!-- /.col 12 -->

                <div class="col-md-12 all2">
                  <div style="padding-left: 0" class="col-md-3 col-xs-5">
                    <div class="small-box-mod2">
                      <div class="inner">
                        <?php 
                          if(isset($allTotOrdErn[0]->tot_order)){
                            echo "<span class='h-font2'>".$allTotOrdErn[0]->tot_order."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>0</span>";
                          }
                        ?>
                      </div>
                      <span class="small-box-footer">Order <?php if(isset($allTotOrdErn[0]->tot_order)) if($allTotOrdErn[0]->tot_order > 1) echo 's'; ?></span>
                    </div>
                  </div><!-- /.col -->
                  <div class="col-md-3 col-xs-5">
                    <div class="small-box-mod2">
                      <div class="inner">
                        <?php 
                          if(isset($allTotCust[0]->tot_customer)){
                            echo "<span class='h-font2'>".$allTotCust[0]->tot_customer."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>0</span>";
                          }
                        ?>
                      </div>
                      <span class="small-box-footer">Customer <?php if(isset($allTotCust[0]->tot_customer)) if($allTotCust[0]->tot_customer > 1) echo 's'; ?></span>
                    </div>
                  </div><!-- /.col -->
                  <div class="col-md-3 col-xs-5">
                    <div class="small-box-mod2">
                      <div class="inner">
                        <?php 
                          if(isset($allTotOrdErn[0]->tot_earning)){
                            echo "<span class='h-font2'>". '৳' . $allTotOrdErn[0]->tot_earning."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>"."৳0.00</span>";
                          }
                        ?>
                      </div>
                      <span class="small-box-footer">Earning Value</span>
                    </div>
                  </div><!-- /.col -->
                  <div style="padding-right: 0" class="col-md-3 col-xs-5">
                    <div style="padding: 27px 30px" class="small-box-mod2">
                      <div class="inner">
                        <div style="margin-bottom: 10px" class="input-group">
                          <span class="input-group-addon target-span"><strong>৳</strong></span>
                          <input type="number" class="form-control target-amount" name="all_target_amount" id="all_target_amount" value="<?php if($remittanceTarget[0]->all_amount > 0) echo $remittanceTarget[0]->all_amount; ?>">
                          <span class="input-group-btn">
                            <button type="button" id="add_all_amount" class="btn btn-info btn-flat" disabled>Add</button>
                          </span>
                        </div>
                      </div>
                      <span class="small-box-footer">Target Value</span>
                    </div>
                  </div><!-- /.col -->
                </div><!-- /.col 12 -->
                <script>
                  $('.month2').hide();
                  $('.year2').hide();
                  $('.all2').hide();
                </script>
              </div><!-- /.row -->
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">
          <!-- /.box -->
          <div class="box">
            <div class="box-header">
              <i class="ion ion-pie-graph"></i>

              <h3 class="box-title">Purchase & Sales Summary</h3>
            </div>

            <div class="box-header with-border">
              <span class="box-title external-event bg-gray" id="week" style="font-size: 14px;"><?php echo $this->lang->line('dashboard_this_week'); ?></span>
              <span class="box-title external-event" id="month" style="font-size: 14px;"><?php echo $this->lang->line('dashboard_this_month'); ?></span>
              <span class="box-title external-event" id="year" style="font-size: 14px;"><?php echo $this->lang->line('dashboard_this_year'); ?></span>
              <span class="box-title external-event" id="all" style="font-size: 14px;"><?php echo $this->lang->line('dashboard_all_time'); ?></span>
            </div>

            <div class="box-body">
              <div class="row">
                <div class="col-md-12 week">
                  <div style="padding-left: 0;" class="col-md-3 col-xs-5">
                    <div class="small-box-mod">
                      <div class="inner">
                        <?php 
                          if(isset($weekPurchase[0]->item)){
                            echo "<span class='h-font2'>".$weekPurchase[0]->item."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>0</span>";
                          }
                        ?>
                      </div>
                      <span class="small-box-footer"><?php echo $this->lang->line('dashboard_purchase_item') . 's'; ?></span>
                    </div>
                  </div><!-- /.col -->
                  <div class="col-md-3 col-xs-5">
                    <div class="small-box-mod">
                      <div class="inner">
                        <?php 
                          if(isset($weekSales[0]->item)){
                            echo "<span class='h-font2'>".$weekSales[0]->item."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>0</span>";
                          }
                        ?>
                      </div>
                      <span class="small-box-footer"><?php echo $this->lang->line('dashboard_sold_items'); ?></span>
                    </div>
                  </div><!-- /.col -->
                  <div class="col-md-3 col-xs-5">
                    <div class="small-box-mod">
                      <div class="inner">
                        <?php 
                          if(isset($weekPurchase[0]->value_in_usd)){
                            echo "<span class='h-font2'>". '$' . $weekPurchase[0]->value_in_usd."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>"."$0.00</span>";
                          }

                          echo '&emsp;';

                          if(isset($weekPurchase[0]->value_in_bdt)){
                            echo "<span class='h-font2'>". '৳' . $weekPurchase[0]->value_in_bdt."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>"."৳0.00</span>";
                          }
                        ?>
                      </div>
                      <span class="small-box-footer"><?php echo $this->lang->line('dashboard_purchase_value'); ?></span>
                    </div>
                  </div><!-- /.col -->
                  <div style="padding-right: 0" class="col-md-3 col-xs-5">
                    <div class="small-box-mod">
                      <div class="inner">
                        <?php 
                          if(isset($weekSales[0]->value_in_usd)){
                            echo "<span class='h-font2'>". '$' . $weekSales[0]->value_in_usd."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>"."$0.00</span>";
                          }

                          echo '&emsp;';

                          if(isset($weekSales[0]->value_in_bdt)){
                            echo "<span class='h-font2'>". '৳' . $weekSales[0]->value_in_bdt."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>"."৳0.00</span>";
                          }
                        ?>
                      </div>
                      <span class="small-box-footer"><?php echo $this->lang->line('dashboard_sales_value'); ?></span>
                    </div>
                  </div><!-- /.col -->
                </div><!-- /.col 12 -->

                <div class="col-md-12 month">
                  <div style="padding-left: 0" class="col-md-3 col-xs-5">
                    <div class="small-box-mod">
                      <div class="inner">
                        <?php 
                          if(isset($monthPurchase[0]->item)){
                            echo "<span class='h-font2'>".$monthPurchase[0]->item."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>0<span class='h-font'>";
                          }
                        ?>
                      </div>
                      <span class="small-box-footer"><?php echo $this->lang->line('dashboard_purchase_item') . 's'; ?></span>
                    </div>
                  </div><!-- /.col -->
                  <div class="col-md-3 col-xs-5">
                    <div class="small-box-mod">
                      <div class="inner">
                        <?php 
                          if(isset($monthSales[0]->item)){
                            echo "<span class='h-font2'>".$monthSales[0]->item."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>0<span class='h-font'>";
                          }
                        ?>
                      </div>
                      <span class="small-box-footer"><?php echo $this->lang->line('dashboard_sold_items'); ?></span>
                    </div>
                  </div><!-- /.col -->
                  <div class="col-md-3 col-xs-5">
                    <div class="small-box-mod">
                      <div class="inner">
                        <?php 
                          if(isset($monthPurchase[0]->value_in_usd)){
                            echo "<span class='h-font2'>". '$' . $monthPurchase[0]->value_in_usd."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>"."$0.00</span>";
                          }

                          echo '&emsp;';

                          if(isset($monthPurchase[0]->value_in_bdt)){
                            echo "<span class='h-font2'>". '৳' . $monthPurchase[0]->value_in_bdt."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>"."৳0.00</span>";
                          }
                        ?>
                      </div>
                      <span class="small-box-footer"><?php echo $this->lang->line('dashboard_purchase_value'); ?></span>
                    </div>
                  </div><!-- /.col -->
                  <div style="padding-right: 0" class="col-md-3 col-xs-5">
                    <div class="small-box-mod">
                      <div class="inner">
                        <?php 
                          if(isset($monthSales[0]->value_in_usd)){
                            echo "<span class='h-font2'>". '$' . $monthSales[0]->value_in_usd."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>"."$0.00</span>";
                          }

                          echo '&emsp;';

                          if(isset($monthSales[0]->value_in_bdt)){
                            echo "<span class='h-font2'>". '৳' . $monthSales[0]->value_in_bdt."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>"."৳0.00</span>";
                          }
                        ?>
                      </div>
                      <span class="small-box-footer"><?php echo $this->lang->line('dashboard_sales_value'); ?></span>
                    </div>
                  </div><!-- /.col -->
                </div><!-- /.col 12 -->

                <div class="col-md-12 year">
                  <div style="padding-left: 0" class="col-md-3 col-xs-5">
                    <div class="small-box-mod">
                      <div class="inner">
                        <?php 
                          if(isset($yearPurchase[0]->item)){
                            echo "<span class='h-font2'>".$yearPurchase[0]->item."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>0<span class='h-font'>";
                          }
                        ?>
                      </div>
                      <span class="small-box-footer"><?php echo $this->lang->line('dashboard_purchase_item') . 's'; ?></span>
                    </div>
                  </div><!-- /.col -->
                  <div class="col-md-3 col-xs-5">
                    <div class="small-box-mod">
                      <div class="inner">
                        <?php 
                          if(isset($yearSales[0]->item)){
                            echo "<span class='h-font2'>".$yearSales[0]->item."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>0<span class='h-font'>";
                          }
                        ?>
                      </div>
                      <span class="small-box-footer"><?php echo $this->lang->line('dashboard_sold_items'); ?></span>
                    </div>
                  </div><!-- /.col -->
                  <div class="col-md-3 col-xs-5">
                    <div class="small-box-mod">
                      <div class="inner">
                        <?php 
                          if(isset($yearPurchase[0]->value_in_usd)){
                            echo "<span class='h-font2'>". '$' . $yearPurchase[0]->value_in_usd."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>"."$0.00</span>";
                          }

                          echo '&emsp;';

                          if(isset($yearPurchase[0]->value_in_bdt)){
                            echo "<span class='h-font2'>". '৳' . $yearPurchase[0]->value_in_bdt."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>"."৳0.00</span>";
                          }
                        ?>
                      </div>
                      <span class="small-box-footer"><?php echo $this->lang->line('dashboard_purchase_value'); ?></span>
                    </div>
                  </div><!-- /.col -->
                  <div style="padding-right: 0" class="col-md-3 col-xs-5">
                    <div class="small-box-mod">
                      <div class="inner">
                        <?php 
                          if(isset($yearSales[0]->value_in_usd)){
                            echo "<span class='h-font2'>". '$' . $yearSales[0]->value_in_usd."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>"."$0.00</span>";
                          }

                          echo '&emsp;';

                          if(isset($yearSales[0]->value_in_bdt)){
                            echo "<span class='h-font2'>". '৳' . $yearSales[0]->value_in_bdt."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>"."৳0.00</span>";
                          }
                        ?>
                      </div>
                      <span class="small-box-footer"><?php echo $this->lang->line('dashboard_sales_value'); ?></span>
                    </div>
                  </div><!-- /.col -->
                </div><!-- /.col 12 -->

                <div class="col-md-12 all">
                  <div style="padding-left: 0" class="col-md-3 col-xs-5">
                    <div class="small-box-mod">
                      <div class="inner">
                        <?php 
                          if(isset($allPurchase[0]->item)){
                            echo "<span class='h-font2'>".$allPurchase[0]->item."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>0<span class='h-font'>";
                          }
                        ?>
                      </div>
                      <span class="small-box-footer"><?php echo $this->lang->line('dashboard_purchase_item') . 's'; ?></span>
                    </div>
                  </div><!-- /.col -->
                  <div class="col-md-3 col-xs-5">
                    <div class="small-box-mod">
                      <div class="inner">
                        <?php 
                          if(isset($allSales[0]->item)){
                            echo "<span class='h-font2'>".$allSales[0]->item."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>0<span class='h-font'>";
                          }
                        ?>
                      </div>
                      <span class="small-box-footer"><?php echo $this->lang->line('dashboard_sold_items'); ?></span>
                    </div>
                  </div><!-- /.col -->
                  <div class="col-md-3 col-xs-5">
                    <div class="small-box-mod">
                      <div class="inner">
                        <?php 
                          if(isset($allPurchase[0]->value_in_usd)){
                            echo "<span class='h-font2'>". '$' . $allPurchase[0]->value_in_usd."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>"."$0.00</span>";
                          }

                          echo '&emsp;';

                          if(isset($allPurchase[0]->value_in_bdt)){
                            echo "<span class='h-font2'>". '৳' . $allPurchase[0]->value_in_bdt."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>"."৳0.00</span>";
                          }
                        ?>
                      </div>
                      <span class="small-box-footer"><?php echo $this->lang->line('dashboard_purchase_value'); ?></span>
                    </div>
                  </div><!-- /.col -->
                  <div style="padding-right: 0" class="col-md-3 col-xs-5">
                    <div class="small-box-mod">
                      <div class="inner">
                        <?php 
                          if(isset($allSales[0]->value_in_usd)){
                            echo "<span class='h-font2'>". '$' . $allSales[0]->value_in_usd."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>"."$0.00</span>";
                          }

                          echo '&emsp;';

                          if(isset($allSales[0]->value_in_bdt)){
                            echo "<span class='h-font2'>". '৳' . $allSales[0]->value_in_bdt."</span>"; 
                          }
                          else {
                            echo "<span class='h-font2'>"."৳0.00</span>";
                          }
                        ?>
                      </div>
                      <span class="small-box-footer"><?php echo $this->lang->line('dashboard_sales_value'); ?></span>
                    </div>
                  </div><!-- /.col -->
                </div><!-- /.col 12 -->
                <script>
                  $('.month').hide();
                  $('.year').hide();
                  $('.all').hide();
                </script>
              </div><!-- /.row -->
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <div class="row">
        <div class="col-md-12">
          <!-- TO DO List -->
          <div class="box">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>

              <h3 class="box-title">Notice Board</h3>
            </div>

            <!-- /.box-header -->
            <div class="box-body" style="min-height: 275px">
              <div class="row">
                <div class="col-md-12">
                  <ul class="todo-list">
                    <?php
                      $counter = 3;
                      foreach ($notice as $key => $value){
                    ?>
                        <li>
                          <span class="text"><?php echo $value->notice_title ?></span>
                          <!-- Emphasis label -->
                          <span style="font-size: 90%" class="label bg-gray"><i class="fa fa-calendar"></i>&nbsp; <?php echo $value->notice_date ?></span>
                          <!-- General tools such as edit or delete-->
                          <div class="tools">
                            <a title="View Description" href="javascript:view_notice(<?php echo $value->notice_id; ?>)" style="color: #ED1C24" class="fa fa-eye"></a>
                            <a title="Edit" href="<?php echo base_url('notice/edit/'); ?><?php echo $value->notice_id; ?>" style="color: #ED1C24" class="fa fa-edit"></a>
                            <a title="Delete" href="javascript:delete_notice(<?php echo $value->notice_id; ?>)" style="color: #ED1C24" class="fa fa-trash-o"></a>
                          </div>
                        </li>
                    <?php
                        $counter--;
                      } 

                      // if($counter > 2){
                        for($i = 0; $i < $counter; $i++){
                          echo '<li>&nbsp;</li>';
                        // }
                      }
                    ?>
                  </ul>

                  <br>

                  <div style="padding: 0;" class="chat">
                    <div class="item">
                      <div style="margin: 0" class="attachment">
                        <h3 style="margin-top: 10px;">
                          <span id="notice_title"><?php if(isset($notice2[0])){ echo $notice2[0]->notice_title; } ?></span>
                          <?php if(isset($notice2[0])){ echo '<span style="font-size: 80%;" class="label bg-gray pull-right"><i class="fa fa-calendar"></i>&nbsp;' . $value->notice_date . '</span>'; } ?>
                        </h3>

                        <p style="font-size: 14px" class="filename">
                          <span id="notice_desc"><?php if(isset($notice2[0])){ echo $notice2[0]->notice_desc; } ?></span>
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.box -->
        </div>

        <!--  <div class="col-md-7"> 
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo $this->lang->line('dashboard_yearly_sales'); ?></h3>
              <div class="box-tools pull-right">
                <button class="btn btn-box-tool" type="button" data-widget="collapse">
                  <i class="fa fa-minus"></i>
                </button>
                <button class="btn btn-box-tool" type="button" data-widget="remove">
                  <i class="fa fa-times"></i>
                </button>
              </div>/box-tools pull-right
            </div>
            <div class="box-body" style="overflow-y: auto;">
              <div id="bar_chart"></div>
            </div>box
          </div>box
        </div> -->

        <!-- <div class="col-md-5"> 
          <div class="box">
            <div class="box-header with-border">
              <select class="form-control select2" id="warehouse" name="warehouse" style="width: 100%;">
                <?php
        
                  foreach ($warehouse as $row) {
                    echo "<option value='$row->warehouse_id'".set_select('warehouse_id',$row->branch_id).">$row->warehouse_name</option>";
                  }
                ?>
              </select>
            </div>
            <div class="box-body">
              <div class="col-sm-12">
                <div class="col-sm-6">
                  <div class="small-box bg-aqua">
                    <div class="inner">
                      <?php 
                        if(isset($product)){
                          echo "<span class='h-font2' style='color: #fff;' id='pitems'>".count($product)."</span>"; 
                        }
                        else {
                          echo "<span class='h-font'>0<span class='h-font'>";
                        }
                      ?>
                    </div>
                    <span class="small-box-footer"><?php echo $this->lang->line('dashboard_no_of_items'); ?></span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="small-box bg-green">
                    <div class="inner">
                      <?php 
                        if(isset($warehouse_product[0]->warehouse_item)){
                          echo "<span class='h-font2' style='color: #fff;' id='witems'>".$warehouse_product[0]->warehouse_item."</span>"; 
                        }
                        else {
                          echo "<span class='h-font'>0<span class='h-font'>";
                        }
                      ?>
                    </div>
                    <span class="small-box-footer"><?php echo $this->lang->line('dashboard_warehouse_products'); ?></span>
                  </div>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="col-sm-6">
                  <div class="small-box bg-yellow">
                    <div class="inner">
                      <?php 
                        if(isset($warehouse_product[0]->value)){
                          echo "<span style='font-size:28px;'>".$this->session->userdata('symbol')."</span><span class='h-font2' style='color: #fff;' id='wvalue'>".$warehouse_product[0]->value."</span>"; 
                        }
                        else {
                          echo "<span style='font-size:28px;'>".$this->session->userdata('symbol')."</span><span class='h-font'>0<span class='h-font'>";
                        }
                      ?>
                    </div>
                    <span class="small-box-footer"><?php echo $this->lang->line('dashboard_value_in_warehouse'); ?></span>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="small-box bg-red">
                    <div class="inner">
                      <?php 
                        if(isset($total_sales[0]->total_sales)){
                          echo "<span style='font-size:28px;'>".$this->session->userdata('symbol')."</span><span class='h-font2' style='color: #fff;' id='tsales'>".$total_sales[0]->total_sales."</span>"; 
                        }
                        else {
                          echo "<span style='font-size:28px;'>".$this->session->userdata('symbol')."</span><span class='h-font'>0<span class='h-font'>";
                        }
                      ?>
                    </div>
                    <span class="small-box-footer"><?php echo $this->lang->line('dashboard_total_sales'); ?></span>
                  </div>
                </div>
              </div>
            </div>box header
          </div>box
        </div>/.col 5 -->
      </div>
    </section>
    <!-- /.content -->
  </div>

<?php 
  $this->load->view('layout/footer');
?>
</div>

<script type="text/javascript">
  $(function() {
      $(".preload").delay(1000).fadeOut(500, function() {
          $(".content-all").fadeIn(500);        
      });
  });
</script>

<script>
      $(document).ready(function() {
        var color = "bg-gray";
        $('#week').click(function(){
          $('#week').addClass(color);
          $('#month').removeClass(color);
          $('#year').removeClass(color);
          $('#all').removeClass(color);
          $('.week').show();
          $('.month').hide();
          $('.year').hide();
          $('.all').hide();
        });
        $('#week2').click(function(){
          $('#week2').addClass(color);
          $('#month2').removeClass(color);
          $('#year2').removeClass(color);
          $('#all2').removeClass(color);
          $('.week2').show();
          $('.month2').hide();
          $('.year2').hide();
          $('.all2').hide();
        });
        $('#month').click(function(){
          $('#month').addClass(color);
          $('#week').removeClass(color);
          $('#year').removeClass(color);
          $('#all').removeClass(color);
          $('.week').hide();
          $('.month').show();
          $('.year').hide();
          $('.all').hide();
        });
        $('#month2').click(function(){
          $('#month2').addClass(color);
          $('#week2').removeClass(color);
          $('#year2').removeClass(color);
          $('#all2').removeClass(color);
          $('.week2').hide();
          $('.month2').show();
          $('.year2').hide();
          $('.all2').hide();
        });
        $('#year').click(function(){
          $('#year').addClass(color);
          $('#week').removeClass(color);
          $('#month').removeClass(color);
          $('#all').removeClass(color);
          $('.week').hide();
          $('.month').hide();
          $('.year').show();
          $('.all').hide();
        });
        $('#year2').click(function(){
          $('#year2').addClass(color);
          $('#week2').removeClass(color);
          $('#month2').removeClass(color);
          $('#all2').removeClass(color);
          $('.week2').hide();
          $('.month2').hide();
          $('.year2').show();
          $('.all2').hide();
        });
        $('#all').click(function(){
          $('#all').addClass(color);
          $('#week').removeClass(color);
          $('#month').removeClass(color);
          $('#year').removeClass(color);
          $('.week').hide();
          $('.month').hide();
          $('.year').hide();
          $('.all').show();
        });
        $('#all2').click(function(){
          $('#all2').addClass(color);
          $('#week2').removeClass(color);
          $('#month2').removeClass(color);
          $('#year2').removeClass(color);
          $('.week2').hide();
          $('.month2').hide();
          $('.year2').hide();
          $('.all2').show();
        });

        $('#week_target_amount').on('input change', function(){
          if($(this).val() == '' || $(this).val() == null){
            $('#add_week_amount').prop("disabled", true);
          }
          else{
            $('#add_week_amount').prop("disabled", false);
          }
        });

        $('#month_target_amount').on('input change', function(){
          if($(this).val() == '' || $(this).val() == null){
            $('#add_month_amount').prop("disabled", true);
          }
          else{
            $('#add_month_amount').prop("disabled", false);
          }
        });

        $('#year_target_amount').on('input change', function(){
          if($(this).val() == '' || $(this).val() == null){
            $('#add_year_amount').prop("disabled", true);
          }
          else{
            $('#add_year_amount').prop("disabled", false);
          }
        });

        $('#all_target_amount').on('input change', function(){
          if($(this).val() == '' || $(this).val() == null){
            $('#add_all_amount').prop("disabled", true);
          }
          else{
            $('#add_all_amount').prop("disabled", false);
          }
        });

        $('#add_week_amount').on('click', function(){
          var week_target_amount = $('#week_target_amount').val();
          var type = 'week';

          $.ajax({
            url: "<?php echo base_url('auth/updateTotAmount') ?>",
            type: "POST",
            dataType: "JSON",
            data: { 
              week_target_amount: week_target_amount,
              type: type
            },
            success: function(data){
            } 
          });
        });

        $('#add_month_amount').on('click', function(){
          var month_target_amount = $('#month_target_amount').val();
          var type = 'month';

          $.ajax({
            url: "<?php echo base_url('auth/updateTotAmount') ?>",
            type: "POST",
            dataType: "JSON",
            data: { 
              month_target_amount: month_target_amount,
              type: type
            },
            success: function(data){
              console.log(data)
            } 
          });
        });

        $('#add_year_amount').on('click', function(){
          var year_target_amount = $('#year_target_amount').val();
          var type = 'year';

          $.ajax({
            url: "<?php echo base_url('auth/updateTotAmount') ?>",
            type: "POST",
            dataType: "JSON",
            data: { 
              year_target_amount: year_target_amount,
              type: type
            },
            success: function(data){
              console.log(data)
            } 
          });
        });

        $('#add_all_amount').on('click', function(){
          var all_target_amount = $('#all_target_amount').val();
          var type = 'all';

          $.ajax({
            url: "<?php echo base_url('auth/updateTotAmount') ?>",
            type: "POST",
            dataType: "JSON",
            data: { 
              all_target_amount: all_target_amount,
              type: type
            },
            success: function(data){
              console.log(data)
            } 
          });
        });
      });
      $('#warehouse').change(function(){
        var id = $(this).val();
        $.ajax({
            url: "<?php echo base_url('auth/getWarehouseData') ?>/"+id,
            type: "GET",
            dataType: "JSON",
            success: function(data){
              if(data['product'].length == null){
                $('#pitems').text('0');
              }
              else{
                $('#pitems').text(data['product'].length);
              }

              if(data['warehouse_product'][0].warehouse_item == null){
                $('#witems').text('0');
              }
              else{
                $('#witems').text(data['warehouse_product'][0].warehouse_item);
              }

              if(data['warehouse_product'][0].value == null){
                $('#wvalue').text('0');
              }
              else{
                $('#wvalue').text(data['warehouse_product'][0].value);
              }

              if(data['total_sales'][0].total_sales == null){
                $('#tsales').text('0');
              }
              else{
                $('#tsales').text(data['total_sales'][0].total_sales);
              }
              //console.log(data);
            } 
          });
      });
  </script>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['bar']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url('auth/product_profit') ?>',
        success: function (data1) {
          var data = new google.visualization.DataTable();
          data.addColumn('string', '<?php echo $this->lang->line('dashboard_month'); ?>');
          data.addColumn('number', '<?php echo $this->lang->line('header_sales'); ?>');
          data.addColumn('number', '<?php echo $this->lang->line('header_purchase'); ?>');
          var jsonData = $.parseJSON(data1);
          for(var i in jsonData){
            data.addRow([jsonData[i].month, parseInt(jsonData[i].sales),parseInt(jsonData[i].purchase)]);
          }
          

          var options = {
            chart: {
              title: '<?php echo $this->lang->line('dashboard_sales_performance'); ?>',
              subtitle: '<?php echo $this->lang->line('dashboard_sales_of_company'); ?>'
            },
            width: 600,
            height: 400,
            axes: {
               x: {
                  0: {side: 'bottom'}
                },
                y:{
                  0:{side: 'left'}
                }
            }
          };
          var chart = new google.charts.Bar(document.getElementById('bar_chart'));
          chart.draw(data, options);
        }
    });
  }
</script>

<script type="text/javascript">
  function delete_notice(id)
  {
    if(confirm('Sure To Remove This Record ?'))
    {
      window.location.href='<?php  echo base_url('notice/delete/'); ?>'+id;
    }
  }

  function view_notice(id)
  {
    $.ajax({
      url: "<?php echo base_url('auth/getNoticeData') ?>/"+id,
      type: "GET",
      dataType: "JSON",
      success: function (response) {
        $('#notice_title').html(response[0].notice_title);
        $('#notice_desc').html(response[0].notice_desc);
      }
    });
  }
</script>