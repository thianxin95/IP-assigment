<!DOCTYPE html>
<!--
/**
 * Description of OrderMenu
 *
 * @author Daniel Lee
 */
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Order Page</title>
    </head>
    <style>      
        table,th,td{
            border: 1px solid black;
        }
        .chooseProduct{
            background-color: lightblue;
        }
        .tap2{
            background-color: #9FA8DA;
        }
    </style>
    <body>
        <?php
        include_once '../../Controller/ProductController.php';
        include_once '../../Object/CustomerOb.php';
        include_once '../../Object/OrderDetailsOB.php';
        include_once '../../Controller/OrderDetailsController.php';
        include_once '../../Object/Session_itemSelected.php';
        session_start();
        if (isset($_SESSION["user"])) {
            echo "Your session is here. </br> ";
        }
        $user = new Customer("", "", "", "", "", "", "", "", "", "");
        if ($_SESSION["user"] == null) {
            echo "<script> location.href='../../login.php'; </script>";
            echo"empty";
        }
        $user = $_SESSION["user"];
        $UserID = $user->getUserID();
        $Username = $user->getName();
        $Usertype = $user->getUserType();
        echo 'Welcome ' . $Username;

        $linkstate = "return false";
        ?>
        <div class="chooseProduct">
            <h1>Product list</h1>

            <form action="OrderMenu.php" method="POST">                          

                <table>
                    <tr>
                        <th>Product Code</th>
                        <th>Product Type</th>
                        <th>Description</th>
                        <th>Availability</th>
                        <th>Price</th>

                    </tr>
                    <?php
                    $_productcont = new ProductController();
                    $productlist = $_productcont->getAllProduct();

                    for ($a = 0; $a < count($productlist); $a++) {
                        $productCode = $productlist[$a]->getProductCode();
                        $producttype = $productlist[$a]->getProductType();
                        $productdes = $productlist[$a]->getProductDes();
                        $Availability = $productlist[$a]->getAvailability();
                        $price = $productlist[$a]->getPrice();
                        echo("<tr>");
                        echo("<td>$productCode</td>");
                        echo("<td>$producttype</td>");
                        echo("<td>$productdes</td>");
                        echo("<td>$Availability</td>");
                        echo("<td>RM$price</td>");
                        echo("</tr>");
                    }
                    ?>

                </table>
                Product Code: 
                <select name="productcode"> 
                    <option value="0">--Select Product Code--</option>
                    <?php
                    for ($b = 0; $b < count($productlist); $b++) {
                        $productCode = $productlist[$b]->getProductCode();

                        echo '<option value="' . $productCode . '">' . $productCode . '</option>';
                    }
                    ?>
                </select>


                <input type="number" name="quantity" placeholder="Quantity">
                <br><br>


                <input type="submit" name="submit" value="Add item into catalog"> 



                <?php
                if (isset($_POST['submit'])) {
                    $i = 0;
                    if ($_POST['submit'] == 'Add item into catalog') {

                        if (empty($_POST['quantity'])) {
                            echo '<script> alert("MUST CHOOSE QUANTITY IN ORDER TO PLACE ORDER.");</script>';
                        } else if ($_POST['quantity'] <= 0) {
                            echo '<script> alert("MUST insert greater that 0.");</script>';
                        } elseif ($_POST['productcode'] == '0') {
                            echo '<script> alert("PLEASE CHOOSE A PRODUCT TO MAKE ORDER.");</script>';
                        } else {
                            $proCode = $_POST['productcode'];
                            $quantity = $_POST['quantity'];

                            for ($c = 0; $c < count($productlist); $c++) {

                                $productCode = $productlist[$c]->getProductCode();
                                if ($productCode == $proCode) {
                                    $price = $productlist[$c]->getPrice();
                                    $totalprice = $price * $quantity;
                                }
                            }



                            $Selected_item = new Session_itemSelected($UserID, $proCode, $quantity, $price, $totalprice);

                            $_SESSION["Selected_itemArray"][] = $Selected_item;

                            echo '</br>Selected item = ' . $Selected_item->getUserID() . ' ' . $Selected_item->getProductCode() . ' ' . $Selected_item->getQuantity() . ' ' . $Selected_item->getUnitPrice() . ' ' . $Selected_item->getTotalprice();

                            $linkstate = "true";
                        }
                    }
                }
                ?>

            </form>



            <a class="nav-link" href="DisplayCatalogProduct.php" onclick= "<?php echo $linkstate; ?>"> view catalog item </a>


        </div>

    </body>
</html>
