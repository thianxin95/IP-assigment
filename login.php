<?php
include('databaseconn.php');
include('Object/CustomerOb.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <?php include('PageTitle.php') ?>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left p-5">
              <h4><?php echo($title) ?></h4>
              <h6 class="font-weight-light">Sign in to continue.</h6>
              <form class="pt-3" method="post" action="login.php">
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg" id="Username" name="Username" placeholder="Username" required="required">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="Password" name="Password" placeholder="Password" required="required">
                </div>
                <div class="mt-3">
                 <!-- <a class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn" href="index.html">SIGN IN</a> -->
                 <button type="submit" name="submit" id="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">Log In</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
       <div class="modal fade" id="wrongdetails" tabindex="-1" role="dialog" aria-labelledby="label_wrongdetails" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="label_wrongdetails">Wrong Credentials</h5>
                       <!--   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button> -->
                        </div>
                        <div class="modal-body">
                          <p>Wrong login ID or Password.</p>
                          <p>Sign In to continue</p>
                        </div>
                        <div class="modal-footer">
                            <a href="login.php" class="btn btn-success">OK</a>
                        </div>
                      </div>
                    </div>
                  </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->

  
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/js/vendor.bundle.addons.js"></script>
    <?php 
if(isset($_POST['submit'])){
    $userid = $_POST['Username'];
    $userpassword = $_POST['Password'];
    $sql = "SELECT * FROM users WHERE userID = '$userid' AND password = '$userpassword'";
    //$conn = new mysqli($servername, $db_user, $db_password, $db_table); apply for PDO singleton
    $conn = Database::getInstance();
    $login_result = $conn->query($sql);
    if(!$login_result){
        trigger_error('Invalid query: ' . $conn->error);
    }
    if($login_result){
        while($row= $login_result->fetch(PDO::FETCH_ASSOC)){
            session_start();    
            //if the database returns a correct user result only set session and give login
            //$Username = $_POST["Username"];
            $customerob = new Customer($row["userID"], $row["userType"], $row["Name"], $row["Email"], $row["creditLimit"], $row["usedCredit"], $row["overDue"]);
            $_SESSION["user"] = $customerob;
            if($customerob->userType == "Customer"){
                echo "<script> location.href='index.php'; </script>";
                $conn->close();
                exit;
            }if($customerob->userType == "Employee"){
                echo "<script> location.href='Employee/index.php'; </script>";
                $conn->close();
                exit;
            }
        }
        
    }else{
        echo"<script>$('#wrongdetails').modal();</script>";
        $conn->close();
    }
}
?>
  <!-- endinject -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/misc.js"></script>
  <!-- endinject -->
</body>

</html>
