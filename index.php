<?php
session_start();
include_once './includes/header.php';
include_once 'dbcon.php';
$database = new Firebase();

?>
  <div class="container">
   <div class="row">
  <div class="col-md-6 mb-3">
    <div class="card">
      <div class="card-body">
        <h4>Total No of Record:
          <?php 
            $count = $database->countData("contact")->getSnapshot()->numChildren();
            echo $count;
          ?>
        </h4> 

      </div> 
    </div> 
  </div>
    <div class="col-md-12">
     <?php
        if (isset($_SESSION['status'])) {
          echo "<h5 class='alert alert-success'>" . $_SESSION['status'] . "</h5>";
          unset($_SESSION['status']);
        }
      ?>
      <div class="card">
        <div class="card-header">
         <h4>
            PHP Firebase CRUD - Realtime Database
            <a href="add-contact.php" class="btn btn-primary float-end">Add Contacts</a>
         </h4> 
        </div>
        <div class="card-body">

        <table class="table table-bordered table-striped">
          <thead>
            <tr>
              <th>Sl.no</th>
              <th>First Name</th>
              <th>Last Name</th>
              <th>Email Id</th>
              <th>Phone No</th>
              <th>Edit</th>
              <th>Delete</th>
            </tr> 
          </thead>
          <tbody>
            <?php
            $fetchdata = $database->getData('contact'); 

              if($fetchdata > 0){
                $i = 1;
               foreach ($fetchdata as $key => $row) {
                ?>
                  <tr>
                  <td><?=$i++?></td>
                  <td><?=$row['fname']?></td>
                  <td><?=$row['lname']?></td>
                  <td><?=$row['email']?></td>
                  <td><?=$row['phone']?></td>
                  <td>
                  <a href="edit-contact.php?id=<?=$key?>" class="btn btn-primary btn-sm">Edit</a>
                  </td>
                  <td>
                    <form action="delete.php" method="POST">
                      <button type="submit" name="delete_btn" value="<?=$key?>" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                  </td>
                  </tr>
                <?php 
               }
              }else {
                ?>
               <tr>
                    <td colspan="7">No Record Found</td>
                  </tr>
                <?php
              }
            ?>
         </tbody>
        </table>

      </div>
     </div
    </div>
   </div> 
  </div>

<?php
include_once './includes/footer.php';
?>
