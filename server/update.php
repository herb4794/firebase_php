<?php
session_start();
require_once '../dbcon.php';

$database = new Firebase();

if(isset($_POST['update_contact'])){
  $id = $_POST['id'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];

  $postData = [
    'fname' =>$first_name,
    'lname' => $last_name,
    'email' => $email,
    'phone' => $phone
  ];

  $result = $database->update("contact", $postData, $id);

  if ($result) {
    $_SESSION['status'] = "Contact Update Successuflly";
    header('Location: ../index.php');
  }else{
    $_SESSION['status'] = "Contact Not Updata";
    header('Location: ../index.php');
  }
}


?>
