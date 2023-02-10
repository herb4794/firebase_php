<?php

use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;

session_start();
require_once 'dbcon.php';

$database = new Firebase();
if (isset($_SESSION['verified_user_id'])) {

  $uid = $_SESSION['verified_user_id'];
  $idTokenString = $_SESSION['idTokenString'];

  try {
    $verifiedIdToken = $database->auth->verifyIdToken($idTokenString);
  } catch (FailedToVerifyToken $e) {
    $_SESSION['expiry_status'] = 'The token is invalid: ' . $e->getMessage();
    header('Location: logout.php');
    exit();
  }

  $uid = $verifiedIdToken->claims()->get('sub');
  $user = $database->auth->getUser($uid);

}else{
  $_SESSION['status'] = "Login to access this page";
  header('Location: login.php');
  exit();

}
?>
