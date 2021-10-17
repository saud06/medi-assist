  <?php date_default_timezone_set('asia/dhaka'); ?>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b><?php echo $this->lang->line('dashboard_version'); ?></b> 1.0
    </div>
     <?php echo $this->lang->line('dashboard_copyright'); ?> &copy; <?php echo date('Y'); ?> <strong><a href="#" target="_blank" class="text-black">Winmark BD Ltd</a></strong>. Developed by <strong><a href="http://rrmsense.com/" target="_blank" class="text-black">RRMSENSE Global Systech Limited</a></strong>. All <?php echo $this->lang->line('dashboard_rights_reserved'); ?>
  </footer>
<!-- ./wrapper -->
<!-- Control Sidebar -->

<!-- Cancel Button -->
<script type="text/javascript">
  function cancel(path){
    window.location.href='<?php  echo base_url(); ?>'+path;
  }
</script>
<!-- close cancel button -->
<script src="<?php echo base_url();?>assets/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/jQuery/jquery-3.1.1.js"></script> 
<!-- jQuery 2.2.3 -->
<!-- <script src="<?php echo base_url('assets/'); ?>plugins/jQuery/jquery-2.2.3.min.js"></script> -->
<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('assets/'); ?>plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="<?php echo base_url('assets/'); ?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url('assets/'); ?>plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="<?php echo base_url('assets/'); ?>plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- CK Editor -->
<!-- <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script> -->
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url('assets/'); ?>plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="<?php echo base_url('assets/'); ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/'); ?>plugins/fastclick/fastclick.js"></script>

<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.dataTables.min.css">
<style type="text/css">
  button.dt-button {
    background-image: none;
    background-color: #D2D6DE !important;
    border: 1px solid transparent;
  }

  button.dt-button:hover:not(.disabled) {
    background-image: none;
    background-color: #AFB3B9 !important;
    border: 1px solid transparent;
  }

  div.dt-button-collection>button.dt-button.active:not(.disabled):hover:not(.disabled){
    background-image: none;
    background-color: #AFB3B9 !important;
    border: 1px solid transparent;
  }

  div.dt-button-collection>button.dt-button.active:not(.disabled) {
    background-image: none;
    background-color: #AFB3B9 !important;
    border: 1px solid transparent;
  }
</style>
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>

<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/'); ?>dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url('assets/'); ?>dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/'); ?>dist/js/demo.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url('assets/'); ?>bootstrap/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url('assets/'); ?>plugins/select2/select2.full.min.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url('assets/'); ?>plugins/input-mask/jquery.inputmask.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url('assets/'); ?>plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- bootstrap color picker -->
<script src="<?php echo base_url('assets/'); ?>plugins/colorpicker/bootstrap-colorpicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="<?php echo base_url('assets/'); ?>plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- SlimScroll 1.3.0 -->
<script src="<?php echo base_url('assets/'); ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url('assets/'); ?>plugins/iCheck/icheck.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url('assets/'); ?>plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/'); ?>dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/'); ?>dist/js/demo.js"></script>
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    //Datemask dd/mm/yyyy
    $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
    //Datemask2 mm/dd/yyyy
    $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
    //Money Euro
    $("[data-mask]").inputmask();

    //Date range picker
    $('#reservation').daterangepicker();
    $('#reservation2').daterangepicker();
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
    //Date range as a button
    $('#daterange-btn').daterangepicker(
        {
          ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate: moment()
        },
        function (start, end) {
          $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
    );

    //Date picker
    $(document).ready(function() {
      $('.datepicker').datepicker({
          autoclose: true,
          format: "yyyy-mm-dd",
          todayHighlight: true,
          orientation: "auto",
          todayBtn: true,
          todayHighlight: true,  
      });
    });
    

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass: 'iradio_minimal-blue'
    });
    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
      checkboxClass: 'icheckbox_minimal-red',
      radioClass: 'iradio_minimal-red'
    });
    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass: 'iradio_flat-green'
    });

    //Colorpicker
    $(".my-colorpicker1").colorpicker();
    //color picker with addon
    $(".my-colorpicker2").colorpicker();

    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });
    //ckeditor
    /*$(function () {
      // Replace the <textarea id="editor1"> with a CKEditor
      // instance, using default configuration.
      CKEDITOR.replace('details');
      //bootstrap WYSIHTML5 - text editor
      $(".textarea").wysihtml5();
    });*/
  });
</script>

