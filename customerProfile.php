<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 
 *
 * @author Chang kwok Fei
 */
include ('Object/CustomerOb.php');
include('Object/InvoiceOB.php');
include('databaseconn.php');

session_start();



if ($_SESSION["user"] == null) {
    echo "<script> location.href='login.php'; </script>";
}
$user = $_SESSION["user"];
$Username = $user->getUserID();
$realName=$user->getName();
$address =$user->getAddress();
$phone =$user->getPhone();
$password =$user->getPassword();
$email = $user->getEmail();
$userType=$user->getUserType();
$used = $user->getUsedCredit();
$over= $user->getOverDue();
$creditLeft = $user->getCreditLimit();

if($userType == "Customer"){
?> 
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php include('PageTitle.php') ?>
        <!-- plugins:css -->
        <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
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
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- Side Menu -->
      <?php include('SideMenu.php') ?>
      <!-- Side Menu -->
      <div class="main-panel">
        <div class="content-wrapper">
            <!-- WRITE YOUR CODE HERE! -->
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class=" col-md-9 col-lg-9 "> 
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>User ID:</td>
                        <td><?php echo($Username) ?></td>
                      </tr>
                      <tr>
                        <td>Name:</td>
                        <td><?php echo($realName) ?></td>
                      </tr>
                      <tr>
                        <td>Email:</td>
                        <td><?php echo($email) ?></td>
                      </tr>
                   
                         <tr>
                            
                      <tr>
                        <td>Password:</td>
                        <td>********* </td>
                      </tr>
                        <td>Phone Number:</td>
                        <td><?php echo($phone) ?>
                        </td>
                         <tr>
                        <td>Home Address:</td>
                        <td><?php echo($address)?></td>
                      </tr>
                           
                      </tr>
                     
                    </tbody>
                  </table>
                  
                            <a href="updateInfo.php" class="btn btn-primary" >Edit Profile</a>
               
                </div>
              </div>
                </div>
            </div>
            </div>
          <?php include('Footer.php') ?>
                    </div>
               </div>
     
           </div>
    

        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
       
        <!-- partial -->
      
      <!-- main-panel ends -->
    
    <!-- page-body-wrapper ends -->
  
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/misc.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/i18n/defaults-*.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>

</html>



<?php 
}
elseif ($userType=="Corporate") {
    ?>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php include('PageTitle.php') ?>
        <!-- plugins:css -->
        <link rel="stylesheet" href="vendors/iconfonts/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">
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
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- Side Menu -->
      <?php include('SideMenu.php') ?>
      <!-- Side Menu -->
      <div class="main-panel">
        <div class="content-wrapper">
            <!-- WRITE YOUR CODE HERE! -->
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <div class=" col-md-9 col-lg-9 "> 
                            <form method="post" action="getInvoice.php">
                  <table class="table table-user-information">
                    <tbody>
                      <tr>
                        <td>User ID:</td>
                        <td><?php echo($Username) ?></td>
                      </tr>
                      <tr>
                        <td>Name:</td>
                        <td><?php echo($realName) ?></td>
                      </tr>
                      <tr>
                        <td>Email:</td>
                        <td><?php echo($email) ?></td>
                      </tr>
                   
                         <tr>
                             <tr>
                        <td>Credit Limit:</td>
                        <td><?php echo($creditLeft) ?></td>
                      </tr>
                        <tr>
                        <td>Used Credit:</td>
                        <td><?php echo($used) ?></td>
                      </tr>
                      <tr>
                        <td>Overdue:</td>
                        <td><?php echo($over) ?></td>
                      </tr>
                      <tr>
                        <td>Password:</td>
                        <td>********</td>
                      </tr>
                        <td>Phone Number:</td>
                        <td><?php echo($phone) ?>
                        </td>
                         <tr>
                        <td>Home Address:</td>
                        <td><?php echo($address) ?></td>
                      </tr>
                           
                      </tr>
                     
                    </tbody>
                  </table>
                                
                  
                            <a href="updateInfo.php" class="btn btn-primary" >Edit Profile</a>
                          
                    </form>
               
                </div>
              </div>
                </div>
            </div>
            </div>
          <?php include('Footer.php') ?>
                    </div>
               </div>
     
           </div>
    

        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
       
        <!-- partial -->
      
      <!-- main-panel ends -->
    
    <!-- page-body-wrapper ends -->
  
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <script src="vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/misc.js"></script>
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
   $user2 = new InvoiceOB("", "", "", "", "", "", "");
    $invoiceID = $user2->getInvoiceUserID();
    $invoiceDate = $user2->getInvoiceDate();
    $invoiceUserID = $user2->getInvoiceUserID();
    $invoiceOrderID = $user2->getInvoiceOrderID();
    $invoiceAmount = $user2->getInvoiceAmount();
    $invoiceStatus = $user2->getPaymentStatus();
    //datedb = new mysqli($servername, $db_user, $db_password, $db_table); deprecated with PDO
    $conn_updatedb = Database::getInstance();
    $query_updatedb = "SELECT * FROM invoices WHERE userID ='1'";   
    $update_result = $conn_updatedb->query($query_updatedb);
    if (!$update_result) {
        trigger_error('Invalid query: ' . $conn->error);
    }
    $conn_updatedb->close();
    
   
 
}



}
?>

    

