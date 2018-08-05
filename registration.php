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
  <style>
/* Style all input fields */
input {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    margin-top: 6px;
    margin-bottom: 16px;
}

/* Style the submit button */



/* Style the container for inputs */


/* The message box is shown when the user clicks on the password field */
#message {
    display:none;
    background: #f1f1f1;
    color: #000;
    position: relative;
    padding: 20px;
    margin-top: 10px;
}

#message p {
    padding: 10px 35px;
    font-size: 18px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
    color: green;
}

.valid:before {
    position: relative;
    left: -35px;
    content: "✔";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
    color: red;
}

.invalid:before {
    position: relative;
    left: -35px;
    content: "✖";
}
</style>
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
              
             <div class="row">
            
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Signing up is easy. It only takes a few steps</h4>
                  <form class="forms-sample" method="post" action="registration.php">
                    <div class="form-group">
                      <label for="username">Username</label>
                      <input type="text" class="form-control" id="username" placeholder="Username" name="userid" required="required">
                    </div>
                     <div class="form-group">
                          <label>Membership</label>
                          
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="membershipRadios" id="customer" value="Customer" >
                                Customer
                              </label>
                            </div>
                  <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="membershipRadios" id="corcustomer" value="Corporate" required="required">
                                Corporate Customer
                              </label>
                            </div>
                        </div>
                      <div class="form-group">
                      <label for="exampleInputUsername1">Name</label>
                      <input type="text" class="form-control" id="name" placeholder="Username" name="name" required="required">
                    </div>
                       <div class="form-group">
                      <label for="username">Address</label>
                      <input type="text" class="form-control" id="address" placeholder="address" name="address" required="required">
                    </div>
                       <div class="form-group">
                      <label for="username">Phone</label>
                      <input type="text" class="form-control" id="phone" placeholder="phone" name="phone" required="required">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                       <input type="hidden" name="creditLimit" value="500">
                      <input type="hidden" name="usedCrdit" value="0">
                      <input type="hidden" name="overDue" value="0">
                    </div>
                   
                    <div class="form-group">
                      <label for="exampleInputConfirmPassword1">Password</label>
                      <input type="password" class="form-control" required="required" placeholder="Password" name="password" id="password" pattern="(?=.*\d)(?=.*[a-z])(?=onkeyup='check();.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" >
                    </div>
                       <div id="message">
  <h3>Password must contain the following:</h3>
  <p id="letter" class="invalid">A <b>lowercase</b> letter</p>
  <p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
  <p id="number" class="invalid">A <b>number</b></p>
  <p id="length" class="invalid">Minimum <b>8 characters</b></p>
</div>
                      
                    <div class="form-check form-check-flat form-check-primary">
                      
                    </div>
                    <input type="submit" class="btn btn-gradient-primary mr-2" name="submit" id="submit">
                   
                  </form>
                  <h5>Already have account? <a href="login.php">Login</a></h5>
                </div>
              </div>
            
            </div>
              
          </div>
              <?php include('Footer.php') ?>
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
    include_once 'Pattern/PasswordFactory.php';
    $passgen = new PasswordFactory();
    $saltedPass = $passgen->getSaltedPassword($_POST['password']);
    $typeCus=$_POST["membershipRadios"];
    $credit=$_POST["creditLimit"];
    $usedCredit=$_POST["usedCrdit"];
    $overDue=$_POST["overDue"];
    if($typeCus =="Customer" )
    {
       $credit = '0';
        $usedCredit='0';
        $overDueue="no";
    }
  $sql="INSERT INTO users (userID, userType, Name, Address,Phone, Email, creditLimit, usedCredit, overDue, password)VALUES ('".$_POST["userid"]."','$typeCus','".$_POST["name"]."','".$_POST["address"]."','".$_POST["phone"]."','".$_POST["email"]."','$credit','$usedCredit','$overDue','".$saltedPass."')";
 
$conn = Database::getInstance();

$login_result = $conn->query($sql);
if(!$login_result){
        trigger_error('Invalid query: ' . $conn->error);
    }
$conn->close();
}

?>
  <script>
var myInput = document.getElementById("password");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var length = document.getElementById("length");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
    document.getElementById("message").style.display = "block";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
    document.getElementById("message").style.display = "none";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
  // Validate lowercase letters
  var lowerCaseLetters = /[a-z]/g;
  if(myInput.value.match(lowerCaseLetters)) {  
    letter.classList.remove("invalid");
    letter.classList.add("valid");
  } else {
    letter.classList.remove("valid");
    letter.classList.add("invalid");
  }
  
  // Validate capital letters
  var upperCaseLetters = /[A-Z]/g;
  if(myInput.value.match(upperCaseLetters)) {  
    capital.classList.remove("invalid");
    capital.classList.add("valid");
  } else {
    capital.classList.remove("valid");
    capital.classList.add("invalid");
  }

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myInput.value.match(numbers)) {  
    number.classList.remove("invalid");
    number.classList.add("valid");
  } else {
    number.classList.remove("valid");
    number.classList.add("invalid");
  }
  
  // Validate length
  if(myInput.value.length >= 8) {
    length.classList.remove("invalid");
    length.classList.add("valid");
  } else {
    length.classList.remove("valid");
    length.classList.add("invalid");
  }
}
</script>
  
  <script src="js/off-canvas.js"></script>
  <script src="js/misc.js"></script>
  <!-- endinject -->
</body>
  </html>
