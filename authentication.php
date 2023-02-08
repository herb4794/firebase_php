<?php
require_once 'dbcon.php';
$database = new Firebase();
if (isset($_POST['register_btn'])) {
  $user_name = $_POST['register_user'];
  $password = $_POST['register_pass'];
  $email = $_POST['register_email'];
  $phone = $_POST['register_phone'];

  $userProperties = [
  'email' => $email,
  'emailVerified' => false,  
  'phoneNumber' => "+852".$phone,
  'password' => $password,
  'displayName' => $user_name,
];

  $result = $database->authentication($userProperties);
  if ($result) {
    $_SESSION['status'] = "User Created Successuflly";
    header('Location: index.php');
  }else{
    $_SESSION['status'] = "User Created False";
    header('Location: register.php');
  }
}

?>
