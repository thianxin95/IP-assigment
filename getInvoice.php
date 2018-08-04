<?php
#include 'Object/CustomerOb.php';
include_once 'Controller/OrderListController.php';
include 'Object/InvoiceOB.php';
include_once 'CustomerSite/InvoiceController.php';

session_start();

$user = new Customer("", "", "", "", "", "", "", "", "", "");
$user = $_SESSION["user"];
if ($_SESSION["user"] == null) {
    echo "<script> location.href='login.php'; </script>";
}
//Check user if it was employee, if not, for logout and back to login.php


$Username = $user->getUserID();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>

        <?php
        $ordCon = new OrderListController();
        $invoiceob = new InvoiceOB("", "", "", "", "", "", "");
        $invoiceob = $ordCon->getInvoiceUserID($Username);
        
        for ($i = 0; $i < count($invoiceob); $i++) {
            echo("<tr>");
            echo("<td>" . $invoiceob[$i]->getInvoiceNo() . "</td>");
            echo("<td>" . $invoiceob[$i]->getInvoiceDate() . "</td>");
            echo("<td>" . $invoiceob[$i]->getInvoiceUserID() . "</td>");
            echo("<td>" . $invoiceob[$i]->getInvoiceOrderID() . "</td>");
            echo("<td>" . $invoiceob[$i]->getInvoiceAmount() . "</td>");
            echo("<td>" . $invoiceob[$i]->getPaymentStatus() . "</td>");


           
            
    
   
    $xmlPath = "CustomerSite/Invoice.xml";
    $drob = new InvoiceOB("", "", "", "", "", "", "");
    $report_controller = new InvoiceController($xmlPath);
    $drob->setInvoiceNo("3/08/2018");
    $drob->setInvoiceDate("1");
    $drob->setInvoiceUserID("1");
    $drob->setInvoiceOrderID("1");
    $drob->setInvoiceAmount("1sjj");
    $drob->setPaymentStatus("1sjj");
    $report_controller->updateRecord($drob);
        }
        ?>
        
    </body>
</html>