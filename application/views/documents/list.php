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
          <li class="active"><!-- Document --> 
            Documents
          </li>
        </ol>
      </h5> 
    </section>
    <!-- Main content -->
    <section class="content" style="padding-top: 0">
      <div class="box-header with-border" style="padding-top: 0;">
        <h3 class="box-title"><!-- List Document -->
          Documents List
        </h3>
        <a title="Add New Document" id="addButton" class="btn bg-gray" style="margin: 10px"><i class="fa fa-plus" aria-hidden="true"></i></a>
      </div>

      <div id="reload" class="row">
        <style type="text/css">
          .fl-l{
            float:left
          }

          .fl-r{
            float:right
          }

          html, body{
            background-color:#F2F2F2;
          }

          .ul-wrapper{
            list-style:none;
          }

          .product{
            width:160px;
            margin-right:0px;
            background-color:#FFFFFF;
            position:relative;
            background: transparent;
          }

          .product:last-of-type{
            margin-right:0;
          }

          .container-prod{
            height:220px;
            width: 120px;
            overflow:hidden;
            position:relative;
            -moz-box-shadow: 0px 0px 0px 0px #F2F2F2;
            -webkit-box-shadow:  0px 0px 0px 0px #F2F2F2;
            box-shadow: 0px 0px 0px 0px #F2F2F2;
            -webkit-transition:all 0.3s ease;
            -moz-transition:all 0.3s ease;
            -o-transition:all 0.3s ease;
            transition:all 0.3s ease;
          }

          .container-prod:hover, .container-prod.information, .container-prod.social-sharing{
            -moz-box-shadow: 0px 0px 5px 0px #333;
            -webkit-box-shadow:  0px 0px 5px 0px #333;
            box-shadow: 0px 0px 5px 0px #333;
          }

          .image{
            /*height:130px;*/
            background-position:center;
            background-size:cover;
            background-repeat:no-repeat;
            -webkit-transition:all 1s ease;
            -moz-transition:all 1s ease;
            -o-transition:all 1s ease;
            transition:all 1s ease;
          }

          .container-information{
            height:67px;
            overflow:hidden;
            -webkit-transition:all 1s ease;
            -moz-transition:all 1s ease;
            -o-transition:all 1s ease;
            transition:all 1s ease;
            background-color:#031E16;
            color:#FFFFFF;
          }

          .buttons{
            position:relative;
            z-index:2;
          }

          .buttons a{
            padding-top: 2px;
            text-align:center;
            width:50%;
            height:25px;
            line-height:25px;
            background-color:#939393;
            color:#FFFFFF;
            text-decoration:none;
            position:relative;
            overflow:hidden;
          }

          .buttons a > span {
            position:relative;
            z-index:3;
            display:block;
            width:100%;
          }

          .buttons a > span:before{
            content:"";
            background-color:rgba(0,0,0,0);
            width:100%;
            height:40px;
            position:absolute;
            top:40px;
            left:0;
            z-index:1;
            -webkit-transition:all 0.3s ease;
            -moz-transition:all 0.3s ease;
            -o-transition:all 0.3s ease;
            transition:all 0.3s ease;
          }

          .buttons a:hover > span:before, .information .buttons a.fl-l > span:before{
            top:0;
            background-color:rgba(0,0,0,0.5);
          }

          .fname{
            border: none; 
            padding: 0; 
            width: 100%; 
            line-height: 20px; 
            color: #000;
            background-color: #c1c1c1; 
            padding-left: 5px; 
            padding-right: 5px; 
            text-align: center;
            cursor: default;
          }

          .fname:focus {
            outline: none !important;
          }

          .details {
            margin: 0; 
            padding: 0; 
            background: #D4C157; 
            font-size: 10px; 
            line-height: 15px;
          }

          .buttons a i{
            font-size:20px;
          }
        </style>

        <div class="col-md-12">
          <br>
          <ul class="ul-wrapper" style="background-color: transparent; padding-left: 20px; padding-right: 20px;">
            <?php 
              foreach ($data as $row) {
                $id = $row->document_id;
            ?>
                <li class="product fl-l">
                  <div class="container-prod">
                    <a onclick="event.preventDefault(); window.open(this.href, '_blank', 'width=1200, height=800');" title="View Document" href="<?php echo base_url('documents/view/') . $id; ?>">
                      <div class="image" style="background-image:url('assets/images/doc.png'); height: 130px;">
                      </div>
                    </a>
                      
                    <div class="container-information">
                      <div class="title">
                        <input onkeypress="if(event.keyCode == 13) insert('<?php echo $id ?>');" id="fname<?php echo $id; ?>" class="fname" type="text" value="<?php if($row->document_name){ echo $row->document_name; } else{ echo 'New Document'; } ?>" readonly><br>
                      </div>

                      <div class="title">
                        <p style="padding-top: 2px;" class="fname details"><?php echo 'Created By: ' . $row->created_by; ?></p>
                      </div>

                      <div class="title">
                        <p style="padding-bottom: 2px;" class="fname details"><?php echo 'Created On: ' . $row->datetime; ?></p>
                      </div>
                    </div>

                    <div class="buttons">
                      <a title="Rename" href="javascript:rename('<?php echo $id; ?>')" class="fl-l"><span><i class="fa fa-edit"></i></span></a>
                      <a title="Delete" href="javascript:delete_document('<?php echo $id;?>')" class="fl-l"><span><i class="fa fa-trash"></i></span></a>
                      <!-- <a title="Export" href="<?php echo base_url('documents/export/') . $id; ?>" class="fl-l"><span><i class="fa fa-external-link"></i></span></a> -->
                    </div>
                  </div>
                </li>
            <?php
              }
            ?>
          </ul>
        </div>
      </div>
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
      url: "<?php echo base_url('category/filter_category') ?>/",
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
          trHTML += '<td>' + item.category_code + '</td>';
          trHTML += '<td>' + item.category_name + '</td>';
          trHTML += '<td>' + item.category_desc + '</td>';
          var type = '<?php echo $this->session->userdata("type") ?>';
          if(type == 'admin'){
            trHTML += '<td>';
              trHTML += '<div class="dropdown"><button title="Action" type="button" class="btn btn-sm bg-gray gropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog" aria-hidden="true"></i> &nbsp;<span class="fa fa-angle-double-down"></span></button><ul class="dropdown-menu"><li><a href="<?php echo base_url('category/edit/'); ?>' + item.category_id + '"><i class="fa fa-edit"></i>Edit</a></li><li><a href="javascript:delete_id(' + item.category_id + ')"><i class="fa fa-trash-o"></i>Delete</a></li></ul></div>';
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
          trHTML += '<td>' + item.category_code + '</td>';
          trHTML += '<td>' + item.category_name + '</td>';
          trHTML += '<td>' + item.category_desc + '</td>';
          trHTML += '</tr>';
        });
        
        $('#precords').append(trHTML);
      }
    });
  });
