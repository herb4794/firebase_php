<?php
session_start();
require_once 'dbcon.php';
include './includes/header.php';
$database = new Firebase();
?>



<div class="container">
  <div class="row">
    <div class="col-md-12">
      <?php
        if(isset($_SESSION['status'])){
          echo "<h5 class='alert alert-success'>".$_SESSION['status']."</h5>";
          unset($_SESSION['status']);
        }

        if(isset($_SESSION['expiry_status'])){
          echo "<h5 class='alert alert-success'>" . $_SESSION['expiry_status']. "</h5>";
          unset($_SESSION['expiry_status']);
        }

      ?>
      <h2>Home Page</h2>
    </div>
  </div>
</div>







<?php
include './includes/footer.php';
?>
