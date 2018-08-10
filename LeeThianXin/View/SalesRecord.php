
<!--
/**
 * Description of SalesRecord
 *
 * @author Daniel Lee
 */
-->

<?php
include '../../Object/OrderDetailsOB.php';
include '../../Controller/OrderDetailsController.php';

include_once '../../Controller/SalesOrderController.php';
include_once '../../Object/SalesOrderOB.php';
include_once './SalesOrderxmlWritter.php';
include_once '../../Object/EmployeeOB.php';

session_start();

$user = new Employee("", "", "", "", "", "", "", "", "", "");
if ($_SESSION["employee"] == null) {
    echo "<script> location.href='../../login.php'; </script>";
}
$user = $_SESSION["employee"];
$Username = $user->getUserID();

$salesOrder_ctrl = new SalesOrderController();
$productIDList = $salesOrder_ctrl->getProductID();

if($productIDList == null){
    echo '<script> alert("No record...");</script>';
    echo "<script> location.href='../../Employee/index.php'; </script>";
}

//for ($i = 0; $i < count($productIDList); $i++) {
//    echo '</br>' . $productIDList[$i];
//}



if ($productIDList != null) {
    $ab = 1;
    for ($i = 0; $i < count($productIDList); $i++) {
        $quantity = $salesOrder_ctrl->getQuantity($productIDList[$i]);
        $unitPrice = $salesOrder_ctrl->getUnitPrice($productIDList[$i]);
        $totalAmount = $quantity * $unitPrice;
        $recordID = 'RCD' . $ab;
        $salesProduct = new SalesOrderOB($recordID, $productIDList[$i], $quantity, $totalAmount);
        $saleOrderlist[] = $salesProduct;
        $ab++;
    }
}

if ($saleOrderlist != NULL) {
    for ($i = 0; $i < count($saleOrderlist); $i++) {

        echo '</br>Record ID ' . $saleOrderlist[$i]->getId() . '</br>Product: ' . $saleOrderlist[$i]->getProductCode() . 'Quantity' . $saleOrderlist[$i]->getQuantity() . "Total Amount: " . $saleOrderlist[$i]->getTotalAmount();
    }
}

$item = new SalesOrderOB("", "", "", "");

$imp = new DOMImplementation;
$dtd = $imp->createDocumentType('SaleReport', '', 'SaleRecord.dtd');
$dom = $imp->createDocument("", "", $dtd);
$dom->createProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="SalesReport.xsl"');

$dom->preserveWhiteSpace = false;
$dom->formatOutput = true;

$xslt = $dom->createProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="SalesReport.xsl"');
$dom->appendChild($xslt);

$saleReport = $dom->createElement("SaleReport");

$dom->appendChild($saleReport);

foreach ($saleOrderlist as $productDetail) {
    $item = $productDetail;

    $record = $dom->createElement("record");
    $record->setAttribute("recordID", $item->getId());
    $saleReport->appendChild($record);

    $productCode = $dom->createElement("productCode", $item->getProductCode());
    $record->appendChild($productCode);

    $quantity = $dom->createElement("quantity", $item->getQuantity());
    $record->appendChild($quantity);

    $totalAmount = $dom->createElement("totalAmount", $item->getTotalAmount());
    $record->appendChild($totalAmount);
}

$dom->save("SaleReport.xml");

echo "<script> location.href='SaleReport.xml'; </script>";
?>

