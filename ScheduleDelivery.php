<?php
    ini_set('display_errors', 1);
    include_once './Function/ValidateInput.php';
    include_once './Object/CustomerOb.php';
    include_once './customOrderDA.php';
    session_start();

    $user = new Customer("", "", "", "", "", "", "", "", "","");
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
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <h4>Schedule Delivery</h4>
        <form action="" method="post">
            <input type="radio" id="delivery" name="method" value="delivery" checked="checked"  onclick="document.getElementById('address').disabled =false;"/>Set up a Delivery
            <input type="radio" id="pickup" name="method" value="pickup" onclick="document.getElementById('address').disabled = true;document.getElementById('address').value = ''"/>In-Store Pickup
            
            <table>
                <tr>
                    <td>Delivery address : </td>
                    <td><textarea id="address" name="address" rows="6" cols="15"></textarea></td>
                </tr>
                <tr>
                    <td>Date and Time :</td>
                   <td><input type='datetime-local' name='getDate' /></td>
                    
                </tr>
                <tr>
                    <td><button><a href="customOrder.xml">Back</a></button></td>
                    <td><input type="submit" id="btnSub" name="btnSub" value="Place Order"/></td>
                </tr>
            </table>
            
        </form>
        
        <?php
            $errorMsg = " ";
            $checkError = false;
            if(isset($_POST["btnSub"])){             
                if(empty($_POST["address"])&& $_POST["method"]== "delivery"){
                    $errorMsg.= "Address cannot be empty<br/>";
                }

                if(empty($_POST["getDate"])){
                    $errorMsg .= "Date and time are required.<br/>";
                    $checkError = true;
                }elseif (strtotime ($_POST["getDate"]) <= strtotime('tomorrow')) {
                    $errorMsg.= "Date must be later than today.<br/>";
                    $checkError = true;
                }        
                echo $errorMsg;
                if($checkError == false){
                    $validate = new ValidateInput();
                    if($_POST["method"] == "delivery"){
                        $address =  $validate->getValidatedInput($_POST["address"]);
                    }
                    $date = Date('d-m-Y H:i:s', strtotime( $_POST["getDate"]));
                    $date = $validate->getValidatedInput($date);
                    //store to database
                    $order = new customOrderDA();
                    $lastID = $order->getLastInsertedID();
                    echo $lastID;
                }
            
            }
//            if(isset($_POST["method"])){
//                $method = $_POST["method"];
//                if($method == "delivery"){
//                    echo "Delivery Address : <textarea id='address' name='address' ></textarea><br/>";
//                    echo "Delivery Date and Time : <input type='datetime-local' />";
//                }
//                    
//            }
//            
//            //if
        ?>
    </body>
</html>
