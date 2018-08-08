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
        $invoiceob = new InvoiceOB("", "", "", "", "", "");
        $invoiceob = $ordCon->getInvoiceUserID($Username);
        
        for ($i = 0; $i < count($invoiceob); $i++) {
            echo("<tr>");
            echo("<td>" . $invoiceob[$i]->getInvoiceNo() . "</td>");
            echo("<td>" . $invoiceob[$i]->getInvoiceDate() . "</td>");
            echo("<td>" . $invoiceob[$i]->getInvoiceUserID() . "</td>");
           # echo("<td>" . $invoiceob[$i]->getInvoiceOrderID() . "</td>");
            echo("<td>" . $invoiceob[$i]->getInvoiceAmount() . "</td>");
            echo("<td>" . $invoiceob[$i]->getPaymentStatus() . "</td>");


            $xmlPath = "CustomerSite/Invoice.xml";
    $drob = new InvoiceOB("", "", "", "", "", "");
    $report_controller = new InvoiceController($xmlPath);
    $drob->setInvoiceNo( $invoiceob[$i]->getInvoiceNo());
    $drob->setInvoiceDate( $invoiceob[$i]->getInvoiceDate());
    $drob->setInvoiceUserID($invoiceob[$i]->getInvoiceUserID());
   # $drob->setInvoiceOrderID($invoiceob[$i]->getInvoiceOrderID());
    $drob->setInvoiceAmount($invoiceob[$i]->getInvoiceAmount());
    $drob->setPaymentStatus($invoiceob[$i]->getPaymentStatus());
    $report_controller->clearRecord();
    $report_controller->updateRecord($drob);
    echo "<script> location.href='CustomerSite/Invoice.xml';</script>";       
    
   
    
        }
       
        ?>
        
    </body>
</html>