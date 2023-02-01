<?php
include_once './includes/header.php';
require_once 'dbcon.php';
$database = new Firebase();
?>

  <div class="container">
   <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header">
         <h4>
            Edit & Update Contacts
            <a href="index.php" class="btn btn-danger float-end">BACK</a>
         </h4> 
        </div>
        <div class="card-body">
          <?php

            if(isset($_GET['id'])){
              $key_child = $_GET['id'];
              $getData = $database->childData('contact', $key_child); 

              if($getData > 0){
                ?>
                
        <form action="update.php" method="POST">

          <input type="hidden" name="id" value="<?=$key_child?>"></input>
            <div class="form-group mb-3">
              <label for="">First Name</label>
              <input type="text" name="first_name" value="<?=$getData['fname']?>" class="form-control">
            </div>

            <div class="form-group mb-3">
              <label for="">Last name</label>
              <input type="text" name="last_name" value="<?=$getData['lname']?>" class="form-control">
            </div>

            <div class="form-group mb-3">
              <label for="">Email Address</label>
              <input type="text" name="email" value="<?=$getData['email']?>" class="form-control">
            </div>

            <div class="form-group mb-3">
              <label for="">Phone Number</label>
              <input type="text" name="phone" value="<?=$getData['phone']?>" class="form-control">
            </div>
            
            <div class="form-group mb-3">
              <button type="submit" name="update_contact" class="btn btn-primary">Update Contact</button>
              </div>
          </form>
         <?php
              }else{
                
                $_SESSION['status'] = "Invalid Id";
                header('Location: ../index.php');
                exit();
              }
            }else{
              $_SESSION['status'] = "No Found";
              header('Location: ../index.php');
              exit();
            }
          ?>

        </div>
     </div>
    </div>
   </div> 
  </div>
<?php
include_once './includes/footer.php';
?>

