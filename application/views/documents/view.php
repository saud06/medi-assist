<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  $conn = mysqli_connect('localhost', 'root', '', 'winmark');
  $document_id = $this->uri->segment('3'); 
  $sql = "SELECT * FROM document WHERE document_id = $document_id";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $document_desc = $row['document_desc'];
?>

<title>View Document</title>

<link href="../../assets/plugins/froala/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
<link href="../../assets/plugins/froala/css/froala_style.min.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
<link href="../../assets/dist/css/AdminLTE.min.css" rel="stylesheet" type="text/css" />

<script src="../../assets/plugins/jQuery/jquery-3.1.1.js"></script> 
<script src="../../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../../assets/plugins/froala/js/froala_editor.pkgd.min.js"></script>

<?php 
  if(isset($_POST['document_id']) && !empty($_POST['document_id'])){
    $document_desc_upd = $_POST['document_desc'];
    $sql2 = "UPDATE document SET document_desc = '$document_desc_upd' WHERE document_id = $document_id";
    $result2 = mysqli_query($conn, $sql2);

    $sql3 = "SELECT * FROM document WHERE document_id = $document_id";
    $result3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);
    $document_desc = $row3['document_desc'];
  }
?>

<form action="" method="POST">  
  <textarea class="form-control" name="document_desc" id="document_desc">
    <div class="fr-view">
      <?php 
        echo $document_desc;
      ?>
    </div>
  </textarea>

  <br>

  <style type="text/css">
    .btn {
      display: inline-block;
      padding: 6px 12px;
      margin-bottom: 0;
      font-size: 14px;
      font-weight: 400;
      line-height: 1.42857143;
      text-align: center;
      white-space: nowrap;
      vertical-align: middle;
      -ms-touch-action: manipulation;
      touch-action: manipulation;
      cursor: pointer;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
      background-image: none;
      border: 1px solid transparent;
      border-radius: 4px;
    }
  </style>

  <input type="hidden" name="document_id" value="<?php echo $document_id; ?>">

  <p id="myElem" style="display: none;">Document Saved Successfully.</p>

  <button type="submit" id="submit" class="btn bg-gray pull-right"><i class="fa fa-hdd-o"></i> Save</button>
</form>

<br>

<script>
  $(function(){ 
    $('textarea').froalaEditor({
      height: '80vh'
    }) 
  });

  $("#submit").click(function (e) {
    alert('Document Saved Successfully.');
  });
</script>