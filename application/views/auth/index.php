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
        window.location.href='<?php  echo base_url('auth/delete/'); ?>'+id;
     }
  }
</script>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h5>
         <ol class="breadcrumb">
          <li><a href="<?php echo base_url('auth/dashboard'); ?>" class="text-black"><i class="fa fa-dashboard">&nbsp;</i><strong><?php echo $this->lang->line('header_dashboard'); ?></strong></a></li>
          <li class="active">
            <!-- Users -->
            <?php echo $this->lang->line('user_lable');?>
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
                <!-- List Users -->
                User List
              </h3>
              <!-- <a class="btn bg-gray" style="margin: 10px" href="<?php echo base_url('auth/create_user');?>">
                Add New User
                <?php echo $this->lang->line('user_btn_new'); ?>
              </a> -->
            </div>
            <!-- /.box-header -->
            <div class="box-body outer-scroll">
              <div class="inner-scroll">
                <div class="row">
                  <div class="col-sm-12">
                    <strong>User List Filter:</strong> &emsp;

                    <select class="form-control select2" name="filt_category_id" id="filt_category_id" style="width: 15%;">
                      <option value="" selected>All Categories</option>
                      <option value="n_a">N/A</option>

                      <?php 
                        foreach ($all_categories as $category) {
                      ?>
                          <option value="<?php echo $category->category_id ?>"><?php echo $category->category_name ?></option>
                      <?php
                        }
                      ?>
                    </select> &emsp;

                    <select class="form-control select2" name="status" id="status" style="width: 15%;">
                      <option value="">All Status</option>
                      <option value="1" selected>Active</option>
                      <option value="0">Inactive</option>
                    </select> &emsp;

                    <button title="Filter User List" type="button" id="btn_ajax" class="btn bg-gray"><i class="fa fa-search"></i></button>&emsp;

                    <div class="btn-group">
                      <button title="Print User List" type="button" class="btn bg-gray gropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-print" aria-hidden="true"></i>&nbsp;
                        <span class="fa fa-angle-double-down"></span>
                      </button>
                      <ul class="dropdown-menu">
                        <li>
                          <a href="#" target="_blank" onclick="printContent('print')">Print (Default)</a>
                        </li>
                        <li id="pdf">
                          <a href="<?php echo base_url('auth/list_pdf');?>" target="_blank">PDF (On Letter Head)</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <br>

                <table id="index" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>
                          <?php echo $this->lang->line('product_no'); ?>.
                      </th>
                      <th><!-- Employee ID -->
                          Employee ID
                      </th>
                      <th><!-- First Name -->
                          <?php echo $this->lang->line('user_lable_fname'); ?>
                      </th>
                      <th><!-- Last Name -->
                          <?php echo $this->lang->line('user_lable_lname'); ?>
                      </th>
                      <th><!-- Email -->
                          <?php echo $this->lang->line('user_lable_email'); ?>
                      </th>
                      <th><!-- Type -->
                          Type
                      </th>
                      <th><!-- Category -->
                          Category
                      </th>
                      <th><!-- Action -->
                          <?php echo $this->lang->line('user_lable_action'); ?>
                      </th>
                    </tr>
                  </thead>
                  <tbody id="records">
                    <?php foreach ($users as $key => $user):?>
                    <tr>
                      <td></td>
                      <td><?php echo $user->emp_id;?></td>
                      <td><?php echo $user->first_name;?></td>
                      <td><?php echo $user->last_name;?></td>
                      <td><?php echo $user->username;?></td>
                      <td>
                        <?php foreach ($user->groups as $key2 => $group):
                                echo $key2+1 . '. ' . $group->description . '<br>';
                              endforeach
                          ?>
                      </td>
                      <td>
                        <!-- <?php 
                          foreach ($users[$key]->categories as $category): 
                            if($category->category_id == $user->category_id){
                              echo $category->category_name;
                            }
                          endforeach;
                          
                          if(!$user->category_id){
                            echo 'N/A';
                          }
                        ?> -->

                        <?php 
                          $this->db->where('id', $user->id);
                          $cat_id = $this->db->get('users')->result_array();
                          $var = $cat_id[0]['category_id'];
                          $cat_idd = explode(",", $var);

                          $cat_data = array();
                          foreach ($cat_idd as $key => $value) {
                            $this->db->where('category_id', $value);
                            $categories = $this->db->get('category')->result_array();
                            
                            if(empty($categories)){ 
                              array_push($cat_data, 'N/A');
                            }
                            else{ 
                              array_push($cat_data, $categories[0]['category_name']);
                            }
                          }

                          foreach ($cat_data as $key => $value) {
                            if($value == 'N/A'){ 
                              echo $value;
                            }
                            else{
                              echo ($key+1) . '. ' . $value . '<br>';
                            }
                          }
                        ?>
                      </td>
                      <td>
                        <div class="dropdown">
                          <button title="Action" type="button" class="btn btn-sm bg-gray gropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-cog"></i>&nbsp;
                            <span class="fa fa-angle-double-down"></span>
                          </button>
                          <ul class="dropdown-menu">
                            <li>
                              <a href="<?php echo base_url('auth/edit_user/'); ?><?php echo $user->id; ?>"><i class="fa fa-edit"></i>Edit</a>
                            </li>
                            <?php if($user->id != 1){ ?>
                              <li>
                                <a href="javascript:delete_id(<?php echo $user->id;?>)"><i class="fa fa-trash-o"></i>Delete</a>
                              </li>
                            <?php } ?>
                          </ul>
                        </div>
                      </td>
                    </tr>
                  <?php endforeach;?>
                  <tfoot>
                    <tr>
                      <th>
                          <?php echo $this->lang->line('product_no'); ?>.
                      </th>
                      <th><!-- Employee ID -->
                          Employee ID
                      </th>
                      <th><!-- First Name -->
                          <?php echo $this->lang->line('user_lable_fname'); ?>
                      </th>
                      <th><!-- Last Name -->
                          <?php echo $this->lang->line('user_lable_lname'); ?>
                      </th>
                      <th><!-- Email -->
                          <?php echo $this->lang->line('user_lable_email'); ?>
                      </th>
                      <th><!-- Type -->
                          Type
                      </th>
                      <th><!-- Category -->
                          Category
                      </th>
                      <th><!-- Action -->
                          <?php echo $this->lang->line('user_lable_action'); ?>
                      </th>
                    </tr>
                  </tfoot>
                </table>

                <div style="display: none;" id="print">
                  <div id="header" class="box-header with-border" style="text-align: center; display: none">
                    <!-- <img width="300" height="100" src="<?php echo base_url().'assets/images/winmarkFinal.png'; ?>"><br>
                    <hr> -->

                    <h3 class="box-title">
                      User List
                    </h3>
                    <br><br>

                    <table id="pindex" class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th>
                              <?php echo $this->lang->line('product_no'); ?>.
                          </th>
                          <th><!-- Employee ID -->
                              Employee ID
                          </th>
                          <th><!-- First Name -->
                              <?php echo $this->lang->line('user_lable_fname'); ?>
                          </th>
                          <th><!-- Last Name -->
                              <?php echo $this->lang->line('user_lable_lname'); ?>
                          </th>
                          <th><!-- Email -->
                              <?php echo $this->lang->line('user_lable_email'); ?>
                          </th>
                          <th><!-- Type -->
                              Type
                          </th>
                          <th><!-- Category -->
                              Category
                          </th>
                        </tr>
                      </thead>
                      <tbody id="precords">
                        <?php foreach ($users as $key => $user):?>
                          <tr>
                            <td><?php echo ++$key;?></td>
                            <td><?php echo $user->emp_id;?></td>
                            <td><?php echo $user->first_name;?></td>
                            <td><?php echo $user->last_name;?></td>
                            <td><?php echo $user->username;?></td>
                            <td>
                              <?php foreach ($user->groups as $key2 => $group):
                                      echo $key2+1 . '. ' . $group->description . '<br>';
                                    endforeach
                                ?>
                            </td>
                            <td>
                              <!-- <?php 
                                foreach ($users[$key]->categories as $category): 
                                  if($category->category_id == $user->category_id){
                                    echo $category->category_name;
                                  }
                                endforeach;
                                
                                if(!$user->category_id){
                                  echo 'N/A';
                                }
                              ?> -->

                              <?php 
                                $this->db->where('id', $user->id);
                                $cat_id = $this->db->get('users')->result_array();
                                $var = $cat_id[0]['category_id'];
                                $cat_idd = explode(",", $var);

                                $cat_data = array();
                                foreach ($cat_idd as $key2 => $value) {
                                  $this->db->where('category_id', $value);
                                  $categories = $this->db->get('category')->result_array();
                                  
                                  if(empty($categories)){ 
                                    array_push($cat_data, 'N/A');
                                  }
                                  else{ 
                                    array_push($cat_data, $categories[0]['category_name']);
                                  }
                                }

                                foreach ($cat_data as $key3 => $value) {
                                  if($value == 'N/A'){ 
                                    echo $value;
                                  }
                                  else{
                                    echo ($key3+1) . '. ' . $value . '<br>';
                                  }
                                }
                              ?>
                            </td>
                          </tr>
                        <?php endforeach;?>
                      <tfoot>
                        <tr>
                          <th>
                              <?php echo $this->lang->line('product_no'); ?>.
                          </th>
                          <th><!-- Employee ID -->
                              Employee ID
                          </th>
                          <th><!-- First Name -->
                              <?php echo $this->lang->line('user_lable_fname'); ?>
                          </th>
                          <th><!-- Last Name -->
                              <?php echo $this->lang->line('user_lable_lname'); ?>
                          </th>
                          <th><!-- Email -->
                              <?php echo $this->lang->line('user_lable_email'); ?>
                          </th>
                          <th><!-- Type -->
                              Type
                          </th>
                          <th><!-- Category -->
                              Category
                          </th>
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
    var filt_category_id = $('#filt_category_id').val();
    if(!filt_category_id) filt_category_id = 0;
    else if(filt_category_id == 'n_a'){
      filt_category_id = -1;
    }

    var status = $('#status').val();
    if(!status) status = 2;

    $.ajax({
      url: "<?php echo base_url('auth/filter_user') ?>/",
      type: "POST",
      dataType: "JSON",
      data : {
        filt_category_id: filt_category_id,
        status: status
      },
      success: function (response) {
        var table = $('#index').DataTable();
        table.destroy();
        $('#records').empty();

        var trHTML = '';
        $.each(response.users, function (i, item) {
          //console.log(i);
          trHTML += '<tr>';
          trHTML += '<td>'+(i+1)+'</td>';
          trHTML += '<td>' + item.emp_id + '</td>';
          trHTML += '<td>' + item.first_name + '</td>';
          trHTML += '<td>' + item.last_name + '</td>';
          trHTML += '<td>' + item.username + '</td>';
          trHTML += '<td>';
            var groups = item.groups;
            for(j=0; j<groups.length; j++){
              trHTML += (j+1) + '. ' + groups[j].description + '<br>';
            }
          trHTML += '</td>';
          trHTML += '<td>';
            var categories = item.categories;
            if(categories == ''){
              trHTML += 'N/A';
            }
            else{
              for(i=0; i<categories.length; i++){
                trHTML += (i+1) + '. ' + categories[i].category_name + '<br>';
              }
            }
          trHTML += '</td>';
          trHTML += '<td>';
            trHTML += '<div class="dropdown"><button title="Action" type="button" class="btn btn-sm bg-gray gropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> &nbsp;<span class="fa fa-angle-double-down"></span></button><ul class="dropdown-menu"><li><a href="<?php echo base_url('auth/edit_user/'); ?>' + item.id + '"><i class="fa fa-edit"></i>Edit</a></li><li><a href="javascript:delete_id(' + item.id + ')"><i class="fa fa-trash-o"></i>Delete</a></li></ul></div>';
          trHTML += '</td>';
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
        $.each(response.users, function (i, item) {
          //console.log(i);
          trHTML += '<tr>';
          trHTML += '<td>'+(i+1)+'</td>';
          trHTML += '<td>' + item.emp_id + '</td>';
          trHTML += '<td>' + item.first_name + '</td>';
          trHTML += '<td>' + item.last_name + '</td>';
          trHTML += '<td>' + item.username + '</td>';
          trHTML += '<td>';
            var groups = item.groups;
            for(j=0; j<groups.length; j++){
              trHTML += (j+1) + '. ' + groups[j].description + '<br>';
            }
          trHTML += '</td>';
          trHTML += '<td>';
            var categories = item.categories;
            if(categories == ''){
              trHTML += 'N/A';
            }
            else{
              for(i=0; i<categories.length; i++){
                trHTML += (i+1) + '. ' + categories[i].category_name + '<br>';
              }
            }
          trHTML += '</td>';
          trHTML += '</tr>';
        });
        
        $('#precords').append(trHTML);
      }
    });

    $("#pdf").html('<a href="<?php echo base_url('auth/filterUserPDF/');?>' + filt_category_id + '/' + status + '" target="_blank">PDF (On Letter Heads)</a>');
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