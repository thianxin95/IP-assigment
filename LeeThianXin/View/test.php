<?php
$xml = new DOMDocument('1.0');
$xml->formatOutput=TRUE;

   $CatalogRow = $xml->createElement("CatalogRow"); 
        $CatalogRow->setAttribute("productCode", "aaaaa1");
        $xml->appendChild($CatalogRow);

        $OrderDetailsID = $xml->createElement("OrderDetailsID", "2");
        $CatalogRow->appendChild($OrderDetailsID);

        $OrderID = $xml->createElement("OrderID", "3");
        $CatalogRow->appendChild($OrderID);

        $ProductCode = $xml->createElement("ProductCode", "we4");
        $CatalogRow->appendChild($ProductCode);

        $Quantity = $xml->createElement("Quantity", "5");
        $CatalogRow->appendChild($Quantity);

        $UnitPrice = $xml->createElement("UnitPrice", "6");
        $CatalogRow->appendChild($UnitPrice);


//        $CatalogRow = $xml->createElement("CatalogRow"); 
//        $CatalogRow->setAttribute("productCode", "aaaaa1");
//        $xml->appendChild($CatalogRow);
//
//        $OrderDetailsID = $xml->createElement("OrderDetailsID", "2");
//        $CatalogRow->appendChild($OrderDetailsID);
//
//        $OrderID = $xml->createElement("OrderID", "3");
//        $CatalogRow->appendChild($OrderID);
//
//        $ProductCode = $xml->createElement("ProductCode", "4");
//        $CatalogRow->appendChild($ProductCode);
//
//        $Quantity = $xml->createElement("Quantity", "5");
//        $CatalogRow->appendChild($Quantity);
//
//        $UnitPrice = $xml->createElement("UnitPrice", "6");
//        $CatalogRow->appendChild($UnitPrice);
//


echo "<xmp>".$xml->saveXML()."</xmp>";

?>
