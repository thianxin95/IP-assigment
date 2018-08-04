<!DOCTYPE html>

<?php
include './CatalogController.php';
include_once '../Model/Order.php';


$orderID = $_POST['orderID'];
$userID = $_POST['userID'];
$orderDate = $_POST['orderDate'];
$pickup = $_POST['pickup'];
$deliveryAddress = $_POST['deliveryAddress'];
$requireDate = $_POST['requireDate'];
$totalAmount = $_POST['totalAmount'];
$status = $_POST['status'];

$xmlPath = "./CatalogItem.xml";
$order = new Order();
$order_controller = new CatalogController($xmlPath);
$order->setOrderID($orderID);
$order->setUserID($userID);
$order->setOrderDate($orderDate);
$order->setPickup($pickup);
$order->setDeliveryAddress($deliveryAddress);
$order->setRequiredDate($requireDate);
$order->setTotalAmount($totalAmount);
$order->setStatus($status);
$order_controller->clearRecord();
$order_controller->updateRecord($order);

echo ($order->getOrderID());


        ?>
    </body>
</html>