<!-- Datatable Index -->
    <script type="text/javascript">
      $(document).ready(function() {
        var t = $('#index').DataTable( {
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
    </script>
  <!-- Close Datatable Index-->

  <!-- Datatable Index -->
    <script type="text/javascript">
      $(document).ready(function() {
        var t = $('#index1').DataTable( {
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
    </script>
  <!-- Close Datatable Index-->

  <!-- Datatable Index -->
    <script type="text/javascript">
      $(document).ready(function() {
        var t = $('#index2').DataTable( {
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
    </script>
  <!-- Close Datatable Index-->

  <!-- Datatable Index -->
    <script type="text/javascript">
      $(document).ready(function() {
        var t = $('#index3').DataTable( {
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
    </script>
  <!-- Close Datatable Index-->

  <!-- Datatable Index -->
    <script type="text/javascript">
      $(document).ready(function() {
        var t = $('#index4').DataTable( {
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
    </script>
  <!-- Close Datatable Index-->

  <!-- Datatable Index -->
    <script type="text/javascript">
      $(document).ready(function() {
        var t = $('#index5').DataTable( {
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
    </script>
  <!-- Close Datatable Index-->

  <!-- Datatable Index -->
    <script type="text/javascript">
      $(document).ready(function() {
        var t = $('#index6').DataTable( {
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
    </script>
  <!-- Close Datatable Index-->

  <!-- Datatable Index -->
    <script type="text/javascript">
      $(document).ready(function() {
        var t = $('#index7').DataTable( {
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
    </script>
  <!-- Close Datatable Index-->

  <!-- Datatable Index -->
    <script type="text/javascript">
      $(document).ready(function() {
        var t = $('#index8').DataTable( {
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
    </script>
  <!-- Close Datatable Index-->

  <!-- Datatable Index -->
    <script type="text/javascript">
      $(document).ready(function() {
        var t = $('#index9').DataTable( {
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
    </script>
  <!-- Close Datatable Index-->

  <!-- Datatable Index -->
    <script type="text/javascript">
      $(document).ready(function() {
        var t = $('#index10').DataTable( {
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
    </script>
  <!-- Close Datatable Index-->

  <!-- Datatable Index -->
    <script type="text/javascript">
      $(document).ready(function() {
        var t = $('#log_datatable').DataTable( {
          "columnDefs": [ {
              "searchable": false,
              "orderable": false,
              "targets": 0
          } ],
          "order": [[ 1, 'desc' ]],
          "pageLength": 100
        });
   
        t.on( 'order.dt search.dt', function () {
          t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
              cell.innerHTML = i+1;
          });
        }).draw();
      });
    </script>
  <!-- Close Datatable Index-->

  <!-- Menu -->
  <script type="text/javascript">
    /*$('.treeview').hover(function(){
      $(this).find('.treeview-menu:first').slideDown(400);
    },function(){
      $(this).find('.treeview-menu').slideUp(400);
    });*/

    $(".treeview").hover(function(){
      $.data(this, "timer", setTimeout($.proxy(function() {
        $(this).find('.treeview-menu:first').slideDown(400);
      }, this), 300));
    },
    function() {
      $(this).find('.treeview-menu').slideUp(400);
      clearTimeout($.data(this, "timer"));
    });
  </script> 
  <!-- Close Menu-->

  <!-- Sticky Note-->
  <script type="text/javascript">
    function remove(ele){
      $.ajax({
        url: "<?php echo base_url('auth/removeNote') ?>/",
        type: "POST",
        dataType: "JSON",
        data: {id: ele},
        success: function (response) {
        }
      });
    }

    zIndex = 10;

    $('.sticky-note-pre')
        .draggable({
            handle: '.handle'    
        })
        .resizable({
            resize: function(){
                var n = $(this);
                n.find('.contents').css({
                    width: n.width() - 40,
                    height: n.height() - 60
                });
            }
        })
        .bind('click hover focus mousedown', function(){
            $(this)
                .css('zIndex', zIndex++)
                .find('.ui-icon')
                    .css('zIndex', zIndex++)
                .end()
            ;
        })
        .find('.close')
            .click(function(){
                $(this).parents('.sticky-note').remove();
            })
        .end()
        .dblclick(function(){
            $(this).remove();
        })
        .addClass('sticky-note')
        .removeClass('sticky-note-pre')
    ;

    $('#new').click(function(){
        $('#notes')
            /*.append('\
                <div style="display: inline-block" class="sticky-note-pre ui-widget-content">\
                    <div class="handle"><div title="Pin It" style="padding: 2px; float: left; font-size: 21px; line-height: 1;" class="save_plz closee"><i style="font-weight: bolder" class="fa fa-paperclip"></i></div>&nbsp;<div title="Close It" class="close closee"><i class="fa fa-close"></i></div></div>\
                    <div contenteditable class="contents"></div>\
                </div>\
             ')*/
            .append('\
                <div style="display: inline-block" class="sticky-note-pre ui-widget-content">\
                    <div class="handle">&nbsp;<div title="Close Note" class="close closee"><i class="fa fa-close"></i></div></div>\
                    <div contenteditable class="contents"></div>\
                </div>\
             ')
            .find('.sticky-note-pre')
            .end()
        ;
        $('.contents')
            .focus()
        ;
        $('.sticky-note-pre')
            .draggable({
                handle: '.handle'    
            })
            .resizable({
                resize: function(){
                    var n = $(this);
                    n.find('.contents').css({
                        width: n.width() - 40,
                        height: n.height() - 60
                    });
                }
            })
            .bind('click hover focus mousedown', function(){
                $(this)
                    .css('zIndex', zIndex++)
                    .find('.ui-icon')
                        .css('zIndex', zIndex++)
                    .end()
                ;
            })
            .find('.save_plz')
                .click(function(){
                  var note = $('.sticky-note').find('.contents').html();
                  alert(note);

                  if(note == ''){
                    alert('Add Some Note First!');
                  }

                  else{
                    $.ajax({
                      url: "<?php echo base_url('auth/saveNote') ?>/",
                      type: "POST",
                      dataType: "JSON",
                      data: {note: note},
                      success: function (response) {
                        if(response == ''){
                          alert('Add Some Text in Note First!');
                        }
                      }
                    });
                  }
                }).end()
            .find('.close')
                .click(function(){
                    $(this).parents('.sticky-note').remove();
                })
            .end()
            .dblclick(function(){
                $(this).remove();
            })
            .addClass('sticky-note')
            .removeClass('sticky-note-pre')
        ;
    });

    $('#save').click(function(){
        $('.contents').blur();

        var notes = [], i, note;
        $('.sticky-note').each(function(){
            notes.push($(this).find('.contents').html());
        });

        if(notes.length == 0){
          alert('Add Some Note First!');
        }

        else{
          $.ajax({
            url: "<?php echo base_url('auth/saveNotes') ?>/",
            type: "POST",
            dataType: "JSON",
            data: {notes: notes},
            success: function (response) {
              if(response == ''){
                alert('Add Some Text in Note First!');
              }
            }
          });
        }
    });
  </script>
  <!-- Sticky Note-->
</body>
</html>