<?php
include ('../Object/EmployeeOB.php');
include ('../databaseconn.php');
session_start();

$user = new Employee("", "", "", "", "", "", "","","","");
if ($_SESSION["user"] == null) {
    echo "<script> location.href='../login.php'; </script>";
}
$user = $_SESSION["user"];
$Username = $user->getUserID();
$Username = $user->getUserID();
$realName=$user->getName();
$address =$user->getAddress();
$phone =$user->getPhone();
$password =$user->getPassword();
$email = $user->getEmail();

//Check user if it was employee, if not, for logout and back to login.php
if ($user->getUserType() != "Employee") {
    session_destroy();
    session_unset();
    echo "<script> location.href='../login.php'; </script>";
}
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php include('../PageTitle.php') ?>
        <!-- plugins:css -->
        <link rel="stylesheet" href="../vendors/iconfonts/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
        <!-- endinject -->
        <!-- plugin css for this page -->
        <!-- End plugin css for this page -->
        <!-- inject:css -->
        <link rel="stylesheet" href="../css/style.css">
        <!-- endinject -->
        <link rel="shortcut icon" href="images/favicon.png" />
    </head>

    <body>
        <div class="container-scroller">
            <!-- partial:partials/_navbar.html -->
            <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo" href="index.php">Fiore Flowershop</a>
                </div>
                <div class="navbar-menu-wrapper d-flex align-items-stretch">
                    <div class="search-field d-none d-md-block">
                        <form class="d-flex align-items-center h-100" action="#">

                        </form>
                    </div>
                    <?php include('NavBar.php') ?>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                        <span class="mdi mdi-menu"></span>
                    </button>
                </div>
            </nav>
        </div>
        <!-- partial --
        <!-- Side Menu -->
        <?php include('SideMenu.php') ?>
        <!-- Side Menu -->
        <div class="main-panel">
            <div class="content-wrapper">
                <!-- WRITE YOUR CODE HERE! -->
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Update Profile</h4>
                            <form method="post" action="employeeUpdate.php">
                  <table class="table table-user-information">
                    <tbody>
                     <tr>
                        <td>User ID:</td>
                        <td><?php echo($Username) ?></td>
                      </tr>
                      <tr>
                        <td>Name</td>
                        <td><input name="name" type="text"  placeholder="<?php echo($realName) ?>"value=""></td>
                      </tr>
                      <tr>
                        <td>Email</td>
                        <td><input name="email" type="text" value="<?php echo($email) ?>"></td>
                      </tr>
                  
                      <tr>
                        <td>Password</td>
                        <td><input name="password" type="text" value="<?php echo($password) ?>"></td>
                      </tr>
                        <td>Phone Number</td>
                        <td><input name="phone" type="text" value="<?php echo($phone) ?>">
                        </td>
                         <tr>
                        <td>Home Address:</td>
                        <td><input name="address" type="text" value="<?php echo($address) ?>"></td>
                      </tr>
                           
                      
                     
                    </tbody>
                  </table>
                  
                      <button type="submit" class="btn btn-primary" name="submit" id="submit" >Submit</button>
                      
                      </form>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <?php include('../Footer.php') ?>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->

        <!-- container-scroller -->
        <!-- plugins:js -->
        <script src="../vendors/js/vendor.bundle.base.js"></script>
        <script src="../vendors/js/vendor.bundle.addons.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page-->
        <!-- End plugin js for this page-->
        <!-- inject:js -->
        <script src="../js/off-canvas.js"></script>
        <script src="../js/misc.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/i18n/defaults-*.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page-->
        <!-- End custom js for this page-->
    </body>

</html>
<?php


if (isset($_POST['submit'])) {
    $userID = $user->getUserID();
   
    $updateName = $_POST['name'];
    $updateEmail = $_POST['email'];
    $updatePassword = $_POST['password'];
    $updateAddress = $_POST['address'];
    $updatePhone = $_POST['phone'];
    //datedb = new mysqli($servername, $db_user, $db_password, $db_table); deprecated with PDO
    $conn_updatedb = Database::getInstance();
    $query_updatedb = "UPDATE users SET Name='$updateName',Address='$updateAddress',Phone='$updatePhone', password='$updatePassword' WHERE userID ='$userID'";   
    $update_result = $conn_updatedb->query($query_updatedb);
    if (!$update_result) {
        trigger_error('Invalid query: ' . $conn->error);
    }
    $conn_updatedb->close();
    $user->setAddress($updateAddress);
}

?>

