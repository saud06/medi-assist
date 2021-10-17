<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$p = array('admin','accountant','manager');
if(!(in_array($this->session->userdata('type'),$p))){
  redirect('auth');
}
$this->load->view('layout/header');
?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    <h5>
		<ol class="breadcrumb">
		  <li><a href="<?php echo base_url('auth/dashboard'); ?>" class="text-black"><i class="fa fa-dashboard">&nbsp;</i><strong><?php echo $this->lang->line('header_dashboard'); ?></strong></a></li>
		  <li class="active"><?php echo $this->lang->line('reports_daily_reports'); ?></li>
		</ol>
  	</h5> 
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
      	<div class="col-md-12">
      		<div class="box box-info">
      			<div class="box-body">
      			<div id="external-events">
  					<span class="external-event bg-yellow pull-left">
  						<?php echo $this->lang->line('reports_current_month_sales'); ?> <?php echo $this->session->userdata('symbol').$current_month_sales[0]->total; ?> 
  					</span>
  					<span class="external-event bg-green pull-right">
  						<?php echo $this->lang->line('reports_profite'); ?> <?php  echo $this->session->userdata('symbol').($current_month_sales[0]->total - $profit); ?>		
  					</span>
  				</div>
  				</div>
      		</div>
      	</div>
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-body no-padding">
              <!-- THE CALENDAR -->
              <div id="calendar1"></div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /. box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

 <?php $this->load->view('layout/footer') ?> 


<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/fullcalendar/fullcalendar.min.js"></script>

<script>
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {

        // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        };

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject);

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex: 1070,
          revert: true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        });

      });
    }

    ini_events($('#external-events div.external-event'));

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date();
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear();
    $('#calendar1').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'today',
        month: 'month',
        week: 'week',
        day: 'day'
      },
      //Random default events
      events: [
			<?php foreach ($sales as $value) { ?>
				{
					title: 'S : <?php echo $this->session->userdata('symbol').$value->total; ?>',
					start: '<?php echo $value->date; ?>',
					color: 'green'				
				},
			<?php } ?>
			<?php foreach ($sales_return as $value) { ?>
				{
					title: 'SR: <?php echo $this->session->userdata('symbol').$value->total; ?>',
					start: '<?php echo $value->date; ?>',
					color: 'red'		
				},
			<?php } ?>
			<?php foreach ($day_profit as $value) { ?>
				{
					title: 'P: <?php echo $this->session->userdata('symbol').$value->profit; ?>',
					start: '<?php echo $value->date; ?>',
					color: 'blue'			
				},
			<?php } ?>
			]
      
    });

    /* ADDING EVENTS */
    var currColor = "#3c8dbc"; //Red by default
    //Color chooser button
    var colorChooser = $("#color-chooser-btn");
    $("#color-chooser > li > a").click(function (e) {
      e.preventDefault();
      //Save color
      currColor = $(this).css("color");
      //Add color effect to button
      $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
    });
    $("#add-new-event").click(function (e) {
      e.preventDefault();
      //Get value and make sure it is not null
      var val = $("#new-event").val();
      if (val.length == 0) {
        return;
      }

      //Create events
      var event = $("<div />");
      event.css({"background-color": currColor, "border-color": currColor, "color": "#fff"}).addClass("external-event");
      event.html(val);
      $('#external-events').prepend(event);

      //Add draggable funtionality
      ini_events(event);

      //Remove event from text input
      $("#new-event").val("");
    });
  });
</script>