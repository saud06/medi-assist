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
        window.location.href='<?php  echo base_url('category/delete/'); ?>'+id;
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
          <li class="active"><!-- Category --> 
            <?php echo $this->lang->line('header_category'); ?>
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
              <h3 class="box-title"><!-- List Category -->
                Category List
              </h3>
              <a title="Add New Category" class="btn bg-gray" style="margin: 10px" href="<?php echo base_url('category/add');?>"><i class="fa fa-plus" aria-hidden="true"></i></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body outer-scroll">
              <div class="inner-scroll">
                <div class="row">
                  <div class="col-sm-12">
                    <strong>Category List Filter:</strong> &emsp;

                    <select class="form-control select2" name="status" id="status" style="width: 20%;">
                      <option value="">All Status</option>
                      <option value="active" selected>Active</option>
                      <option value="inactive">Inactive</option>
                    </select> &emsp;

                    <button title="Filter Category List" type="button" id="btn_ajax" class="btn bg-gray"><i class="fa fa-search" aria-hidden="true"></i></button>
                  </div>
                </div>
                <br>

                <table id="example" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th><?php echo $this->lang->line('category_lable_no'); ?>.</th>
                    <th><?php echo $this->lang->line('category_lable_code'); ?></th>
                    <th><?php echo $this->lang->line('category_lable_cname'); ?></th>
                    <th>Description</th>
                    <?php if($this->session->userdata('type') == 'admin'){ ?>
                      <th><?php echo $this->lang->line('category_lable_actions'); ?></th>
                    <?php }?>
                  </tr>
                  </thead>

                  <tfoot>
                  <tr>
                    <th><?php echo $this->lang->line('category_lable_no'); ?>.</th>
                    <th><?php echo $this->lang->line('category_lable_code'); ?></th>
                    <th><?php echo $this->lang->line('category_lable_cname'); ?></th>
                    <th>Description</th>
                    <?php if($this->session->userdata('type') == 'admin'){ ?>
                      <th><?php echo $this->lang->line('category_lable_actions'); ?></th>
                    <?php }?>
                  </tr>
                  </tfoot>
                </table>
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

<script type="text/javascript">
  $(document).ready(function() {
    $('#example thead tr').clone(true).appendTo( '#example thead' );
    
    $('#example thead tr:eq(1) th').each( function (i) {
        var title = $(this).text();

        if (i == 0 || i == 4) {
          $(this).html( '' );
        }
        else{
          $(this).html( '<input class="form-control" type="text" placeholder="Search by '+title+'" />' );
        }
 
        $( 'input', this ).on( 'keyup change', function () {
            if ( table.column(i).search() !== this.value ) {
                table
                    .column(i)
                    .search( this.value )
                    .draw();
            }
        } );
    } );

    var status = null;
    $('#btn_ajax').click(function(){
      status = $('#status').val();
      if(!status) status = 0;

      var table = $('#example').DataTable();
      table.destroy();
      table.clear().draw();

      $('#example').DataTable( {
        orderCellsTop: true,
        fixedHeader: true,
        columnDefs: [ {
            searchable: false,
            orderable: false,
            targets: [0, -1]
        } ],
        serverSide: true,
        processing: true,
        language: {          
            processing: "<i class='fa fa-refresh fa-spin'></i>&emsp;Loading Data..."
        },
        ajax:{
            url : "category/list_filtered_view/"+status,
            dataType : "json",
            type: "post"
        },
        deferRender: true,
        order: [[ 1, 'asc' ]],
        dom: 'Bfrtip',
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10', '25', '50', 'All' ]
        ],
        buttons: [
            {
              extend: 'pageLength',
              text: '<i class="fa fa-bars"></i>',
              titleAttr: 'Pagination'
            },
            {
              extend: 'colvis',
              text: '<i class="fa fa-clone"></i>',
              titleAttr: 'Columns'
            },
            {
                extend: 'collection',
                text: '<i class="fa fa-file-text-o"></i>',
                titleAttr: 'Export',
                buttons: [
                    {
                        extend: 'copy',
                        title: 'Category List',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        title: 'Category List',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Category List',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                    {
                        extend: 'print',
                        title: '<h2 style="text-align: center;"><img src="assets/images/winmarkfinal.png" alt="Wimark"><br><br><u>Category List</u></h2><br>',
                        exportOptions: {
                            columns: ':visible'
                        }
                    },
                ]
            }
        ],
        stateSave: true
      });
    }); 
 
    var table = $('#example').DataTable( {
      orderCellsTop: true,
      fixedHeader: true,
      columnDefs: [ {
          searchable: false,
          orderable: false,
          targets: [0, -1]
      } ],
      serverSide: true,
      processing: true,
      language: {          
          processing: "<i class='fa fa-refresh fa-spin'></i>&emsp;Loading Data..."
      },
      ajax:{
          url : "category/list_view",
          dataType : "json",
          type: "post"
      },
      deferRender: true,
      order: [[ 1, 'asc' ]],
      dom: 'Bfrtip',
      lengthMenu: [
          [ 10, 25, 50, -1 ],
          [ '10', '25', '50', 'All' ]
      ],
      buttons: [
          {
            extend: 'pageLength',
            text: '<i class="fa fa-bars"></i>',
            titleAttr: 'Pagination'
          },
          {
            extend: 'colvis',
            text: '<i class="fa fa-clone"></i>',
            titleAttr: 'Columns'
          },
          {
              extend: 'collection',
              text: '<i class="fa fa-file-text-o"></i>',
              titleAttr: 'Export',
              buttons: [
                  {
                      extend: 'copy',
                      title: 'Category List',
                      exportOptions: {
                          columns: ':visible'
                      }
                  },
                  {
                      extend: 'excelHtml5',
                      title: 'Category List',
                      exportOptions: {
                          columns: ':visible'
                      }
                  },
                  {
                      extend: 'pdfHtml5',
                      title: 'Category List',
                      exportOptions: {
                          columns: ':visible'
                      }
                  },
                  {
                      extend: 'print',
                      title: '<h2 style="text-align: center;"><img src="assets/images/winmarkfinal.png" alt="Wimark"><br><br><u>Category List</u></h2><br>',
                      exportOptions: {
                          columns: ':visible'
                      }
                  },
              ]
          }
      ],
      stateSave: true
    });
  });
</script>