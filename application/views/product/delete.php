<?php
    /*session_start();
    include_once('db_config.php');*/
    if (count($_POST["selected_id"]) > 0 )
     {
      $all = implode(",", $_POST["selected_id"]);
$sql = "DELETE FROM products WHERE 1 AND product_id IN($all)";
        if($this->db->query($sql,array($all))){
      return TRUE;
    }
    else{
      return FALSE;
    }
  }


      /*$query="DELETE FROM products WHERE 1 AND id IN($all)";
      if(mysqli_query($conn,$query)){
          $_SESSION['success'] = 'Products have been deleted successfully.';
      }
    }else{
        $_SESSION['error'] = 'Select checkbox to delete product.';
    }*/
    //header("Location:list");

    
?>