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
              <h6 class="font-weight-light">New Here?</h6>
             <div class="row">
            
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Signing up is easy. It only takes a few steps</h4>
                  <form class="forms-sample" method="post" action="registration.php">
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" class="form-control" id="username" placeholder="Username" name="userid">
                    </div>
                     <div class="form-group">
                          <label>Membership</label>
                          
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="membershipRadios" id="customer" value="customer" >
                                Customer
                              </label>
                            </div>
                  <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="membershipRadios" id="corcustomer" value="corporate">
                                Corporate Customer
                              </label>
                            </div>
                        </div>
                      <div class="form-group">
                      <label for="exampleInputUsername1">Name</label>
                      <input type="text" class="form-control" id="name" placeholder="Username" name="name">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                       <input type="hidden" name="creditLimit" value="500">
                      <input type="hidden" name="usedCrdit" value="0">
                      <input type="hidden" name="overDue" value="0">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" class="form-control" id="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputConfirmPassword1">Confirm Password</label>
                      <input type="password" class="form-control" id="exampleInputConfirmPassword1" placeholder="Password" name="password">
                    </div>
                    <div class="form-check form-check-flat form-check-primary">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input">
                        Remember me
                      </label>
                    </div>
                    <button type="submit" class="btn btn-gradient-primary mr-2" name="submit" id="submit">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            
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
if(isset($_POST["submit"])){
  $sql="INSERT INTO users (userID, userType, Name, Email, creditLimit, usedCredit, overDue, password)VALUES ('".$_POST["userid"]."','".$_POST["membershipRadios"]."','".$_POST["name"]."','".$_POST["email"]."','".$_POST["creditLimit"]."','".$_POST["usedCrdit"]."','".$_POST["overDue"]."','".$_POST["password"]."')";
 
$conn = Database::getInstance();

$login_result = $conn->query($sql);
if(!$login_result){
        trigger_error('Invalid query: ' . $conn->error);
    }
$conn->close();
}
?>
  
  <script src="js/off-canvas.js"></script>
  <script src="js/misc.js"></script>
  <!-- endinject -->
</body>
  </html>