</script>

<script type="text/javascript">
  function rename(ele) {
    $('#fname' + ele).removeAttr('readonly').css('cursor', 'text').select();
  }

  function insert(document_id){
    var document_name = $('#fname' + document_id).val();
    $.ajax({
      url: "<?php echo base_url('documents/editDocument') ?>/",
      type: "POST",
      dataType: "JSON",
      data : {
        document_id: document_id,
        document_name: document_name
      },
      success: function (response) {
        if(response.status){
          // window.location.reload(true);
          $("#reload").load(" #reload > *");
        }
      }
    });

    $('#fname' + document_id).css('cursor', 'default');
    $('#fname' + document_id).blur();
    $('#fname' + document_id).attr('readonly', true);
  }

  function delete_document(id){
    if(confirm('Sure To Remove This Document?')){
      $.ajax({
        url: "<?php echo base_url('documents/delete') ?>/",
        type: "POST",
        dataType: "JSON",
        data : {
          document_id: id
        },
        success: function (response) {
          if(response.status){
            // window.location.reload(true);
            $("#reload").load(" #reload > *");
          }
        }
      });
    }
  }

  var imgURL = 'assets/images/doc.png';
  $("#addButton").click(function (e) {
    $(".ul-wrapper").append('<li class="product fl-l"><div class="container-prod"><div class="image" style="background-image:url(' + imgURL + '); height:130px;"></div><div class="container-information"><div class="title"><input class="fname" type="text" value="New Document"></div></div><div class="buttons"><a title="Rename" href="javascript:void(0)" class="fl-l"><span><i class="fa fa-edit"></i></span></a><a title="Delete" href="javascript:void(0)" class="fl-l"><span><i class="fa fa-trash"></i></span></a><a title="View" href="javascript:void(0)" class="fl-l"><span><i class="fa fa-eye"></i></span></a><a title="Export" href="javascript:void(0)" class="fl-l"><span><i class="fa fa-external-link"></i></span></a></div></div></li>');

    $.ajax({
      url: "<?php echo base_url('documents/addDocument') ?>",
      type: "POST",
      dataType: "JSON",
      success: function (response) {
        if(response.status){
          // window.location.reload(true);
          // $("#reload").load("http://localhost/winmark/documents #reload" );
          $("#reload").load(" #reload > *");
        }
      }
    });
  });
</script>