
<?php
include_once '../../Object/CustomerOb.php';
session_start();

$user = new Customer("", "", "", "", "", "", "", "", "", "");
if ($_SESSION["user"] == null) {
    echo "<script> location.href='login.php'; </script>";
}
$user = $_SESSION["user"];
$Username = $user->getUserID();

?>

<!DOCTYPE html>

<html>
    <head>
        
        <meta charset="UTF-8">
        <style>
            body {
                background-color: #FFCDD2;
            }
            h1{
                color:maroon;
                margin-left: 100px;
            }
        </style>
        <title>Take new order.</title>
        
    </head>
    <body>
        <h1>Take new order</h1>
        <?php
        echo($Username);
        ?>
        <hr>
        <form action="processOrder.php" method="POST">
            <table style="border: 0px;">
                
                <th style="width: 150px; text-align: center;">Product</th>
                <th style="width: 150px; text-align: center;">Quantity</th>
                
                <tr style="width: 150px; text-align: center;">
                    <td>order ID</td>
                    <td>
                        <input type="text" name="orderID" size="3"/>
                    </td>
                </tr>
                <tr style="width: 150px; text-align: center;">
                    <td>user ID</td>
                    <td>
                <input type="text" name="userID" size="3"/>
                </td>
                </tr>
                   <tr style="width: 150px; text-align: center;">
                    <td>order DATE</td>
                    <td>
                <input type="text" name="orderDate" size="3"/>
                </td>
                </tr>
                   <tr style="width: 150px; text-align: center;">
                    <td>pickup</td>
                    <td>
                <input type="text" name="pickup" size="3"/>
                </td>
                </tr>
                   <tr style="width: 150px; text-align: center;">
                    <td>delivery address</td>
                    <td>
                <input type="text" name="deliveryAddress" size="3"/>
                </td>
                </tr>
                   <tr style="width: 150px; text-align: center;">
                    <td>required Date</td>
                    <td>
                <input type="text" name="requireDate" size="3"/>
                </td>
                </tr>
                   <tr style="width: 150px; text-align: center;">
                    <td>total amount</td>
                    <td>
                <input type="text" name="totalAmount" size="3"/>
                </td>
                </tr>
                   <tr style="width: 150px; text-align: center;">
                    <td>status</td>
                    <td>
                <input type="text" name="status" size="3"/>
                </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: center;">
                        <input type="submit" value="Submit" />
                   
                </tr>
             
            </table>
                  
          
            
        </form>
  

    </body>

</html>
