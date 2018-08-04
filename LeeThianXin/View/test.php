<?php
$xml = new DOMDocument('1.0');
$xml->formatOutput=TRUE;


$CatalogRow = $xml->createElement("CatalogRow");
$xml->appendChild($CatalogRow);

$productCode=$xml->createElement("productCode", "PDR1");
$CatalogRow->appendChild($productCode);

$productType=$xml->createElement("productType", "Flower");
$CatalogRow->appendChild($productType);

$productQuantity=$xml->createElement("productQuantity", "24");
$CatalogRow->appendChild($productQuantity);

$totalPrice=$xml->createElement("totalPrice", "240");
$CatalogRow->appendChild($totalPrice);

$userID=$xml->createElement("userID", "lee95");
$CatalogRow->appendChild($userID);

$userType=$xml->createElement("userType", "Customer");
$CatalogRow->appendChild($userType);

//$CatalogRecord= $xml->createElement("CatalogRecord");
//$xml->appendChild($CatalogRecord);
//
//$CatalogRow = $xml->createElement("CatalogRow");
//$CatalogRow->setAttribute("rowID", "c1");
//$CatalogRecord->appendChild($CatalogRow);
//
//$orderID=$xml->createElement("orderID", "ORD0001");
//$CatalogRow->appendChild($orderID);
//
//$userID=$xml->createElement("userID", "UID0001");
//$CatalogRow->appendChild($userID);
//
//$orderDate=$xml->createElement("orderDate", "2/8/2018");
//$CatalogRow->appendChild($orderDate);
//
//$pickup=$xml->createElement("pickup", "no");
//$CatalogRow->appendChild($pickup);
//
//$deliveryAddress=$xml->createElement("deliveryAddress", "pv-16");
//$CatalogRow->appendChild($deliveryAddress);
//
//$requiredDate=$xml->createElement("requiredDate", "5/8/2018");
//$CatalogRow->appendChild($requiredDate);
//
//$totalAmount=$xml->createElement("totalAmount", "300");
//$CatalogRow->appendChild($totalAmount);
//
//$status=$xml->createElement("status", "unpaid");
//$CatalogRow->appendChild($status);



echo "<xmp>".$xml->saveXML()."</xmp>";

?>
