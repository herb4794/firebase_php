<?php
session_start();
require_once('dbcon.php');

if (isset($_POST['save-contact'])) {
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $postData = [
    'fname' => $first_name,
    'lname' => $last_name,
    'email' => $email,
    'phone' => $phone
  ];
  $database = new Firebase();
  $database->insertData("contact", $postData);
  
}

?>
