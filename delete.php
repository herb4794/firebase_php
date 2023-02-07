<?php
require_once 'dbcon.php';

$database = new Firebase();

if (isset($_POST['delete_btn'])) {
  $id = "contact/".$_POST['delete_btn'];
  
  $result = $database->delete($id);

  if ($result) {
    $_SESSION['status'] = "delete data is complete";
    header('Location: index.php');
  }else{
    $_SESSION['status'] = "delete data Error";
    header('Location: index.php');
  }
}

?>
