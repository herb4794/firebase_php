<?php
session_start();
require_once 'dbcon.php';
use Kreait\Firebase\Exception\Auth\FailedToVerifyToken;
$database = new Firebase();
if (isset($_POST['login_btn'])) {
  $email = $_POST['login_email'];
  $password = $_POST['login_pass'];

  try {
    $user = $database->auth->getUserByEmail("$email");

    try{
      $signInResult = $database->auth->signInWithEmailAndPassword($email, $password);
      $idTokenString = $signInResult->idToken();

      try{
        $verifiedIdToken = $database->auth->verifyIdToken($idTokenString);
        $uid = $verifiedIdToken->claims()->get('sub');
        $_SESSION['idTokenString'] = $idTokenString;
        $_SESSION['verified_user_id'] = $uid;
        
        $_SESSION['status'] = "Logged in successfilly";
        header("Location: home.php");
        exit();

      }catch(FailedToVerifyToken $e){
        echo "The token is InvalidToken: " . $e->getMessage();
      }catch(\InvalidArgumentException $e){
        echo "The Token could not be parsed: " .$e->getMessage();
      }
    }catch(Exception $e){
      $_SESSION['status'] = "Wrong Password";
      header("Location: login.php");
      exit();
    }
  }catch(\Kreait\Firebase\Exception\Auth\UserNotFound $e){
    $_SESSION['status'] = "Invalid Email Address";
    header("Location: login.php");
    exit();
  }
}
else{
  $_SESSION['status'] = "Not allowed";
  header('Location: login.php');
  exit();

}


?>
